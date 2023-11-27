<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\{FeaturesRepository};
use Auth;

class FeaturesController extends Controller
{  

	protected $features;

	public function __construct(FeaturesRepository $features)
    {
        $this->middleware('admin');
        $this->features = $features;
    }

    public function index()
    {
        $features = $this->features->getAllFeatures();

        return view('admin.features.index', [
            'features' => $features,
            'pageTitle' => 'Manage Features'
        ]);
    }

    public function edit($id)
    {
        $features = $this->features->getById($id);
        if($features){
            return view('admin.features.edit', [
                'pageTitle' => 'Edit Features',
                'features' => $features
            ]);
        }

        return redirect()->route('features.index');   
    }

    public function update($id, Request $request)
    {
        $status = $this->features->update($id,[
            'tooltip_text' => $request->tooltip_text,
        ]);

        if($status)
        {
            session(['key' => 'success']);
            session(['msg' => 'Features Updated Succesfully !']);    
        }

        return redirect()->route('features.index');
    }
}