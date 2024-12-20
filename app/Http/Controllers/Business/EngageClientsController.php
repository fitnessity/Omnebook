<?php

namespace App\Http\Controllers\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Repositories\{UserRepository,SportsRepository};
use Illuminate\Support\Facades\Auth;
use File;
use Config;
use Redirect;
use View;
use DB;
use Response;
use Validator;
use DateTime;
use Hash;


use App\{BusinessServices,BusinessPriceDetailsAges,CustomList,Customer,CustomCientList,UserBookingDetail};

class EngageClientsController extends BusinessBaseController {


	public function index(Request $request,$business_id){
		return view('business.engage-clients.index');
	}

	public function contactList(Request $request,$business_id){
		$customList = CustomList::where(['business_id'=>$business_id])->get();
		$programList = BusinessServices::where(['cid'=>$business_id ,'is_active' => 1])->get();
		$categoryList = BusinessPriceDetailsAges::where(['cid'=>$business_id])->get();

		$type = $request->has('type') ? $request->type : 'all';
		$typeId = $request->has('typeId') ? $request->typeId : '';
		$typeName = $request->has('typeName') ? $request->typeName : 'All Contacts';
		return view('business.engage-clients.contact_list',compact('programList','categoryList','customList','business_id','type','typeId','typeName'));
	}

	public function storeList(Request $request){
		$validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

       	$list = CustomList::create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'business_id' => $request->business_id,
        ]);

   		$type = 'custom';
		$typeId = $list->id;
		$typeName = $request->name;
       
        return redirect()->route('business.engage_client.contact-list' ,['type' =>$type,'typeId' =>$typeId,'typeName' =>$typeName]);
	}

	public function updateList(Request $request){
		$validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

		$list = CustomList::find($request->id);
       	$list->update([
            'name' => $request->name ]);

   		$type = 'custom';
		$typeId = $list->id;
		$typeName = $request->name;
       
        return redirect()->route('business.engage_client.contact-list' ,['type' =>$type,'typeId' =>$typeId,'typeName' =>$typeName]);
	}

	public function deleteList(Request $request){
		CustomList::find($request->id)->delete();
	}

	public function getAddClientsModel(Request $request ,$business_id){
		$customers = Customer::where('business_id',$business_id)->get();
		$customList = CustomList::find($request->id);
		$oldClientsAry = CustomCientList::where('custom_list_id' , $request->id)->pluck('customer_id')->toArray();
		$oldClients = implode(',', $oldClientsAry);

		return view('business.engage-clients.add_client_model' ,compact('customers','customList','oldClients'));
	}

	public function loadClientDatatable(Request $request ,$business_id){

		if($request->type == 'all'){
			$customers = Customer::where('business_id',$business_id)->get();
		}else if($request->type == 'program'){
			$customersIdAray = UserBookingDetail::where('sport',$request->id)->whereNotNull('user_id')->pluck('user_id')->toArray();
			$customers = Customer::whereIn('id',$customersIdAray)->get();
		}else if($request->type == 'category'){
			$category = BusinessPriceDetailsAges::find($request->id);
			$customersIdAray = $category->BusinessPriceDetails()->pluck('id')->toArray();
			$customersIdAray = UserBookingDetail::whereIn('priceid',$customersIdAray)->pluck('user_id')->toArray();
			$customers = Customer::whereIn('id',$customersIdAray)->get();
		}elseif($request->type == 'custom'){
			$customList =  CustomList::find($request->id);
			$customersIdAray = $customList->customCientList()->pluck('customer_id')->toArray();
			$customers = Customer::whereIn('id',$customersIdAray)->get();
		}elseif($request->type == 'customer'){
			$customers = Customer::where('business_id',$business_id)->get();

			$customerStatus = $customers->mapToGroups(function ($customer) {
	            return [$customer->is_active() => $customer];
	        });

			if($request->id == 'Active'){
                $customers =  $customerStatus->get($request->id, collect());
            }else if($request->id == 'InActive'){
                $customers =  $customerStatus->get($request->id, collect());
            }else if($request->id == 'Prospect'){
                $customers =  $customerStatus->get($request->id, collect());
            }else if($request->id == 'at-risk'){
                $customers = $customers->filter->customerAtRisk();
            }else if($request->id == 'big-spenders'){
                $customers = $customers->filter->bigSpender(); 
            }
		}else if($request->type == 'gender'){
			$customers = Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->where(DB::raw('LOWER(gender)'), strtolower($request->id))->get();
		}else if($request->type == 'age'){
			if($request->id == '18-29'){
                $customers =  Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->whereRaw("birthdate <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR)")
                   ->whereRaw("birthdate >= DATE_SUB(CURDATE(), INTERVAL 29 YEAR)")
                   ->get();
            }else if($request->id == '30-39'){
                $customers =  Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->whereRaw("birthdate <= DATE_SUB(CURDATE(), INTERVAL 30 YEAR)")
                   ->whereRaw("birthdate >= DATE_SUB(CURDATE(), INTERVAL 39 YEAR)")
                   ->get();
            }else if($request->id == '40-49'){
                $customers = Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->whereRaw("birthdate <= DATE_SUB(CURDATE(), INTERVAL 40 YEAR)")
                   ->whereRaw("birthdate >= DATE_SUB(CURDATE(), INTERVAL 49 YEAR)")
                   ->get();
            }else if($request->id == '50'){
                $customers = Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->whereRaw("birthdate <= DATE_SUB(CURDATE(), INTERVAL 50 YEAR)")->get();
            }else if($request->id == 'kids'){
                $customers =  Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->whereRaw("birthdate >= DATE_SUB(CURDATE(), INTERVAL 18 YEAR)")->get();
            }
		}else if($request->type == 'membership'){
			$currentDate = Carbon::now();
			if($request->id == 'Month'){
				$lastDateOfMonth = $currentDate->endOfMonth();
				$customersIdAray = UserBookingDetail::where('business_id',$business_id)->where('expired_at', '<=', $lastDateOfMonth)->whereDate('expired_at', '>=', Carbon::now()->format('Y-m-d'))->whereNotNull('user_id')->pluck('user_id')->toArray();
			}else{
				$customersIdAray = UserBookingDetail::where('business_id',$business_id)->whereDate('expired_at', '<', $currentDate)->whereNotNull('user_id')->pluck('user_id')->toArray();
			}
			$customers = Customer::whereIn('id',$customersIdAray)->get();
		}
		
		$type = $request->type;
		return view('business.engage-clients.client_table' ,compact('customers','type'));
	}

	public function storeClientCustomList(Request $request ,$business_id){

		$cIds = $request->input('cid');
		$cidArray = explode(',', $cIds);
		$customList = CustomList::find($request->lId);
		$oldClients = CustomCientList::where('custom_list_id' , $request->lId)->pluck('id')->toArray();
		$ids = [];
		foreach ($cidArray as $cId) {
			$checkExis = CustomCientList::where(['custom_list_id' =>$request->lId ,'customer_id' => $cId])->first();
			if(!$checkExis){
				$data = CustomCientList::create([
					'business_id' => $business_id,
					'custom_list_id' => $request->lId,
					'customer_id' => $cId,
				]);

				$ids[] = $data->id;
			}else{
				$ids[] = $checkExis->id;
			}
		}

		$diff = array_diff($oldClients,$ids);
		CustomCientList::whereIn('id',$diff)->delete();

		return redirect()->route('business.engage_client.contact-list',['type' =>'custom','typeId' =>$request->lId,'typeName' =>$customList->name]);
	}
}