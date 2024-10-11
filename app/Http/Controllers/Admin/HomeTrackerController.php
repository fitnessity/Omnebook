<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\HomeTracker;
use Auth;
use Redirect;
use Response;
use DB;
use Input;
use Validator;

class HomeTrackerController extends Controller
{ 
	public function index()
    { 
    	$hometracker = HomeTracker::where('id',1)->get();
		if($hometracker)
		{
			return view('admin.hometracker.index', [
	            'hometracker' => $hometracker,
	            'pageTitle' => 'Manage Home Tracker'
       	 	]);
		}  
    }

    public function update(Request $request)
	{
		$id = 1;
       	$hometracker = HomeTracker::where('id',$id)->first();
       	$input['trainers'] = $request->trainers;
		$input['locations'] = $request->locations;
		$input['activities'] = $request->activities;
		$input['businesses'] = $request->businesses;
		$input['bookings'] = $request->bookings;
		$hometracker = DB::table('home_tracker')->where('id', $request->id)->update($input);
		if($hometracker)
        {
            session(['key' => 'success']);
            session(['msg' => 'Home Tracker Updated Succesfully !']);    
        }

        return redirect()->route('hometracker');
	}   
    
}