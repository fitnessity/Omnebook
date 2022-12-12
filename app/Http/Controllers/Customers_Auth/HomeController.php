<?php

namespace App\Http\Controllers\Customers_Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;
use Redirect;
use Response;
use App\Api;
use Str;
use App\MailService;
use DB;

use App\Repositories\CustomerRepository;

class HomeController extends Controller
{

	/**
     * The user repository instance.
     *
     * @var CustomerRepository
     */
    protected $customers;
	public function __construct(CustomerRepository $users) {

        $this->customers = $customers;
    }

	public function index(){
        return view('customers.index');
    }
}