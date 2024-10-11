<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{CustomerNotes,Customer,StripePaymentMethod,Recurring};
use Auth,Redirect,Storage,Hash,Response;

class NotesAlertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->customer_id){
            if($request->type == 'user'){
                $familyMember = Auth::user()->user_family_details()->where('id',$request->customer_id)->first();
                $customer = Customer::where(['fname' => $familyMember->first_name,'lname' => $familyMember->last_name,'email' => $familyMember->email,])->first();
            }else{
                $customer = Customer::find($request->customer_id);
            }
            
            $id = @$customer->id;
        }else{
            $customer = Auth::user()->customers()->where('business_id',$request->business_id)->first();
            $id = @$customer->id;
        }

        $notes = CustomerNotes::where(['customer_id'=> $id ,'display_chk' => 1])->orderby('due_date','desc')->whereDate('due_date', '=', now())->whereTime('time', '<=', now()->format('H:i'))
                ->orWhere(function ($query) use($id) {
                    $query->whereDate('due_date', '<=', now())->where('customer_id', $id )->where('display_chk' ,1);
                })
                ->when($request->business_id, function ($query) use ($request) {
                    return $query->where('business_id', $request->business_id);
                })->get();

       

        $expiredCards = StripePaymentMethod::where(['user_id'=> $id, 'user_type' => 'Customer'])->where('exp_year','<=', date('Y'))->where('exp_month','<', date('m'))->get();
        $missedPayments = Recurring::where(['user_id'=> $id, 'user_type' => 'Customer'])->where('status' ,'!=','Completed')->whereDate('payment_date' ,'<' ,date('Y-m-d'))->orderBy('payment_date' ,'desc')->get();

        $alertCount = count($expiredCards) +  count($missedPayments);
        return view('personal.notes_alerts.index',compact('notes','expiredCards','missedPayments','alertCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Responsall();exit;
     */
    public function store(Request $request)
    {   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

}
