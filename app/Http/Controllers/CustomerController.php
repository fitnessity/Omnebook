<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use Aws\S3\S3Client;
use App\Jobs\{ProcessAttendanceExcelData,ProcessCustomerExcelData,ProcessMembershipExcelData,ProcessAttendance,ProcessMembership,Membership,MembershipRun};
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
use App\BusinessCustomerUploadFiles;
use Request as resAll;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use App\BusinessStaff;
use App\ChunkProcessTracker;
class CustomerController extends Controller {
    protected $customers;
    protected $company;
    protected $resultDate;
    public $error = '';
    public function __construct(CustomerRepository $customers,BookingRepository $bookings,UserRepository $users) {
        $this->middleware('auth'); $this->customers = $customers; $this->bookings = $bookings; $currentDate = Carbon::now();
        $this->resultDate = $currentDate->subYears(18);
    }
    public function client(){ return view('customers.add_client'); }
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
                    $serch3 = @$searchValues[2] !='' ? @$searchValues[2] : '';
                    $q->orderBy('fname');
                    if (count($searchValues) === 3) {
                        $q->where(function($q) use ($searchValues) {
                            $q->where('fname', 'like', "%{$searchValues[0]} {$searchValues[1]}%")
                              ->where('lname', 'like', "%{$searchValues[2]}%");
                        })
                        ->orWhere(function($q) use ($searchValues) {
                            $q->where('fname', 'like', "%{$searchValues[0]}%")
                              ->where('lname', 'like', "%{$searchValues[1]} {$searchValues[2]}%");
                        });
                    }        
                    elseif($serch1 != '' && $serch2 != ''){
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
        $customers_n = $customers->get();
                
        $customers = collect(); 
        foreach ($customers_n as $customer)
        {
            if ($customer->parent_cus_id!=null) {
                $parentCustomer = Customer::find($customer->parent_cus_id);
                if ($parentCustomer) {
                    $customers->push($customer);
                }
            }
            else{
                $customers->push($customer);
            }
        }        

        $customerCount = count($customers); 
        set_time_limit(8000000); ini_set('memory_limit', '-1'); ini_set('max_execution_time', 10000);
        $customerStatusCounts = $customers->mapToGroups(function ($customer) {
            return [$customer->is_active() => $customer];
        });
      
        
        
        $validLetters = [];
        $customersCollection = '';
        if(!$request->customer_type){
            $currentCount =  $customerCount;
            for ($asciiValue = ord('A'); $asciiValue <= ord('Z'); $asciiValue++) {
                $validLetters[] = chr($asciiValue);
            }
        }else{
            if($request->customer_type == 'active'){
                $forActive =  $customerStatusCounts->get('Active', collect());
                $activeMembersCount = $forActive->count();
                $customersCollection = $forActive;
                $currentCount = $activeMembersCount ;
            }else if($request->customer_type == 'in-active'){
                $forInActive =  $customerStatusCounts->get('InActive', collect());
                $inActiveMembersCount = $forInActive->count();
                $customersCollection = $forInActive;
                $currentCount = $inActiveMembersCount ;
            }else if($request->customer_type == 'prospect'){
                $forPros =  $customerStatusCounts->get('Prospect', collect());
                $prospectMembersCount = $forPros->count();
                $customersCollection = $forPros;
                $currentCount = $prospectMembersCount;
            }else if($request->customer_type == 'suspended'){
                $suspend = $customers->filter->suspendedOrNot();
                $suspendCount = $suspend->count();
                $customersCollection = $suspend;
                $currentCount = $suspendCount;
            }else if($request->customer_type == 'owed'){
                $owd = $customers->filter->owedOrnot();
                $owdCount = $owd->count();
                $customersCollection = $owd;
                $currentCount = $owdCount;
            }else if($request->customer_type == 'at-risk'){
                $atRiskMembers = $customers->filter->customerAtRisk();
                $atRiskMembersCount = $atRiskMembers->count();
                $customersCollection = $atRiskMembers;
                $currentCount = $atRiskMembersCount;
            }else if($request->customer_type == 'big-spenders'){
                $bigSpender = $customers->filter->bigSpender(); 
                 $bigSpenderCount = $bigSpender->count();
                $customersCollection = $bigSpender->sortByDesc(function ($customer) {
                    return $customer->total_spend;
                })->take(20);
                $currentCount = $bigSpenderCount;
            }
            for ($asciiValue = ord('A'); $asciiValue <= ord('Z'); $asciiValue++) {
                $letter = chr($asciiValue);
                if ($customersCollection->contains(function ($customer) use ($letter) {
                    return stripos($customer->fname, $letter) === 0;
                })) {
                    $validLetters[] = $letter;
                }
            }
        }
        if ($request->ajax()) {
            return response()->json([
                'customers' => $customers,
                'customerCount' => $customerCount,
            ]);
        }
        return view('customers.index', compact(['company','customerCount','currentCount','validLetters','customersCollection']));
    }



    public function getCustomerCounts($business_id,Request $request)
    {
        $user = Auth::user(); $company = $user->businesses()->findOrFail($business_id); $customers = $company->customers()->get();
        $customerStatusCounts = $customers->mapToGroups(function ($customer) {
            return [$customer->is_active() => $customer];
        });
        $customerCount = $customers->count();
        $activeCount =$customerStatusCounts->get('Active', collect())->count();
        $inactiveCount = $customerStatusCounts->get('InActive', collect())->count();
        $prospectCount =$customerStatusCounts->get('Prospect', collect())->count();
        $suspendedCount =$customers->filter->suspendedOrNot()->count();
        $owedCount = $customers->filter->owedOrnot()->count();
        $atRiskCount = $customers->filter->customerAtRisk()->count();
        $spenderCount = $customers->filter->bigSpender()->count();
        $counts = [
            'totalMembers' => 'Total Members (' . $customerCount . ')',
            'activeMembers' => 'Active Members (' . $activeCount . ')',
            'inactiveMembers' => 'Inactive Members (' . $inactiveCount . ')',
            'prospectMembers' => 'Prospects (' . $prospectCount . ')',
            'suspendedMembers' => 'Suspended (' . $suspendedCount . ')',
            'owedMembers' => 'Owed (' . $owedCount . ')',
            'atRiskMembers' => 'At-Risk (' . $atRiskCount . ')',
            'spenderMembers' => 'Big Spenders (' . $spenderCount . ')'
        ];
        return response()->json($counts);
    }
    public function loadView(Request $request)
    {
        $char = $request->input('char');
        $cid = Auth::user()->cid;
        $company = CompanyInformation::find($cid);
        $customers = Customer::where('business_id', $cid)->where('fname', 'LIKE', $char.'%')->orderBy('fname')->get();
        $customerStatusCounts = $customers->mapToGroups(function ($customer) {
            return [$customer->is_active() => $customer];
        });

        if($request->customer_type == 'active'){
            $customers =  $customerStatusCounts->get('Active', collect());
        }else if($request->customer_type == 'in-active'){
            $customers =  $customerStatusCounts->get('InActive', collect());
        }else if($request->customer_type == 'prospect'){
            $customers =  $customerStatusCounts->get('Prospect', collect());
        } else if($request->customer_type == 'suspended'){
            $customersAry = $customers->filter->suspendedOrNot();
            $customers = [];
            foreach ($customersAry as $key => $value) {
                if(!empty($value->suspended())){
                    foreach ($value->suspended() as $key => $ubd) {
                        $customers[] = $ubd;
                    }
                }
            }
        }else if($request->customer_type == 'owed'){
            $customersAry = $customers->filter->owedOrnot();
            $customers = [];
            foreach ($customersAry as $key => $value) {
                if(!empty($value->owedDetail()->get())){
                    foreach ($value->owedDetail()->get()     as $key => $owed) {
                        $customers[] = $owed;
                    }
                }
            }
        }else if($request->customer_type == 'at-risk'){
            $customers = $customers->filter->customerAtRisk();
        }else if($request->customer_type == 'big-spenders'){
            $customers = $customers->filter->bigSpender();
        }
        return view('customers.customer-detail-list',compact('customers' ,'char','company'));
    }
        public function create(Request $request, $business_id){
            $intent = $clientSecret = null;
            $success = 0; $successMsg = '';
            if(!$request->customer_id){
                if (session()->has('success-register')) { $success = session('success-register'); }
                if (session()->has('auto_generate_msg')) { $successMsg = session('auto_generate_msg'); }
                session()->forget('success-register'); session()->forget('auto_generate_msg');
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
            return view('customers.create',compact('clientSecret', 'business_id','success', 'businessTerms','successMsg'));
        }
        public function createdata(Request $request){
            $business_id=$request->businessId; $intent = $clientSecret = null; $success = 0; $successMsg = '';
            if(!$request->customer_id){
                if (session()->has('success-register')) { $success = session('success-register'); }
                if (session()->has('auto_generate_msg')) { $successMsg = session('auto_generate_msg'); }
                session()->forget('success-register'); session()->forget('auto_generate_msg');
            }
            $businessTerms = BusinessTerms::where('cid',$business_id)->first();
            if($request->customer_id){
                $customer = Customer::find($request->customer_id);
                \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
                if($customer->stripe_customer_id != ''){
                    $intent = $stripe->setupIntents->create([
                        'payment_method_types' => ['card'], 'customer' => $customer->stripe_customer_id,
                    ]);
                    $clientSecret = $intent['client_secret'];
                } 
            }
            return response()->json([
                'clientSecret' => $clientSecret, 'customer_id'=>$customer->id, 'business_id' => $business_id, 'success' => $success, 'businessTerms' => $businessTerms,
                'successMsg' => $successMsg
            ]);
        }
        public function create_model(Request $request, $business_id){
            $intent = $clientSecret = null; $success = 0; $successMsg = '';
            if(!$request->customer_id){
                if (session()->has('success-register')) {  $success = session('success-register'); }
                if (session()->has('auto_generate_msg')) { $successMsg = session('auto_generate_msg'); }
                session()->forget('success-register');
                session()->forget('auto_generate_msg');
            }
            $businessTerms = BusinessTerms::where('cid',$business_id)->first();
            if($request->customer_id){
                $customer = Customer::find($request->customer_id);
                \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
                if($customer->stripe_customer_id != ''){
                    $intent = $stripe->setupIntents->create([
                        'payment_method_types' => ['card'],'customer' => $customer->stripe_customer_id,
                    ]);
                    $clientSecret = $intent['client_secret'];
                } 
                $data = [
                    'customer_id'=>$customer->id, 'clientSecret' => $clientSecret, 'business_id' => $business_id, 'success' => $success,
                    'businessTerms' => $businessTerms,'successMsg' => $successMsg,
                ];
                return response()->json($data);
            }
            $data = [
                'clientSecret' => $clientSecret,'business_id' => $business_id,'success' => $success, 'businessTerms' => $businessTerms,'successMsg' => $successMsg
            ];
            $html = view('customers.create_model', $data)->render();
            $html = preg_replace('/[\r\n\t]+/', ' ', $html);
            return response()->json(['html' => $html]);
        }
    public function delete(Request $request, $business_id){
        $customerdata = $this->customers->findById($request->id);
        if( $customerdata != ''){  Customer::where('id',$request->id)->delete(); }
    }
    public function show(Request $request, $business_id, $id){
        ini_set('memory_limit', '2056M');
		ini_set('max_execution_time', 4800);
		ini_set('memory_limit', '-1');
        // dd($id);
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $terms = $company->business_terms->first();
        $customerdata = $company->customers->find($id);
        
        if(!$customerdata){ return redirect()->route('business_customer_index'); }
        $visits = $customerdata != '' ? $customerdata->visits()->get() : [];
        $active_memberships = $customerdata != '' ? $customerdata->active_memberships()->orderBy('created_at','desc')->get() : [];
        $suspended_memberships = $customerdata != '' ? $customerdata->suspended_memberships()->orderBy('created_at','desc')->get() : [];
        $purchase_history = @$customerdata != '' ?  @$customerdata->purchase_history()->orderBy('created_at','desc')->get() : [];
        
        $booking_detail = UserBookingDetail::where('business_id', $business_id)
        ->where('user_id', '!=', $customerdata->id)
        ->whereNotNull('user_id')  
        ->whereNull('deleted_at')  
        ->get();
        $id = $customerdata->id;           
        $familyPurchaseHistory = [];         
        foreach ($booking_detail as $booking) {  
            $familyMember = Customer::where('business_id', $company->id)
                ->where('id', $booking->user_id)
                ->first();             
            if ($familyMember)
            {                     
                $familyPurchases = $familyMember->family_purchase_history($id, $booking->booking_id)->get()->toArray();    
                if (!empty($familyPurchases)) {
                    $familyPurchaseHistory[$familyMember->fname . ' ' . $familyMember->lname] []= $familyPurchases; 
                }  
           }       
        }
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
            $cardSuccessMsg = 1; Session::forget('cardSuccessMsg');
        }
        return view('customers.show', [
            'customerdata'=>$customerdata,
            'strpecarderror'=>$strpecarderror,
            'terms'=> $terms,
            'visits' => $visits,
            'purchase_history' => $purchase_history,
            'active_memberships' => $active_memberships,
            'suspended_memberships'=>$suspended_memberships,
            'complete_booking_details' => $complete_booking_details,
            'auto_pay_payment_msg' =>$auto_pay_payment_msg,
            'documents' =>$documents,
            'notes' =>$notes,
            'lastBooking' =>$lastBooking,
            'cardSuccessMsg' =>$cardSuccessMsg,
            'resultDate' =>$this->resultDate,
            'id'=>$id,
            'company'=>$company,
            'familyPurchaseHistory'=>$familyPurchaseHistory
        ]);
    }
    public function searchcustomersaction(Request $request) {
        if($request->get('query'))
        {
            $array_data=array(); $query = $request->get('query');
            $data_cus = User::where('firstname', 'LIKE', "%{$query}%")->orWhere('lastname', 'LIKE', "%{$query}%")->orWhere('username', 'LIKE', "%{$query}%")->get();
            foreach($data_cus as $cuss)
            {   
                $array_data [] = array(
                    "name"=>$cuss->fname .' '.$cuss->lname, "cus_id"=>$cuss->id, "image" => $cuss->profile_pic, "email" => $cuss->email,
                    "phone_number" => $cuss->phone_number, "age" => $cuss->getcustage(),
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
                            if($row['image'] != ''){ $output .='<img src="'.asset('/customers/images/'.$row['image']).'">';
                            }else{
                                $output .='<div class="company-profile-img-controller">';$pf=substr($row['name'], 0, 1);
                                $output .='<p class="img-controller">'.$pf.'</p></div>';
                            }
                            $age = '';
                            if($row['age'] != '—'){ $age = '('.$row['age'].'  Years Old)'; }
                            $output .='</div>
                            <div class="col-md-10 div-controller">
                                <p class="pstyle">'.$row['name'].' <label class="liaddress">'.$age.'<label></p>
                                <p class="pstyle liaddress">'.$row['email'].'</p><p class="pstyle liaddress">'.$row['phone_number'].'</p>
                            </div>
                            <input type="hidden" name="cid" id="cid" value="'.$row['cus_id'].'">
                        </div></li>';
                }
            }
            else
            {
                $output .= '<li class="liimage"> '; $output .= "Looks like there's no client with that name listed.</li>";
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
            // $password = '';
            $userid=$customer->user_id;
            $users=User::where('id',$userid)->first();
            $password=$users->buddy_key;
        }else{
            $password = Str::random(8);
            $customer->update(['password' => Hash::make($password)]);
        }
        $status =  SGMailService::sendMailToCustomer($request->cid,$request->bid,$password);
       return  $status;
    }
    public function importmembership(Request $request)
    {
        $business_id = $request->input('business_id');
        $user = Auth::user();
        $current_company = $user->businesses()->findOrFail($business_id);
        $file = $request->file('import_file');
        if($file)
        {
            $ext = $file->getClientOriginalExtension();
            if($ext != 'csv')
            {
                return response()->json(['status'=>500,'message'=>'File format is not supported.']);
            }
            try {
                    $originalName = $file->getClientOriginalName();
                    $fileName = time() . '_' . str_replace(' ', '_', $originalName);
                    $file->move(public_path('uploads/customers'), $fileName);
                    $data = BusinessCustomerUploadFiles::create([
                        'user_id' => $user->id, 'business_id' => $business_id,
                        'file' => 'uploads/customers/' . $fileName,
                        'file_type'=>'Members file', 'status' => 1,
                    ]);
                    return response()->json(['status' => 200,'data' => $data]);
                } 
            catch (\Exception $e) 
            {
                return response()->json(['status' => 500, 'message' => 'An error occurred while uploading the file.','error' => $e->getMessage()]);
            }
        }
        return response()->json(['status' => 500, 'message' => 'No file uploaded.']);
    }
        public function uploadFileMember(Request $request, $business_id, $id)
        {
                ini_set('memory_limit', '-1'); 
                ini_set('max_execution_time', -1);
                $user = Auth::user();
                $current_company = $user->current_company;
                if ($current_company->id == $request->business_id && $current_company->membership_uploading == 0) {
                    $data = BusinessCustomerUploadFiles::find($id);
                    $newFileName = $data->file;
                    $filePath = public_path($newFileName);
                    Log::info('File path: ' . $filePath);
                    try { $rows = Excel::toCollection(null, $filePath)[0]; }
                    catch (\Exception $e) {
                        Log::error('Error reading Excel file: ' . $e->getMessage());
                        return response()->json(['status' => 500, 'message' => 'Error reading Excel file']);
                    }
                    Log::info('Total rows read: ' . count($rows));
                    $headerFound = false;
                    $filteredRows = collect();
                    foreach ($rows as $index => $row) {
                        if ($row === null || empty(array_filter($row->toArray()))) {
                            continue;
                        }
                        if ($this->isHeaderRow($row)) {
                            $headerFound = true;
                            continue; 
                        }
                        if ($headerFound) {
                            $filteredRows->push($row); 
                        } 
                    }
                    if ($filteredRows->isEmpty()) {
                        Log::info('No filtered rows found.'); 
                        Log::info($filteredRows);
                    }
                    // dd($request->business_id);
                    $bid=$request->business_id;
                    $upid=$data->id;
                    $totalChunks = $filteredRows->chunk(1000)->count();
                    $tracker = new ChunkProcessTracker();
                    $tracker->business_id = $request->business_id;
                    $tracker->total_chunks = $totalChunks;
                    $tracker->processed_chunks = 0;
                    $tracker->email_sent = false;
                    $tracker->save();
                    $chunks = $filteredRows->chunk(1000);                                    
                        foreach ($chunks as $chunk) {
                            $job = new Membership($request->business_id, $chunk->toArray(),$user->email,$upid,$tracker->id,$user->id);
                            dispatch($job)->onQueue('membership');
                        }
                        return response()->json(['status' => 200, 'message' => 'We are processing your file. Once completed, We will send you an email and notification.', 'data' => $data]);
                    } else {
                        return response()->json(['status' => 500, 'message' => 'You don\'t have permission to upload files at this moment']);
                    }
        }
        private function isHeaderRow($row)
        {
            Log::info('Original row: ' . json_encode($row));
            $expectedHeaders = ['name', 'membership_type', 'status', 'member_from', 'member_to'];
            $rowValues = collect($row)->map(function ($value) {
                return strtolower(str_replace(["\u{00a0}", ' '], '_', $value));
            })->slice(0, count($expectedHeaders))->values()->toArray();
            Log::info('Processed row values for header check: ' . json_encode($rowValues));
            Log::info('Expected headers: ' . json_encode($expectedHeaders));
            return $rowValues === $expectedHeaders;
        }
    public function importattendance(Request $request){
        ini_set('memory_limit', '-1'); 
        ini_set('max_execution_time', -1);
        $business_id = $request->input('business_id');
        $user = Auth::user();
        $current_company = $user->businesses()->findOrFail($business_id);
        $file = $request->file('import_file');
        if($file)
        {
            $ext = $file->getClientOriginalExtension();
            if($ext != 'csv')
            {
                return response()->json(['status'=>500,'message'=>'File format is not supported.']);
            }
            try {
                    $originalName = $file->getClientOriginalName();
                    $fileName = time() . '_' . str_replace(' ', '_', $originalName);
                    $file->move(public_path('uploads/customers'), $fileName);
                    $data = BusinessCustomerUploadFiles::create([
                        'user_id' => $user->id,'business_id' => $business_id,'file' => 'uploads/customers/' . $fileName,
                        'file_type'=>'Attendance file','status' => 1,
                    ]);
                    return response()->json(['status' => 200, 'message' => 'We are processing your file. Once completed, We will send you an email and notification.', 'data' => $data]);
                } 
                catch (\Exception $e) 
                {
                    return response()->json(['status' => 500, 'message' => 'An error occurred while uploading the file.','error' => $e->getMessage()]);
                }
        }
        return response()->json(['status' => 500, 'message' => 'No file uploaded.']);
    }
    public function uploadFileAttendance(Request $request, $business_id, $id)
    {
        ini_set('memory_limit', '-1'); ini_set('max_execution_time', -1);
        $user = Auth::user();
        $current_company = $user->businesses()->findOrFail($business_id);
        $data = BusinessCustomerUploadFiles::find($id);
        $newFileName = $data->file;
        $filePath = public_path($newFileName);
        $headings = (new HeadingRowImport)->toArray($filePath);
        if(!empty($headings)){
            foreach($headings as $key => $row) {
                $firstrow = $row[0];
                if( $firstrow[0] != 'date' ||$firstrow[1] != 'day' || $firstrow[2] != 'time' ||$firstrow[4] != 'client'  || $firstrow[8] != 'pricing_option' || $firstrow[9] != 'exp_date'|| $firstrow[10] != 'visits_rem' ) 
                {
                    return response()->json(['status'=>500,'message'=>'Problem in header.']);
                }
            }
        }
        $excel = Excel::toArray([], $filePath);
        $excel = isset($excel[0]) ? $excel[0] : array();
        $chunkSize = 1000; // Define the chunk size
        $chunks = array_chunk($excel, $chunkSize);
        foreach ($chunks as $chunk) {
            $job = new ProcessAttendance($request->business_id, $chunk,$user->email);
            dispatch($job)->onQueue('attendance');
        }
        $current_company->update(['membership_uploading' => 0]);
        $data->isseen = '0'; $data->status = '0'; $data->save();
        return response()->json(['status' => 200, 'message' => 'File imported Successfully']);
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
            'UserFamilyDetails' => $UserFamilyDetails,'companyId' => $companyId,'parent_cus_id' => $id,'resultDate' => $this->resultDate,
        ]);
    }
    public function addFamilyMemberCustomer(Request $request) {
        $idArray = $userIdArray = []; $userId = ''; $parent_id = null;
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
                'request_status' => 1,
            ])->save();
            if (@$request['primaryAccountHolder'][$i] == 1 && $parent_id === null) {
                $parent_id = $customer->id;
            }else{
                $idArray[$i][] = $customer->id;   
            }
            $customer->create_stripe_customer_id();
            $is_user = User::where('email', $request['email'][$i])->whereRaw('LOWER(firstname) = ? AND LOWER(lastname) = ?', [strtolower($request['fname'][$i]), strtolower($request['lname'][$i])])->first();
            if(!$is_user){
                $familyUser = New User();
                $familyUser->role = 'customer';
                $familyUser->firstname =  $request['fname'][$i];
                $familyUser->lastname =  $request['lname'][$i];
                $familyUser->username = $request['fname'][$i].$request['lname'][$i];
                $familyUser->email = $request['email'][$i];
                $familyUser->gender = $request['gender'][$i];
                $familyUser->primary_account = 0;
                $familyUser->country = 'United Status';
                $familyUser->phone_number = $request['mobile'][$i];
                $familyUser->birthdate =  $request['birthdate'][$i] != '' ? date('Y-m-d', strtotime($request['birthdate'][$i])) : null;
                $familyUser->stripe_customer_id =  $customer->stripe_customer_id;
                $familyUser->save(); 
                $customer->user_id =  $familyUser->id;
            }else{
                $customer->user_id =  @$is_user->id;
            }
            $userIdArray[] = $customer->user_id;   
            $customer->save();
        }
        if($parent_id){
            $cus = Customer::where('id', $request['parent_cus_id'])->first();
            $cusParent = Customer::where('id',  $parent_id)->first();
            Customer::whereIn('id', $idArray)->update(['parent_cus_id' => $parent_id]);
            $cus->update(['parent_cus_id' => $parent_id,'primary_account' => 0]);
            $cusParent->update(['parent_cus_id' => null,'primary_account' => 1]);
            User::whereIn('id', $userIdArray)->update(['primary_account' => 0]);
            User::where('id', $cusParent->user_id)->update(['primary_account' => 1]);
        }
        return redirect()->route('customer.add_family',['id' => $request['parent_cus_id']]);
    }
    public function removefamilyCustomer(Request $request) {
        $customer = Customer::find($request->id);
        $customer->update(['parent_cus_id' => NULL]);
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
                    "card_stripe_id"=>$carddetails['card']->id, "card_token_id"=> $carddetails->id,
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
            unset($data['_token']); unset($data['cus_id']);
            $cust = Customer::find($request->cus_id);
            if($request->primary_account == 1){
                $data['parent_cus_id'] = NULL; $data['primary_account']  = 1;
            }else{
                $data['primary_account'] = 0;
            }
            if($data['primary_account'] == 1 && $cust->primary_account == 0){
                if($cust->parent_cus_id){
                    Customer::where(['parent_cus_id' => $cust->parent_cus_id])->update(['parent_cus_id' => $cust->id]);
                }
                $oldParent = Customer::where(['id' => $cust->parent_cus_id])->first();
                if($oldParent){
                    $oldParent->update(['parent_cus_id' => $cust->id ,'primary_account' => 0]);
                    User::where(['email' => @$oldParent->email, 'id' => @$oldParent->user_id])->update(['primary_account' => 0]);
                }
            }
            User::where(['email' => $cust['email'] , 'id' => $cust['user_id']])->update(['primary_account' => $data['primary_account'] ,'birthdate'=>$data['birthdate'],'profile_pic'=> $data['profile_pic'] ?? $cust->profile_pic ]);
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
        $chk = Customer::where(['business_id' =>$bId  ,'email' => @$user->email,'fname' => @$user->first_name,'lname' => @$user->last_name])->first();
        if($chk == ''){
            profileSyncToBusiness($bId, $user);
        }else{
            $chk->update(['profile_pic'=> $user->profile_pic ,'request_status' =>1]);
            $familyMember = UserFamilyDetail::where(['user_id' => $user->id])->get();
            foreach($familyMember as $member){
                $chkFamily = Customer::whereRaw('LOWER(fname) = ? AND LOWER(lname) = ?', [strtolower($member->first_name), strtolower($member->last_name)])->where(['email' => $member->email ,'business_id' =>$bId ])->first();
                if(!$chkFamily){
                    Customer::create([
                        'business_id' => $bId,
                        'fname' => $member->first_name,
                        'lname' => ($member->last_name) ? $member->last_name : '',
                        'username' => $member->first_name.' '.$member->last_name,
                        'email' => $member->email, 'country' => 'US', 'status' => 0,
                        'phone_number' => $member->mobile,
                        'birthdate' => $member->birthday,
                        'gender' => $member->gender,
                        'user_id' => NULL, 
                        'parent_cus_id'=> $chk->id ,
                        'relationship' =>$member->relationship, 'request_status' =>1,
                    ]);
                }
            }
        }
        Notification::create([
            'user_id' => Auth::user()->id, 'customer_id' =>  NULL, 'table_id' => Auth::user()->id, 'table' =>  'User',
            'display_date' => date('Y-m-d'), 'display_time' => date("H:i"), 'type' => 'business', 'business_id' =>  $bId, 'status'  =>  'Alert'
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
                $oid = $orderId; $bookingArray = UserBookingDetail::where('booking_id',$oid)->pluck('id')->toArray();
            }else{
                $orderId = @$transaction->Recurring->booking_detail_id; $oid = $orderId;
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
    public function getMoreRecords(Request $request)
    {
        $char = $request->char;
        $offset = $request->get('offset', 0);
        $limit = 20; 
        $cid = Auth::user()->cid;
        $company = CompanyInformation::find($cid);
        $customers = Customer::where('business_id', $cid)->where('fname', 'LIKE', $char.'%')->skip($offset)->take($limit)->orderBy('fname')->get();
        return view('customers.customer-detail-list',compact('customers' ,'char','company'));
    }
    public function sendTermsMail(Request $request){
        $company = CompanyInformation::find($request->business_id); $terms = $company->businessterms;
        $termNameToMap = [
            'Covid' => 'covidtext','Liability' => 'liabilitytext','Contract' => 'contracttermstext','Refund' => 'refundpolicytext','Terms' => 'termcondfaqtext',
        ];
        $termsTextProperty = $termNameToMap[$request->termsName];
        $termsText = $terms->{$termsTextProperty};
        $customer = Customer::find($request->cid);
        $logo = @$company->logo != '' ? Storage::Url(@$company->logo) : '';
        $emailDetail = array(
            'companyImage' => $logo, 'companyName'=> $company->company_name,
            'companyAddress'=> $company->company_address(), 'companyEmail'=> $company->business_email,
            'companyPhone'=> $company->business_phone, 'termsName' => $request->termsName, 'email' => $customer->email, 'termsText' => $termsText
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
        $customer = Customer::find($request->customerId);
        $document = CustomersDocuments::create([
            'user_id' => Auth::user()->id, 
            'staff_id' => session('StaffLogin') ?? '', 
            'business_id' => $customer->business_id,'customer_id' => $request->customerId,
            'title' => $request->title,'doc_requested_date' => date('Y-m-d'),
        ]);
        if(!empty($request->docName)){
            for($i=0; $i< count($request->docName);$i++){
                if($request->docName[$i] != ''){
                    $data = CustomerDocumentsRequested::Create([
                            'user_id' => @$document->user_id,'business_id' => @$document->business_id,
                            'customer_id' => @$document->customer_id,'doc_id' => $document->id,'content' => $request->docName[$i],
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
            'Content-Type' => 'image/jpeg',
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
        $notification = Notification::where('table_id',$id)->first();
        @$note->delete();
        $notification->delete();
    }
    public function addNotes(Request $request, $business_id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'notes' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()]);
        }
        $cid=Customer::where('user_id',Auth::user()->id)->where('business_id',$business_id)->first();
        $timeString = isset($request->time) ? implode(',', $request->time) : null;

        $note = CustomerNotes::updateOrCreate(
            ['id' =>  $request->notes_id],
            [
                'user_id' => Auth::user()->id, 
                'business_id' => $business_id,
                'type'=>'add_notes',
                'customer_id' => $cid->id,
                'title' => $request->title,
                'note' => $request->notes,
                'due_date' => $request->due_date,
                'time'=>$timeString,
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
            $word = $request->notes_id ? 'updated' : 'Added';
            return response()->json(['status'=>200,'message'=>'Note '.$word.' Successfully.']);

        }else{

            return response()->json(['status'=>500,'message'=>'Something Went Wrong.']);
        }
    }


    public function addRemainderNotes(Request $request, $business_id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'notes' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => 422, 'errors' => $validator->errors()]);
        }
        $cid=Customer::where('user_id',Auth::user()->id)->where('business_id',$business_id)->first();
        $timeString = isset($request->time) ? implode(',', $request->time) : null;

        $note = CustomerNotes::updateOrCreate(
            ['id' =>  $request->notes_id],
            [
                'user_id' => Auth::user()->id, 
                'business_id' => $business_id,
                'type'=>'add_remainder',
                'customer_id' => $cid->id,
                'title' => $request->title,
                'note' => $request->notes,
                'due_date' => $request->due_date,
                'time'=>$timeString,
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
            $word = $request->notes_id ? 'updated' : 'Added';
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
    public function changeCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), 
            ]);
        }
        $customer = Customer::find($request->customerId);
        $customerUser = $customer->user;
        $user = User::where('unique_code' , $request->code)->whereNotIn('id' ,[$customerUser->id])->first();
        $chkBusinessStaff = BusinessStaff::where('unique_code', $checkInCode)->first();//my code
        if($user || $chkBusinessStaff){
            return response()->json([
                'success' => false,
                'message' => 'Code already taken by another user.', 
            ]);
        }else{
            $customerUser->update(['unique_code'=> $request->code]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Checkin code changed successfully.',
        ]);
    }
    public function getCheckinCode(Request $request){
        if($request->checkin_code){
            $user = User::where('unique_code' , $request->checkin_code)->where('email' , '!=' , $request->email)->first();
            if($user){ return 1; }
            return 0;
        }else{
            $user = User::where(['email' => $request->email])->whereRaw('LOWER(firstname) = ?', [strtolower($request->fname)])
                ->whereRaw('LOWER(lastname) = ?', [strtolower($request->lname)])->first();
            if($user){ return $user->unique_code;}
            else{ return generateUniqueCode(); }
        }
    }

    public function shows(Request $request, $business_id, $id){
        ini_set('memory_limit', '2056M');
		ini_set('max_execution_time', 4800);
		ini_set('memory_limit', '-1');
    
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $terms = $company->business_terms->first();
        $customerdata = $company->customers->find($id);
        
        if(!$customerdata){ return redirect()->route('business_customer_index'); }
        $visits = $customerdata != '' ? $customerdata->visits()->get() : [];
        $active_memberships = $customerdata != '' ? $customerdata->active_memberships()->orderBy('created_at','desc')->get() : [];
        $suspended_memberships = $customerdata != '' ? $customerdata->suspended_memberships()->orderBy('created_at','desc')->get() : [];
        $purchase_history = @$customerdata != '' ?  @$customerdata->purchase_history()->orderBy('created_at','desc')->get() : [];
    
        $booking_detail = UserBookingDetail::where('business_id', $business_id)
        ->where('user_id', '!=', $customerdata->id)
        ->whereNotNull('user_id')  
        ->whereNull('deleted_at')  
        ->get();
        $id = $customerdata->id;           
        $familyPurchaseHistory = [];         
        foreach ($booking_detail as $booking) {  
            $familyMember = Customer::where('business_id', $company->id)
                ->where('id', $booking->user_id)
                ->first();             
            if ($familyMember)
            {                     
                $familyPurchases = $familyMember->family_purchase_history($id, $booking->booking_id)->get()->toArray();    
                if (!empty($familyPurchases)) {
                    $familyPurchaseHistory[$familyMember->fname . ' ' . $familyMember->lname] []= $familyPurchases; 
                }  
           }       
        }
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
            $cardSuccessMsg = 1; Session::forget('cardSuccessMsg');
        }
        return view('customers.show', [
            'customerdata'=>$customerdata,
            'strpecarderror'=>$strpecarderror,
            'terms'=> $terms,
            'visits' => $visits,
            'purchase_history' => $purchase_history,
            'active_memberships' => $active_memberships,
            'suspended_memberships'=>$suspended_memberships,
            'complete_booking_details' => $complete_booking_details,
            'auto_pay_payment_msg' =>$auto_pay_payment_msg,
            'documents' =>$documents,
            'notes' =>$notes,
            'lastBooking' =>$lastBooking,
            'cardSuccessMsg' =>$cardSuccessMsg,
            'resultDate' =>$this->resultDate,
            'id'=>$id,
            'company'=>$company,
            'familyPurchaseHistory'=>$familyPurchaseHistory
        ]);
    }
    public function active_membership($business_id, Request $request)
    {
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $terms = $company->business_terms->first();
        $customerdata = $company->customers->find($request->customer_id);
        if(!$customerdata){ return redirect()->back(); }
        $visits = $customerdata != '' ? $customerdata->visits()->get() : [];
            $active_memberships = $customerdata != '' ? $customerdata->active_memberships()->orderBy('created_at','desc')->get() : [];
            $html = view('customers.active_membership_list', compact('active_memberships', 'customerdata'))->render();
            return response()->json(['html' => $html]);
    }
    
    public function completed_membership($business_id, Request $request)
    {
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $terms = $company->business_terms->first();
        $customerdata = $company->customers->find($request->customer_id);
            if(!$customerdata){ return redirect()->back(); }
            $complete_booking_details = @$customerdata != '' ? $customerdata->complete_booking_details()->get() : [];

            $html = view('customers.completed_membership_list', compact('complete_booking_details', 'customerdata'))->render();
            return response()->json(['html' => $html]);
    }

    public function suspended_membership($business_id, Request $request)
    {
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $terms = $company->business_terms->first();
        $customerdata = $company->customers->find($request->customer_id);
        if(!$customerdata){ return redirect()->back(); }
           $suspended_memberships = $customerdata != '' ? $customerdata->suspended_memberships()->orderBy('created_at','desc')->get() : [];
            $html = view('customers.suspended_membership', compact('suspended_memberships', 'customerdata'))->render();
            return response()->json(['html' => $html]);
    }

    public function purchase_history($business_id, Request $request)
    {
            $user = Auth::user();
            $company = $user->businesses()->findOrFail($business_id);
            $terms = $company->business_terms->first();
            $customerdata = $company->customers->find($request->customer_id);
            if(!$customerdata){ return redirect()->back(); }
            $purchase_history = @$customerdata != '' ?  @$customerdata->purchase_history()->orderBy('created_at','desc')->get() : [];
            $booking_detail = UserBookingDetail::where('business_id', $business_id)
            ->where('user_id', '!=', $customerdata->id)
            ->whereNotNull('user_id')  
            ->whereNull('deleted_at')  
            ->get();
            $familyPurchaseHistory = [];         
            foreach ($booking_detail as $booking) {  
                $familyMember = Customer::where('business_id', $company->id)
                    ->where('id', $booking->user_id)
                    ->first();             
                if ($familyMember)
                {                     
                    $familyPurchases = $familyMember->family_purchase_history($request->customer_id, $booking->booking_id)->get()->toArray();    
                    if (!empty($familyPurchases)) {
                        $familyPurchaseHistory[$familyMember->fname . ' ' . $familyMember->lname] []= $familyPurchases; 
                    }  
               }       
            }
            $html = view('customers.purchase_history', compact('purchase_history', 'customerdata','familyPurchaseHistory'))->render();
            return response()->json(['html' => $html]);
    }
    public function connected_family($business_id, Request $request)
    {
            $user = Auth::user();
            $company = $user->businesses()->findOrFail($business_id);
            $terms = $company->business_terms->first();
            $customerdata = $company->customers->find($request->customer_id);
            if(!$customerdata){ return redirect()->back(); }
            $html = view('customers.connected_family', compact('customerdata'))->render();
            return response()->json(['html' => $html]);
    }
    public function attendance_history($business_id, Request $request)
    {
            $user = Auth::user();
            $company = $user->businesses()->findOrFail($business_id);
            $terms = $company->business_terms->first();
            $customerdata = $company->customers->find($request->customer_id);
            $visits = $customerdata != '' ? $customerdata->visits()->get() : [];
            if(!$customerdata){ return redirect()->back(); }
            $html = view('customers.attendance_history', compact('visits','customerdata'))->render();
            return response()->json(['html' => $html]);
    }
}