<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\{Products,ProductColors,ProductBrand,ProductSize,ProductMaterial,Vender,Sports,ProductsCategory};
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use DataTables;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $business_id)
    {   
        $productCategory = ProductsCategory::orderBy('name')->get();
        $data = Products::where('business_id',$business_id)->orderBy('created_at','desc');

        if($request->term){
            $searchValues = preg_split('/\s+/', $request->term, -1, PREG_SPLIT_NO_EMPTY); 
            $products = $data->where('name', 'like', "%{$request->term}%")
                ->when($request->categoryId ,function($q) use($request){
                    $q->where('category', '!=', '')->whereRaw("FIND_IN_SET(?, category)", [$request->categoryId]);
                })->get();
            return response()->json($products);
        }

        if ($request->ajax()) {
            $data->when($request->categoryId ,function($q) use($request){
                $q->where('category', '!=', '')->whereRaw("FIND_IN_SET(?, category)", [$request->categoryId]);
            })->get();

            return DataTables::of($data)
                ->addColumn('action', function($row){
                    $btn = '<ul class="list-inline hstack gap-2 mb-0">
                                <li class="list-inline-item edit">
                                    <a onclick="EditProduct('.$row->id.')" class="font-black d-inline-block edit-item-btn">
                                        <i class="ri-pencil-fill fs-16"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-danger d-inline-block remove-item-btn" onclick="deleteProduct('.$row->id.')">
                                        <i class="ri-delete-bin-5-fill fs-16"></i>
                                    </a>
                                </li>
                            </ul>';
                        return $btn;
                })
                ->addColumn('category1', function($row){
                    $categoryString = '';

                    if($row->category != ''){
                        $categories = explode(',',$row->category);
                        foreach($categories as $c){
                            $category = ProductsCategory::find($c);
                            $categoryString .= $category->name != '' ? @$category->name.',' : '';
                        }
                    }

                    return $categoryString;   
                })->addColumn('product_image1', function($row){
                    if($row->product_image){
                        $proImg ='<img src="'.Storage::URL($row->product_image).'" alt="" class="avatar-xs rounded-circle me-2 shadow"> ';
                    }else{
                        $fc =  substr($row->name, 0, 1);
                        $proImg = '<div class="avatar-xsmall"><span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">'.$fc.'</span></div>';
                    }
                    return $proImg;
                })
                ->rawColumns(['action','product_image1','category1'])
                ->addIndexColumn()->make(true);
        }
        
        $productCount = $data->count();
        return view('business.products.index',compact('productCategory','productCount','business_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $business_id)
    {   
        $productColors = ProductColors::orderBy('name')->get();
        $productBrand = ProductBrand::orderBy('name')->get();
        $productSize = ProductSize::orderBy('name')->get();
        $productMaterial = ProductMaterial::orderBy('name')->get();
        $productCategory = ProductsCategory::orderBy('name')->get();
        $venders = Vender::orderBy('name')->get();
        $sportsData = Sports::where('is_deleted','0')->where('parent_sport_id', '=', NULL)->orWhere('parent_sport_id', '=', "''")->orderBy('sport_name')->get();

        $company = $request->current_company;
        $id = $request->id  ?? '';
        $product = $company->products()->where('id',$id)->first();

        return view('business.products.create',compact('business_id','productColors','productBrand','productSize','productMaterial','venders','sportsData','productCategory','id','product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$business_id)
    {      
        //print_r($request->all());exit;
        $companyInfo = $request->current_company;
        $id = $request->id ?? 0;
        $thisProduct = $companyInfo->products()->where('id', $id)->first(); 

        $gallaryImage ='';
        if($request->has('file')){
            for($i=0;$i<count($request->file);$i++){
                $base64File = $request->file[$i];
                $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));
                $filename = 'products/' . Str::uuid()->toString() . '.jpg';
                Storage::disk('s3')->put($filename, $fileData);
                $gallaryImage .= $filename.',';
            }
        }

        $productImage = $agreementImg ='';

        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image')->store('products');
            if(@$thisProduct->product_image){
                Storage::disk('s3')->delete(@$thisProduct->product_image);
            }
        }

        $productImage = $productImage != '' ? $productImage : @$thisProduct->product_image;

        if ($request->hasFile('agreement_img') && $request->requireID == 'yes' ) {
            $agreementImg = $request->file('agreement_img')->store('products');
            if(@$thisProduct->agreement_img){
                Storage::disk('s3')->delete(@$thisProduct->agreement_img);
            }
        }

        $agreementImg = $agreementImg != '' ? $agreementImg : @$thisProduct->agreement_img;
    
        if ($request->has('galleryfile')) {
            $imagesInString = explode(',', rtrim(@$thisProduct->gallery, ','));
            foreach ($imagesInString as $image) {
                if (in_array($image, $request->galleryfile)) {
                    $gallaryImage .= $image .',';
                }else{
                    Storage::disk('s3')->delete($image);
                }
            }
        }

        $data  = [
            'user_id' => Auth::user()->id,
            'business_id' =>$business_id,
            'name' => $request->product_name,
            'description' =>$request->description,
            'product_image' =>$productImage,
            'gallery' =>$gallaryImage,
            'product_type' =>$request->product_type,
            'sale_price' =>$request->sale_price ?? 0,
            'rental_price' =>$request->rental_price ?? 0,
            'on_sale_price' =>$request->on_sale_price  ?? 0,
            'business_cost' =>$request->cost_price  ?? 0,
            /*'sales_tax' =>$request->sales_tax  ?? 0,*/
            'shipping_cost' =>$request->shipping_cost ?? 0,
            'rental_duration' => $request->rental_duration_int != '' ? $request->rental_duration_int.' '. $request->rental_duration: '',
            'require_deposit' =>$request->require_deposite,
            'deposit_amount' =>$request->require_deposite == 'yes' ? $request->deposit_amount : 0,
            'delivery_method' =>$request->require_deposite == 'yes' ? $request->delivery_method : '',
            'require_ID_to_rent' => $request->requireID ,
            'agreement_info' =>$request->requireID == 'yes' ? $request->agreement_info : '',
            'agreement_img' =>$request->requireID == 'yes' ? $agreementImg : '',
            'quantity' =>$request->quantity ?? 0,
            'low_quantity_alert' =>$request->low_quantity_alert ?? 0,
            'vendor_id' =>$request->vendor_id != '' ? implode(',' , $request->vendor_id) :  '' ,
            'color' =>  $request->colors != '' ? implode(',' ,$request->colors): '',
            'brand' =>  $request->brands != '' ? implode(',' ,$request->brands): '' ,
            'size' => $request->size != '' ? implode(',' ,$request->size): '' ,
            'category' =>  $request->category != '' ? implode(',' ,$request->category): '',
            'great_for' => $request->great_for != '' ? implode(',' ,$request->great_for): '' ,
            'activity_is_for' =>$request->activity_for != '' ? implode(',' ,$request->activity_for): '',
            'material' =>$request->material != '' ? implode(',' ,$request->material): '',
            'policy_returning' =>$request->product_policy,
            'status' =>$request->status,
            'visibility' =>$request->visibility,
        ];

        Products::updateOrCreate(['id' => $id],$data);

        return redirect()->route('business.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($business_id, $id)
    {
        Products::find($id)->delete();
    }


    public function addVariantModal($business_id,$name){
        return view('business.products.dynamic_modal',compact('name','business_id'));
    }

    public function addVariant(Request $request,$business_id){
        
        $model = null;

        if ($request->type == 'color') {
            $model = ProductColors::class;
        } elseif ($request->type == 'size') {
            $model = ProductSize::class;
        } elseif ($request->type == 'brand') {
            $model = ProductBrand::class;
        } elseif ($request->type == 'material') {
            $model = ProductMaterial::class;
        } elseif ($request->type == 'vender') {
            $model = Vender::class;
        }elseif ($request->type == 'category') {
            $model = ProductsCategory::class;
        }

        if ($model) {
            $existingRecord = $model::whereRaw('LOWER(name) = ?', [strtolower($request->name)])->first();

            if ($existingRecord) {
                return response()->json([
                    'error' => ucwords($request->type).' name already exists',
                    'data' => []
                ]);
            }

            $model::create(['name' => $request->name]);
            $options = [];
            $modelData =  $model::orderBy('name')->get();
            foreach($modelData as $dt){
                $options[] = [
                    'id' => $dt->id,
                    'text' => $dt->name
                ];
            }

            return response()->json([
                'success' => ucwords($request->type). ' added successfully',
                'data' => $options, 
            ]);
        }

        return response()->json([
            'error' => 'Invalid type',
            'data' => [] 
        ]);
    }
}
