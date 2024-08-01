<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WebsiteIntegration;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class WebsiteIntegrationConroller extends Controller
{
    //
    public function index()
    {
        return view('business.website_integration.index');
    }

    public function update(Request $request)
    {
        $currentCompany = Auth::user()->current_company()->first();
        // dd($currentCompany);

            $data = WebsiteIntegration::where('business_id', $request->business_id)->first();
            $input = [];

            $imageFields = ['checkin'];
            $dbFields = ['background_img'];

            foreach ($imageFields as $i => $field) {
                if ($request->has($field)) {
                    if ($field === 'checkin' && strpos($request->input($field), "checkin") !== false) {
                        $input[$dbFields[$i]] = $request->input($field);
                    } else {
                        $base64File = $request->input($field);
                        $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));
                        $filename = 'checkin-settings/' . Str::uuid()->toString() . '.jpg';
                        Storage::disk('s3')->put($filename, $fileData);
                        $input[$dbFields[$i]] = $filename;
                    }
                } else {
                    $input[$dbFields[$i]] = '';
                }
            }

            // Handle logo upload
            if ($request->has('logo')) {
                $input['logo'] = $request->file('logo')->store('checkin-settings');
            }

            // Handle other input fields
            $input['user_id'] = $currentCompany->user_id;
            $input['business_id'] = $currentCompany->id;
            $input['textcolor']=$request->text_color;
            $input['bg_color']=$request->background_color;
            
            // Update or create the record in the database
            if ($data) {
                $data->update($input);
            } else {
                WebsiteIntegration::create($input);
            }
         return redirect()->back();
    }


}