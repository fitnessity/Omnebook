<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Str,Storage;
use App\{BusinessCheckinSettings};

class CheckInController extends Controller
{

	public function index(Request $request, $business_id)
    {
    	$data =  BusinessCheckinSettings::where('business_id', $business_id)->first();
        $color1 = @$data->welcome_screen_color; 
        $color2 = @$data->digit_screen_color; 
        $color3 = @$data->alert_screen_color;
        return view('business.checkin.index' ,compact('data','color1','color2','color3'));
    }

    public function store(Request $request){
    	// print_r($request->all());exit;
        // dd($request->all());
        $data = BusinessCheckinSettings::where('business_id', $request->business_id)->first();

        $input = [];

        $imageFields = ['cover', 'passcode', 'checkin'];
        $dbFields = ['welcome_cover_photo', 'passcode_cover_photo', 'alerts_photo'];
        foreach ($imageFields as $i=>$field) {
            if ($request->has($field)) {
               if (strpos($request->input($field), "checkin") !== false) {
                    $input[$dbFields[$i]] = $request->input($field);
                } else {
                    $base64File = $request->input($field);
                    $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));
                    $filename = 'checkin-settings/' . Str::uuid()->toString() . '.jpg';
                    Storage::disk('s3')->put($filename, $fileData);
                    $input[$dbFields[$i]] = $filename;
                }

            }else{
                $input[$dbFields[$i]] = '';
            }
        }

        if($request->has('logo')){
            $input['logo']= $request->file('logo')->store('checkin-settings');
        }
        $input['play_sound'] = implode(',', $request->input('radio', []));
        $input['user_id'] = auth()->user()->id;
        $input['business_id'] = $request->business_id;
        $input['customer_return_back_time'] = $request->customer_return_back_time;
        $input['welcome_screen_color'] = $request->welcome_screen_color;
        $input['digit_screen_color'] = $request->digit_screen_color;
        $input['alert_screen_color'] = $request->alert_screen_color;
        $input['membership_option'] = $request->membership_option ?? 1;
        //print_r($input);exit;
    	if($data){
    		$data->update($input);
    	}else{
    		
			BusinessCheckinSettings::create($input);
    	}

    	return redirect()->back();
    }
}
