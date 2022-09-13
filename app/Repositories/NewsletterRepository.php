<?php

namespace App\Repositories;

use App\Newsletter;
use DB;
use Auth;

class NewsletterRepository
{   
    /**
     * Newsletter Model
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
        $this->model = new Newsletter();
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

    public function getByEmail($email = null)
    {
        if($email)
        {
            return $this->model->where('email',$email)->first();
        }

        return false;
    }

    public function getAllNewsletterModules()
    {   
       return $this->model->select('id','name','email')->get();
    }

    /**
     * Get By Id
     * @param int $id
     * @return bool
     */
    // public function getById($id = null)
    // {
    //     if($id)
    //     {
    //         return $this->model->find($id);
    //     }

    //     return false;
    // }

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
    public function deleteNewsletter($id = null)
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

    // public function deleteMultiplePlans($planIds = array())
    // {
    //     return $this->model->whereIn('id', $planIds)->delete();
    // }
}