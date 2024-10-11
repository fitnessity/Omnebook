<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\{PromoCodeRepository};
use Auth;
use Redirect;

class PromoCodesController extends Controller
{
	protected $promo_code;
    public function __construct(PromoCodeRepository $promo_code)
    {
        $this->middleware('admin');
        $this->promo_code = $promo_code;
    }

    public function index(){
        $promoCodes = $this->promo_code->getAllPromoCodes();
        return view('admin.promo_codes.index', [
            'promoCodes' => $promoCodes,
            'pageTitle' => 'Manage Promo Codes'
        ]);
    }

    public function create(){
        return view('admin.promo_codes.create', [       
            'pageTitle' => 'Add New Promo Code'
        ]);
    }

    public function edit($id){
        $promoCode = $this->promo_code->getById($id);
        if($promoCode){
            return view('admin.promo_codes.edit', [
                'pageTitle' => 'Edit Promo Code',
                'promoCode' => $promoCode,
            ]);
        }
        return redirect()->route('promo_codes.index');   
    }

    public function store(Request $request)
    {
        $promoCode = $this->promo_code->create([
            'title' => $request->title,
            'code' => $request->code,
            'status' => $request->status,
            'price_in' => $request->price_in,
            'price' => $request->price,
           ]);

        if($promoCode){
            session(['key' => 'success']);
            session(['msg' => 'Promo Code Created Succesfully !']);    
        }

        return redirect()->route('promo_codes.index');
    }

    public function update($id, Request $request)
    {
        /*print_r($request->all());*/
        $status = $this->promo_code->update($id,[
           	'title' => $request->title,
            'code' => $request->code,
            'status' => $request->status, 
            'price_in' => $request->price_in,
            'price' => $request->price,]);

        if($status) {
            session(['key' => 'success']);
            session(['msg' => 'Promo Code Updated Succesfully !']);    
        }
        return redirect()->route('promo_codes.index');
    }

    public function delete($id){
    	$status = $this->promo_code->delete($id);
    	if($status) {
            session(['key' => 'success']);
            session(['msg' => 'Promo Code Deleted Succesfully !']);    
        }
        return redirect()->route('promo_codes.index');
    }
}

