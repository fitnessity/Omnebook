<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\ProfessionalRepository;
use App\Repositories\SportsRepository;
use App\Miscellaneous;
use App\User;
use Auth;
use Redirect;
use Response;
use DB;
use Validator;
use Image;
use App\UserProfessionalDetail;
use App\MailService;

class AdminBusinessController extends Controller
{   
    protected $professionals;
    protected $sports;

    public function __construct(ProfessionalRepository $professionals, SportsRepository $sports)
    {
        $this->middleware('admin');
        $this->professionals = $professionals;   
        $this->sports = $sports; 
    }

    public function index()
    {
        $businessType = Miscellaneous::businessType();
        //$professionals = $this->professionals->getAllProfessionals();
        $businessUsers = $this->professionals->getAllBusinessUsers();

        return view('admin.businessusers.index', [
            'pageTitle'     => 'Manage Business User',
            'professionals' => $businessUsers,
            'businessType' => $businessType
        ]);
    }

    public function view($id)
    {
        $professional = $this->professionals->getById($id);
        $sports_names = $this->sports->getAllSportsNames();

        if(isset($professional['ProfessionalDetail']) && @count($professional['ProfessionalDetail']) > 0){
          $professional['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($professional['ProfessionalDetail']);
        }

        return view('admin.businessusers.view', [
            'pageTitle'     => 'View Business User Details',
            'professional' => $professional,
            'sports_names' => $sports_names
        ]);
    }

    /**
     * Reject Professional
     * 
     * @param Request $request
     * @return string
     */
    public function rejectProfessional(Request $request)
    {
        $input = $request->all();

        if(is_array($input) && isset($input['professionalId']))
        {
            $status = $this->professionals->rejectProfessional($input['professionalId'], $input['userReason']);
            
            if($status)
            {   
                $mail_data = array();
                $mail_data['rejectedReason'] = $input['userReason'];
                $mail_data['professionalDetail'] = $this->professionals->getById($input['professionalId']);
                MailService::sendEmailProfileRejected($mail_data);

                return json_encode([
                    'status' => true
                ]);
            }
        }
        
        return json_encode([
            'status' => false
        ]);
    }

    public function Approve(Request $request)
    {
        if($request->singleProfessional && $request->singleProfessional == true)
        {
            $request->professionalIds = (array)$request->professionalIds;
        }
        
        if(!isset($request->professionalIds) || count($request->professionalIds) == 0) {
            return json_encode([
                'status' => false
            ]);
        }
        $status = User::whereIn('id', $request->professionalIds)
                        ->update([
                            'status' => 'approved',
                            'is_firstlogin_after_approve' => '1'
                        ]);
        if($status)
        {   
            foreach ($request->professionalIds as $key => $value) {
                $professional = $this->professionals->getById($value);
                MailService::sendEmailProfileApproved($professional);
            }

            return json_encode([
                'status' => true
            ]);
        }
        
        return json_encode([
            'status' => false
        ]);
    }

    public function deleteAll(Request $request){
        $input = $request->all();
        
        if(isset($request->professionalIds) && @count($request->professionalIds) > 0) {

            $update = User::whereIn('id', $input['professionalIds'])
                     ->update([
                        'is_deleted' => 1
                    ]);

            if(!$update) {
                return json_encode([
                    'status' => false
                ]);
            } else {
                return json_encode([
                    'status' => true
                ]);
            }

        } else {
            return json_encode([
                    'status' => false
                ]);
        }
    }

    public function postProfessionals(Request $request){
        $input = $request->all();
        
        if(count(@$input['professionalIds']) > 0 && @$input['submit_delete_professional'] == 1){

            $update = User::whereIn('id', $input['professionalIds'])
                     ->update([
                        'is_deleted' => 1
                    ]);

            if(!$update) {
                $response = array(
                        'danger' => 'Some error while deleting Business User.',
                );
            } else {
                $response = array(
                    'success' =>  'Business User successfully deleted.',
                );    
            }

        } else {
            $response = array(
                    'danger' =>  'Please select at least one Business User.',
            );
        }

        if(count(@$input['professionalIds']) > 0 && @$input['submit_approve_professional'] == 1){

            $update = User::whereIn('id', $input['professionalIds'])
                     ->update([
                            'status' => 'approved',
                            'is_firstlogin_after_approve' => '1'
                        ]);
                     
            if($update)
            {   
                foreach ($input['professionalIds'] as $key => $value)
                {
                    $professional = $this->professionals->getById($value);
                    MailService::sendEmailProfileApproved($professional);
                }
            }

            if(!$update) {
                $response = array(
                        'danger' => 'Some error while approving Business User.',
                );
            } else {
                $response = array(
                    'success' =>  'Approved Business User Successfully!',
                );    
            }

        } else {
            $response = array(
                    'danger' =>  'Please select at least one Business User.',
            );
        }
        return Redirect::to('/admin/professionals')->with('status',$response);
    }
}