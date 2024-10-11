<?php

namespace App;



use App\{User,SGMailService};
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class ExcelUploadTracker extends Model

{

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */
    use SoftDeletes;
    protected $table = 'excel_upload_tracker';
    public $timestamps = true;
	protected $fillable = ['user_id','business_id','excel_file_name','status'];

}

