<?php



namespace App;



use Illuminate\Database\Eloquent\Model;



class InstantForms extends Model

{



    /**

     * The database table used by the model.

     *

     * @var string

     */




    public $timestamps = false;

    

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

     protected $fillable = ['activity','qoutes','activity_for','language','expLevel','expActivity','expProfessional','gear','gearYes','do_activity','which_personality','gender','ageRange','participateActivity','days','time_available','medicalIssue','medicalYes','trainingLocation','StartActivity','travelUpto','zipcode'];



     

}