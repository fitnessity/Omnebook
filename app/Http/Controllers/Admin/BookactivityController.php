<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\FeedbackRepository;
use App\User;
use Auth;
use Redirect;
use Response;
use DB;
use Input;
use App\Bookactivity;
use App\Miscellaneous;
use Validator;

class BookactivityController extends Controller
{   
	public function index()
    { 
        $bookactivity = Bookactivity::get();

        return view('admin.book.index', [
            'bookactivity' => $bookactivity,
            'pageTitle' => 'Manage Book an Activity'
        ]);
    }
    public function create()
    {
        return view('admin.book.create', [            
            'pageTitle' => 'Add New Book an Activity'
        ]);
    }
    public function store(Request $request)
    {

    	$validator = $this->saveValidator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        $arr = $request->all();

        $title = $arr['title'];
        
        if(@$arr['image']){
     
            if($request->hasFile('image')) {

                if (!file_exists(public_path('uploads/book/thumb'))) {
                    mkdir(public_path('uploads/book/thumb'), 0755, true);
                }

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR;


                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'668','667');

                if(@$image_upload['success'] && @$image_upload['success'] != ''){
                    $arr['image'] = @$image_upload['filename'];
                } else {
                    return redirect()->route('create-new-bookactivity')->with('status', $image_upload);
                }                
            }
        }
        
       $status = Bookactivity::create($arr);

        if($status)
        {
            session(['key' => 'success']);
            session(['msg' => 'Book an Activity Created Succesfully !']);    
        }

        return redirect()->route('bookactivity');
    }

    protected function saveValidator($data)
    {
        return Validator::make($data, [  
            'image' => 'required',          
            'title' => 'required|max:255'        
        ],
        [
            'image.required' => 'Provide a Image',
            'title.required' => 'Provide a Title'
        ]);
    }
    protected function updateValidator($data,$id)
    {
        return Validator::make($data, [            
            'image' => 'required',          
            'title' => 'required|max:255'
        ],
        [
            'image.required' => 'Provide a Image',
            'title.required' => 'Provide a Title'
        ]);
    }
    public function edit($id)
    {
        $book = Bookactivity::where('id',$id)->get();


        if($book)
        {
            return view('admin.book.edit', [
                'pageTitle' => 'Edit Book an Activity',
                'book' => $book,
                'id' => $id
            ]);
        }

        return redirect()->route('plan-list');   
    }
    public function update($id, Request $request)
    {
        $id = $id;
       
        $book = Bookactivity::where('id',$id)->first();
         
       $input = $request->all();

        $image = '';
        if($request->hasFile('image')) {

            if (!file_exists(public_path('uploads/book/thumb'))) {
                mkdir(public_path('uploads/book/thumb'), 0755, true);
            }

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('image'),$file_upload_path,1,$thumb_upload_path,'668','667');

            if(@$image_upload['success'] && @$image_upload['success'] != ''){
                $input['image'] = @$image_upload['filename'];
            } else {
                return redirect('/admin/book/edit/'.$input['id'])->with('status', $image_upload);
            }    
        }

       
        $book = DB::table('bookactivity')->where('id', $input['id'])->update($input);

        if($book)
        {
            session(['key' => 'success']);
            session(['msg' => 'Book an Activity Updated Succesfully !']);    
        }

        return redirect()->route('bookactivity');
    }
    public function delete($id)
    {
       $data = Bookactivity::where('id',$id)->first();
        $data->delete();
        return redirect()->route('bookactivity');
    }
}