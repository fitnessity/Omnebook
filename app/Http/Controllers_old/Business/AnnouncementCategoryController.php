<?php
namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\{User,Announcement,AnnouncementCategory};
use Auth;
use Illuminate\Support\Facades\Session;

class AnnouncementCategoryController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,$business_id)
    {   
        $category = AnnouncementCategory::where('business_id',$business_id)->orderBy('name')->get();
        return view('business.announcement.announcement_category.index',compact('category','business_id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('business.announcement.announcement_category.create')->render();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$business_id)
    {
        AnnouncementCategory::create([
            'user_id' => Auth::user()->id, 
            'business_id' => $business_id, 
            'name' => $request->name, 
        ]);
        return redirect()->route('business.announcement-category.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($business_id,$id)
    {        
        $category = AnnouncementCategory::find($id);
        return view('business.announcement.announcement_category.edit',['c'=>$category,'business_id'=>$business_id])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request , $business_id,$announcement_category)
    {   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id ,$announcement_category)
    {   
        $category = AnnouncementCategory::find($announcement_category);
        $category->update(['name'=>$request->name]);
        return redirect()->route('business.announcement-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $business_id, $id)
    {
        AnnouncementCategory::find($id)->delete();
        return redirect()->route('business.announcement-category.index');
    }

}
