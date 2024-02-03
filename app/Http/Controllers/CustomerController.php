<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
/*use PhpOffice\PhpSpreadsheet\Writer\Xlsx*/;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Aws\S3\S3Client;
use App\Jobs\{ProcessAttendanceExcelData,ProcessCustomerExcelData,ProcessMembershipExcelData};
use GuzzleHttp\Client;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ExportCustomer;
use App\Imports\{CustomerImport,ImportMembership,customerAtendanceImport};
use Maatwebsite\Excel\HeadingRowImport;
use Session,Redirect,DB,Input,Auth,Hash,Validator,View,Mail,Str,Config,Excel,SplFileInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use App\Repositories\{CustomerRepository,BookingRepository,UserRepository};
use App\{BusinessCompanyDetail,BusinessServices,User,Customer,CustomerFamilyDetail,BusinessTerms,UserBookingDetail,SGMailService,MailService,UserBookingStatus,CompanyInformation,ExcelUploadTracker,UserFamilyDetail,Transaction,StripePaymentMethod,CustomersDocuments,CustomerNotes,CustomerDocumentsRequested,Notification};

use Illuminate\Support\Facades\Storage;

use Request as resAll;

class CustomerController extends Controller {
    /**
     * The user repository instance.
     *
     * @var CustomerRepository
     */

    protected $customers;
    protected $company;
    public $error = '';

    public function __construct(CustomerRepository $customers,BookingRepository $bookings,UserRepository $users) {
        $this->middleware('auth');
        $this->customers = $customers;
        $this->bookings = $bookings;
    }

    public function client(){
        return view('customers.add_client');
    }

    public function index(Request $request, $business_id){
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $customers = $company->customers()->orderBy('fname');
        
        if($request->term){
            $searchValues = preg_split('/\s+/', $request->term, -1, PREG_SPLIT_NO_EMPTY);
            $customers = $customers->where('business_id', $business_id)
                ->where(function ($q) use ($searchValues) {
                    $serch1 = @$searchValues[0] != '' ? @$searchValues[0] : '';
                    $serch2 = @$searchValues[1] != '' ? @$searchValues[1] : '';
                    $q->orderBy('fname');
                    if($serch1 != '' && $serch2 != ''){
                        $q->where(function($q) use ($serch1, $serch2) {
                            $q->where('fname', 'like', "%{$serch1}%")
                              ->where('lname', 'like', "%{$serch2}%");
                        })
                        ->orWhere(function($q) use ($serch1, $serch2) {
                            $q->where('fname', 'like', "%{$serch2}%")
                              ->where('lname', 'like', "%{$serch1}%");
                        });
                    }else{
                        $q->orWhere('fname', 'like', "%{$serch1}%")
                        ->orWhere('lname', 'like', "%{$serch1}%")
                        ->orWhere('email', 'like', "%{$serch1}%")
                        ->orWhere('phone_number', 'like', "%{$serch1}%");
                    }  
                });
        }

        if($request->customer_id){
            $customers = $customers->where('id',$request->customer_id);
        }

        $customers = $customers->get();
        $customerCount = count($customers);

        if ($request->ajax()) {
            return response()->json($customers);
        }
        return view('customers.index', [
            'company' => $company,
            'customerCount' => $customerCount,
        ]); 
    }

    public function create(Request $request, $business_id){
        $intent = $clientSecret = null;
        $success = 0;
        if(!$request->customer_id){
            if (session()->has('success-register')) {
                $success = session('success-register');
            }
            session()->forget('success-register');
        }

        $businessTerms = BusinessTerms::where('cid',$business_id)->first();
        if($request->customer_id){
            $customer = Customer::find($request->customer_id);
            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            if($customer->stripe_customer_id != ''){
                $intent = $stripe->setupIntents->create([
                    'payment_method_types' => ['card'],
                    'customer' => $customer->stripe_customer_id,
                ]);
                $clientSecret = $intent['client_secret'];
            } 
        }
        return view('customers.create',compact('clientSecret', 'business_id','success','businessTerms'));
    }

    public function delete(Request $request, $business_id){
        $customerdata = $this->customers->findById($request->id);
        if( $customerdata != ''){
            Customer::where('id',$request->id)->delete();
        }
    }

    public function show(Request $request, $business_id, $id){
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $terms = $company->business_terms->first();
        $customerdata = $company->customers->find($id);
        if(!$customerdata){
            return redirect()->route('business_customer_index');
        }
        $visits = $customerdata != '' ? $customerdata->visits()->get() : [];
        $active_memberships = $customerdata != '' ? $customerdata->active_memberships()->orderBy('created_at','desc')->get() : [];
        $purchase_history = @$customerdata != '' ?  @$customerdata->purchase_history()->get() : [];

       
        $complete_booking_details = @$customerdata != '' ? $customerdata->complete_booking_details()->get() : [];
        $strpecarderror = '';
        if (session()->has('strpecarderror')) {
            $strpecarderror = Session::get('strpecarderror');
        }

        $auto_pay_payment_msg = '';
        if($request->session()->has('recurringPayment')){
            $auto_pay_payment_msg =  $request->session()->get('recurringPayment');
            $request->session()->forget('recurringPayment');
        }


        $documents = CustomersDocuments::where(['customer_id'=>$id])->get();
        $lastBooking = $customerdata->bookingDetail()->orderby('created_at','desc')->first();
        $notes = CustomerNotes::where(['customer_id'=>$id])->get();

        $cardSuccessMsg =0;

        if(Session::has('cardSuccessMsg')){
            $cardSuccessMsg = 1;
            Session::forget('cardSuccessMsg');
        }

        return view('customers.show', [
            'customerdata'=>$customerdata,
            'strpecarderror'=>$strpecarderror,
            'terms'=> $terms,
            'visits' => $visits,
            'purchase_history' => $purchase_history,
            'active_memberships' => $active_memberships,
            'complete_booking_details' => $complete_booking_details,
            'auto_pay_payment_msg' =>$auto_pay_payment_msg,
            'documents' =>$documents,
            'notes' =>$notes,
            'lastBooking' =>$lastBooking,
            'cardSuccessMsg' =>$cardSuccessMsg,
        ]);
    }

    public function searchcustomersaction(Request $request) {
        if($request->get('query'))
        {
            $array_data=array();
            $query = $request->get('query');
          
            // $data_cus = $this->customers->findByfname($query); 
            $data_cus = User::where('firstname', 'LIKE', "%{$query}%")->orWhere('lastname', 'LIKE', "%{$query}%")->orWhere('username', 'LIKE', "%{$query}%")->get();
           
            foreach($data_cus as $cuss)
            {   
                $array_data [] = array(
                    "name"=>$cuss->fname .' '.$cuss->lname , 
                    "cus_id"=>$cuss->id,
                    "image" => $cuss->profile_pic,
                    "email" => $cuss->email,
                    "phone_number" => $cuss->phone_number,
                    "age" => $cuss->getcustage(),
                );
            }

            sort($array_data);
          
            $output = '<ul class="customer-list">';
            if(!empty($array_data)){
                foreach($array_data as $row)
                {
                    $output .= '<li class="searchclick" >
                        <div class="row rowclass-controller">
                            <div class="col-md-2">';
                            if($row['image'] != ''){
                                $output .='<img src="'.asset('/customers/images/'.$row['image']).'">';
                            }else{
                                $output .='<div class="company-profile-img-controller">';
                                        $pf=substr($row['name'], 0, 1);
                                $output .='<p class="img-controller">'.$pf.'</p></div>';
                            }
                            $age = '';
                            if($row['age'] != '—'){
                                $age = '('.$row['age'].'  Years Old)';
                            }

                            $output .='</div>
                            <div class="col-md-10 div-controller">
                                <p class="pstyle">'.$row['name'].' <label class="liaddress">'.$age.'<label></p>
                                <p class="pstyle liaddress">'.$row['email'].'</p>
                                <p class="pstyle liaddress">'.$row['phone_number'].'</p>
                            </div>
                            <input type="hidden" name="cid" id="cid" value="'.$row['cus_id'].'">
                        </div></li>';
                }
            }
            else
            {
                $output .= '<li class="liimage"> ';
                $output .= "Looks like there's no client with that name listed.</li>";
            }
           
            echo $output;
        }
    }

    public function export(Request $request)
    {   
        return Excel::download(new ExportCustomer($request->id,$request->chk), 'customer.xlsx');
    }

    public function sendemailtocutomer(Request $request){
        $customer = Customer::findOrFail($request->cid);
        if(@$customer->password != ''){
            $password = '';
        }else{
            $password = Str::random(8);
            $customer->update(['password' => Hash::make($password)]);
        }
        $status =  SGMailService::sendWelcomeMailToCustomer($request->cid,$request->bid,$password);
       return  $status;
    }

    public function importmembership(Request $request){
        $user = Auth::user();
        $current_company =  $user->current_company;
        if($current_company->id == $request->business_id && $current_company->membership_uploading == 0){
            if($request->hasFile('import_file')){
                $ext = $request->file('import_file')->getClientOriginalExtension();
                if($ext != 'csv' && $ext != 'csvx' && $ext != 'xls' && $ext != 'xlsx' )
                {
                    return response()->json(['status'=>500,'message'=>'File format is not supported.']);
                }
                ini_set('max_execution_time', 10000); 
                $headings = (new HeadingRowImport(2))->toArray($request->file('import_file'));

                if(!empty($headings)){
                    foreach($headings as $key => $row) {
                        $firstrow = $row[0];
                        /*if($firstrow[0] != 'name' || $firstrow[1] != 'membership_type' ||  $firstrow[2] != 'status'|| $firstrow[3] != 'member_from'|| $firstrow[4] != 'member_to') 
                        {
                            $this->error = 'Problem in header.';
                            break;
                        }*/
                        if($firstrow[1] != 'name' || $firstrow[2] != 'membership_type' ||  $firstrow[3] != 'status'|| $firstrow[4] != 'member_from'|| $firstrow[5] != 'member_to') 
                        {
                            $this->error = 'Problem in header.';
                            break;
                        }
                    }
                }

                $current_company->update(['membership_uploading' => 1]);
                // $name = Str::random(8).'.csv';
                // Storage::disk('uploadExcel')->put($name,'');
                // $target = '../public/ExcelUpload/'.$name;

                // $reader = new Xlsx();
                // $spreadsheet = $reader->load($request->file('import_file'));
                // $writer = new Csv($spreadsheet);
                // $writer->save($target);
                // $excel = Excel::toArray(new ImportMembership,$target);
                // $excel = isset($excel[0])?$excel[0]:array();
                // ProcessMembershipExcelData::dispatch($request->business_id,$excel);
                
                //Excel::import(new ImportMembership($request->business_id),  $target);

                // unlink('../public/ExcelUpload/'.$name);

                $file = $request->file('import_file');
                $timestamp = now()->timestamp;
                $uid = $user->id;
                $newFileName = $request->business_id.'-'.$timestamp.'-'.$uid.'.'.$file->getClientOriginalExtension();
                $path = $file->storeAs('ExcelFiles', $newFileName);
                Storage::disk('s3')->put($path, file_get_contents($file));
                $exltracker = new ExcelUploadTracker;
                $exltracker->user_id = $uid;
                $exltracker->business_id = $request->business_id;
                $exltracker->excel_file_name = $newFileName;
                $exltracker->status= 0;
                $exltracker->save();
                $excel = Excel::toArray(new ImportMembership,$path);
                $excel = isset($excel[0])?$excel[0]:array();
                ProcessMembershipExcelData::dispatch($request->business_id,$excel);
                $exltracker->status= 1;
                $exltracker->update();
                $current_company->update(['membership_uploading' => 0]);
            }
        
            if($this->error != '')
            {
                return response()->json(['status'=>500,'message'=>$this->error]);
            }
            else{
                return response()->json(['status'=>200,'message'=>'File imported Successfully']);
            }
        }else{
            return response()->json(['status'=>500,'message'=>'You Don\'t have permission to upload files at this moment']);
        }
    }

    public function importattendance(Request $request){
        set_time_limit(8000000); 
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 10000);
        $user = Auth::user();
        $current_company =  $user->current_company;
        if($current_company->id == $request->business_id  && $current_company->attendance_uploading == 0){
            if($request->hasFile('import_file')){
                $ext = $request->file('import_file')->getClientOriginalExtension();
                if($ext != 'csv' && $ext != 'csvx' && $ext != 'xls' && $ext != 'xlsx' )
                {
                    return response()->json(['status'=>500,'message'=>'File format is not supported.']);
                }
                $headings = (new HeadingRowImport)->toArray($request->file('import_file'));
                if(!empty($headings)){
                    foreach($headings as $key => $row) {
                        $firstrow = $row[0];
                        if( $firstrow[0] != 'date' ||$firstrow[1] != 'day' || $firstrow[2] != 'time' ||$firstrow[4] != 'client'  || $firstrow[8] != 'pricing_option' || $firstrow[9] != 'exp_date'|| $firstrow[10] != 'visits_rem' ) 
                        {
                            $this->error = 'Problem in header.';
                            break;
                        }
                    }
                }

                $current_company->update(['attendance_uploading' => 1]);

                // $name = Str::random(8).'.csv';
                // Storage::disk('uploadExcel')->put($name,'');
                // $target = '../public/ExcelUpload/'.$name;

                // $reader = new Xlsx();
                // $spreadsheet = $reader->load($request->file('import_file'));
                // $writer = new Csv($spreadsheet);
                // $writer->save($target);
                
                // $excel = Excel::toArray(new customerAtendanceImport,$target);
                // $excel = isset($excel[0])?$excel[0]:array();
                // ProcessAttendanceExcelData::dispatch($request->business_id,$excel);

                //Excel::import(new customerAtendanceImport($request->business_id),  $target);
                //unlink('../public/ExcelUpload/'.$name);

                $file = $request->file('import_file');
                $timestamp = now()->timestamp;
                $uid = $user->id;
                $newFileName = $request->business_id.'-'.$timestamp.'-'.$uid.'.'.$file->getClientOriginalExtension();
                $path = $file->storeAs('ExcelFiles', $newFileName);
                Storage::disk('s3')->put($path, file_get_contents($file));

                $exltracker = new ExcelUploadTracker;
                $exltracker->user_id = $uid;
                $exltracker->business_id = $request->business_id;
                $exltracker->excel_file_name = $newFileName;
                $exltracker->status= 0;
                $exltracker->save();

                $excel = Excel::toArray(new customerAtendanceImport,$path);
                $excel = isset($excel[0])?$excel[0]:array();
                ProcessAttendanceExcelData::dispatch($request->business_id,$excel);
                $exltracker->status= 1;
                $exltracker->update();
                $current_company->update(['attendance_uploading' => 0]);
            }
        
            if($this->error != '')
            {
                return response()->json(['status'=>500,'message'=>$this->error]);
            }
            else{
                return response()->json(['status'=>200,'message'=>'File imported Successfully']);
            }
        }else{
            return response()->json(['status'=>500,'message'=>'You Don\'t have permission to upload files at this moment']);
        }
    }

    public function visit_modal(Request $request, $business_id, $id){
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $customer = $company->customers->find($id);
        $visits = $customer->visits()->where('booking_detail_id', $request->booking_detail_id)->get();
        return view('customers.activity_visits', ['visits' => $visits, 'customer' => $customer]);
    }

    public function visit_membership_modal(Request $request, $business_id ){
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $customer = $company->customers->find($request->id);
        $booking_detail = $customer->bookingDetail()->findOrFail($request->booking_detail_id);
        return view('customers._edit_membership_info_model', ['booking_detail' => $booking_detail ,'business_id' =>$business_id ,"customer_id"=>$request->id]);
    }

    public function void_or_refund_modal(Request $request, $business_id ){
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $customer = $company->customers->find($request->id);
        $booking_detail = $customer->bookingDetail()->findOrFail($request->booking_detail_id);
        return view('customers.edit_refund_or_void_model', ['booking_detail' => $booking_detail ,'business_id' =>$business_id ,"customer_id"=>$request->id]);
    }

    public function terminate_or_suspend_modal(Request $request, $business_id ){
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $customer = $company->customers->find($request->id);
        $booking_detail = $customer->bookingDetail()->findOrFail($request->booking_detail_id);
        return view('customers.edit_terminate_or_suspend_model', ['booking_detail' => $booking_detail ,'business_id' =>$business_id ,"customer_id"=>$request->id]);
    }

    public function add_family ($id){
        $UserFamilyDetails  = [];
        $customer = Customer::find($id);
        $UserFamilyDetails  = $customer->get_families();
        $companyId = $customer->business_id;
            
        return view('customers.add_family', [
            'UserFamilyDetails' => $UserFamilyDetails,
            'companyId' => $companyId,
            'parent_cus_id' => $id,
        ]);
        //return view('profiles.viewcustomer');
    }

    public function addFamilyMemberCustomer(Request $request) {
        //print_r($request->all());
        $idArray = [];
        $parent_id = null;
        for ($i=0; $i <= $request->family_count ; $i++) { 
            $customer = Customer::firstOrNew(['id' => $request['cus_id'][$i]]);

            $customer->fill([
                'business_id'       => $request['business_id'],
                'fname'             => $request['fname'][$i],
                'lname'             => $request['lname'][$i],
                'email'             => $request['email'][$i],
                'phone_number'      => $request['mobile'][$i],
                'emergency_contact' => $request['emergency_contact'][$i],
                'relationship'      => $request['relationship'][$i],
                'gender'            => $request['gender'][$i],
                'birthdate'         => $request['birthdate'][$i] != '' ? date('Y-m-d', strtotime($request['birthdate'][$i])) : null,
                'parent_cus_id'     => $request['parent_cus_id'],
                'primary_account' => 0,
            ])->save();

            if (@$request['primaryAccountHolder'][$i] == 1 && $parent_id === null) {
                $parent_id = $customer->id;
            }else{
                $idArray[$i][] = $customer->id;   
            }
        }

            /*echo $parent_id;
            print_r($idArray);exit;*/
        if($parent_id){
            Customer::whereIn('id', $idArray)->update(['parent_cus_id' => $parent_id]);
            Customer::where('id', $request['parent_cus_id'])->update(['parent_cus_id' => $parent_id,'primary_account' => 0]);
            Customer::where('id', $parent_id)->update(['parent_cus_id' => null,'primary_account' => 1]);
        }
        return Redirect::back();
    }

    public function removefamilyCustomer(Request $request) {
        $customer = Customer::find($request->id);
        $customer->update(['parent_cus_id' => NULL]);
       /* DB::delete('DELETE FROM customers WHERE id = "'.$request->id.'"');
        return Redirect::back()->with('success', 'Family Member Delete.');*/
    }

    public function addFamilyViaSearch(Request $request){
        $customer = Customer::find($request->cid);
        $parentCustomer = Customer::find($request->currentCid);
        if($parentCustomer->parent_cus_id != $customer->id && $customer->parent_cus_id != $customer->id){
            $parentCustomer = Customer::find($request->currentCid);
            if($parentCustomer->parent_cus_id != ''){
                $pid = $parentCustomer->parent_cus_id;
            }else{
                $pid = $request->currentCid;
            }
            $customer->update(['parent_cus_id' => $pid]);
        }
    }

    public function update_customer(Request $request){
        //print_r($request->all());exit;
        session()->forget('strpecarderror');
        if($request->chk == 'update_billing'){
            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            
            $customerdata = Customer::find($request->cus_id);
            $customerdata->create_stripe_customer_id();

            $stripe_customer_id = $customerdata->stripe_customer_id;

            if($request->payment_type == 'update'){
                $stripval = $stripe->customers->deleteSource(
                    $stripe_customer_id,
                    $customerdata->card_stripe_id,
                    []
                );
            }

            try{
                if($request->card_month == ''){
                    $request->card_month = $request->card_monthhidden;
                }

                if($request->card_year == ''){
                    $request->card_year = $request->card_yearhidden;
                }
                $carddetails = $stripe->tokens->create([
                    'card' => [
                        'number' => $request->cardNumber,
                        'exp_month' =>  $request->card_month,
                        'exp_year' =>  $request->card_year,
                        'cvc' =>  $request->cvv,
                        'name' =>  $request->owner,
                    ],
                ]);
                $customer_source = $stripe->customers->createSource(
                    $stripe_customer_id,
                    [ 'source' =>$carddetails->id]
                );

                $cust = Customer::find($request->cus_id);
                $data = array(
                    "card_stripe_id"=>$carddetails['card']->id,
                    "card_token_id"=> $carddetails->id,
                );
                $cust = Customer::find($request->cus_id);
                $cust->update($data);
            }catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException | \Exception $e) {
                $statusmsg = "Your card is not valid.";
                Session::put('strpecarderror', $statusmsg);
            }   
        }elseif($request->chk == 'update_personal'){
            $data = $request->all();
            if($request->hasFile('profile_pic')){
                $data['profile_pic'] = $request->file('profile_pic')->store('customer');
            }
            if(@$data['birthdate'] != ''){
                $data['birthdate'] = date('Y-m-d',strtotime($request->birthdate));
            }

            unset($data['_token']);
            unset($data['cus_id']);
            
            $cust = Customer::find($request->cus_id);
            if($request->primary_account == 1){
                $data['parent_cus_id'] = NULL;
                 $data['primary_account']  = 1;
            }else{
                $data['primary_account'] = 0;
            }

            User::where(['email' => $cust['email'] , 'id' => $cust['user_id']])->update(['primary_account' => $data['primary_account'] ,'profile_pic'=> $data['profile_pic'] ?? $cust->profile_pic ]);
            $cust->update($data);
        }elseif($request->chk == 'update_terms'){
            $data = $request->all();
            $covid = (@$data['terms_covid'] == 1) ? date('Y-m-d'): '';
            $liability = (@$data['terms_liability'] == 1) ? date('Y-m-d'): '';
            $contract = (@$data['terms_contract'] == 1) ? date('Y-m-d'): '';
            $cust = Customer::find($request->cus_id);
            $cust->update(['terms_covid' =>$covid,'terms_liability' =>$liability,'terms_contract' =>$contract,]);

        }
        
        return redirect()->route('business_customer_show',['business_id' => $cust->company_information->id, 'id'=>$request->cus_id]);
    }

    public function paymentdeletecustomer(Request $request) {
        $customer = Customer::where('id', $request->cus_id)->first();
        if($customer != ''){
            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            $stripval = $stripe->customers->deleteSource(
                $customer->stripe_customer_id,
                $request->cardid,
                []
            );
            echo $stripval;
        }
    }

    public function sendReceiptToCustomer(Request $request){
        if($request->odetailid == ''){
            $bookingStatus = UserBookingStatus::where('id',$request->oid)->first();
            $bookingDetail = $bookingStatus->UserBookingDetail;
                foreach($bookingDetail as $bd){
                    $getreceipemailtbody = $this->bookings->getreceipemailtbody($request->oid, $bd['id']);
                    $emailDetail = array(
                        'getreceipemailtbody' => $getreceipemailtbody,
                        'email' => $getreceipemailtbody['email']);
                    $status  = SGMailService::sendBookingReceipt($emailDetail);
                }
        }else{
            $getreceipemailtbody = $this->bookings->getreceipemailtbody($request->oid, $request->odetailid);
            $emailDetail = array(
                'getreceipemailtbody' => $getreceipemailtbody,
                'email' => $getreceipemailtbody['email']);
            $status  = SGMailService::sendBookingReceipt($emailDetail);
        }
        return $status;
    }

    public function request_access_mail(Request $request){
        $business = Auth::user()->current_company;
        $customer = $business->customers()->findOrFail($request->id);
        $data = array(
            "email"=> @$customer->email,
            "cName"=> @$customer->fname.' '.@$customer->lname,
            "pName"=>$business->dba_business_name,
            "url"=> env('APP_URL').'/registration/'.Crypt::encryptString($customer->id)
        );
        $status = SGMailService::requestAccessMail($data);
        return $status;
    }

    public function grant_access($id,$business_id){
        $user_id = Crypt::decryptString($id);
        $bId = Crypt::decryptString($business_id);
        $user = User::where('id',$user_id)->first();
        $chk = Customer::where('user_id' , @$user->id)->first();

        if($chk == ''){
            profileSyncToBusiness($bId, $user);
        }else{
            $chk->update(['profile_pic'=> $user->profile_pic]);
            $familyMember = UserFamilyDetail::where(['user_id' => $user->id])->get();
            foreach($familyMember as $member){
                $chkFamily = Customer::where(['fname' =>$member->first_name ,'lname' =>$member->last_name])->first();
                if($chkFamily == ''){
                    Customer::create([
                        'business_id' => $bId,
                        'fname' => $member->first_name,
                        'lname' => ($member->last_name) ? $member->last_name : '',
                        'username' => $member->first_name.' '.$member->last_name,
                        'email' => $member->email,
                        'country' => 'US',
                        'status' => 0,
                        'phone_number' => $member->mobile,
                        'birthdate' => $member->birthday,
                        'gender' => $member->gender,
                        'user_id' => NULL, //this is null bcz of user is not created at 
                        'parent_cus_id'=> $chk->id ,
                        'relationship' =>$member->relationship
                    ]);
                }
            }

            $cardData = StripePaymentMethod::where(['user_id' => $user->id , 'user_type' => 'User' ])->get();

            foreach($cardData as $data){
                $stripData = StripePaymentMethod::where(['user_id' =>$chk->id ,'payment_id'=> $data->payment_id ,'exp_year' => $data->exp_year ,'last4' =>$data->last4])->first();
                if($stripData == ''){
                    StripePaymentMethod::create([
                        'payment_id' => $data->payment_id,
                        'user_type' => 'Customer',
                        'user_id' => $customer->id,
                        'pay_type'=> $data->pay_type,
                        'brand'=> $data->brand,
                        'exp_month'=> $data->exp_month,
                        'exp_year'=> $data->exp_year,
                        'last4'=> $data->last4,
                    ]);
                }
            }

            /*$paymentHistory = Transaction::where('user_type', 'User')
            ->where('user_id', $user->id)
            ->orWhere(function($subquery) use ($chk) {
                $subquery->where('user_type', 'Customer')
                    ->where('user_id', $chk->id);
            })->get();

            foreach($paymentHistory as $data){
                $history = Transaction::where(['user_id' =>$chk->id ,'user_type'=>'Customer'])->first();
                if($history == ''){
                    Transaction::create([
                        'item_id' => $data->item_id,
                        'user_type' => 'Customer',
                        'user_id' => $chk->id,
                        'item_type'=> $data->item_type,
                        'channel'=> $data->channel,
                        'kind'=> $data->kind,
                        'transaction_id'=> $data->transaction_id,
                        'stripe_payment_method_id'=> $data->stripe_payment_method_id,
                        'amount'=> $data->amount,
                        'qty'=> $data->qty,
                        'status'=> $data->status,
                        'refund_amount'=> $data->refund_amount,
                        'payload'=> $data->payload
                    ]);
                }
            }*/
        }


        Notification::create([
            'user_id' => Auth::user()->id,
            'customer_id' =>  NULL,
            'table_id' => Auth::user()->id,
            'table' =>  'User',
            'display_date' => date('Y-m-d'),
            'display_time' => date("H:i"),
            'type' => 'business',
            'business_id' =>  $bId,
            'status'  =>  'Alert'
        ]);
        
        return Redirect()->route('personal.orders.index');
    }

    public function remove_grant_access(Request $request, $id,$customerId,$type = null){
        $customers = Customer::where('id',$customerId)->update(['user_id'=> null]); 
        if($request->type){
            return Redirect()->route('personal.orders.index',['business_id'=>$id ,'customer_id' =>$customerId]);
        }else{
            return Redirect()->route('personal.family_members.index',['business_id'=>$id,'customerId'=>$customerId]);
        }
    }

    public function receiptmodel($orderId,$customer,$isFrom = null){
        $customerData = Customer::where('id',$customer)->first();
        $transaction = Transaction::where('item_id',$orderId)->first();
        if(!$isFrom){
            if(@$transaction->item_type == 'UserBookingStatus'){
                $oid = $orderId;
                $bookingArray = UserBookingDetail::where('booking_id',$oid)->pluck('id')->toArray();
            }else{
                $orderId = @$transaction->Recurring->booking_detail_id;
                $oid = $orderId;
                $bookingArray = UserBookingDetail::where('id',$orderId)->pluck('id')->toArray();
            }
            $transactionType = @$transaction->item_type;
        }else{
             $oid = $orderId;
            $bookingArray = UserBookingDetail::where('id',$orderId)->pluck('id')->toArray();
            $transactionType = 'Membership';
        }
        return view('customers._receipt_model',['array'=> $bookingArray ,'email' =>@$customerData->email, 'orderId' => $oid ,'type' =>$transactionType]);
    }

    public function loadView(Request $request)
    {
        $char = $request->input('char');
        $cid = Auth::user()->cid;
        $company = CompanyInformation::find($cid);
        $customers = Customer::where('business_id', $cid)->where('fname', 'LIKE', $char.'%')->orderBy('fname')->get();
        return view('customers.customer-detail-list',compact('customers' ,'char','company'));
    }

    public function getMoreRecords(Request $request)
    {
        $char = $request->char;
        $offset = $request->get('offset', 0); // Offset for pagination, passed from the frontend
        $limit = 20; // Number of records to load per request
        
        $cid = Auth::user()->cid;
        $company = CompanyInformation::find($cid);
        // Fetch the next set of records using your query logic
        $customers = Customer::where('business_id', $cid)->where('fname', 'LIKE', $char.'%')->skip($offset)->take($limit)->orderBy('fname')->get();
        return view('customers.customer-detail-list',compact('customers' ,'char','company'));
    }

    public function sendTermsMail(Request $request){
        $company = CompanyInformation::find($request->business_id);
        $terms = $company->businessterms;
        
        $termNameToMap = [
            'Covid' => 'covidtext',
            'Liability' => 'liabilitytext',
            'Contract' => 'contracttermstext',
            'Refund' => 'refundpolicytext',
            'Terms' => 'termcondfaqtext',
        ];

        $termsTextProperty = $termNameToMap[$request->termsName];
        $termsText = $terms->{$termsTextProperty};
        
        $customer = Customer::find($request->cid);
        $logo = @$company->logo != '' ? Storage::Url(@$company->logo) : '';
        $emailDetail = array(
            'companyImage' => $logo, 
            'companyName'=> $company->company_name,
            'companyAddress'=> $company->company_address(),
            'companyEmail'=> $company->business_email,
            'companyPhone'=> $company->business_phone,
            'termsName' => $request->termsName,
            'email' => $customer->email,
            'termsText' => $termsText
        );
        $status  = SGMailService::sendTermsMail($emailDetail);
    }

    public function uploadDocument(Request $request, $business_id){
        $path = $request->hasFile('file') ? $request->file('file')->store('Customer-Documents') : '';
        $create = CustomersDocuments::create([
            'user_id' => Auth::user()->id, 
            'staff_id' => session('StaffLogin') ?? '', 
            'business_id' => $business_id,
            'customer_id' => $request->id,
            'title' => $request->title,
            'path' => $path
        ]);
        if($create){
            if($request->sign == 1){
                $this->requestSign($business_id , $create->id);
            }
            return response()->json(['status'=>200,'message'=>'Document Added Successfully.']);
        }else{
            return response()->json(['status'=>500,'message'=>'Something Went Wrong.']);
        }
    }

    public function uploadDocsName(Request $request){
        //print_r($request->all());exit;
        /*$document = CustomersDocuments::find($request->docId);
        if(!empty($request->docName)){
            for($i=0; $i< count($request->docName);$i++){
                if($request->docName[$i] != ''){
                    $data = CustomerDocumentsRequested::updateOrCreate([
                            'id' => $request->contentID[$i],
                        ],
                        [
                            'user_id' => @$document->user_id,
                            'business_id' => @$document->business_id,
                            'customer_id' => @$document->customer_id,
                            'doc_id' => $request->docId,
                            'content' => $request->docName[$i],
                        ]
                    ); 

                    if($request->contentID[$i]){
                        Notification::updateOrCreate([
                            'display_date' => date('Y-m-d'),
                            'table_id' => $data->id,
                            'table' => 'CustomerDocumentsRequested',
                            'business_id' => $document->business_id,
                        ],[
                            'user_id' => $document->user_id , 'customer_id' => $document->customer_id , 'display_date' => date('Y-m-d') , 'table_id' => $data->id , 'table' => 'CustomerDocumentsRequested',  'display_time' =>date('H:i'), 'business_id' => $document->business_id,'type' => 'personal','status'=>'Alert'
                        ]); 
                    }
                }
            }
        }
        if(!empty($request->deletIds)){
            CustomerDocumentsRequested::whereIn('id', $request->deletIds)->delete();
        } */  

        $customer = Customer::find($request->customerId);
        $document = CustomersDocuments::create([
            'user_id' => Auth::user()->id, 
            'staff_id' => session('StaffLogin') ?? '', 
            'business_id' => $customer->business_id,
            'customer_id' => $request->customerId,
            'title' => $request->title,
            'doc_requested_date' => date('Y-m-d'),
        ]);

        if(!empty($request->docName)){
            for($i=0; $i< count($request->docName);$i++){
                if($request->docName[$i] != ''){
                    $data = CustomerDocumentsRequested::Create([
                            'user_id' => @$document->user_id,
                            'business_id' => @$document->business_id,
                            'customer_id' => @$document->customer_id,
                            'doc_id' => $document->id,
                            'content' => $request->docName[$i],
                        ]
                    ); 

                    Notification::Create([
                        'user_id' => $document->user_id , 'customer_id' => $document->customer_id , 'display_date' => date('Y-m-d') , 'table_id' => $data->id , 'table' => 'CustomerDocumentsRequested',  'display_time' =>date('H:i'), 'business_id' => $document->business_id,'type' => 'personal','status'=>'Alert'
                    ]); 
                    
                }
            }
        }

        $request->session()->flash('success', 'Documents Content Added successfully.');
        return redirect()->route('business_customer_show',['business_id'=>@$document->business_id ,'id'=> @$document->customer_id]);
    }

    public function docContent($customerId){
        //$content = CustomerDocumentsRequested::where('doc_id',$id)->get();
        return view('customers.documents_contents',compact('customerId'))->render();
    }

    public function requestSign($business_id,$id){
        $document = CustomersDocuments::find($id);
        $document->update(['status' =>1 ,'sign_requested_date' => date('Y-m-d')]);

        Notification::create([
            'user_id' => Auth::user()->id,
            'customer_id' =>  $document->customer_id,
            'table_id' => $document->id,
            'table' =>  'CustomersDocuments',
            'display_date' => date('Y-m-d'),
            'display_time' => date("H:i"),
            'type' => 'personal',
            'business_id' => $document->business_id,
            'status'  =>  'Alert'
        ]);
    }

    public function download($id)
    {
        $document = CustomersDocuments::findOrFail($id);
        $filePath = Storage::url($document->path);
        $name = str_replace("Customer-Documents/", "", $document->path);
        $imageContent = file_get_contents($filePath);
        $headers = [
            'Content-Type'        => 'image/jpeg', // Change the content type based on your image type
            'Content-Disposition' => 'attachment; filename='.$name,
        ];
        return Response::make($imageContent, 200, $headers);
    }
   
    public function removeDoc($id){
        $docs = CustomersDocuments::find($id);
        Storage::disk('s3')->delete($docs->path);
        $docs->delete();
    }

    public function removenote($business_id, $id){
        $note = CustomerNotes::find($id);
        @$note->delete();
    }

    public function addNotes(Request $request, $business_id){
        $note = CustomerNotes::updateOrCreate(
            ['id' =>  $request->id],
            [
                'user_id' => Auth::user()->id, 
                'business_id' => $business_id,
                'customer_id' => $request->cid,
                'title' => $request->title,
                'note' => $request->notes,
                'due_date' => $request->due_date,
                'time' => $request->time,
                'display_chk' => $request->displayChk ?? 0,
                'status' => 1,
            ]
        );

        $data = ['user_id' => $note->user_id , 'customer_id' => $note->customer_id , 'display_date' => $note->due_date , 'table_id' => $note->id , 'table' => 'CustomerNotes',  'display_time' => $note->time, 'business_id' => $note->business_id,'type' => 'business','status'=>'Alert'];

        if($note->display_chk == 1){
            $data['type'] = 'personal';
            Notification::updateOrCreate([
                'display_date' => $note->due_date,
                'table_id' => $note->id,
                'table' => 'CustomerNotes',
                'type' => 'personal',
                'business_id' => $note->business_id,
            ],$data);
        }

        $data['type'] = 'business';
        Notification::updateOrCreate([
                'display_date' => $note->due_date,
                'table_id' => $note->id,
                'table' => 'CustomerNotes',
                'type' => 'business',
                'business_id' => $note->business_id,
            ],$data);
        
        if($note){
            $word = $request->id ? 'updated' : 'Added';
            return response()->json(['status'=>200,'message'=>'Note '.$word.' Successfully.']);
        }else{
            return response()->json(['status'=>500,'message'=>'Something Went Wrong.']);
        }
    }

    public function updateNote(Request $request, $business_id){
        $business = Auth::user()->current_company;
        $ids = explode(',', $request->input('id'));
        $business->CustomerNotes()->whereIn('id', $ids)->update(['status' => 1]);
    }

    public function getNote($business_id,$cusId, $id = null){
        $note = CustomerNotes::find($id);
        return view('customers._note' ,compact('note','cusId'));
    }
}