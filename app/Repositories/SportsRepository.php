<?php

namespace App\Repositories;

use App\Sports;
use DB;
use Auth;
use App\UserBookingDetail;

class SportsRepository
{

    /**
     * Sports Model
     * 
     * @var object
     */
    public $model;

    /**
     * Construct
     * 
     */
    public function __construct()
    {
        $this->model = new Sports();
    }

    //Sports with categories
    public function getAllSports()
    {   
        
       return DB::select("select sports1.* from (select *,if(parent_sport_id is null,id,parent_sport_id) as sports_group from sports ) as sports1 
          left join sports as sports2 on sports2.id = sports1.sports_group
          order by sports2.sport_name,parent_sport_id,sports1.sport_name");
        
    }

    //Sports Name (Id => Name)
    public function getAllSportsNames($show_deleted_sports = 0)
    {   
      if($show_deleted_sports == 0)
        $all_sports = Sports::orderBy('sport_name')->where('is_deleted','0')->get();
      else
        $all_sports = Sports::orderBy('sport_name')->get();

        $sports_arr = array();
        foreach ($all_sports as $key => $value) {
            $sports_arr[$value->id] = $value->sport_name;
        }
        return $sports_arr;
    }

    //Sports Names (Alphabets Wise)
    public function getAlphabetsWiseSportsNames()
    {   
       $all_sports = Sports::orderBy('sport_name')->where('is_deleted','0')->get();
        $sports_arr = array();
        //
        $sports = array();

        foreach ($all_sports as $key => $value) {
            
            if($value->parent_sport_id > 0){
              $sports_arr[$value->parent_sport_id]['child'][$value->id] = $value->sport_name;
            } else {
              $sports_arr[$value->id]['name'] = $value->sport_name;
            }
        }

        /*if($sports_arr){
          foreach($sports_arr as $key=>$data) 
          {
          //print_r($data['name']);
            if(!isset($sports[substr(ucfirst($data['name']), 0, 1)]))
            {
              $sports[substr($data['name'], 0, 1)] = array();
            }
            $sports[substr(ucfirst($data['name']), 0, 1)][]= (object) array('value' => $key,'title' => $data['name'],'child' => @$data['child']?$data['child']:array());
          }
            //exit;
        }*/

        //sort by alphabet
        ksort($sports); 
        //$sports = array('1','2');
        return $sports;
    }
    public function getAjaxHappeningByFlag($flag)
    {
      echo $flag; die();
        // if($flag == 'most'){
        // }
    }

    //Get Sports From Category Id
    public function getSportsFromCatId($cat_id)
    {   
       if($cat_id == 'most'){

            // $return = UserBookingDetail::leftjoin("sports as sp", DB::raw('sp.id'), '=', 'user_booking_details.sport')
            //     ->leftjoin("sports as sports1", function($query){                    
            //         $query->on(DB::raw('sports1.id'),'=', DB::raw('(select sports2.parent_sport_id from sports as sports2 where sp.id = sports2.parent_sport_id limit 1)'));
            //         $query->where('sports1.is_deleted', '=', 0);
            //         })
            //     ->where('sp.is_deleted',0)
            //     ->where('sp.parent_sport_id',NULL)
            //     ->groupBy('sport1')
            //     ->orderBy('total_booked', 'desc')
            //     ->limit(3);
            
            // return $return->get(['sport','sp.sport_name','sp.image', DB::raw('COUNT(sport) as total_booked'), DB::raw('IF(min(sports1.id) > 0,1,0) as has_child')]);
          

          $return = Sports::select('sports.id as sport','sport_name','image',DB::raw('(select COUNT(subSport.id) from sports as subSport where parent_sport_id = sports.id) as has_child'),
                                DB::raw('COUNT(user_booking_details.sport) as total_booked'))
                          ->join('user_booking_details','user_booking_details.sport','=','sports.id')
                          ->where('sports.is_deleted', 0)
                          ->groupBy('sports.id')
                          ->orderBy('total_booked', 'desc')
                          ->get();
          return $return;

       } else if($cat_id == 'all'){
            $return = Sports::select(DB::raw('sports.*'),DB::raw('sports_categories.category_name'),DB::raw('IF((select count(*) from sports as sports1 where sports1.is_deleted = "0" AND sports1.parent_sport_id = sports.id ) > 0,1,0) as has_child'))
                  ->leftjoin("sports_categories", DB::raw('sports.category_id'), '=', 'sports_categories.id');
            $return->where('sports.is_deleted','0');
            $return->where('sports.parent_sport_id',NULL);
            $return->groupBy('sports.id');
            $return->orderBy('sports.sport_name');
            return $return->get();
       } else {
            $return = Sports::select(DB::raw('sports.*'),DB::raw('sports_categories.category_name'),DB::raw('IF((select count(*) from sports as sports1 where sports1.is_deleted = "0" AND sports1.parent_sport_id = sports.id ) > 0,1,0) as has_child'))
                  ->leftjoin("sports_categories", DB::raw('sports.category_id'), '=', 'sports_categories.id')
                  ->where('sports.parent_sport_id',NULL)
                  ->where('sports.is_deleted','0')
                  // ->where('sports_categories.id',$cat_id)
                  ->whereRaw("FIND_IN_SET($cat_id,sports.category_id)")
                  ->groupBy('sports.id')
                  ->orderBy('sports.sport_name');
            return $return->get();
       }
    }

    public function getSportDetail($id)
    {   
        if($id > 0){
            return Sports::where('id',$id)->get();
        } else {
            return NULL;
        }
    }

    //Get parent sports list
    public function getParentSportsList($exclude_sport = NULL)
    {   
        $return = Sports::where('is_deleted','0');
        if($exclude_sport) $return->where('id', '!=', $exclude_sport);
        $return->where('parent_sport_id', '=', NULL);
        $return->orWhere('parent_sport_id', '=', "''");
        $return->orderBy('sport_name');
        return $return->get();
    }

    //Get child sports list
    public function getChildSportsList($parent_sport_id)
    {   
      if($parent_sport_id){
        $return = Sports::where('is_deleted','0')
          ->where('parent_sport_id', '=', $parent_sport_id)
          ->orderBy('sport_name');
        return $return->get();
      } else return NULL;
    }

    //Get sports child-parent
    public function getSportsChildParentWise()
    {   
      $sports = Sports::where('is_deleted','0')
        ->whereNotNull('parent_sport_id');
      $result = $sports->get(['id','parent_sport_id']);
      $sports = array();   
      if($result){
        foreach ($result as $key => $value) {
             $sports[$value['id']] = $value['parent_sport_id']; 
        }
      }
      return $sports;
    }

    //Check sport is parent or not 
    public function checkIsParentSport($sports_id)
    {
        if($sports_id > 0){
            $count = Sports::where('parent_sport_id','=',$sports_id)->where('is_deleted','=',0)->count();
            if($count > 0) return 1; else return 0;
        } else return 0;
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

            return  $model->update($data);
        }

        return false;
    }

}