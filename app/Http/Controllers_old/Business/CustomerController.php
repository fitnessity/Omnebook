<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Maatwebsite\Excel\HeadingRowImport;
use App\Customer;
use App\StripePaymentMethod;
use Illuminate\Support\Facades\Storage;
use App\{ExcelUploadTracker};
use Excel;
use Session;
use App\Imports\{CustomerImport,ImportMembership,customerAtendanceImport};
use App\Jobs\{ProcessAttendanceExcelData,ProcessCustomerExcelData,ProcessMembershipExcelData};
use App\BusinessCustomerUploadFiles;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $business_id, $id)
    {
        //notes
        $company = $request->current_company;

        $customer = $company->customers()->findOrFail($id);

            

        $customer->update(array_merge(
            $request->only(['notes']), []));

        return redirect()->route('business_customer_show',['business_id' => $company->id, 'id'=>$customer->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function card_editing_form(Request $request, $business_id){
        $company = $request->current_company;
        $customer = $company->customers()->findOrFail($request->customer_id);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $customer->create_stripe_customer_id();
        $intent = $stripe->setupIntents->create(
          [
            'customer' => @$customer->stripe_customer_id,
            'payment_method_types' => ['card'],
          ]
        );
        return view('business.customers.card_editing_form', compact('intent'));
    }


    public function refresh_payment_methods(Request $request){
        $customer = Customer::findOrFail($request->customer_id);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $payment_methods = $stripe->paymentMethods->all(['customer' => $customer->stripe_customer_id, 'type' => 'card']);
        $fingerprints = [];
        foreach($payment_methods as $payment_method){
            $fingerprint = $payment_method['card']['fingerprint'];
            if (in_array($fingerprint, $fingerprints, true)) {
                $deletePaymentMethod = StripePaymentMethod::where('payment_id', $payment_method['id'])->first();
                if($deletePaymentMethod != ''){
                    $deletePaymentMethod->delete();
                }
            } else {
                $fingerprints[] = $fingerprint;
                $card = StripePaymentMethod::where(['payment_id'=>$payment_method['id']])->first();
                if(!$card){
                    $stripePaymentMethod = new StripePaymentMethod;
                    $stripePaymentMethod->payment_id = $payment_method['id'];
                    $stripePaymentMethod->user_type = 'Customer';
                    $stripePaymentMethod->user_id = $customer->id;
                    $stripePaymentMethod->pay_type = $payment_method['type'];
                    $stripePaymentMethod->brand = $payment_method['card']['brand'];
                    $stripePaymentMethod->exp_month = $payment_method['card']['exp_month'];
                    $stripePaymentMethod->exp_year = $payment_method['card']['exp_year'];
                    $stripePaymentMethod->last4 = $payment_method['card']['last4'];
                    $stripePaymentMethod->save();
                }
            }
        }
        if($request->return_url){
            if (str_contains($request->return_url, 'check-in-portal')) {
                $returnUrl = route('check-in-portal', ['customer_id' => $customer->id]);
                return redirect($returnUrl);
            }
            Session::put(['cardSuccessMsg' => 1]);
            return redirect($request->return_url);
        }else{
            return redirect()->route('business_customer_create',['business_id' => $customer->business_id]);
        }
    }

    public function refresh_payment_methods_modal(Request $request)
    {
        $customer = Customer::findOrFail($request->customer_id);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $payment_methods = $stripe->paymentMethods->all(['customer' => $customer->stripe_customer_id, 'type' => 'card']);
        $fingerprints = [];
        foreach($payment_methods as $payment_method){
            $fingerprint = $payment_method['card']['fingerprint'];
            if (in_array($fingerprint, $fingerprints, true)) {
                $deletePaymentMethod = StripePaymentMethod::where('payment_id', $payment_method['id'])->first();
                if($deletePaymentMethod != ''){
                    $deletePaymentMethod->delete();
                }
            } else {
                $fingerprints[] = $fingerprint;
                $card = StripePaymentMethod::where(['payment_id'=>$payment_method['id']])->first();
                if(!$card){
                    $stripePaymentMethod = new StripePaymentMethod;
                    $stripePaymentMethod->payment_id = $payment_method['id'];
                    $stripePaymentMethod->user_type = 'Customer';
                    $stripePaymentMethod->user_id = $customer->id;
                    $stripePaymentMethod->pay_type = $payment_method['type'];
                    $stripePaymentMethod->brand = $payment_method['card']['brand'];
                    $stripePaymentMethod->exp_month = $payment_method['card']['exp_month'];
                    $stripePaymentMethod->exp_year = $payment_method['card']['exp_year'];
                    $stripePaymentMethod->last4 = $payment_method['card']['last4'];
                    $stripePaymentMethod->save();
                }
            }
        }
        if($request->return_url){
            if (str_contains($request->return_url, 'check-in-portal')) {
                $returnUrl = route('check-in-portal', ['customer_id' => $customer->id]);
                return redirect($returnUrl);
            }
            Session::put(['cardSuccessMsg' => 1]);
            return redirect($request->return_url);
        }else{
            return redirect()->route('check-in-welcome');
        }
    }

    public function importcustomer(Request $request,$business_id)
    {
        $user = Auth::user();
        $current_company = $user->businesses()->findOrFail($business_id);
        $file = $request->file('import_file');
        if($request->hasFile('import_file')){
            $ext = $file->getClientOriginalExtension();
            if($ext != 'csv'){
                return response()->json(['status'=>500,'message'=>'File format is not supported.']);
            }
           
        try {
                $originalName = $file->getClientOriginalName();
                $fileName = time() . '_' . str_replace(' ', '_', $originalName);
                // $file->move(public_path('uploads/customers'), $fileName);
                try {
                    // Move the file
                    $file->move(public_path('uploads/customers'), $fileName);
                } catch (\Exception $e) {
                    // Handle the error here, you can log or return an error response
                    return response()->json(['status' => 500, 'message' => 'Failed to move the file: ' . $e->getMessage()]);
                }
                // dd('3');
                $data = BusinessCustomerUploadFiles::create([
                    'user_id' => $user->id,
                    'business_id' => $business_id,
                    'file' => 'uploads/customers/' . $fileName,
                    'file_type'=>'customers file',
                    'status' => 1,
                ]);
                return response()->json(['status' => 200, 'message' => 'We are processing your file. Once completed, We will send you an email and notification.', 'data' => $data]);
                } catch (\Exception $e) {
                    return response()->json(['status' => 500, 'message' => 'An error occurred while uploading the file.','error' => $e->getMessage()]);
                }
        }
        return response()->json(['status' => 500, 'message' => 'No file uploaded.']);
    }

    // public function CustomerProcessfile($id)
    // {
    //     $data=BusinessCustomerUploadFiles::find($id);
    //     $file=$data->file;
    //     $headings = (new HeadingRowImport)->toArray($file);
    //     if(!empty($headings)){
    //         foreach($headings as $key => $row) {
    //             $firstrow = $row[0];
    //             /*print_r($firstrow);exit;*/
    //             if($firstrow[0] != 'last_name' || $firstrow[1] != 'first_name' || $firstrow[3] != 'id' ||  $firstrow[4] != 'address'|| $firstrow[5] != 'city'|| $firstrow[6] != 'state' || $firstrow[7] != 'postal_code' || $firstrow[8] != 'country'|| $firstrow[9] != 'mobile_phone' || $firstrow[10] != 'home_phone' || $firstrow[11] != 'work_phone' || $firstrow[12] != 'email') 
    //             {
    //                 return response()->json(['status'=>500,'message'=>'Problem in header.']);
    //             }
    //         }
    //     }

    //     $current_company->update(['customer_uploading' => 1]);
        
    //     $timestamp = now()->timestamp;
    //     $newFileName = 'business/customer_imports/'.$request->business_id.'-'.$timestamp.'-'.$user->id.'.'.$file->getClientOriginalExtension();

    //     //  ProcessCustomerExcelData::dispatch($request->business_id, $newFileName);
    //     $job = new ProcessCustomerExcelData($request->business_id,$newFileName);
    //     dispatch($job);
    // }

    // public function uploadFile(Request $request,$business_id,$id)
    // {
        
    //     $user = Auth::user();
    //     $current_company = $user->businesses()->findOrFail($business_id);
      
    //     $data=BusinessCustomerUploadFiles::find($id);
    //     $newFileName=$data->file;
    //     // dd($newFileName);
    //     $filePath = public_path($newFileName);
    //     // dd($filePath);
    //     $headings = (new HeadingRowImport)->toArray($filePath);
    //     if(!empty($headings)){
    //         foreach($headings as $key => $row) {
    //             $firstrow = $row[0];
    //             /*print_r($firstrow);exit;*/
    //             if($firstrow[0] != 'last_name' || $firstrow[1] != 'first_name' || $firstrow[3] != 'id' ||  $firstrow[4] != 'address'|| $firstrow[5] != 'city'|| $firstrow[6] != 'state' || $firstrow[7] != 'postal_code' || $firstrow[8] != 'country'|| $firstrow[9] != 'mobile_phone' || $firstrow[10] != 'home_phone' || $firstrow[11] != 'work_phone' || $firstrow[12] != 'email') 
    //             {
    //                 return response()->json(['status'=>500,'message'=>'Problem in header.']);
    //             }
    //         }
    //     }
        
        // $job = new ProcessCustomerExcelData($request->business_id,$filePath);
        // dispatch($job);

    //     $data->isseen='0';
    //     $data->status='0';
    //     $data->save();
    //     return response()->json(['status'=>200,'message'=>'Client file upload is complete. You uploaded {# clients)...']);
    // }
  
    public function uploadFile(Request $request, $business_id, $id)
    {
        ini_set('memory_limit', '2056M');
		ini_set('max_execution_time', 4800);
		ini_set('memory_limit', '-1');
        
        $user = Auth::user();
        $current_company = $user->businesses()->findOrFail($business_id);
    
        $data = BusinessCustomerUploadFiles::find($id);
        $newFileName = $data->file;
        $filePath = public_path($newFileName);
        $headings = (new HeadingRowImport)->toArray($filePath);
    
        if (!empty($headings)) {
            foreach ($headings as $key => $row) {
                $firstrow = $row[0];
                if (
                    $firstrow[0] != 'last_name' || $firstrow[1] != 'first_name' ||
                    $firstrow[3] != 'id' || $firstrow[4] != 'address' || $firstrow[5] != 'city' ||
                    $firstrow[6] != 'state' || $firstrow[7] != 'postal_code' || $firstrow[8] != 'country' ||
                    $firstrow[9] != 'mobile_phone' || $firstrow[10] != 'home_phone' || $firstrow[11] != 'work_phone' ||
                    $firstrow[12] != 'email'
                ) {
                    return response()->json(['status' => 500, 'message' => 'Problem in header.']);
                }
            }
        }
        $file = fopen($filePath, 'r');
        $headers = fgetcsv($file); 
        $dataRows = [];
        while ($row = fgetcsv($file)) {
            $dataRows[] = $row;
        }
        fclose($file);
        $chunks = array_chunk($dataRows, 1000);
        $jobIds = [];
        foreach ($chunks as $chunkIndex => $chunk) {
            $user=auth()->user();
            $job = new ProcessCustomerExcelData($business_id, $chunk,$user->email);
            dispatch($job)->onQueue('customer');
        }
        $data->isseen = '0';
        $data->status = '0';
        $data->save();
        return response()->json(['status' => 200, 'message' => 'Client file upload is complete. You uploaded {# clients)...']);
        
        // my  new code starts
        // for ($i = 0; $i < 60; $i++) { 
        //     $status = Cache::get('job_status_' . $business_id);
        //     if ($status) {
        //         if ($status == 'success') {
        //             return response()->json(['status' => 500, 'message' => 'Client file upload is complete. You uploaded {# clients)...']);
        //             $data->isseen = '0';
        //             $data->status = '0';
        //             $data->save();
        //         } elseif ($status == 'failed') {
        //             return response()->json(['status' => 500, 'message' => 'Client file upload failed. Please try again.']);
        //         }
        //     }
        //     sleep(1); 
        // }
    

        // ends
    }
  
}