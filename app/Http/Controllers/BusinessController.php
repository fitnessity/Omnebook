<?php

namespace App\Http\Controllers;

// use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Auth;
use Response;
use Redirect;
use Validator;
use Input;
use Image;
use File;
use DB;
use App\User;
use App\UserService;
use App\UserProfessionalDetail;
use App\PagePost;
use App\PagePostComments;
use App\PagePostCommentsLike;
use App\PagePostLikes;
use App\PagePostSave;
use App\CompanyInformation;
use App\Miscellaneous;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\PageAttachment;
use App\BusinessCompanyDetail;
use App\BusinessExperience;
use App\BusinessInformation;
use App\BusinessService;
use App\BusinessTerms;
use App\BusinessVerified;
use App\BusinessServices;
use App\BusinessServicesMap;
use App\BusinessPriceDetails;
use App\BusinessSubscriptionPlan;
use App\BusinessActivityScheduler;
use App\PageLike;
use App\Notification;
use App\Sports;
use App\BusinessReview;

class BusinessController extends Controller
{
	protected $users;
    public function __construct(UserRepository $users)
    {
		$this->users = $users;
    }
    /*public function testTwilio(Request $request)
    {
        require asset('/twilio/sdk/Services/Twilio.php');
		// require asset('/css/material-charts.css');die;
        // Create an authenticated client for the Twilio API
        $client = new Services_Twilio($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);
		// Use the Twilio REST API client to send a text message
        $m = $client->account->messages->sendMessage(
			$_ENV['TWILIO_NUMBER'], // the text will be sent from your Twilio number
			$number, // the phone number the text will be sent to
			$message // the body of the text message
		);
		// Return the message object to the browser as JSON
		return $m;
	}*/
	
	public function pagePost(Request $request) {
		$images=array();
        $loggedinUser = Auth::user(); 
		$page_id = $request->page_id;
        if($request->hasFile('image_post')){  
			$files=$request->file('image_post'); 
			foreach($files as $file){
                $name=$file->getClientOriginalName();               
                $images[]=$name;
                $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR, $name);
            }
           
            $data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "images" => implode("|",$images),
				"page_id" => $page_id,
            );
            PagePost::create($data);
        }
        else if($request->hasFile('video')){
            $this->validate($request, [
                'video' => 'required|mimes:mp4,mov,ogg,qt | max:10000',            
            ]);
            $imagebanner = $request->file('video');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'video'.DIRECTORY_SEPARATOR, $name); 
            $data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "video" => $name,
				"page_id" => $page_id,
            );
			PagePost::create($data);
        }
		else if($request->hasFile('music_post')){ 
			$imagebanner = $request->file('music_post');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'music'.DIRECTORY_SEPARATOR, $name); 
            $data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "music" => $name,
				"page_id" => $page_id,
            );
           PagePost::create($data);
        }
		else if( $request->selfieimg !='' ){ 
			$data = $request->selfieimg;
			
			list($type, $data) = explode(';', $data);
			list(, $data) = explode(',', $data);
			$data = base64_decode($data);
			$imgname= 'selfie_image'.date('dmYHis');
			
			file_put_contents(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id.DIRECTORY_SEPARATOR.$imgname.'.png', $data);
			
			$data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "images" => $imgname.'.png',
				"page_id" => $page_id,
            );
            PagePost::create($data);
		}
		else if($request->post_text != '' && !$request->hasFile('music_post') && !$request->hasFile('video') && !$request->hasFile('image_post') && !$request->selfieimg ){
			$data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
				"page_id" => $page_id,
            );
           PagePost::create($data);
		}
        return Redirect::back()->with('success', 'Post created succesfully!');
    }
	
	public function pagePostcomment($id,Request $request) { 
       $data=array(
       		"user_id" => Auth::user()->id,
            "post_id" => $id,
            "comment" => $request->comment,
       );
        $data = PagePostComments::create($data);
        $comment =  PagePostComments::where('id',$data->id)->first();
        $username = User::find($comment->user_id);
		$cmntlike=''; $cmntUlike='';
		$cmntlike = PagePostCommentsLike::where('comment_id', $comment->id)->count();
		// $cmntUlike = PostCommentLike::where('comment_id',$comment->id)->where('user_id',Auth::user()->id)->count();
		$commentLiked='';
		if($cmntUlike>0){ $commentLiked='commentLiked'; }
        $html = '<li>
                    <div class="comet-avatar">';
						if(File::exists(public_path("/uploads/profile_pic/thumb/".$username->profile_pic ))){
                        	$html.= '<img src="/public/uploads/profile_pic/thumb/'.$username->profile_pic.'" alt="pic">';
                        }else{ 
							$pf=substr($username->firstname, 0, 1).substr($username->lastname, 0, 1);
                            $html.= '<div class="admin-img-text"><p>'.$pf.'</p></div>';
						}
                     $html.= '</div>
                    <div class="we-comment">
                        <h5><a href="javascript:void(0);" title="">'.$username->firstname.' '.$username->lastname.'</a></h5>
                        <p>'.$comment->comment.'</p>
                        <div class="inline-itms">
                            <span>'.$comment->created_at->diffForHumans().'</span>
							<a href="javascript:void(0);" class="commentlike" id="'.$comment->id.'" post-id="'.$id.'" ><i class="fa fa-heart '.$commentLiked.'" id="comlikei'.$comment->id.'"></i><span id="comlikecounter'.$comment->id.'">'.$cmntlike.'</span></a>
                        </div>
                    </div>
                </li>';

        return response()->json(array("success"=>'success','html'=>$html));
    }
	public function pageshowcomments($id,Request $request) { 
        $commentdisplay = $request->commentdisplay; 
        
        if($commentdisplay == 5){
            $commentdisplay = $commentdisplay+2;
            $commentData =  PagePostComments::where('post_id',$id)->limit($commentdisplay)->get();
        }else{           
            $commentData =  PagePostComments::where('post_id',$id)->limit($commentdisplay)->get();
        }
        $html ='';
        foreach ($commentData as $comment) {
            $username = User::find($comment->user_id);
			$cmntlike = PagePostCommentsLike::where('comment_id', $comment->id)->count();
			$cmntUlike = PagePostCommentsLike::where('comment_id',$comment->id)->where('user_id',Auth::user()->id)->count();
			$commentLiked='';
			if($cmntUlike>0){ $commentLiked='commentLiked'; }
            $html .= '<li>
                    <div class="comet-avatar">
                        <img src="/public/uploads/profile_pic/thumb/'.$username->profile_pic.'" alt="">
                    </div>
                    <div class="we-comment">
                        <h5><a href="javascript:void(0);" title="">'.$username->firstname.' '.$username->lastname.'</a></h5>
                        <p>'.$comment->comment.'</p>
                        <div class="inline-itms">
                            <span>'.$comment->created_at->diffForHumans().'</span>
                            <a href="javascript:void(0);" class="commentlike" id="'.$comment->id.'" post-id="'.$id.'" ><i class="fa fa-heart '.$commentLiked.'" id="comlikei'.$comment->id.'"></i><span id="comlikecounter'.$comment->id.'">'.$cmntlike.'</span></a>
                        </div>
                    </div>
                </li>';           
        }        
        return response()->json(array("success"=>'success','html'=>$html));
    }
	public function commentLike($id,Request $request) {
		$like = PagePostCommentsLike::where('user_id',Auth::user()->id)->where('comment_id',$id)->first();
		$status='';
		if(!empty($like)){
			PagePostCommentsLike::find($like->id)->delete();
			$status='unlike';
		}
		else
		{
			$data=array(
                "user_id" => Auth::user()->id,
                "post_id" => $request->postId,
				"comment_id" => $id,
            );
            PagePostCommentsLike::create($data);
			$status='like';
		}
		$likecount = PagePostCommentsLike::where('post_id',$request->postId)->where('comment_id',$id)->count();
		return response()->json(array("success"=>'success','count'=>$likecount,'status'=>$status));
	}
	public function likepost($id,Request $request) {
      $like = PagePostLikes::where('user_id',Auth::user()->id)->where('post_id',$id)->first();
      
      if(!empty($like)){
        /* already like any post */
			$saved='0';
			if($like->is_like=='0'){ $saved='1'; }else{ $saved='0'; }
            $like->is_like = $saved;
            $like->update(); 
			$likecount = PagePostLikes::where('post_id',$id)->where('is_like',1)->count();
			return response()->json(array("success"=>'success','count'=>$likecount,'saved'=>$saved));
                     
        }else{
             /*new post like */
			 $saved='1';
            $data=array(
                "user_id" => Auth::user()->id,
                "post_id" => $id,
                "is_like" => $request->is_like,
            );
            PagePostLikes::create($data);
			$likecount = PagePostLikes::where('post_id',$id)->where('is_like',1)->count();
        	return response()->json(array("success"=>'success','count'=>$likecount,'saved'=>$saved));
        }
       // return response()->json(array("success"=>'success','count'=>$like->is_like));
    }
	
	public function savePost(Request $request)
    {
		$postid=$request->postid;
		$pageid=$request->pageid;
		$postsaved = PagePostSave::where('post_id',$postid)->where('user_id',Auth::user()->id)->first();
		if( !empty($postsaved) ) {
			PagePostSave::find($postsaved->id)->delete();
			return response()->json(array("success"=>'delsave'));
		}
		else
		{
			$array = array(
				"post_id" => $postid,
				"page_id" => $pageid,
				"user_id" => Auth::user()->id
			);
			PagePostSave::create($array);
			return response()->json(array("success"=>'success'));
		} 
    }
	public function DelPost(Request $request)
    {
		PagePostSave::where('post_id', $request->postid )->delete();
		PagePostLikes::where('post_id', $request->postid )->delete();
		PagePostComments::where('post_id', $request->postid )->delete();
		PagePostCommentsLike::where('post_id', $request->postid )->delete();
		PagePost::find( $request->postid )->delete();
        return response()->json(array("success"=>'success'));
	}
	public function viewGalleryList($page_id) {
        $galleryPic = [];
        $gallery = DB::select('select id, attachment_name, cover_photo from users_add_attachment where page_id = ? and cover_photo = 1 order by cover_order ASC', [$page_id]);
        if (!empty($gallery) && $gallery[0]->id > 0) {
            foreach ($gallery as $pic) {
                $filename = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR . $pic->attachment_name;
                $obj['id'] = $pic->id;
                $obj['cover'] = $pic->cover_photo;
                $obj['name'] = $pic->attachment_name;
                $obj['size'] = @filesize($filename);
                $galleryPic[] = $obj;
            }
        }
        //return Response::json($galleryPic);
        return $galleryPic;
    }


    public function savegallarypics(Request $request)
    {   
       /* echo "string"; print_r($request->all());*/
        $loggedinUser = Auth::user();
        $pageid=$request->pageid;
        $id = $request->imgId;
        $this->validate($request, [
            'galaryphoto' => 'required|dimensions:min_width=800,min_height=450',
        ]);
        $imageName = '';
        if ($request->hasFile('galaryphoto')) {
            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'page-cover-photo' . DIRECTORY_SEPARATOR;
            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'page-cover-photo' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('galaryphoto'), $file_upload_path, 1, $thumb_upload_path, '247', '266');
            $imageName = $image_upload['filename'];
        }
        
        $affected= PageAttachment::where(['user_id' =>$loggedinUser->id ,'page_id' => $pageid ,'id'=>$id])->update(["attachment_name" => $imageName]);
        if ($affected) {
            return Redirect::back()->with('success', 'Cover photo updated successfully.');
        } else {
            return Redirect::back()->with('error', 'Problem in updating cover photo.');
        } 
    }

	
	public function savepagecoverphoto(Request $request) {
       /* print_r($request->all());exit();*/
        if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
		$pageid=$request->page_id;
		$pageinfo = CompanyInformation::where('id', $pageid )->first();
        $loggedinUser = Auth::user();
        $cat = User::find($loggedinUser['id']);
        $user = User::where('id', Auth::user()->id)->first();
        $this->validate($request, [
            'coverphoto' => 'required|dimensions:min_width=800,min_height=450',
        ]);

        $imageName = '';
        if ($request->hasFile('coverphoto')) {
            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'page-cover-photo' . DIRECTORY_SEPARATOR;
            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'page-cover-photo' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('coverphoto'), $file_upload_path, 1, $thumb_upload_path, '247', '266');
            $imageName = $image_upload['filename'];
        }
		$array = array(
			"page_id" => $pageid,
			"user_id" => Auth::user()->id,
			"attachment_name" => $imageName,
			"attachment_status" => '1',
			"cover_photo" => "1",
		);
		$affected=PageAttachment::create($array);
        if ($affected) {
            return Redirect::back()->with('success', 'Cover photo updated successfully.');
        } else {
            return Redirect::back()->with('error', 'Problem in updating cover photo.');
        }         
    }
	
	public function editPageProPic(Request $request) {
        $validator = Validator::make($request->all(), [ 'profile_pic' => '|required|image|mimes:jpeg,jpg,png'], [ 'required' => 'The :attribute is required.']);
        if ($validator->fails()) {
            $errMsg = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            return Response::json($response);
        }
        // save profile pic
        $image = new Image();
        $request->profile_pic = '';
        if (!$request->hasFile('profile_pic')) {
            $response = array(
                'type' => 'danger',
                'msg' => 'No image found to upload',
            );
            return Response::json($response);
        }
        $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR;
        $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
        $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('profile_pic'), $file_upload_path, 1, $thumb_upload_path, '415', '354');
        //Store thumb of 150x150
        if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {
            mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);
        }
        $thumb_upload_path150 = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb150' . DIRECTORY_SEPARATOR;
        Image::make($request->file('profile_pic'))->resize(150, 150)->save($thumb_upload_path150 . $image_upload['filename']);
        // save new profile pic
		$page_id = $request->page_id;
        $userObj = CompanyInformation::find($page_id);
        // delete existing image
        if (isset($userObj->logo)) {
            @unlink(public_path('uploads/profile_pic/thumb150') . DIRECTORY_SEPARATOR . $userObj->logo);
            @unlink(public_path('uploads/profile_pic/thumb') . DIRECTORY_SEPARATOR . $userObj->logo);
            @unlink(public_path('uploads/profile_pic') . DIRECTORY_SEPARATOR . $userObj->logo);
        }
        $userObj->logo = $image_upload['filename'];
        if (!$userObj->save()) {
            $response = array(
                'type' => 'danger',
                'msg' => 'Some error while updating profile picture.',
            );
            return Response::json($response);
        } else {
            $image_path = asset('/images') . '/' . 'user.png';
            if ($userObj->profile_pic != '' && file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . $userObj->logo)) {
                $image_path = secure_asset('/public/uploads/profile_pic/thumb') . '/' . $userObj->logo;
            }
            $response = array(
                'type' => 'success',
                'msg' => 'Profile picture updated succesfully!',
                'returndata' => array(
                    'profile_pic' => $image_path
                )
            );
          return Redirect::back()->with('success', 'Profile picture updated succesfully!');
        }
    }
	
	public function editpagepost(Request $request) {
		$loggedinUser = Auth::user(); 
		$id = $request->id;
		$data = PagePost::find($id);      
		$count = count(explode("|",$data->images));        
		$countimg = $count-5;
		$getimages = explode("|",$data->images);
		$html = '<input type="hidden" name="postId" id="postId" value="'.$data->id.'">'; 
      	$html .='<figure>';
       	if($data->video != ''){
        	$html .= '<input id="video" name="video" type="file"/><a href="#" title="" data-toggle="modal" data-target="#img-comt"><video width="320" height="240" src="/public/uploads/gallery/'.$loggedinUser->id.'/video/'.$data->video.'" controls>Your browser does not support the video tag.</video></a>';
       }elseif($data->music != ''){
			$html .= '<input id="music_post" name="music_post" type="file"/><audio src="/public/uploads/gallery/'.$loggedinUser->id.'/music/'.$data->music.'" controls></audio>';
       }elseif( isset($getimages[4]) && !empty($getimages[4]) ){
			$html .=' <div class="img-bunch">
        		<input id="image_post" type="file" name="image_post[]" multiple  />
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">';
						if(isset($getimages[0])){
							$html .=' <figure>
								<i class="delimgpost5 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'" aria-hidden="true" title="Delete photo"></i>
                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[0].'" alt="">
                            	</a>
                        	</figure>';
						}
						if(isset($getimages[1])){
							$html .=' <figure>
								<i class="delimgpost5 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[1].'" aria-hidden="true" title="Delete photo"></i>
								<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[1].'" alt="">
                            	</a>
							</figure>';
						}
                    	$html .='</div>
                    	<div class="col-lg-6 col-md-6 col-sm-6">';
						if(isset($getimages[2])){
							$html .=' <figure>
								<i class="delimgpost5 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[2].'" aria-hidden="true" title="Delete photo"></i>
                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[2].'" alt="">
                            	</a>
                        	</figure>';
                       	}
						if(isset($getimages[3])){
                        	$html .='<figure>
                        		<i class="delimgpost5 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[3].'" aria-hidden="true" title="Delete photo"></i>
                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[3].'" alt="">
                            	</a>
                        	</figure>';
                       }
                       if(isset($getimages[4])){
							$html .='<figure>
                        		<i class="delimgpost5 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[4].'" aria-hidden="true" title="Delete photo"></i>
                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[4].'" alt="">
                            	</a>
                            	<div class="more-photos">
                                	<span>+'.$countimg.'</span>
                            	</div>
                        	</figure>';
						}
                    	$html .='</div>
                	</div>
				</div>
			</div>';
       }
	   elseif( isset($getimages[3]) && !empty($getimages[3]) ){
			$html .='<div class="img-bunch">
        		<input id="image_post" type="file" name="image_post[]" multiple />
					<div class="row">                   
						<div class="col-lg-12 col-md-12 col-sm-12">
                        	<figure>
								<i class="delimgpost4 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'" aria-hidden="true" title="Delete photo"></i>
                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                            		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[0].'" alt="">
                            	</a>
							</figure>
                    	</div>
                	</div>
                	<div class="row">   
                		<div class="col-lg-4 col-md-4 col-sm-4"> 
                			<figure>
                				<i class="delimgpost4 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[1].'" aria-hidden="true" title="Delete photo"></i>
                    			<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                    				<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[1].'" alt="" height="170">
                    			</a>
                			</figure>
                		</div>
                		<div class="col-lg-4 col-md-4 col-sm-4"> 
                			<figure>
                				<i class="delimgpost4 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[2].'" aria-hidden="true" title="Delete photo"></i>
                    			<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                    				<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[2].'" alt="" height="170">
                    			</a>
               				</figure>
						</div>
					 	<div class="col-lg-4 col-md-4 col-sm-4">  
                			<figure>
								<i class="delimgpost4 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[3].'" aria-hidden="true" title="Delete photo"></i>
                    			<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                    				<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[3].'" alt="" height="170">
                    			</a>
							</figure>
						</div>
                	</div>
			</div>';
       }
	   elseif( isset($getimages[2]) && !empty($getimages[2]) ){
			$html .='<div class="img-bunch">
				<input id="image_post" type="file" name="image_post[]" multiple  />
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">                
						<figure>
                     		<i class="delimgpost3 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[0].'" alt="" width="100" height="335">
							</a>
                    	</figure>
                	</div>
                	<div class="col-lg-6 col-md-6 col-sm-6">
                    	<figure>                    
                     		<i class="delimgpost3 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[1].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[1].'" alt="" width="100" height="165">
							</a>
                    	</figure>
                    	<figure>
                     		<i class="delimgpost3 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[2].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[2].'" alt="" width="100" height="165">
                        	</a>
                    	</figure>
                	</div>
                </div>
			</div>';
       }
	   elseif( isset($getimages[1]) && !empty($getimages[1]) ) {
			$html .='<div class="img-bunch-two">
				<input id="image_post" type="file" name="image_post[]" multiple  />
				<div class="row">
                	<div class="col-lg-6 col-md-6 col-sm-6">
                    	<figure>                   
                      		<i class="delimgpost2 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[0].'" alt="" height=200>
                        	</a>
                    	</figure>
                	</div>
                	<div class="col-lg-6 col-md-6 col-sm-6">
                    	<figure>
                    		<i class="delimgpost2 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[1].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[1].'" alt="" height=200>
                        	</a>
                    	</figure>
                	</div>
				</div>
			</div>';
       }
	   elseif( isset($getimages[0]) && !empty($getimages[0]) ){
			$html .='<div class="img-bunch">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<figure>
                    		<input id="image_post" type="file" name="image_post[]" multiple  />
                    		<i class="delimgpost1 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'" aria-hidden="true" title="Delete photo"></i>
                        	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                        		<span class="error" id="err_image_sign">
								<img src="/public/uploads/gallery/'.$loggedinUser->id.'/'.$getimages[0].'" alt="">
                        	</a>
						</figure>
					</div>
				</div>
			</div>';
       }
       $html .= '</figure>';
       $html .= '';  
       return response()->json(array("success"=>'success','html'=>$html,'data_textarea'=>$data->post_text));
	}
	public function pagePostupdate(Request $request) { 
		$id = $request->postId;        
		$data = PagePost::find($id);
		if($request->post_text_upd != ''){
        	$postText = $request->post_text_upd;
       	}else{
        	$postText = $data->post_text;
       	}
		$data->post_text = $postText;
        $loggedinUser = Auth::user();
		if($files=$request->file('image_post')) {            
			foreach($files as $file)
			{
                $name=$file->getClientOriginalName();               
                $images[]=$name;
                $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR, $name);
            }
            $imgpost = implode("|",$images);
            $imgpost = $data->images."|".$imgpost;  
        }else{
            $imgpost = $data->images;
        }
		if($request->hasFile('video')){
            $this->validate($request, [
                'video' => 'required|mimes:mp4,mov,ogg,qt | max:10000',            
            ]);
            $imagebanner = $request->file('video');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'video'.DIRECTORY_SEPARATOR, $name);
            $videopost = $name;
        }else{
            $videopost = $data->video;
        }
		if($request->hasFile('music_post')){
            $this->validate($request, [
                'video' => 'required|mimes:mp4,mov,ogg,qt | max:10000',            
            ]);
            $imagebanner = $request->file('music_post');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'music'.DIRECTORY_SEPARATOR, $name);
           $musicpost = $name;
        }else{
            $musicpost = $data->music;
        }
		$data->video = $videopost;
        $data->music = $musicpost;
        $data->images = $imgpost;
        $data->update();
        return redirect()->back()->with('success', 'Post updated succesfully!');
	}
	
	public function viewbusinessprofileofOther($user_name,$id)
	{
		$page_id = $id;
		$company = CompanyInformation::where('id',$id)->first();
        $compare = 'null';
        $loggedinUser = '';
		$loggedinUser = User::where('id',$company->user_id)->first();
		
       /* echo $loggedinUser; exit();*/
		// $loggedinUser = Auth::user();
        /*if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }*/
		$user_professional_detail = $terms = $business_details = $business_exp = $business_term = $business_spec = $business_service = $business_price = $gallery = [];
        $companyData = $serviceData = $servicePrice = $businessSpec = $services = $max_price = $min_price = [];
        $company['company_images'] = [];
		
		if(!empty($company)) {
            $userId = $company->user_id;
        	
            $business_details = BusinessCompanyDetail::where('cid', $page_id)->get();
            $business_details = isset($business_details[0]) ? $business_details[0] : [];

            $business_exp = BusinessExperience::where('cid', $page_id)->get();
            $business_exp = isset($business_exp[0]) ? $business_exp[0] : [];
            
            $business_term = BusinessTerms::where('cid', $page_id)->get();
            $business_term = isset($business_term[0]) ? $business_term[0] : [];

            $business_spec = BusinessService::where('cid', $page_id)->get();
            $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
       
            $gallery = $this->galleryList($userId);
           
            $serviceData = BusinessServices::where('cid', $page_id)->where('instant_booking', 1)->get();
            if (isset($serviceData)) {
                foreach ($serviceData as $service) {
                    $company = CompanyInformation::where('id', $service['cid'])->get();
                    $company = isset($company[0]) ? $company[0] : [];
                    if(!empty($company)) {
                    	$companyData[$company['id']][] = $company;
                    }

                    $price = BusinessPriceDetails::where('cid', $service['cid'])->get();
                    $price = isset($price[0]) ? $price[0] : [];
                    if(!empty($company)) {
                    	$servicePrice[$company['id']][] = $price;
                    }

                    $business_spec = BusinessService::where('cid', $service['cid'])->get();
                    $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
                    if(!empty($company)) {
                    	$businessSpec[$company['id']][] = $business_spec;
                    }
                }
            }
			
            if(isset($company['company_images']) && $company['company_images'] != null) {
            	$company['company_images'] = json_decode($company['company_images']);
            }
            $max_price = UserService::where('company_id', $company['id'])->max('price');
            $min_price = UserService::where('company_id', $company['id'])->min('price');

            $user_professional_detail = UserProfessionalDetail::where('company_id', $page_id)->first();
			
            $terms = [];
            if (!empty($user_professional_detail)) {
                $user_professional_detail->availability = $user_professional_detail->availability != null ? json_decode(json_decode($user_professional_detail->availability)) : null;
                $terms = BusinessTerms::where('userid', $user_professional_detail->user_id)->get();
            }
			$services = UserService::where('company_id', $company['id'])->get();
		    foreach ($services as $key2 => $value2) {
                $sport = Sports::where('id', $value2['sport'])->first();
                $value2['amenties'] = $sport['sport_name'];
            }
        }
		
		//$UserProfileDetail = $this->users->getUserProfileDetail($company['user_id'], array('professional_detail', 'history', 'education', 'certification', 'service'));
		//$PagePost = PagePost::limit(5)->orderBy('id','desc')->get();
		$UserProfileDetail ='';
		
		$PagePost = PagePost::where('page_id', $page_id)->limit(1)->orderBy('id','desc')->get();
		
        $postsave = [];
        $photos = [];
        $videos = [];
        if( $loggedinUser != ''){
            $postsave = PagePostSave::where('user_id',$loggedinUser->id)->orderBy('id','desc')->get();
            $photos = PagePost::select('images','user_id')->where('images','!=',null)->where('user_id',$loggedinUser->id)->orderBy('id','desc')->limit(10)->get();
            $videos = PagePost::select('video','user_id')->where('video','!=',null)->where('user_id',$loggedinUser->id)->orderBy('id','desc')->limit(1)->get();
        }
		
		
		$viewgallery = $this->viewPageGalleryList($page_id);
		
		$cart = []; $profile_posts=[]; $family=[];
        /*if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }*/
		return view('profiles.viewBusinessProfile', [
            'cart' => $cart,
			'company' => $company,
            'claim' =>'Claimed',
			'user_professional_detail' => $user_professional_detail,
			'services' => $services,
			'max_price' => $max_price,
			'min_price' => $min_price,
			'terms' => $terms,
			'business_exp' => $business_exp,
			'business_term' => $business_term,
			'business_spec' => $business_spec,
			'gallery' => $gallery,
			'serviceData' => $serviceData,
			'companyData' => $companyData,
			'servicePrice' => $servicePrice,
			'businessSpec' => $businessSpec,
			'UserProfileDetail' => $UserProfileDetail,
			'page_posts' => $PagePost,
			'family' =>$family,
			'postsave' => $postsave,
			'photos' => $photos,
            'videos' => $videos,
			'viewgallery' => $viewgallery,
        ]);
		//$view = 'profiles.viewBusinessProfile';
		//return view($view);
	}
	public function viewbprofiletimelineofOther($user_name,$id)
	{
		$page_id = $id;
		$company = CompanyInformation::where('id',$id)->first();
		$loggedinUser = User::where('id',$company->user_id)->first();
		
		$user_professional_detail = $terms = $business_details = $business_exp = $business_term = $business_spec = $business_service = $business_price = $gallery = [];
        $companyData = $serviceData = $servicePrice = $businessSpec = $services = $max_price = $min_price = [];
        $company['company_images'] = [];
		
		if(!empty($company)) {
            $userId = $company->user_id;
        
            $business_details = BusinessCompanyDetail::where('cid', $page_id)->get();
            $business_details = isset($business_details[0]) ? $business_details[0] : [];

            $business_exp = BusinessExperience::where('cid', $page_id)->get();
            $business_exp = isset($business_exp[0]) ? $business_exp[0] : [];
            
            $business_term = BusinessTerms::where('cid', $page_id)->get();
            $business_term = isset($business_term[0]) ? $business_term[0] : [];

            $business_spec = BusinessService::where('cid', $page_id)->get();
            $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
       
            $gallery = $this->galleryList($userId);
            
            $serviceData = BusinessServices::where('cid', $page_id)->where('instant_booking', 1)->get();
            if (isset($serviceData)) {
                foreach ($serviceData as $service) {
                    $company = CompanyInformation::where('id', $service['cid'])->get();
                    $company = isset($company[0]) ? $company[0] : [];
                    if(!empty($company)) {
                    	$companyData[$company['id']][] = $company;
                    }

                    $price = BusinessPriceDetails::where('cid', $service['cid'])->get();
                    $price = isset($price[0]) ? $price[0] : [];
                    if(!empty($company)) {
                    	$servicePrice[$company['id']][] = $price;
                    }

                    $business_spec = BusinessService::where('cid', $service['cid'])->get();
                    $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
                    if(!empty($company)) {
                    	$businessSpec[$company['id']][] = $business_spec;
                    }
                }
            }

            if(isset($company['company_images']) && $company['company_images'] != null) {
            	$company['company_images'] = json_decode($company['company_images']);
            }
            $max_price = UserService::where('company_id', $company['id'])->max('price');
            $min_price = UserService::where('company_id', $company['id'])->min('price');

            $user_professional_detail = UserProfessionalDetail::where('company_id', $page_id)->first();
            $terms = [];
            if (!empty($user_professional_detail)) {
                $user_professional_detail->availability = $user_professional_detail->availability != null ? json_decode(json_decode($user_professional_detail->availability)) : null;
                $terms = BusinessTerms::where('userid', $user_professional_detail->user_id)->get();
            }
			$services = UserService::where('company_id', $company['id'])->get();
		    foreach ($services as $key2 => $value2) {
                $sport = Sports::where('id', $value2['sport'])->first();
                $value2['amenties'] = $sport['sport_name'];
            }
        }
		$UserProfileDetail = $this->users->getUserProfileDetail($company['user_id'], array('professional_detail', 'history', 'education', 'certification', 'service'));
		//$PagePost = PagePost::limit(5)->orderBy('id','desc')->get();
		
		$PagePost = PagePost::where('page_id', $page_id)->orderBy('id','desc')->get();
		
		$postsave = PagePostSave::where('user_id',$loggedinUser->id)->orderBy('id','desc')->get();
		
		$cart = []; $profile_posts=[]; $family=[];
		
		return view('profiles.viewBusinessProfileTimeline', [
            'cart' => $cart,
			'company' => $company,
			'user_professional_detail' => $user_professional_detail,
			'services' => $services,
			'max_price' => $max_price,
			'min_price' => $min_price,
			'terms' => $terms,
			'business_exp' => $business_exp,
			'business_term' => $business_term,
			'business_spec' => $business_spec,
			'gallery' => $gallery,
			'serviceData' => $serviceData,
			'companyData' => $companyData,
			'servicePrice' => $servicePrice,
			'businessSpec' => $businessSpec,
			'UserProfileDetail' => $UserProfileDetail,
			'page_posts' => $PagePost,
			'family' =>$family,
			'postsave' => $postsave,
        ]);
	}
	
	public function galleryList($user_id) {
        $galleryPic = [];
        $gallery = DB::select('select id, attachment_name, cover_photo from users_add_attachment where user_id = ? order by id DESC', [$user_id]);
        if (!empty($gallery) && $gallery[0]->id > 0) {
            foreach ($gallery as $pic) {
                $filename = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . $user_id . DIRECTORY_SEPARATOR . $pic->attachment_name;
                $obj['id'] = $pic->id;
                $obj['cover'] = $pic->cover_photo;
                $obj['name'] = $pic->attachment_name;
                $obj['size'] = @filesize($filename);
                $galleryPic[] = $obj;
            }
        }
        //return Response::json($galleryPic);
        return $galleryPic;
    }
	public function viewPageGalleryList($page_id) {
        $galleryPic = [];
        $gallery = DB::select('select id, attachment_name, cover_photo from page_attachment where page_id = ? and cover_photo = 1 order by cover_order ASC', [$page_id]);
        if (!empty($gallery) && $gallery[0]->id > 0) {
            foreach ($gallery as $pic) {
                $filename = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'page-cover-photo' . DIRECTORY_SEPARATOR . $pic->attachment_name;
                $obj['id'] = $pic->id;
                $obj['cover'] = $pic->cover_photo;
                $obj['name'] = $pic->attachment_name;
                $obj['size'] = @filesize($filename);
                $galleryPic[] = $obj;
            }
        }
        //return Response::json($galleryPic);
        return $galleryPic;
    }
	public function followPage(Request $request) {
		$userid = $request->userid;
		$pageid = $request->pageid;
		$follow_id = 0;
		$followpro = PageLike::create([
        	'pageid' => $pageid,
            'follower_id' => $userid,
        ]);
		if($followpro){
			$noti = Notification::create([
				'user_id' => $pageid,
				'sender_id' => $userid,
				'type' => '1',
				'notification_type' => '1',
				'status' => 0,
			]);
			$response = array( 'type' => 'success' );
		}
		else{
			$response = array( 'type' => 'fail' );
		}
		return Response::json($response);
	}
	
	public function loadmorepagepostview(Request $request) {
		$page=$request->page;
		$userid=$request->userid;
		$pageid=$request->pageid;
        $limit = 5;
        $offset = $limit * $page;
		$AllFollowing = UserFollow::where('user_id', Auth::user()->id)->get();
		$followingarr=array();
		$followingarr[]=$userid;
		foreach($AllFollowing as $farr)
		{
			$followingarr[]=$farr->follower_id;
		}
	}
	public function Businessact_detail_filter(Request $request){
		$actoffer = $request->actoffer;
		$actloc = $request->actloc;
		$actfilmtype = $request->actfilmtype;
		$actfilgreatfor = $request->actfilgreatfor;
		$actfilparticipant=$request->actfilparticipant;
		$btype = $request->btype;
		$actdate = $request->actdate;
		$serviceid = $request->serviceid;
		$companyid = $request->companyid;
		
		$searchData = DB::table('business_services')->where('business_services.cid', $companyid)->where('business_services.is_active', 1)->where('business_services.id', '!=' , $serviceid);
		if( !empty($actoffer) )
		{
			$searchData->Where('sport_activity', $actoffer);
		}
		
		$activity = $searchData->get()->toArray();
		
		$activity = json_decode(json_encode($activity), true);
		$actbox='';
		if (!empty($activity)) { 
			foreach ($activity as  $act) {
				//echo $act['id'].'--'.$act['program_name'].'<br>';
				//DB::enableQueryLog();
				$servicePrice = BusinessPriceDetails::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
				//dd(\DB::getQueryLog());
				//print_r($servicePrice);
				$pay_session1=''; $pay_price1='';
				if( !empty($servicePrice) )
				{
					if(@$servicePrice[0]['pay_session']!=''){
						$pay_session1 = @$servicePrice[0]['pay_session'];
					}
					if(@$servicePrice[0]['pay_price']!=''){
						$pay_price1 = @$servicePrice[0]['pay_price'];
					}
				}
				$SpotsLeft = UserBookingDetail::where('sport', @$act['id'] )->count();
				if( !empty($act['group_size']) )
					$SpotsLeftdis = $act['group_size']-$SpotsLeft;
				$servicePr = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->toArray();
				$fun_para="'".$act['id']."',this.value,'".@$act['group_size']."','bookajax'";
				$actbox .= '<div class="text-book show-more-height" id="kickboxing'.$act['id'].'">
                    		<div class="row">
                        		<div class="col-md-6 col-lg-6">
                            		<div class="bookinfo-title">
										<h4>'.$act['program_name'].'</h4>
										<div class="bookinfo">
											<h4>Booking Info</h4>
										</div>
										<div class="booking-detail">
											<span>Friday, May 7th, 2021</span>
										</div>
										<div class="booking-detail">
											<span>09:00 am - 10:00 am</span>
										</div>
										<div class="booking-detail">
											<span>Service Type: </span> <span>'.@$act['service_type'].'</span>
										</div>
										<div class="booking-detail">
											<span>Duration: </span> <span>1 hour</span>
										</div>
										<div class="booking-detail">
											<span>Activity Location: </span> <span>'.@$act['activity_location'].'</span>
										</div>	
										<div class="booking-detail">
											<span>Spots Left: </span>
											<span><?php echo $SpotsLeftdis; ?>/'.@$act['group_size'].'</span>
										</div>
										<div class="booking-detail">
											<span>Service For: </span> <span>'.@$act['activity_for'].'</span>
										</div>
										<div class="booking-detail">
											<span>Age: </span> <span>'.@$act['age_range'].'</span>
										</div>
										<div class="booking-detail">
											<span>Language: </span> <span>-</span>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-lg-6">
                            		<div class="price-part">
										<h4>Choose Price Option</h4>
										<select id="selprice'.$act['id'].'" name="selprice'.$act['id'].'" class="price-select-control" onchange="changeactpr('.$fun_para.')">
                                            <option>Select Price Option</option>';
											if (!empty($servicePr)) { 
												foreach ($servicePr as  $pr) {
													$actbox .= '<option value="'.$pr['pay_session'].'~~'.$pr['pay_price'].'">
													'.$pr['pay_session'].' Sessions/$'.$pr['pay_price'].'</option>';
												}
											}
                                        $actbox .= '</select>
										<label>Booking Details</label>
										<div id="bookajax'.@$act["id"].'">
											<p>Price Option: '.$pay_session1 .' Session</p>
											<p>Participants: '.@$act['group_size'].'</p>
											<p>Total: $'.$pay_price1.'/person</p>
										</div>
                                        <form method="post" action="/addtocart">
											<input name="_token" type="hidden" value="'.csrf_token().'">
											<input type="hidden" name="pid" value="'.@$act["id"].'" size="2" />
											<input type="hidden" name="quantity" value="1" class="product-quantity" size="2" />
											<input type="hidden" name="price" id="pricebookajax'.$act['id'].'" value="'.$pay_price1.'" class="product-price" size="2" />
                                        	<input type="submit" value="Add to Cart" class="btn btn-addtocart mt-10" />
                                        </form>
									</div>
                                </div>
									
                            </div>
							<div class="viewmore_links">
                            	<a id="viewmore'.$act['id'].'" style="display:block">View More <img src="public/img/arrow-down.png" alt=""></a>
                                <a id="viewless'.$act['id'].'" style="display:none">View Less <img src="public/img/arrow-down.png" alt=""></a>
                            </div>
                        </div>';
						$actbox .='<script>
							$("#viewmore'.$act['id'].'").click(function () {
								$("#kickboxing'.$act['id'].'").addClass("intro");
								$("#viewless'.$act['id'].'").show();
								$("#viewmore'.$act['id'].'").hide();
							});
						   	$("#viewless'.$act['id'].'").click(function () {
								$("#kickboxing'.$act['id'].'").removeClass("intro");
								$("#viewless'.$act['id'].'").hide();
								$("#viewmore'.$act['id'].'").show();
							});
						</script>';
				
				
			}//for
		}//if
		echo $actbox;
		exit;
		
	}
	
	public function save_business_reviews(Request $request)
	{
		$page_id = $request->page_id;
		$rating = $request->rating;
		$review = $request->review;
		$title = $request->rtitle;
		
		$ip=$request->ip();
		$loggedId = Auth::user()->id;
		
		if($page_id!='' && $rating!='' && $review !='')
		{ 
			$chk=BusinessReview::where('user_id',Auth::user()->id)->where('page_id',$page_id)->first();
			if(empty($chk))
			{
				$images=array(); $imgpost='';
				if($request->TotalFiles > 0)
				{
					for ($x = 0; $x < $request->TotalFiles; $x++) 
					{
						if ($request->hasFile('rimg'.$x)) 
						{
							$file = $request->file('rimg'.$x);
							$name = date('His').$file->getClientOriginalName();
							$file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'review'.DIRECTORY_SEPARATOR,$name);
							if( !empty($name) ){
								$images[]=$name;
							}
						}
					}
					$imgpost = implode("|",$images);
				}
				
				$data=array(
				   	"rating"=>$rating,
				   	"title"=>$title,
					"review"=>$review,
					"images"=>$imgpost,
					"user_id" => Auth::user()->id,
					"page_id" => $page_id,
					"ip" => $ip,
				);
				BusinessReview::create($data);
				echo 'submitted';
				exit;
			}
			else
			{
				echo 'already';
				exit;
			}
		}
		else
		{
			echo 'addreview';
			exit;
		}
	}

    public function addbusinesscustomer() {
        return view('business.addbusinesscustomer');
    }

    public function add_business_customer(Request $request)
    {   
        /*print_r($request->all());exit;*/
        $comdata = CompanyInformation::where('company_name' , $request->Companyname)->first();

        if($request->add_status == 'yes'){
            $comdata =  '';
        }
        
        if($comdata != ''){
            $modelbody = '';
            if ($comdata->logo !="") {
                if (file_exists( public_path() . '/uploads/profile_pic/thumb/' . $comdata->logo)) {
                   $profilePic = url('/public/uploads/profile_pic/thumb/' . $comdata->logo);
                }else {
                   $profilePic = url('/public/images/service-nofound.jpg');
                }
            }else{ $profilePic = '/public/images/service-nofound.jpg'; }

            $address = '';
            if($comdata->address != ''){
                $address = $comdata->address.', ';
            }
            if($comdata->city != ''){
                $address .= $comdata->city.', ';
            }
            if($comdata->state != ''){
                $address .= $comdata->state.', ';
            }
            if($comdata->country != ''){
                $address .= $comdata->country.', ';
            }
            if($comdata->zip_code != ''){
                $address .= $comdata->zip_code;
            }

           /* $var = "matched";*/
            $var = '<div class="row">
                            <div class="col-md-4">
                                <div class="modal-imgs">
                                    <img src="'.$profilePic.'">
                                </div>
                            </div>
                            <div class="col-md-6 txt-space">
                                <div class="modal-img-title">
                                    <h4>'.$comdata->company_name.'</h4>
                                    <p>'.$address.'</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="modal-links">
                                    <h3>Write a Review</h3>
                                    <input type="file" name="rimg[]" id="files" class="hidden" multiple="multiple">
                                    <label for="files" style="text-decoration: underline;font-weight: 500">Add a Photo</label> 
                                </div>
                            </div>
                        </div>';
        } else{

            $images=array(); $imgpost='';
            if ($request->hasFile('rimg')) {
                if(count($request->rimg) > 0)
                {
                    foreach($request->rimg as $img){
                        $file = $img;
                       /* echo $file;exit;*/
                        $name = date('His').$file->getClientOriginalName();
                        $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'review'.DIRECTORY_SEPARATOR,$name);
                        if( !empty($name) ){
                            $images[]=$name;
                        }
                    }
                    $imgpost = implode("|",$images);
                }
            }
           

            $data['lat'] = $request->lat;
            $data['lon'] = $request->lon;

            $companyData = [
                "user_id" => null,
                "is_verified" => 0,
                "status"=>1,
                "business_added_by_cust_name" =>$request->business_added_by_cust_name,
                "first_name" => $request->Firstnameb,
                "last_name" => '',
                "email" => $request->email,
                "contact_number" => '',
                "logo" =>'',
                "company_name" => $request->Companyname,
                "address" => $request->Address,
                "state" => $request->State,
                "country" => $request->Country,
                "zip_code" => $request->ZipCode,
                "city" => $request->City,
                "ein_number" => '',
                "establishment_year" => '',
                "business_user_tag" => '',
                "about_company" => $request->Shortdescription,
                "short_description" => '',
                "embed_video" => '',
                "latitude" => $data['lat'],
                "longitude" => $data['lon'],
                'dba_business_name' => $request->Companyname,
                'additional_address' => $request->additional_address,
                'neighborhood' => $request->neighborhood,
                'business_phone' => $request->business_phone,
                'business_email' => $request->business_email,
                'business_website' => $request->business_website,
                'business_type' => $request->business_type,
            ];


            $data = CompanyInformation::create($companyData);

            $businessData = [
                "cid" => $data->id,
                "userid" => null,
                "Companyname" => $request->Companyname,
                "Address" => $request->Address,
                "City" => $request->City,
                "State" => $request->State,
                "ZipCode" => $request->ZipCode,
                "Country" => $request->Country,
                "EINnumber" => '',
                "Businessusername" => '',
                "Profilepic" => '',
                "Firstnameb" => $request->Firstnameb,
                "Lastnameb" => '',
                "Emailb" => $request->email,
                "Phonenumber" => '',
                "Aboutcompany" => $request->Shortdescription,
                "Shortdescription" => '',
                "EmbedVideo" => '',
                "showstep" => 2            
            ];

            BusinessCompanyDetail::create($businessData);

            $ip=$request->ip();

            

            $createbus_review = array(
                "rating"=>$request->rating,
                "title"=>$request->re_title,
                "review"=>$request->re_detail,
                "images"=> $imgpost,
                "user_id" => Auth::user()->id,
                "page_id" => $data->id,
                "ip" => $ip,
            );

            BusinessReview::create($createbus_review);
            $var = "added";
        }

        echo $var;
        exit;
    }
}