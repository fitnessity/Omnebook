<?php

namespace App\Http\Controllers\Business;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\{CompanyInformation,BusinessStaff,BusinessPositions};
use Str,Auth;

use App\Imports\staffImport;

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
        $companyStaff = @$companyInfo->business_staff->sortByDesc('id');
       /* print_r($companyStaff);
        exit;*/
        return view('business.staff.index', compact('companyStaff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request , $business_id)
    {
        $positions = BusinessPositions::where('business_id',$business_id)->get();
        return view('business.staff.add_staff_model',['business_id'=>$business_id,'positions'=>$positions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $business_id)
    {   
        //print_r($request->all());exit;
        $image = '';
        if ($request->hasFile('files')){   
            $image = $request->file('files')->store('staff');
        }
        echo
        $random_password = Str::random(8);
        $company = $request->current_company;
        $create = BusinessStaff::create(['business_id' => $company->id,'first_name' => $request->first_name, 'last_name' => $request->last_name, 'gender' => $request->gender,'position' =>$request->position, 'phone' => $request->phone ,'email'=>$request->email, 'profile_pic' => $image, 'bio'=> $request->bio,'address'=>$request->address,'city'=> $request->city,'state'=> $request->state,'postcode'=>$request->postcode,'birthdate'=>date('Y-m-d',strtotime($request->birthdate)) ,'password'=>Hash::make($random_password),'buddy_key'=>$random_password]);
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
    public function show(Request $request, $business_id, $id)
    {
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $staffMember = $company->business_staff->find($id);
        if(!$staffMember){
            return redirect()->route('business.staff.index');
        }
        $positions = BusinessPositions::where('business_id',$business_id)->get();
        return view('business.staff.show',compact('staffMember','positions'));
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
    public function update(Request $request ,$business_id, $id)
    {
        //print_r($request->all());
        if($request->has('image')){
            $image = $request->file('image')->store('staff');
            Storage::delete($request->oldImage);
        }else{
            $image = $request->oldImage;
        }

        $staff = BusinessStaff::where('id',$id)->first();
        if($request->password != ''){
            $password = Hash::make($request->password);
            $buddy_key = $request->password;
        }else{
            $password = $staff->password;
            $buddy_key = $staff->buddy_key;
        }

        $update = [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'gender' => $request->gender,
            'position' =>$request->position, 
            'phone' => $request->phone,
            'email'=>$request->email, 
            'profile_pic' => $image, 
            'bio'=> $request->bio,
            'address'=>$request->address,
            'city'=> $request->city,
            'state'=> $request->state,
            'password'=>$password,
            'buddy_key'=>$buddy_key,
            'postcode'=>$request->postcode,
            'birthdate'=>date('Y-m-d',strtotime($request->birthdate))
        ];   
        $staff->update($update);
        //print_r($update);exit;     
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusinessStaff  $businessStaff
     * @return \Illuminate\Http\Response
     */
    public function destroy($business_id,$id)
    {
        $member = BusinessStaff::find($id);
        $services = $member->BusinessServices;
        if(!empty($services) && count($services) > 0){
           return 'error';
        }else{
            $member->delete();
            return 'success';
        }
        
    }

    public function position_modal($business_id){
        $positions = BusinessPositions::where('business_id',$business_id)->get();
        return view('business.staff.add_positions_modal',['business_id'=>$business_id,'positions'=>$positions]);
    }

    public function position_store(Request $request, $business_id){
        for ($i=0; $i < count($request->positions) ; $i++) { 
            $data = [
                "name"=> $request->positions[$i],
                "business_id"=>  $business_id,
                "user_id"=> Auth::user()->id,
            ];
            BusinessPositions::create($data);
        }

        return redirect()->route('business.staff.index');
    }

    public function position_delete(Request $request, $business_id, $id){
        $position = BusinessPositions::where('id',$id)->first();
        $position->delete();
    }
}
