<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use APp\CompanyInformation;

class TaxController extends Controller
{
	public function index(Request $request, $business_id)
    {   
    	$company = CompanyInformation::find($business_id);
    	$dues_tax = $company->dues_tax;
    	$sales_tax = $company->sales_tax;
    	return view('business.settings.tax.index',compact('dues_tax','sales_tax'));
    }

    public function store(Request $request ,$business_id){
    	$company = CompanyInformation::find($business_id);
    	@$company->update(['dues_tax' => $request->duesTax ,'sales_tax'=>$request->salesTax]);
    	return redirect()->route('business.tax.index');
    }
}