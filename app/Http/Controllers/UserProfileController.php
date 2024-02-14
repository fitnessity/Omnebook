<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Redirect,Validator,Input,Response,Auth,Hash,Image,File,View,Mail,Session,DB,Str;
use Illuminate\Support\Facades\{Gate,Log,Storage};
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\{PlanRepository,ProfessionalRepository,BookingRepository,UserRepository};
use App\{Fit_background_check_faq,Fit_vetted_business_faq,MailService,Evident,Evidents,Sports,ProfileSave,InstantForms,Languages,UserFavourite,UserFollow,UserFollower,Review,BusinessCompanyDetail,BusinessExperience,BusinessInformation,BusinessService,BusinessTerms,BusinessVerified,BusinessServices,BusinessServicesMap,BusinessPriceDetails,BusinessSubscriptionPlan,CompanyInformation,BusinessActivityScheduler,ProfileFollow,ProfileFav,InquiryBox,ProfileView,PostLike,PostReport,PostComment,PostCommentLike,PagePost,PagePostSave,Notification,BusinessServicesFavorite,UserBookingStatus,UserBookingDetail,ProfilePostViews,BusinessPostViews,StripePaymentMethod,BusinessClaim,Miscellaneous,User,UserEmploymentHistory,UserEducation,UserCertification,UserService,UserSecurityQuestion,UserMembership,UserProfessionalDetail,UserSkillAward,UserFamilyDetail,UserCustomerDetail,BusinessPriceDetailsAges,AddrStates,AddrCities,ProfilePost,Event,Transaction,Customer,SGMailService,CustomersDocuments};
use App\Repositories\SportsRepository;
use App\Mail\BusinessVerifyMail;
use Twilio\Rest\Client;
use App\Services\TwilioService;
use Twilio\TwiML\VoiceResponse;
use Carbon\Carbon;

use Request as resAll;

class UserProfileController extends Controller {

    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Plan Repository
     *
     * @var PlanRepository Object
     */
    protected $planRepository;

    /**
     * Professionals Repository
     *
     * @var professionals Object
     */
    protected $professionals;

    /**
     * sports Repository
     *
     * @var sports Object
     */
    protected $sports;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users, PlanRepository $planRepository, ProfessionalRepository $professionals, SportsRepository $sports, BookingRepository $bookings) {
        
        $this->middleware('auth', ['except' => ['getBladeDetail1','profileDetail', 'SendVerificationlinkCall', 'SendVerificationlinkMsg', 'makeCall', 'generateVoiceMessage', 'sendCustomMessage', 'getBladeDetail', 'newFUn', 'getBusinessClaim', 'getStateList', 'getCityList', 'familyProfileUpdate', 'submitFamilyForm', 'submitFamilyFormWithSkip', 'check', 'deleteCompany', 'submitFamilyForm1', 'skipFamilyForm1', 'getBusinessClaimDetaill', 'businessClaim', 'getLocationBusinessClaimDetaill', 'VerifySendVerificationlink', 'searchResultLocation', 'searchResultLocation1','profileView','sendmail','mailtemplate','about','postDetail','varify_email_for_claim_business','varify_code_to_claim_business','resendOpt']]);

        $this->bookings = $bookings;
        $this->planRepository = $planRepository;
        $this->users = $users;
        $this->professionals = $professionals;
        $this->sports = $sports;
        $this->arr = [];
        if (Auth::check()) {
            // View::share('languages', $languages);
            // View::share('UserProfileDetail', $UserProfileDetail);
            // View::share('sports_select', $sports_select);
            // View::share('sport_dd', $sport_dd + $sports_names);
            // View::share('businessType', $businessType);
            // View::share('activity', $activity);
            // View::share('programType', $programType);
            // View::share('programFor', $programFor);
            // View::share('teaching', $teaching);
            // View::share('numberOfPeople', $numberOfPeople);
            // View::share('ageRange', $ageRange);
            // View::share('expLevel', $expLevel);
            // View::share('serviceLocation', $serviceLocation);
            // View::share('pFocuses', $pFocuses);
            // View::share('duration', $duration);
            // View::share('specialDeals', $specialDeals);
            // View::share('servicePriceOption', $servicePriceOption);
            // View::share('allLanguages', $languages);
            // View::share('timeSlots', $timeSlots);
            // View::share('mydetails', $mydetails);
        }
    }
    public function about() { 
        return view('profiles.about');
        
    }

    public function editpost(Request $request) {
       $loggedinUser = Auth::user(); 
       $id = $request->id;
       $data = ProfilePost::find($id);      
       $count = count(explode("|",$data->images));        
       $countimg = $count-5;
       $getimages = explode("|",$data->images);

       $html = '<input type="hidden" name="postId" id="postId" value="'.$data->id.'">'; 
      $html .='<figure>';
       if($data->video != ''){
        $html .= '<input id="video" name="video" type="file"/><a href="#" title="" data-toggle="modal" data-target="#img-comt"><video width="320" height="240" src="/public/uploads/gallery/'.$loggedinUser->id.'/video/'.$data->video.'" controls>Your browser does not support the video tag.</video></a>';
       }elseif($data->music != ''){
        $html .= '<input id="music_post" name="music_post" type="file"/><audio src="/public/uploads/gallery/'.$loggedinUser->id.'/music/'.$data->music.'" controls></audio>';
       }elseif(isset($getimages[4])){
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
                </div>';
       }elseif(isset($getimages[3])){
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
                </div>';
       }elseif(isset($getimages[2])){
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
                </div>  ';
       }elseif(isset($getimages[1])){
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
       }elseif(isset($getimages[0])){
        $html .='<div class="img-bunch">
                 <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <figure>
                    <input id="image_post" type="file" name="image_post[]" multiple  />
                    <i class="delimgpost1 fa fa-trash-o" onclick="delPostImg(this);" data-delpostid="'.$data->id.'" data-imgname="'.$getimages[0].'"  aria-hidden="true" title="Delete photo"></i>
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

    public function loadmorepost(Request $request) {
        $page=$request->page;
        $userid=$request->userid;
        $limit = 5;
        $offset = $limit * $page;
        $AllFollowing = UserFollow::where('user_id', Auth::user()->id)->get();
        $followingarr=array();
        $followingarr[]=$userid;
        foreach($AllFollowing as $farr)
        {
            $followingarr[]=$farr->follower_id;
        }
        $followingarr1=implode(",",$followingarr);
        $f = explode(",", $followingarr1);
        $profile_posts = ProfilePost::whereIn('user_id', $f)->skip($offset)->take($limit)->orderBy('id','desc')->get();
        $html = '';
        $loggedinUser = Auth::user();
        foreach ($profile_posts as $profile_post) {
            $userData = User::where('id',$profile_post->user_id)->first();
            $postreport = PostReport::where('user_id',$userid)->where('post_id',$profile_post->id)->first();
            $html .= '<div class="central-meta item">
                                <div class="user-post">
                                    <div class="friend-info">';
                                        if(File::exists(public_path("/uploads/profile_pic/thumb/".$userData->profile_pic )))
                                        {
                                            $html .='<figure>
                                                <img src="/public/uploads/profile_pic/thumb/'.$userData->profile_pic.'" alt="Fitnessity">
                                            </figure>';
                                        }
                                        else
                                        {
                                            $html .= '<figure><div class="admin-img-text">';
                                                $pf=substr($userData->firstname, 0, 1).substr($userData->lastname, 0, 1);
                                            $html .='<p>'.$pf.'</p></div></figure>';
                                        }
                                        
                                        $html .='<div class="friend-name">                     
                                            <div class="more">
                                                <div class="more-post-optns"><i class="fa fa-ellipsis-h"></i>
                                                    <ul>';
                                                         if($loggedinUser->id == $profile_post->user_id){
                                                       $html .= ' <li><a id="'.$profile_post->id.'" class="editpopup" href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Edit Post</a></li>
                                                        <li><a href="/delPost/'.$profile_post->id.'"><i class="fa fa-trash-o"></i>Delete Post</a></li>';
                                                        }
                                                        
                                                        /*if(empty($postreport)){
                                                       $html .= ' <li class="bad-report"><a is_report="1" id="'.$profile_post->id.'" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Report Post</a></li>';
                                                        }elseif($postreport->report_post==1){
                                                        $html .= '<li class="bad-report"><a is_report="0" id="'.$profile_post->id.'" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Un Report Post</a></li>';

                                                         }elseif($postreport->report_post==0){
                                                         $html .= '<li class="bad-report"><a is_report="1" id="'.$profile_post->id.'" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Report Post</a></li>';
                                                         
                                                        }
                                                        
                                                        $html .= '<li><i class="fa fa-address-card-o"></i>Boost This Post</li>
                                                        <li><i class="fa fa-clock-o"></i>Schedule Post</li>
                                                        <li><i class="fa fa-wpexplorer"></i>Select as featured</li>
                                                        <li><i class="fa fa-bell-slash-o"></i>Turn off Notifications</li>';*/
                                                    $html .='</ul>
                                                </div>
                                            </div>
                                            
                                            <ins><a href="#" title="">'.ucfirst($userData->firstname).' '.ucfirst($userData->lastname).' </a> Post Album</ins>
                                            <span><i class="fa fa-globe"></i> published: '.date('F, j Y H:i:s A', strtotime($profile_post->created_at)).'</span>
                                        </div>
                                        <div class="post-meta">
                                            <input type="text" name="abc" data-emojiable="true" data-emoji-input="image" class="removepost" value="'.$profile_post->post_text.'" disabled="">';
                                        
                                            
                                            $userid = $profile_post->user_id;
                                            $count = count(explode("|",$profile_post->images));
                                            $countimg = $count-5;
                                            $getimages = explode("|",$profile_post->images);
                                           
                                            $html .= '<figure>';
                                                if(isset($profile_post->video)){
                                                $html .= ' <div class="img-bunch">
                                                     <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <figure>
                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                            <video controls class="thumb"  style="width: 100%;"  id="vedio'.$profile_post->id.'">
                                                                <source src="/public/uploads/gallery/'.$userid.'/video/'.$profile_post->video.'" type="video/mp4">
                                                            </video>
                                                            </a>
                                                        </figure>
                                                        <script type="text/javascript">
                                                            const vidajax = document.getElementById("vedio'.$profile_post->id.'");

                                                            ["playing"].forEach(t => 
                                                               vidajax.addEventListener(t, e => vediopostviews("'.$profile_post->id.'"))
                                                            );
                                                        </script>
                                                    </div>
                                                        </div>
                                                    </div>';
                                            }elseif(isset($profile_post->music)){   
                                               $html .= ' <div class="img-bunch">
                                                     <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <figure>
                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                            <audio src="/public/uploads/gallery/'.$userid.'/music/'.$profile_post->music.'" controls></audio>
                                                            </a>
                                                        </figure>
                                                    </div>
                                                        </div>
                                                    </div>';
                                            }elseif(isset($getimages[4]) && !empty($getimages[4]) ){

                                                 $html .= '<div class="img-bunch">
                                                     <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">';
                                                            if(isset($getimages[0])){
                                                           $html .= ' <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[0].'" alt="">
                                                                </a>
                                                            </figure>';
                                                            }if(isset($getimages[1])){
                                                            $html .= '<figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[1].'" alt="">
                                                                </a>
                                                            </figure>';
                                                        $html .= '</div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">';
                                                            }if(isset($getimages[2])){
                                                            $html .= '<figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[2].'" alt="">
                                                                </a>
                                                            </figure>';
                                                            }if(isset($getimages[3])){
                                                            $html .= '<figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[3].'" alt="">
                                                                </a>
                                                            </figure>';
                                                            }if(isset($getimages[4])){
                                                            $html .= '<figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[4].'" alt="">
                                                                </a>
                                                                <div class="more-photos">
                                                                    <span>+'.$countimg.'</span>
                                                                </div>
                                                            </figure>';
                                                        }
                                                        $html .= '</div>
                                                    </div>
                                                </div>';


                                            }elseif(isset($getimages[3]) && !empty($getimages[3]) ){
                                                   $html .= ' <div class="img-bunch">
                                                     <div class="row">                   
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[3].'" alt="">
                                                                </a>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                    <div class="row">   
                                                    <div class="col-lg-4 col-md-4 col-sm-4"> 
                                                    <figure>
                                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                        <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[2].'" alt="" height="170">
                                                        </a>
                                                    </figure>   
                                                    </div> 
                                                    <div class="col-lg-4 col-md-4 col-sm-4"> 
                                                    <figure>
                                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                        <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[1].'" alt="" height="170">
                                                        </a>
                                                    </figure>    
                                                    </div> 
                                                    <div class="col-lg-4 col-md-4 col-sm-4">  
                                                    <figure>
                                                        <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                        <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[0].'" alt="" height="170">
                                                        </a>
                                                    </figure>   
                                                    </div> 
                                                    </div>';

                                                    }elseif(isset($getimages[2]) && !empty($getimages[2])){
                                                    $html .= '<div class="img-bunch">
                                                     <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <figure>
                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                            <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[2].'" alt="" width="100" height="335">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <figure>
                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                            <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[1].'" alt="" width="100" height="165">
                                                            </a>
                                                        </figure>
                                                        <figure>
                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                            <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[0].'" alt="" width="100" height="165">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                    </div>
                                                    </div> ';             

                                                    }elseif(isset($getimages[1]) && !empty($getimages[1]) ){
                                                    $html .= '<div class="img-bunch-two">
                                                     <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <figure>
                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                            <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[1].'" alt="">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <figure>
                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                            <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[0].'" alt="">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                        </div>
                                                    </div>';

                                                    }elseif(isset($getimages[0]) && !empty($getimages[0]) ){
                                                    $html .= '<div class="img-bunch">
                                                     <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <figure>
                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                            <img src="/public/uploads/gallery/'.$userid.'/'.$getimages[0].'" alt="">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                        </div>
                                                    </div>';
                                                }
                                                $activethumblike='';
                                                $profile_posts_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->count();
                                                 $likemore = $profile_posts_like-2;
                                                $loginuser_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id',$loggedinUser->id)->first();
                                                $seconduser_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->first();

                                                 $profile_posts_comment = PostComment::where('post_id',$profile_post->id)->count();
                                               if(!empty($loginuser_like)){
                                                   $activethumblike='activethumblike';
                                               }
                                               $html .= ' <ul class="like-dislike" id="ulike-dislike'.$profile_post->id.'">
                                                    <li><a class="bg-purple" href="#" title="Save to Pin Post">
                                                        <i class="thumbtrack fas fa-thumbtack"></i>
                                                        </a></li>
                                                    <li><a class="bg-blue '.$activethumblike.'" href="javascript:void(0);" title="Like Post"><i id="'.$profile_post->id.'" is_like="1" class="thumbup thumblike fas fa-thumbs-up"></i></a></li>
                                                    <li><a class="bg-red" href="javascript:void(0);" title="dislike Post"><i id="'.$profile_post->id.'" is_like="0" class="thumpdown thumblike fas fa-thumbs-down"></i></i></a></li>
                                                </ul>
                                            </figure>   
                                            <div class="we-video-info">';
                                                $html .= '<ul class ="postinfoulajax'.$profile_post->id.'">';
                                                 if(isset($profile_post->video)){
                                                    $ppvcntajax = ProfilePostViews::where('post_id' , $profile_post->id)->count();
                                                     $html .= '<li>
                                                        <span class="views" title="views">
                                                            <i class="eyeview fas fa-eye"></i>
                                                            <ins>'.$ppvcntajax.'</ins>
                                                        </span>
                                                    </li>';
                                                }
                                                $html .= '<li>
                                                        <div class="likes heart" title="Like/Dislike">❤ <span id="likecount'.$profile_post->id.'">'.$profile_posts_like.'</span></div>
                                                    </li>
                                                    <li>
                                                        <span class="comment" title="Comments">
                                                            <i class="commentdots fas fa-comment-dots"></i>
                                                            <ins>'.$profile_posts_comment.'</ins>
                                                        </span>
                                                    </li>
                                                </ul>';
                                                 
                                                $html .= '<div class="users-thumb-list" id="users-thumb-list'.$profile_post->id.'">';
                                                $profile_posts_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->count();
                                                if($profile_posts_like>0){
                                                if(!empty($loginuser_like)){
                                                   $html.='<a data-toggle="tooltip" title="Anderw" href="#">
                                                        <img alt="" src="/public/uploads/profile_pic/thumb/'.$userid.'" height="32" width="32">  
                                                    </a>';
                                                    }
                                                    $profile_posts_all = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->limit(4)->get();
                                                if(isset($profile_posts_all[0])){
                                                    $seconduser = User::find($profile_posts_all[0]->user_id);
                                                  $html.='<a data-toggle="tooltip" title="frank" href="#">';
                                                    if(File::exists(public_path("/uploads/profile_pic/thumb/".$seconduser->profile_pic ))){ 
                                                        $html.='<img alt="" src="'.url('/public/uploads/profile_pic/thumb/'.$seconduser->profile_pic).'" height="32" width="32">';
                                                    }else{ 
                                                        $pf=substr($seconduser->firstname, 0, 1).substr($seconduser->lastname, 0, 1);
                                                        $html.='<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                    }  
                                                    $html.='</a>';
                                                 }
                                                  if(isset($profile_posts_all[1])){
                                                    $thirduser = User::find($profile_posts_all[1]->user_id);
                                                   $html.=' <a data-toggle="tooltip" title="Sara" href="#">
                                                        <img alt="" src="/public/uploads/profile_pic/thumb/'.$thirduser->profile_pic.'" height="32" width="32">  
                                                    </a>';
                                                  }
                                                  if(isset($profile_posts_all[2])){
                                                    $fourthuser = User::find($profile_posts_all[2]->user_id);
                                                  $html.=' <a data-toggle="tooltip" titl
                                                  e="Amy" href="#">
                                                        <img alt="" src="/public/uploads/profile_pic/thumb/'.$fourthuser->profile_pic.'" height="32" width="32">  
                                                    </a>';
                                                }
                                                if(isset($profile_posts_all[3])){
                                                    $fifthuser = User::find($profile_posts_all[3]->user_id);
                                                 $html.='<a data-toggle="tooltip" title="Ema" href="#">
                                                        <img alt="" src="/public/uploads/profile_pic/thumb/'.$fifthuser->profile_pic.'" height="32" width="32">  
                                                    </a>';
                                                }
                                                  $html.='  <span><strong>';
                                                  if(!empty($loginuser_like)){
                                                 $html .='You';
                                                }
                                                  $html .='</strong>';
                                                  if(!empty($seconduser_like)){
                                                    $secondusername = User::where('id',$seconduser_like->user_id)->first();
                                                 $html .=' , <b>'.$secondusername->username.'</b>';
                                                 }
                                                 if($profile_posts_like>2){
                                                 $html .=' And <a href="#" title="">'.$likemore.'+ More</a>';
                                                }
                                                 $html .=' Liked</span>
                                                ';
                                                }
                                           $html.='</div></div>
                                        </div>
                                        
                                        <div class="coment-area" style="display: block;">
                                            <ul class="we-comet">';
                                        $comments = PostComment::where('post_id',$profile_post->id)->limit(2)->get();
                                        
                                        if(count($comments) > 0){
                                        foreach($comments as $comment){
                                         $username = User::find($comment->user_id);
                                         $cmntlike = PostCommentLike::where('comment_id', $comment->id)->count();
                                         $cmntUlike = PostCommentLike::where('comment_id',$comment->id)->where('user_id',$userid)->count();
                                         $commentLiked='';
                                         if($cmntUlike>0){ $commentLiked='commentLiked'; }
                                               $html .='<li class="commentappendremove">
                                                    <div class="comet-avatar">';
                                                    if(File::exists(public_path("/uploads/profile_pic/thumb/".$username->profile_pic ))){ 
                                                        $html .='<img src="'.url('/public/uploads/profile_pic/thumb/'.$username->profile_pic).'" alt="pic">';
                                                    }else{ 
                                                        $pf=substr($username->firstname, 0, 1).substr($username->lastname, 0, 1);
                                                            $html .='<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                    } 
                                                    $html .='
                                                    </div>
                                                    <div class="we-comment">
                                                        <h5><a href="javascript:void(0);" title="">'.$username->firstname.' '.$username->lastname.'</a></h5>
                                                        <p>'.$comment->comment.'</p>
                                                        <div class="inline-itms" id="commentlikediv'.$comment->id.'">
                                                            <span>'.$comment->created_at->diffForHumans().'</span>
                                                            
                                                            <a href="javascript:void(0);" class="commentlike" id="'.$comment->id.'" post-id="'.$profile_post->id.'" ><i class="fa fa-heart '.$commentLiked.'" id="comlikei'.$comment->id.'"></i><span id="comlikecounter'.$comment->id.'">'.$cmntlike.'</span></a>
                                                        </div>
                                                    </div>
                                                </li>';
                                               }
                                           }

                                               $html.='<li class="commentappend'.$profile_post->id.'"></li>';
                                                $html.='
                                                <input type="hidden" name="commentdisplay" id="commentdisplay" value="5">';
                                                if(count($comments) > 2){
                                                    $html.='<li>
                                                        <a id="'.$profile_post->id.'" href="javascript:void(0);" title="" class="showcomments showmore underline">more comments+</a>
                                                    </li>';
                                                }
                                            
                                                $html.='<li class="post-comment"><div class="comet-avatar">';
                                                    if(File::exists(public_path("/uploads/profile_pic/thumb/".$loggedinUser->profile_pic ))){
                                                        $html.= '<img src="/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic.'" alt="pic">';
                                                    }else{ 
                                                        $pf=substr($loggedinUser->firstname, 0, 1).substr($loggedinUser->lastname, 0, 1);
                                                        $html.= '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                    }
                                                   $html.='</div>';
                                                   $html.='<div class="post-comt-box">
                                                        <form method="post" id="commentfrm">
                                                            <textarea placeholder="Post your comment" name="comment" id="comment'.$profile_post->id.'"></textarea>
                                                            <span class="error" id="err_comment'.$profile_post->id.'"></span>
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
                                                            <button style="background-color: #ef3e46" id="'.$profile_post->id.'" class="postcomment" type="button">Post</button>
                                                        </form> 
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>';
        }
        return response()->json(array("success"=>'success','html'=>$html));   
    }

    public function updateprofilepostviewcount(Request $request){
        $ppviews =  ProfilePostViews::where(['post_id'=>$request->post_id,'user_id' => Auth::user()->id])->first();
        if( $ppviews == ''){
            $data=array(
                "user_id" => Auth::user()->id,
                "post_id" => $request->post_id,
            );
           /* print_r($data);*/
            ProfilePostViews::create($data);
        }
    }

    public function reportPost($id,Request $request) {
        $report = PostReport::where('user_id',Auth::user()->id)->where('post_id',$id)->first();
        if(!empty($report)){
            $report->report_post = $request->is_report;
            $report->update();
        }else{
            $data=array(
                "user_id" => Auth::user()->id,
                "post_id" => $id,
                "report_post" => $request->is_report,
            );
            PostReport::create($data);
        }
        
        return response()->json(array("success"=>'success'));
    }

    public function postcomment($id,Request $request) { 
       $data=array(
            "user_id" => Auth::user()->id,
            "post_id" => $id,
            "comment" => $request->comment,
       );
        $data = PostComment::create($data);
        $comment =  PostComment::where('id',$data->id)->first();
        $username = User::find($comment->user_id);
        $cmntlike = PostCommentLike::where('comment_id', $comment->id)->count();
        $cmntUlike = PostCommentLike::where('comment_id',$comment->id)->where('user_id',Auth::user()->id)->count();
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
                    $html .= '</div>
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

    public function postDetail($id) {
        //$id = $request->id;
        $profile_post = ProfilePost::find($id); 
        
        /*echo "<pre>";
        print_r($profile_post);
        exit;*/
        return view('profiles.postDetail',compact('profile_post'));
    }

    public function showcomments($id,Request $request) { 
        $commentdisplay = $request->commentdisplay; 
        
        /*if($commentdisplay == 5){
            $commentData =  PostComment::skip(2)->take($commentdisplay)->get();
        }else{           
            $commentData =  PostComment::limit($commentdisplay)->get();
        } */
        if($commentdisplay == 5){
            $commentdisplay = $commentdisplay+2;
            $commentData =  PostComment::where('post_id',$id)->limit($commentdisplay)->get();
        }else{           
            $commentData =  PostComment::where('post_id',$id)->limit($commentdisplay)->get();
        }
        $html ='';
        foreach ($commentData as $comment) {
            $username = User::find($comment->user_id);
            $cmntlike = PostCommentLike::where('comment_id', $comment->id)->count();
            $cmntUlike = PostCommentLike::where('comment_id',$comment->id)->where('user_id',Auth::user()->id)->count();
            $commentLiked='';
            if($cmntUlike>0){ $commentLiked='commentLiked'; }
            $html .= '<li>
                    <div class="comet-avatar">';
                        if(File::exists(public_path("/uploads/profile_pic/thumb/".$username->profile_pic ))){
                            $html.= '<img src="/public/uploads/profile_pic/thumb/'.$username->profile_pic.'" alt="pic">';
                        }else{ 
                            $pf=substr($username->firstname, 0, 1).substr($username->lastname, 0, 1);
                            $html.= '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                        }
                    $html .= '</div>
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

    public function likepost($id,Request $request) {
      $like = PostLike::where('user_id',Auth::user()->id)->where('post_id',$id)->first();
      
      if(!empty($like)){
        
        /* already like any post */
            $like->is_like = $request->is_like;
            $like->update();  
                     
        }else{
            /* new post like */
            $data=array(
                "user_id" => Auth::user()->id,
                "post_id" => $id,
                "is_like" => $request->is_like,
            );
            PostLike::create($data);
        }
        $likecount = PostLike::where('post_id',$id)->where('is_like',1)->count();
        return response()->json(array("success"=>'success','count'=>$likecount));    
    }

    public function likecomment($id,Request $request) {
        $like = PostCommentLike::where('user_id',Auth::user()->id)->where('comment_id',$id)->first();
        $status='';
        if(!empty($like)){
            PostCommentLike::find($like->id)->delete();
            $status='unlike';
        }
        else
        {
            $data=array(
                "user_id" => Auth::user()->id,
                "post_id" => $request->postId,
                "comment_id" => $id,
            );
            PostCommentLike::create($data);
            $status='like';
        }
        $likecount = PostCommentLike::where('post_id',$request->postId)->where('comment_id',$id)->count();
        return response()->json(array("success"=>'success','count'=>$likecount,'status'=>$status));
    }

    public function deleteimagepost($id,Request $request) {
      $imgname = $request->imgname;
      $data = ProfilePost::find($id);      
      $images = explode("|", $data->images);
      if(in_array($imgname, $images)){
        $key = array_search ($imgname, $images);
        unset($images[$key]);
        $imgpost = implode("|",$images);
        $data->images = $imgpost;
        $data->update();
        return response()->json(array("success"=>'success'));
      }
    }

    public function profilePostupdate(Request $request) { 
        $id = $request->postId;        
       $data = ProfilePost::find($id); 
       if($request->post_text_upd != ''){
        $postText = $request->post_text_upd;
       }else{
        $postText = $data->post_text;
       }    
        $data->post_text = $postText;
        $loggedinUser = Auth::user();
       if($files=$request->file('image_post')) {
            foreach($files as $file){
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
            /* max 10 mb */
            $this->validate($request, [
                'video' => 'required|mimes:mp4,mov,ogg,qt | max:10000',            
            ]);

            $imagebanner = $request->file('video');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'video'.DIRECTORY_SEPARATOR, $name); 
           /*if (isset($data->video)) {
             $bannerImage = public_path(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'video'.DIRECTORY_SEPARATOR,$data->video);
             unlink($bannerImage);
           }*/
           $videopost = $name;
        }else{
            $videopost = $data->video;
        }

        if($request->hasFile('music_post')){    
            /* max 10 mb */
            /*$this->validate($request, [
                'video' => 'required|mimes:mp4,mov,ogg,qt | max:10000',            
            ]);*/

            $imagebanner = $request->file('music_post');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'music'.DIRECTORY_SEPARATOR, $name); 
           /*if (isset($data->video)) {
             $bannerImage = public_path(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'video'.DIRECTORY_SEPARATOR,$data->video);
             unlink($bannerImage);
           }*/
           $musicpost = $name;
        }else{
            $musicpost = $data->music;
        }

        $data->video = $videopost;
        $data->music = $musicpost;
        $data->images = $imgpost;
        $data->update();
         
        return redirect()->route('profile-viewProfile')->with('success', 'Post updated succesfully! ');
    }

    public function delPost($id) { 
        ProfileSave::where('profile_id',$id)->delete();
        PostLike::where('post_id',$id)->delete();
        PostComment::where('post_id',$id)->delete();
        PostCommentLike::where('post_id',$id)->delete();     
        ProfilePost::find($id)->delete();
        return redirect()->route('profile-viewProfile')->with('success', 'Post deleted succesfully! ');
    }

    public function profilesavePost(Request $request)
    {
        $pid=$request->postid;
        $loggedinUser = Auth::user();
        $array = array(
            "profile_id" => $pid,
            "user_id" => Auth::user()->id
        );
        ProfileSave::create($array);
        return response()->json(array("success"=>'success'));
       // return redirect()->route('profile-viewProfile')->with('success', 'Post save succesfully! ');
    }

    public function RemovesavePost($pid,$uid)
    {
        $del=ProfileSave::where('user_id', Auth::user()->id)->where('profile_id', $pid)->delete();
        return redirect()->route('profile-viewProfile')->with('success', 'Post removed succesfully! ');
    }

    public function profilePost(Request $request) {
        $images=array();
        $loggedinUser = Auth::user(); 
               
       // if($files=$request->file('image_post')) {            
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
            );
            ProfilePost::create($data);
        }
        else if($request->hasFile('video')){    
            /* max 10 mb */
            /*$this->validate($request, [
                'video' => 'required|mimes:mp4,mov,ogg,qt | max:10000',            
            ]);*/
            $imagebanner = $request->file('video');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'video'.DIRECTORY_SEPARATOR, $name); 
            $data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "video" => $name,
            );
            ProfilePost::create($data);
        }
        else if($request->hasFile('music_post')){ 
            $imagebanner = $request->file('music_post');        
            $name = $imagebanner->getClientOriginalName();        
            $imagebanner->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR.'music'.DIRECTORY_SEPARATOR, $name); 
            $data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "music" => $name,
            );
           ProfilePost::create($data);
        }
        else if( $request->selfieimg !='' ){ 
            $data = $request->selfieimg;
            
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $imgname= 'selfie_image'.date('dmYHis');
            
            file_put_contents(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id.DIRECTORY_SEPARATOR.$imgname.'.png', $data);
            
            //echo 'call'.$loggedinUser->id; exit;
            
            $data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
                "images" => $imgname.'.png',
            );
            ProfilePost::create($data);
        }
        else if($request->post_text != '' && !$request->hasFile('music_post') && !$request->hasFile('video') && !$request->hasFile('image_post') && !$request->selfieimg ){
            $data=array(
                "post_text" => $request->post_text,
                "user_id" => $loggedinUser->id,
            );
           ProfilePost::create($data);
        }
        return redirect()->route('profile-viewProfile')->with('success', 'Post created succesfully!');
    }
  

    public static function inquirySubmit(Request $request)
    {
        $all = $request->all();

        InquiryBox::create($all);        

         $response = array(
                'type' => 'success',
                'msg' => 'Your inquiry submitted successfully',
               
            );
            
          return Redirect::back()->with('success', 'Your inquiry submitted successfully');


    }
    public static function editUsername(Request $request)
    {        
       $username = $request->username;
       $name = explode(" ", $username);
       $user = User::find( Auth::user()->id);
       $user->firstname = $name[0];
       $user->lastname = $name[1];
       $user->update();

       return Redirect::back()->with('success', 'Name updated succesfully!');

    }
    
    public static function savereviews(Request $request)
    {
            $companyId = $request->companyId;
            $userId = CompanyInformation::find($companyId);           
            $array = array(
            "rating" => $request->rating,
            "review" => $request->review,
            "reviewby_userid" => Auth::user()->id,
            "reviewfor_userid" => $userId->user_id,
        );
        Review::create($array);
        return redirect()->route('companypage',$companyId);     

    }

    public static function signupVerification()

    {

        $user = User::findOrFail(578);
        
        return view('emails.signup-verification', ['user' => $user]);
        

    }
    
    public function manojTest(Request $request) {
        die('createNewBusinessProfile');
    }
    
    public function editBusinessProfile(Request $request) {
        if($request->btnedit == 'Edit') {
            User::where('id', Auth::user()->id)->update(['bstep' => 2, 'cid' => $request->cid, 'serviceid' => $request->serviceid]);
            return redirect()->route('createNewBusinessProfile');
        }
        
        if($request->btnview == 'View') {
           // return redirect('/pcompany/view/'.$request->cid);
           return redirect('/profile/viewbusinessProfile/'.$request->cid);
        }
        
        if($request->btncreateservice == 'Create Service') {
            User::where('id', Auth::user()->id)->update(['bstep' => 71, 'cid' => $request->cid, 'serviceid' => 0]);
            return redirect()->route('createNewBusinessProfile');
        }
        
        if($request->btnmanageservice == 'Manage Service') {
            return redirect('/business/'.$request->cid.'/services');
        }
    }
    
    
    public function editBusinessService(Request $request) {
        //print_r($request->all());exit;
        $businessData = [
            'bstep' => 72,
            'cid' => $request->cid,
            'serviceid' => $request->serviceid,
            'servicetype' => $request->service_type
        ];
        
        User::where('id', Auth::user()->id)->update($businessData);
        if($request->btnedit == 'Edit') {
            return redirect()->route('createNewBusinessProfile');
        }
        
        if($request->btnview == 'View') {
            return redirect('/pcompany/view/'.$request->cid);
        }
    }

    public function createNewBusinessProfile(Request $request) {
        if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
    
        $companyId = !empty(Auth::user()->cid) ? Auth::user()->cid : "";
        
        $serviceId = !empty(Auth::user()->serviceid) ? Auth::user()->serviceid : "";
        $loggedinUser = Auth::user();
        $UserProfileDetail = [];
       
        $sports_names = $this->sports->getAllSportsNames();
        $approve = []; //Evidents::where('user_id', $loggedinUser['id'])->get();
        $serviceType = Miscellaneous::businessType();
        $programType = Miscellaneous::programType();
        $programFor = Miscellaneous::programFor();
        $numberOfPeople = Miscellaneous::numberOfPeople();
        $ageRange = Miscellaneous::ageRange();
        $expLevel = Miscellaneous::expLevel();
        $serviceLocation = Miscellaneous::serviceLocation();
        $pFocuses = Miscellaneous::pFocuses();
        $duration = Miscellaneous::duration();
        $servicePriceOption = Miscellaneous::servicePriceOption();
        $specialDeals = Miscellaneous::specialDeals();
        
        $family = []; 
        
        $companyservice = $company_info = $business_details = $business_exp = $business_term = $business_spec = $business_veri = $business_service = $business_price = $business_plan = $business_price_ages =[];
        $business_activity = array();
        if(!empty($companyId)) {
        $company_info = CompanyInformation::where('id', $companyId)->get();
        $company_info = isset($company_info[0]) ? $company_info[0] : [];

        $business_details = BusinessCompanyDetail::where('cid', $companyId)->get();
        $business_details = isset($business_details[0]) ? $business_details[0] : [];
        
        $business_exp = BusinessExperience::where('cid', $companyId)->get();
        $business_exp = isset($business_exp[0]) ? $business_exp[0] : [];
        
        $business_term = BusinessTerms::where('cid', $companyId)->get();
        $business_term = isset($business_term[0]) ? $business_term[0] : [];
        
        $business_spec = BusinessService::where('cid', $companyId)->get();
        $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
        
        $business_veri = BusinessVerified::where('cid', $companyId)->get();
        $business_veri = isset($business_veri[0]) ? $business_veri[0] : [];
        
        $business_service = BusinessServices::where('cid', $companyId)->where('id', $serviceId)->get();
        $business_service = isset($business_service[0]) ? $business_service[0] : [];
      
        if(!empty($business_service)){
            $business_price = BusinessPriceDetails::where('cid', $companyId)->where('serviceid', $business_service['id'])->get();
            $business_price = isset($business_price) ? $business_price : [];

            $business_price_ages = BusinessPriceDetailsAges::where('cid', $companyId)->where('serviceid', $business_service['id'])->get();
            $business_price_ages = isset($business_price_ages) ? $business_price_ages : [];
            
            $business_activity = BusinessActivityScheduler::where('cid', $companyId)->where('serviceid', $business_service['id'])->get();
            $business_activity = isset($business_activity) ? $business_activity : [];
        }
        else
        {
            $business_price = []; $business_activity=[];$business_price_ages=[];
        }
        
        $business_plan = BusinessSubscriptionPlan::where('id', 1)->get();
        $business_plan = isset($business_plan[0]) ? $business_plan[0] : [];
        
        $companyservice = BusinessServices::where('userid', Auth::user()->id)->where('cid', $companyId)->orderBy('id', 'DESC')->get();
        }
        //dd($companyservice);
        //dd(json_encode(@explode(',', $business_spec->languages)));
        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }

        $state = AddrStates::where('id', $user->state)->first();

        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
            ;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }

        $UserProfileDetail['country'] = $user->country;
        $firstCompany = CompanyInformation::where('user_id', Auth::user()->id)->first();
        $companies = CompanyInformation::where('user_id', Auth::user()->id)->get();

        $view = 'profiles.createNewBusinessProfile';
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        return view($view, [
            'cart' => $cart,
            'UserProfileDetail' => $UserProfileDetail,
            'firstCompany' => $firstCompany,
            'countries' => $this->users->getCountriesList(),
            'states' => $this->users->getStateList($UserProfileDetail['country']),
            'cities' => $this->users->getCityList($UserProfileDetail['state']),
            'phonecode' => Miscellaneous::getPhoneCode(),
            'sports_names' => $sports_names,
            'serviceType' => $serviceType,
            'programType' => $programType,
            'programFor' => $programFor,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "PROFILE",
            'approve' => $approve,
            'family' => $family,
            'company_info' => $company_info,
            'business_details' => $business_details,
            'business_exp' => $business_exp,
            'business_term' => $business_term,
            'business_spec' => $business_spec,
            'business_veri' => $business_veri,
            'business_service' => $business_service,
            'companyservice' => $companyservice,
            'business_activity' => $business_activity,
            'business_price' => $business_price,
            'business_price_ages' => $business_price_ages,
            'business_plan' => $business_plan,
            'companies' => $companies,
        ]);
    }

    public function welcomeBusinessProfile(Request $request) {


        if(Session::has('business_welcome')){
            Session::forget('business_welcome');
        }
        $company = CompanyInformation::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $user = User::where('id', Auth::user()->id)->first();
        //$user->role = 'business';
        $user->role = 'customer';
        // $user->is_upgrade = 1;
        $user->save();
        $request->session()->forget('companyId');
        $firstCompany = CompanyInformation::where('user_id', Auth::user()->id)->orderBy('id', 'ASC')->first();
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        

        /*
            $company = CompanyInformation::where('id', Auth::user()->cid)->first();        
            
            if($company){

    	        if($company->charges_enabled == '0'){
    		        $stripe_client = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
    		        
    		        
    				try{
    					$stripe_account = $stripe_client->accounts->retrieve(
    					  	$company->stripe_connect_id,
    					  	[]
    			  		);
    			  		
    			  		if($stripe_account->charges_enabled){
    			  			$company->charges_enabled = 1;
    				  		$company->save();	

    				  		return redirect()->route('createNewBusinessProfile');				  		
    			  		}

    		
    			  	}catch(\Stripe\Exception\PermissionException $e){

    			  	}catch(\Stripe\Exception\InvalidArgumentException $e){

    			  	}
    	        }else{
    		        return redirect()->route('createNewBusinessProfile');				  		
    	        }

            }
    */

        
        return view('business.welcomeBusinessProfile', compact('company', 'firstCompany', 'cart'));
        
        /*$company='';
        $firstCompany='';
        $cart='';
        return view('business.welcomeBusinessProfile');*/
    }

    public function companyBusinessProfile(Request $request) {
        $business_details = BusinessCompanyDetail::where('userid', Auth::user()->id)->get();
        $business_details = isset($business_details[0]) ? $business_details[0] : [];
        return view('business.companyBusinessProfile', ['business_details' => $business_details]);
    }

    public function experienceBusinessProfile(Request $request) {
        return view('business.experienceBusinessProfile');
    }

    public function specificationBusinessProfile(Request $request) {
        return view('business.specificationBusinessProfile');
    }

    public function termsBusinessProfile(Request $request) {
        return view('business.termsBusinessProfile');
    }

    public function verifiedBusinessProfile(Request $request) {
        return view('business.verifiedBusinessProfile');
    }

    public function servicesBusinessProfile(Request $request) {
        return view('business.servicesBusinessProfile');
    }

    public function bookingBusinessProfile(Request $request) {
        return view('business.bookingBusinessProfile');
    }
    
    public function businessJumps($bstep, $cid) {

        User::where('id', Auth::user()->id)->update(['bstep' => $bstep, 'cid' => $cid]);
        return redirect()->route('createNewBusinessProfile');

    }

    /* Step 1 - Business Profile */
    public function addbstep(Request $request) {
        //dd(Auth::user()->cid);


        $companyId = $serviceId = 0;
        if(isset($request->cid) && $request->cid != 0) {
            $companyId = $request->cid;
        } elseif(isset(Auth::user()->cid) && !empty(Auth::user()->cid)) {
            $companyId = Auth::user()->cid;
        }

        if(isset($request->serviceid)) {
            $serviceId = $request->serviceid;
        } elseif(isset(Auth::user()->serviceid) && !empty(Auth::user()->serviceid)) {
            $serviceId = Auth::user()->serviceid;
        }
        
        $businessData = [
            'bstep' => $request->bstep,
            'cid' => $companyId,
            'serviceid' => $serviceId
        ];
                
        CompanyInformation::where('id', $businessData['cid'])->update(['serviceid' => $businessData['serviceid']]);
        User::where('id', Auth::user()->id)->update($businessData);


/*
        if($request->gostripe == '1'){
	        $stripe_client = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
	        $company = CompanyInformation::where('id', $companyId)->get()->first();
	        if(!$company){
	            $company = CompanyInformation::create([
		            "stripe_connect_id" => "1111111"
		        ]);        
                User::where('id', Auth::user()->id)->update(['cid' => $company->id]);
	        }
	        
			try{
				$stripe_account = $stripe_client->accounts->retrieve(
				  	$company->stripe_connect_id,
				  	[]
		  		);
	
		  	}catch(\Stripe\Exception\PermissionException $e){
				$stripe_account = $stripe_client->accounts->create([
					'type' => 'express', 
					'email' => Auth::user()->email,
				]);
				$company->stripe_connect_id = $stripe_account->id;
				$company->save();
		  	}
		  	
		  	if($stripe_account->charges_enabled){
		  		$company->charges_enabled = 1;
		  		$company->save();
	  		}else{

		  		$link = $stripe_client->accountLinks->create(
				  [
				    'account' => $stripe_account->id,
				    'refresh_url' => 'https://fitnessity.co/business-welcome?stripe_status=pending&cid=' . $company->id,
				    'return_url' => 'https://fitnessity.co/business-welcome?stripe_status=pending&cid=' . $company->id,
				    'type' => 'account_onboarding',
				  ]
				);
				$url = $link['url'];
				return redirect($url);
	  		}		


        }
*/
        
        return redirect()->route('createNewBusinessProfile');
    }

    /* Step 2 - Business Profile */
    public function addbusinesscompanydetail(Request $request) {
    /*    print_r($request->all());*/
        $validator = Validator::make($request->all(), [
            'Companyname' => 'required',
            'Address' => 'required',
            'City' => 'required',
            'State' => 'required',
            'ZipCode' => 'required',
            // 'Businessusername' => 'required',
            'Firstnameb' => 'required',
            'Lastnameb' => 'required',
            'userid' => 'required'
        ]);
        
        global $cid;
        $cid = $request->cid;
        $request->Country = 'United States';
        
        $profile_picture = $companyId = "";
        if ($request->hasFile('Profilepic')) {
            $gallery_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR ;
            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
            $image_upload = Miscellaneous::uploadPhotoGallery($request->Profilepic, $gallery_upload_path, 1, $thumb_upload_path, 130, 100);
            if($image_upload['success'] == true) {
                $profile_picture = $image_upload['filename'];
            }
        } else {
            $profile_picture = $request->oldProfilepic;
        }
        /* using the insertion time only */
        $request->Profilepic = $profile_picture;
        $data['lat'] = $request->lat;
        $data['lon'] = $request->lon;
        
        $companyData = [
            "user_id" => Auth::user()->id,
            "first_name" => $request->Firstnameb,
            "last_name" => $request->Lastnameb,
            "email" => $request->Emailb,
            "contact_number" => $request->Phonenumber,
            "logo" => $profile_picture,
            "company_name" => $request->Companyname,
            "address" => $request->Address,
            "state" => $request->State,
            "country" => $request->Country,
            "zip_code" => $request->ZipCode,
            "city" => $request->City,
            "ein_number" => $request->EINnumber,
            "establishment_year" => $request->Establishmentyear,
            "business_user_tag" => $request->Businessusername,
            "about_company" => $request->Aboutcompany,
            "short_description" => $request->Shortdescription,
            "embed_video" => $request->EmbedVideo,
            "latitude" => $data['lat'],
            "longitude" => $data['lon'],
            'dba_business_name' => $request->dba_business_name,
			'additional_address' => $request->additional_address,
			'neighborhood' => $request->neighborhood,
			'business_phone' => $request->business_phone,
			'business_email' => $request->business_email,
			'business_website' => $request->business_website,
			'business_type' => $request->business_type,
        ];
        
        if($request->cid==0)
        {   
          
            $cid = CompanyInformation::create($companyData)->id;
        }
        else {
            CompanyInformation::where('id', $cid)->where('user_id', Auth::user()->id)->update($companyData);
        }
        
        $businessData = [
            "cid" => $cid,
            "userid" => Auth::user()->id,
            "Companyname" => $request->Companyname,
            "Address" => $request->Address,
            "City" => $request->City,
            "State" => $request->State,
            "ZipCode" => $request->ZipCode,
            "Country" => $request->Country,
            "EINnumber" => $request->EINnumber,
            "Businessusername" => $request->Businessusername,
            "Profilepic" => $profile_picture,
            "Firstnameb" => $request->Firstnameb,
            "Lastnameb" => $request->Lastnameb,
            "Emailb" => $request->Emailb,
            "Phonenumber" => $request->Phonenumber,
            "Aboutcompany" => $request->Aboutcompany,
            "Shortdescription" => $request->Shortdescription,
            "EmbedVideo" => $request->EmbedVideo,
            "showstep" => 2            
        ];


        /************* new flow change ******************
        $business_details = BusinessCompanyDetail::where('userid', Auth::user()->id)->get();
        if (!isset($business_details[0])) {
            BusinessCompanyDetail::create($request->all());
        } else {
            BusinessCompanyDetail::where('userid', Auth::user()->id)->update($businessData);
        }

        return redirect()->route('experienceBusinessProfile');
        ****************************************************/
        
        
        /* Table - business_companydetails */
        $business_details = BusinessCompanyDetail::where('cid', $cid)->where('userid', Auth::user()->id)->get();
        if (!isset($business_details[0])) {
            BusinessCompanyDetail::create($businessData);
        } else {
            BusinessCompanyDetail::where('cid', $cid)->where('userid', Auth::user()->id)->update($businessData);
        }

        
        User::where('id', Auth::user()->id)->update(['bstep' => 3]);
        User::where('id', Auth::user()->id)->update(['cid' => $cid]);

        return redirect()->route('createNewBusinessProfile');
    }

    /* Step 3 - Business Profile */
    public function addbusinessexperience(Request $request) {
        // echo"<pre>"; print_r($request->all());exit();
         //dd($request->all());
        /************* new flow change ******************
          $businessData = $request->all();
          $business_details = BusinessExperience::where('userid', Auth::user()->id)->get();
          if(!isset($business_details[0])) {
          BusinessExperience::create($request->all());
          } else {
          BusinessExperience::where('userid', Auth::user()->id)->update($businessData);
          }
         
        return redirect()->route('specificationBusinessProfile');
        ****************************************************/
        //global $cid;
        $frm_organisation = array();
        $frm_posi = array();
        $frm_servi_start = array();
        $frm_service_end = array();
        $frm_ispresent = array();
        $frm_course = array();
        for($i=0; $i < count($request->frm_organisationname);$i++){
            $frm_organisation[] = $request->frm_organisationname[$i];
            $frm_posi[] = $request->frm_position[$i];
            $frm_servi_start[] = $request->frm_servicestart[$i];
            $frm_service_end[] = $request->frm_serviceend[$i];
            $frm_ispresent[] = $request->frm_ispresent[$i];
        }

        for($i=0;$i < count($request->frm_course);$i++){
            $frm_course[] = $request->frm_course[$i];
            $frm_university[] = $request->frm_university[$i];
            $frm_passingyear[] = $request->frm_passingyear[$i];
        }

        for($i=0;$i < count($request->certification);$i++){
            $certification[] = $request->certification[$i];
            $frm_passingdate[] = $request->frm_passingdate[$i];
        }

        for($i=0;$i < count($request->skill_type);$i++){
            $skill_type[] = $request->skill_type[$i];
            $skillcompletion[] = $request->skillcompletion[$i];
            $frm_skilldetail[] = $request->frm_skilldetail[$i];
        }

        
        $skill_type = json_encode($skill_type,true);
        $skillcompletion = json_encode($skillcompletion,true);
        $frm_skilldetail = json_encode($frm_skilldetail,true);

        $certification = json_encode($certification,true);
        $frm_passingdate = json_encode($frm_passingdate,true);

        $frm_course = json_encode($frm_course,true);
        $frm_university = json_encode($frm_university,true);
        $frm_passingyear = json_encode($frm_passingyear,true);

        $frm_organisationname = json_encode($frm_organisation,true);
        $frm_position = json_encode($frm_posi,true);
        $frm_servicestart = json_encode($frm_servi_start,true);
        $frm_serviceend = json_encode($frm_service_end,true);
        $frm_ispresentcheck = json_encode($frm_ispresent,true);
     
        $stillwork=0;
        if($request->frm_ispresentcheck=='on'){ $stillwork =1; }
        $businessData = [
            "cid" => $request->cid,
            "userid" => $request->userid,
            "frm_organisationname" => $frm_organisationname,
            "frm_position" => $frm_position,
            /*"frm_ispresentcheck" => $stillwork,*/
            "frm_ispresentcheck" => $frm_ispresentcheck,
            "frm_servicestart" => $frm_servicestart,
            "frm_serviceend" => $frm_serviceend,
            "frm_course" => $frm_course,
            "frm_university" => $frm_university,
            "frm_passingyear" => $frm_passingyear,
            "certification" => $certification,
            "frm_passingdate" => $frm_passingdate,
            "skill_type" => $skill_type,
            "skillcompletion" => $skillcompletion,
            "frm_skilldetail" => $frm_skilldetail,
            "showstep" => 4
        ];
       /* print_r($businessData);*/
        
        /* Table - business_experience */
        $business_exp = BusinessExperience::where('cid', $request->cid)->where('userid', Auth::user()->id)->get();
        // print_r($business_exp);exit();
        if (!isset($business_exp[0])) {
            BusinessExperience::create($businessData);
        } else {
            BusinessExperience::where('cid', $request->cid)->where('userid', Auth::user()->id)->update($businessData);
        }
        
        User::where('id', Auth::user()->id)->update(['bstep' => 4]);
 
        return redirect()->route('createNewBusinessProfile');
    }

    /* Step 4 - Business Profile */
    public function addbusinessspecification(Request $request) {
        //dd($request->all());
        
        $languages = $serBusinessoff1 = $medical_type = $goals_option = "";
        if(isset($request->languages) && !empty($request->languages)) {
            $languages = @implode(",",$request->languages);    
        }
        if(isset($request->medical_type) && !empty($request->medical_type)) {
            $medical_type = @implode(",",$request->medical_type);    
        }
        if(isset($request->serBusinessoff1) && !empty($request->serBusinessoff1)) {
            $serBusinessoff1 = @implode(",",$request->serBusinessoff1);
        }
        if(isset($request->goals_option) && !empty($request->goals_option)) {
            $goals_option = @implode(",",$request->goals_option);
        }
       
        $businessData = [
          'cid' => $request->cid,
          'userid'=>$request->userid, 
          'languages'=>$languages, 
          'medical_states'=>$request->medical_states,
          'medical_type'=>$medical_type,
          'fitness_goals'=>$request->fitness_goals,
          'goals_option'=>$goals_option,
          'hours_opt'=>$request->hours_opt,
          'mon_shift_start'=>$request->mon_shift_start,
          'mon_shift_end'=>$request->mon_shift_end,  
          'tue_shift_start'=>$request->tue_shift_start,
          'tue_shift_end'=>$request->tue_shift_end,  
          'wed_shift_start'=>$request->wed_shift_start,
          'wed_shift_end'=>$request->wed_shift_end,
          'thu_shift_start'=>$request->thu_shift_start,
          'thu_shift_end'=>$request->thu_shift_end,
          'fri_shift_start'=>$request->fri_shift_start,
          'fri_shift_end'=>$request->fri_shift_end,
          'sat_shift_start'=>$request->sat_shift_start,
          'sat_shift_end'=>$request->sat_shift_end,
          'sun_shift_start'=>$request->sun_shift_start,
          'sun_shift_end'=>$request->sun_shift_end,
          'serTimeZone'=>$request->serTimeZone,
          'special_days_off'=> $request->special_days_off,
          'serBusinessoff1'=>$serBusinessoff1
        ];
        
        /* Table - business_services */
        $business_spec = BusinessService::where('cid', $request->cid)->where('userid', Auth::user()->id)->get();
        if (!isset($business_spec[0])) {
            BusinessService::create($businessData);
        } else {
            BusinessService::where('cid', $request->cid)->where('userid', Auth::user()->id)->update($businessData);
        }
        
        User::where('id', Auth::user()->id)->update(['bstep' => 5]);
        //return view('profiles.createNewBusinessProfile');
        return redirect()->route('createNewBusinessProfile');
    }

    /* Step 5 - Business Profile */
    public function addbusinessterms(Request $request) {
        /*dd($request->all());*/

        $refundpolicy = 0;
        $covid = 0;
        $liability = 0;
        $termcondfaq = 0;
        $contractterms = 0;
        $termcondfaqtext = NULL;
        $contracttermstext = NULL;
        $liabilitytext = NULL;
        $refundpolicytext = NULL;
        $covidtext = NULL;
        if($request->has('termcondfaq')){
            $termcondfaq = 1;
            $termcondfaqtext = $request->termcondfaqtext;
        } 
        if($request->has('contractterms')){
            $contractterms = 1;
            $contracttermstext = $request->contracttermstext;
        } 
        if($request->has('refundpolicy')){
            $refundpolicy = 1;
            $refundpolicytext = $request->refundpolicytext;
        } 
        if($request->has('liability')){
            $liability = 1;
            $liabilitytext = $request->liabilitytext;
        } 
        if($request->has('covid')){
            $covid = 1;
            $covidtext = $request->covidtext;
        }
        $businessData = [
            "cid" => $request->cid,
            "userid" => $request->userid,
            "houserules" => $request->houserules,
            "cancelation" => $request->cancelation,
            "cleaning" => $request->cleaning,
            "termcondfaq" => $termcondfaq,
            "termcondfaqtext" => $termcondfaqtext,
            "contractterms" => $contractterms,
            "contracttermstext" => $contracttermstext,
            "liability" => $liability,
            "liabilitytext" => $liabilitytext,
            "covid" => $covid,
            "covidtext" => $covidtext,
            "refundpolicy" => $refundpolicy,
            "refundpolicytext" => $refundpolicytext
        ];
        //dd($businessData);
        /* Table - business_terms */
        $business_term = BusinessTerms::where('cid', $request->cid)->where('userid', Auth::user()->id)->get();
        if (!isset($business_term[0])) {
            BusinessTerms::create($request->all());
        } else {
            BusinessTerms::where('cid', $request->cid)->where('userid', Auth::user()->id)->update($businessData);
        }
        
        //User::where('id', Auth::user()->id)->update(['bstep' => 6]); ///nnn 24-5-2022 - hide evident by nipa
        User::where('id', Auth::user()->id)->update(['bstep' => 7]); // redirect user to create service tab 
        
        return redirect()->route('createNewBusinessProfile');
    }

    /* Step 6 - Business Profile */
    public function addbusinessverification(Request $request) {
        //dd($request->all());
        $businessData = [
            "cid" => $request->cid,
            "userid" => $request->userid,
            "card_number" => $request->cardnumber,
            "card_name" => $request->namecard,
            "card_expiry" => $request->exirydate,
            "card_cvv" => $request->cvv,
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "dob" => $request->dateofbirth,
            "ssn" => $request->securitynumber,
            "phone" => $request->phonenumber,
            "email" => $request->email,
            "rights_summary" => $request->rights_summary,
            "ack_summary" => $request->summary_receipt,
            "authorize_detail" => $request->authorize_detail,
            "ack_authorize" => $request->receive_consumer,
            "signature" => $request->full_name,
            "created" => date("Y-m-d")
        ];
        
        /* Table - business_verified */
        $business_veri = BusinessVerified::where('cid', $request->cid)->where('userid', Auth::user()->id)->get();
        if (!isset($business_veri[0])) {
            BusinessVerified::create($businessData);
        } else {
            BusinessVerified::where('cid', $request->cid)->where('userid', Auth::user()->id)->update($businessData);
        }
        
        User::where('id', Auth::user()->id)->update(['bstep' => 7]);
        return redirect()->route('createNewBusinessProfile');
    }

    /* Step 8 - Business Profile */
    public function addbusinessbooking(Request $request) {
        if($request->cid != "" && $request->cid > 0) {
            return redirect('/pcompany/view/'.$request->cid);
        } else {
            return redirect('/manage/company');
        }
    }


    public function makeCall(Request $request, TwilioService $twilioService) {
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $twilio = new Client($sid, $token);
        $call = $twilio->calls
                ->create("+918854862050", // to
                $twilio_number, // from
                [
            "twiml" => "<Response><Say voice='woman' language='en-IN'>Your one time password is 123456</Say></Response>"
                ]
        );

        //  $voiceMessage = new VoiceResponse();
        //  $voiceMessage->say('Your one time password is 123456', ['voice' => 'woman', 'language' => 'en-IN']);
        // $voiceMessage->say('This is an automated call providing you your OTP from the test app.');
        //  $voiceMessage->say('Your one time password is ' . $otpCode);
        //  $voiceMessage->pause(['length' => 1]);
        //  $voiceMessage->say('Your one time password is ' . $otpCode);
        //  $voiceMessage->say('GoodBye');
        //   return response($voiceMessage)
        //          ->header('Content-Type', 'application/xml');
        // print_r($voiceMessage);die;
        // $otp = $OTPService->createOtp();
        //   $otp = '123456';
        // $callId = $twilioService->makeOtpVoiceCall(env('AUTHORIZED_PHONE_NUMBER'), $otp);
        // return view('otp.validate', ['callId' => $callId]);
    }

    public function generateVoiceMessage(Request $request, $otpCode, TwilioService $twilioService) {
        $twimlResponse = $twilioService->generateTwimlForVoiceCall($otpCode);
        print_r($twimlResponse);
        die;
        // return response($twimlResponse)
        //     ->header('Content-Type', 'application/xml');
    }

    public function sendCustomMessage(Request $request) {
        // $validatedData = $request->validate([
        //     'users' => 'required|array',
        //     'body' => 'required',
        // ]);
        // $recipients = $validatedData["users"];
        // // iterate over the array of recipients and send a twilio request for each
        // foreach ($recipients as $recipient) {
        //     $this->sendMessage($validatedData["body"], $recipient);
        // }
        // return back()->with(['success' => "Messages on their way!"]);
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        // $client->messages->create(+919782051806, ['from' => +15005550006, 'body' => 'Send sms from twillio']);
        try {
            $message = $client->messages
                    ->create("+918854862050", // to
                    [
                "body" => "Hey Mr Nugget, you the bomb!",
                "from" => $twilio_number
                    ]
            );
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteImageCompany(Request $request) {

        $company = CompanyInformation::where('id', $request->company_id)->first();
        $image = json_decode($company->company_images);
        //print_r(gettype($image));die;
        //unset($image[$request->myindex]);
        array_splice($image, $request->myindex, 1);
        $company->company_images = count($image) == 0 ? null : json_encode($image);
        $company->save();
        return 200;
    }

    public function deleteImageCompany1(Request $request) {

        $company = User::where('id', Auth::user()->id)->first();
        $image = json_decode($company->company_images);
        //print_r(gettype($image));die;
        //unset($image[$request->myindex]);
        array_splice($image, $request->myindex, 1);
        $company->company_images = count($image) == 0 ? null : json_encode($image);
        $company->save();
        return 200;
    }

    public function deleteImageGallery(Request $request) {

        $gallery = DB::select('select id, attachment_name from users_add_attachment where id = ? order by id DESC', [$request->delId]);
        if(!empty($gallery)) {
            foreach($gallery as $pic) {
                /*
                $uid = Auth::user()->id;
                $gallery_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . $uid . DIRECTORY_SEPARATOR . $pic->attachment_name;
                $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . $uid . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $pic->attachment_name;
                
                chmod($gallery_upload_path, 0777);
                unlink($gallery_upload_path);

                chmod($thumb_upload_path, 0777);
                unlink($thumb_upload_path); 
                */
                DB::table('users_add_attachment')->delete($request->delId);
            }
        }
        
        return 200;
        return redirect()->route('profile-viewProfile');
    }
    
    public function setCoverPhoto(Request $request) {

        $gallery = DB::select('select id, attachment_name from users_add_attachment where id = ? order by id DESC', [$request->selectId]);
        if(!empty($gallery)) {
            foreach($gallery as $pic) {
                DB::update('update users_add_attachment set cover_photo = 1 where id = "' . $request->selectId . '"');
            }
        }

        return redirect()->route('profile-viewProfile');
    }
    
    public function unsetCoverPhoto(Request $request) {
        $gallery = DB::select('select id, attachment_name from users_add_attachment where id = ? order by id DESC', [$request->selectId]);
        if(!empty($gallery)) {
            foreach($gallery as $pic) {
                DB::update('update users_add_attachment set cover_photo = 0 where id = "' . $request->selectId . '"');
            }
        }
        return redirect()->route('profile-viewProfile');
    }

    public function getBladeDetail($company_id, Request $request) {
        //die('getBladeDetail');
        $view = 'home.individual-page';
        return $this->companyProfilePage($request, $view, $company_id);
    }

    public function getBladeDetail1($company_id, Request $request) {
        //die('getBladeDetail1');
        $view = 'home.individual-page-new';
        return $this->companyProfilePage($request, $view, $company_id);

    }
    public function profileDetail($user_id) {
       $ip = \Request::getClientIp(true);    
     
       $UserProfileDetail = User::find($user_id);
       $ProfileFollowcount = ProfileFollow::where('user_id',$user_id)->count();
       $ProfileFavcount = ProfileFav::where('user_id',$user_id)->count();
       $ProfileView = profileView::where('ip',$ip)->count();   
       return view('jobpost.search_profile', compact('UserProfileDetail','ProfileFollowcount','ProfileFavcount','ProfileView'));

    }
    /*public function profileDetailPage($user_id) { 
       $ip = \Request::getClientIp(true);    
      
      // $UserProfileDetail = User::where('username',$user_name)->get();
       $UserProfileDetail = User::find($user_id);
      // $user_id=$UserProfileDetail->id;
       
       $ProfileFollowcount = ProfileFollow::where('user_id',$user_id)->count();
       $ProfileFavcount = ProfileFav::where('user_id',$user_id)->count();
       $ProfileView = profileView::where('ip',$ip)->count();   
       return view('jobpost.search_profile', compact('UserProfileDetail','ProfileFollowcount','ProfileFavcount','ProfileView'));

    }*/
    public function viewuserpersonalprofile($user_name){
        $ip = \Request::getClientIp(true);
        $UserProfileDetail = User::where('username',$user_name)->first();
        $user_id= @$UserProfileDetail->id;
    
        $gallery = $this->galleryList($user_id);
        /*echo "<pre>";print_r($gallery);
        exit;*/
        $viewgallery = $this->viewGalleryList($user_id); 
               
        $UserProfileDetail = $this->users->getUserProfileDetail($user_id, array('professional_detail', 'history', 'education', 'certification', 'service'));
        
        if (isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0) {
            $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
        }
        $sports_names = $this->sports->getAllSportsNames();
        $approve = Evidents::where('user_id', $user_id)->get();
        $serviceType = Miscellaneous::businessType();
        $programType = Miscellaneous::programType();
        $programFor = Miscellaneous::programFor();
        $numberOfPeople = Miscellaneous::numberOfPeople();
        $ageRange = Miscellaneous::ageRange();
        $expLevel = Miscellaneous::expLevel();
        $serviceLocation = Miscellaneous::serviceLocation();
        $pFocuses = Miscellaneous::pFocuses();
        $duration = Miscellaneous::duration();
        $servicePriceOption = Miscellaneous::servicePriceOption();
        $specialDeals = Miscellaneous::specialDeals();
        //  $loggedinUser['role'] = 'customer';
        // $loggedinUser->save();
        //dd($UserProfileDetail);die;

        $view = 'profiles.viewUserProfile';
        $family = UserFamilyDetail::where('user_id', $user_id)->get();
        $business_details = BusinessInformation::where('user_id',$user_id)->get();
        //  dd($this->users->getStateList($UserProfileDetail['country']));
        //die;

        $user = User::where('id', $user_id)->first();
        $city = AddrCities::where('id', $user->city)->first();

        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;
        $firstCompany = CompanyInformation::where('user_id', $user_id)->first();
        $companies = CompanyInformation::where('user_id', $user_id)->get();

        /*$cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }*/

        $ProfileFollowcount = ProfileFollow::where('user_id', $user_id)->count();
        $ProfileFavcount = ProfileFav::where('user_id', $user_id)->count();
        $ProfileViewCount = ProfileView::where('user_id', $user_id)->count();
        $AllFollowing = UserFollow::where('user_id', $user_id)->get();
        $followingarr=array();
        $followingarr[]=$user_id;
        foreach($AllFollowing as $farr)
        {
            $followingarr[]=$farr->follower_id;
        }
        $followingarr1=implode(",",$followingarr);
        $f = explode(",", $followingarr1);
        //DB::enableQueryLog();
        $profile_posts = ProfilePost::whereIn('user_id', $f)->limit(5)->orderBy('id','desc')->get();
        //dd(\DB::getQueryLog());
        //$profile_posts = ProfilePost::limit(5)->orderBy('id','desc')->get();

        $videos = ProfilePost::select('video','user_id')->where('video','!=',null)->where('user_id',$user_id)->orderBy('id','desc')->limit(1)->get();

        $images = ProfilePost::select('images','user_id')->where('images','!=',null)->where('user_id',$user_id)->orderBy('id','desc')->limit(10)->get();
        $profilesave = ProfileSave::where('user_id',$user_id)->orderBy('id','desc')->get();

        return view($view, [
            //'cart' => $cart,
            'UserProfileDetail' => $UserProfileDetail,
            'videos'=> $videos,
            'profilesave'=>$profilesave,
            'images'=> $images,
            'gallery' => $gallery,
            'viewgallery' => $viewgallery,
            'firstCompany' => $firstCompany,
            'countries' => $this->users->getCountriesList(),
            'states' => $this->users->getStateList($UserProfileDetail['country']),
            'cities' => $this->users->getCityList($UserProfileDetail['state']),
            'phonecode' => Miscellaneous::getPhoneCode(),
            'sports_names' => $sports_names,
            'serviceType' => $serviceType,
            'programType' => $programType,
            'programFor' => $programFor,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "PROFILE",
            'approve' => $approve,
            'family' => $family,
            'business_details' => $business_details,
            'companies' => $companies,
            'ProfileFollowcount' => $ProfileFollowcount,
            'ProfileFavcount' => $ProfileFavcount,
            'ProfileViewCount' => $ProfileViewCount,
            'profile_posts' => $profile_posts,
        ]);    
      
       /*$ProfileFollowcount = ProfileFollow::where('user_id',$user_id)->count();
       $ProfileFavcount = ProfileFav::where('user_id',$user_id)->count();
       $ProfileView = profileView::where('ip',$ip)->count(); */  
      //return view('profiles.viewUserProfile', compact('UserProfileDetail','ProfileFollowcount','ProfileFavcount','ProfileView'));
    }
    public function profileView(Request $request)
    {
        $ip = \Request::getClientIp(true);      
        $data = array(
            "user_id" => $request->userd,
            "ip" => $ip,
        );
        profileView::create($data);
    }

    public function newFUn(Request $request) {
        return redirect('/search-result-location?location=' . $request->location . '&page=1&page_size=10');
    }
    //for header & banner search
    public function searchResultLocation(Request $request) {

        $user_data = array();
        $data_user = array();
        if($request->site_search!= null && $request->site_search != 'undefined')
        {
            $query=explode("(",$request->site_search);
            $query_=explode(" ",@$query[0]);
            $query_fname=@$query_[0];
            $query_lname=@$query_[1];
            $query_explode=explode(')',@$query[1]);
            $query_username=@$query_explode[0];
            $data_user = User::where('firstname', "%{$query_fname}%")->orWhere('lastname', 'LIKE', "%{$query_lname}%")->orWhere('username', 'LIKE', "%{$query_username}%")->get();
        }
        $company_ids = [];
        $myloc = $request->location;
        $language = $request->language;
        $select_language = $request->language;
        $select_label = $request->label;
        $select_zipcode = $request->zipcode;
        $company = array();
        if ($myloc != null && $myloc != 'undefined') {
            if ($select_zipcode != null && $select_zipcode != 'undefined') {
                $company = CompanyInformation::where('dba_business_name', 'LIKE', $select_label . '%')->where('city', 'LIKE', $myloc . '%')->where('zip_code', 'LIKE', $select_zipcode . '%')->get();
            } else {
                $company = CompanyInformation::where('city', 'LIKE', $myloc . '%')->get();
            }
        } else {
            if($select_label!=null && $select_label!= 'undefined') {
                $company = CompanyInformation::where('dba_business_name', 'LIKE', $select_label . '%')->get();
            }
        }
        //dd($data_user); exit;
        $sports = $this->sports->getAlphabetsWiseSportsNames();
        $sports_names = $this->sports->getAllSportsNames();
        $sports_child_parent = $this->sports->getSportsChildParentWise();
        $userSpotPrice = $userSport = array();
        $sports_select = '';
        if ($sports) {
            $sports_select .= "<option value=''>Choose Activity</option>";
            foreach ($sports as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    if (count($value1->child)) {
                        $sports_select .= "<optgroup label='" . $value1->title . "'>";
                        foreach ($value1->child as $key2 => $value2) {
                            $selected = $request->selected_sport && $request->selected_sport == $key2 ? "selected" : "";
                            $sports_select .= "<option value='" . $key2 . "' " . $selected . " >" . $value2 . "</option>";
                        }
                        $sports_select .= "</optgroup>";
                    } else {
                        $selected = $request->selected_sport && $request->selected_sport == $value1->value ? "selected" : "";
                        $sports_select .= "<option  value='" . $value1->value . "' " . $selected . ">" . $value1->title . "</option>";
                    }
                }
            }
        }

        $businessType = Miscellaneous::businessType();
        $programType = Miscellaneous::programType();
        $programFor = Miscellaneous::programFor();
        $numberOfPeople = Miscellaneous::numberOfPeople();
        $ageRange = Miscellaneous::ageRange();
        $expLevel = Miscellaneous::expLevel();
        $serviceLocation = Miscellaneous::serviceLocation();
        $pFocuses = Miscellaneous::pFocuses();
        $duration = Miscellaneous::duration();
        $servicePriceOption = Miscellaneous::servicePriceOption();
        $specialDeals = Miscellaneous::specialDeals();
        $activity = Miscellaneous::activity();
        $teaching = Miscellaneous::teaching();
        $alllanguages = Miscellaneous::getLanguages();
        $timeSlots = Miscellaneous::getTimeSlot();
        $locations = array();

        if(!empty($company)) {
            foreach ($company as $key => $value) {
    
                $value['company_images'] = $value['company_images'] == null ? [] : json_decode($value['company_images']);
                $max_price = UserService::where('company_id', $value['id'])->max('price');
                $min_price = UserService::where('company_id', $value['id'])->min('price');
                $str = '';
                $services = UserService::where('company_id', $value['id'])->get();
    
                foreach ($services as $key2 => $value2) {
                    $sport = Sports::where('id', $value2['sport'])->first();
                    $str = $str . $sport['sport_name'];
                    if (($key2 + 1) != count($services)) {
                        $str = $str . ', ';
                    }
                }
    
                $user_logo = User::where('id', $value['user_id'])->first();
                $user_logo1 = $user_logo['profile_pic'];
                $value['business_name'] = $value['dba_business_name'];
                $value['activity'] = "";
                $value['website'] = "";
                $value['location'] = $value['city'];
                $value['address'] = $value['address'];
                $value['phone'] = $value['contact_number'];
                $value['type'] = "claimed";
                $value['type'] = "claimed";
                $value['max_price'] = $max_price;
                $value['min_price'] = $min_price;
                $value['service_name'] = $str;
                $value['user_logo'] = $user_logo1;
            }
        }
        if(count($data_user->toarray())>0)
        {
            foreach ($data_user as $key => $value) {
    
                $value['cover_photo'] = $value['cover_photo'] == null ? [] : json_decode($value['cover_photo']);
                $max_price = 0;
                $min_price = 0;
                $str = '';
                $services = "";
    
                $user_logo = User::where('id', $value['id'])->first();
                $user_logo1 = $user_logo['profile_pic'];
                $value['username'] = $value['username'];
                $value['firstname'] = $value['firstname'];
                $value['lastname'] = $value['lastname'];
                $value['activity'] = "";
                $value['website'] = "";
                $value['location'] = $value['city'];
                $value['address'] = $value['address'];
                $value['phone'] = $value['phone_number'];
                $value['type'] = "claimed";
                $value['type'] = "claimed";
                $value['max_price'] = $max_price;
                $value['min_price'] = $min_price;
                $value['service_name'] = " ";
                $value['user_logo'] = $user_logo1;
            }
        }
        
        
        $result=array();
        $search_data2 = $company;
        if(!empty($company))
            $result = $company->toArray();
        
        if(count($data_user->toarray())>0)
            $result=array_merge($result,$data_user->toarray());
        
        $page = $request->page ? $request->page : 1;
        $perPage = $request->page_size ? $request->page_size : 10;
        $offset = ($page * $perPage) - $perPage;
        $request_location = $request->location;
        $select_activity_location = $request->activity_location;
        $select_personality = $request->personality_habit;
        $select_experience = $request->activity_exp;
        $select_age = $request->age_range;
        $select_activity_for = $request->activity_for;
        $select_activity_type = $request->activity_type;
        $select_professional_type = $request->professional_type;
        
        $resultnew = new LengthAwarePaginator(
                array_slice($result, $offset, $perPage, true), count($result), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]
        );
        
        if(!empty($company)) {
            foreach ($resultnew as $value) {
                if ($value['type'] == 'claimed') {
                    $found = 0;
                    foreach ($locations as $key2 => $value2) {
                        if (($value2[1] == $value['latitude']) && ($value2[2] == $value['longitude'])) {
                            $found = $found + 1;
                        }
                    }
                    if ($found != 0) {
                        $lat = $value['latitude'] + ((floatVal('0.' . rand(1, 9)) * $found) / 10000);
                        $long = $value['longitude'] + ((floatVal('0.' . rand(1, 9)) * $found) / 10000);
                        $a = [$value['dba_business_name'], $lat, $long, $value['id'], $value['logo']];
                    } else {
                        $a = [$value['dba_business_name'], $value['latitude'], $value['longitude'], $value['id'], $value['logo']];
                    }
                    array_push($locations, $a);
                }
            }
        }
        //dd($locations);
        $return = Sports::select(DB::raw('sports.*'), DB::raw('sports_categories.category_name'), DB::raw('IF((select count(*) from sports as sports1 where sports1.is_deleted = "0" AND sports1.parent_sport_id = sports.id ) > 0,1,0) as has_child'))
                ->leftjoin("sports_categories", DB::raw('sports.category_id'), '=', 'sports_categories.id');
        $return->where('sports.is_deleted', '0');
        $return->where('sports.parent_sport_id', NULL);
        $return->groupBy('sports.id');
        $return->orderBy('sports.sport_name');

        $sports_list = $return->get();
        $teaching = Miscellaneous::teaching();
        $gender = Miscellaneous::gender();
        $participateActivity = Miscellaneous::participateActivity();
        $dayactivity = Miscellaneous::dayactivity();
        $trainingLocation = Miscellaneous::trainingLocation();
        $StartActivity = Miscellaneous::StartActivity();
        $travelUpto = Miscellaneous::travelUpto();
        $language = Languages::get();
        $activeLevel = Miscellaneous::activeLevel();
        $expProfessional = Miscellaneous::expProfessional();
        $expActivity = Miscellaneous::expActivity();
        $expLevel = Miscellaneous::expLevel();
        $getTimeSlot = Miscellaneous::getTimeSlot();

        return view('home.searchLocationResult', compact(
                'resultnew', 
                'businessType', 
                'select_professional_type', 
                'select_professional_type', 
                'sports_select', 
                'sports', 
                'request_location', 
                'activity', 
                'select_activity_for', 
                'select_activity_type', 
                'programType', 
                'ageRange', 
                'select_age', 
                'alllanguages', 
                'select_language', 
                'pFocuses', 
                'select_experience', 
                'select_personality', 
                'serviceLocation', 
                'sports_list', 
                'select_activity_location', 
                'locations', 
                'language', 
                'travelUpto', 
                'StartActivity', 
                'trainingLocation', 
                'dayactivity', 
                'participateActivity', 
                'gender', 
                'teaching', 
                'activeLevel', 
                'expProfessional', 
                'expActivity', 
                'expLevel', 
                'getTimeSlot'));
    }

    public function searchResultLocation1(Request $request) {

        $company_ids = [];
        $myloc = $request->location;
        $language = $request->language;
        $select_language = $request->language;
        $select_label = $request->label;
        $select_zipcode = $request->zipcode;
        //print_r($request->professional_type);die;
        if ($request->selected_sport != null && $request->selected_sport != 'undefined') {
            $my_service_data = UserService::where('company_id', '!=', null)->where('sport', $request->selected_sport)->get();
            foreach ($my_service_data as $value2) {
                array_push($company_ids, $value2['company_id']);
            }
            // dd($company_ids);
            $company = CompanyInformation::whereIn('id', $company_ids)->where('city', 'LIKE', $myloc . '%')->get();
            // dd(count($company));
        }

        if ($request->age_range != null && $request->age_range != 'undefined') {
            foreach ($request->age_range as $data) {
                $str = ':"' . $data;
                $my_service_data = UserService::where('company_id', '!=', null)->where('agerange', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->where('city', 'LIKE', $myloc . '%')->get();
            // dd(count($company));
        }

        if ($request->activity_for != null && $request->activity_for != 'undefined') {
            foreach ($request->activity_for as $data) {
                $str = ':"' . $data;
                $my_service_data = UserService::where('company_id', '!=', null)->where('activitydesignsfor', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            // dd($company_ids);
            $company = CompanyInformation::whereIn('id', $company_ids)->where('city', 'LIKE', $myloc . '%')->get();
            // dd(count($company));
        }

        if ($request->activity_type != null && $request->activity_type != 'undefined') {
            foreach ($request->activity_type as $data) {
                $str = ':"' . $data;
                $my_service_data = UserService::where('company_id', '!=', null)->where('activitytype', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {

                    array_push($company_ids, $value2['company_id']);
                }
            }
            // dd($company_ids);
            $company = CompanyInformation::whereIn('id', $company_ids)->where('city', 'LIKE', $myloc . '%')->get();
            // dd(count($company));
        }

        if ($request->language != null && $request->language != 'undefined') {
            foreach ($request->language as $data) {
                $str = ':"' . $data;
                $my_service_data = UserProfessionalDetail::where('company_id', '!=', null)->where('languages', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->where('city', 'LIKE', $myloc . '%')->get();
        }

        if ($request->professional_type != null && $request->professional_type != 'undefined') {
            foreach ($request->professional_type as $data) {
                $str = ':"' . $data;
                //print_r($str);die;
                $my_service_data = UserService::where('company_id', '!=', null)->where('servicetype', 'LIKE', '%' . $str . '%')->get();
                //  print_r($my_service_data);die;
                foreach ($my_service_data as $value2) {

                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->where('city', 'LIKE', $myloc . '%')->get();
        }

        if ($request->activity_location != null && $request->activity_location != 'undefined') {
            foreach ($request->activity_location as $data) {
                $str = ':"' . $data;
                $my_service_data = UserProfessionalDetail::where('company_id', '!=', null)->where('work_locations', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->where('city', 'LIKE', $myloc . '%')->get();
        }

        if ($request->personality_habit != null && $request->personality_habit != 'undefined') {
            foreach ($request->personality_habit as $data) {
                $str = ':"' . $data;
                $my_service_data = UserProfessionalDetail::where('company_id', '!=', null)->where('personality', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->where('city', 'LIKE', $myloc . '%')->get();
        }

        if ($request->activity_exp != null && $request->activity_exp != 'undefined') {
            foreach ($request->activity_exp as $data) {
                $str = ':"' . $data;
                $my_service_data = UserProfessionalDetail::where('company_id', '!=', null)->where('experience_level', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->where('city', 'LIKE', $myloc . '%')->get();
        }
        $data = BusinessClaim::where('location', 'LIKE', $myloc . '%')->where('is_verified', 0)->get();

        if (!($request->selected_sport != null && $request->selected_sport != 'undefined') &&
                !($request->language != null && $request->language != 'undefined') &&
                !($request->activity_location != null && $request->activity_location != 'undefined') &&
                !($request->age_range != null && $request->age_range != 'undefined') &&
                !($request->activity_for != null && $request->activity_for != 'undefined') &&
                !($request->activity_type != null && $request->activity_type != 'undefined') &&
                !($request->personality_habit != null && $request->personality_habit != 'undefined') &&
                !($request->professional_type != null && $request->professional_type != 'undefined') &&
                !($request->activity_exp != null && $request->activity_exp != 'undefined')
        )
        $company = CompanyInformation::where('city', 'LIKE', $myloc . '%')->get();
        $locations = array();

        foreach ($company as $key => $value) {
            $value['company_images'] = $value['company_images'] == null ? [] : json_decode($value['company_images']);
            $max_price = UserService::where('company_id', $value['id'])->max('price');
            $min_price = UserService::where('company_id', $value['id'])->min('price');
            $str = '';
            $services = UserService::where('company_id', $value['id'])->get();
            foreach ($services as $key2 => $value2) {
                $sport = Sports::where('id', $value2['sport'])->first();
                $str = $str . $sport['sport_name'];
                if (($key2 + 1) != count($services)) {
                    $str = $str . ', ';
                }
            }
            $pro_pic_l = '';
            $user_logo = User::where('id', $value['user_id'])->first();
            if($user_logo != ''){
                $pro_pic_l  = $user_logo->profile_pic;
            }
            $user_logo1 = $pro_pic_l;
            $value['business_name'] = $value['dba_business_name'];
            $value['activity'] = "";
            $value['website'] = "";
            $value['location'] = $value['city'];
            $value['address'] = $value['address'];
            $value['phone'] = $value['contact_number'];
            $value['type'] = "claimed";
            $value['type'] = "claimed";
            $value['max_price'] = $max_price;
            $value['min_price'] = $min_price;
            $value['service_name'] = $str;
            $value['user_logo'] = $user_logo1;
        }

        foreach ($data as $key => $value) {
            $value['type'] = "unclaimed";
        }

        $search_data = $data;
        $search_data2 = $company;
        $result = array_merge($company->toArray(), $data->toArray());
        $page = $request->page ? $request->page : 1;
        $perPage = $request->page_size ? $request->page_size : 10;
        $offset = ($page * $perPage) - $perPage;
        $request_location = $request->location;
        $select_activity_location = $request->activity_location;
        $select_personality = $request->personality_habit;
        $select_experience = $request->activity_exp;
        $select_age = $request->age_range;
        $select_activity_for = $request->activity_for;
        $select_activity_type = $request->activity_type;
        $select_professional_type = $request->professional_type;
        $resultnew = new LengthAwarePaginator(
                array_slice($result, $offset, $perPage, true), count($result), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]
        );

        foreach ($resultnew as $value) {
            if ($value['type'] == 'claimed') {
                $a = [$value['dba_business_name'], $value['latitude'], $value['longitude'], $value['id'], $value['logo']];
                array_push($locations, $a);
            }
        }

        return view('home.search-location', compact('select_professional_type', 'select_activity_type', 'select_activity_for', 'select_age', 'select_experience', 'select_personality', 'select_activity_location', 'select_language', 'request_location', 'resultnew', 'locations'
        ));

        //return response()->json(['status'=>200,'search_data'=>$data,'search_data2'=>$company]);
        //return view('home.searchLocationResult',compact('search_data','search_data2','locations'));
    }

    public function SendVerificationlink(Request $request) {

        $business = BusinessClaim::where('id', $request->business_id)->first();

        $code = $this->generateRandomString();

        $business->token = $code;

        $business->user_id = Auth::user()->id;

        $business->save();

        $email = $request->business_email . '@' . $business->website;

        Mail::to($email)->send(new BusinessVerifyMail($business, $code));

        //   print_r("gfhj");die;

        return redirect('/get-business-detail/' . $request->business_id . '?mail_sent=1&email=' . $request->business_email);

        // return view('home.business-claim-detail', [
        //     'data'=>$business,
        //     'mail_sent'=>1
        //     ]);
    }

    public function SendVerificationlinkMsg(Request $request) {

        //  return redirect()->back()->with('msg', 'Phone nuber is not correct');

        $business = BusinessClaim::where('id', $request->business_id)->first();

        // $code= $this->generateRandomString();

        $code = rand(1000, 9999);

        $business->token = $code;

        $business->user_id = Auth::user()->id;

        $business->save();



        $account_sid = getenv("TWILIO_SID");

        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $twilio_number = getenv("TWILIO_NUMBER");

        $client = new Client($account_sid, $auth_token);

        try {

            $message = $client->messages
                    ->create($business->phone, [

                "body" => "Your business verification code is: " . $code,
                "from" => $twilio_number
                    ]
            );

            return redirect('/get-business-detail/' . $request->business_id . '?msg_sent=1&phone=' . $business->phone);
        } catch (\Exception $e) {

            return redirect()->back()->with('msg', $e->getMessage());
        }
    }

    public function SendVerificationlinkCall(Request $request) {

        $business = BusinessClaim::where('id', $request->business_id)->first();

        $code = rand(1000, 9999);

        $business->token = $code;

        $business->user_id = Auth::user()->id;

        $business->save();

        try {

            $sid = getenv("TWILIO_SID");

            $token = getenv("TWILIO_AUTH_TOKEN");

            $twilio_number = getenv("TWILIO_NUMBER");

            $twilio = new Client($sid, $token);

            $call = $twilio->calls
                    ->create($business->phone, // to
                    $twilio_number, // from
                    [

                "twiml" => "<Response><Say voice='woman' language='en-IN'>Your one time password is " . $code . "</Say></Response>"
                    ]
            );

            return redirect('/get-business-detail/' . $request->business_id . '?call_sent=1&phone=' . $business->phone);
        } catch (\Exception $e) {

            return redirect()->back()->with('msg', $e->getMessage());
        }
    }

    public function makeOTPMsg(Request $request) {

        $code = $request->otp;

        $business = BusinessClaim::where('id', $request->business_id)->first();

        if (empty($business)) {

            return redirect()->back()->with('msg', 'Invalid link');
        }

        if ($business->token == $code) {

            Auth::loginUsingId($business['user_id'], true);

            $request->session()->put('company_name', $business['business_name']);

            $request->session()->put('phone', $business['phone']);

            $user = User::where('id', $business['user_id'])->first();

            Auth::login($user);

            Auth::loginUsingId($user->id, true);

            return redirect('/profile/viewProfile?companyCreate=1')->with(['phone' => $business['phone'], 'company_name' => $business['business_name'], 'business_id' => $business['id'], 'city' => $business['location']]);
        } else {

            return redirect()->back()->with('msg', 'Invalid OTP');
        }
    }

    public function VerifySendVerificationlink(Request $request) {

        $code = $request->code;

        $business = BusinessClaim::where('token', $request->code)->first();

        if (empty($business)) {

            return response()->json(['status' => 500, 'message' => 'Invalid link']);
        }

        Auth::loginUsingId($business['user_id'], true);

        $request->session()->put('company_name', $business['business_name']);

        $request->session()->put('phone', $business['phone']);

        $user = User::where('id', $business['user_id'])->first();

        Auth::login($user);



        Auth::loginUsingId($user->id, true);



        // print_r($request->session()->get('phone'));die;

        return redirect('/profile/viewProfile?companyCreate=1')->with(['phone' => $business['phone'], 'company_name' => $business['business_name'], 'business_id' => $business['id'], 'city' => $business['location']]);



        //     $company_data = new CompanyInformation();
        //     $company_data->user_id = $business['user_id'];
        //   //  $company_data->first_name = $data['company_representative_first_name'];
        // //    $company_data->last_name = $data['company_representative_last_name'];
        //     $company_data->company_name = $business['business_name'];
        //     $company_data->address = $business['location'];
        //     //$company_data->email = $data['email'];
        //     $company_data->contact_number = $business['phone'];
        //   $company_data->save();
        //   $business->is_verified = 1;
        //   $business->save();
    }

    public function generateRandomString($length = 10) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function businessClaim(Request $request) {
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        return view('home.business-claim',[
            'cart' => $cart
        ]);
    }

    public function showbusinessClaimDetail(Request $request, $cid) {
        return view('home.business-claim-info-details',compact('cid'));
    }

    public function getBusinessClaim($myloc) {

        //print_r($myloc);die;

        $data = BusinessClaim::where('location', 'LIKE', $myloc . '%')->where('is_verified', 0)->get();

        $company = CompanyInformation::where('city', 'LIKE', $myloc . '%')->get();

        foreach ($company as $key => $value) {

            $value['business_name'] = $value['dba_business_name'];

            $value['activity'] = "";

            $value['website'] = "";

            $value['location'] = $value['city'];

            $value['address'] = $value['address'];

            $value['phone'] = $value['contact_number'];
        }

        return response()->json(['status' => 200, 'search_data' => $data, 'search_data2' => $company]);
    }

    public function getLocationBusinessClaimDetaill(Request $request) {

        //print_r($myloc);die;

        $data = BusinessClaim::where('business_name', 'LIKE', $request->business_name . '%')->where('location', $request->location)->where('is_verified', 0)->get();

        $company = CompanyInformation::where('city', $request->location)->where('dba_business_name', 'LIKE', $request->business_name . '%')->get();



        foreach ($company as $key => $value) {

            $value['business_name'] = $value['dba_business_name'];

            $value['activity'] = "";

            $value['website'] = "";

            $value['location'] = $value['city'];

            $value['address'] = $value['address'];

            $value['phone'] = $value['contact_number'];
        }

        //    dd(gettype($data));
        //    $data2 =  array_merge( (array) $data, (array) $company);
        // $data2 = array_merge($data,$company);

        return response()->json(['status' => 200, 'search_data' => $data, 'search_data2' => $company]);
    }

    public function getBusinessClaimDetaill($valueid, Request $request) {

        //print_r($myloc);die;

        $data = BusinessClaim::where('id', $valueid)->first();

        if ($request->mail_sent) {

            return view('home.business-claim-detail', [

                'data' => $data,
                'mail_sent' => 1,
                'email' => $request->email
            ]);
        } elseif ($request->msg_sent) {

            return view('home.business-claim-detail', [

                'data' => $data,
                'msg_sent' => 1

                    //'email'=>$request->email
            ]);
        } elseif ($request->call_sent) {

            return view('home.business-claim-detail', [

                'data' => $data,
                'call_sent' => 1

                    //'email'=>$request->email
            ]);
        } else {

            return view('home.business-claim-detail', [

                'data' => $data,
                'mail_sent' => 0
            ]);
        }

        //return response()->json(['status'=>200,'search_data'=>$data]);
    }

    public function viewPCompany(Request $request, $company_id) {
        
        $view = 'home.individual-page-new';
        return $this->companyProfilePage($request, $view, $company_id);
        
    }
    
    public function companyProfilePage($request, $view, $company_id) {
        
        $user_professional_detail = $terms = $business_details = $business_exp = $business_term = $business_spec = $business_service = $business_price = $gallery = [];
        $companyData = $serviceData = $servicePrice = $businessSpec = $services = $max_price = $min_price = [];
        $company['company_images'] = [];
            
        $company = CompanyInformation::with('employmenthistory', 'education', 'users', 'certification', 'service', 'skill', 'ProfessionalDetail')->where('id', $company_id)->first();

        if(!empty($company)) {
            $userId = $company->user_id;
        
            $business_details = BusinessCompanyDetail::where('cid', $company_id)->get();
            $business_details = isset($business_details[0]) ? $business_details[0] : [];

            $business_exp = BusinessExperience::where('cid', $company_id)->get();
            $business_exp = isset($business_exp[0]) ? $business_exp[0] : [];
            
            $business_term = BusinessTerms::where('cid', $company_id)->get();
            $business_term = isset($business_term[0]) ? $business_term[0] : [];

            $business_spec = BusinessService::where('cid', $company_id)->get();
            $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
       
            $gallery = $this->galleryList($userId);
            
            
            $serviceData = BusinessServices::where('cid', $company_id)->where('instant_booking', 1)->get();
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

            $user_professional_detail = UserProfessionalDetail::where('company_id', $company_id)->first();
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
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        return view($view, compact('cart', 'company', 'user_professional_detail', 'services', 'max_price', 'min_price', 'terms', 'business_exp', 'business_term', 'business_spec', 'gallery', 'serviceData', 'companyData', 'servicePrice', 'businessSpec'));
    }

    public function newtest(Request $request) {
        return view('personal-profile.newtest');
    }

    public function Pfavourite(Request $request) {
        $fav_id = $request->cid;
        $loggedId = Auth::user()->id;
        $favData = UserFavourite::where('user_id',$loggedId)->where('favourite_user_id',$fav_id)->first();
        if(empty($favData)){
            $status = UserFavourite::create([
                        'user_id' => $loggedId,
                        'favourite_user_id' => $fav_id
            ]);
        }
    }

    public function Pfollow(Request $request) {       
        $followid = $request->cid;
        $followerid = $request->fid;
        $loggedId = Auth::user()->id;

        $follower_id = 0;

        if ($followid == '') {
            $follow_id = 0;
        } else {
            $follow_id = $followid;
        }

        if ($followerid == '') {
            $follower_id = 0;
        } else {
            $follower_id = $followerid;
        }
       
        $followData = UserFollow::where('user_id',$loggedId)->where('follow_id',$follow_id)->first();
        if(empty($followData)){
            $followerdata = UserFollow::create([
                        'user_id' => $loggedId,
                        'follow_id' => $follow_id,
                        'follower_id' => $follower_id
            ]);
        }
    }

    public function follow_profile(Request $request) {  
        if(Auth::check()){   
            $loggedId = Auth::user()->id; 
            $followerId = $request->followerId;
            $data = ProfileFollow::where('follower_id',$loggedId)->first();
            if(empty($data)){
                $followerdata = ProfileFollow::create([
                            'user_id' => $followerId,
                            'follower_id' => $loggedId
                ]);
            }
            return response()->json(array('success','success'));
        }else{
            return response()->json(array('success','error'));
        }
    }

    public function fav_profile(Request $request) {  
        if(Auth::check()){   
            $loggedId = Auth::user()->id; 
            $favId = $request->favId;
            $data = ProfileFav::where('fav_user_id',$loggedId)->first();
            if(empty($data)){
                $followerdata = ProfileFav::create([
                            'user_id' => $favId,
                            'fav_user_id' => $loggedId
                ]);
            }
            return response()->json(array('success','success'));
        }else{
            return response()->json(array('success','error'));
        }
    }

    public function removefollower(Request $request) {
        $remove_id = $request->fid;
        //$loggedId = Auth::user()->id;
        $del=UserFollow::where('user_id', $remove_id)->where('follower_id', Auth::user()->id)->delete();
        
        if($del){
            $response = array(
                'type' => 'success',
                'msg' => 'Successfully removed follower',
            );
        }
        else
        {
            $response = array(
                'type' => 'fail',
                'msg' => 'Something wrong please try again',
            );
        }
        
        return Response::json($response);
        //DB::update('update users_follow set follow_id = "0" where  user_id = "' . $remove_id . '"');
    }

    public function unfollow_company(Request $request) {

        $unfollow_id = $request->fid;
        $loggedId = Auth::user()->id;
        $del=UserFollow::where('user_id', Auth::user()->id)->where('follower_id', $unfollow_id)->delete();
        if($del){
            $response = array(
                'type' => 'success',
            );
        }
        else
        {
            $response = array(
                'type' => 'fail',
                'msg' => 'Something wrong please try again',
            );
        }
        return Response::json($response);
    }

    public function follow_back(Request $request) {
        if( !empty($request->id) ){ $follow_id = $request->id; } else{ $follow_id =0; }
        $user_id = $request->userid;

        $followback = UserFollow::create([
                    'user_id' => Auth::user()->id,
                    'follow_id' => $follow_id,
                    'follower_id' => $user_id
        ]);
        if($followback){
            $response = array( 'type' => 'success', );
        }
        else{
            $response = array( 'type' => 'fail', );
        }
        return Response::json($response);
    }

    public function getMyService1(Request $request) {

        $arr_service = json_decode($request->arr_service);

        $data = [];

        foreach ($arr_service as $value) {

            $v = UserService::where('id', $value)->first();

            $d = Sports::where('id', $v->sport)->get();

            $v['sport_name'] = $d[0]['sport_name'];

            array_push($data, $v);
        }

        return response()->json(['data' => $data]);
    }

    public function get_createcompanyform() {

        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity1111";

        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail', 'history', 'education', 'certification', 'service', 'skill'));

        $service = $UserProfileDetail['service'];

        $service = @$service[0]['sport'];

        if ($sports) {

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if (count($value1->child)) {

                        $sports_select .= "<optgroup label='" . $value1->title . "'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected = null; // ($service==$key2)?"selected":"";

                            $sports_select .= "<option value='" . $key2 . "' " . $selected . " >" . $value2 . "</option>";
                        }

                        $sports_select .= "</optgroup>";
                    } else {

                        $selected = null; //($service==$value1->value)?"selected":"";

                        $sports_select .= "<option value='" . $value1->value . "' " . $selected . ">" . $value1->title . "</option>";
                    }
                }
            }
        }



        // dd($UserProfileDetail);
        // die;



        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();



        // dd($loggedinUser['id']);
        // die;

        if (UserProfessionalDetail::where('user_id', $loggedinUser['id'])->first() == null) {

            $ProfessionalDetail = UserProfessionalDetail::orderBy('id', 'DESC')->first();
        } else {

            $ProfessionalDetail = UserProfessionalDetail::where('user_id', $loggedinUser['id'])->first();
        }



        return view('profiles.createCompany', [

            'languages' => $languages,
            'UserProfileDetail' => $UserProfileDetail,
            'ProfessionalDetail' => $ProfessionalDetail,
            'sports_select' => $sports_select,
            'sport_dd' => $sport_dd + $sports_names,
            'businessType' => $businessType,
            'activity' => $activity,
            'programType' => $programType,
            'programFor' => $programFor,
            'teaching' => $teaching,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "COMPLETE PROFILE",
            'allLanguages' => $languages,
            'timeSlots' => $timeSlots,
            'mydetails' => User::find($loggedinUser['id'])
        ]);
    }

    public function mybusinessusertag(Request $request) {
        $count = CompanyInformation::where('business_user_tag', $request->email)->count();
        return response()->json(['status' => 200, 'count' => $count]);
    }

    public function manageCompany(Request $request) {
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        $company = CompanyInformation::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('profiles.manageCompany', compact('company', 'cart'));
    }

    public function changecompanystatus(Request $request) {
        if($request->status == 'DEACTIVATE'){
            $status = '0';
        }else{
            $status = '1';
        }
       CompanyInformation::where('id',$request->cid)->update(['status'=> $status]);
       return $status;
    }
    
    public function deleteCompany(Request $request) {
        //print_r($request->company_id);die;
        UserEducation::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->delete();
        UserEmploymentHistory::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->delete();
        UserCertification::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->delete();
        UserSkillAward::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->delete();
        UserProfessionalDetail::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->delete();
        UserService::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->delete();
        CompanyInformation::where('id', $request->company_id)->where('user_id', Auth::user()->id)->delete();
        return response()->json(['type' => 'success', 'msg' => 'Company delete successfully', 'redirecturl' => '']);
    }

    public function editCompany(Request $request) {
        if (!Gate::allows('profile_edit_access')) {
            // $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/profile/viewProfile');
        }
        if ((CompanyInformation::where('id', $request->company_id)->where('user_id', Auth::user()->id)->count()) == 0) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/profile/viewProfile');
        }
        $loggedinUser = Auth::user();
        $sports = $this->sports->getAlphabetsWiseSportsNames();
        $sports_names = $this->sports->getAllSportsNames(1);
        $sport_dd = array();
        $sports_select = '';
        $sport_dd[""] = "Choose a Sport/Activity";
        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail', 'history', 'education', 'certification', 'service', 'skill'));
        $service1 = UserService::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->get();
        $UserProfileDetail['service'] = $service1;
        $service = $UserProfileDetail['service'];
        $service = @$service[0]['sport'];
        if ($sports) {
            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";
            foreach ($sports as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    if (count($value1->child)) {
                        $sports_select .= "<optgroup label='" . $value1->title . "'>";
                        foreach ($value1->child as $key2 => $value2) {
                            $selected = null; // ($service==$key2)?"selected":"";
                            $sports_select .= "<option value='" . $key2 . "' " . $selected . " >" . $value2 . "</option>";
                        }
                        $sports_select .= "</optgroup>";
                    } else {
                        $selected = null; //($service==$value1->value)?"selected":"";
                        $sports_select .= "<option value='" . $value1->value . "' " . $selected . ">" . $value1->title . "</option>";
                    }
                }
            }
        }
        $education1 = UserEducation::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->get();
        $UserProfileDetail['education'] = $education1;
        $certification1 = UserCertification::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->get();
        $UserProfileDetail['certification'] = $certification1;
        $history1 = UserEmploymentHistory::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->get();
        $UserProfileDetail['employmenthistory'] = $history1;
        $skill1 = UserSkillAward::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->get();
        $UserProfileDetail['skill'] = $skill1;
        $professional_detail1 = UserSkillAward::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->get();
        $ProfessionalDetail1 = UserProfessionalDetail::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->first();
        $UserProfileDetail['professional_detail'] = $professional_detail1;
        $UserProfileDetail['ProfessionalDetail'] = $ProfessionalDetail1;
        //dd($UserProfileDetail['ProfessionalDetail']);die;
        $businessType = Miscellaneous::businessType();
        $programType = Miscellaneous::programType();
        $programFor = Miscellaneous::programFor();
        $numberOfPeople = Miscellaneous::numberOfPeople();
        $ageRange = Miscellaneous::ageRange();
        $expLevel = Miscellaneous::expLevel();
        $serviceLocation = Miscellaneous::serviceLocation();
        $pFocuses = Miscellaneous::pFocuses();
        $duration = Miscellaneous::duration();
        $servicePriceOption = Miscellaneous::servicePriceOption();
        $specialDeals = Miscellaneous::specialDeals();
        $activity = Miscellaneous::activity();
        $teaching = Miscellaneous::teaching();
        $languages = Miscellaneous::getLanguages();
        $timeSlots = Miscellaneous::getTimeSlot();
        return view('profiles.editCompany', [
            'company_id' => $request->company_id,
            'UserProfileDetail' => $UserProfileDetail,
            'sports_select' => $sports_select,
            'sport_dd' => $sport_dd + $sports_names,
            'businessType' => $businessType,
            'activity' => $activity,
            'programType' => $programType,
            'programFor' => $programFor,
            'teaching' => $teaching,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "COMPLETE PROFILE",
            'allLanguages' => $languages,
            'timeSlots' => $timeSlots,
            'mydetails' => CompanyInformation::where('id', $request->company_id)->where('user_id', Auth::user()->id)->first()
        ]);
    }

    public function uploadPic(Request $request) {
        if ($request->hasFile('frm_profile_pic')) {
            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'service_profile_pic' . DIRECTORY_SEPARATOR;
            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'service_profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('frm_profile_pic'), $file_upload_path, 1, $thumb_upload_path, '247', '266');
            $image_name = $image_upload['filename'];
        } else {

            $image_name = $request->old_profile_pic;
        }
    }

    public function createNewService(Request $request) {
        if ($request->hasFile('frm_profile_pic')) {

            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'service_profile_pic' . DIRECTORY_SEPARATOR;



            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'service_profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;



            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('frm_profile_pic'), $file_upload_path, 1, $thumb_upload_path, '247', '266');



            $image_name = $image_upload['filename'];
        } else {

            $image_name = $request->old_profile_pic;
        }

        $available_dates = [];

        $dateee = \DateTime::createFromFormat("m-d-Y", $request->starting_date);

        $request->starting_date = $dateee->format('Y-m-d');

        if ($request->class_meets == 'Weekly') {



            //print_r($sdate);die;

            $this->arr = [];

            $day_arr = json_decode($request->serv_time_slot);

            foreach ($day_arr as $value) {

                if ($value->sunday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Sunday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->monday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Monday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->tuesday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Tuesday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->wednesday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Wednesday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->thrusday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Thrusday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->friday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Friday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->saturday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Saturday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }
            }

            //print_r($this->arr);die;

            Log::info("called");





            $available_dates = $this->arr;

            Log::info($available_dates);
        } else {

            $this->arr = [$request->starting_date];

            $available_dates = $this->arr;
        }

        // die;

        $inserted = array(
            'user_id' => Auth::user()->id,
            'image' => $image_name,
            'sport' => $request->frm_servicesport,
            'title' => $request->frm_servicetitle,
            'price' => $request->frm_serviceprice,
            'timeslot_from' => $request->frm_servicetimeslotfrom,
            'timeslot_to' => $request->frm_servicetimeslotto,
            'servicedesc' => $request->frm_servicedesc,
            'servicetype' => json_encode(json_decode($request->frm_servicetype), JSON_FORCE_OBJECT),
            'programtype' => $request->frm_programtype,
            'agerange' => json_encode(json_decode($request->frm_agerange), JSON_FORCE_OBJECT),
            'programfor' => json_encode(json_decode($request->frm_programfor), JSON_FORCE_OBJECT),
            'numberofpeople' => json_encode(json_decode($request->frm_numberofpeople), JSON_FORCE_OBJECT),
            'experience_level' => json_encode(json_decode($request->frm_experience_level), JSON_FORCE_OBJECT),
            'servicelocation' => json_encode(json_decode($request->frm_servicelocation), JSON_FORCE_OBJECT),
            'focuses' => json_encode(json_decode($request->frm_servicefocuses), JSON_FORCE_OBJECT),
            'specialdeals' => json_encode(json_decode($request->frm_specialdeals), JSON_FORCE_OBJECT),
            'servicepriceoption' => json_encode(json_decode($request->frm_servicepriceoption), JSON_FORCE_OBJECT),
            'duration' => $request->frm_serviceduration,
            'terms_conditions' => $request->termcondfaqtext,
            "expire_days" => $request->expire_days,
            "expire_in_option" => $request->expire_in_option1,
            "expire_in_option2" => $request->expire_in_option2,
            "sessions" => $request->sessions,
            "multiple_count" => $request->multiple_count,
            "recurring_pay" => $request->recurring_pay,
            "introoffer" => $request->introoffer,
            "runautopay" => $request->runautopay,
            "often" => $request->often,
            "often_every_op1" => $request->often_every_op1,
            "often_every_op2" => $request->often_every_op2,
            "numberofpays" => $request->numberofpays,
            "chargeclients" => $request->chargeclients,
            "termcondfaq" => $request->termcondfaq,
            'terms_conditions' => $request->termcondfaqtext,
            "contractterms" => $request->contractterms,
            "contracttermstext" => $request->contracttermstext, 
            "liability" => $request->liability,
            "liabilitytext" => $request->liabilitytext,
            "covid" => 1,
            "covidtext" => $request->covidtext,
            "refundpolicy" => $request->refundpolicy,
            "refundpolicytext" => $request->refundpolicytext,
            "setupprice" => $request->setupprice,
            "offerpro_states" => $request->offerpro_states,
            "activitydesignsfor" => json_encode(json_decode($request->activitydesignsfor), JSON_FORCE_OBJECT),
            "activitytype" => json_encode(json_decode($request->activitytype), JSON_FORCE_OBJECT),
            "frm_teachingstyle" => json_encode(json_decode($request->frm_teachingstyle), JSON_FORCE_OBJECT),
            "salestax" => $request->salestax,
            "after_drop" => $request->after_drop,
            "salestaxpercentage" => $request->salestaxpercentage,
            "duestax" => $request->duestax,
            "duestaxpercentage" => $request->duestaxpercentage,
            //  "serv_time_slot" =>json_encode(json_decode($request->hours)),
            //  'company_id'=>$company_data->id,
            'serv_time_slot' => $request->serv_time_slot,
            'class_meets' => $request->class_meets,
            'starting_date' => $request->starting_date,
            'end_date' => $request->end_date,
            'available_dates' => json_encode($available_dates),
            'schedule_until' => $request->schedule_until
        );



        $serviceObj = DB::table('user_services')
                ->insert($inserted);

        $data = UserService::orderBy('id', 'DESC')->first();

        //$id = DB::getPdo()->lastInsertId();

        return response()->JSON(['status' => 200, 'message' => $data]);
    }

    public function deleteNewService(Request $request) {

        UserService::where('id', $request->service_id)->delete();

        return response()->json(['status' => 200]);
    }

    public function companyImageUpload(Request $request) {

        $company = CompanyInformation::where('id', $request->company_id)->first();

        if ($company->company_images != null) {

            $file_arr = json_decode($company->company_images);
        } else {

            $file_arr = [];
        }

        $images = $request->file('images');

        if ($request->hasFile('images')) {

            //print_r("dsfdsf");die;

            foreach ($images as $item) {



                $file = $item;

                $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR;

                $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail1($item, $file_upload_path, 1, $thumb_upload_path);

                array_push($file_arr, $image_upload['filename']);

                //$request->profile_pic =$image_upload['filename'];
                //Store thumb

                if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {

                    mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);
                }

                $thumb_upload_path150 = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb150' . DIRECTORY_SEPARATOR;

                Image::make($item)->save($thumb_upload_path150 . $image_upload['filename']);
            }
        }

        $company->company_images = json_encode($file_arr);

        $company->save();

        return redirect()->back();
    }

    public function userImageUpload(Request $request) {

        $company = User::where('id', Auth::user()->id)->first();

        if ($company->company_images != null) {

            $file_arr = json_decode($company->company_images);
        } else {

            $file_arr = [];
        }

        $images = $request->file('images');

        if ($request->hasFile('images')) {

            //print_r("dsfdsf");die;

            foreach ($images as $item) {



                $file = $item;

                $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR;

                $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail1($item, $file_upload_path, 1, $thumb_upload_path);

                array_push($file_arr, $image_upload['filename']);

                //$request->profile_pic =$image_upload['filename'];
                //Store thumb

                if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {

                    mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);
                }

                $thumb_upload_path150 = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb150' . DIRECTORY_SEPARATOR;

                Image::make($item)->save($thumb_upload_path150 . $image_upload['filename']);
            }
        }

        $company->company_images = json_encode($file_arr);

        $company->save();

        return redirect()->back();
    }
    
    public function viewGalleryList($user_id) {
        $galleryPic = [];
        $gallery = DB::select('select id, attachment_name, cover_photo from users_add_attachment where user_id = ? and cover_photo = 1 order by cover_order ASC', [$user_id]);
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

    public function galleryUpload(Request $request) {

        if ($request->hasFile('galleryphoto')) {
            $uid = Auth::user()->id;
            $gallery_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . $uid . DIRECTORY_SEPARATOR;
            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR . $uid . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::uploadPhotoGallery($request->galleryphoto, $gallery_upload_path, 1, $thumb_upload_path, 130, 100);

            if (isset($image_upload['filename'])) {
                $result['success'] = "File is valid, and was successfully uploaded.\n";
                DB::insert('insert into users_add_attachment (user_id, attachment_name, attachment_data, attachment_status) values (?, ?, ?, ?)', [$uid, $image_upload['filename'], '', 1]);
            } else {
                $result['error'] = "Possible file upload attack!\n";
            }

            return redirect()->route('profile-viewProfile');
        }

        /*         * **************** Dropzone ************************
          $result = [];
          $file_array = [];
          $file_array['uid_attach'] = isset($request->uid_attach) ? $request->uid_attach : 0;

          if (!file_exists(public_path('uploads/gallery/'.$file_array['uid_attach']))) {
          mkdir(public_path('uploads/gallery/'.$file_array['uid_attach']), 0755, true);
          }

          $uploaddir = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR.$file_array['uid_attach'].DIRECTORY_SEPARATOR;

          $uploadfile = $uploaddir . basename($_FILES['file']['name']);

          if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
          $result['success'] = "File is valid, and was successfully uploaded.\n";
          DB::insert('insert into users_add_attachment (user_id, attachment_name, attachment_data, attachment_status) values (?, ?, ?, ?)', [$file_array['uid_attach'], $_FILES['file']['name'], '', 1]);
          } else {
          $result['error'] = "Possible file upload attack!\n";
          }

          return Response::json($result);
         */
    }

    public function createCompany(Request $request) {
        //die;
        // print_r($request->all());die;
        // save profile pic

        $image = new Image();

        $request->profile_pic = '';

        if ($request->hasFile('profile_pic')) {

            $file = Input::file('profile_pic');

            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('profile_pic'), $file_upload_path, 1, $thumb_upload_path, '415', '354');

            $request->profile_pic = $image_upload['filename'];

            //Store thumb

            if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {

                mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);
            }

            $thumb_upload_path150 = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb150' . DIRECTORY_SEPARATOR;

            Image::make($request->file('profile_pic'))->resize(150, 150)->save($thumb_upload_path150 . $image_upload['filename']);
        }

        if ($request->mybusinessid && $request->mybusinessid != '0' && $request->mybusinessid != 0) {

            $business = BusinessClaim::where('id', $request->mybusinessid)->first();

            $website = $business->website;
        }



        $data = $request->all();

        $company_data = new CompanyInformation();

        $company_data->user_id = Auth::user()->id;

        $company_data->first_name = $data['company_representative_first_name'];

        $company_data->last_name = $data['company_representative_last_name'];

        $company_data->company_name = $data['company_name'];

        $company_data->address = $data['address'];

        $company_data->email = $data['email'];

        $company_data->city = $data['city'];

        $company_data->state = $data['state'];

        $company_data->zip_code = $data['zipcode'];

        $company_data->latitude = $data['latitude'];

        $company_data->longitude = $data['longitude'];

        $company_data->country = $data['country'];

        $company_data->contact_number = $data['contact_number'];

        $company_data->ein_number = $data['ein_number'];

        $company_data->establishment_year = $data['establishment_year'];

        $company_data->business_user_tag = $data['business_user_tag'];

        $company_data->about_company = $data['about_company'];

        $company_data->short_description = $data['short_description'];

        $company_data->website = $request->mybusinessid && $request->mybusinessid != '0' && $request->mybusinessid != 0 ? $website : NULL;



        if (isset($request->profile_pic) && $request->profile_pic != '') {

            // save new profile pic

            $company_data->logo = $request->profile_pic;
        }

        if (!$company_data->save()) {

            return response()->json(['type' => 'danger', 'msg' => 'Some error has occured while registering company!', 'redirecturl' => '']);
        } else {

            if ($request->course != '' || $request->university != '' || $request->passing_year != '') {

                $education = new UserEducation();

                $education->user_id = Auth::user()->id;

                $education->course = $request->course;

                $education->university = $request->university;

                if ($request->passing_year != '') {

                    $education->passing_year = $request->passing_year;
                }

                $education->company_id = $company_data->id;

                $education->save();
            }

            if ($request->organization != '' && $request->position != '' && $request->service_start != '') {

                $education = new UserEmploymentHistory();

                $education->user_id = Auth::user()->id;

                $education->organization = $request->organization;

                $education->position = $request->position;

                $education->company_id = $company_data->id;

                $dates = \DateTime::createFromFormat("m-d-Y", $request->service_start);

                //$education->service_start = $request->service_start;

                $education->service_start = $dates->format('Y-m-d');

                if ($request->is_present == '') {

                    $education->is_present = 0;
                } else {

                    $education->is_present = $request->is_present;

                    if ($request->service_end != 'Till Date') {

                        $datee = \DateTime::createFromFormat("m-d-Y", $request->service_end);

                        $education->service_end = $datee->format('Y-m-d');
                    }
                }

                $education->save();
            }



            if ($request->title != '' && $request->completion_date != '') {

                $certificate = new UserCertification();

                $certificate->user_id = Auth::user()->id;

                $certificate->title = $request->title;

                $datee = \DateTime::createFromFormat("m-d-Y", $request->completion_date);

                $certificate->completion_date = $datee->format('Y-m-d');

                $certificate->company_id = $company_data->id;

                $certificate->save();
            }



            if ($request->type != '' && $request->skill_completion_date != '') {

                $skil_award = new UserSkillAward();

                $skil_award->user_id = Auth::user()->id;

                $skil_award->type = $request->type;

                $datee = \DateTime::createFromFormat("m-d-Y", $request->skill_completion_date);

                // $certificate->completion_date = $datee->format('Y-m-d');

                $skil_award->completion_date = $datee->format('Y-m-d');

                $skil_award->skill_detail = $request->skill_detail;

                $skil_award->company_id = $company_data->id;

                $skil_award->save();
            }



            $update = array(
                'experience_level' => json_encode(json_decode($request->experience_level), JSON_FORCE_OBJECT),
                'train_to' => json_encode(json_decode($request->train_to), JSON_FORCE_OBJECT),
                'personality' => json_encode(json_decode($request->personality), JSON_FORCE_OBJECT),
                'availability' => json_encode($request->availability),
                'languages' => json_encode(json_decode($request->languages), JSON_FORCE_OBJECT),
                'skill_lavel' => json_encode(json_decode($request->skill_lavel), JSON_FORCE_OBJECT),
                'medical_states' => $request->medical_states,
                'medical_type' => json_encode(json_decode($request->medical_type), JSON_FORCE_OBJECT),
                'work_locations' => json_encode(json_decode($request->work_locations), JSON_FORCE_OBJECT),
                'goals_states' => $request->goals_states,
                'goals_option' => json_encode(json_decode($request->goals_option), JSON_FORCE_OBJECT),
                'hours' => $request->hours_opt != 'undefined' ? $request->hours_opt : null,
                'timezone' => $request->timezone,
                'special_days_off' => $request->special_days_off,
                'notice_each_book' => '{"' . $request->notice_each_book_day . '":"' . $request->notice_each_book_ans . '"}',
                'advance_book' => '{"' . $request->advance_book_day . '":"' . $request->advance_book_ans . '"}',
                'willing_to_travel' => $request->willing_to_travel,
                'travel_miles' => $request->travel_miles,
                'travel_times' => NULL,
                'user_id' => Auth::user()->id,
                'company_id' => $company_data->id,
            );

            $id = DB::table('user_professional_details')->insertGetId($update);



            foreach (json_decode($request->arr_service) as $value) {

                $us = UserService::where('id', $value)->first();

                $us->company_id = $company_data->id;

                $us->save();
            }



            if ($request->mybusinessid && $request->mybusinessid != '0' && $request->mybusinessid != 0) {

                $business = BusinessClaim::where('id', $request->mybusinessid)->first();

                $business->is_verified = 1;

                $business->save();
            }





            //     if($request->hasFile('frm_profile_pic'))
            //     {
            //         $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR;
            //         $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;
            //         $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('frm_profile_pic'),$file_upload_path,1,$thumb_upload_path,'247','266');
            //         $image_name = $image_upload['filename'];
            //     }
            //     else
            //     {
            //         $image_name = $request->old_profile_pic;
            //     } 
            //     $available_dates = [];
            //     if($request->class_meets == 'Weekly'){
            //         //print_r($sdate);die;
            //         $this->arr = [];
            //         $day_arr = json_decode($request->serv_time_slot);
            //         foreach($day_arr as $value){
            //         if($value->sunday_start != ''){
            //           $sdate = date('Y-m-d', strtotime('next Sunday', strtotime($request->starting_date)));
            //           $this->mydate($sdate,$request->end_date);
            //         }
            //         if($value->monday_start != ''){
            //           $sdate = date('Y-m-d', strtotime('next Monday', strtotime($request->starting_date)));
            //           $this->mydate($sdate,$request->end_date);
            //         }
            //         if($value->tuesday_start != ''){
            //           $sdate = date('Y-m-d', strtotime('next Tuesday', strtotime($request->starting_date)));
            //           $this->mydate($sdate,$request->end_date);
            //         }
            //         if($value->wednesday_start != ''){
            //           $sdate = date('Y-m-d', strtotime('next Wednesday', strtotime($request->starting_date)));
            //           $this->mydate($sdate,$request->end_date);
            //         }
            //         if($value->thrusday_start != ''){
            //           $sdate = date('Y-m-d', strtotime('next Thrusday', strtotime($request->starting_date)));
            //           $this->mydate($sdate,$request->end_date);
            //         }
            //         if($value->friday_start != ''){
            //           $sdate = date('Y-m-d', strtotime('next Friday', strtotime($request->starting_date)));
            //           $this->mydate($sdate,$request->end_date);
            //         }
            //         if($value->saturday_start != ''){
            //           $sdate = date('Y-m-d', strtotime('next Saturday', strtotime($request->starting_date)));
            //           $this->mydate($sdate,$request->end_date);
            //         }
            //         }
            //         //print_r($this->arr);die;
            //         Log::info("called");
            //       $available_dates = $this->arr; 
            //         Log::info($available_dates);
            //     }
            //     else{
            //         $this->arr = [$request->starting_date];
            //         $available_dates = $this->arr;
            //     }
            //   // die;
            //      $inserted = array(
            //     'user_id' => Auth::user()->id,
            //     'image'=> $image_name,
            //     'sport' => $request->frm_servicesport,
            //     'title' => $request->frm_servicetitle,
            //     'price' => $request->frm_serviceprice,
            //     'timeslot_from' => $request->frm_servicetimeslotfrom,
            //     'timeslot_to' => $request->frm_servicetimeslotto,
            //     'servicedesc' => $request->frm_servicedesc,
            //     'servicetype' => json_encode(json_decode($request->frm_servicetype),JSON_FORCE_OBJECT),
            //     'programtype' => $request->frm_programtype,
            //     'agerange' => json_encode(json_decode($request->frm_agerange),JSON_FORCE_OBJECT),
            //     'programfor' => json_encode(json_decode($request->frm_programfor),JSON_FORCE_OBJECT),
            //     'numberofpeople' => json_encode(json_decode($request->frm_numberofpeople),JSON_FORCE_OBJECT),
            //     'experience_level' => json_encode(json_decode($request->frm_experience_level),JSON_FORCE_OBJECT),
            //     'servicelocation' => json_encode(json_decode($request->frm_servicelocation),JSON_FORCE_OBJECT),
            //     'focuses' => json_encode(json_decode($request->frm_servicefocuses),JSON_FORCE_OBJECT),
            //     'specialdeals' => json_encode(json_decode($request->frm_specialdeals),JSON_FORCE_OBJECT),
            //     'servicepriceoption' => json_encode(json_decode($request->frm_servicepriceoption),JSON_FORCE_OBJECT),
            //     'duration' => $request->frm_serviceduration,
            //     'terms_conditions' => $request->termcondfaqtext,
            //     "expire_days"=>$request->expire_days,
            //     "expire_in_option"=>$request->expire_in_option1,
            //     "expire_in_option2"=>$request->expire_in_option2,
            //     "sessions"=>$request->sessions,
            //     "multiple_count"=>$request->multiple_count,
            //     "recurring_pay"=>$request->recurring_pay,
            //     "introoffer"=>$request->introoffer,
            //     "runautopay"=>$request->runautopay,
            //     "often"=>$request->often,
            //     "often_every_op1"=>$request->often_every_op1,
            //     "often_every_op2"=>$request->often_every_op2,
            //     "numberofpays"=>$request->numberofpays,
            //     "chargeclients"=>$request->chargeclients,
            //     "termcondfaq"=>$request->termcondfaq,
            //     'terms_conditions' => $request->termcondfaqtext,
            //     "contractterms"=>$request->contractterms,
            //     "contracttermstext"=>$request->contracttermstext,
            //     "liability"=>$request->liability,
            //     "liabilitytext"=>$request->liabilitytext,
            //     "setupprice"=>$request->setupprice,
            //     "offerpro_states"=>$request->offerpro_states,
            //     "activitydesignsfor"=>json_encode(json_decode($request->activitydesignsfor),JSON_FORCE_OBJECT),
            //     "activitytype"=>json_encode(json_decode($request->activitytype),JSON_FORCE_OBJECT),
            //     "frm_teachingstyle"=>json_encode(json_decode($request->frm_teachingstyle),JSON_FORCE_OBJECT),
            //     "salestax"=>$request->salestax,
            //     "after_drop"=>$request->after_drop,
            //     "salestaxpercentage"=>$request->salestaxpercentage,
            //     "duestax"=>$request->duestax,
            //     "duestaxpercentage"=>$request->duestaxpercentage,
            //   //  "serv_time_slot" =>json_encode(json_decode($request->hours)),
            //     'company_id'=>$company_data->id,
            //     'serv_time_slot'=>$request->serv_time_slot,
            //     'class_meets'=>$request->class_meets,
            //     'starting_date'=>$request->starting_date,
            //     'end_date'=>$request->end_date,
            //     'available_dates'=>json_encode($available_dates),
            //     'schedule_until'=>$request->schedule_until
            // );
            //     $serviceObj = DB::table('user_services')
            //                     ->insert($inserted);
            // $msg = "Service saved successfully!";

            if ($id) {

                $u = User::where('id', Auth::user()->id)->first();
                
                //$u->role = 'business'; /* Changed by manoj 08Aug21 */
                $u->role = 'customer';

                $u->is_upgrade = 1;

                $u->save();

                return response()->json(['type' => 'success', 'msg' => 'Create Company successfully', 'redirecturl' => '']);
            }
        }
    }

    public function mydate($date, $end_date) {

        //$this->arr[] = $date;

        Log::info("date " . $date);

        array_push($this->arr, $date);

        $date = strtotime($date);

        $date = strtotime("+7 day", $date);

        if ((date('Y-m-d', $date)) <= (date('Y-m-d', strtotime($end_date)))) {

            $this->mydate(date('Y-m-d', $date), $end_date);
        } else {

            Log::info($this->arr);

            return $this->arr;
        }

        //echo date('M d, Y', $date);
    }

    public function switchAccount(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        if ($user->is_upgrade == 1) {
            /* Changed by manoj 08Aug21 */
            /*
            if ($request->manage_company) {
                $user->role = 'business';
            } else {
                if ($user->role == 'customer')
                    $user->role = 'business';
                else
                    $user->role = 'customer';
            }
            */
            if ($request->manage_company) {
                $user->role = 'customer';
            } else {
                if ($user->role == 'customer')
                    $user->role = 'customer';
                else
                    $user->role = 'customer';
            }
            $user->save();
            $response = array(
                'type' => 'success',
                'msg' => 'Successfully switch account',
            );
        } else {
            $response = array(
                'type' => 'error',
                'msg' => 'Error switch account',
            );
        }
        return Response::json($response);
    }

    public function createBusinessProfile(Request $request) {

        $userObj = new BusinessInformation();

        $s = AddrStates::where('state_name', $request->state)->get();

        $c = AddrCities::where('city_name', $request->city)->get();

        $userObj->user_id = Auth::user()->id;

        $userObj->company_name = $request->company_name;

        $userObj->address = $request->address;

        $userObj->city = @$c[0]->id;

        $userObj->state = @$s[0]->id;

        $userObj->country = strtoupper($request->country);

        $userObj->zip_code = $request->zipcode;

        $userObj->ein_number = $request->b_EINnumber;

        $userObj->establishment_year = $request->b_Establishmentyear;

        // get lat long

        $latlongdata = Miscellaneous::getLatLong($request->zipcode);

        $userObj->latitude = $latlongdata['lat'];

        $userObj->longitude = $latlongdata['long'];

        $userObj->save();

        $response = array(
            'type' => 'success',
            'msg' => 'Successfully created business',
        );

        return Response::json($response);
    }

    public function upgradeBusinessProfile(Request $request) {

        $userObj = User::where('id', Auth::user()->id)->first();

        $s = AddrStates::where('state_name', $request->state)->get();

        $c = AddrCities::where('city_name', $request->city)->get();

        $userObj->company_name = $request->company_name;

        $userObj->address = $request->address;

        $userObj->city = @$c[0]->id;

        $userObj->state = @$s[0]->id;

        $userObj->country = strtoupper($request->country);

        $userObj->zipcode = $request->zipcode;

        $userObj->ein_number = $request->b_EINnumber;

        $userObj->establishment_year = $request->b_Establishmentyear;
        
        //$userObj->role = 'business'; /* Changed by Manoj 08Aug21 */
        $userObj->role = 'customer';

        $userObj->is_upgrade = 1;

        // get lat long

        $latlongdata = Miscellaneous::getLatLong($request->zipcode);

        $userObj->latitude = $latlongdata['lat'];

        $userObj->longitude = $latlongdata['long'];

        $userObj->save();

        if ($request->course != '' && $request->university != '' && $request->passing_year != '') {

            $education = new UserEducation();

            $education->user_id = Auth::user()->id;

            $education->course = $request->course;

            $education->university = $request->university;

            $education->passing_year = $request->passing_year;

            $education->save();
        }

        if ($request->organization != '' && $request->position != '' && $request->service_start != '') {

            $education = new UserEmploymentHistory();

            $education->user_id = Auth::user()->id;

            $education->organization = $request->organization;

            $education->position = $request->position;

            $education->service_start = $request->service_start;

            if ($request->is_present == '') {

                $education->is_present = 0;
            } else {

                $education->is_present = $request->is_present;

                $education->service_end = date('Y-m-d', strtotime($request->service_end));
            }

            $education->save();
        }



        if ($request->title != '' && $request->completion_date != '') {

            $certificate = new UserCertification();

            $certificate->user_id = Auth::user()->id;

            $certificate->title = $request->title;

            $certificate->completion_date = $request->completion_date;

            $certificate->save();
        }



        if ($request->type != '' && $request->skill_completion_date != '') {

            $skil_award = new UserSkillAward();

            $skil_award->user_id = Auth::user()->id;

            $skil_award->type = $request->type;

            $skil_award->completion_date = $request->skill_completion_date;

            $skil_award->skill_detail = $request->skill_detail;

            $skil_award->save();
        }

        $response = array(
            'type' => 'success',
            'msg' => 'Successfully upgraded profile',
        );

        return Response::json($response);
    }

    public function postChangePassword(Request $request) {

        $postArr = $request->all();

        $rules = [

            'current_password' => 'required',
            'password' => 'required|same:password_confirmation|min:8',
            'password_confirmation' => 'required|same:password|min:8',
        ];

        $validator = Validator::make($postArr, $rules);

        if ($validator->fails()) {

            //return redirect->back()->withErrors

            return redirect('profile/change-password')->withErrors($validator)->withInput();
        } else {

            $user = User::where('id', Auth::user()->id)->first();

            //print_r($postArr['password']);die;

            if (Hash::check($postArr['current_password'], $user->password)) {

                // print_r("if");die;

                $user->password = bcrypt($postArr['password']);

                $user->save();

                $request->session()->flash('success', 'Password changed successfully !');

                return redirect('profile/viewProfile');
            } else {

                // print_r("else");die;

                $request->session()->flash('alert-danger', 'Current password not match');

                //return redirect()->back();

                return redirect('/profile/change-password');
            }
        }
    }

    public function viewChangePassword() {

        return view('profiles/changePassword');
    }

    public function check() {

        if (!(Auth::check())) {

            Auth::loginUsingId(230, true);
        } else {

            print_r("called");
            die;
        }
    }

    public function submitFamilyForm() {

        $postArr = Input::all();

        $rules = [

            'first_name' => 'required',
            'last_name' => 'required',
            // 'email'             => 'required|email',
            //'relationship'          => 'required',
            //'gender'  => 'required',
            //'birthday'  => 'required',
            'mobile' => 'required'
        ];

        $validator = Validator::make($postArr, $rules);

        if ($validator->fails()) {

            $errMsg = array();

            foreach ($validator->messages()->getMessages() as $field_name => $messages) {

                $errMsg = $messages;
            }

            $response = array(
                'type' => 'danger',
                'msg' => 'Validation fails',
            );

            return Response::json($response);
        } else {

            if ((UserFamilyDetail::where('user_id', Input::get('user_id'))->count()) == 0)
                $family = new UserFamilyDetail();
            else
                $family = UserFamilyDetail::where('user_id', Input::get('user_id'))->first();



            $family->user_id = Input::get('user_id');

            $family->first_name = Input::get('first_name');

            $family->last_name = Input::get('last_name');

            $family->email = Input::get('email');

            $family->mobile = Input::get('mobile');

            $family->gender = Input::get('gender');

            $family->relationship = Input::get('relationship');

            $family->emergency_contact = Input::get('emergency_contact');

            $family->birthday = Input::get('birthday');

            $family->save();

            Auth::loginUsingId(Input::get('user_id'), true);

            $url = '/profile/viewProfile';

            $response = array(
                'type' => 'success',
                'msg' => 'Successfully added family member',
                'redirecturl' => $url,
            );

            return Response::json($response);
        }
    }

    public function submitFamilyForm1(Request $request) {
        //print_r($request->all());exit();
        for($i=0;$i<=$request->familycnt;$i++){
            if($request->first_name[$i] != ''){
                
                $family = new UserFamilyDetail();
                $family->user_id = Auth::user()->id;
                $family->first_name = $request->first_name[$i];
                $family->last_name = $request->last_name[$i];
                $family->email = $request->email[$i];
                $family->mobile = $request->mobile[$i];
                $family->gender = $request->gender[$i];
                $family->relationship = $request->relationship[$i];
                $family->emergency_contact = $request->emergency_phone[$i];
                $family->birthday = date('Y-m-d',strtotime($request->birthday[$i]));
                $family->save();
            }
        }

        Auth::loginUsingId(Input::get('user_id'), true);

        $url = '/';
        $claim = 'not set';
        $claim_cid = '';
        $claim_cname = '';
        if(session()->has('claim_business_page')) {
            $claim = 'set';
            $claim_cid = session()->get('claim_cid');
            $data = CompanyInformation::where('id',$claim_cid)->first();
            if($data != ''){
                $claim_cname = $data->dba_business_name;
            }
        }
        if($claim  == 'set'){
            $url =  '/claim/reminder/'.$claim_cname."/".$claim_cid; 
        }

        $response = array(
            'type' => 'success',
            'msg' => 'Successfully added family member',
            'redirecturl' => $url,
        );

        return Response::json($response);
    }

    public function skipFamilyForm1(Request $request) {

        Auth::loginUsingId(Auth::user()->id, true);

        $url = '/';
        $claim = 'not set';
        $claim_cid = '';
        $claim_cname = '';
        if(session()->has('claim_business_page')) {
            $claim = 'set';
            $claim_cid = session()->get('claim_cid');
            $data = CompanyInformation::where('id',$claim_cid)->first();
            if($data != ''){
                $claim_cname = $data->dba_business_name;
            }
        }
        if($claim  == 'set'){
            $url =  '/claim/reminder/'.$claim_cname."/".$claim_cid; 
        }

        $response = array(
            'type' => 'success',
            'msg' => 'Successfully logged in',
            'redirecturl' => $url,
        );

        return Response::json($response);
    }

    public function submitFamilyFormWithSkip(Request $request) {

        Auth::loginUsingId($request->user_id, true);

        $url = '/profile/viewProfile';

        $response = array(
            'type' => 'success',
            'msg' => 'Successfully logged in',
            'redirecturl' => $url,
        );

        return Response::json($response);
    }

    public function familyProfileUpdate(Request $request) {

        $user = User::where('confirmation_code', $request->user_id)->count();

        if ($user != 0) {



            $data = User::where('confirmation_code', $request->user_id)->first();

            return view('auth.family')->with('user_id', $data->id);
        } else {



            return view('auth.family')->with('error_msg', 'Invalid Request');
        }
    }

    /* public function sam(){

      require_once(base_path().'/buddy/wp-load.php');

      require_once(base_path().'/buddy/wp-blog-header.php');







      } */

    // protected function historyValidator($data)
    // {
    //     return Validator::make($data, [            
    //                 'organization' => 'required|max:255',
    //                 'position' => 'required|max:255',
    //                 'servicestart' => 'required|max:255',
    //                 'serviceend' => 'required|max:255',  
    //             ],
    //             [
    //                 'required' => 'The :attribute is required.',
    //             ]);
    // }

    public function historyValidator() {

        $data = Input::all();

        //print_r($data);die;

        $validator = Validator::make($data, [

                    'organization' => 'required|max:255',
                        //'position' => 'required|max:255',
                        // 'passingyear' => 'required|max:255',
                        ], [

                    'required' => 'The :attribute is required.',
        ]);

        if ($validator->fails()) {

            $response = array(
                'type' => 'danger',
                'msg' => 'Validation fails',
            );

            return Response::json($response);
        } else {

            $history_id = Input::get('history_id');

            if ($history_id != '' && $history_id != null && $history_id != 'undefined') {

                $education = UserEmploymentHistory::where('id', $history_id)->first();

                $msg = 'updated';
            } else {

                $msg = 'added';

                $education = new UserEmploymentHistory();
            }

            if (Input::get('company_id')) {

                $education->company_id = Input::get('company_id');
            }

            $education->user_id = Auth::user()->id;

            $education->organization = Input::get('organization');

            $education->position = Input::get('position');

            if (Input::get('is_present') == '') {

                $education->is_present = 0;
            } else {

                $education->is_present = Input::get('is_present');

                if (Input::get('service_end') != 'Till Date') {

                    $dateee = \DateTime::createFromFormat("m-d-Y", Input::get('service_end'));

                    $education->service_end = $dateee->format('Y-m-d');
                }

                //$education->service_end = date('Y-m-d', strtotime(Input::get('service_end'))) ;
            }

            $dateee = \DateTime::createFromFormat("m-d-Y", Input::get('service_start'));

            $education->service_start = $dateee->format('Y-m-d');

            //$education->service_start = date('Y-m-d', strtotime(Input::get('service_start'))) ;



            $education->save();

            $response = array(
                'type' => 'success',
                'msg' => 'Successfully ' . $msg . ' user employee history details',
                'id' => $education->id

                    //'redirecturl' => $url,
            );

            return Response::json($response);
        }
    }

    public function EducationValidator() {

        $data = Input::all();

        //print_r($data);die;

        $validator = Validator::make($data, [

                    'course' => 'required|max:255',
                    'university' => 'required|max:255',
                        // 'passingyear' => 'required|max:255',
                        ], [

                    'required' => 'The :attribute is required.',
        ]);

        if ($validator->fails()) {

            $response = array(
                'type' => 'danger',
                'msg' => 'Validation fails',
            );

            return Response::json($response);
        } else {

            $history_id = Input::get('education_id');

            if ($history_id != '' && $history_id != null && $history_id != 'undefined') {

                $education = UserEducation::where('id', $history_id)->first();

                $msg = 'updated';
            } else {

                $education = new UserEducation();

                $msg = 'added';
            }

            if (Input::get('company_id')) {

                $education->company_id = Input::get('company_id');
            }

            $education->user_id = Auth::user()->id;

            $education->course = Input::get('course');

            $education->university = Input::get('university');

            $dateee = \DateTime::createFromFormat("Y", Input::get('passing_year'));

            $education->passing_year = $dateee->format('Y-m-d');

            $education->save();

            $response = array(
                'type' => 'success',
                'msg' => 'Successfully ' . $msg . ' education details',
                //'redirecturl' => $url,
                'id' => $education->id
            );

            return Response::json($response);
        }
    }

    public function deleteData(Request $request) {

        $data = $request->all();

        if ($data['selection_data'] == 'education_id') {

            UserEducation::where('id', $data['id'])->delete();

            $response = array(
                'type' => 'success',
                'msg' => 'Successfully deleted education detail',
                    //'redirecturl' => $url,
            );

            return Response::json($response);
        } else if ($data['selection_data'] == 'certificate_id') {

            UserCertification::where('id', $data['id'])->delete();

            $response = array(
                'type' => 'success',
                'msg' => 'Successfully deleted certificate data',
                    //'redirecturl' => $url,
            );

            return Response::json($response);
        } else if ($data['selection_data'] == 'skillaward_id') {

            UserSkillAward::where('id', $data['id'])->delete();

            $response = array(
                'type' => 'success',
                'msg' => 'Successfully deleted skill data',
                    //'redirecturl' => $url,
            );

            return Response::json($response);
        } else {

            UserEmploymentHistory::where('id', $data['id'])->delete();

            $response = array(
                'type' => 'success',
                'msg' => 'Successfully deleted emplyee history data',
                    //'redirecturl' => $url,
            );

            return Response::json($response);
        }
    }

    // protected function EducationValidator()
    // {
    //     $data = Input::all();
    //     return Validator::make($data, [            
    //                 'course' => 'required|max:255',
    //                 'university' => 'required|max:255',
    //                 'passingyear' => 'required|max:255',
    //             ],
    //             [
    //                 'required' => 'The :attribute is required.',
    //             ]);
    // }
    // protected function CertificationValidator($data)
    // {
    //     return Validator::make($data, [            
    //                 'certificatetitle' => 'required|max:255',
    //                 'certificatetitle' => 'required|max:255',
    //             ],
    //             [
    //                 'required' => 'The :attribute is required.',
    //             ]);
    // }

    public function CertificationValidator() {

        $data = Input::all();

        $validator = Validator::make($data, [

                    'title' => 'required|max:255',
                        ], [

                    'required' => 'The :attribute is required.',
        ]);

        if ($validator->fails()) {

            $response = array(
                'type' => 'danger',
                'msg' => 'Validation fails',
            );

            return Response::json($response);
        } else {

            $history_id = Input::get('certificate_id');

            if ($history_id != '' && $history_id != null && $history_id != 'undefined') {

                $education = UserCertification::where('id', $history_id)->first();

                $msg = 'updated';
            } else {

                $msg = 'added';

                $education = new UserCertification();
            }

            if (Input::get('company_id')) {

                $education->company_id = Input::get('company_id');
            }

            $education->user_id = Auth::user()->id;

            $education->title = Input::get('title');

            $education->completion_date = date('Y-m-d', strtotime(Input::get('completion_date')));

            $education->save();

            $response = array(
                'type' => 'success',
                'msg' => 'Successfully ' . $msg . ' certification details',
                //'redirecturl' => $url,
                'id' => $education->id
            );

            return Response::json($response);
        }
    }

    public function skillAwardValidator() {

        $data = Input::all();

        $validator = Validator::make($data, [

                    'type' => 'required|max:255',
                        ], [

                    'required' => 'The :attribute is required.',
        ]);

        if ($validator->fails()) {

            $response = array(
                'type' => 'danger',
                'msg' => 'Validation fails',
            );

            return Response::json($response);
        } else {

            $history_id = Input::get('skill_award_id');

            if ($history_id != '' && $history_id != null && $history_id != 'undefined') {

                $education = UserSkillAward::where('id', $history_id)->first();

                $msg = 'updated';
            } else {

                $msg = 'added';

                $education = new UserSkillAward();
            }

            if (Input::get('company_id')) {

                $education->company_id = Input::get('company_id');
            }

            $education->user_id = Auth::user()->id;

            $education->type = Input::get('type');

            $education->skill_detail = Input::get('skill_detail');

            $dateee = \DateTime::createFromFormat("m-d-Y", Input::get('completion_date'));

            $education->completion_date = $dateee->format('Y-m-d');

            // $education->completion_date = date('Y-m-d', strtotime(Input::get('completion_date')));

            $education->save();

            $response = array(
                'type' => 'success',
                'msg' => 'Successfully ' . $msg . ' skill award details',
                //'redirecturl' => $url,
                'id' => $education->id
            );

            return Response::json($response);
        }
    }

    protected function securityValidator($data) {

        return Validator::make($data, [

                    'question1' => 'required',
                    'question2' => 'required',
                    'question3' => 'required',
                    'answer1' => 'required|max:255',
                    'answer2' => 'required|max:255',
                    'answer3' => 'required|max:255',
                        ], [

                    'question1.required' => 'Select security question',
                    'question2.required' => 'Select security question',
                    'question3.required' => 'Select security question',
                    'answer1.required' => 'Answer is required',
                    'answer2.required' => 'Answer is required',
                    'answer3.required' => 'Answer is required',
        ]);
    }

    protected function detailValidator($data) {

        return Validator::make($data, [

                    'company_name' => 'required|max:255',
                    'firstname' => 'required|max:255',
                    'lastname' => 'required|max:255',
                    'gender' => 'required',
                    // 'phone_number' => 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
                    'phone_number' => 'regex:/^\(?([1-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
                    'address' => 'required|max:255',
                    'city' => 'required|max:10',
                    'state' => 'required|max:10',
                    'zipcode' => 'required|integer',
                        ], [

                    'company_name.required' => 'Provide a company name',
                    'firstname.required' => 'Provide a first name',
                    'lastname.required' => 'Provide a last name',
                    'gender.required' => 'Select a gender',
                    'address.required' => 'Provide an address',
                    'city.required' => 'Provide a city',
                    'state.required' => 'Provide a state',
                    'zipcode.required' => 'Provide a zipcode',
                    'zipcode.integer' => 'Zipcode must be a number.',
                    'phone_number.regex' => 'Phone number format is invalid',
        ]);
    }

    protected function detailValidatorForCustomer($data) {

        return Validator::make($data, [

                    'firstname' => 'required|max:255',
                    'lastname' => 'required|max:255',
                    'gender' => 'required',
                    'phone_number' => 'regex:/^\(?([1-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
                    'address' => 'required|max:255',
                    'city' => 'required|max:10',
                    'state' => 'required|max:10',
                    'zipcode' => 'required|integer',
                    'about_me' => 'required'
                        ], [

                    'firstname.required' => 'Provide a first name',
                    'lastname.required' => 'Provide a last name',
                    'gender.required' => 'Select a gender',
                    'address.required' => 'Provide an address',
                    'city.required' => 'Provide a city',
                    'state.required' => 'Provide a state',
                    'zipcode.required' => 'Provide a zipcode',
                    'zipcode.integer' => 'Zipcode must be a number.',
                    'phone_number' => 'Phone number format is invalid.',
                    'about_me.required' => 'Provide about me'
        ]);
    }

    /**

     * Display a list of all of the user's page.

     *

     * @param  Request  $request

     * @return Response

     */
    public function index($userid) {

        return view('profiles.profile', [

            'pageTitle' => "PROFILE"
        ]);
    }

    public function createProfile() {



        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames();



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Select Sport";



        if ($sports) {

            $sports_select .= "<option value=''>Select Sport</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if (count($value1->child)) {

                        $sports_select .= "<optgroup label='" . $value1->title . "'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $sports_select .= "<option value='" . $key2 . "'>" . $value2 . "</option>";
                        }

                        $sports_select .= "</optgroup>";
                    } else {

                        $sports_select .= "<option value='" . $value1->value . "'>" . $value1->title . "</option>";
                    }
                }
            }
        }



        $loggedinUser = Auth::user();

        return view('profiles.createBusinessProfile', [

            'users' => $this->users->findById($loggedinUser['id']),
            'sports_select' => $sports_select,
            'sport_dd' => $sport_dd + $sports_names,
            // 'days' => Miscellaneous::getDays();
            'pageTitle' => "PROFILE"
        ]);
    }

    public function saveProfileHistory(Request $request) {

        // ini_set('memory_limit', '-1');

        ini_set('max_execution_time', 300);

        $loggedinUser = Auth::user();

        //save training details

        $professionalObj = New UserProfessionalDetail();

        $professionalObj->user_id = $loggedinUser['id'];

        $professionalObj->experience_level = $request->selected_experience_level;

        $professionalObj->professional_type = $request->professional_type;

        $professionalObj->about_me = $request->about_me;

        $professionalObj->train_to = ($request->train_to) ? implode(",", $request->train_to) : '';

        $professionalObj->personality = ($request->personality) ? implode(",", $request->personality) : '';

        $professionalObj->availability = ($request->availability) ? implode(",", $request->availability) : '';



        $professionalObj->willing_to_travel = $request->willing_to_travel;

        if (isset($request->willing_to_travel) && $request->willing_to_travel == 'yes') {

            $professionalObj->travel_miles = $request->travel_miles;
        } else {

            $professionalObj->travel_miles = NULL;
        }



        if (!$professionalObj->save()) {

            $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

            return redirect('/profile/editProfileHistory');
        }



        // save employment history

        $history_record = array();

        $history_index = 0;

        $i = 0;

        while ($i < count($request->organization)) {



            if ($request->organization[$i] == "" || $request->position[$i] == "" || $request->servicestart[$i] == "" || $request->serviceend[$i] == "") {

                continue;
            }

            $history_record[$history_index]['user_id'] = $loggedinUser['id'];

            $history_record[$history_index]['organization'] = $request->organization[$i];

            $history_record[$history_index]['position'] = $request->position[$i];

            if ($request->ispresent[$i] == 1) {

                $history_record[$history_index]['is_present'] = 1;

                $history_record[$history_index]['service_end'] = "0000-00-00";
            } else {

                $history_record[$history_index]['is_present'] = '0';

                $history_record[$history_index]['service_end'] = date("Y-m-d", strtotime($request->serviceend[$i]));
            }

            $history_record[$history_index]['service_start'] = date("Y-m-d", strtotime($request->servicestart[$i]));

            $history_index++;



            $i++;
        }

        if (count($history_record) > 0) {

            if (!UserEmploymentHistory::insert($history_record)) {

                $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

                return redirect('/profile/editProfileHistory');
            }
        }



        // save education

        $education_record = array();

        $education_index = 0;

        $i = 0;

        while ($i < count($request->course)) {



            if ($request->course[$i] == "" || $request->university[$i] == "" || $request->passingyear[$i] == "") {

                continue;
            }

            $education_record[$education_index]['user_id'] = $loggedinUser['id'];

            $education_record[$education_index]['course'] = $request->course[$i];

            $education_record[$education_index]['university'] = $request->university[$i];

            $education_record[$education_index]['passing_year'] = date("Y-m-d", strtotime($request->passingyear[$i]));

            $education_index++;



            $i++;
        }

        if (count($education_record) > 0) {

            if (!UserEducation::insert($education_record)) {

                $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

                return redirect('/profile/editProfileHistory');
            }
        }



        // save certification

        $certificate_record = array();

        $certificate_index = 0;

        $i = 0;

        while ($i < count($request->certificatetitle)) {



            if ($request->certificatetitle[$i] == "" || $request->certificatecompletion[$i] == "") {

                continue;
            }

            $certificate_record[$certificate_index]['user_id'] = $loggedinUser['id'];

            $certificate_record[$certificate_index]['title'] = $request->certificatetitle[$i];

            $certificate_record[$certificate_index]['completion_date'] = date("Y-m-d", strtotime($request->certificatecompletion[$i]));

            $certificate_index++;



            $i++;
        }

        if (count($certificate_record) > 0) {

            if (!UserCertification::insert($certificate_record)) {

                $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

                return redirect('/profile/editProfileHistory');
            }
        }



        // save service

        $service_record = array();

        $service_index = 0;

        $i = 0;

        while ($i < count($request->servicetitle)) {



            if ($request->servicetitle[$i] == "" || $request->servicedesc[$i] == "" || $request->servicesport[$i] == "") {

                continue;
            }

            $service_record[$service_index]['user_id'] = $loggedinUser['id'];

            $service_record[$service_index]['sport'] = $request->servicesport[$i];

            $service_record[$service_index]['title'] = $request->servicetitle[$i];

            $service_record[$service_index]['price'] = $request->serviceprice[$i];

            $service_record[$service_index]['servicedesc'] = $request->servicedesc[$i];

            $service_index++;



            $i++;
        }

        if (count($service_record) > 0) {

            if (!UserService::insert($service_record)) {

                $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

                return redirect('/profile/editProfileHistory');
            }
        }



        $request->session()->flash('alert-success', 'Profile saved successfully!');

        return redirect('/profile/editProfileHistorySecurity');
    }

    public function createProfileSecurity() {

        $loggedinUser = Auth::user();





        if (UserSecurityQuestion::where('user_id', $loggedinUser['id'])->count() == 0) {

            return view('profiles.createBusinessProfile_security', [

                'users' => $this->users->findById($loggedinUser['id']),
                'question' => Miscellaneous::getSecurityQuestions(),
                'pageTitle' => "PROFILE"
            ]);
        } else {

            return redirect('/profile/editProfileSecurity');
        }
    }

    public function getQuestions() {



        return Response::json(Miscellaneous::getSecurityQuestions());

        exit();
    }

    public function getBackgroundCheckFAQ() {

        $data = Fit_background_check_faq::all();

        return view('faq.background_check_faq', compact('data'));
    }

    public function getVettedBussinessFAQ() {

        $data = Fit_vetted_business_faq::all();

        return view('faq.vetted_business_faq', compact('data'));
    }

    public function editProfileSecurity() {

        if (!Gate::allows('profile_edit_access')) {

            // $request->session()->flash('alert-danger', 'Access Restricted');

            return redirect('/profile/viewProfile');
        }



        $loggedinUser = Auth::user();



        return view('profiles.editBusinessProfile_security', [

            'UserProfileDetail' => $this->users->getUserProfileDetail($loggedinUser['id'], array('security')),
            'question' => Miscellaneous::getSecurityQuestions(),
            'pageTitle' => "EDIT PROFILE"
        ]);
    }

    public function saveProfileSecurity(Request $request) {

        $validator = $this->securityValidator($request->all());

        if ($validator->fails()) {

            $this->throwValidationException(
                    $request, $validator
            );
        }

        $status = true;

        if (isset($request->action) && $request->action == "edit" && ($request->id1 > 0)) {

            $UserSecurityQuestion = UserSecurityQuestion::find($request->id1);

            $UserSecurityQuestion->question = $request->question1;

            $UserSecurityQuestion->answer = $request->answer1;

            if (!$UserSecurityQuestion->save())
                $status = false;



            $UserSecurityQuestion = UserSecurityQuestion::find($request->id2);

            $UserSecurityQuestion->question = $request->question2;

            $UserSecurityQuestion->answer = $request->answer2;

            if (!$UserSecurityQuestion->save())
                $status = false;



            $UserSecurityQuestion = UserSecurityQuestion::find($request->id3);

            $UserSecurityQuestion->question = $request->question3;

            $UserSecurityQuestion->answer = $request->answer3;

            if (!$UserSecurityQuestion->save())
                $status = false;
        }else {

            $loggedinUser = Auth::user();



            $data = array(
                array('user_id' => $loggedinUser['id'], 'question' => $request->question1, 'answer' => $request->answer1),
                array('user_id' => $loggedinUser['id'], 'question' => $request->question2, 'answer' => $request->answer2),
                array('user_id' => $loggedinUser['id'], 'question' => $request->question3, 'answer' => $request->answer3),
            );



            if (!UserSecurityQuestion::insert($data)) {

                $status = false;
            }
        }



        if (!$status) {

            $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

            return redirect('/profile/editProfileHistorySecurity');
        } else {

            $request->session()->flash('alert-success', 'Profile saved successfully!');

            if (isset($request->action) && $request->action == "edit") {

                return redirect('/profile/viewProfile');
            } else {

                return redirect('/profile/viewProfile');
            }
        }
    }

    public function createProfileMembership() {

        $loggedinUser = Auth::user();

        return view('profiles.createBusinessProfile_membership', [

            'users' => $this->users->findById($loggedinUser['id']),
            'pageTitle' => "PROFILE",
            'plans' => $this->planRepository->getAllPlans()
        ]);
    }

    public function editProfileMembership() {

        if (!Gate::allows('profile_edit_access')) {

            // $request->session()->flash('alert-danger', 'Access Restricted');

            return redirect('/profile/viewProfile');
        }



        $loggedinUser = Auth::user();

        return view('profiles.editBusinessProfile_membership', [

            'UserProfileDetail' => $this->users->getUserProfileDetail($loggedinUser['id'], array('membership')),
            'users' => $this->users->findById($loggedinUser['id']),
            'pageTitle' => "PROFILE",
            'plans' => $this->planRepository->getAllPlans()
        ]);
    }

    public function saveProfileMembership(Request $request) {

        $loggedinUser = Auth::user();



        if ($request->selected_plans == "") {

            $response = array(
                'type' => 'danger',
                'msg' => 'Please select any plan.',
            );

            return Response::json($response);
        }



        $plans = explode(",", $request->selected_plans);

        if (isset($request->action) && $request->action == "edit") {

            $previous_plans = explode(",", $request->previous_plans);

            $deleted_plan = array_diff($previous_plans, $plans);

            if (count($deleted_plan) > 0) {

                UserMembership::whereIn('membership_plan_id', $deleted_plan)->delete();
            }
        }



        $data = array();

        foreach ($plans as $plan) {

            $data[] = array('user_id' => $loggedinUser['id'], 'membership_plan_id' => $plan);
        }



        if (!UserMembership::insert($data)) {

            $response = array(
                'type' => 'danger',
                'msg' => 'Some error has occured while saving profile.',
            );

            return Response::json($response);
        }



        $response = array(
            'type' => 'success',
            'msg' => 'Profile saved successfully!',
        );

        return Response::json($response);
    }

    public function sendProfileToReview($status, Request $request) {

        $loggedinUser = Auth::user();



        switch ($status) {

            case 'submit_review': $db_status = 'review_pending';

                $msg_error = 'Some error has occured while submitting to review.';

                $msg_success = 'Profile submitted to review successfully!';

                break;

            case 'save_draft': $db_status = 'draft';

                $msg_error = 'Some error has occured while saving profile to draft.';

                $msg_success = 'Profile saved in draft successfully!';

                break;
        }



        $user = User::find($loggedinUser['id']);

        $user->status = $db_status;

        if (!$user->save()) {

            $response = array(
                'type' => 'danger',
                'msg' => $msg_error,
            );

            return Response::json($response);
        }



        if ($status == 'submit_review') {



            $mail_data = array();

            $mail_data['adminDetails'] = $this->users->getAdminUser();

            $mail_data['professionalDetails'] = $this->professionals->getById($loggedinUser['id']);



            if (isset($mail_data['adminDetails']) && $mail_data['adminDetails'] != '') {

                MailService::sendEmailUserProfileForReview($mail_data);
            }
        }



        if ($request->ajax()) {

            $response = array(
                'type' => 'success',
                'msg' => $msg_success,
            );

            return Response::json($response);
        } else {

            $request->session()->flash('alert-success', $msg_success);

            return redirect('/profile/viewProfile');
        }
    }

    public function addFamilyDetail() {

        $postArr = Input::all();

        $rules = [

            'first_name' => 'required',
            'last_name' => 'required',
            // 'email'             => 'required|email',
            //'relationship'          => 'required',
            //'gender'  => 'required',
            //'birthday'  => 'required',
            'mobile' => 'required'
        ];

        $validator = Validator::make($postArr, $rules);

        if ($validator->fails()) {

            $errMsg = array();

            foreach ($validator->messages()->getMessages() as $field_name => $messages) {

                $errMsg = $messages;
            }

            $response = array(
                'type' => 'danger',
                'msg' => 'Validation fails',
            );

            return Response::json($response);
        } else {

            if (Input::get('family_id') == 0) {

                // $count = UserFamilyDetail::where('user_id',Auth::user()->id)->where('email',Input::get('email'))->count();
                // if($count == 0){
                //     $family = new UserFamilyDetail();
                // }
                // else{
                //      $response = array(
                //     'type' => 'danger',
                //     'msg' => 'Email already registered',
                //     //'redirecturl' => $url,
                //     );
                //     return Response::json($response);
                // }

                $family = new UserFamilyDetail();
            } else {

                // $count = UserFamilyDetail::where('user_id',Auth::user()->id)->where('email',Input::get('email'))->where('id','!=',Input::get('family_id'))->count();
                // if($count == 0){
                // $family = UserFamilyDetail::where('id',Input::get('family_id'))->first();
                // }
                // else{
                //      $response = array(
                //     'type' => 'danger',
                //     'msg' => 'Email already registered',
                //     //'redirecturl' => $url,
                //     );
                //     return Response::json($response);
                // }

                $family = UserFamilyDetail::where('id', Input::get('family_id'))->first();
            }

            $date = \DateTime::createFromFormat("m-d-Y", Input::get('birthday'));



            $family->user_id = Auth::user()->id;

            $family->first_name = Input::get('first_name');

            $family->last_name = Input::get('last_name');

            $family->email = Input::get('email');

            $family->mobile = Input::get('mobile');

            $family->gender = Input::get('gender');

            $family->emergency_contact = Input::get('emergency_contact');

            $family->relationship = Input::get('relationship');

            $family->birthday = $date->format('Y-m-d');

            $family->save();

            if (Input::get('family_id') == 0)
                $msg = 'Successfully added family members';
            else
                $msg = 'Successfully updated family members';

            //  $url = '/';

            $response = array(
                'type' => 'success',
                'msg' => $msg,
                    //'redirecturl' => $url,
            );

            return Response::json($response);
        }
    }

    public function deleteFamily($family_id) {

        $count = UserFamilyDetail::where('user_id', Auth::user()->id)->where('id', $family_id)->count();

        if ($count == 0) {

            $response = array(
                'type' => 'danger',
                'msg' => 'Made an invalid request',
            );

            return Response::json($response);
        } else {

            UserFamilyDetail::where('user_id', Auth::user()->id)->where('id', $family_id)->delete();

            $response = array(
                'type' => 'success',
                'msg' => 'Family member deleted successfully',
            );

            return Response::json($response);
        }
    }

    public function businessDelete($business_id) {

        $count = BusinessInformation::where('user_id', Auth::user()->id)->where('id', $business_id)->count();

        if ($count == 0) {

            $response = array(
                'type' => 'danger',
                'msg' => 'Made an invalid request',
            );

            return Response::json($response);
        } else {

            BusinessInformation::where('user_id', Auth::user()->id)->where('id', $business_id)->delete();

            $response = array(
                'type' => 'success',
                'msg' => 'Business detail deleted successfully',
            );

            return Response::json($response);
        }
    }
    public function mailtemplate(Request $request) {
         return view('mailtemplate');
    }
    public function sendmail(Request $request) {

        $user = User::findOrFail(720);

       /* $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('arya.developers.2017@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");*/
       

        Mail::send('emails.signup-verification', ['user' => $user], function ($m) use ($user) {

            $m->from('noreply@fitnessity.co', 'Fitnessity');



            $m->to('arya.developers.2017@gmail.com', $user->firstname.' '.$user->lastname)->subject('Email Verification');

        });

        return "success";

    }
    public function savemyprofilepic(Request $request)
    {


         if($request->hasFile('galaryphoto')) {

            $path = $request->file('galaryphoto')->store('gallery');
            DB::table('users_add_attachment')->where('id',$request->imgId)->update(array('attachment_name'=>$path));
         }

        



        /*  $gallery = DB::select('select id, attachment_name from users_add_attachment where id = ? order by id DESC', [$id]);
*/
      /*  if(!empty($gallery)) {
            foreach($gallery as $pic) {
                echo $pic;
                exit;
                DB::update('update users_add_attachment set attachment_name = '.$imgname.' where id = "' . $request->selectId . '"');
            }
        }*/

         return redirect()->route('profile-viewProfile');

    }
    public function viewbusinessProfile(Request $request, $page_id) {
        $loggedinUser = Auth::user();
        if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
        $user_professional_detail = $terms = $business_details = $business_exp = $business_term = $business_spec = $business_service = $business_price = $gallery = [];
        $companyData = $serviceData = $servicePrice = $businessSpec = $services = $max_price = $min_price = [];
        $company['company_images'] = [];
        
        $company = CompanyInformation::with('employmenthistory', 'education', 'users', 'certification', 'service', 'skill', 'ProfessionalDetail')->where('id', $page_id)->first();
        
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
                    $company1 = CompanyInformation::where('id', $service['cid'])->get();
                    $company1 = isset($company[0]) ? $company[0] : [];
                    if(!empty($company1)) {
                        $companyData[$company['id']][] = $company1;
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
        $UserProfileDetail = $this->users->getUserProfileDetail(@$company['user_id'], array('professional_detail', 'history', 'education', 'certification', 'service'));
        $PagePost = PagePost::where('page_id',$page_id)->limit(1)->orderBy('id','desc')->get();
        $postsave = PagePostSave::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        
        $photos = PagePost::select('images','user_id')->where('images','!=',null)->where('user_id',Auth::user()->id)->where('page_id',$page_id)->orderBy('id','desc')->limit(10)->get();
        $videos = PagePost::select('video','user_id')->where('video','!=',null)->where('user_id',Auth::user()->id)->where('page_id',$page_id)->orderBy('id','desc')->limit(1)->get();
        $viewgallery = $this->viewPageGalleryList($page_id);
        
        $cart = []; $profile_posts=[]; $family=[];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        return view('profiles.businessProfile', [
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
        
        
        /*$loggedinUser = Auth::user();
        $gallery = $this->galleryList($loggedinUser['id']);
        $viewgallery = $this->viewGalleryList($loggedinUser['id']);
        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail', 'history', 'education', 'certification', 'service'));
        if (isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0) {
            $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
        }
        $sports_names = $this->sports->getAllSportsNames();
        $approve = Evidents::where('user_id', $loggedinUser['id'])->get();
        $serviceType = Miscellaneous::businessType();
        $programType = Miscellaneous::programType();
        $programFor = Miscellaneous::programFor();
        $numberOfPeople = Miscellaneous::numberOfPeople();
        $ageRange = Miscellaneous::ageRange();
        $expLevel = Miscellaneous::expLevel();
        $serviceLocation = Miscellaneous::serviceLocation();
        $pFocuses = Miscellaneous::pFocuses();
        $duration = Miscellaneous::duration();
        $servicePriceOption = Miscellaneous::servicePriceOption();
        $specialDeals = Miscellaneous::specialDeals();
        if ($loggedinUser['role'] == 'business' || $loggedinUser['role'] == 'professional' || $loggedinUser['role'] == 'admin') {
            $view = 'profiles.viewProfile';
        } elseif ($loggedinUser['role'] == 'customer') {
            $view = 'profiles.viewProfileCustomer';
        }
        $family = UserFamilyDetail::where('user_id', Auth::user()->id)->get();
        $business_details = BusinessInformation::where('user_id', Auth::user()->id)->get();
        
        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;
        $firstCompany = CompanyInformation::where('user_id', Auth::user()->id)->first();
        $companies = CompanyInformation::where('user_id', Auth::user()->id)->get();
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        $ProfileFollowcount = ProfileFollow::where('user_id',Auth::user()->id)->count();
        $ProfileFavcount = ProfileFav::where('user_id',Auth::user()->id)->count();
        $ProfileViewCount = ProfileView::where('user_id',Auth::user()->id)->count();
        $profile_posts = ProfilePost::all();
        
        return view('profiles.businessProfile', [
            'cart' => $cart,
            'UserProfileDetail' => $UserProfileDetail,
            'gallery' => $gallery,
            'viewgallery' => $viewgallery,
            'firstCompany' => $firstCompany,
            'countries' => $this->users->getCountriesList(),
            'states' => $this->users->getStateList($UserProfileDetail['country']),
            'cities' => $this->users->getCityList($UserProfileDetail['state']),
            'phonecode' => Miscellaneous::getPhoneCode(),
            'sports_names' => $sports_names,
            'serviceType' => $serviceType,
            'programType' => $programType,
            'programFor' => $programFor,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "PROFILE",
            'approve' => $approve,
            'family' => $family,
            'business_details' => $business_details,
            'companies' => $companies,
            'ProfileFollowcount' => $ProfileFollowcount,
            'ProfileFavcount' => $ProfileFavcount,
            'ProfileViewCount' => $ProfileViewCount,
            'profile_posts' => $profile_posts,
        ]);*/
    }
    public function viewProfile(Request $request) {

        // print_r("profile called");
        //update user's lat long
        //$this->users->updatelatlong();
       /*session()->forget('cart_item');*/
        if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
        $loggedinUser = Auth::user();
        $gallery = $this->galleryList($loggedinUser['id']);
        /*echo "<pre>";print_r($gallery);
        exit;*/
        $viewgallery = $this->viewGalleryList($loggedinUser['id']);
        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail', 'history', 'education', 'certification', 'service'));
        
        if (isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0) {
            $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
        }
        $sports_names = $this->sports->getAllSportsNames();
        $approve = Evidents::where('user_id', $loggedinUser['id'])->get();
        $serviceType = Miscellaneous::businessType();
        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        //  $loggedinUser['role'] = 'customer';
        // $loggedinUser->save();
        //dd($UserProfileDetail);die;

        if ($loggedinUser['role'] == 'business' || $loggedinUser['role'] == 'professional' || $loggedinUser['role'] == 'admin') {
            $view = 'profiles.viewProfile';
        } elseif ($loggedinUser['role'] == 'customer') {
            $view = 'profiles.viewProfileCustomer';
        }

        $family = UserFamilyDetail::where('user_id', Auth::user()->id)->get();
        $business_details = BusinessInformation::where('user_id', Auth::user()->id)->get();
        //  dd($this->users->getStateList($UserProfileDetail['country']));
        //die;

        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();

        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;
        $firstCompany = CompanyInformation::where('user_id', Auth::user()->id)->first();
        $companies = CompanyInformation::where('user_id', Auth::user()->id)->get();

        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        $ProfileFollowcount = ProfileFollow::where('user_id',Auth::user()->id)->count();
        $ProfileFavcount = ProfileFav::where('user_id',Auth::user()->id)->count();
        $ProfileViewCount = ProfileView::where('user_id',Auth::user()->id)->count();
        $AllFollowing = UserFollow::where('user_id', Auth::user()->id)->get();
        $followingarr=array();
        $followingarr[]=Auth::user()->id;
        foreach($AllFollowing as $farr)
        {
            $followingarr[]=$farr->follower_id;
        }
        $followingarr1=implode(",",$followingarr);
        $f = explode(",", $followingarr1);
        //DB::enableQueryLog();
        $profile_posts = ProfilePost::whereIn('user_id', $f)->limit(5)->orderBy('id','desc')->get();
        //dd(\DB::getQueryLog());
        //$profile_posts = ProfilePost::limit(5)->orderBy('id','desc')->get();

        $videos = ProfilePost::select('video','user_id')->where('video','!=',null)->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        $images = ProfilePost::select('images','user_id')->where('images','!=',null)->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        $profilesave = ProfileSave::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

        /*echo "<pre>";
        print_r($videos);
        exit;*/
        return view($view, [
            'cart' => $cart,
            'UserProfileDetail' => $UserProfileDetail,
            'videos'=> $videos,
            'profilesave'=>$profilesave,
            'images'=> $images,
            'gallery' => $gallery,
            'viewgallery' => $viewgallery,
            'firstCompany' => $firstCompany,
            'countries' => $this->users->getCountriesList(),
            'states' => $this->users->getStateList($UserProfileDetail['country']),
            'cities' => $this->users->getCityList($UserProfileDetail['state']),
            'phonecode' => Miscellaneous::getPhoneCode(),
            'sports_names' => $sports_names,
            'serviceType' => $serviceType,
            'programType' => $programType,
            'programFor' => $programFor,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "PROFILE",
            'approve' => $approve,
            'family' => $family,
            'business_details' => $business_details,
            'companies' => $companies,
            'ProfileFollowcount' => $ProfileFollowcount,
            'ProfileFavcount' => $ProfileFavcount,
            'ProfileViewCount' => $ProfileViewCount,
            'profile_posts' => $profile_posts,
        ]);
    }

    public function companyDetail(Request $request) {   

        //return $request->type;

        if ($request->type) {

            //print_r("if")

            $type = $request->type;
        } else {

            $type = 1;
        }

        // print_r($type);die;

        if ($request->type == 1) {

            // print_r("if");die;

            $data = BusinessInformation::where('user_id', Auth::user()->id)->where('company_name', $request->company_name)->first();
        } else {

            //print_r(Auth::user()->id);die;

            $data = User::where('id', Auth::user()->id)->where('company_name', $request->company_name)->first();

            $data['zip_code'] = $data['zipcode'];
        }

        //return $data;

        if ($data) {

            $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail', 'history', 'education', 'certification', 'service'));



            if (isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0) {

                $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
            }



            $sports_names = $this->sports->getAllSportsNames();

            $approve = Evidents::where('user_id', $loggedinUser['id'])->get();

            $serviceType = Miscellaneous::businessType();

            $programType = Miscellaneous::programType();

            $programFor = Miscellaneous::programFor();

            $numberOfPeople = Miscellaneous::numberOfPeople();

            $ageRange = Miscellaneous::ageRange();

            $expLevel = Miscellaneous::expLevel();

            $serviceLocation = Miscellaneous::serviceLocation();

            $pFocuses = Miscellaneous::pFocuses();

            $duration = Miscellaneous::duration();

            $servicePriceOption = Miscellaneous::servicePriceOption();

            $specialDeals = Miscellaneous::specialDeals();

            return view('profiles.companyView', [

                'data' => $data,
                'UserProfileDetail' => $UserProfileDetail,
                'countries' => $this->users->getCountriesList(),
                'states' => $this->users->getStateList($UserProfileDetail['country']),
                'cities' => $this->users->getCityList($UserProfileDetail['state']),
                'phonecode' => Miscellaneous::getPhoneCode(),
                'sports_names' => $sports_names,
                'serviceType' => $serviceType,
                'programType' => $programType,
                'programFor' => $programFor,
                'numberOfPeople' => $numberOfPeople,
                'ageRange' => $ageRange,
                'expLevel' => $expLevel,
                'serviceLocation' => $serviceLocation,
                'pFocuses' => $pFocuses,
                'duration' => $duration,
                'specialDeals' => $specialDeals,
                'servicePriceOption' => $servicePriceOption,
                'approve' => $approve,
            ]);
        } else
            return view('profiles.companyView')->with('error_msg', 'Invalid Request');
    }

    public function editProfilePicture(Request $request) {

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

        $loggedinUser = Auth::user();

        $userObj = User::find($loggedinUser['id']);



        // delete existing image

        if (isset($userObj->profile_pic)) {

            @unlink(public_path('uploads/profile_pic/thumb150') . DIRECTORY_SEPARATOR . $userObj->profile_pic);

            @unlink(public_path('uploads/profile_pic/thumb') . DIRECTORY_SEPARATOR . $userObj->profile_pic);

            @unlink(public_path('uploads/profile_pic') . DIRECTORY_SEPARATOR . $userObj->profile_pic);
        }



        $userObj->profile_pic = $image_upload['filename'];

        if (!$userObj->save()) {

            $response = array(
                'type' => 'danger',
                'msg' => 'Some error while updating profile picture.',
            );

            return Response::json($response);
        } else {

            $image_path = asset('/images') . '/' . 'user.png';

            if ($userObj->profile_pic != '' && file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . $userObj->profile_pic)) {

                $image_path = secure_asset('/public/uploads/profile_pic/thumb') . '/' . $userObj->profile_pic;
            }

            $response = array(
                'type' => 'success',
                'msg' => 'Profile picture updated succesfully!',
                'returndata' => array(
                    'profile_pic' => $image_path
                )
            );
            
          return Redirect::back()->with('success', 'Profile picture updated succesfully!');

            //return redirect()->back();

            //return Response::json($response);
        }
    }

    public function editCompanyPicture(Request $request) {

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

        $loggedinUser = Auth::user();

        $userObj = CompanyInformation::where('id', $request->company_id)->first();



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
                'msg' => 'Some error while updating compay logo.',
            );

            return Response::json($response);
        } else {

            $image_path = asset('/images') . '/' . 'user.png';

            if ($userObj->logo != '' && file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . $userObj->logo)) {

                $image_path = asset('/uploads/profile_pic/thumb') . '/' . $userObj->logo;
            }

            $response = array(
                'type' => 'success',
                'msg' => 'Company updated succesfully!',
                'returndata' => array(
                    'profile_pic' => $thumb_upload_path
                )
            );

            return Response::json($response);
        }
    }

    //update banner image

    public function editBannerPicture(Request $request) {
        $validator = Validator::make($request->all(), [ 'banner_image' => 'required|image|mimes:jpeg,jpg,png'], [ 'required' => 'The :attribute is required.']);
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
        // save banner image
        $image = new Image();
        $request->banner_image = '';
        if (!$request->hasFile('banner_image')) {
            $response = array(
                'type' => 'danger',
                'msg' => 'No image found to upload',
            );
            return Response::json($response);
        }

        $file = Input::file('banner_image');
        if (!file_exists(public_path('uploads/banner_image/thumb'))) {
            mkdir(public_path('uploads/banner_image/thumb'), 0755, true);
        }
        $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'banner_image' . DIRECTORY_SEPARATOR;
        $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'banner_image' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
        $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('banner_image'), $file_upload_path, 1, $thumb_upload_path, '379', '2000');
        // save new Banner image
        $loggedinUser = Auth::user();
        if ($loggedinUser['role'] == "customer") {
            $userObj = UserCustomerDetail::where('user_id', $loggedinUser['id'])->first();
        }
        if ($loggedinUser['role'] == "business" || $loggedinUser['role'] == "professional") {
            $userObj = UserProfessionalDetail::where('user_id', $loggedinUser['id'])->first();
        }
        if (count($userObj) > 0) {
            if ($userObj->banner_image != '') {
                $bannerImage = public_path("/uploads/banner_image/{$userObj->banner_image}");
                $bannerThumbImage = public_path("/uploads/banner_image/thumb/{$userObj->banner_image}");
                if (File::exists($bannerImage) && File::exists($bannerThumbImage)) {
                    unlink($bannerImage);
                    unlink($bannerThumbImage);
                }
            }
            $userObj->banner_image = $image_upload['filename'];
            $userObj->save();
        } else {
            if ($loggedinUser['role'] == "customer") {
                $userObj = UserCustomerDetail::create([
                'user_id' => $loggedinUser['id'],
                'banner_image' => $image_upload['filename']
                ]);
            }
            if ($loggedinUser['role'] == "business" || $loggedinUser['role'] == "professional") {
                $userObj = UserProfessionalDetail::create([
                'user_id' => $loggedinUser['id'],
                'banner_image' => $image_upload['filename']
                ]);
            }
        }

        if (!$userObj->save()) {
            $response = array(
                'type' => 'danger',
                'msg' => 'Some error while updating profile picture.',
            );
            return Response::json($response);
        } else {
            $image_path = asset('/images') . '/' . 'profile-banner.jpg';
            if ($userObj->banner_image != '' && file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'banner_image' . DIRECTORY_SEPARATOR . $userObj->banner_image)) {
                $image_path = asset('/uploads/banner_image') . '/' . $userObj->banner_image;
            }
            $response = array(
                'type' => 'success',
                'msg' => 'Banner image updated Succesfully!',
                'returndata' => array(
                    'banner_image' => $image_path
                )
            );
            return Response::json($response);
        }
    }

    public function editProfileDetail(Request $request) {
        if (Auth::user()->role == "business" || Auth::user()->role == "professional") {
            $validator = $this->detailValidator($request->all());
        } else if (Auth::user()->role == "customer") {
            $validator = $this->detailValidatorForCustomer($request->all());
        }
        // if($validator->fails()) {
        //   $errMsg = array();
        //     foreach($validator->messages()->getMessages() as $field_name => $messages) {
        //         $errMsg = $messages;
        //     }
        //     $response = array('type' => 'danger','msg' => $errMsg);
        //     return Response::json($response);
        // }       
        $nstate = AddrStates::where('state_name', $request->state)->first();
        $ncity = AddrCities::where('city_name', $request->city)->first();
        $loggedinUser = Auth::user();
        $userObj = User::find($loggedinUser['id']);
        $userObj->company_name = $request->company_name;
        $userObj->firstname = $request->firstname;
        $userObj->lastname = $request->lastname;
        $userObj->username = $request->username;
        $userObj->position = $request->position;
        $userObj->gender = $request->gender;
        $userObj->phone_number = $request->phone_number;
        $userObj->address = $request->address;
        $userObj->city = $request->city;
        $userObj->state = $request->state;
        $userObj->country = $request->country;
        $userObj->zipcode = $request->zipcode;
        $userObj->intro = $request->intro;
        //get lat long
        $latlongdata = Miscellaneous::getLatLong($request->zipcode);
        $userObj->latitude = $latlongdata['lat'];
        $userObj->longitude = $latlongdata['long'];
        //return Response::json($userObj);
        if (!$userObj->save()) {
            $response = array(
                'type' => 'danger',
                'msg' => 'Some error while updating profile.',
            );
            return Response::json($response);
        } else {
            if (isset($request->about_me) && ($loggedinUser['role'] == "business" || $loggedinUser['role'] == "professional")) {
                $professional_detail = UserProfessionalDetail::where('user_id', $loggedinUser['id'])->first();
                $professional_detail->about_me = $request->about_me;
                $professional_detail->about_business = $request->about_business;
                $professional_detail->save();
            }
            if (isset($request->about_me) && $loggedinUser['role'] == "customer") {
                $customer_detail = UserCustomerDetail::where('user_id', $loggedinUser['id'])->first();
                if ($customer_detail != [] && $customer_detail != '') {
                    $customer_detail->about_me = $request->about_me;
                    $customer_detail->intro = $request->intro;
                    $customer_detail->save();
                } else {
                    $customer_detail = UserCustomerDetail::create([
                    'user_id' => $loggedinUser['id'],
                    'about_me' => $request->about_me
                    ]);
                    // $customer_detail;
                }
            }
            /* if(!$status)
              {
              $response = array(
              'type' => 'danger',
              'msg' => 'Some error while updating profile.',
              );
              return Response::json($response);
              } */
            $response = array(
                'type' => 'success',
                'msg' => 'Profile updated succesfully!'
            );
            return Response::json($response);
        }
    }

    public function editProfileHistory() {

        if (!Gate::allows('profile_edit_access')) {
            // $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/profile/viewProfile');
        }



        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail', 'history', 'education', 'certification', 'service', 'skill'));

        $service = $UserProfileDetail['service'];

        $service = @$service[0]['sport'];

        if ($sports) {

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if (count($value1->child)) {

                        $sports_select .= "<optgroup label='" . $value1->title . "'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected = null; // ($service==$key2)?"selected":"";

                            $sports_select .= "<option value='" . $key2 . "' " . $selected . " >" . $value2 . "</option>";
                        }

                        $sports_select .= "</optgroup>";
                    } else {

                        $selected = null; //($service==$value1->value)?"selected":"";

                        $sports_select .= "<option value='" . $value1->value . "' " . $selected . ">" . $value1->title . "</option>";
                    }
                }
            }
        }



        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();



        return view('profiles.editBusinessProfile', [

            'UserProfileDetail' => $UserProfileDetail,
            'sports_select' => $sports_select,
            'sport_dd' => $sport_dd + $sports_names,
            'businessType' => $businessType,
            'activity' => $activity,
            'programType' => $programType,
            'programFor' => $programFor,
            'teaching' => $teaching,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "COMPLETE PROFILE",
            'allLanguages' => $languages,
            'timeSlots' => $timeSlots,
            'mydetails' => User::find($loggedinUser['id'])
        ]);
    }

    public function getlanguage(Request $r) {



        $languages = DB::table('languages')->where('name', 'like', '%' . $r->lang . '%')->get();



        return response()->json($languages);
    }

    public function saveEditedProfileHistory(Request $request) {



        //  print_r($request->all());
        //die;

        $loggedinUser = Auth::user();



        //$professionalObj = UserProfessionalDetail::find($request->professional_detail_id);

        $update = array(
            'experience_level' => json_encode($request->experience_level, JSON_FORCE_OBJECT),
            'train_to' => json_encode($request->train_to, JSON_FORCE_OBJECT),
            'personality' => json_encode($request->personality, JSON_FORCE_OBJECT),
            'availability' => json_encode(json_encode($request->availability)),
            'languages' => json_encode($request->languages, JSON_FORCE_OBJECT),
            'skill_lavel' => json_encode($request->skill_lavel, JSON_FORCE_OBJECT),
            'medical_states' => $request->medical_states,
            'medical_type' => json_encode($request->medical_type, JSON_FORCE_OBJECT),
            'work_locations' => json_encode($request->work_locations, JSON_FORCE_OBJECT),
            'goals_states' => $request->fitness_goals,
            'goals_option' => json_encode($request->goals_option, JSON_FORCE_OBJECT),
            'hours' => $request->hours_opt,
            'timezone' => $request->timezone,
            'special_days_off' => $request->special_days_off,
            'notice_each_book' => '{"' . $request->notice_each_book_day . '":"' . $request->notice_each_book_ans . '"}',
            'advance_book' => '{"' . $request->advance_book_day . '":"' . $request->advance_book_ans . '"}',
            'willing_to_travel' => $request->willing_to_travel,
            'travel_miles' => $request->travel_miles,
            'travel_times' => NULL
        );

        //print_r($update);die;

        $g = UserProfessionalDetail::where('company_id', $request->company_id)->where('user_id', Auth::user()->id)->first();

        $db = DB::table('user_professional_details')
                ->where('id', $g->id)
                ->update($update);



        $co = CompanyInformation::where('id', $request->company_id)->first();

        $co->email = $request->emailb;

        $co->first_name = $request->firstnameb;

        $co->last_name = $request->lastnameb;

        $co->contact_number = $request->phone_number;

        $co->company_name = $request->Companyname;
        $co->dba_business_name = $request->Companyname;
        $co->ein_number = $request->b_EINnumber;

        $co->establishment_year = $request->b_Establishmentyear;

        $co->about_company = $request->about_company;

        $co->short_description = $request->b_shortDescription;

        $co->address = $request->address;

        $co->city = $request->city;

        $co->state = $request->state;

        $co->country = $request->country;

        $co->zip_code = $request->zip_code;

        $co->latitude = $request->latitude;

        $co->longitude = $request->longitude;

        $co->save();



        // print_r($request->professional_detail_id);die;
        // if(!$db) {
        //     $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');
        //     return redirect('/profile/editProfileHistory');
        // }



        $request->session()->flash('alert-success', 'Profile saved successfully!');

        //return redirect('/profile/editProfileHistory');

        return redirect('manage/company');
    }

    public function getStateList(Request $request) {

        $states = $this->users->getStateList($request->country_code);

        return response()->json($states);
    }

    public function getCityList(Request $request) {

        $cities = $this->users->getCityList($request->state_id);

        return response()->json($cities);
    }

    public function showSportAlertbox() {

        return view('profiles.sportAlertbox');
    }

    // regenerate profile pic by 354 x 415 

    public function regenerateImages() {

        $dir = public_path('uploads/profile_pic');

        $thumbsDir = public_path('uploads/profile_pic/thumb150');



        if ($this->users->thumbResize($dir, $thumbsDir)) {

            return redirect('/')->with('alert-success', 'Images resize successfully');
        }
    }

    public function editservicedetail(Request $request) {

        $input = $request->hours;





        /*  if($request->editservice_id > 0)

          {

          $check = "false";

          }

          else

          {

          $check = "true";

          }

          $validator = $this->validator($input,true);

          if ($validator->fails()) {

          $error = $validator->messages()->all();

          return $response = array(

          'type' => 'danger',

          'msg'  => $error



          );

          }

         */

        if ($request->hasFile('frm_profile_pic')) {

            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'service_profile_pic' . DIRECTORY_SEPARATOR;



            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'service_profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;



            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('frm_profile_pic'), $file_upload_path, 1, $thumb_upload_path, '247', '266');



            $image_name = $image_upload['filename'];
        } else {

            $image_name = $request->old_profile_pic;
        }

//return $image_name;exit;
        // save new profile pic

        $loggedinUser = Auth::user();



        $available_dates = [];

        $dateee = \DateTime::createFromFormat("m-d-Y", $request->starting_date);

        $request->starting_date = $dateee->format('Y-m-d');

        if ($request->class_meets == 'Weekly') {



            //print_r($sdate);die;

            $this->arr = [];

            $day_arr = json_decode($request->serv_time_slot);

            foreach ($day_arr as $value) {

                if ($value->sunday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Sunday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->monday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Monday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->tuesday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Tuesday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->wednesday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Wednesday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->thrusday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Thrusday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->friday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Friday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }

                if ($value->saturday_start != '') {

                    $sdate = date('Y-m-d', strtotime('next Saturday', strtotime($request->starting_date)));

                    $this->mydate($sdate, $request->end_date);
                }
            }





            $available_dates = $this->arr;

            Log::info($available_dates);
        } else {

            $this->arr = [$request->starting_date];

            $available_dates = $this->arr;
        }



        $inserted = array(
            'user_id' => $loggedinUser['id'],
            'image' => $image_name,
            'sport' => $request->frm_servicesport,
            'title' => $request->frm_servicetitle,
            'price' => $request->frm_serviceprice,
            'timeslot_from' => $request->frm_servicetimeslotfrom,
            'timeslot_to' => $request->frm_servicetimeslotto,
            'servicedesc' => $request->frm_servicedesc,
            'servicetype' => json_encode($request->frm_servicetype, JSON_FORCE_OBJECT),
            'programtype' => $request->frm_programtype,
            'agerange' => json_encode($request->frm_agerange, JSON_FORCE_OBJECT),
            'programfor' => json_encode($request->frm_programfor, JSON_FORCE_OBJECT),
            'numberofpeople' => json_encode($request->frm_numberofpeople, JSON_FORCE_OBJECT),
            'experience_level' => json_encode($request->frm_experience_level, JSON_FORCE_OBJECT),
            'servicelocation' => json_encode($request->frm_servicelocation, JSON_FORCE_OBJECT),
            'focuses' => json_encode($request->frm_servicefocuses, JSON_FORCE_OBJECT),
            'specialdeals' => json_encode($request->frm_specialdeals, JSON_FORCE_OBJECT),
            'servicepriceoption' => json_encode($request->frm_servicepriceoption, JSON_FORCE_OBJECT),
            'duration' => $request->frm_serviceduration,
            'terms_conditions' => $request->termcondfaqtext,
            "expire_days" => $request->expire_days,
            "expire_in_option" => $request->expire_in_option1,
            "expire_in_option2" => $request->expire_in_option2,
            "sessions" => $request->sessions,
            "multiple_count" => $request->multiple_count,
            "recurring_pay" => $request->recurring_pay,
            "introoffer" => $request->introoffer,
            "runautopay" => $request->runautopay,
            "often" => $request->often,
            "often_every_op1" => $request->often_every_op1,
            "often_every_op2" => $request->often_every_op2,
            "numberofpays" => $request->numberofpays,
            "chargeclients" => $request->chargeclients,
            "termcondfaq" => $request->termcondfaq,
            'terms_conditions' => $request->termcondfaqtext,
            "contractterms" => $request->contractterms,
            "contracttermstext" => $request->contracttermstext,
            "liability" => $request->liability,
            "liabilitytext" => $request->liabilitytext,
            "setupprice" => $request->setupprice,
            "offerpro_states" => $request->offerpro_states,
            "activitydesignsfor" => json_encode($request->activitydesignsfor, JSON_FORCE_OBJECT),
            "activitytype" => json_encode($request->activitytype, JSON_FORCE_OBJECT),
            "frm_teachingstyle" => json_encode($request->frm_teachingstyle, JSON_FORCE_OBJECT),
            "salestax" => $request->salestax,
            "after_drop" => $request->after_drop,
            "salestaxpercentage" => $request->salestaxpercentage,
            "duestax" => $request->duestax,
            "duestaxpercentage" => $request->duestaxpercentage,
            'serv_time_slot' => $request->serv_time_slot,
            'class_meets' => $request->class_meets,
            'starting_date' => $request->starting_date,
            'end_date' => $request->end_date,
            'available_dates' => json_encode($available_dates),
            'schedule_until' => $request->schedule_until,
            "covid" => 1,
            "covidtext" => $request->covidtext,
        );



        if ($request->company_id) {

            $new_array = array('company_id' => $request->company_id);



            $inserted = array_merge($inserted, $new_array);

            //array_push($inserted,('company_id'=>$$request->company_id));
        }



        if ($request->editservice_id > 0) {

            //print_r($inserted);

            $serviceObj = DB::table('user_services')
                    ->where('id', $request->editservice_id)
                    ->update($inserted);

            $msg = "Service Updated successfully!";
        } else {

            $serviceObj = DB::table('user_services')
                    ->insert($inserted);

            $msg = "Service saved successfully!";
        }

        /* logic to save service - ends */

        return $response = array(
            'type' => 'success',
            'msg' => $msg,
            'image_name' => $image_name
        );

        /* $request->session()->flash('alert-success', 'Service saved successfully!');

          return redirect('/profile/editProfileHistory'); */
    }

    protected function validator($data, $check) {

        $rules = [

            "user_id" => "required", "sport" => "required", "title" => "required", "price" => "required", "servicedesc" => "required", "servicetype" => "required", "programtype" => "required", "agerange" => "required", "programfor" => "required", "numberofpeople" => "required", "experience_level" => "required", "servicelocation" => "required", "focuses" => "required", "specialdeals" => "required", "servicepriceoption" => "required", "duration" => "required", "terms_conditions" => "required", "expire_days" => "required", "expire_in_option" => "required", "expire_in_option2" => "required", "sessions" => "required", "multiple_count" => "required", "recurring_pay" => "required", "introoffer" => "required", "runautopay" => "required", "often" => "required", "often_every_op1" => "required", "often_every_op2" => "required", "numberofpays" => "required", "chargeclients" => "required", "termcondfaq" => "required", "contractterms" => "required", "contracttermstext" => "required", "liability" => "required", "liabilitytext" => "required", "setupprice" => "required", "offerpro_states" => "required", "activitydesignsfor" => "required", "activitytype" => "required", "frm_teachingstyle" => "required"

                // 'image' => 'required|image|mimes:jpeg,jpg,bmp,png|max:750'
        ];



        $message = [

            'frm_servicesport.required' => 'Sport is required',
            'frm_servicetitle.required' => 'Title is required',
            'frm_serviceprice.required' => 'Price is required',
            'frm_servicedesc.required' => 'Description is required',
            'frm_servicetype.required' => 'Service Type is required',
            'frm_programtype.required' => 'Program Type is required',
            'frm_agerange.required' => 'Age-Range is required',
            'frm_programfor.required' => 'Program is required',
            'frm_numberofpeople.required' => 'Number of People is required',
            'frm_experience_level.required' => 'Experience Level is required',
            'frm_servicelocation.required' => 'Place is required',
            'frm_servicefocuses.required' => 'Focuses is required',
            'frm_specialdeals.required' => 'Special Deals is required',
            'frm_servicepriceoption.required' => 'Price Options is required',
            'frm_serviceduration.required' => 'Duration is required',
            'frm_tcdesc.required' => 'Terms and Conditions is required',
            'frm_profile_pic.required' => 'Service pic is required'
        ];



        if ($check == 'true') {

            $rules['frm_profile_pic'] = 'required|image|mimes:jpeg,jpg,bmp,png|max:750';
        }

        return Validator::make($data, $rules, $message);
    }

    public function get_serviceform($id = null) {

        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail', 'history', 'education', 'certification', 'service'));

        $service = UserService::where('id', $id)->get();

        //    print_r($id);die;

        if (count($service) != 0) {

            $service_c = @$service[0]['sport'];

            $image = $service[0]['image'];
        } else {

            $service_c = '';

            $image = null;
        }

        if ($sports) {

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if (count($value1->child)) {

                        $sports_select .= "<optgroup label='" . $value1->title . "'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected = ($service_c == $key2) ? "selected" : "";

                            $sports_select .= "<option value='" . $key2 . "' " . $selected . " >" . $value2 . "</option>";
                        }

                        $sports_select .= "</optgroup>";
                    } else {

                        $selected = ($service_c == $value1->value) ? "selected" : "";

                        $sports_select .= "<option value='" . $value1->value . "' " . $selected . ">" . $value1->title . "</option>";
                    }
                }
            }
        }



        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();



        return view('profiles.servicepopup', [

            'service' => $service,
            'image' => $image,
            'UserProfileDetail' => $UserProfileDetail,
            'sports_select' => $sports_select,
            'sport_dd' => $sport_dd + $sports_names,
            'businessType' => $businessType,
            'activity' => $activity,
            'programType' => $programType,
            'programFor' => $programFor,
            'teaching' => $teaching,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "COMPLETE PROFILE",
            'allLanguages' => $languages,
            'timeSlots' => $timeSlots,
            'mydetails' => User::find($loggedinUser['id'])]);
    }

    public function get_serviceform2($id = null) {

        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail', 'history', 'education', 'certification', 'service'));

        $service = UserService::where('id', $id)->get();

        //    print_r($id);die;

        if (count($service) != 0) {

            $service_c = @$service[0]['sport'];

            $image = $service[0]['image'];
        } else {

            $service_c = '';

            $image = null;
        }

        if ($sports) {

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if (count($value1->child)) {

                        $sports_select .= "<optgroup label='" . $value1->title . "'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected = ($service_c == $key2) ? "selected" : "";

                            $sports_select .= "<option value='" . $key2 . "' " . $selected . " >" . $value2 . "</option>";
                        }

                        $sports_select .= "</optgroup>";
                    } else {

                        $selected = ($service_c == $value1->value) ? "selected" : "";

                        $sports_select .= "<option value='" . $value1->value . "' " . $selected . ">" . $value1->title . "</option>";
                    }
                }
            }
        }



        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();



        return view('profiles.newservicepopup', [

            'service' => $service,
            'image' => $image,
            'UserProfileDetail' => $UserProfileDetail,
            'sports_select' => $sports_select,
            'sport_dd' => $sport_dd + $sports_names,
            'businessType' => $businessType,
            'activity' => $activity,
            'programType' => $programType,
            'programFor' => $programFor,
            'teaching' => $teaching,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "COMPLETE PROFILE",
            'allLanguages' => $languages,
            'timeSlots' => $timeSlots,
            'mydetails' => User::find($loggedinUser['id'])]);
    }

    public function get_serviceform1($id = null) {

        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail', 'history', 'education', 'certification', 'service'));

        $service = UserService::where('id', $id)->get();

        //    print_r($id);die;

        if (count($service) != 0) {

            $service_c = @$service[0]['sport'];

            $image = $service[0]['image'];
        } else {

            $service_c = '';

            $image = null;
        }

        if ($sports) {

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if (count($value1->child)) {

                        $sports_select .= "<optgroup label='" . $value1->title . "'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected = ($service_c == $key2) ? "selected" : "";

                            $sports_select .= "<option value='" . $key2 . "' " . $selected . " >" . $value2 . "</option>";
                        }

                        $sports_select .= "</optgroup>";
                    } else {

                        $selected = ($service_c == $value1->value) ? "selected" : "";

                        $sports_select .= "<option value='" . $value1->value . "' " . $selected . ">" . $value1->title . "</option>";
                    }
                }
            }
        }



        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();



        return view('profiles.create_service', [

            'service' => $service,
            'image' => $image,
            'UserProfileDetail' => $UserProfileDetail,
            'sports_select' => $sports_select,
            'sport_dd' => $sport_dd + $sports_names,
            'businessType' => $businessType,
            'activity' => $activity,
            'programType' => $programType,
            'programFor' => $programFor,
            'teaching' => $teaching,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "COMPLETE PROFILE",
            'allLanguages' => $languages,
            'timeSlots' => $timeSlots,
            'mydetails' => User::find($loggedinUser['id'])]);
    }

    public function getmyservices(Request $request) {



        $login_id = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);

        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        if ($request->company_id) {

            $service = UserService::where('user_id', $login_id['id'])->where('company_id', $request->company_id)->get();
        } else {

            $service = UserService::where('user_id', $login_id['id'])->get();
        }



        return view('profiles.myservices', [

            'myservice' => $service,
            'sport_dd' => $sport_dd + $sports_names
                ]
        );
    }

    public function evident() {

        $loggedinUser = Auth::user();

        $dd = DB::select('select * from user_evident where user_id = "' . $loggedinUser["id"] . '"');

        //   dd($dd);

        $check = false;

        $d = '';

        if (@$dd[0]->status == 1) {

            $d = "Your request is Approve";

            $check = true;
        }

        if (count($dd) > 0) {

            $evidentstatus = json_decode(Evident::request_id($dd[0]->evident_id));



            if ($evidentstatus->attributes[0]->status == 'pending') {

                $d = 'Your request is under processing';
            } else {

                Evidents::where('id', $dd[0]->id)->update(['status' => 1]);

                $d = 'Your request is Approve';

                $check = true;
            }
        }



        return view('profiles.evident', compact('d', 'check'));
    }

    public function evidentdata(Request $r) {

        $input = $r->all();

        $verifydata = array(
            "email" => Auth::user()['email'],
            "summary" => "Basic Background Check Test",
            "description" => "This is a test of the Evident ID API. The description goes into the email body",
            "userAuthenticationType" => "blindtrust",
            "attributesRequested" => [array("attributeType" => "background.criminal.profile.standard_basic")]
        );

        $submitdata = array(
            "inputs" =>
            [array(
            "type" => "core.ssn",
            "value" => $r->ssn
                ),
                array(
                    "type" => "core.dateofbirth",
                    "value" => array(
                        "objectType" => "date",
                        "year" => date('Y', strtotime($r->dateofbirth)),
                        "day" => date('d', strtotime($r->dateofbirth)),
                        "month" => date('m', strtotime($r->dateofbirth))
                    )
                ),
                array(
                    "type" => "core.fullname",
                    "value" => array(
                        "objectType" => "Name",
                        "prefix" => null,
                        "first" => $r->name,
                        "middle" => null,
                        "last" => $r->lastname,
                        "suffix" => null
                    )
                ),
                array(
                    "type" => "consent.fcra.reviewed_disclosure",
                    "value" => true
                ),
                array(
                    "type" => "consent.fcra.authorized",
                    "value" => true
                ),
                array(
                    "type" => "consent.fcra.requested_free_copy_state",
                    "value" => true
                )
        ]);







        $s = Evident::curl_verify(json_encode($verifydata));

        $s = json_decode($s, JSON_OBJECT_AS_ARRAY);



        $login_id = Auth::user();

        $savedata = array(
            'user_id' => $login_id['id'],
            'userIdentityToken' => $s['userIdentityToken'],
            'idOwnerId' => $s['idOwnerId'],
            'evident_id' => $s['id'],
            'other_data' => json_encode($submitdata),
            'business_email' => Auth::user()['email']
        );

        $save = Evidents::create($savedata);

        if ($save) {

            echo Evident::curl_submit(json_encode($submitdata));
        }
    }

    

    public function cajax(Request $request) {
        switch ($request->type) {
            case 'add':
                $event = Event::create([
                            'title' => $request->title,
                            'start' => $request->start,
                            'end' => $request->end,
                ]);
                return response()->json($event);
                break;

            case 'update':
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);
                return response()->json($event);
                break;

            case 'delete':
                $event = Event::find($request->id)->delete();
                return response()->json($event);
                break;

            default:
                # code...
                break;
        }
    }

    public function favorite(Request $request) {
        
        $user = User::where('id', Auth::user()->id)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        //$FavDetail = BusinessServicesFavorite::where('user_id', Auth::user()->id)->get();
        $FavDetail = BusinessServicesFavorite::select("business_services.id", "business_services.program_name", 
        "business_services.profile_pic", "business_services.sport_activity", "business_services_favorite.service_id", 
        "business_services_favorite.user_id")
                ->join("business_services", "business_services_favorite.service_id", "=", "business_services.id")
                ->where("business_services_favorite.user_id", Auth::user()->id)
                ->get();
        
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        return view('personal-profile.favorite', [
            'UserProfileDetail' => $UserProfileDetail, 
            'FavDetail' => $FavDetail,
            'cart' => $cart
        ]);
        
        /*$user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('m d,Y', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        $UserProfileDetail['email'] = $user->email;

        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
            ;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
            ;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;

        $follow = UserFavourite::select("company_informations.company_name", "company_informations.first_name", "company_informations.last_name", "company_informations.id", "company_informations.logo", "company_informations.address", "company_informations.contact_number", "users_favourite.favourite_user_id", "users_favourite.user_id", "company_informations.user_id")
                ->join("company_informations", "users_favourite.favourite_user_id", "=", "company_informations.id")
                ->where("users_favourite.user_id", Auth::user()->id)
                ->get();


        $FavDetail = $follow;
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        return view('personal-profile.favorite', [
            'UserProfileDetail' => $UserProfileDetail, 
            'FavDetail' => $FavDetail,
            'cart' => $cart
        ]);*/
    }

    public function followers(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('m d,Y', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        $UserProfileDetail['email'] = $user->email;

        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
            ;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
            ;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;

        /*$fdata = UserFollow::select("user_id", "follow_id", "follower_id")
                ->where("user_id", "!=", Auth::user()->id)
                ->orwhere("follow_id", "=", 4)
                ->where("follow_id", "=", 1)
                ->get();*/

        $fdata = UserFollow::select("user_id", "follow_id", "follower_id")
                ->where("follower_id", "=", Auth::user()->id)
                ->get();
        
        $testdata = '';
        if(isset($fdata)) {
        foreach ($fdata as $data) {
            $query = CompanyInformation::select("first_name", "last_name", "logo", "user_id", "id")
                    ->where("user_id", $data['user_id'])
                    ->first();
            $queryUser = User::select("firstname", "lastname", "profile_pic", "id")
                    ->where("id", $data['user_id'])
                    ->first();
            $isfollow = UserFollow::select("user_id", "follow_id", "follower_id")
                ->where("follower_id", "=", @$queryUser['id'])
                ->get();
            $id = $user_id = $logo = $fname = $lname = "";
            if( !empty($queryUser) ) {
                $id = isset($query["id"]) ? $query["id"] : "";
                $user_id = isset($data["user_id"]) ? $data["user_id"] : "";
                $logo = isset($queryUser["profile_pic"]) ? $queryUser["profile_pic"] : "";
                $fname = isset($queryUser["firstname"]) ? $queryUser["firstname"] : "";
                $lname = isset($queryUser["lastname"]) ? $queryUser["lastname"] : "";
                
                $queryUserfollowersdata = UserFollow::select("user_id", "follow_id", "follower_id")->where("follower_id", "=", $queryUser["id"])->get();
                $queryUserfollowingdata = UserFollow::select("user_id", "follow_id", "follower_id")->where("user_id", "=",$queryUser["id"])->get();
                $testdata .='
                <div class="followers-block">
                    <div class="followers-content">
						<div class="col-md-1 col-xs-4 nopadding">';
                            if(File::exists(public_path("/uploads/profile_pic/thumb/".$logo )))
                                $testdata .= '<div class="admin-img">
                                    <img src="/public/uploads/profile_pic/thumb/'.$logo.'" alt="Fitnessity">';
                            else
                            {
                                $testdata .= '<div class="admin-img-text">';
                                $pf=substr($queryUser["firstname"], 0, 1).substr($queryUser["lastname"], 0, 1);
                                $testdata .= '<p>'.$pf.'</p>';
                            }
							$testdata .= '</div>
						</div>
						<div class="col-md-7 col-xs-7">
							<div class="followers-right-content mt-15">
								<h5> '.$fname.' '.$lname.' </h5>
								<ul>
									  <li><span>Follower </span> '.$queryUserfollowersdata->count().' </li>
									  <li><span>Member Since</span> '.date('F Y',strtotime($user->created_at)).'</li>
									  <li><span>Following </span> '.$queryUserfollowingdata->count().' </li>
								   
								</ul>
							</div> 
						</div>
						<div class="col-md-2 col-xs-6 mt-35">';
							if ($isfollow->count()>0) {
								$testdata .='Following';
							} else {
								$testdata .='<a class="followback" id="'.$id.'" data-user="'.$user_id.'">Follow</a> ';
							}

						$testdata .=' </div>
						<div class="col-md-2 col-xs-6">
							<div class="followers-button">
								<a class="following-btn follow-btn remove-btn" id="'.$user_id.'">Remove</a>
							</div>
						</div>
					</div>
				</div>';
            }
        }
        }
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        return view('personal-profile.followers', [
            'UserProfileDetail' => $UserProfileDetail, 
            'testdata' => $testdata,
            'cart' => $cart
        ]);
    }

    public function following(Request $request) {

        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('m d,Y', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        

        /*$follow = UserFollow::select("company_informations.company_name", "company_informations.first_name", "company_informations.last_name", "company_informations.id", "company_informations.logo")
                ->join("company_informations", "users_follow.follow_id", "=", "company_informations.id")
                ->where("users_follow.user_id", "=", Auth::user()->id)
                ->get();*/
        $follow = UserFollow::select("user_id", "follow_id", "follower_id")
                ->where("user_id", "=", Auth::user()->id)
                ->get();
        $FollowDetail = $follow;
        
        /*$cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }*/

        return view('personal-profile.following', [
            'UserProfileDetail' => $UserProfileDetail, 
            'FollowDetail' => $FollowDetail,
           // 'cart' => $cart
        ]);
    }
    
    public function creditCardInfo(Request $request){
        $cardInfo = [];
        $intent = null;
        $user = User::where('id', Auth::user()->id)->first();
        $customers = $user->customers()->pluck('id')->toArray();
        $customer_ids = implode(',',$customers);

        $query = StripePaymentMethod::where('user_type', 'user')
            ->where('user_id', Auth::user()->id);

        if ($customer_ids) {
            $query->orWhere(function($subquery) use ($customer_ids) {
                $subquery->where('user_type', 'customer')
                    ->whereIn('user_id', explode(',', $customer_ids));
            });
        }

        $cardInfo = $query->orderBy('created_at', 'desc')->get();

        $UserProfileDetail['firstname'] =  $user->firstname;
       
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        if($user->stripe_customer_id != ''){
            $intent = $stripe->setupIntents->create([
                'payment_method_types' => ['card'],
                'customer' => $user->stripe_customer_id,
            ]);
        }

        return view('personal-profile.credit-cards', [
            'UserProfileDetail' => $UserProfileDetail, 
            'cardInfo' => $cardInfo,
            'cart' => $cart,
            'intent' => $intent 
        ]);
    }
    
    public function cardsSave(Request $request) {
       
        $user = User::where('id', Auth::user()->id)->first();
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $payment_methods = $stripe->paymentMethods->all(['customer' => $user->stripe_customer_id, 'type' => 'card']);
        $fingerprints = [];
        foreach($payment_methods as $payment_method){
            $fingerprint = $payment_method['card']['fingerprint'];
            if (in_array($fingerprint, $fingerprints, true)) {
                $deletePaymentMethod = StripePaymentMethod::where('payment_id', $payment_method['id'])->first();
                if($deletePaymentMethod != ''){
                    $deletePaymentMethod->delete();
                }
            } else {
                $fingerprints[] = $fingerprint;
                $stripePaymentMethod = StripePaymentMethod::firstOrNew([
                    'payment_id' => $payment_method['id'],
                    'user_type' => 'User',
                    'user_id' => $user->id,
                ]);

                $stripePaymentMethod->pay_type = $payment_method['type'];
                $stripePaymentMethod->brand = $payment_method['card']['brand'];
                $stripePaymentMethod->exp_month = $payment_method['card']['exp_month'];
                $stripePaymentMethod->exp_year = $payment_method['card']['exp_year'];
                $stripePaymentMethod->last4 = $payment_method['card']['last4'];
                $stripePaymentMethod->save();

                $customer = Customer::where(['fname' =>$user->firstname,'lname' =>$user->lastname, 'email' => $user->email])->get();

                if ($stripePaymentMethod->wasRecentlyCreated && !empty($customer) ) {
                  
                    foreach($customer as $cus){
                        $spmForCus = StripePaymentMethod::create([
                            'payment_id' => $payment_method['id'],
                            'user_type' => 'Customer',
                            'user_id' => $cus->id,
                            'pay_type' => $payment_method['type'],
                            'brand' => $payment_method['card']['brand'],
                            'exp_month' => $payment_method['card']['exp_month'],
                            'exp_year' => $payment_method['card']['exp_year'],
                            'last4' => $payment_method['card']['last4'],
                        ]);
                    }
                }
            }
        }

        if($request->chkRedirection == 1){
            $user->show_step = 7;
            $user->save();
            return redirect('/registration/?showstep=1'); 
        }else{
            return redirect()->route('creditCardInfo'); 
        }
        
    }

    public function cardDelete(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $request->stripe_payment_method)->firstOrFail();

        $stripePaymentMethod->delete();
    }

    public function paymentHistory(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $customers = $user->customers()->pluck('id')->toArray();
        $customer_ids = implode(',',$customers);

        $query2 = Transaction::where('transaction.user_type', 'user')
            ->where('transaction.user_id', Auth::user()->id);

        if ($customer_ids) {
            $query2->orWhere(function($subquery) use ($customer_ids) {
                $subquery->where('transaction.user_type', 'customer')
                    ->whereIn('transaction.user_id', explode(',', $customer_ids));
            });
        }

        $query2 = $query2->join("user_booking_status as ubs", "transaction.item_id", "=", "ubs.id")->Join("user_booking_details as usd", "ubs.id", "=", "usd.booking_id");
        $transactionDetail = $query2->orderby('transaction.created_at' ,'DESC')->whereNotNull('usd.id')->paginate(10); 

        //print_r($transactionDetail);exit;
        $UserProfileDetail['firstname'] =  $user->firstname;
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        return view('personal-profile.payment-history', [
            'UserProfileDetail' => $UserProfileDetail, 
            'transactionDetail' => $transactionDetail, 
            'cart' => $cart
        ]);
    }

    public function card_purchase_history(Request $request){
        // /print_r($request->all());exit;
        $cardDetail = StripePaymentMethod::findOrFail($request->pid);
        $user = Auth::user();
        $transactionDetail = $user->Transaction()->where('stripe_payment_method_id',$cardDetail->payment_id)->get();
        $html = '';
        foreach($transactionDetail as $history){
            $html .= '<tr>
                <td>'.date('m/d/Y',strtotime($history->created_at)).'</td>
                <td>'.$history->item_description()['itemDescription'].'</td>
                <td>'.$history->item_type_terms().'</td>
                <td>'.$history->getPmtMethod().'</td>
                <td>$'.$history->amount.'</td>
                <td>'.$history->item_description()['qty'].'</td>
            </tr>';
        }
        return $html;
    }

    public function review(Request $request) {

        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('m d,Y', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        $UserProfileDetail['profile_pic '] = $user->profile_pic;

        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
            ;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
            ;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;

        $reviewdata = Review::select("review", "rating", "title", "created_at")
                ->where("reviewfor_userid", Auth::user()->id)
                ->get();

        $RevData = $reviewdata;
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        return view('personal-profile.review', [
            'UserProfileDetail' => $UserProfileDetail, 
            'RevData' => $RevData, 
            'cart' => $cart
        ]);
    }

    public function userprofile(Request $request) {

        if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
        $loggedinUser = Auth::user();
        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail', 'history', 'education', 'certification', 'service'));
        if (isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0) {
            $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
        }
    
        $view = 'personal-profile.user-profile';

        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('Y-m-d', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        //$UserProfileDetail['email'] = $user->email;
        if (!empty($user->profile_pic)) {
            $UserProfileDetail['profile_pic'] = $user->profile_pic;
        }
        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;
       
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        return view($view, [
            'cart' => $cart,
            'UserProfileDetail' => $UserProfileDetail,
            'pageTitle' => "PROFILE"
        ]);
        //return view('personal-profile.user-profile');
    }

    public function updateuserprofile(Request $request) {
        if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
        $loggedinUser = Auth::user();
        $user = User::where('id', Auth::user()->id)->first();

        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ]);


        $imageName = '';
        if($request->hasFile('frm_profile_pic')){
            $imageName = $request->file('frm_profile_pic')->store('customer');
        }else{
            $imageName = $request->old_profile_pic;
        }

        $cat = User::find($loggedinUser['id']);
        $cat->firstname = $request->firstname;
        $cat->lastname = $request->lastname;
        $cat->gender = $request->gender;
        $cat->phone_number = $request->phone_number;
        $cat->dobstatus = $request->dobstatus;
        $cat->address = $request->address;
        $cat->country = $request->country;
        $cat->zipcode = $request->zipcode;
        $cat->state = $request->state;
        $cat->city = $request->city;
        $cat->birthdate = date('Y-m-d', strtotime($request['birthdate']));
        $cat->quick_intro = $request->quick_intro;
        $cat->favorit_activity = $request->favorit_activity;
        $cat->business_info = $request->business_info;
        if (!empty($imageName)) {
            $cat->profile_pic = $imageName;
        }
        $affected = $cat->update();

        if ($affected)
            return Redirect::back()->with('success', 'Profile updated successfully.');
        else
            return Redirect::back()->with('error', 'Problem in profile update.');
    }

    public function addinstantHire(Request $request) {


        $activity = $request->sport;
        $qoutes = $request->qoutes;
        $activity_for = '';
        $language = '';
        $expLevel = '';
        $expActivity = '';
        $expProfessional = '';
        $do_activity = '';
        $which_personality = '';
        $days = '';
        $time_available = '';

        if ($request->activity_for != '') {
            $activity_for = implode(',', $request->activity_for);
        }

        if ($request->language != '') {
            $language = implode(',', $request->language);
        }

        if ($request->expLevel != '') {
            $expLevel = implode(',', $request->expLevel);
        }

        if ($request->expActivity != '') {
            $expActivity = implode(',', $request->expActivity);
        }

        if ($request->expProfessional != '') {
            $expProfessional = implode(',', $request->expProfessional);
        }

        $gear = $request->gear;
        $gearYes = $request->gearYes;

        $activeLevel = $request->activeLevel;

        if ($request->do_activity != '') {
            $do_activity = implode(',', $request->do_activity);
        }

        if ($request->which_personality != '') {
            $which_personality = implode(',', $request->which_personality);
        }

        $gender = $request->gender;
        $ageRange = $request->ageRange;
        $participateActivity = $request->participateActivity;

        if ($request->days != '') {
            $days = implode(',', $request->days);
        }
        if ($request->time_available != '') {
            $time_available = implode(',', $request->time_available);
        }
        $medicalIssue = $request->medicalIssue;
        $medicalYes = $request->medicalYes;
        $trainingLocation = $request->trainingLocation;
        $StartActivity = $request->StartActivity;
        $travelUpto = $request->travelUpto;
        $zipcode = $request->zipcode;
        $savedata = array(
            'activity' => $activity,
            'qoutes' => $qoutes,
            'activity_for' => $activity_for,
            //'language'=>$language,
            'expLevel' => $expLevel,
            'expActivity' => $expActivity,
            'expProfessional' => $expProfessional,
            'gear' => $gear,
            'gearYes' => $gearYes,
            'activeLevel' => $activeLevel,
            'do_activity' => $do_activity,
            'which_personality' => $which_personality,
            'gender' => $gender,
            'ageRange' => $ageRange,
            'participateActivity' => $participateActivity,
            'days' => $days,
            'time_available' => $time_available,
            'medicalIssue' => $medicalIssue,
            'medicalYes' => $medicalYes,
            'trainingLocation' => $trainingLocation,
            'StartActivity' => $StartActivity,
            'travelUpto' => $travelUpto,
            'zipcode' => $zipcode
        );

        $save = InstantForms::create($savedata);
        // return redirect('/')->with('message', 'Your Data Saved Successfully!');
        return view('home.instant_success');
    }

    public function savemycoverphoto(Request $request) {
        if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
        $loggedinUser = Auth::user();
        $cat = User::find($loggedinUser['id']);
        $user = User::where('id', Auth::user()->id)->first();        
        $this->validate($request, [
            'coverphoto' => 'required|dimensions:min_width=800,min_height=450',
        ]);


        if($request->hasFile('coverphoto')) {
            $file = Input::file('coverphoto');
            $name = $file->getClientOriginalName();

            $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR. $loggedinUser->id .DIRECTORY_SEPARATOR ."thumb".DIRECTORY_SEPARATOR, $name);
         }

        /*$imageName = '';
        if ($request->hasFile('coverphoto')) {

            $file_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'cover-photo' . DIRECTORY_SEPARATOR;
            $thumb_upload_path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'cover-photo' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR;
            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('coverphoto'), $file_upload_path, 1, $thumb_upload_path, '247', '266');
            $imageName = $image_upload['filename'];
             if($user->cover_photo != ''){
              @unlink(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'cover-photo'.DIRECTORY_SEPARATOR.$user->cover_photo);
              @unlink(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'cover-photo'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$user->cover_photo);
              } 
        }*/

          $affected = DB::table('users_add_attachment')->insert(['user_id' => Auth::user()->id, 'attachment_name' => $name, 'attachment_status' => '1' ,'cover_photo' =>'1']);

       /* $cat = User::find($loggedinUser['id']);
        $cat->cover_photo = $imageName;*/
        /*$affected = $cat->update();*/

        if ($affected) {
           /* return redirect('/profile/viewProfile?cover=1');*/
            return Redirect::back()->with('success', 'Cover photo updated successfully.');
        } else {
           /* return redirect('/profile/viewProfile?cover=0');*/
            return Redirect::back()->with('error', 'Problem in updating cover photo.');
        }
            
    }

    public function removeusercoverphoto(Request $request) {
        if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
        $loggedinUser = Auth::user();
        $cat = User::find($loggedinUser['id']);
        $imageName = '';
        if ($cat->cover_photo != '') {
            @unlink(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'cover-photo' . DIRECTORY_SEPARATOR . $cat->cover_photo);
            @unlink(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'cover-photo' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $cat->cover_photo);
        }
        $cat = User::find($loggedinUser['id']);
        $cat->cover_photo = $imageName;
        $affected = $cat->update();

        if ($affected)
            echo "success";
        else
            echo "fail";
        exit;
    }

    public function updatechangepassword(Request $request) {
        if (!Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
        $loggedinUser = Auth::user();
        $user = User::where('id', Auth::user()->id)->first();

        $this->validate($request, [
            'currpassword' => 'required',
            'newpassword' => 'min:6|required_with:retypepassword|same:retypepassword',
            'retypepassword' => 'required|min:6',
        ]);
        $affected = "";
        $current_password = Auth::User()->password;
        if (Hash::check($request->newpassword, $current_password)) {
            $cat = User::find($loggedinUser['id']);
            $cat->password = Hash::make($request->newpassword);
            $affected = $cat->save();
            //$affected=$cat->update();
        }
        if ($affected)
            return Redirect::back()->with('success', 'Password has been changed successfully.');
        else
            return Redirect::back()->with('error', 'Problem in password change.');
    }

    public function removefamily(Request $request) {
        //print_r($request->all());exit;
        DB::delete('DELETE FROM  user_family_details WHERE id = "' . $request->id . '"');
    
        return Redirect::back()->with('success', 'Family Member Deleted Successfully..');
    }

    public function payment_history(Request $request){
        if($request->type == 'user'){
            $purchase_history = Auth::user()->Transaction()->orderby('id', 'desc')->get();
        }else{
            $customer = Customer::find($request->id);
            $purchase_history = @$customer != '' ?  @$customer->Transaction()->orderby('id', 'desc')->get() : [];
        }
        //print_r($purchase_history);exit;
        return view('personal-profile.payment-history-modal',['purchase_history'=>$purchase_history ,'id'=>$request->id]);
    }

    public function spotify() 
    {
        return view('spotify');
    }
    
    public function followProfile(Request $request) {
        $userid = $request->userid;
        $profileid = $request->profileid;
        $follow_id = 0;
        $followpro = UserFollow::create([
            'user_id' => $userid,
            'follow_id' => $follow_id,
            'follower_id' => $profileid
        ]);
        if($followpro){
            $noti = Notification::create([
                'user_id' => $profileid,
                'sender_id' => $userid,
                'type' => '2',
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

    public function getServiceData(Request $request) {
        $user = BusinessServices::where('id', $request->sid)->first();
        $businessData = [
            'bstep' => 72,
            'serviceid' => $user['id'],
            'servicetype' => $user['service_type']
        ];
        User::where('id', Auth::user()->id)->update($businessData);
        echo 'success';
    }

    public function NewService(Request $request) {
        $businessData = [
            'bstep' => 72,
            'cid' => $request->cid,
            'serviceid' => 0,
            'servicetype' => $request->service_type
        ];
        
        User::where('id', Auth::user()->id)->update($businessData);
        echo 'success';
    }   

    public function resendOpt(Request $request){
        $digits = 4;
        $random = rand(pow(10, $digits-1), pow(10, $digits)-1);
        CompanyInformation::where('id',$request->cid)->update(['claim_business_verification_code'=>$random]);
        $details = [];
        $data = CompanyInformation::where('id',$request->cid)->first();
        if($request->type == 'email'){
            $details = array(
                "random_code" => $random,
                "email" =>$data->business_email
            );
            $success = MailService::sendEmailclaimvarification($details);
        }else if($request->type == 'phone'){
            $phone_number = str_replace([' ','(',')','-'],'',$data->business_phone);
            $phone_number = '+1'.$phone_number;
            $success = $this->sendMessage($random,$phone_number);
        }else{
            $phone_number = str_replace([' ','(',')','-'],'',$data->business_phone);
            $phone_number = '+1'.$phone_number;
            $success = $this->makeCalluser($random,$phone_number);
        }
        
        return $success;
    }

    public function varify_email_for_claim_business(Request $request){
        $digits = 4;
        $random = rand(pow(10, $digits-1), pow(10, $digits)-1);
        CompanyInformation::where('id',$request->cid)->update(['claim_business_verification_code'=>$random]);
        $details = [];
        $data = CompanyInformation::where('id',$request->cid)->first();
        if($request->type_enter == 'email'){
             if($data->business_email == $request->val){
                $details = array(
                    "random_code" => $random,
                    "email"=>$request->val
                );
                MailService::sendEmailclaimvarification($details);
                $msg = "Success";
            }else{
                $msg = "Fail";
            }
        }else if($request->type_enter == 'phone'){
            $phone_number = str_replace([' ','(',')','-'],'',$request->val);
            $phone_number = '+1'.$phone_number;
            $msg = $this->sendMessage($random,$phone_number);

        }else{
            $phone_number = str_replace([' ','(',')','-'],'',$request->val);
            $phone_number = '+1'.$phone_number;
            $msg = $this->makeCalluser($random,$phone_number);
        }

        return $msg;
    }

    public function makeCalluser($random,$phone_number) {
        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $twilio = new Client($sid, $token);

        try{
            $call = $twilio->calls
                ->create($phone_number, // to
                $twilio_number, // from
                [
                    "twiml" => "<Response><Say voice='woman' language='en-IN'>Your one time Varification Code is " . $random . "</Say></Response>"
                ]
            );
            $msg = 'Success';
        }catch(\Exception $e) {
            $msg = 'Fail';
        }
        return $msg; 
    }

    private function sendMessage($message, $recipients)
    {   
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        try{
            $client->messages->create($recipients, [ "body" => "Your verification code is: " .$message, 'from' => $twilio_number]);
            $msg = 'Success';
        }catch(\Exception $e) {
            $msg = 'Fail';
        }
        return $msg;
    }

    public function business_claim_varification($cid,$type){
        return view('home.business-claim-varification',compact('cid','type'));
    } 

    public function varify_code_to_claim_business(Request $request){

        $data = CompanyInformation::where(['id'=>$request->cid])->first();
        $address = $city = $ZipCode = $state = '';

        if(Auth::check()){
            $id =  Auth::user()->id;
        }else{
            $id =  $request->id;
        }
        if($data != ''){
            if($data->claim_business_verification_code == $request->code){
                CompanyInformation::where('id',$request->cid)->update(['is_verified'=>1,'user_id' => $id]);
                BusinessCompanyDetail::where('id',$request->cid)->update(['showstep'=>2,'userid' => $id]);
                $user = User::where('id',$id)->update(['bstep' => 1, 'cid' => $request->cid]);
                $detail_data_com = [];
                $detail_data_com['company_data'] = CompanyInformation::where('id',$request->cid)->first();
                $allDetail  = json_decode(json_encode($detail_data_com), true); ;
                SGMailService::welcomeMailOfNewBusinessToCustomer(['cid'=> $request->cid,'email' => $user->email]);
                $msg = 'Match';
            }else{
                $msg = 'Not Match';
            }   
        }else{
            $msg = 'issue';
        }

        return $msg;
    }

    public function unset_session_for_claim(Request $request){
        session()->forget('claim_business_page');
        session()->forget('claim_cid');
        session()->forget('claim_status');
    }

    public function claim_reminder($cname , $cid){
        
        $data = CompanyInformation::where('id',$cid)->first();
        if($data->user_id){
            return redirect()->route('business_dashboard');
        }
        $val = 'null';
        $address = '';
        
        if($data->address != ''){
            $address = $data->address.', ';
        }
        if($data->city != ''){
            $address .= $data->city.', ';
        }
        if($data->state != ''){
            $address .= $data->state.', ';
        }
        if($data->country != ''){
            $address .= $data->country.', ';
        }
        if($data->zip_code != ''){
            $address .= $data->zip_code;
        }

        return view('home.business-claim-reminder',compact('cname','cid','address'));
    } 
	public function createmanageStaff(Request $request){
		return view('profiles.createstaff');
	}
	public function staff_scheduled_activities(){
		return view('profiles.staff-scheduled-activities');
	}
	public function manageproduct(){
		return view('profiles.manageproduct');
	}
	public function addproduct(){
		return view('profiles.addproduct');
	}
	public function manage_activity(){
		return view('profiles.ManageActivity');
	}
	public function financial_dashboard(){
		return view('profiles.financial-dashboard');
	}

   
    public function view_customer (){
        return view('profiles.view-customer');
    }
    public function pricedetails (){
        return view('profiles.pricedetails');
    }

    public function businesspricedetails ($catid){
        $catdata =  BusinessPriceDetailsAges::where('id',$catid)->first();
        $business_activity = BusinessActivityScheduler::where('cid', $catdata['cid'])->where('serviceid', $catdata['serviceid'])->where('category_id',$catid)->get();
        $business_activity = isset($business_activity) ? $business_activity : [];
        return view('profiles.createnewbusinesspricedetails',compact('catid','catdata','business_activity'));
    }

    /*public function addbusinessschedule (Request $request){
        // print_r($request->all());
        //   exit;
        $shift_start = $request->duration_cnt;
        // echo $shift_start; exit;
        if($shift_start >= 0) {
           // BusinessActivityScheduler::where('cid', $request->cid)->where('userid', Auth::user()->id)->where('serviceid',  $request->serviceid)->where('category_id',$request->catid)->delete();
            $alldata = BusinessActivityScheduler::where('cid', $request->cid)->where('userid', Auth::user()->id)->where('serviceid',  $request->serviceid)->where('category_id',$request->catid)->get();
            
            $idary = array();
            $idary1 = array();
            foreach( $alldata as $data_all){
                $idary[] =  $data_all['id'];
            }
            $date = '';
            $getdate = explode('/',$request->starting);
            $date .= $getdate[2].'-'.$getdate[0].'-'.$getdate[1];
            for($i=0; $i <= $shift_start; $i++) { 
                if($request->id[$i] != ''){
                    $idary1[] = $request->id[$i];
                }
                
                if($request->shift_start[$i] != '' && $request->shift_end[$i] != '' && $request->set_duration[$i] != '') {

                    if($request->until == 'days'){
                        $daynum = '+'.$request->scheduled.' days';
                        $expdate  = date('Y-m-d', strtotime($request->starting. $daynum ));
                    }else if($request->until == 'month'){
                        $daynum = '+'.$request->scheduled.' month';
                        $expdate  = date('Y-m-d', strtotime($request->starting. $daynum ));
                    }else if($request->until == 'years'){
                        $daynum = '+'.$request->scheduled.' years';
                        $expdate  = date('Y-m-d', strtotime($request->starting. $daynum ));
                    }else{
                        $daynum = '+'.$request->scheduled.' week';
                        $expdate  = date('Y-m-d', strtotime($request->starting. $daynum ));
                    }

                    $activitySchedulerData = [
                        "cid" => $request->cid,
                        "category_id" => $request->catid,
                        "userid" =>Auth::user()->id,
                        "serviceid" =>$request->serviceid,
                        "activity_meets" => $request->frm_class_meets,
                        "starting" => $date,
                        "activity_days" => isset($request->activity_days[$i]) ? $request->activity_days[$i] : '',
                        "shift_start" => isset($request->shift_start[$i]) ? $request->shift_start[$i] : '',
                        "shift_end" => isset($request->shift_end[$i]) ? $request->shift_end[$i] : '',
                        "set_duration" => isset($request->set_duration[$i]) ? $request->set_duration[$i] : '',
                        "spots_available" => isset($request->sport_avail[$i]) ? $request->sport_avail[$i] : '',
                        "scheduled_day_or_week" => $request->until, 
                        "scheduled_day_or_week_num" => $request->scheduled,
                        "end_activity_date" => $expdate,
                        "is_active" => 1,
                        "schedule_until" => '',
                        "sales_tax" => '',
                        "sales_tax_percent" => '',
                        "dues_tax" => '',
                        "dues_tax_percent" => ''
                    ];
                    if($request->id[$i] != ''){
                        // echo $request->id[$i];
                        BusinessActivityScheduler::where('id', $request->id[$i])->update($activitySchedulerData);
                    }else{
                        BusinessActivityScheduler::create($activitySchedulerData);
                    }
                    
                }
            }
        
            $differenceArray1 = array_diff($idary, $idary1);
            foreach($differenceArray1 as $deletdata){
                BusinessActivityScheduler::where('id',$deletdata)->delete();
            }
        }
        // exit;
        return redirect()->route('businesspricedetails', [$request->catid]);
        // return Redirect::route('businesspricedetails')->with('catid', $request->catid);
        // return()->route('businesspricedetails',['catid' => $request->catid]);
    }*/
    public function modelboxsuccess(Request $request){
        /*print_r($request->all());*/
        for($x=0;$x=$request->i;$x++){
            for($y=0;$y=$request->j;$y++){
                $id= $request->input('priceid_'.$x.$y);
               /* echo $id;exit;*/
                $nuberofautopays_adult= $request->input('nuberofautopays_adult_'.$x.$y);
                $client_be_charge_on_adult= $request->input('client_be_charge_on_adult_'.$x.$y);
                $first_pmt_adult= $request->input('first_pmt_adult_'.$x.$y);
                $total_contract_revenue_adult= $request->input('total_contract_revenue_adult_'.$x.$y);
                $recurring_pmt_adult= $request->input('recurring_pmt_adult_'.$x.$y);
                /* echo $recurring_pmt_adult;exit;*/
                BusinessPriceDetails::where('id',$id)->update(['is_recurring_adult'=>1,'recurring_nuberofautopays_adult'=>$nuberofautopays_adult,'recurring_client_be_charge_on_adult'=>$client_be_charge_on_adult,'recurring_client_be_charge_on_adult'=>$client_be_charge_on_adult,'recurring_first_pmt_adult'=>$first_pmt_adult,'recurring_total_contract_revenue_adult'=>$total_contract_revenue_adult,'recurring_recurring_pmt_adult'=>$recurring_pmt_adult]);
                if($x==$request->i && $y==$request->j){
                    exit;
                }
            }
        }
        return 'success';
    }
    
    public function editactivityimg(Request $request) {
        $loggedinUser = Auth::user(); 
        $serviceid = $request->serviceid;

        $html = '<input type="hidden" name="serviceid" id="serviceid" value="'.$serviceid.'">
                    <input type="hidden" name="imgnameajax" id="imgnameajax" value="'.$request->imgname.'">'; 
        $html .='<figure>
                    <div class="img-bunch">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 align-self-modal">
                                <figure>
                                    <input id="image_post" type="file" name="image_post" />
                                    <a href="#" title="" data-toggle="modal">
                                        <span class="error" id="err_image_sign">

                                   <img src="'.Storage::URL($request->imgname).'" alt="">
                                    </a>
                                </figure>
                            </div>
                        </div>
                    </div>
                </figure>';
      
       return $html;
    }

    public function activityimgupdate(Request $request) { 
        $serviceId = $request->serviceid;        
        $businessData = BusinessServices::find($serviceId);
        $profile_pic = $businessData->profile_pic;

        if ($request->hasFile('image_post')) {
            $name = $request->file('image_post')->store('activity');
            if(str_contains($profile_pic, ',')){
                $profile_pic1 = explode(',', $profile_pic);
            }else{
                $profile_pic1 = $profile_pic;
            }

            $pro_img = '';
            if(is_array($profile_pic1)){
                foreach($profile_pic1 as $key => $data){
                    if ($request->imgnameajax != $data) {
                        if($data != ''){
                           $pro_img .= $data.',';
                        }
                    }else{
                        $pro_img .= $name.',';
                        Storage::delete($request->imgnameajax);
                    }
                }
            }else{
                $pro_img = $name;
            }  
        }    
        $pro_img = rtrim($pro_img,',');
        $updateval = $businessData->update(['profile_pic' => $pro_img]);
        return redirect()->route('business.services.create',['business_id'=>$businessData->cid ,'serviceType'=>$businessData->service_type, 'serviceId'=> $serviceId]);
    } 
}

