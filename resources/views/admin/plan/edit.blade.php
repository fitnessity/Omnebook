@extends('admin.layouts.layout')

@section('content')

    {!! Form::open(array('id' => 'editPlan', 'route' => ['update-plan', $plan->id] , 'files' => true)) !!}
   
        <div class="panel panel-default">
            <div class="panel-heading">Edit</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('title') ? ' has-error' : '' }} ">
                        {!! Form::label('title', 'Title', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::text('title', $plan->title, ['id' => 'title', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                            @if($errors->has('title'))
                                <p class="help-block">
                                    {{ $errors->first('title') }}
                                </p>
                            @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('heading') ? ' has-error' : '' }} ">
                        {!! Form::label('heading', 'Heading', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::text('heading', $plan->heading, ['id' => 'heading', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('heading'))
                            <p class="help-block">
                                {{ $errors->first('heading') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('price_per_month') ? ' has-error' : '' }}">
                        {!! Form::label('price_per_month', 'Price Per Month ($)', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::number('price_per_month', $plan->price_per_month, ['min' => 0, 'id' => 'price_per_month', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                            @if($errors->has('price_per_month'))
                                <p class="help-block">
                                    {{ $errors->first('price_per_month') }}
                                </p>
                            @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('price_per_year') ? ' has-error' : '' }}">
                        {!! Form::label('price_per_year', 'Price Per Year ($)', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::number('price_per_year', $plan->price_per_year, ['min' => 0, 'id' => 'price_per_year', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                            @if($errors->has('price_per_year'))
                                <p class="help-block">
                                    {{ $errors->first('price_per_year') }}
                                </p>
                            @endif
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 form-group">

                        {!! Form::label('featurs_details', 'Features', ['class' => 'control-label']) !!} <span class="color-red">*</span>

                        <div class="row">
                            @php $myAraay = json_decode($plan->featurs_details,true); @endphp
                            
                            @foreach ($features as $key=>$f)
                                <div class="col-md-3">
                                    <p>{{$f->name}}</p>
                                </div>

                                <div class="col-md-6">
                                    <input class="form-control mb-5" type="text" name="featureValue_{{$f->id}}" @if(isset($myAraay[$f->id])) value="{{ $myAraay[$f->id] }}" @endif required>
                                </div>
                                <div class="col-md-3"></div>
                            @endforeach
                        </div>
                        
                        @if($errors->has('featurs_details'))
                            <p class="help-block">{{ $errors->first('featurs_details') }}</p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        @if(Storage::exists($plan->image))
                            <input type="hidden" name="hiddenimage" value="{{$plan->image}}">
                            <img src="{{Storage::url($plan->image)}}" height="100px" width="100px" id="banner"> <br>
                            {!! Form::label('plan_image', 'Plan Image', ['class' => 'control-label']) !!}
                        @else
                            {!! Form::label('plan_image', 'Upload Banner', ['class' => 'control-label']) !!} 
                        @endif

                        <input type="file" name="image" id="image" class="form-control">
                        @if($errors->has('image'))
                            <p class="help-block">{{ $errors->first('image') }}</p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        {!! Form::label('description', 'Description', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::textarea('description', $plan->description, array('id' => 'description', 'class' => 'form-control', 'required' =>'required')) !!}
                        <p class="help-block"></p>
                        @if($errors->has('description'))
                            <p class="help-block">
                                {{ $errors->first('description') }}
                            </p>
                        @endif
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('is_deleted') ? ' has-error' : '' }}">
                        {!! Form::label('is_deleted', 'Is Active?', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        <p class="help-block"></p>
                        @if($errors->has('is_deleted'))
                            <p class="help-block">
                                {{ $errors->first('is_deleted') }}
                            </p>
                        @endif
                        <div>
                            <label>{!! Form::radio('is_deleted', 0, !($plan->is_deleted) ? true : false) !!} Yes</label>
                        </div>
                        <div>
                          <label>{!! Form::radio('is_deleted', 1, $plan->is_deleted ? true : false) !!} No</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box-footer text-center">          
                           <button type="submit" id="submit" class="btn btn-primary " >Submit</button>
                           <a href="\admin\plans\membership-plan" class="btn btn-danger ">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {!! Form::close() !!}
 <script>
 $(document).ready(function(){
    CKEDITOR.replace( 'description');
  });   
 </script>

@endsection