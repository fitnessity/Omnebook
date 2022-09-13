<?php

namespace App\Repositories;

use App\SportsCategories;
use DB;
use Auth;

class SportsCategoriesRepository
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
        $this->model = new SportsCategories();
    }

    public function getAllSportsCategories()
    {   
        return SportsCategories::where('is_deleted','0')->get();
    }

}