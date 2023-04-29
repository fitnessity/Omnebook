<?php

namespace App\Http\Controllers\Business;
use Illuminate\Support\Facades\Hash;
use App\BusinessStaff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{CompanyInformation};
use Str;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $business_id )
    {
        $companyInfo = CompanyInformation::where('id', $business_id)->orderBy('id', 'DESC')->first();
        $companyStaff = @$companyInfo->business_staff->sortByDesc('created_at');
        return view('business.staff.index', compact('companyStaff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('business.staff._add_staff_model');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $business_id)
    {   
        $image = '';
        if ($request->hasFile('insimg')) 
        {   
            $file = $request->file('insimg');
            $name = date('His').$file->getClientOriginalName();
            $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'instructureimg'.DIRECTORY_SEPARATOR,$name);
            if( !empty($name) ){
                $image = $name;
            }
        }

        $random_password = Str::random(8);
        $company = $request->current_company;
        $create = BusinessStaff::create(['business_id' => $company->id,'first_name' => $request->first_name, 'last_name' => $request->last_name, 'position' =>$request->position, 'phone' => $request->phone ,'email'=>$request->email, 'profile_pic' => $image, 'bio'=> $request->bio ,'password'=>Hash::make($random_password)]);
        if($request->has('fromservice')){
            if($create){
                return "success";
            }else{
                return "fail";
            }
        }else{
            return redirect()->route('business.staff.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusinessStaff  $businessStaff
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $business_id)
    {
        return view('business.staff.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusinessStaff  $businessStaff
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessStaff $businessStaff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusinessStaff  $businessStaff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessStaff $businessStaff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessStaff  $businessStaff
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessStaff $businessStaff)
    {
        //
    }
}
