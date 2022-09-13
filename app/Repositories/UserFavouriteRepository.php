<?php
namespace App\Repositories;

use App\User;
use App\UserFavourite;
use DB;
use Auth;

class UserFavouriteRepository
{
    public function getUserFavourite($user_id)
    {
        $favourites =  UserFavourite::select('*')
                     ->where('user_id', $user_id)
                    // ->where(function($query) use ($user_id)
                    // {
                    //     $query->where('user_id', $user_id);
                    //     // $query->Orwhere('favourite_user_id', $user_id);
                    // })
                    ->with('favouriteinfo')
                    ->with('user')
                    ->get()->toArray();

        // echo '<pre>'; print_r($favourites); die();
        if(count($favourites) > 0) {
            foreach($favourites as $key => $network) {
                if($network['favourite_user_id'] == $user_id) {
                    $friendinfo = $network['favouriteinfo'];
                    $userinfo = $network['user'];
                    unset($favourites[$key]['favouriteinfo']);
                    unset($favourites[$key]['userinfo']);
                    $favourites[$key]['favouriteinfo'] = $userinfo;
                    $favourites[$key]['user'] = $friendinfo;
                }
            }
        }
        return $favourites;
    }
}
?>