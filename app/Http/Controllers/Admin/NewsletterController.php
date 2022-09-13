<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Newsletter;
use App\Repositories\NewsletterRepository;
use Validator;
use Redirect;
use Response;
use Auth;
use App\MailService;

class NewsletterController extends Controller
{
    protected $newsletter;

    public function __construct(NewsletterRepository $newsletter)
    {
        $this->middleware('admin');
        $this->newsletter = $newsletter;    
    }
    /**
     * Display a list of all of the user's page.
     *
     * @param  Request  $request
     * @return Response
     */

    public function index()
    {   
        $loggedinAdmin = Auth::user();
        
        if($loggedinAdmin->role == "admin"){
            
            $newsletterModulesList = $this->newsletter->getAllNewsletterModules();

            return view('admin.newsletter.index', [
                'newsletter_modules_list_title' => 'Newsletter',
                'newsletter_modules_list' => $newsletterModulesList,
                'pageTitle' => "Newsletters"
            ]);

        } else {
             return Redirect::to('/admin');
        }
    }

    public function postNewsletter(Request $request){
        $input = $request->all();
        
        if(count(@$input['newsletterIds']) > 0 && @$input['submit_delete_newsletter'] == 1){

            $delete = Newsletter::whereIn('id', $input['newsletterIds'])->delete();

            if(!$delete) {
                $response = array(
                        'danger' => 'Some error while deleting newsletters.',
                );
            } else {
                $response = array(
                    'success' =>  'Newsletters deleted successfully!',
                );    
            }

        } else {
            $response = array(
                    'danger' =>  'Please select at least one Newsletter.',
            );
        }
        return Redirect::to('/admin/newsletters')->with('status',$response);
    }

    public function create()
    {
        return view('admin.newsletter.sendmail', [            
            'pageTitle' => 'Send Email'
        ]);
    }

    public function store(Request $request)
    {
        
        $return = array();
        $loggedinAdmin = Auth::user();
        
            if($loggedinAdmin->role == "admin"){
            $validator = $this->mailvalidator($request->all());
            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            $data['title'] = $request->title;
            $data['content'] = $request->content;

            try {
                MailService::sendEmailNewsletter($data);
            }
            catch (Exception $e) {
                throw new Exception("Error While sending email", 1);                
            }

            $response = array(
                'success' => 'Mail has been sent to all subscribers',
            );

            return redirect()->route('newsletters-list')->with('status', $response);
        }
        else{
             return Redirect::to('/admin');
        }
        return $return;
    }

    public function saveNewsletter(Request $request)
    {
        $input = $request->all();

        $validator = $this->validator($input);
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if($input['name'] != "" && $input['email'] != "")
        {
            $data = $this->newsletter->getByEmail($input['email']);

            if(!empty($data))
            {
                echo '1';
            }
            else
            {
                $status = $this->newsletter->create($request->all());
                echo '2';
            }
        }
        else
        {
            echo "Error";
        }
    }
    
    protected function mailvalidator($data)
    {
        return Validator::make($data, [            
            'title' => 'required|max:255',
            'content' => 'required',
        ],
        [
            'title.required' => 'Provide a title',
            'content.required' => 'Provide a content'
        ]);
    }

    protected function validator($data)
    {
        return Validator::make($data, [            
            'name' => 'required|max:255',
            'email' => 'required|string|email|max:255',
        ],
        [
            'name.required' => 'Provide a title',
            'email.required' => 'Provide an email'
        ]);
    }

    public function delete(Request $request)
    {
        $status = $this->newsletter->deleteNewsletter($request->id);

        if($status)
        {
            session(['key' => 'success']);
            session(['msg' => 'Newsletter Deleted Succesfully !']);    
        }
        return redirect()->route('newsletters-list');
    }
}