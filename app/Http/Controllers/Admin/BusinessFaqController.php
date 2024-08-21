<?php
namespace App\Http\Controllers\Admin;
use App\User;
use Validator;
use App\Fit_vetted_business_faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


Class  BusinessFaqController extends Controller{

    public  $list = array('Knowledge based'=>'Knowledge based','Support forum'=>'Support forum','News 24x7'=>'News 24x7');
    public function __construct()
    {
        $this->middleware('admin');
       
    }

    public function index(){
        $quansw = Fit_vetted_business_faq::paginate(20);
        
        return view('admin.vatted_business_faq.index', [
            'pageTitle' => "Vetted Business FAQ List",
            'help' =>$quansw,
            'breadcrumbs'=>'Manage Vetted Business FAQ',
        ]);
    }
    public function create(){
        return view('admin.vatted_business_faq.create', [
            'pageTitle' => "Add New",
            'list'=>$this->list,
            'breadcrumbs'=>'Manage Vetted Business FAQ',
        ]);
    }

    public function view($id){
        $data = Fit_vetted_business_faq::find($id);
        return view('admin.vatted_business_faq.edit', [
            'pageTitle' => "Edit Question",
            'help'=>$data,
            'list'=>$this->list,
            'breadcrumbs'=>'Manage Vetted Business FAQ',
        ]);
    }

    public function store(Request $r){
            $value= $r->input();
            $value = array('answer'=>$r->answer_content,'qustion'=>$r->question);
            $save = Fit_vetted_business_faq::create($value);
            if($save){
                session(['key' => 'success']);
                session(['msg' => 'Created Succesfully !']); 
            return redirect('admin/vatted_business_faq');
            }
    }

    public function update(Request $r){
        $value = array('answer'=>$r->answer_content,'qustion'=>$r->question);
        $save = Fit_vetted_business_faq::where('id',$r->id)->update($value);
        if($save){
            session(['key' => 'success']);
            session(['msg' => 'Update Succesfully !']); 
        return redirect('admin/vatted_business_faq');
        }
    }

        public function delete($id){
            $save = Fit_vetted_business_faq::where('id',$id)->delete();
            if($save){
                session(['key' => 'success']);
                session(['msg' => 'Delete Succesfully !']); 
            return redirect('admin/vatted_business_faq');
            }
}
}