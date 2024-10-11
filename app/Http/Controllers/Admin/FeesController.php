<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Fees;
use Auth;
use Redirect;
use Response;
use DB;
use Validator;
use App\BusinessSubscriptionPlan;
class FeesController extends Controller
{
    //
	public function index()
	{
		$id=1;
		$fees = BusinessSubscriptionPlan::where('id',1)->get();
		if($fees)
		{
			return view('admin.fees.index', [ 'pageTitle' => 'Manage Fees', 'fees' => $fees, 'id' => $id ]);
		}
	}
	public function update(Request $request)
	{
		$id = 1;
       	$fee = BusinessSubscriptionPlan::where('id',$id)->first();
       	$input['price'] = $request->price;
		$input['service_fee'] = $request->service_fee;
		$input['site_tax'] = $request->site_tax;
		$input['fitnessity_fee'] = $request->fitnessity_fee;
		$fees = DB::table('business_subscription_plan')->where('id', $request->id)->update($input);
		if($fees)
        {
            session(['key' => 'success']);
            session(['msg' => 'fees Updated Succesfully !']);    
        }

        return redirect()->route('fees');
	}
}
