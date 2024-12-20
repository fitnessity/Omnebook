<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\{User,CompanyInformation,BusinessStaff};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\HeadingRowImport;
use Excel; 
use App\Imports\staffImport;

class StaffController extends Controller
{
	 /**
     * Display a list of all of the user's page.
     *
     * @param  Request  $request
     * @return Response
     */


    public $error = '';
    public function index(Request $request)
    {
        if(Auth::check() == 1){

            Auth::logout();
        }
        
        if($request->has('term'))
        {
            $companies = CompanyInformation::whereRaw('LOWER(`company_name`) LIKE ?', [ '%'. strtolower($request->term) .'%' ])->get(); 
        }

        if ($request->ajax()) {
            return response()->json($companies);
        }
        return view('staff.login');
    }

    public function login(Request $request)
    {
        $company = CompanyInformation::whereRaw('LOWER(`company_name`) = ?', [strtolower($request->searchCompany)])->first();
        
        if($company == ''){
            return redirect()->back()->with('errorMsg','Please check your company. We can\'t find this company.');
        }

    	$staff = BusinessStaff::where(['email'=>$request->email,'business_id'=>$company->id,'buddy_key'=>$request->password])->first();

    	if($staff == ''){
    		return redirect()->back()->with('errorMsg','Email or Password doesn\'t match. Please check Your Email and Password.');
    	}
    	
    	$userDetail = $staff->CompanyInformation->users;
    	if($userDetail != ''){
			Session::put('StaffLogin', $staff->id);
    		Auth::login($userDetail);
    		return redirect('/dashboard');
    	}else{
    		return redirect()->back()->with('errorMsg','Error while Log In');
    	}
    	
    }


    public function importstaff(Request $request){
        if($request->hasFile('import_file')){
            $ext = $request->file('import_file')->getClientOriginalExtension();
            if($ext != 'csv' && $ext != 'csvx' && $ext != 'xls' && $ext != 'xlsx' )
            {
                return response()->json(['status'=>500,'message'=>'File format is not supported.']);
            }
            ini_set('max_execution_time', 10000); 
            $headings = (new HeadingRowImport)->toArray($request->file('import_file'));
            if(!empty($headings)){
                foreach($headings as $key => $row) {
                    $firstrow = $row[0];
                    if(  $firstrow[0] != 'name' || $firstrow[1] != 'home_phone' || $firstrow[2] != 'work_phone' || $firstrow[3] != 'ext' ||  $firstrow[4] != 'mobile_phone'|| $firstrow[5] != 'email'|| $firstrow[6] != 'address' || $firstrow[7] != 'city' || $firstrow[8] != 'state'|| $firstrow[9] != 'postal_code' ) 
                    {
                        $this->error = 'Problem in header.';
                        break;
                    }
                }
            }
            if($this->error != '')
            {
                return response()->json(['status'=>500,'message'=>$this->error]);
            }

            Excel::import(new staffImport($request->business_id), $request->file('import_file'));
        }

        if($this->error != '')
        {
            return response()->json(['status'=>500,'message'=>$this->error]);
        }
        else{
            return response()->json(['status'=>200,'message'=>'File imported Successfully']);
        }
    }
}