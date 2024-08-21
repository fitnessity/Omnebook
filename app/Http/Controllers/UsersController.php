<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ProfileFollow;
use App\ProfileFav;
use App\InquiryBox;
use App\ProfileView;
use App\PostLike;
use App\PostReport;
use App\PostComment;
use App\PostCommentLike;
use App\PagePost;

class UsersController extends Controller
{
    /**
     * Display a list of all of the user's page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('users.profile');
    }

    public function profile(Request $request)
    {
        return view('users.profile');
    }
	
}