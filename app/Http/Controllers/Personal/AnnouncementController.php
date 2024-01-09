<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Redirect,Storage,Hash,Response;
use App\{Announcement};


class AnnouncementController  extends Controller
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

        $categoryQuery = Announcement::with('AnnouncementCategory')
            ->where(['business_id' => $request->business_id, 'status' => 'active'])
            ->groupBy('category_id')
            ->get();

        $categories = $categoryQuery->pluck('AnnouncementCategory')->unique();

        $announcement = Announcement::where(['business_id' => $request->business_id, 'status' => 'active'])
            ->when(!$request->date, function ($query) {
                return $query->where(function ($query) {
                    $query->whereDate('announcement_date', '<=', date('Y-m-d'))
                        ->whereTime('announcement_time', '<=', date('H:i'));
                })->orWhere(function ($query) {
                    $query->whereDate('announcement_date', '<=', date('Y-m-d'));
                });
            })
            ->when($request->category, function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            })->when($request->date, function ($query) use ($request) {
                return $query->where('start_date', $request->date);
            })->orderBy('start_date', 'desc')->orderBy('start_time', 'desc')->get();

        return view('personal.announcement_news.index',compact('announcement','categories'));
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
    {   //print_r($request->all());exit;
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

    public function dateFilter(Request $request){


        $announcement = Announcement::where(['business_id' => $request->business_id, 'status' => 'active'])
            ->when($request->search,function($query) use ($request){
                return $query->where('title', 'like', '%' . $request->search . '%');
            })->when($request->category, function ($query) use ($request) {
                return $query->where('category_id', $request->category);
            })->when($request->date, function ($query) use ($request) {
                return $query->where('start_date', $request->date);
            })->orderBy('start_date', 'desc')->orderBy('start_time', 'desc')->get();
        return view('personal.announcement_news.announcement-content',compact('announcement'))->render();
    }
}
