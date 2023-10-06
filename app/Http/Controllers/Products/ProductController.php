<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products;
use Auth;
use Redirect;

class ProductController extends Controller
{
    //
	
	public function addProduct()
	{
		return view('product.addProduct');
	}
	public function create(Request $request){
		
	}
	public function store(Request $request)
    {
		//dd('1');
		$product = [
			"user_id" => Auth::user()->id,
			"business_id" => '1',
			"description" => $request->description,
			"gallery" => '1',
			"name" => $request->pname,
			"policy_returning"=>'1',
		];
		/*$flight = products::create([
			"user_id" => Auth::user()->id,
			'name' => $request->pname,
		]);*/
		Products::create($product);
		return redirect()->back()->with('success',"Prodcut Added...");
	}
}
