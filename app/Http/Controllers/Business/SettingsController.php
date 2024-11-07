<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use App\TermsCondition;
use App\CompanyInformation;
class SettingsController extends BusinessBaseController
{
    public function index(Request $request ,$business_id)
    {
        $sidecolor=CompanyInformation::where('id',Auth::user()->cid)->first();
        $terms=TermsCondition::where('cid', Auth::user()->cid)->get();
     	return view('business.settings.index',compact('terms','sidecolor'));
    }

    public function update_sidepanel(Request $request,$business_id)
    {
    
        $sideColor = CompanyInformation::where('id', $business_id)->first(); 
    
        if (!$sideColor) {
            return response()->json(['error' => 'Business not found'], 404);
        }

        $sideColor->side_panel_color = $request->side_panel_color == 'white' ? 0 : 1;
        $sideColor->save();
    
        return response()->json(['success' => true, 'message' => 'Side panel color updated successfully']);

    }
}