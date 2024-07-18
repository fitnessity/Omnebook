<?php

namespace App\Repositories;

use App\Customer;
use App\Sports;
use App\SocialAccount;
use DB;
use Auth;
use Carbon\Carbon;
use App\UserEmploymentHistory;
use App\UserProfessionalDetail;
use App\CompanyInformation;
use ReCaptcha\ReCaptcha;
use App\Miscellaneous;
use Intervention\Image\Facades\Image;

class CustomerRepository
{	
	public function findById($id)
    {
        return Customer::where('id', $id)->first();
    }
    
    public function findByEmail($email)
    {
        return Customer::where('email', $email)->get();
    }

	public function validateCustomer($email, $id = 0)
    {   echo $email;
        echo $id;exit;
        $query = Customer::where('email', $email);

        if(isset($id) && $id > 0)
            $query->where('id', '!=', $request->id);
        $existing_customer = $query->first();
        if(@count($existing_customer) > 0) {
            return false;
        }
        return true;
    }

    public function findUniqueEmailPerBusiness($id,$email){
        $existing_email = Customer::where(['email'=> $email , 'business_id'=> $id])->first();
        if($existing_email != '') {
            return 'false';
        }
        return 'true';
    }

    public function findUniquefeildPerBusiness($id,$feildname,$value){
        $existing_or_not = Customer::where([$feildname=> $value , 'business_id'=> $id])->first();
        if($existing_or_not != '') {
            return false;
        }
        return true;
    }

    public function findByfname($query)
    {
        return Customer::where('fname', 'LIKE', "%{$query}%")->orderBy('fname', 'ASC')->get();
    }

}