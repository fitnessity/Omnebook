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
            Session::put(['cardSuccessMsg' => 1]);
            return redirect($request->return_url);
        }else{
            return redirect()->route('business_customer_create',['business_id' => $customer->business_id]);
        }
    }

    public function importcustomer(Request $request, $business_id)
    {
        $user = Auth::user();
        $current_company = $user->businesses()->findOrFail($business_id);
        $file = $request->file('import_file');

        // if($current_company->customer_uploading){
        //    return response()->json(['status'=>500,'message'=>'Client import processing...']); 
        // }
        if($request->hasFile('import_file')){
            $ext = $file->getClientOriginalExtension();
            // if($ext != 'csv' && $ext != 'csvx' && $ext != 'xls' && $ext != 'xlsx' ){
            if($ext != 'csv'){
                return response()->json(['status'=>500,'message'=>'File format is not supported.']);
            }

            $headings = (new HeadingRowImport)->toArray($file);
            /*print_r($headings);*/
            if(!empty($headings)){
                foreach($headings as $key => $row) {
                    $firstrow = $row[0];
                    /*print_r($firstrow);exit;*/
                    if(  $firstrow[0] != 'last_name' || $firstrow[1] != 'first_name' || $firstrow[3] != 'id' ||  $firstrow[4] != 'address'|| $firstrow[5] != 'city'|| $firstrow[6] != 'state' || $firstrow[7] != 'postal_code' || $firstrow[8] != 'country'|| $firstrow[9] != 'mobile_phone' || $firstrow[10] != 'home_phone' || $firstrow[11] != 'work_phone' || $firstrow[12] != 'email') 
                    {
                        return response()->json(['status'=>500,'message'=>'Problem in header.']);
                    }
                }
            }


            $current_company->update(['customer_uploading' => 1]);
            
            
            $timestamp = now()->timestamp;
            $newFileName = 'business/customer_imports/'.$request->business_id.'-'.$timestamp.'-'.$user->id.'.'.$file->getClientOriginalExtension();


            Storage::disk('s3')->put($newFileName, file_get_contents($file));


            ProcessCustomerExcelData::dispatch($request->business_id, $newFileName);

            

            return response()->json(['status'=>200,'message'=>'File processing...']);
        }


    }
}
