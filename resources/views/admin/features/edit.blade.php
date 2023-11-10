@extends('admin.layouts.layout')

@section('content')

    {!! Form::open(array('id' => 'editFeatures', 'route' => ['update-plan', $features->id] , 'files' => true)) !!}
   
        <div class="panel panel-default">
            <div class="panel-heading">Edit</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('name') ? ' has-error' : '' }} ">
                        {!! Form::label('name', 'Name', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::text('name', $features->name, ['id' => 'name', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '' ,]) !!}
                        <p class="help-block"></p>
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('tooltip_text') ? ' has-error' : '' }} ">
                        {!! Form::label('tooltip_text', 'Tooltip Text', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::text('tooltip_text', $features->tooltip_text, ['id' => 'tooltip_text', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('tooltip_text'))
                            <p class="help-block">
                                {{ $errors->first('tooltip_text') }}
                            </p>
                        @endif
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