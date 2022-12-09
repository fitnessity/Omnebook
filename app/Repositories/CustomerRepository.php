<?php

namespace App\Repositories;

use App\Customer;
use App\Sports;
use App\SocialAccount;
use DB;
use Auth;
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
    {
        $query = Customer::where('email', $email);

        if(isset($id) && $id > 0)
            $query->where('id', '!=', $request->id);
        $existing_customer = $query->first();
        if(@count($existing_customer) > 0) {
            return false;
        }
        return true;
    }
}