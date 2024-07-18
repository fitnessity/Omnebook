<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Personal\PersonalBaseController;
use Illuminate\Http\Request;
use Auth;
use App\{Customer,User,BusinessServices};

use App\Repositories\{BookingRepository};

class OrderController extends PersonalBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $booking_repo;

    public function __construct(BookingRepository $booking_repo)
    {        
        $this->booking_repo = $booking_repo;
    }


    public function index(Request $request)
    {
        $user = Auth::user();
        $business = $user->company()->where('id',request()->business_id)->first();
        if(!request()->business_id){
            return redirect()->route('personal.manage-account.index');
        }

        if($request->customer_id){
            if(request()->type == 'user'){
                $familyMember = Auth::user()->user_family_details()->where('id',request()->customer_id)->first();
                $user = User::where(['firstname'=> @$familyMember->first_name, 'lastname'=>@$familyMember->last_name, 'email'=>@$familyMember->email])->first();
                $customer = Customer::where(['user_id' => @$user->id])->first();
                $name = @$familyMember->full_name;
            }else{
                $customer = Customer::find(request()->customer_id);
                $name = @$customer->full_name;
            }   
        }else{
            $customer = Customer::where(['business_id'=>$request->business_id,'user_id'=>Auth::user()->id])->first();
            $name = @$customer->full_name;
        }

        $bookingDetails = $currentBooking =  [];
        $bookingDetails =  $this->booking_repo->otherTab($request->serviceType, $request->business_id,@$customer);
      
        $currentBookingData = $this->booking_repo->currentTab($request->serviceType,$request->business_id,@$customer);
        foreach($currentBookingData as $i=>$book_details){
            $currentBooking[@$book_details->business_services_with_trashed->id .'!~!'.@$book_details->business_services_with_trashed->program_name] [] = $book_details;
        }

        $tabval = $request->tab; 

        return view('personal.orders.index', compact('bookingDetails','currentBooking','tabval','customer','name','business'));
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
    public function edit( $id)
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

    public function searchActivity(Request $request){
        $serviceType = $request->serviceType;
        
        if(!$request->customerId){
            $customer = Auth::user()->customers()->where('business_id' ,$request->businessId)->first();
            $customerID = @$customer->id;
        }else{
            $customer = Customer::find($request->customerId);
            $customerID = $request->customerId;
        }

        $orderDetails = [];
        $tabName = $request->type;
        if($customerID){
            if($request->type == 'current'){
                $bDetails = $this->booking_repo->currentTab($request->serviceType,$request->business_id,@$customer);
            }else{
                $bookingDetails =  $this->booking_repo->otherTab($request->serviceType, $request->business_id,@$customer);
                $bDetails = $this->booking_repo->tabFilterData($bookingDetails,$tabName,request()->serviceType ,date('Y-m-d'));
            }

            foreach($bDetails as $bd){
                if($request->text != ''){
                    $activity = BusinessServices::where('id',$bd->sport)->where('program_name', 'like', '%'.$request->text.'%')->withTrashed()->first();
                }else{
                    $activity = BusinessServices::where('id',$bd->sport)->withTrashed()->first();
                }
                if($activity){
                    $orderDetails[@$bd->business_services_with_trashed->id .'!~!'.@$bd->business_services_with_trashed->program_name] [] = $bd;
                }
            }

            //print_r($orderDetails);exit();

            return view('personal.orders.user_booking_detail',compact('orderDetails','tabName'))->render();
        }
    }

    public function grantAccess(Request $request){
        if($request->status == 'deny'){
            $customers = Customer::where('id',$request->customerId)->update(['user_id'=> null]); 
            if($request->type){
                return Redirect()->route('personal.orders.index',['business_id'=>$request->business_id ,'customer_id' =>$request->customerId,'type'=>$request->type]);
            }else{
                return Redirect()->route('personal.orders.index',['business_id'=>$request->business_id ]);
            }
        }else{
            if($request->customer_id){
                $customers = Customer::where(['business_id'=>$request->business_id ,'id'=>$request->customer_id])->first();
                $customers->update(['user_id'=> $customers->id]);
            }else{
                $user = Auth::user();
                $customer = Customer::where(['business_id'=>$request->business_id ,'email' =>$user->email ])->first();
                $customer->update(['user_id'=> $user->id]);
            }
            
            if($request->type){
                return Redirect()->route('personal.orders.index',['business_id'=>$request->business_id ,'customer_id' =>$request->customerId,'type'=>$request->type]);
            }else{
                return Redirect()->route('personal.orders.index',['business_id'=>$request->business_id ]);
            }
        }
    }
}
