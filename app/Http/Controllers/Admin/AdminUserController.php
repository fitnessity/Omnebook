<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use View;
use Validator;
use App\{User,Admin};
use Hash;
use Redirect;
use Response;
use Auth;
use App\Repositories\UserRepository;
use App\Repositories\BookingRepository;
use App\Miscellaneous;
use Image;
use App\UserCustomerDetail;
use App\InquiryBox;
use App\ContactUs;
use DB;

class AdminUserController extends Controller
{
    protected $users;
    protected $booking;

    public function __construct(UserRepository $users,BookingRepository $booking)
    {
        
        
        $this->users = $users;
        $this->middleware('admin:admin');
        $this->booking = $booking;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inquiry()
    {
        $inquiry = InquiryBox::get();
        return view('admin.inquiry', [
                'inquiry' => $inquiry,
                'pageTitle' => "Inquiry"
                ]);

    }
    public function inquirydelete($id)
    {
        $inquiry = InquiryBox::find($id)->delete();       
        return redirect()->route('inquiry');   

    }
    public function contactus()
    {
        $contact = contactus::get();
        return view('admin.contact', [
                'contact' => $contact,
                'pageTitle' => "Contact Us"
                ]);

    }
    public function contactdelete($id)
    {
        $inquiry = contactus::find($id)->delete();       
        return redirect()->route('contact-us');   

    }
    public function index()
    {    
        
        $socialMediaUsers = $this->users->getUserCount('social_media_users');
        $totalUsers = $this->users->getUserCount();
        $totalBusinessUsers = $this->users->getUserCount('business_users');
        $totalPersonalUsers = $this->users->getUserCount('personal_users');
        
        $totalApprovedProfiles = $this->users->getUserCountByStatus('approved');
        $totalPendingProfiles = $this->users->getUserCountByStatus('pending');
        $totalRejectedProfiles = $this->users->getUserCountByStatus('rejected');
        $totalActiveProfiles = $this->users->getUserCountByStatus('active');

        $latestCustomers = $this->users->getLatestUsers('customer');
        $latestProfessionals = $this->users->getLatestUsers('business');

        $totalBooking = $this->booking->getBookingCount();
        $totalConfirmedBooking = $this->booking->getBookingCount('confirmed');

      
        $totalBookedProfessional = 0;
          
        return view('admin.dashboard', [
                'socialMediaUsers' => $socialMediaUsers,
                'totalUsers' => $totalUsers,
                'totalBusinessUsers' => $totalBusinessUsers,
                'totalPersonalUsers' => $totalPersonalUsers,
                'totalApprovedProfiles' => $totalApprovedProfiles,
                'totalPendingProfiles' => $totalPendingProfiles,
                'totalRejectedProfiles' => $totalRejectedProfiles,
                'totalActiveProfiles' => $totalActiveProfiles,
                'latestCustomers' => $latestCustomers,
                'latestProfessionals' => $latestProfessionals,
                'totalBooking' => $totalBooking,
                'totalConfirmedBooking' => $totalConfirmedBooking,
                'totalBookedProfessional' => $totalBookedProfessional,
                'pageTitle' => "Dashboard"
            ]);

    }

    public function viewCustomers()
    {   
      
		$customers = User::where('is_deleted','=','0')->get();    
        return view('admin.customers.index', [
                'allCustomers' => $customers,
                'pageTitle' => "Manage Users"
                ]);

    }

    public function postCustomers(Request $request){
      
        $input = $request->all();
        $upd=0;
        if(count(@$input['customerIds']) > 0 && @$input['submit_delete_customers'] == 1){
			
			foreach($input['customerIds'] as $id)
			{
				$update = User::where('id', $id)
                     ->update([
                        'is_deleted' => '1'
                    ]);
					if($update){ $upd=1; }
			}
			
            if($upd==0) {
                $response = array(
                        'danger' => 'Some error while deleting customers.',
                );
            } else {
                $response = array(
                    'success' =>  'Customers successfully deleted.',
                );    
            }

        } else {
            $response = array(
                    'danger' =>  'Please select at least one customer.',
            );
        }
        return Redirect::to('/admin/users')->with('status',$response);
    }

    public function getCustomerDetails($id)
    {   
        $customer_details = $this->users->getCustomers($id);
        
        if(empty($customer_details)){
            $response = array(
                    'danger' =>  'Customer not found.',
            );
            return Redirect::to('/admin/users')->with('status',$response);
        }    
        return view('admin.customers.edit', [
            'customerDetails' => $customer_details,
            'countries' => $this->users->getCountriesList()->toArray(),
            'states' => $this->users->getStateList($customer_details['country'])->toArray(),
            'cities' => $this->users->getCityList($customer_details['state'])->toArray(),
            'phonecode' => Miscellaneous::getPhoneCode(),
            'pageTitle' => "Edit Customer"
        ]);
    }

    public function postCustomerDetails(Request $request)
    {
        $input = $request->all();
        $validator = $this->customerValidator($input);

        if($validator->fails()) {
          $errMsg = array();
            foreach($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = end($messages);
            }   
            $response = array(
                    'danger' =>  $errMsg,
            );
            return redirect('/admin/users/edit/'.$request->id)->with('status', $response);
        }

        $loggedinUser = Auth::user();
        
        $userObj = User::find($request->id);        
        $userObj->firstname = $request->firstname;
        $userObj->lastname = $request->lastname;
        $userObj->gender = $request->gender;
        $userObj->phone_number = $request->phone_number;
        $userObj->address = $request->address;
        $userObj->city = $request->city;
        $userObj->state = $request->state;
        $userObj->country = 'US';
        $userObj->zipcode = $request->zipcode;
        $userObj->activated = $request->activated;
        if($request->new_password){
            $userObj->password = Hash::make($request->new_password);
        }
        
        $image = new Image();
        $request->profile_pic = '';
        if($request->hasFile('profile_pic')) {

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('profile_pic'),$file_upload_path,1,$thumb_upload_path,'415','354');

            if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {
                    mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);
            }
            $thumb_upload_path150 = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR;
            
            Image::make($request->file('profile_pic'))->resize(150, 150)->save($thumb_upload_path150 . $image_upload['filename']);

            $userObj = User::find($request->id);  

            if(isset($userObj->profile_pic))
            {
                @unlink(public_path('uploads/profile_pic/thumb150'). DIRECTORY_SEPARATOR . $userObj->profile_pic);
                @unlink(public_path('uploads/profile_pic/thumb'). DIRECTORY_SEPARATOR . $userObj->profile_pic);
                @unlink(public_path('uploads/profile_pic'). DIRECTORY_SEPARATOR . $userObj->profile_pic);
            }
            $userObj->profile_pic = $image_upload['filename'];
        }

        if(!$userObj->save()) {
            $response = array(
                    'danger' => 'Some error while updating profile picture.',
            );
            return redirect('/admin/users/edit/'.$request->id)->with('status', $response);
        }else {

            if(isset($request->about_me) && $userObj->role == "customer")
            {
                $customer_detail = UserCustomerDetail::where('user_id', $request->id)->first();
                if(@count($customer_detail) > 0)       
                {
                    $customer_detail->about_me = $request->about_me;
                    $customer_detail->save();
                }
                else
                {
                    $customer_detail = UserCustomerDetail::create([
                        'user_id' => $request->id,
                        'about_me' => $request->about_me
                    ]);
                }
            }
            if(!$customer_detail->save())
            {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Some error while updating profile.',
                );
                return Response::json($response);
            }
            $response = array(
                    'success' => 'Profile updated succesfully!',
            );
            return Redirect::to('/admin/users/edit/'.$request->id)->with('status',$response);
        }
    }

    public function viewCustomerDetails($id)
    {   
        $customer_details = $this->users->getCustomers($id);
        
        if(empty($customer_details)){
            $response = array(
                    'danger' =>  'Customer not found.',
            );
            return Redirect::to('/admin/users')->with('status',$response);
        }
        
        return view('admin.customers.view', [
            'customerDetails' => $customer_details,
            'pageTitle' => "Customer Proifle"
        ]);
    }

    public function deactivateCustomer($id)
    {   
        $customer = $this->users->getCustomers($id);
        
        if(count($customer) > 0){
            
            $userObj = User::find($id);  
            $userObj->activated = 0;

            if(!$userObj->save()) {
                $response = array(
                        'danger' => 'Some error while deactivating customer.',
                );
            } else {
                $response = array(
                    'success' =>  'Customer successfully deactivated.',
                );    
            }

        } else {
            $response = array(
                    'danger' =>  'Customer not found.',
            );
        }
        return Redirect::to('/admin/users')->with('status',$response);

    }

    public function deleteCustomer($id)
    {
        $customer = $this->users->getCustomers($id);
        
        if(count($customer) > 0){
            
            $userObj = User::find($id);  
            $userObj->is_deleted = 1;
			
			
            if(!$userObj->save()) {
                $response = array(
                        'danger' => 'Some error while deleting customer.',
                );
            } else {
                $response = array(
                    'success' =>  'Customer successfully deleted.',
                );    
            }
            
        } else {
            $response = array(
                    'danger' =>  'Customer not found.',
            );
        }
        return Redirect::to('/admin/users')->with('status',$response);
    }

    protected function customerValidator($data)
    {
        return Validator::make($data, [            
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'gender' => 'required',
            'phone_number' => 'regex:/^\(?([1-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
            'address' => 'required|max:255',
            'city' => 'required|max:10',
            'state' => 'required|max:10',
            'zipcode' => 'required|integer',
            'new_password'  =>  'same:confirm_password',
            'confirm_password' =>  'same:new_password',
            'profile_pic' => 'image|mimes:jpg,png,jpeg',
            'about_me' => 'required'
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
            'about_me.required' => 'Provide about me'
        ]);
    }

    public function updatefitnessityfee(Request $request){
        User::where('id',$request->uid)->update(['fitnessity_fee'=>$request->fitness_fee, 'recurring_fee'=>$request->recurring_fee]);
    }

}