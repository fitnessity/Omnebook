@extends('admin.layouts.layout')
@section('content')
<style type="text/css">
	.blog-container {
	  	background: #fff;
	  	border-radius: 5px;
	  	box-shadow: hsla(0, 0, 0, .2) 0 4px 2px -2px;
	  	font-family: "adelle-sans", sans-serif;
	  	font-weight: 100;
	  	margin: 48px auto;
	  	width: 100%;
		box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
		padding: 20px;
	}
	.blog-container a {
	  	color: #4d4dff;
	  	text-decoration: none;
	  	transition: .25s ease;
	}
	.blog-container a:hover {
	    border-color: #ff4d4d;
	    color: #ff4d4d;
	}
	.cvrImg{
	  	border-radius: 5px 5px 0 0;
		height: 200px;
		width: 100%;
	}
	.blog-author,.blog-author--no-cover {
	  	margin: 0 auto;
	  	width: 98%;
	}
	.userImg
	{
		background-size: cover;
		border-radius: 50%;
		content: " ";
		display: inline-block;
		height: 32px;
		margin-right: 0.5rem;
		position: relative;
		top: 50px;
		width: 32px;
	}
	.blog-author h3 {
	  	color: #fff;
	  	font-weight: 100;
	  	padding-left: 40px;
	  	background-color: #000;
	  	width: max-content;
	}
	.blog-author--no-cover h3 {
	  	color: lighten(#333, 40%);
	  	font-weight: 100;
	}
	.blog-body {
	  	margin: 0 auto;
	  	width: 80%;
	}
	.video-body {
	  	height: 100%;
	  	width: 100%;
	}
	.blog-title h1 a {
	  	color: #333;
	  	font-weight: 100;
	}
	.blog-summary p {
	  	color: lighten(#333, 10%);
	}
	.blog-tags ul {
	  	display: flex;
	  	flex-direction: row;
	  	flex-wrap: wrap;
	  	list-style: none;
	  	padding-left: 0;
	}
	.blog-tags li + li {
	  	margin-left: .5rem;
	}
	.blog-tags a {
		border: 1px solid lighten(#333, 40%);
		border-radius: 3px;
		color: lighten(#333, 40%);
		font-size: .75rem;
		height: 1.5rem;
		line-height: 1.5rem;
		letter-spacing: 1px;
		padding: 0 .5rem;
		text-align: center;
		text-transform: uppercase;
		white-space: nowrap;
		width: 5rem;
	}

	.blog-footer {
	  	border-top: 1px solid lighten(#333, 70%);
	  	margin: 0 auto;
	  	padding-bottom: .125rem;
	  	width: 80%;
	}
	.blog-footer ul {
	  	list-style: none;
	  	display: flex;
	  	flex: row wrap;
	  	justify-content: flex-end;
	  	padding-left: 0;
	}
	.blog-footer li:first-child {
	  	margin-right: auto;
	}
	.blog-footer li + li {
	 	margin-left: .5rem;
	}
	.blog-footer li {
	  	color: lighten(#333, 40%);
	  	font-size: .75rem;
	  	height: 1.5rem;
	  	letter-spacing: 1px;
	  	line-height: 1.5rem;
	  	text-align: center;
	  	text-transform: uppercase;
	  	position: relative;
	  	white-space: nowrap;
	}
	.blog-footer li a {
	    color: lighten(#333, 40%);
	}
	.comments {
	  	margin-right: 1rem;
	}
	.published-date {
	  	border: 1px solid lighten(#333, 40%);
	  	border-radius: 3px;
	  	padding: 0 .5rem;
	}
	.numero {
	  	position: relative;
	  	top: -0.5rem;
	}
	.icon-star,.icon-bubble {
	  	fill: lighten(#333, 40%);
	  	height:24px;
	  	margin-right: .5rem;
	  	transition: .25s ease;
	  	width: 24px;
	}
	.icon-star:hover,.icon-bubble:hover {
	    fill: #ff4d4d;
	}
	.commentappendremove {
	    display: inline-block;
	    margin-bottom: 20px;
	    width: 100%;
	}
	.comet-avatar {
	    display: inline-block;
	    max-width: 36px;
	    vertical-align: top;
	    width: 36px;
	}
	.comet-avatar img {
	    border-radius: 100%;
	    max-width: 35px;
	}
	.we-comment {
	    border-bottom: 1px solid #ede9e9;
	    display: inline-block;
	    padding-bottom: 8px;
	    padding-left: 8px;
	    position: relative;
	    vertical-align: top;
	    width: 92%;
	}
	.we-comment h5 {
	    color: #515365;
	    display: inline-block;
	    font-size: 14px;
	    font-weight: 500;
	    margin-bottom: 0;
	    margin-right: 8px;
	    width: auto;
	    text-transform: capitalize;
	}
	.we-comment  p {
	    display: inline;
	    font-size: 14px;
	    line-height: 20px;
	    margin-bottom: 0;
	    margin-top: 0;
	}
	.inline-itms {
	    display: inline-block;
	    margin-top: 5px;
	    width: 100%;
	}
	.commentappend {
	    display: inline-block;
	    margin-bottom: 20px;
	    width: 100%;
	}
	li {
	    display: inline-block;
	    margin-bottom: 20px;
	    width: 100%;
	}
</style>

<div id="systemMessage"></div>
   
<div class="panel panel-default">
    <div class="panel-heading">
        List
    </div>

    <div class="panel-body">
      <div class="row">
        <div class="col-md-2" style="float:right;">
          <select id="filter-select" name="filter-select" class="form-control">
              <option value="All">Show All</option>
              <option value="Yes">Active</option>
              <option value="No">Inactive</option>
          </select>
        </div>
      </div>
    </div>

    <svg display="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
		<defs>
			<symbol id="icon-bubble" viewBox="0 0 1024 1024">
				<title>bubble</title>
				<path class="path1" d="M512 224c8.832 0 16 7.168 16 16s-7.2 16-16 16c-170.464 0-320 89.728-320 192 0 8.832-7.168 16-16 16s-16-7.168-16-16c0-121.408 161.184-224 352-224zM512 64c-282.784 0-512 171.936-512 384 0 132.064 88.928 248.512 224.256 317.632 0 0.864-0.256 1.44-0.256 2.368 0 57.376-42.848 119.136-61.696 151.552 0.032 0 0.064 0 0.064 0-1.504 3.52-2.368 7.392-2.368 11.456 0 16 12.96 28.992 28.992 28.992 3.008 0 8.288-0.8 8.16-0.448 100-16.384 194.208-108.256 216.096-134.88 31.968 4.704 64.928 7.328 98.752 7.328 282.72 0 512-171.936 512-384s-229.248-384-512-384zM512 768c-29.344 0-59.456-2.24-89.472-6.624-3.104-0.512-6.208-0.672-9.28-0.672-19.008 0-37.216 8.448-49.472 23.36-13.696 16.672-52.672 53.888-98.72 81.248 12.48-28.64 22.24-60.736 22.912-93.824 0.192-2.048 0.288-4.128 0.288-5.888 0-24.064-13.472-46.048-34.88-56.992-118.592-60.544-189.376-157.984-189.376-260.608 0-176.448 200.96-320 448-320 246.976 0 448 143.552 448 320s-200.992 320-448 320z"></path>
			</symbol>
			<symbol id="icon-star" viewBox="0 0 1024 1024">
				<title>star</title>
				<path class="path1" d="M1020.192 401.824c-8.864-25.568-31.616-44.288-59.008-48.352l-266.432-39.616-115.808-240.448c-12.192-25.248-38.272-41.408-66.944-41.408s-54.752 16.16-66.944 41.408l-115.808 240.448-266.464 39.616c-27.36 4.064-50.112 22.784-58.944 48.352-8.8 25.632-2.144 53.856 17.184 73.12l195.264 194.944-45.28 270.432c-4.608 27.232 7.2 54.56 30.336 70.496 12.704 8.736 27.648 13.184 42.592 13.184 12.288 0 24.608-3.008 35.776-8.992l232.288-125.056 232.32 125.056c11.168 5.984 23.488 8.992 35.744 8.992 14.944 0 29.888-4.448 42.624-13.184 23.136-15.936 34.88-43.264 30.304-70.496l-45.312-270.432 195.328-194.944c19.296-19.296 25.92-47.52 17.184-73.12zM754.816 619.616c-16.384 16.32-23.808 39.328-20.064 61.888l45.312 270.432-232.32-124.992c-11.136-6.016-23.424-8.992-35.776-8.992-12.288 0-24.608 3.008-35.744 8.992l-232.32 124.992 45.312-270.432c3.776-22.56-3.648-45.568-20.032-61.888l-195.264-194.944 266.432-39.68c24.352-3.616 45.312-18.848 55.776-40.576l115.872-240.384 115.84 240.416c10.496 21.728 31.424 36.928 55.744 40.576l266.496 39.68-195.264 194.912z"></path>
			</symbol>
		</defs>
	</svg>
<?php 
use App\User;
use App\PostLike;
use App\PostComment;
?>
	<div class="row bxx">
		@foreach($post as $data)
			<?php 
				$usrData =User::where('id',$data->user_id)->first();
				$profile_posts_like = PostLike::where('post_id',$data->id)->where('is_like',1)->count();
				$profile_posts_comment = PostComment::where('post_id',$data->id)->count();
				$comments = PostComment::where('post_id',$data->id)->limit(2)->get();
		        $allcomments = PostComment::where('post_id',$data->id)->get();

		        $userid=$data->user_id;
		        $count = count(explode("|",$data->images));
		        $countimg = $count-5;
		        $getimages = explode("|",$data->images);
			?>

			<div class="col-md-6">
				<div class="blog-container">
		  
				  	<div class="blog-header">
					    <div class="blog-cover">
					    	@if(isset($data->video))
		                        <div class="img-bunch">
		                            <div class="row">
		                                <div class="col-lg-12 col-md-12 col-sm-12">
		                                    <figure>
		                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
		                                        <video controls class="thumb"  style="width: 100%;">
		                                            <source src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/video/{{$data->video}}" type="video/mp4" class="cvrImg">
		                                        </video>
		                                        </a>
		                                    </figure>
		                                </div>
		                            </div>
		                        </div>
		                        @elseif(isset($data->music))   
		                            <div class="img-bunch">
		                                <div class="row">
			                                <div class="col-lg-12 col-md-12 col-sm-12">
			                                    <figure>
			                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
			                                        <audio src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/music/{{$data->music}}" controls class="cvrImg"></audio>
			                                        </a>
			                                    </figure>
			                                </div>
		                                </div>
		                            </div>
		                        @else
		                            <div class="img-bunch">
		                                <div class="row">
		                                    <div class="col-lg-12 col-md-12 col-sm-12">
		                                        <figure>
		                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
		                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="" class="cvrImg">
		                                            </a>
		                                        </figure>
		                                    </div>
		                                </div>
		                            </div>
		                        @endif 

					      <div class="blog-author">
					      	<img src="https://www.fitnessity.co/public/uploads/profile_pic/thumb/{{$usrData->profile_pic}}" alt="" class="userImg">
					        <h3>{{$usrData->firstname}} {{$usrData->lastname}}</h3>
					      </div>
					    </div>
				  	</div>
				  	<br>
				  	<div class="blog-body">
					    <div class="blog-summary">
					      <p>{{$data->post_text}}</p>
					    </div>
				  	</div>

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
			                    </div>
			                </div>
			            </li>
			            @endforeach
			        @endif
			        <li class="commentappend{{$data->id}}"></li>
			        @if(count($allcomments) > 2)
			        <input type="hidden" name="commentdisplay" id="commentdisplay" value="5">
			        <li>
			            <a id="{{$data->id}}" href="javascript:void(0);" title="" class="showcomments showmore underline">more comments+</a>
			        </li>
			        @endif
		  
					<div class="blog-footer">
					    <ul>
					      <li class="comments"><a href="#"><svg class="icon-bubble"><use xlink:href="#icon-bubble"></use></svg><span class="numero"></span>{{$profile_posts_comment}}</a></li>
					      <li class="shares"><a href="#"><svg class="icon-star"><use xlink:href="#icon-star"></use></svg><span class="numero">{{$profile_posts_like}}</span></a></li>
					    </ul>
					</div>
					<hr>
				</div>
			</div>
		@endforeach

		<div class="content-dash" id="scroll_pagination"></div>

	</div>
</div>

<script type="text/javascript">
$(document).on('click', '.showcomments', function(){
    var commentdisplay = $('#commentdisplay').val();
    var postId =$(this).attr('id');
    $('.commentappendremove').html("");
    $.ajax({
        url: "{{url('/showcomments')}}" + "/"+postId,
        type: 'get',
        data:{
            commentdisplay:commentdisplay
        },
        success: function (data) {
            if(data.success=='success'){
                //$('#likecount'+postId).html(data.count);
                $('.commentappend'+postId).html(data.html);
                var commentsum = parseInt(commentdisplay)+parseInt(5);
                $('#commentdisplay').val(commentsum);
            }
        }
    }); 
});
/* page load scroll*/
var page =0;
var cnfload = true;

//for mobile and web scroll
var addition_constant = 0;
$(document.body).on('touchmove', onScroll); // for mobile
$(window).on('scroll', onScroll);

function onScroll() {
  var addition = ($(window).scrollTop() + window.innerHeight);
  //var footerHeight = $('#footer').height();
  var scrollHeight = (document.body.scrollHeight - 1);
  //scrollHeight = scrollHeight-footerHeight;
  if (addition > scrollHeight && addition_constant < addition) {

    addition_constant = addition;

    cnfload = false;
    page++;
    //alert(page);
    load_data(page);
  }
}

function load_data(page){
        
    $('.loader').show();
    $.ajax({
        url: "{{url('/loadmoreposts')}}",
        type: 'get',
        data:{
            page:page,
        },          
        success: function (data) {
            if(data.success=='success'){
                $('#scroll_pagination').append(data.html);
                cnfload = true;
            }

        }
    });
}
//load_data(page);
</script>
@endsection