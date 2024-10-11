<?php
namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\{User,Announcement,AnnouncementCategory};
use Auth;
use Illuminate\Support\Facades\Session;

class AnnouncementController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,$business_id)
    {   
        $announcement = Announcement::where('business_id',$business_id);
        if($request->category){
            $announcement->where('category_id',$request->category);
        }

        if($request->status){
            $announcement->where('status',$request->status);
        }
        $announcement = $announcement->orderBy('created_at','desc')->get();

        $category = AnnouncementCategory::where('business_id',$business_id)->orderBy('name')->get();
        return view('business.announcement.index', compact('category','announcement','business_id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$business_id)
    {   
        $category = AnnouncementCategory::where('business_id',$business_id)->get();
        return view('business.announcement.create',['category'=>$category,'business_id'=>$business_id])->render();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$business_id)
    {
        //print_r($request->all());exit;
        Announcement::create([
            'user_id' => Auth::user()->id, 
            'business_id' => $business_id, 
            'title' => $request->title, 
            'short_description' => $request->short_description, 
            'category_id' => $request->category, 
            'start_date' => $request->expire == 1 ? $request->startDate : NULL, 
            'end_date' => $request->expire == 1 ? $request->endDate  : NULL, 
            'start_time' =>  $request->expire == 1 ? date('H:i', strtotime($request->startTime)) : '', 
            'end_time' => $request->expire == 1 ? date('H:i', strtotime($request->endTime))  : '', 
            'announcement_date' => $request->announcementDate, 
            'announcement_time' =>  $request->announcementTime ? date('H:i', strtotime($request->announcementTime)):  '',   
            'does_expire' => $request->expire ?? 0, 
            'status' => $request->status, 
            'announcement' => $request->announcement, 
        ]);
        return redirect()->route('business.announcement.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($business_id,$id)
    {
        $announcement = Announcement::find($id);
        $category = AnnouncementCategory::where('business_id',$business_id)->get();
        return view('business.announcement.edit',['a'=>$announcement,'category'=>$category,'business_id'=>$business_id])->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request , $business_id,$announcement)
    {   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $business_id ,$announcementID)
    {   
        $announcement = Announcement::find($announcementID);
        $announcement->update([
            'title' => $request->title, 
            'short_description' => $request->short_description, 
            'category_id' => $request->category, 
             'start_date' => $request->expire == 1 ? $request->startDate : NULL, 
            'end_date' => $request->expire == 1 ? $request->endDate  : NULL, 
            'start_time' =>  $request->expire == 1 ? date('H:i', strtotime($request->startTime)) : '', 
            'end_time' => $request->expire == 1 ? date('H:i', strtotime($request->endTime))  : '', 
            'announcement_date' => $request->announcementDate, 
            'announcement_time' =>  $request->announcementTime ? date('H:i', strtotime($request->announcementTime)):  '',   
            'does_expire' => $request->expire ?? 0, 
            'status' => $request->status, 
            'announcement' => $request->announcement, 
        ]);
        return redirect()->route('business.announcement.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$business_id , $id )
    {
        $announcement = Announcement::find($id)->delete();
    }

    public function upload(Request $request, $business_id)
    {
        if($request->hasFile('upload')) {
            $uploadedFile = $request->file('upload');
            $path = $uploadedFile->store('ck-editor');
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = Storage::url($path); 
            $msg = 'Image successfully uploaded'; 
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8'); 
            return $re;
        }

        /*$uploadedFile = $request->file('upload');
        $path = $uploadedFile->store('ck-editor');
        $url = Storage::url($path);
        $fileName = basename($path);
        return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);*/
    }

}
