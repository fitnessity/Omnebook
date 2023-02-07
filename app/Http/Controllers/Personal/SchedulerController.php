<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserBookingDetail;
use DateTime;

class SchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orderdata = UserBookingDetail::where('id',$request->odid)->first();
        $filter_date = new DateTime();
        $shift = 1;
        if($request->date && (new DateTime($request->date)) > $filter_date){
            $filter_date = new DateTime($request->date); 
            $shift = 0;
        }

        $days = [];
        $days[] = new DateTime(date('Y-m-d'));
        for($i = 0; $i<=4; $i++){
            $d = clone($filter_date);
            $days[] = $d->modify('+'.($i+$shift).' day');
        }

        return view('scheduler.activity_schedule',[
            'days' => $days,
            'filter_date' => $filter_date,
            'orderdata' => $orderdata,
            'odid' => $request->odid,
        ]);
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
}
