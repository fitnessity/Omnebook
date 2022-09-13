<?php

namespace App\Repositories;

use App\User;
use App\UserNetwork;
use DB;
use Auth;
use App\MailService;
use App\UserFollower;

class NetworkRepository
{
    public function sendInvitation($mails)
    {
    	try {
            MailService::sendInvitation($mails, Auth::user());
        }
        catch (Exception $e) {
            throw new Exception("Error While sending email", 1);
        }
        return true;
    }

    public function sendFriendRequest($user_id, $friends)
    {
    	$dbArray = array();
        $index = 0;
        foreach($friends as $friend) {
        	$dbArray[$index]['user_id'] = $user_id;
        	$dbArray[$index]['friend_id'] = $friend;
        	$dbArray[$index]['status'] = 'requested';
        	$index++;
        }
        if(!UserNetwork::insert($dbArray))
        	return false;
        return true;
    }

    public function filterRegisteredContacts($contacts, $type='gmail')
    {
        // if($type == "outlook") {
        //     if(count($contacts)>0) {
        //                     foreach($contacts as $key=>$contact) {
        //                         $contacts[$key]['email'] = '';
        //                         if(isset($contact['emails']['preferred']) && $contact['emails']['preferred']!='')
        //                             $contacts[$key]['email'] = $contact['emails']['preferred'];
        //                         if(isset($contact['emails']['account']) && $contact['emails']['account']!='')
        //                             $contacts[$key]['email'] = $contact['emails']['account'];
        //                         if(isset($contact['emails']['personal']) && $contact['emails']['personal']!='')
        //                             $contacts[$key]['email'] = $contact['emails']['personal'];
        //                         if(isset($contact['emails']['business']) && $contact['emails']['business']!='')
        //                             $contacts[$key]['email'] = $contact['emails']['business'];
        //                         if(isset($contact['emails']['other']) && $contact['emails']['other']!='')
        //                             $contacts[$key]['email'] = $contact['emails']['other'];
        //                     }
        //                   }
        // }

        // $return = array();
        // $return['existingContacts'] = array();
        // $return['contacts'] = $contacts;
        // return $return;

          //get already registered contacts
        switch($type) {
            case "gmail":
                          $existingContacts = array();
                          if(count($contacts)>0) {
                            $contactEmails = array_unique(array_column($contacts, 'email'));
                            $existingContacts = $this->getRegisteredUsers($contactEmails);
                          }
                          //remove existng contacts from gmailcontact list
                          if(count($existingContacts)>0) {
                            $existingEmails = array_column($existingContacts, 'email');
                            foreach($contacts as $key=>$contact) {
                              if(in_array($contact['email'], $existingEmails))
                                  unset($contacts[$key]);
                            }
                          }
            break;

            case "outlook":

                          $existingContacts = array();
                          if(count($contacts)>0) {
                            foreach($contacts as $key=>$contact) {
                                $contacts[$key]['email'] = '';
                                if(isset($contact['emails']['preferred']) && $contact['emails']['preferred']!='')
                                    $contacts[$key]['email'] = $contact['emails']['preferred'];
                                if(isset($contact['emails']['account']) && $contact['emails']['account']!='')
                                    $contacts[$key]['email'] = $contact['emails']['account'];
                                if(isset($contact['emails']['personal']) && $contact['emails']['personal']!='')
                                    $contacts[$key]['email'] = $contact['emails']['personal'];
                                if(isset($contact['emails']['business']) && $contact['emails']['business']!='')
                                    $contacts[$key]['email'] = $contact['emails']['business'];
                                if(isset($contact['emails']['other']) && $contact['emails']['other']!='')
                                    $contacts[$key]['email'] = $contact['emails']['other'];
                            }

                            $contactEmails = array_unique(array_column($contacts, 'email'));
                            if(count($contactEmails) > 0) {
                                $contactEmails = array_unique($contactEmails);
                                $existingContacts = $this->getRegisteredUsers($contactEmails);
                            }                            
                          }
                          //remove existng contacts from contact list
                          if(count($existingContacts)>0) {
                            $existingEmails = array_column($existingContacts, 'email');
                            foreach($contacts as $key=>$contact) {
                                if(in_array($contact['email'], $existingEmails) || $contacts[$key]['email'] == '')
                                    unset($contacts[$key]);
                            }
                          }
            break;

            case "email": 
                          $existingContacts = array();
                          if(count($contacts)>0) {
                            $contacts = array_unique($contacts);
                            $pos = array_search(Auth::user()->email, $contacts);
                            if(!empty($pos)){
                                unset($contacts[$pos]);
                            }
                            $existingContacts = $this->getRegisteredUsers($contacts);
                          }
                          //remove existng contacts from contact list
                          if(count($existingContacts)>0) {
                            $existingEmails = array_column($existingContacts, 'email');
                            $contacts = array_diff($contacts, $existingEmails);
                          }

            break;
        }

        if(count($existingContacts) > 0) {
            foreach($existingContacts as $key => $existingContact) {
                if(!empty($existingContact['network_id'])) {
                    unset($existingContacts[$key]);
                }
            }
        }

        $return = array();
        $return['existingContacts'] = $existingContacts;
        $return['contacts'] = array_values($contacts);
        return $return;
    }

    public function getRegisteredUsers($emails)
    {
        $query = User::select('users.*', 'network.id as network_id')
                ->whereIN('users.email', $emails)
                ->where('users.status', 'approved');

        $query  ->leftjoin('user_networks as network', function($join)
                {
                    $join->on('network.friend_id', '=', 'users.id')
                         ->where('network.user_id', '=', Auth::user()->id);
                });

        return $query->get()->toArray();
    }

    public function getUserNetworkAll($user_id)
    {return UserNetwork::select('*')
                    ->where('user_id', $user_id)
                    ->Orwhere('friend_id', $user_id)
                    ->with('friendinfo')
                    ->with('user')
                    ->get()->toArray();
    }

    public function getUserNetwork($user_id)
    {
        $networks =  UserNetwork::select('*')
                    ->where('status', 'accepted')
                    ->where(function($query) use ($user_id)
                    {
                        $query->where('user_id', $user_id);
                        $query->Orwhere('friend_id', $user_id);
                    })
                    ->with('friendinfo')
                    ->with('user')
                    ->get()->toArray();


        if(count($networks) > 0) {
            foreach($networks as $key => $network) {
                if($network['friend_id'] === $user_id) {


                    $friendinfo = $network['friendinfo'];
                    $userinfo = $network['user'];
                    unset($networks[$key]['friendinfo']);
                    unset($networks[$key]['userinfo']);
                    $networks[$key]['friendinfo'] = $userinfo;
                    $networks[$key]['user'] = $friendinfo;
                }
            }
        }

        return $networks;
    }

    public function getNetworkRequestReceived($user_id)
    {
        $networks =  UserNetwork::select('*')
                    ->where('friend_id', $user_id)
                    ->with('user')
                    ->where('status', 'requested')
                    ->get()->toArray();
        return $networks;
    }

    public function getNetworkRequestSent($user_id)
    {
        $networks =  UserNetwork::select('*')
                    ->where('user_id', $user_id)
                    ->with('friendinfo')
                    ->where('status', 'requested')
                    ->get()->toArray();
        return $networks;
    }

    public function removeNetwork($id)
    {
        if($id)
        {
            $network = UserNetwork::find($id);
            return $network->delete();
        }
        return false;
    }

    public function acceptNetwork($id)
    {
        if($id)
        {
            $network = UserNetwork::find($id);
            $network->status = 'accepted';
            return $network->save();
        }
        return false;
    }

    public function getUserFollowers($user_id)
    {
        $users =  UserFollower::select('id','user_id','follower_id')->where('follower_id', $user_id)
        ->with(['followers' => function($q){
            $q->where('is_deleted', '0');
            $q->where('status', 'approved');
        }])->get()->toArray();

        return $users;
    }

    public function getUserFollowings($user_id)
    {
        $users =  UserFollower::select('id','user_id','follower_id')->where('user_id', $user_id)
        ->with('followings')->get()->toArray();

        return $users;
    }
}