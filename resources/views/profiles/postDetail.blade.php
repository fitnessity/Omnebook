@extends('layouts.header')
@section('content')
<?php
use App\User;
use App\PostLike;
use App\PostReport;
use App\PostComment;
?>
<div class="col-sm-12 col-md-8 col-lg-8">
<div class="loadMore">

    <?php //print_r($profile_post); exit;
     $loggedinUser = Auth::user(); 
    $userData = User::where('id',$profile_post->user_id)->first();
	
    ?>
        <div class="central-meta item">
            <div class="user-post">
                <div class="friend-info">
                    <figure>
                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$userData->profile_pic) }}" alt="pic">
                    </figure>
                    <div class="friend-name">
                        <?php
                          $postreport = PostReport::where('user_id',Auth::user()->id)->where('post_id',$profile_post->id)->first();
                         ?>                                           
                        <div class="more">
                            <div class="more-post-optns"><i class="fa fa-ellipsis-h"></i>
                                <ul>
                                     @if($loggedinUser->id == $profile_post->user_id)
                                    <li><a id="{{$profile_post->id}}" class="editpopup" href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Edit Post</a></li>
                                    <li><a href="{{route('delPost',$profile_post->id)}}"><i class="fa fa-trash-o"></i>Delete Post</a></li>
                                    @endif
                                    
                                    @if(empty($postreport))
                                    <li class="bad-report"><a is_report="1" id="{{$profile_post->id}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Report Post</a></li>
                                    @elseif($postreport->report_post==1)
                                    <li class="bad-report"><a is_report="0" id="{{$profile_post->id}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Un Report Post</a></li>

                                     @elseif($postreport->report_post==0)
                                     <li class="bad-report"><a is_report="1" id="{{$profile_post->id}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Report Post</a></li>
                                     @endif

                                    
                                   
                                    
                                    <li><i class="fa fa-address-card-o"></i>Boost This Post</li>
                                    <li><i class="fa fa-clock-o"></i>Schedule Post</li>
                                    <li><i class="fa fa-wpexplorer"></i>Select as featured</li>
                                    <li><i class="fa fa-bell-slash-o"></i>Turn off Notifications</li>
                                </ul>
                            </div>
                        </div>
                        

                        <ins><a href="#" title="">{{ucfirst($userData->firstname)}} {{ucfirst($userData->lastname)}} </a> Post Album</ins>
                        <span><i class="fa fa-globe"></i> published: {{date('F, j Y H:i:s A', strtotime($profile_post->created_at))}}</span>
                    </div>
                    <div class="post-meta">
                        <input type="text" name="abc" data-emojiable="true" data-emoji-input="image" class="removepost" value="{{$profile_post->post_text}}" disabled="">
                    
                         <?php 
                        $userid = $profile_post->user_id;
                        $count = count(explode("|",$profile_post->images));
                        $countimg = $count-5;
                        $getimages = explode("|",$profile_post->images);
                        ?> 
                        <figure>
                            <!-- video post -->
                            @if(isset($profile_post->video))
                             <div class="img-bunch">
                                 <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <figure>
                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                        <video controls class="thumb"  style="width: 100%;">
                                            <source src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/video/{{$profile_post->video}}" type="video/mp4">
                                        </video>
                                        </a>
                                    </figure>
                                </div>
                                    </div>
                                </div>
                        @elseif(isset($profile_post->music))   
                            <div class="img-bunch">
                                 <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <figure>
                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                        <audio src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/music/{{$profile_post->music}}" controls></audio>
                                        </a>
                                    </figure>
                                </div>
                                    </div>
                                </div>
                                <!-- more than 4 images -->
                        @elseif(isset($getimages[4]))

                             <div class="img-bunch">
                                 <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        @if(isset($getimages[0]))
                                        <figure>
                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                            </a>
                                        </figure>
                                        @endif
                                        @if(isset($getimages[1]))
                                        <figure>
                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="">
                                            </a>
                                        </figure>
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        @if(isset($getimages[2]))
                                        <figure>
                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="">
                                            </a>
                                        </figure>
                                        @endif
                                        @if(isset($getimages[3]))
                                        <figure>
                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="">
                                            </a>
                                        </figure>
                                        @endif
                                        @if(isset($getimages[4]))
                                        <figure>
                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[4]}}" alt="">
                                            </a>
                                            <div class="more-photos">
                                                <span>+{{$countimg}}</span>
                                            </div>
                                        </figure>
                                        @endif
                                    </div>
                                </div>
                            </div>


                                  <!-- 4 images -->
                                @elseif(isset($getimages[3]))
                                <div class="img-bunch">
                                 <div class="row">                   
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <figure>
                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                            </a>
                                        </figure>
                                    </div>
                                </div>
                                <div class="row">   
                                <div class="col-lg-4 col-md-4 col-sm-4"> 
                                <figure>
                                    <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                    <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="" height="170">
                                    </a>
                                </figure>   
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4"> 
                                <figure>
                                    <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                    <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="" height="170">
                                    </a>
                                </figure>    
                                </div> 
                                <div class="col-lg-4 col-md-4 col-sm-4">  
                                <figure>
                                    <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                    <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="" height="170">
                                    </a>
                                </figure>   
                                </div> 
                                </div>

                                <!-- 3 images -->
                                @elseif(isset($getimages[2]))
                                <div class="img-bunch">
                                 <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <figure>
                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="" width="100" height="335">
                                        </a>
                                    </figure>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <figure>
                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="" width="100" height="165">
                                        </a>
                                    </figure>
                                    <figure>
                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="" width="100" height="165">
                                        </a>
                                    </figure>
                                </div>
                                </div>
                                </div>              

                                <!-- 2 images -->
                                @elseif(isset($getimages[1]))
                                <div class="img-bunch-two">
                                 <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <figure>
                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                        </a>
                                    </figure>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <figure>
                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="">
                                        </a>
                                    </figure>
                                </div>
                                    </div>
                                </div>

                                <!-- 1 images -->
                                @elseif(isset($getimages[0]))
                                <div class="img-bunch">
                                 <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <figure>
                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                        </a>
                                    </figure>
                                </div>
                                    </div>
                                </div>
                                @endif

                                    
                            <!-- <ul class="like-dislike">
                                <li><a class="bg-purple" href="#" title="Save to Pin Post"><i class="fa fa-thumb-tack"></i></a></li>
                                <li><a class="bg-blue" href="#" title="Like Post"><i class="fa fa-thumbs-up"></i></a></li>
                                <li><a class="bg-red" href="#" title="dislike Post"><i class="fa fa-thumbs-down"></i></a></li>
                            </ul> -->
                            <ul class="like-dislike">
                                <li><a class="bg-purple" href="#" title="Save to Pin Post">
                                    <i class="thumbtrack  fas fa-thumbtack"></i>
                                    </a></li>
                                <li><a class="bg-blue" href="javascript:void(0);" title="Like Post"><i id="{{$profile_post->id}}" is_like="1" class="thumbup thumblike fas fa-thumbs-up"></i></a></li>
                                <li><a class="bg-red" href="javascript:void(0);" title="dislike Post"><i id="{{$profile_post->id}}" is_like="0" class="thumpdown thumblike fas fa-thumbs-down"></i></i></a></li>
                            </ul>
                        </figure>   
                        <div class="we-video-info">
                            <?php

                            $profile_posts_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->count();
                            $likemore = $profile_posts_like-2;
                            $loginuser_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id',$loggedinUser->id)->first();
                            $seconduser_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->first();

                             $profile_posts_comment = PostComment::where('post_id',$profile_post->id)->count();
                             ?>
                            <ul>
                                <li>
                                    <span class="views" title="views">
                                        <i class="eyeview fas fa-eye"></i>
                                        <ins>1.2k</ins>
                                    </span>
                                </li>
                                <li>
                                    <div class="likes heart" title="Like/Dislike">❤ <span id="likecount{{$profile_post->id}}">{{$profile_posts_like}}</span></div>
                                </li>
                                <li>
                                    <span class="comment" title="Comments">
                                        <i class="commentdots fas fa-comment-dots"></i>
                                        <ins>{{$profile_posts_comment}}</ins>
                                    </span>
                                </li>
                                <li>
                                    <span>
                                        <a class="share-pst" href="javascript:void(0);" onclick="fbPost()" title="Share">
                                            <i class="sharealt fas fa-share-alt"></i>
                                        </a>
                                        <a href="http://www.jqueryscript.net" class="share facebook btn btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
                                        <!-- <ins>20</ins> -->
                                    </span> 
                                </li>
                            </ul>
                            @if($profile_posts_like>0)
                            <div class="users-thumb-list">
                                @if(!empty($loginuser_like))
                                <a data-toggle="tooltip" title="Anderw" href="#">
                                    <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic) }}" height="32" width="32">  
                                </a>
                                @endif
                                <?php 
                                $profile_posts_all = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->limit(4)->get();
                               
                                 ?>
                                @if(isset($profile_posts_all[0]))
                                <?php $seconduser = User::find($profile_posts_all[0]->user_id); ?>
                                <a data-toggle="tooltip" title="frank" href="#">
                                    <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$seconduser->profile_pic) }}" height="32" width="32">  
                                </a>
                                @endif
                               
                                 @if(isset($profile_posts_all[1]))
                                <?php $thirduser = User::find($profile_posts_all[1]->user_id); ?>
                                <a data-toggle="tooltip" title="Sara" href="#">
                                    <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$thirduser->profile_pic) }}" height="32" width="32">  
                                </a>
                                @endif

                                 @if(isset($profile_posts_all[2]))
                                <?php $fourthuser = User::find($profile_posts_all[2]->user_id); ?>
                                <a data-toggle="tooltip" title="Amy" href="#">
                                    <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fourthuser->profile_pic) }}" height="32" width="32">  
                                </a>
                                @endif

                                @if(isset($profile_posts_all[3]))
                                <?php $fifthuser = User::find($profile_posts_all[3]->user_id); ?>
                                <a data-toggle="tooltip" title="Ema" href="#">
                                    <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fifthuser->profile_pic) }}" height="32" width="32">  
                                </a>
                                @endif

                                <span><strong>
                                @if(!empty($loginuser_like))
                                You
                                @endif
                            </strong>
                            @if(!empty($seconduser_like))
                             <?php   $secondusername = User::where('id',$seconduser_like->user_id)->first(); ?>
                             ,<b>{{$secondusername->username}}</b>
                             @endif

                             @if($profile_posts_like>2)
                              And <a href="#" title="">{{$likemore}}+ More</a> 
                              @endif
                              Liked
                          </span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="coment-area" style="display: block;">
                        <ul class="we-comet">
                    <?php 
                    $comments = PostComment::where('post_id',$profile_post->id)->limit(2)->get();
                    $allcomments = PostComment::where('post_id',$profile_post->id)->get();
                    ?>
                    @if(count($comments) > 0)
                    @foreach($comments as $comment)
                    <?php
                     $username = User::find($comment->user_id);
                     ?>
                            <li class="commentappendremove">
                                <div class="comet-avatar">
                                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.$username->profile_pic) }}" alt="">
                                </div>
                                <div class="we-comment">
                                    <h5><a href="javascript:void(0);" title="">{{$username->firstname}} {{$username->lastname}}</a></h5>
                                    <p>{{$comment->comment}}</p>
                                    <div class="inline-itms">
                                        <span>{{$comment->created_at->diffForHumans()}}</span>
                                        <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                        <a href="#" title=""><i class="fa fa-heart"></i><span>20</span></a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            @endif

                            
                            <li class="commentappend{{$profile_post->id}}"></li>
                            @if(count($allcomments) > 2)
                            <input type="hidden" name="commentdisplay" id="commentdisplay" value="5">
                            <li>
                                <a id="{{$profile_post->id}}" href="javascript:void(0);" title="" class="showcomments showmore underline">more comments+</a>
                            </li>
                            @endif
                            
                            <li class="post-comment">
                                <div class="comet-avatar">
                                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic) }}" alt="pic">
                                </div>
                                <div class="post-comt-box">
                                    <form method="post" id="commentfrm">
                                        <textarea placeholder="Post your comment" name="comment" id="comment{{$profile_post->id}}"></textarea>
                                        <span class="error" id="err_comment{{$profile_post->id}}"></span>
                                        <div class="add-smiles">
                                            
                                            <span class="em em-expressionless" title="add icon"></span>
                                            <div class="smiles-bunch">
                                                <i class="em em---1"></i>
                                                <i class="em em-smiley"></i>
                                                <i class="em em-anguished"></i>
                                                <i class="em em-laughing"></i>
                                                <i class="em em-angry"></i>
                                                <i class="em em-astonished"></i>
                                                <i class="em em-blush"></i>
                                                <i class="em em-disappointed"></i>
                                                <i class="em em-worried"></i>
                                                <i class="em em-kissing_heart"></i>
                                                <i class="em em-rage"></i>
                                                <i class="em em-stuck_out_tongue"></i>
                                            </div>
                                        </div>
                                        <button style="background-color: #ef3e46" id="{{$profile_post->id}}" class="postcomment" type="button">Post</button>
                                    </form> 
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div><!-- album post -->
</div>
</div>

@include('layouts.footer')
@endsection