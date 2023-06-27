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

    public function createNewBusinessProfile(Request $request){
        return view('design.createNewBusinessProfile');  //d
    }

    public function createNewBusinessProfileone(Request $request){
        return view('design.createNewBusinessProfileone'); //d
    }

    public function createNewBusinessProfiletwo(Request $request){
        return view('design.createNewBusinessProfiletwo'); //d
    }

    public function manage_activity(Request $request){
        return view('design.manage_activity'); //d
    }

    public function manage_booking(Request $request){
        return view('design.manage_booking'); //d
    }

    public function schedule_create(Request $request){
        return view('design.schedule_create'); //d
    }

    public function manage_company(Request $request){
        return view('design.manage_company'); //d
    }

    public function company_setup(Request $request){
        return view('design.company_setup');
    }

    public function checkin_details(Request $request){
        return view('design.checkin_details');
    }

    public function clients(Request $request){
        return view('design.clients');
    }

	public function clientsview(Request $request){
        return view('design.clientsview');
    }

    public function calendar(Request $request){
        return view('design.calendar');
    }
	
	public function addfamily(Request $request){
        return view('design.addfamily');
    }
	
	public function manage_staff(Request $request){
        return view('design.manage_staff');
    }
	
	public function view_staff(Request $request){
        return view('design.view_staff');
    }
	
	public function manage_product(Request $request){
        return view('design.manage_product');
    }
	
	public function add_product(Request $request){
        return view('design.add_product');
    }
	
	public function sales_report(Request $request){
        return view('design.sales_report');
    }
}