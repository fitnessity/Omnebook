<?php
namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\{User,Announcement,AnnouncementCategory,CustomList,BusinessServices,BusinessPriceDetailsAges,AnnouncementContactCustomerList,AnnouncementContactList};
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
        $customList = CustomList::where(['business_id'=>$business_id])->get();
        $programList = BusinessServices::where(['cid'=>$business_id ,'is_active' => 1])->get();
        $categoryList = BusinessPriceDetailsAges::where(['cid'=>$business_id])->get();
        return view('business.announcement.create', compact('category','business_id','customList','programList','categoryList'))->render();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$business_id)
    {

        $announcement = Announcement::create([
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
            'sms_text' => $request->sms_text, 
            'delivery_timeline' => $request->delivery_timeline, 
            'delivery_method' => $request->delivery_method, 
            'delivery_method_sms' => ($request->delivery_method == 'choose') ? ($request->delivery_method_sms ?? 0 ) : 0, 
            'delivery_method_email' => ($request->delivery_method == 'choose') ? ($request->delivery_method_email ?? 0) : 0, 
            'delivery_method_push_notification' => ($request->delivery_method == 'choose') ? ($request->delivery_method_push_notification ?? 0) : 0, 
            'send_sms_push_not_available' => ($request->delivery_method == 'choose') ? ($request->send_sms_push_not_available ?? 0) : 0, 
        ]);

        if(isset($request->list)){
            foreach ($request->list as $key => $value) {
                list($value, $type) = explode('~~', $value);

                $list = AnnouncementContactList::firstOrCreate([
                    'announcement_id' => $announcement->id,
                    'business_id' => $business_id,
                    'list_name' => $type,
                    'value' => $value
                ]);
            }
        }
        return redirect()->route('business.announcement.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($business_id,$id,Request $request)
    {   
        $customList = CustomList::where(['business_id'=>$business_id])->get();
        $programList = BusinessServices::where(['cid'=>$business_id ,'is_active' => 1])->get();
        $categoryList = BusinessPriceDetailsAges::where(['cid'=>$business_id])->get();
        $announcement = Announcement::find($id);
        $category = AnnouncementCategory::where('business_id',$business_id)->get();
        return view('business.announcement.edit', compact('category','business_id','customList','programList','categoryList','announcement','business_id'))->render();
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
            'sms_text' => $request->sms_text, 
            'delivery_timeline' => $request->delivery_timeline, 
            'delivery_method' => $request->delivery_method, 
            'delivery_method_sms' => $request->delivery_method == 'choose' ? ($request->delivery_method_sms ?? 0 ) : 0, 
            'delivery_method_email' => $request->delivery_method == 'choose' ? ($request->delivery_method_email ?? 0) : 0, 
            'delivery_method_push_notification' => $request->delivery_method == 'choose' ? ($request->delivery_method_push_notification ?? 0) : 0, 
            'send_sms_push_not_available' => $request->delivery_method == 'choose' ? ($request->send_sms_push_not_available ?? 0) : 0, 
        ]);

        $newListIds  = [];
        $listIDs = $announcement->announcementContactList()->pluck('id')->toArray();
        if(isset($request->list)){
            foreach ($request->list as $key => $value) {
                list($value, $type) = explode('~~', $value);

                $list = AnnouncementContactList::firstOrCreate([
                    'announcement_id' => $announcement->id,
                    'business_id' => $business_id,
                    'list_name' => $type,
                    'value' => $value
                ]);

                if (!$list->wasRecentlyCreated) {
                    $newListIds [] = $list->id;
                }
            }
        }

        $contactListIdsDiff = array_diff($listIDs, $newListIds);
        foreach ($contactListIdsDiff as $contactListId) {
            $contactList = AnnouncementContactList::find($contactListId);
            $contactList->delete();
        }

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
    }

    public function getAnnouncementStats(Request $request)
    {
        $announcement = Announcement::find($request->id);
        return view('business.announcement.stats_modal',compact('announcement'));
    }

}
