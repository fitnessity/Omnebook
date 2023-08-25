<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Str,Hash,Auth;
use App\{Customer,UserFamilyDetail};

class FamilyMemberController extends Controller
{

	public function index(Request $request){
	}

	public function store(Request $request){
		$user = Auth::user();
		$company = $user->company;

		$profile_pic = '';

		if($request->hasFile('profile_pic')){
        	$profile_pic = $request->file('profile_pic')->store('customer');
        }

        $birthdate = $request->birthdatehidden;

        $data = UserFamilyDetail::create([
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

        foreach($company as $key=>$c){
            if($key == 0){
                $random_password = Str::random(8);
                $password = Hash::make($random_password);
            }

            $businessCustomer = $c->customers()->where('user_id', $user->id)->first();
            if($businessCustomer == ''){
                $businessCustomer = createBusinessCustomer($user,$password,$c->id); //If a customer is not available for a specific business, we should first create a customer. This is necessary because the customer's ID is saved as a parent ID for a family member.
            }

            $createCustomer = Customer::create([
                'business_id' => $c->id,
                'password' => $password,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'phone_number' => $request->mobile,
                'emergency_contact' => $request->emergency_contact,
                'relationship' => $request->relationship,
                'profile_pic' => $profile_pic,
                'gender' => $request->gender,
                'birthdate' =>  $birthdate,
                'parent_cus_id' => @$businessCustomer->id,
            ]);          
        } 
        return redirect()->route('addFamily');
	}

	public function update(Request $request ,$id){
		$familyData = Customer::where('id',$id)->first();

		if($familyData != ''){
			if($request->hasFile('profile_pic')){
            	$profile_pic = $request->file('profile_pic')->store('customer');
	        }else{
	            $profile_pic = $request->old_pic;
	        }

	        $birthdate = $request->birthdatehidden;

			$familyData->fname = $request->fname;
	        $familyData->lname = $request->lname;
	        $familyData->gender = $request->gender;
	        $familyData->email = $request->email;
	        $familyData->relationship = $request->relationship;
	        $familyData->birthdate =   $birthdate;
	        $familyData->phone_number = $request->mobile;
	        $familyData->emergency_contact = $request->emergency_contact;
	        $familyData->profile_pic = $profile_pic;
	        $familyData->update();
		}
		return redirect()->route('addFamily');
	}
}