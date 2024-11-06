<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use App\TermsCondition;
class SettingsController extends BusinessBaseController
{
    public function index(Request $request ,$business_id)
    {
        $terms=TermsCondition::get();
     	return view('business.settings.index',compact('terms'));
    }
}