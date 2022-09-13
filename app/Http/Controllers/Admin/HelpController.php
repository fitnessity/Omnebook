<?php
namespace App\Http\Controllers\Admin;
use App\User;
use Validator;
use App\Fit_Help;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


Class  HelpController extends Controller{

    public  $list = array('Latest Knowledge based'=>'Latest Knowledge based','Latest Support forum'=>'Latest Support forum','Latest News 24x7'=>'Latest News 24x7');
    public function __construct()
    {
        $this->middleware('admin');
       
    }
    
    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('images'), $fileName);
   
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('public/images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function index(){
        $quansw = Fit_Help::paginate(20);
        
        return view('admin.helpdesk.index', [
            'pageTitle' => "Help Desk List",
            'help' =>$quansw,
            'breadcrumbs'=>'Manage Help Center',
        ]);
    }
    public function create(){
        return view('admin.helpdesk.create', [
            'pageTitle' => "Add New",
            'list'=>$this->list,
            'breadcrumbs'=>'Manage Help Center',
        ]);
    }

    public function view($id){
        $data = Fit_Help::find($id);
        return view('admin.helpdesk.edit', [
            'pageTitle' => "Edit Question",
            'help'=>$data,
            'list'=>$this->list,
            'breadcrumbs'=>'Manage Help Center',
        ]);
    }

    public function store(Request $r){
            $value= $r->input();
            $value = array('cat_name'=>$r->cat_name,'answer'=>$r->answer_content,'qustion'=>$r->question);
            $save = Fit_Help::create($value);
            if($save){
                session(['key' => 'success']);
                session(['msg' => 'Created Succesfully !']); 
            return redirect('admin/helpdesk');
            }
    }

    public function update(Request $r){
        $value = array('cat_name'=>$r->cat_name,'answer'=>$r->answer_content,'qustion'=>$r->question);
        $save = Fit_Help::where('id',$r->id)->update($value);
        if($save){
            session(['key' => 'success']);
            session(['msg' => 'Update Succesfully !']); 
        return redirect('admin/helpdesk');
        }
    }

        public function delete($id){
            $save = Fit_Help::where('id',$id)->delete();
            if($save){
                session(['key' => 'success']);
                session(['msg' => 'Delete Succesfully !']); 
            return redirect('admin/helpdesk');
            }
}
}