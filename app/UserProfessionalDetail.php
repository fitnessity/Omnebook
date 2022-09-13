<?php



namespace App;



use App\User;

use Illuminate\Database\Eloquent\Model;

use App\ProfessionalType;

use App\Miscellaneous;



class UserProfessionalDetail extends Model

{

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public $timestamps = false;

    protected $fillable = [
        'experience_level',
'train_to', 
'personality', 
'availability', 
'languages', 
'banner_image', 
'skill_lavel', 
'medical_states', 
'medical_type', 
'work_locations', 
'goals_states', 
'goals_option', 
'hours', 
'timezone',
'special_days_off',
'notice_each_book',
'advance_book',
'willing_to_travel',
'travel_miles',
'travel_times',
'id',
    ];

    protected $appends = ['professional_type'];





    /**

     * Get the user that owns the task.

     */

    public function user()

    {

        return $this->belongsTo(User::class);

    }



    function getProfessionalTypeAttribute() {

        

        $business_type = UserProfessionalDetail::select('professional_type.type')

                        ->join('professional_type', 'professional_type.id', '=', 'user_professional_details.professional_type_id')

                        ->where('user_professional_details.professional_type_id', $this->professional_type_id)

                        ->first();



        return $business_type['type'];

    }



    public static function getFormedProfile($profile){

        

        if(isset($profile->experience_level)){

            $profile->experience_level = Miscellaneous::getBusinessProfileAnswers($profile->experience_level);

        }



        if(isset($profile->train_to)){

            $train = explode(',',$profile->train_to);

            $str = "";

            if(count($train) > 0 ){

                foreach($train as $tran){

                    if($str == ""){

                        $str .= Miscellaneous::getBusinessProfileAnswers($tran);

                    } else {

                        $str .= ', '.Miscellaneous::getBusinessProfileAnswers($tran);

                    }

                }

            }

            $profile->train_to = $str;

        }



        if(isset($profile->personality)){

            $personality = explode(',',$profile->personality);

            $str = "";

            if(count($personality) > 0 ){

                foreach($personality as $pers){

                    if($str == ""){

                        $str .= Miscellaneous::getBusinessProfileAnswers($pers);

                    } else {

                        $str .= ', '.Miscellaneous::getBusinessProfileAnswers($pers);

                    }

                }

            }

            $profile->personality = $str;

        }



        if(isset($profile->travel_times)){

            $traveltimes = explode(',',$profile->travel_times);

            $str = "";

            if(count($traveltimes) > 0 ){

                foreach($traveltimes as $trav){

                    if($str == ""){

                        $str .= Miscellaneous::getBusinessProfileAnswers($trav);

                    } else {

                        $str .= ', '.Miscellaneous::getBusinessProfileAnswers($trav);

                    }

                }

            }

            $profile->travel_times = $str;

        }



        if(isset($profile->availability)){

            $availability = explode(',',$profile->availability);

            $str = "";

            if(count($availability) > 0 ){

                foreach($availability as $avb){

                    if($str == ""){

                        $str .= ucfirst($avb);

                    } else {

                        $str .= ', '.ucfirst($avb);

                    }

                }

            }

            $profile->availability = $str;

        }



        if(isset($profile->languages)){

            $languages = explode(',',$profile->languages);

            $str = "";

            if(count($languages) > 0 ){

                foreach($languages as $lang){

                    if($str == ""){

                        $str .= ucfirst($lang);

                    } else {

                        $str .= ', '.ucfirst($lang);

                    }

                }

            }

            $profile->languages = $str;

        }



        return $profile;



    }



}

