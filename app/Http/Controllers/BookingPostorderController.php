<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BookingPostorder;
use Carbon\Carbon;
use Auth;

class BookingPostorderController extends Controller
{
    //

    public function create(Request $request, $business_id) {
        $booking_postorder = BookingPostorder::create([
                    'business_activity_scheduler_id' => $request->business_activity_scheduler_id,
                    'customer_id' => $request->customer_id,
                    'booked_at' =>Carbon::now(),
        ]);

        return response()->json($booking_postorder->toJSON());
    }

    public function delete(Request $request, $business_id, $booking_postorder_id) {

        $booking_postorder = BookingPostorder::findOrFail($booking_postorder_id);

        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $customer = $company->customers()->findOrFail($booking_postorder->customer_id);

        $booking_postorder->delete();


        return response()->json(['a'=>$booking_postorder->id]);
    }
}
