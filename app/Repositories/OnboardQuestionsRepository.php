<?php

namespace App\Repositories;

use App\OnboardQuestions;
use DB;
use Auth;

class OnboardQuestionsRepository
{   
    /**
     * Plan Model
     * 
     * @var object
     */
    public $model;

    /**
     * Construct
     * 
     */
    public function __construct(){
        $this->model = new OnboardQuestions();
    }

    /**
     * Get All OnboardQuestions
     * @return array
     */
    public function getAllOnboardQuestions(){   
        return $this->model->get();
    }

    /**
     * Create
     * 
     * @param array $data 
     * @return boolean
     */
    public function create($data = array())
    {
        if(is_array($data) && count($data)){
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
        if($id){
            return $this->model->find($id);
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
    public function delete($id = null)
    {
        if($id){
            $model = $this->model->find($id);
            if($model) {
                return $model->delete();
            }
        }

        return false;
    }

    public function deleteMultipleOnboardQuestions($questionIds = array())
    {
        return $this->model->whereIn('id', $questionIds)->delete();
    }
}