<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\TimelineReportedFeedRepository;
use App\Repositories\UserRepository;

use App\TimelineReportedFeed;
use Auth;
use Redirect;
use Response;
use DB;
use Validator;
use Image;

class ReportedFeedsController extends Controller
{   
    protected $reportedFeed;

    public function __construct(TimelineReportedFeedRepository $reportedFeed, UserRepository $users)
    {
        $this->middleware('admin');
        $this->reportedFeed = $reportedFeed;
        $this->users = $users;
    }

    public function index()
    {
        $reportedFeeds = $this->reportedFeed->getAllTimelineReportedFeeds();
        
        return view('admin.reportedfeed.index', [
            'reportedFeeds' => $reportedFeeds,
            'pageTitle' => 'Manage Reported Posts'
        ]);
    }


    public function view($id)
    {
        if($id) {
            $reportedFeed = $this->reportedFeed->getById($id);
            if($reportedFeed)
            {
                if(@$reportedFeed['comment_owner_id'] > 0){
                    $post_owner_details = $reportedFeed->commentOwner;
                    $post_owner_details->ownerType = "Comment Owner";
                } else {
                    $post_owner_details = $reportedFeed->feedOwner;
                    $post_owner_details->ownerType = "Post Owner";
                }
                return view('admin.reportedfeed.view', [
                    'pageTitle' => 'View Reported Post',
                    'reportedFeedDetail' => $reportedFeed,
                    'postOwnerDetails' => $post_owner_details
                ]);
            } else {
                return redirect()->route('reportedfeed-list');
            }
        }
        return redirect()->route('reportedfeed-list');
    }

   

    public function delete(Request $request)
    {
        $status = $this->reportedFeed->deleteItem($request->id);

        
        if($status)
        {
            return json_encode([
                'status' => true
            ]);
        }
        
        return json_encode([
            'status' => false
        ]);

    }

  

    /**
     * Delete Multiple ReportedFeeds
     * 
     * @param Request $request
     * @return array
     */
    public function deleteAll(Request $request){
        $input = $request->all();
        if(isset($request->reportedFeedIds) && count($request->reportedFeedIds) > 0) 
        {
            if(isset($request->submit_delete_reportedfeeds) && $request->submit_delete_reportedfeeds == 1)
            {
                $response = $this->reportedFeed->deleteMultipleTimelineReportedFeeds($request->reportedFeedIds);
            } else if(isset($request->submit_delete_reportedfeeds) && $request->submit_delete_reportedfeeds == 2) {
                $response = $this->reportedFeed->allowFeeds($request->reportedFeedIds);
            }

        } else {
            $response = array(
                    'danger' =>  'Please select at least one Reported Post.',
            );
        }
        return Redirect::to('/admin/reportedfeeds')->with('status',$response);
    }

    public function allowFeed(Request $request)
    {

        $status = $this->reportedFeed->allowFeed($request->id);

        if($status)
        {
            return json_encode([
                'status' => true
            ]);
        }

        return json_encode([
            'status' => false
        ]);

    }

}


