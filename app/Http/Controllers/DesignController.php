<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;

use Request as resAll;

class DesignController extends Controller {

	public function orders(Request $request){
	
        return view('design.order');
	}
	
	public function add_family_for_customer(Request $request){
	
        return view('design.add_family_for_customer');
	}

    public function add_family(Request $request){
        return view('design.add_family');
    } 

    public function dashboard(Request $request){
        return view('design.dashboard');
    }

    public function staff_login(Request $request){
        return view('design.staff_login');
    }
}