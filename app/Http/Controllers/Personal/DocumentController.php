<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Redirect,Storage,Hash,Response;
use App\{CustomersDocuments,CustomerDocumentsRequested,BusinessTerms,Customer,UserFamilyDetail,Notification};
use \PDF;
use GuzzleHttp\Client;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->customer_id){
            if($request->type == 'user'){
                $familyMember = Auth::user()->user_family_details()->where('id',$request->customer_id)->first();
                $customer = Customer::where(['fname' => $familyMember->first_name,'lname' => $familyMember->last_name,'email' => $familyMember->email,])->first();
            }else{
                $customer = Customer::find($request->customer_id);
            }
            
            $id = $customer->id;
        }else{
            $customer = Auth::user()->customers()->where('business_id',$request->business_id)->first();
            $id = $customer->id;
        }

        $documents = CustomersDocuments::where('customer_id', $id)->when($request->business_id, function ($query) use ($request) {
            return $query->where('business_id', $request->business_id);
        })->get();
        //where('status',1)

        $terms = BusinessTerms::where('cid' ,$request->business_id)->first();
        $lastBooking = $customer->bookingDetail()->orderby('created_at','desc')->first();
        return view('personal.documents.index',compact('documents','customer','lastBooking','terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Responsall();exit;
     */
    public function store(Request $request)
    {   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   //print_r($request->all());exit;
        $content = CustomerDocumentsRequested::find($id);
        $imageName = '';
        if($request->hasFile('image')){
            $imageName = $request->file('image')->store('documents');

            Notification::create([
                'user_id' => Auth::user()->id,
                'customer_id' => $content->customer_id,
                'table_id' => $content->id,
                'table' =>  'CustomerDocumentsRequested',
                'display_date' => date('Y-m-d'),
                'display_time' => date("H:i"),
                'type' => 'business',
                'business_id' => $content->business_id,
                'status'  =>  'Alert'
            ]);

            $count = CustomerDocumentsRequested::where('doc_id', $content->doc_id)->whereNotNull('path')->count();
            if ($count == 0) {
                CustomersDocuments::where('id',$content->doc_id)->update(['doc_completed_date' => date('Y-m-d')]);
            }
        }else{
            $imageName = $request->old_profile_pic;
        }

        if($content->path){
            Storage::disk('s3')->delete($content->path);
        }

       $status =  $content->update(['path' => $imageName]);   

        if($status)
            return response()->json(['status'=>200,'message'=>'Document successfully uploded.']);
        else
            return response()->json(['status'=>500,'message'=>'There is error while uploding document.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function getContent($id,$type){
        $content = CustomerDocumentsRequested::where('doc_id',$id)->get();
        if($type == 'upload'){
            return view('personal.documents.contents',compact('content','id'))->render();
        }else{
            return view('personal.documents.content_display',compact('content','id'))->render();
        }
    }

    public function download($id){
        $document = CustomerDocumentsRequested::findOrFail($id);
        $filePath = Storage::url($document->path);
        $name = str_replace("documents/", "", $document->path);
        $imageContent = file_get_contents($filePath);
        $headers = [
            'Content-Type'        => 'image/jpeg', // Change the content type based on your image type
            'Content-Disposition' => 'attachment; filename='.$name,
        ];
        return Response::make($imageContent, 200, $headers);
    }

    public function export(Request $request){
        $terms = BusinessTerms::where('cid' ,$request->cid)->first();
        if($request->type == 'terms'){
            $title = 'Terms, Conditions, FAQ';
            $details =  $terms->termcondfaqtext;
        }else if($request->type == 'contract'){
            $title = 'Contract Terms';
            $details =  $terms->contracttermstext;
        }else if($request->type == 'liability'){
            $title = 'Liability Waiver';
            $details =  $terms->liabilitytext;
        }else if($request->type == 'covid'){
            $title = 'Covid – 19 Protocols';
            $details =  $terms->covidtext;
        }else {
            $title = 'Refund Policy';
            $details =  $terms->refundpolicytext;
        }

        $data = [
            'title'=>$title,
            'details'=> $details != '' ? $details : 'No Terms Details Available',
            'app_url'=> env('APP_URL'),
        ];
        
        $pdf = PDF::loadView('personal.documents.contract_pdf',$data);
        $fileName = $request->type.'.pdf';
        return $pdf->download($fileName);
    }

    public function savesignature(Request $request)
    {
        $signatureDataUrl = $request->input('signature');
        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureDataUrl));
        $filename = 'signatures/signature_' . time() . '.png';
        $customer = Customer::find($request->cus_id);
        //echo $customer ;exit;
        $documents = CustomersDocuments::find($request->id);
        if($signatureDataUrl){
            Storage::disk('s3')->put($filename, $image);
            if($request->type) {
                if($request->type == 'terms'){
                    $customer->update(['terms_sign_path'=> $filename ,'terms_condition' =>date('Y-m-d') ]);
                }else if($request->type == 'contract'){
                    $customer->update(['contract_sign_path'=> $filename,'terms_contract' =>date('Y-m-d')]);
                }else if($request->type == 'liability'){
                    $customer->update(['liability_sign_path'=> $filename,'terms_liability' =>date('Y-m-d')]);
                }else if($request->type == 'covid'){
                    $customer->update(['covid_sign_path'=> $filename,'terms_covid' =>date('Y-m-d')]);
                }else {
                    $customer->update(['refund_sign_path'=> $filename,'terms_refund' =>date('Y-m-d')]);
                }

                $tableId = $customer->id;
                $table = 'Customer';
                $businessId =  $customer->business_id;

            }else{
                Storage::delete($documents->sign_path); 
                $documents->update(['sign_date'=> date('Y-m-d') ,'sign_path'=> $filename]);
                $tableId =  $documents->id;
                $table =  'CustomersDocuments';
                $businessId =  $documents->business_id;
            }

            Notification::create([
                'user_id' => Auth::user()->id,
                'customer_id' =>  $customer->id,
                'table_id' => $tableId,
                'table' =>  $table,
                'display_date' => date('Y-m-d'),
                'display_time' => date("H:i"),
                'type' => 'business',
                'business_id' =>  $businessId,
                'status'  =>  'Alert'
            ]);
        }
    }

    public function imageProxy(Request $request){
        $imageUrl = $request->input('url');
        $client = new Client();
        $imageContent = $client->get($imageUrl)->getBody();

        $headers = [
            'Content-Type' => 'image/png', // Adjust the content type based on your image type
            'Cache-Control' => 'public, max-age=604800', // Optional: Add cache control headers
        ];
        return response($imageContent)->withHeaders($headers);
    }
}
