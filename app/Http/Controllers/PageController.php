<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CmsRepository;
use Validator;
use Response;
use App\MailService;
use DB;
use App\Fit_Help;
use App\ContactUs;
class PageController extends Controller
{
	protected $cms;
	public  $list = array('Latest Knowledge based'=>'Latest Knowledge based','Latest Support forum'=>'Latest Support forum','Latest News 24x7'=>'Latest News 24x7');
	public function __construct(CmsRepository $cms)
    {
        $this->cms = $cms;
    }
    /**
     * Display a list of all of the user's page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request) {
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        return view('pages.about', [
            'pageTitle' => "ABOUT US",
            'cart' => $cart
        ]);
    }
    public function createNewBusinessProfile(Request $request) {
        die("createNewBusinessProfile");
    }

    public function GetPageAboutUs(Request $request) {
        $pageContent = $this->cms->getPageContent('about_us');
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        return view('pages.about', [
            'pageContent' => $pageContent->content,
            'pageTitle' => "ABOUT US",
            'cart' => $cart
        ]);
    }
    
    public function GetPageDiscover(Request $request)
    {
        $pageContent = $this->cms->getPageContent('discover');
        return view('pages.discover', [
            'pageContent' => $pageContent->content,
            'pageTitle' => "DISCOVER"
        ]);
    }
    
    public function GetPageBeaPart(Request $request)
    {
        $pageContent = $this->cms->getPageContent('be_a_part');
        return view('pages.be-a-part', [
            'pageContent' => $pageContent->content,
            'pageTitle' => "BE A PART"
        ]);
    }
    
    public function GetPageHireTrainer(Request $request)
    {
        $pageContent = $this->cms->getPageContent('hire_trainer');
        return view('pages.hire-trainer', [
            'pageContent' => $pageContent->content,
            'pageTitle' => "HIRE TRAINER"
        ]);
    }
    public function GetPageStore(Request $request)
    {
        return view('pages.store', [
            'pageTitle' => "STORE"
        ]);
    }
    public function GetPageJobs(Request $request) {
        return view('pages.jobs', [
            'pageTitle' => "JOBS"
        ]);
    }
    public function GetPageContactUs(Request $request) {        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        $pageContent = $this->cms->getPageContent('contact_us');
        return view('pages.contact', [
            'pageContent' => $pageContent->content,
            'pageTitle' => "CONTACT US",
            'cart' => $cart
        ]);
    }
    public function CustomerSupport(Request $request)
    {
        return view('pages.Help', [
            'pageTitle' => "Customer Support"
        ]);
    }
    public function BusinessSupport(Request $request)
    {
        return view('pages.Help', [
            'pageTitle' => "Buisness Support"
        ]);
    }
    public function helpans($id)
    {      $q = DB::table('fit_help')->where('id',$id)->get();
        return view('pages.Helpdesk', [
            'pageTitle' => "Help Dask","data"=>$q
        ]);
    }
    public function HelpCenter()
    {
        $new_list = [];
        $lists = $this->list;
        foreach($lists as $list){
            $questions = Fit_Help::where('cat_name',$list)->get();
            array_push($new_list,['name'=>$list,'questions'=>$questions]);
        }
       // print_r($new_list[0]);die;
        return view('pages.Help', [

            'pageTitle' => "Help Center",
            'lists' => $new_list,
        ]);
    }
    public function PostPageContactUs(Request $request)
    {
        $postArr = $request->all();
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ];
        $validator = Validator::make($postArr,$rules);
        if($validator->fails()) {
            $errMsg = array();
            foreach($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            return Response::json($response);
        } else {
            ContactUs::create($postArr);
            try {
                MailService::sendContactUs($postArr);
                $response = array(
                    'type' => 'success',
                    'msg' => 'Thank you for contacting Fitnessity. We will get back to you soon!'
                );
            } catch(Exception $e) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Some issue in ending email. Please try again later.'
                );
            }
           return Response::json($response);
        }
    }
    public function GetPageNetwork()
    {
        return view('pages.usernetwork', [
            'pageTitle' => "NETWORK"
        ]);
    }
    public function GetPageUserreviews()
    {
        return view('pages.userreviews', [
            'pageTitle' => "REVIEWS"
        ]);
    }
    public function GetPageUserEvents()
    {
        return view('pages.userevents', [
            'pageTitle' => "EVENTS"
        ]);
    }
    public function GetPagePopularSearch()
    {
        return view('pages.popularsearch', [
            'pageTitle' => "POPULAR SEARCH"
        ]);
    }
    public function GetPageForum()
    {
        return view('pages.forum', [
            'pageTitle' => "FORUM"
        ]);
    }
    public function GetPageNews()
    {
        return view('pages.news', [
            'pageTitle' => "NEWS"
        ]);
    }
    public function GetTermsPage()
    {
        $pageContent = $this->cms->getPageContent('terms_condition');
        return view('pages.terms', [
			'banner_image' => $pageContent->banner_image,
            'pageTitle' => $pageContent->content_title,
            'content' => preg_replace('/(^[\"\']|[\"\']$)/', '', html_entity_decode(htmlentities(stripcslashes($pageContent->content)))),
        ]);
    }
    public function GetPrivacyPage()
    {
        $pageContent = $this->cms->getPageContent('privacy_policy');
        return view('pages.privacy', [
			'banner_image' => $pageContent->banner_image,
            'pageTitle' => $pageContent->content_title,
            'content' => preg_replace('/(^[\"\']|[\"\']$)/', '', html_entity_decode(htmlentities(stripcslashes($pageContent->content)))),
        ]);
    }
    public function GetPageHowItWorksCustomer()
    {

        $pageContent = $this->cms->getPageContent('how_it_works_for_customer');
        return view('pages.howitworks_customer', [
            'pageTitle' => $pageContent->content_title,
            'content' => preg_replace('/(^[\"\']|[\"\']$)/', '', html_entity_decode(htmlentities(stripcslashes($pageContent->content)))),
        ]);
    }
    public function GetPageHowItWorksBusiness()
    {
        $pageContent = $this->cms->getPageContent('how_it_works_for_business');
        return view('pages.howitworks_business', [
            'pageTitle' => $pageContent->content_title,
            'content' => preg_replace('/(^[\"\']|[\"\']$)/', '', html_entity_decode(htmlentities(stripcslashes($pageContent->content)))),           
        ]);
    }
    public function get_qa(Request $r){
        $q = DB::table('fit_help')->select('id','qustion as label')->where('qustion','like','%'.$r->query('term').'%')->get();
        return response()->json($q);
    }
    public function getans(Request $r){
        $q = DB::table('fit_help')->where('qustion',$r->qu)->get();
        return response()->json($q);
    }
}