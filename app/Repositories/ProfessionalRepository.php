<?php

namespace App\Repositories;

use App\User;
use App\UserBookingStatus;
use DB;
use Auth;

class ProfessionalRepository
{   
    /**
     * Professional Model
     * 
     * @var object
     */
    public $model;
    protected $professional_booked;

    /**
     * Construct
     * 
     */
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * Get All Plans
     * @return array
     */
    public function getAllProfessionals()
    {   
        return $this->model->with(['ProfessionalDetail'])->where(['role' => 'professional'])->get();
    }

    /**
     * Get All Business Users
     * @return array
     */
    public function getAllBusinessUsers()
    {   
        return $this->model->with(['ProfessionalDetail'])->where(['role' => 'business'])->get();
    }

    

    /**
     * Create
     * 
     * @param array $data 
     * @return boolean
     */
    public function create($data = array())
    {
        if(is_array($data) && count($data))
        {
            return $this->model->create($data);
        }

        return false;
    }

    /**
     * Get By Id
     * @param int $id
     * @return bool
     */
    public function getById($id = null)
    {
        if($id)
        {
            return $this->model->with(['ProfessionalDetail', 'employmenthistory', 'education', 'certification', 'service'])->find($id);
        }

        return false;
    }

    /**
     * Update
     * @param int $id  
     * @param array $data
     * @return bool
     */
    public function update($id = null, $data = array())
    {
        if($id && is_array($data) && count($data))
        {
            $model = $this->model->find($id);

            return $model->update($data);
        }

        return false;
    }

    /**
     * DeleteItem
     * @param int $id
     * @return bool
     */
    public function deleteItem($id = null)
    {
        if($id)
        {
            $model = $this->model->find($id);

            if($model)
            {
                return $model->delete();
            }
        }

        return false;
    }

    /**
     * Rreject Professional
     * 
     * @param int $userId
     * @param  string $rejectionReason
     * @return boolean
     */
    public function rejectProfessional($userId = null, $rejectionReason = '')
    {
        if($userId)
        {
            $user = $this->model->find($userId);

            $user->status = 'rejected';
            $user->rejected_reason = $rejectionReason;

            return $user->save();
        }

        return false;
    }

      public function getTopBookedProfessionals($flag,$state=null)
    {   
        $arg = array('topprof'=>'user_booking_status.business_id',
        'PRO'=> 'user_booking_status.user_id',
        'CLA'=> 'user_booking_status.business_id',
        'ADV'=> 'user_booking_status.user_id',
        'PROG'=> "users.id",
        'Testi'=> "users.firstname",
        );
        $flg_q = $arg[$flag];
        $ip = $_SERVER['REMOTE_ADDR'];
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
        $statecode = DB::table('addr_states')->select('id')->where('state_name','New york')->get();
           
return  User::select('users.id','users.firstname','users.lastname','users.city','users.state','users.country','users.zipcode','users.profile_pic',DB::raw('COUNT(user_booking_status.business_id) as bookingcount'),DB::raw('group_concat(distinct(CONCAT(UCASE(LEFT(service.sport, 1)), SUBSTRING(service.sport, 2)))) as user_sports'),DB::raw('group_concat(distinct(CONCAT(UCASE(LEFT(certifications.title, 1)), SUBSTRING(certifications.title, 2)))) as user_certification'),DB::raw('COUNT(user_follower.user_id) as followercount'))
->join('user_booking_status','user_booking_status.business_id','=','users.id')
->join("user_services as service", DB::raw('service.user_id'), '=', 'users.id')
->leftJoin("user_certifications as certifications",DB::raw("certifications.user_id"),"=","users.id")
->leftJoin('user_follower','user_follower.user_id','=','users.id')
->where('user_booking_status.status','confirmed')
->where('users.is_deleted', '0')
//->where('users.state', $statecode[0]->id)
->where('users.role', 'business')
->where('users.activated', 1)
->with('states')
->groupby($flg_q)
->orderby('bookingcount','DESC')
->get();

    }
}