<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\PlanRepository;
use App\Miscellaneous;
use App\Plan;
use App\BusinessClaim;
use App\PostComment;
use App\PostLike;
use App\PostReport;
use App\User;
use Auth;
use Redirect;
use Response;
use DB;
use Validator;
use Image;use App\ProfilePost;
use App\PagePost;
use Maatwebsite\Excel\HeadingRowImport;


class PostController extends Controller
{   
    public function index()
    {
       $post = ProfilePost::orderby('created_at' ,'desc')->get();
        return view('admin.post.index', [
            'post' => $post,
            'pageTitle' => 'Manage Profile Post'
        ]);
    }

    public function businessindex()
    {
        $post = PagePost::orderby('created_at' ,'desc')->get();
        return view('admin.post.businessindex', [
            'post' => $post,
            'pageTitle' => 'Manage Business Post'
        ]);
    }

    public function viewProfilepost()
    {
        
        return view('admin.post.viewprofilepost', [
            'pageTitle' => 'View Profile Post'
        ]);
    }

    public function viewBusinesspost()
    {
        
        return view('admin.post.viewbusinesspost', [
            'pageTitle' => 'View Business Post'
        ]);
    }

    public function loadmoreposts(Request $request) 
    {
        $page=$request->page;
        $limit = 5;
        $offset = $limit * $page;
        $profile_posts = ProfilePost::skip($offset)->take($limit)->orderBy('id','desc')->get();
        $html = '';
        foreach ($profile_posts as $data) {
            $userData = User::where('id',$data->user_id)->first();
            $postreport = PostReport::where('post_id',$data->id)->first();
            $usrData =User::where('id',$data->user_id)->first();
            $profile_posts_like = PostLike::where('post_id',$data->id)->where('is_like',1)->count();
            $profile_posts_comment = PostComment::where('post_id',$data->id)->count();
            $comments = PostComment::where('post_id',$data->id)->limit(2)->get();
            $allcomments = PostComment::where('post_id',$data->id)->get();

            $userid=$data->user_id;
            $count = count(explode("|",$data->images));
            $countimg = $count-5;
            $getimages = explode("|",$data->images);

            $html.='<div class="col-md-6">
                <div class="blog-container">
                    <div class="blog-header">
                        <div class="blog-cover">';
                            if(isset($data->video))
                            {
                                $html.='<div class="img-bunch">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <figure>
                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                <video controls class="thumb"  style="width: 100%;">
                                                    <source src="https://www.fitnessity.co/public/uploads/gallery/'.$userid.'/video/'.$data->video.'" type="video/mp4" class="cvrImg">
                                                </video>
                                                </a>
                                            </figure>
                                        </div>
                                    </div>
                                </div>';
                            }
                            elseif(isset($data->music))
                            {   
                                $html.='<div class="img-bunch">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <figure>
                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                <audio src="https://www.fitnessity.co/public/uploads/gallery/'.$userid.'/music/'.$data->music.'" controls class="cvrImg"></audio>
                                                </a>
                                            </figure>
                                        </div>
                                    </div>
                                </div>';
                            }
                            else
                            {
                                $html.='<div class="img-bunch">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <figure>
                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                <img src="https://www.fitnessity.co/public/uploads/gallery/'.$userid.'/'.$getimages[0].'" alt="" class="cvrImg">
                                                </a>
                                            </figure>
                                        </div>
                                    </div>
                                </div>';
                            }

                            $html.='
                            <div class="blog-author">
                                <img src="https://www.fitnessity.co/public/uploads/profile_pic/thumb/'.$usrData->profile_pic.'" alt="" class="userImg">
                                <h3>'.$usrData->firstname.' '.$usrData->lastname.'</h3>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="blog-body">
                        <div class="blog-summary">
                          <p>'.$data->post_text.'</p>
                        </div>
                    </div>';

                    if(count($comments) > 0)
                    {
                        foreach($comments as $comment)
                        {
                            $username = User::find($comment->user_id);
                
                            $html .= '<li class="commentappendremove">
                                <div class="comet-avatar">
                                    <img src="/public/uploads/profile_pic/thumb/'.$username->profile_pic.'" alt="">
                                </div>
                                <div class="we-comment">
                                    <h5><a href="javascript:void(0);" title="">'.$username->firstname.' '.$username->lastname.'</a></h5>
                                    <p>'.$comment->comment.'</p>
                                    <div class="inline-itms">
                                        <span>'.$comment->created_at->diffForHumans().'</span>
                                    </div>
                                </div>
                            </li>';
                        }
                    }

                    $html .='<li class="commentappend'.$data->id.'"></li>';
                    if(count($allcomments) > 2)
                    {
                        $html .='<input type="hidden" name="commentdisplay" id="commentdisplay" value="5">
                        <li>
                            <a id="'.$data->id.'" href="javascript:void(0);" title="" class="showcomments showmore underline">more comments+</a>
                        </li>';
                    }

                    $html .='<div class="blog-footer">
                            <ul>
                              <li class="comments"><a href="#"><svg class="icon-bubble"><use xlink:href="#icon-bubble"></use></svg><span class="numero"></span>'.$profile_posts_comment.'</a></li>
                              <li class="shares"><a href="#"><svg class="icon-star"><use xlink:href="#icon-star"></use></svg><span class="numero">'.$profile_posts_like.'</span></a></li>
                            </ul>
                        </div>
                    <hr>
                </div>
            </div>';
        }
        return response()->json(array("success"=>'success','html'=>$html)); 
    }
}