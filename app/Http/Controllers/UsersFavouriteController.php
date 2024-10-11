<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserFavouriteRepository;
use App\Repositories\UserRepository;
use Auth;
use App\UserFavourite;

class UsersFavouriteController extends Controller
{
    /**
     * Display a list of all of the user's page.
     *
     * @param  Request  $request
     * @return Response
     */
    protected $favourite;
    protected $users;

    public function __construct(UserFavouriteRepository $favourite, UserRepository $users)
    {
        $this->favourite = $favourite;
        $this->users = $users;
    }


    public function index(Request $request)
    {
        $myfavourites = $this->favourite->getUserFavourite(Auth::user()->id);

        return view('favourite.index',[
            'myfavourites' => $myfavourites,
            'pageTitle' => 'Favourites'
        ]);
    }

    public function isFavourite(Request $r)
    {
        $loggedId = Auth::user()->id;
        $type=$r->type;

        if($type == "favourite")
        {
             $status = UserFavourite::create([
                'user_id' => $loggedId,
                'favourite_user_id' => $r->fav_user_id
            ]);
        }
        else
        {
           $status = UserFavourite::where('user_id',$loggedId)
                                    ->where('favourite_user_id',$r->fav_user_id)
                                    ->delete();
        }

        if($status){
            $res = array(
                'data' => $type,
                'type' => 'success',
                'msg' => "".ucfirst($type).' Successfully'
            );
        }else {
            $res = array(
                'data' => $type,
                'type' => 'danger',
                'msg' => 'Selected user not found'
            );
        }

        return response()->json($res);
    }
}