<?php

namespace App\Http\Controllers\Admin;

use App\User;

use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Input;
use Hash;
use Redirect;
use Response;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Miscellaneous;
use Image;

class AdminProfileController extends Controller
{   
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->middleware('admin');
        $this->users = $users;
    }

    /**
     * View profile. (GET)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function viewProfile()
    {
        $loggedinAdmin = Auth::user();
        
        if($loggedinAdmin->role == "admin"){

            $UserProfileDetail = $this->users->getUserProfileDetail($loggedinAdmin['id']);

            if(isset($UserProfileDetail['ProfessionalDetail']) && count($UserProfileDetail['ProfessionalDetail']) > 0){
                $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
            }
            
            return view('admin.profile.editAdminProfile', [
                'UserProfileDetail' => $UserProfileDetail,
                'countries' => $this->users->getCountriesList(),
                'states' => $this->users->getStateList($UserProfileDetail['country']),
                'cities' => $this->users->getCityList($UserProfileDetail['state']),
                'phonecode' => Miscellaneous::getPhoneCode(),
                'pageTitle' => "PROFILE"
            ]);

        } else {
             return Redirect::to('/admin');
        }
    }

    protected function editProfileDetail(Request $request)
    {
        if($_SESSION['myses']->role == "admin"){
            
            $input = $request->all();
            $validator = $this->adminDetailValidator($input);
            
        } else {
            $response = array('danger' => 'Unauthorized access.');
            return redirect('/admin/profile/editprofiledetail')->with('status', $response);
        }
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }


        $loggedinUser = $_SESSION['myses'];
        
        $userObj = User::find($loggedinUser['id']);        
        $userObj->firstname = $request->firstname;
        $userObj->lastname = $request->lastname;
        $userObj->username =  $request->username;
        $userObj->gender = $request->gender;
        $userObj->phone_number = $request->phone_number;
        $userObj->address = $request->address;
        $userObj->city = $request->city;
        $userObj->state = $request->state;
        $userObj->country = 'US';
        $userObj->zipcode = $request->zipcode;
        $userObj->intro = $request->intro;
        if($request->new_password){
            $userObj->password = Hash::make($request->new_password);
        }
        
        $image = new Image();
        $request->profile_pic = '';
        if($request->hasFile('profile_pic')) {

            $file = Input::file('profile_pic');

            $timestamp = date('YmdHis', strtotime(date('Y-M-d H:i:s')));
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $image->filePath = $name;
            $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR, $name);

            $userObj = User::find($loggedinUser['id']);        
            $userObj->profile_pic = $image->filePath;
        }

        if(!$userObj->save()) {
            $response = array(
                    'danger' => 'Some error while updating profile picture.',
            );
            return redirect('/admin/profile/editprofiledetail')->with('status', $response);
        }else {
            $response = array(
                    'success' => 'Profile updated succesfully!',
            );
            return redirect('/admin/profile/editprofiledetail')->with('status', $response);
        }
    }
    protected function adminDetailValidator($data)
    {
        return Validator::make($data, [            
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'gender' => 'required',
            'phone_number' => 'regex:/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/',
            'address' => 'required|max:255',
            'city' => 'required|max:10',
            'state' => 'required|max:10',
            'zipcode' => 'required|integer',
            'new_password'  =>  'same:confirm_password|min:8',
            'confirm_password' =>  'same:new_password|min:8',
            'profile_pic' => 'image|mimes:jpg,png,jpeg|max:1024',
        ],
        [
            'firstname.required' => 'Provide a first name',
            'lastname.required' => 'Provide a last name',
            'gender.required' => 'Select a gender',
            'address.required'  => 'Provide an address',
            'country.required'  => 'Provide a country',
            'city.required'  => 'Provide a city',
            'state.required'  => 'Provide a state',
            'zipcode.required'  => 'Provide a zipcode',
            'zipcode.integer' => 'Zipcode must be a number.',
            'phone_number' => 'Phone number format is invalid.',
            'new_password'  =>  'Password and confirm password mismatch.',
            'confirm_password'  =>  'Password and confirm password mismatch.',
            'profile_pic' => 'Please upload an only image',
        ]);
    }

}
