<?php



namespace App;



use App\User;

use App\Sports;

use Illuminate\Database\Eloquent\Model;



class UserService extends Model

{

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public $timestamps = false;
    protected $fillable = ["user_id","serv_time_slot","sport","title","price","servicedesc","servicetype","programtype","agerange","programfor","numberofpeople","experience_level","servicelocation","focuses","specialdeals","servicepriceoption","duration","image","terms_conditions","expire_days","expire_in_option","expire_in_option2","sessions","multiple_count","recurring_pay","introoffer","runautopay","often","often_every_op1","often_every_op2","numberofpays","chargeclients","termcondfaq","contractterms","contracttermstext","liability","liabilitytext","setupprice","offerpro_states","activitydesignsfor","activitytype","frm_teachingstyle","salestax","salestaxpercentage","duestax","duestaxpercentage"];


    /**

     * Get the user that owns the task.

     */

    public function user()

    {

        return $this->belongsTo(User::class);

    }

}

