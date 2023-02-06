<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{CompanyInformation,User};
use Auth;

class ServiceController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,$business_id)
    {
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        $companyInfo = CompanyInformation::where('id', $business_id)->orderBy('id', 'DESC')->first();
        $companyservice = @$companyInfo->service->sortByDesc('created_at');;
        $companyid = @$companyInfo->id;
        $companyname = @$companyInfo->name;
        return view('profiles.manageService', compact('cart', 'companyname','companyid', 'companyservice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function service_redirection(Request $request){
        $businessData = [
            'bstep' => 72,
            'cid' => $request->cid,
            'serviceid' => $request->serviceid,
            'servicetype' => $request->service_type
        ];
        
        User::where('id', Auth::user()->id)->update($businessData);
        if($request->btnedit == 'Edit') {
            return redirect()->route('createNewBusinessProfile');
        }

        if($request->btnactive == 'Active') {
            BusinessServices::where('cid', $request->cid)->where('id', $request->serviceid)->where('userid', Auth::user()->id)->update(['is_active' => 1]);
            return redirect()->route('business.services.index');
        }
        
        if($request->btncreateservice == 'Create Service') {
            User::where('id', Auth::user()->id)->update(['bstep' => 71]);
            return redirect()->route('createNewBusinessProfile');
        }

        if($request->btnactive == 'Inactive') {
             BusinessServices::where('cid', $request->cid)->where('id', $request->serviceid)->where('userid', Auth::user()->id)->update(['is_active' => 0]);
            return redirect()->route('business.services.index');
        }
    }
}
