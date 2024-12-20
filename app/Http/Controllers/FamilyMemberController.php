<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Str,Hash,Auth,Redirect;
use App\{Customer,UserFamilyDetail,CompanyInformation};

class FamilyMemberController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });

        // You can also apply additional middleware or other constructor logic here
    }
    
	public function index(Request $request){
        $loggedinUser = $this->user;
        $UserFamilyDetails = $familyDetails = [];
        if(count($loggedinUser->company) ==  0){
            $userfamily = $loggedinUser->user_family_details;
            foreach($userfamily as $uf){
                $familyDetails [] = $uf;
            }
        }else{
            $customer = @$loggedinUser->customers;
           
            foreach($customer as $cs){
                foreach ($cs->get_families() as $fm){
                    $UserFamilyDetails [] = $fm;
                }  
            }

            $groupedFamilyDetails = collect($UserFamilyDetails)->groupBy(function ($item) {
                return $item->fname . ' ' . $item->lname;
            });

            $uniqueFamilyDetails = collect([]);

            foreach ($groupedFamilyDetails as $name => $group) {
                $uniqueFamilyDetails->push($group->first()); // Add the first item from each group
            }

            foreach ($uniqueFamilyDetails as $detail) {
                $familyDetails [] = $detail;
            }
        }

       //print_r( $familyDetails);exit();
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        return view('personal-profile.add-family', [
            'cart' => $cart,       
            'UserFamilyDetails' => $familyDetails,
        ]);
	}

	public function store(Request $request){

		$user = Auth::user();
		$company_ids = $user->customers()->distinct('business_id')->pluck('business_id')->toArray();
		
		$company = CompanyInformation::whereIn('id', $company_ids)->get();

		$profile_pic = $birthdate = '';
        $message = "There is issue while adding member.Please try again.";
		if($request->hasFile('profile_pic')){
        	$profile_pic = $request->file('profile_pic')->store('customer');
        }

        if($request->birthdate != ''){
            $date = explode('-', $request->birthdate);
            $birthdate = @$date[2].'-'.@$date[0].'-'.@$date[1];
        }
        //print_r($date);exit;
        //$birthdate = $request->birthdatehidden;
        //$birthdate = date('Y-m-d',strtotime($request->birthdate));

        $familyMember = UserFamilyDetail::where(['user_id' => $user->id , 'first_name' =>  $request->fname , 'last_name' => $request->lname])->first();
        //print_r($familyMember);exit;
        if($familyMember == ''){
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
                'birthday' =>   $birthdate,
                'emergency_contact_name' => $request->emergency_name,
            ]);
        }
        
        $chkProviderOrNot = CompanyInformation::where('user_id' , Auth::user()->id)->first();
        if($chkProviderOrNot){
            foreach($company as $key=>$c){
                $password = '';
                if($key == 0){
                    $random_password = Str::random(8);
                    $password = Hash::make($random_password);
                }

                $businessCustomer = $c->customers()->where('user_id', $user->id)->first();
                if($businessCustomer == ''){
                    $random_password = Str::random(8);
                    $password = Hash::make($random_password);
                    $businessCustomer = createBusinessCustomer($user,$password,$c->id); //If a customer is not available for a specific business, we should first create a customer. This is necessary because the customer's ID is saved as a parent ID for a family member.
                }

    			$customer = Customer::where(['business_id'=> $businessCustomer->business_id, 
                                             'fname' =>  $request->fname,
                                             'lname' => $request->lname,
                                             'parent_cus_id' => $businessCustomer->id])->first();
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
                        'birthdate' =>  $birthdate,
                        'parent_cus_id' => $businessCustomer->id,
                    ]); 
                    $createCustomer->create_stripe_customer_id();
                    $chk = 1;
                }else{
                    $message = 'Member already added as customer..';
                }
            }
        }

        return redirect()->back()->with(['message'=>$message]);
	}

	public function update(Request $request ,$id){
        if($request->birthdate != ''){
            $date = explode('-', $request->birthdate);
            $birthdate = @$date[2].'-'.@$date[0].'-'.@$date[1];
        }

        if($request->hasFile('profile_pic')){
            $profile_pic = $request->file('profile_pic')->store('customer');
        }else{
            $profile_pic = $request->old_pic;
        }
		$familyData = UserFamilyDetail::where('id',$id)->first();


	        
        $primary_customers = Auth::user()->customers()->get();
        
        foreach($primary_customers as $primary_customer){
    	    $family_member = $primary_customer->CustomerFamilyDetail()->where(['fname' => $familyData->first_name ,'lname' => $familyData->last_name])->first();

    	    if($family_member){
	    	    $family_member->update(['fname' => $request->fname,
				                        'lname' => $request->lname,
				                        'birthdate' =>   $birthdate,
				                        'phone_number' => $request->mobile,
				                        'emergency_contact' => $request->emergency_contact,
				                        'profile_pic' => $profile_pic,
				                        'gender' => $request->gender,
				                        'email' => $request->email,
				                        'relationship' => $request->relationship]);
    	    }
        }
        
		$familyData->update([ 'first_name' => $request->fname,
            'last_name' => $request->lname,
            'birthday' =>   $birthdate,
            'mobile' => $request->mobile,
            'emergency_contact' => $request->emergency_contact,
            'profile_pic' => $profile_pic,
            'gender' => $request->gender,
            'email' => $request->email,
            'relationship' => $request->relationship]);

    	return redirect()->route('family-member.index');
	}

    public function show(Request $request){
        $familyData = '';
        $type = $request->type;
        if($request->has('id')){
            $user = Auth::user();
            if($type == 'user'){
                $familyData = $user->user_family_details()->findOrFail($request->id); // this is for user who are not providers 
            }else{
                $familyData = Customer::where('id',$request->id)->first(); // this is for user who are providers
            }
        }

        return view('personal-profile.add-edit-family',compact('familyData' ,'type'));
    }
 
    public function destroy(Request $request, $id){
        if($request->type == 'customer'){
            $companyIds = Auth::user()->company()->pluck('id')->toArray();
            $familyData = Customer::where('id',$id)->first();
            $customers = Customer::where(['fname' => @$familyData->fname ,'lname' => @$familyData->lname]);
            if (!empty($companyIds)) {
                $customers->whereIn('business_id', $companyIds);
            }
            
            $customers = $customers->get();
            if(!empty($customers)){
                foreach($customers as $customer){
                    $customer->update(['parent_cus_id'=>NULL]);
                }
            }
        }else{
            $familyData = UserFamilyDetail::where('id',$id)->delete();
        }
    }  
}