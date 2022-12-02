<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AddrCities;
use App\AddrStates;
use App\UserBookingStatus;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function calendar(Request $request) {
         
        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('m d,Y', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        $UserProfileDetail['email'] = $user->email;

        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
            ;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
            ;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;

        if ($request->ajax()) {
            /*$data = Event::whereDate('start', '>=', $request->start)
                    ->whereDate('end', '<=', $request->end)
                    ->get(['id', 'title', 'start', 'end']);*/
                    
            $data = UserBookingStatus::selectRaw('user_booking_status.id, ser.program_name as title,  
                    user_booking_status.bookedtime as start')
                    ->leftjoin("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                    ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                    ->where('user_booking_status.user_id', Auth::user()->id)
                    ->whereDate('user_booking_status.bookedtime', '>=', $request->start)
                    ->whereDate('user_booking_status.bookedtime', '<=', $request->end)->get(['id', 'title', 'start' ]);
                    
            return response()->json($data);
        }
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        return view('calendar.index', ['UserProfileDetail' => $UserProfileDetail, 'cart' => $cart] );
    }
}
