<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;
use File;
use Config;
use Redirect;
use View;
use DB;
use Response;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ActivityController extends Controller {

	public function activity(Request $request)
	{
		return view('activity.activites');
	}
}