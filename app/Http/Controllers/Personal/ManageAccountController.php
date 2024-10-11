<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Redirect,Storage,Hash;
use App\{UserFamilyDetail,Customer,CompanyInformation,BusinessServices};
use Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log; 
use DB;
class ManageAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*public function __construct() {
        $this->middleware('auth');
    }*/

     protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

    }

    public function index(Request $request)
    {
        $user = $this->user;
        $UserFamilyDetails = $familyDetails = [];
        $customer = @$user->customers;
        // dd($customer);
        if($customer){
            foreach($customer as $cs){
                foreach ($cs->get_families() as $fm){
                    $familyDetails [] = $fm;
                }  
            }

            $groupedFamilyDetails = collect($familyDetails)->groupBy(function ($item) {
                return $item->fname . ' ' . $item->lname;
            });

            $uniqueFamilyDetails = collect([]);

            foreach ($groupedFamilyDetails as $name => $group) {
                $uniqueFamilyDetails->push($group->first()); // Add the first item from each group
            }

            foreach ($uniqueFamilyDetails as $detail) {
                $UserFamilyDetails [] = $detail;
            }
        }else{
            $userfamily = $user->user_family_details;
            foreach($userfamily as $uf){
                $UserFamilyDetails [] = $uf;
            }
        }

        return view('personal.manage_account.index',compact('user','UserFamilyDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $user = $this->user;
        return view('personal.manage_account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Responsall();exit;
     */
    public function store(Request $request)
    {
        $user = $this->user;
        $company_ids = $user->customers()->distinct('business_id')->pluck('business_id')->toArray();
        
        $message = "There is issue while adding member.Please try again.";
        $profile_pic = $request->hasFile('profile_pic') ? $request->file('profile_pic')->store('customer') : '';
        UserFamilyDetail::create([
            'user_id' => $user->id,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'emergency_contact' => $request->emergency_contact,
            'relationship' => $request->relationship,
            'gender' => $request->gender,
            'profile_pic' => $profile_pic,
            'birthday' =>   $request->birthdate,
            'emergency_contact_name' => $request->emergency_name,
        ]);

        $chkProviderOrNot = CompanyInformation::where('user_id' , $user->id)->get(); 
        if($chkProviderOrNot->isNotEmpty()){
            foreach($chkProviderOrNot as $key=>$c){
                $businessCustomer = $c->customers()->where('user_id', $user->id)->first();
                if($businessCustomer == ''){
                    $random_password = Str::random(8);
                    $password = Hash::make($random_password);
                    $businessCustomer = createBusinessCustomer($user,$password,$c->id); 
                }
            }
        }

        $company = CompanyInformation::whereIn('id' ,$company_ids)->get();

        foreach($company as $key=>$c){
            $password = '';
            if($key == 0){
                $random_password = Str::random(8);
                $password = Hash::make($random_password);
            }

            $customer = Customer::where(['business_id'=> $businessCustomer->business_id, 'fname' =>  $request->fname,'lname' => $request->lname,'parent_cus_id' => $businessCustomer->id])->first();
            if($customer == ''){
                $createCustomer = Customer::create([
                    'business_id' => $c->id,
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'email' => $request->email,
                    'phone_number' => $request->mobile,
                    'emergency_contact' => $request->emergency_contact,
                    'relationship' => $request->relationship,
                    'profile_pic' => $profile_pic,
                    'gender' => $request->gender,
                    'birthdate' =>  $request->birthdate,
                    'parent_cus_id' => $businessCustomer->id,
                ]); 
                $createCustomer->create_stripe_customer_id();

                $chk = 1;
            }else{
                $message = 'Member already added as customer..';
            }
        }

        return redirect()->back()->with(['message'=>$message]);
    }

   
    


    public function store_fu(Request $request)
    {
        $user = $this->user;
        // dd($user);
    
        // Fetch BusinessServices based on serviceid
        // $businessService = BusinessServices::where('id', $serviceid)->first();
        $business_id=$request->business_id;
        // dd($business_id);
        if (!$business_id) {
            return redirect()->back()->with(['message' => 'Invalid Bussiness ID.']);
        }

        // dd($user->id);
        // $business_id = $businessService->cid;
        $parentid=Customer::where('user_id',Auth::id())->where('business_id',$business_id)->first();
        // dd($parentid);

        // Print the SQL query (for debugging purposes)
        // print_r($sql);
        
        $message = "There is issue while adding member. Please try again.";
        $profile_pic = $request->hasFile('profile_pic') ? $request->file('profile_pic')->store('customer') : '';

        // Convert birthdate format to YYYY-MM-DD
        $birthdate = \Carbon\Carbon::createFromFormat('m-d-Y', $request->birthdate)->format('Y-m-d');

        // Create UserFamilyDetail
        UserFamilyDetail::create([
            'user_id' => $user->id,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'emergency_contact' => $request->emergency_contact,
            'relationship' => $request->relationship,
            'gender' => $request->gender,
            'profile_pic' => $profile_pic,
            'birthday' => $birthdate,
            'emergency_contact_name' => $request->emergency_name,
        ]);

        // Check if user is a provider in any company
        $chkProviderOrNot = CompanyInformation::where('user_id', $user->id)->get();
        if ($chkProviderOrNot->isNotEmpty()) {
            foreach ($chkProviderOrNot as $c) {
                $businessCustomer = $c->customers()->where('user_id', $user->id)->first();
                if (!$businessCustomer) {
                    $random_password = Str::random(8);
                    $password = Hash::make($random_password);
                    $businessCustomer = createBusinessCustomer($user, $password, $c->id); // If a customer is not available for a specific business, create one
                }
            }
        }

        // Process business customers for the specified business ID
        $password = '';
        if (empty($businessCustomer)) {
            $random_password = Str::random(8);
            $password = Hash::make($random_password);
        }

        $customer = Customer::where([
            'business_id' => $business_id,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'parent_cus_id' => $parentid->id
        ])->first();

        if (!$customer) {
            $createCustomer = Customer::create([
                'business_id' => $business_id,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone_number' => $request->mobile,
                'emergency_contact' => $request->emergency_contact,
                'relationship' => $request->relationship,
                'profile_pic' => $profile_pic,
                'gender' => $request->gender,
                'birthdate' => $birthdate,
                'parent_cus_id' => $parentid->id,
            ]);
            // dd($createCustomer);
            $createCustomer->create_stripe_customer_id();
            $message = "Member added successfully.";
        } else {
            $message = 'Member already added as customer.';
        }

        return redirect()->back()->with(['message' => $message]);
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
    public function update(Request $request, $id)
    {   //print_r($request->all());exit;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
