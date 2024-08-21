<?php
namespace App\Http\Controllers\Admin;
use App\User;
use Validator;
use App\Fit_background_check_faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


Class  CheckFaqController extends Controller{

    public  $list = array('Knowledge based'=>'Knowledge based','Support forum'=>'Support forum','News 24x7'=>'News 24x7');
    public function __construct()
    {
        $this->middleware('admin');
       
    }

    public function index(){
        $quansw = Fit_background_check_faq::paginate(20);
        
        return view('admin.background_check_faq.index', [
            'pageTitle' => "Background Check FAQ List",
            'help' =>$quansw,
            'breadcrumbs'=>'Manage Background Check FAQ',
        ]);
    }
    public function create(){
        return view('admin.background_check_faq.create', [
            'pageTitle' => "Add New",
            'list'=>$this->list,
            'breadcrumbs'=>'Manage Background Check FAQ',
        ]);
    }

    public function view($id){
        $data = Fit_background_check_faq::find($id);
        return view('admin.background_check_faq.edit', [
            'pageTitle' => "Edit Question",
            'help'=>$data,
            'list'=>$this->list,
            'breadcrumbs'=>'Manage Background Check FAQ',
        ]);
    }

    public function store(Request $r){
            $value= $r->input();
            $value = array('answer'=>$r->answer_content,'qustion'=>$r->question);
            $save = Fit_background_check_faq::create($value);
            if($save){
                session(['key' => 'success']);
                session(['msg' => 'Created Succesfully !']); 
            return redirect('admin/background_check_faq');
            }
    }

    public function update(Request $r){
        $value = array('answer'=>$r->answer_content,'qustion'=>$r->question);
        $save = Fit_background_check_faq::where('id',$r->id)->update($value);
        if($save){
            session(['key' => 'success']);
            session(['msg' => 'Update Succesfully !']); 
        return redirect('admin/background_check_faq');
        }
    }

        public function delete($id){
            $save = Fit_background_check_faq::where('id',$id)->delete();
            if($save){
                session(['key' => 'success']);
                session(['msg' => 'Delete Succesfully !']); 
            return redirect('admin/background_check_faq');
            }
}
}