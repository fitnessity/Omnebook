<?php

namespace App\Repositories;

use App\Cms;
use DB;
use Auth;

class CmsRepository
{

    public function getAllCmsModules()
    {   
        return Cms::select('id','content_title','banner_image','video')
                  ->where('status', 1)->get();
    }

    public function getCmsModule($id = NULL)
    {   
        $cms_module = Cms::select('content','content_title','banner_image','video')
                    ->where('id', $id);

        return $cms_module->where('status', 1)->first();
    }

    public function storeCmsModule($id,$content = NULL,$title = NULL,$banner_image = NULL,$video = NULL,$address = NULL,$email = NULL)
    {  
        $obj = Cms::find($id);
        $obj->content = $content;
        $obj->content_title = $title;
        $obj->video = $video;
        if(isset($banner_image) && $banner_image != '')
            $obj->banner_image = $banner_image;
		$obj->address = $address;
		$obj->email = $email;
        return $obj->save();
    }

    public function getPageContent($content_alias)
    {
        return Cms::select('content','content_title','banner_image','video')->where('content_alias', $content_alias)->first();
    }
}