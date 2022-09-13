<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\NetworkRepository;
use App\Repositories\UserRepository;
use Input;
use Redirect;
use Response;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\SportsRepository;
use App\UserProfessionalDetail;
use App\User;
use App\UserFollower;
use App\Miscellaneous;

class NetworkController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var NetworkRepository
     */
    protected $network;
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  NetworkRepository  $network
     * @return void
     */
    public function __construct(NetworkRepository $network, UserRepository $users, SportsRepository $sports)
    {
        $this->network = $network;
        $this->users = $users;
        $this->sports = $sports;
    }

    public function create()
    {
        return view('network.create');
    }

    public function GetContacts(Request $request)
    {
      //get Gmail contacts
      $gmailContacts = array();
      if(isset($request->code) && $request->code != "") {
        $gmailContacts = $this->getGmailContacts($request->code);
        //set session and redirect
        session(['gmailContactsSession' => $gmailContacts]);
        return Redirect::to('/network/getcontacts');
      }
      // get contacts from session
      else if(session('gmailContactsSession') && count(session('gmailContactsSession')) > 0) {
        $gmailContacts = session('gmailContactsSession');
        session(['gmailContactsSession' => array()]);
      }

      //get already registered contacts
      $contacts = $this->network->filterRegisteredContacts($gmailContacts);

      return view('network.getcontacts', ['gmailContacts' => $contacts['contacts'], 'existingContacts' => $contacts['existingContacts'], 'pageTitle' => "Invite Friends"]);
    }

    public function getGmailContacts($code)
    {
            $auth_code = $code;
            $currentUrl = $_SERVER['REQUEST_URI'];
            $currentUrl = explode('?', $currentUrl);
            $max_results = 200;

                $fields=array(
                    'code'=>  urlencode($auth_code),
                    'client_id'=>  urlencode(env('GOOGLE_CLIENT_ID')),
                    'client_secret'=>  urlencode(env('GOOGLE_SECRET_ID')),
                    'redirect_uri'=>  urlencode(env('GOOGLE_REDIRECT_URI')),
                    'grant_type'=>  urlencode('authorization_code')
                );
                $post = '';
                foreach($fields as $key=>$value)
                {
                    $post .= $key.'='.$value.'&';
                }
                $post = rtrim($post,'&');
                $result = $this->curl('https://accounts.google.com/o/oauth2/token',$post);
                $response =  json_decode($result);
                $accesstoken = $response->access_token;
                $url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&alt=json&v=3.0&oauth_token='.$accesstoken;
                $xmlresponse =  $this->curl($url);
                $responseString = implode('G', explode('$', $xmlresponse));

                $temp = json_decode($responseString,true);
                $responseArray = $temp['feed']['entry'];
                $output = array();
                $index = 0;
                if(count($responseArray) > 0) {
                  foreach ((array)$responseArray as $entry) {

                    $gdName = (isset($entry['gdGname']['gdGfullName']['Gt'])) ? $entry['gdGname']['gdGfullName']['Gt'] : '';
                    $gdFName = (isset($entry['gdGname']['gdGgivenName']['Gt'])) ? $entry['gdGname']['gdGgivenName']['Gt'] : '';
                    $gdLName = (isset($entry['gdGname']['gdGfamilyName']['Gt'])) ? $entry['gdGname']['gdGfamilyName']['Gt'] : '';
                    $gdEmail = (isset($entry['gdGemail'][0]['address'])) ? $entry['gdGemail'][0]['address'] : 'No Email Address';
                    $gdPhone = (isset($entry['gdGphoneNumber'][0]['Gt'])) ? $entry['gdGphoneNumber'][0]['Gt'] : 'No Phone Number';
                    $gdOrgName = (isset($entry['gdGorganization'][0]['gdGorgName']['Gt'])) ? $entry['gdGorganization'][0]['gdGorgName']['Gt'] : 'No Company Name';

                    $contactName = ($gdName != '') ? ucfirst($gdName) : ($gdFName != '') ? ucfirst($gdFName).' '.ucfirst($gdLName) : ucfirst($gdEmail);

                    $output[] = [
                      "tmpid"      => $index,
                      "name"       => $contactName,
                      "first_name" => ucfirst($gdFName),
                      "last_name"  => ucfirst($gdLName),
                      "email"      => $gdEmail,
                      "phone"      => $gdPhone,
                      "company"    => $gdOrgName,
                    ];
                    $index++;
                  }  
                }
                uasort($output, function ($i, $j) {
                  $a = $i['name'];
                  $b = $j['name'];
                  if ($a == $b) return 0;
                  elseif ($a > $b) return 1;
                  else return -1;
              });
        return $output;
    }

    public function curl($url,$post="")
    {
                $curl = curl_init();
                $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
                curl_setopt($curl,CURLOPT_URL,$url);    //The URL to fetch. This can also be set when initializing a session with curl_init().
                curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE); //TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
                curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);    //The number of seconds to wait while trying to connect.
                if($post!="")
                {
                    curl_setopt($curl,CURLOPT_POST,5);
                    curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
                }
                curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);  //The contents of the "User-Agent: " header to be used in a HTTP request.
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);   //To follow any "Location: " header that the server sends as part of the HTTP header.
                curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);  //To automatically set the Referer: field in requests where it follows a Location: redirect.
                curl_setopt($curl, CURLOPT_TIMEOUT, 10);    //The maximum number of seconds to allow cURL functions to execute.
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  //To stop cURL from verifying the peer's certificate.
                $contents = curl_exec($curl);
                curl_close($curl);
                return $contents;
    }

    public function sendEmailInvitation(Request $request)
    {
      $emails = array();
      if(isset($request->inviteemail) && !empty($request->inviteemail))
        $emails = explode(",", $request->inviteemail);

      //check for valid emails
      if(count($emails) > 0) {
        foreach($emails as $key=>$email) {
          if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            unset($emails[$key]);
        }        
      }

      if(count($emails) > 0) {
        $emails = array_map('trim', $emails);
        $status = $status2 = true;
        //check who is already registered among email entered by user
        $filteredContacts = $this->network->filterRegisteredContacts($emails, "email");

        //send friend request to already registered users
        if(isset($filteredContacts['existingContacts']) && count($filteredContacts['existingContacts']) > 0) {
          $existingContacts = array_unique(array_column($filteredContacts['existingContacts'], 'id'));
          $status = $this->network->sendFriendRequest(Auth::user()->id, $existingContacts);
        }
        //send email invitation to new users
        if(isset($filteredContacts['contacts']) && count($filteredContacts['contacts']) > 0) {
          $status2 = $this->network->sendInvitation($filteredContacts['contacts']);
        }

        if($status == true && $status2 == true) {
            $response = array(
                        'type' => 'success',
                        'msg' => 'Invitation sent successfully!'
                    );
        }else {
            $response = array(
                        'type' => 'danger',
                        'msg' => 'Some error while sending invitation. Please try again later.'
                    );
        }
      }else {
        $response = array(
                        'type' => 'danger',
                        'msg' => 'Please provide proper emails to send invitation.',
                    );
      }
      return Response::json($response);
    }

    public function sendInvitation(Request $request)
    {
      if(count($request->gmailcontacts) > 0) {
        $status = $this->network->sendInvitation($request->gmailcontacts);
        if($status) {
            $response = array(
                        'type' => 'success',
                        'msg' => 'Invitation sent successfully!'
                    );
        }else {
            $response = array(
                        'type' => 'danger',
                        'msg' => 'Some error while sending invitation. Please try again later.'
                    );
        }
      }else {
        $response = array(
                        'type' => 'danger',
                        'msg' => 'Please select any contact to send invitation.',
                    );
      }
      $response['data'] = $request->gmailcontacts;
      return Response::json($response);
    }

    public function sendFriendRequest(Request $request)
    {
      if(count($request->fitnessitycontacts) > 0) {
        $status = $this->network->sendFriendRequest(Auth::user()->id, $request->fitnessitycontacts);
        if($status) {
            $response = array(
                        'type' => 'success',
                        'msg' => 'Friend Request sent successfully!'
                    );
        }else {
            $response = array(
                        'type' => 'danger',
                        'msg' => 'Some error occurred while sending friend request. Please try again later.'
                    );
        }
      }else {
        $response = array(
                        'type' => 'danger',
                        'msg' => 'Please select any contact to send friend request.',
                    );
      }
      $response['data'] = $request->fitnessitycontacts;
      return Response::json($response);
    }

    public function filterRegisteredContacts(Request $request)
    {
      $contacts = $this->network->filterRegisteredContacts($request->data, 'outlook');
      $response = array(
                'type' => 'success',
                'data' => $contacts
      );
      return Response::json($response);
    }

    // public function getMyNetwork_old()
    // {
    //   $wholenetwork = $this->network->getUserNetwork(Auth::user()->id);
    //   $pendingNetworkSent = array();
    //   $pendingNetworkRcv = array();
    //   $mynetwork = array();
    //   if(count($wholenetwork) > 0) {
    //     foreach($wholenetwork as $key => $network) {
    //       if($network['status'] == "requested") {

    //         if($network['user_id'] == Auth::user()->id) {

    //           unset($network['user']);
    //           $pendingNetworkSent[] = $network;

    //         }else if($network['friend_id'] == Auth::user()->id) {
              
    //           unset($network['friendinfo']);
    //           $pendingNetworkRcv[] = $network;
    //         }            
    //       }
    //       else if($network['status'] == "accepted") {

    //         if($network['user_id'] == Auth::user()->id) {

    //         }else {
    //           $network['friendinfo'] = $network['user'];
    //         }
    //         $mynetwork[] = $network;
    //       }
    //     }
    //   }

    //   return view('network.mynetwork', ['mynetwork'=>$mynetwork, 'pendingNetworkSent'=>$pendingNetworkSent, 'pendingNetworkRcv'=>$pendingNetworkRcv]);
    // }

    public function removeNetwork(Request $request)
    {
      $status = $this->network->removeNetwork($request->id);
      if(!$status) {
        $response = array(
                        'type' => 'danger',
                        'msg' => 'Some error occurred while processing your request. Please try again later.',
                    );
      }else {
        $response = array(
                        'type' => 'success',
                        'msg' => 'Request proccessed successfully!'
                    );
      }
      return Response::json($response);
    }

    public function acceptNetwork(Request $request)
    {
      $status = $this->network->acceptNetwork($request->id);
      if(!$status) {
        $response = array(
                        'type' => 'danger',
                        'msg' => 'Some error occurred while processing your request. Please try again later.',
                    );
      }else {
        $response = array(
                        'type' => 'success',
                        'msg' => 'Contact Added to Your Network!'
                    );
      }
      return Response::json($response);
    }

    public function getMyNetwork()
    {
      $mynetwork = $this->network->getUserNetwork(Auth::user()->id);
      return view('network.mynetwork', ['mynetwork'=>$mynetwork, 'pageTitle' => "Network"]);
    }

    public function pendingNetworkInvitation()
    {
      return view('network.pendingInvitation', ['pageTitle' => "Pending Invitations"]);
    }

    public function getNetworkRequestReceivedAjax()
    {
      $mynetwork = $this->network->getNetworkRequestReceived(Auth::user()->id);
      if(count($mynetwork) > 0) {
        $html = '<ul class="network-list">';
        foreach($mynetwork as $network) {
          $html .= '<a href="/network/viewprofile/'.$network['user']['id'].'" data-toggle="modal" data-target="#profiledetail_modal" title="Click here to view full profile"><li id="invitation_'.$network['id'].'" class="networkblock">
                      <div class="network-img">';
          if($network['user']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$network['user']['profile_pic']))
              $html .= '<img src="'.config('constants.USER_IMAGE_THUMB').$network['user']['profile_pic'].'" height="72" width="66" style="height:350px;" />';
          else
            $html .= '<img src="'.config('constants.FRONT_IMAGE').'user.png" height="72" width="66" style="height:350px;" />';

          $html .= '<a href="janascript:void(0)" class="remove-network removeNetwork" title="Ignore Invitation" onclick="return removeNetwork(this);">'
                  .'<img src="'.config('constants.FRONT_IMAGE').'no-friend.png" alt="Ignore Invitation" width="30" height="30"/>'
                  .'</a>'
                  .'</div>'
                  .'<div class="network-name">'
                  .'<a href="janascript:void(0)" class="remove-network acceptNetwork" title="Accept Invitation" onclick="return acceptNetwork(this);">'
                  .'<img src="'.config('constants.FRONT_IMAGE').'add-friend.png" alt="Accept Invitation" width="30" height="30"/>'
                  .'</a>'
                  .'<p>'. ucfirst($network['user']['firstname']) .' '. ucfirst($network['user']['lastname']).'</p>'
                  .'</div>'
                  .'</li></a>';
        }
        $html .= '</ul>';
      }
      else {
        $html = "No Invitation Found";
      }
      echo $html;
    }

    public function getNetworkRequestSentAjax()
    {
      $mynetwork = $this->network->getNetworkRequestSent(Auth::user()->id);
      if(count($mynetwork) > 0) {
        $html = '<ul class="network-list">';
        foreach($mynetwork as $network) {
          $html .= '<a href="/network/viewprofile/'.$network['friendinfo']['id'].'" data-toggle="modal" data-target="#profiledetail_modal" title="Click here to view full profile"><li id="invitation_'.$network['id'].'" class="networkblock">
                      <div class="network-img">';
          if($network['friendinfo']['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$network['friendinfo']['profile_pic']))
              $html .= '<img src="'.config('constants.USER_IMAGE_THUMB').$network['friendinfo']['profile_pic'].'" height="72" width="66" style="height:350px;" />';
          else
            $html .= '<img src="'.config('constants.FRONT_IMAGE').'user.png" height="72" width="66" style="height:350px;" />';

          $html .= '<a href="javascript:void(0)" class="remove-network removeNetwork" title="Withdraw Invitation" onclick="return removeNetwork(this);">'
                  .' <img src="'.config('constants.FRONT_IMAGE').'no-friend.png" alt="Withdraw Invitation" width="30" height="30"/></a>'
                  .'</div>'
                  .'<div class="network-name">'
                  .'<p>'. ucfirst($network['friendinfo']['firstname']) .' '. ucfirst($network['friendinfo']['lastname']).'</p>'
                  .'</div>'
                  .'</li></a>';
        }
        $html .= '</ul>';
      }
      else {
        $html = "No Invitation Found";
      }
      echo $html;
    }

    public function networkViewProfile($user_id)
    {

      $user = $this->users->findById($user_id);

      if($user->role === 'customer'){
        
        $view = "network.viewprofile";

        $UserProfileDetail = User::with('customerDetail')->with(['follows' => function ($q) use($user_id) {
            $q->where('user_id', '=', Auth::User()->id);
            $q->where('follower_id', '=', $user_id);
        }])->where('id', $user_id)->first();

      } else if($user->role === 'business'){

        $UserProfileDetail = $this->users->getUserProfileDetail($user_id);
        
        if(isset($UserProfileDetail['ProfessionalDetail']) && count($UserProfileDetail['ProfessionalDetail']) > 0){
            $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
        }

        $view = "network.viewbusinessprofile";
      }

      $sports_names = $this->sports->getAllSportsNames();
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

      return view($view, [
            'UserProfileDetail' => $UserProfileDetail,
            'sports_names' => $sports_names,
            'serviceType' => $serviceType,
            'programType' => $programType,
            'programFor' => $programFor,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration'=> $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'profile' => $UserProfileDetail['role']
      ]);
    }

    public function userFollow(Request $request)
    {
        $request = $request->all();

        if( isset($request) && isset($request['users']) ){

          $status = UserFollower::checkUserFollow($request['users']['id'], $request['users']['follow_id']);
          
          if(count($status) > 0){
            $status = UserFollower::unFollowUser($request['users']['id'], $request['users']['follow_id'] );


          } else {
            $status = UserFollower::AddUserFollow($request['users']['id'], $request['users']['follow_id']);
          }

          return Response::json($status);

        } else {

            $status = array(
                'type' => 'danger',
                'msg' => 'Selected user not found',
            );

            return Response::json($status);
        }
    }

    public function Followers()
    {

      $followers = $this->network->getUserFollowers(Auth::user()->id);
      return view('network.follow', ['followers'=>$followers, 'pageTitle' => "Followers"]);
    }

    public function usereFollowers()
    {

      $followers = $this->network->getUserFollowers(Auth::user()->id);
      return view('network.followers', ['followers'=>$followers, 'pageTitle' => "Followers"]);
    }

    public function usereFolloweings()
    {

      $followers = $this->network->getUserFollowings(Auth::user()->id);
      return view('network.followings', ['followers'=>$followers, 'pageTitle' => "Followings"]);
    }
    

    
}