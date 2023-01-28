<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Input;
use Response;
use Auth;
use Hash;

use Redirect;
use Request as resAll;

class StaffController extends Controller {

	public function createmanageStaff(Request $request){
		return view('staff.createstaff');
	}

	public function staff_scheduled_activities(){
		return view('staff.staff-scheduled-activities');
	}

}