@extends('admin.layouts.layout')

@section('content')

  {!! Form::open(array('route' => 'create-getstarted', 'id' => 'createOnline','enctype' => 'multipart/form-data')) !!}

      <div class="panel panel-default">
        <div class="panel-heading">
          Add
        </div>
        <div class="panel-body">

          <div class="row">
            <div class="col-xs-12 form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            {!! Form::label('image', 'Image', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                <input type="file" name="image" id="image" class="form-control" required="required" onchange="validateImage()">
                @if($errors->has('image'))

                  <p class="help-block">
                        {{ $errors->first('image') }}
                  </p>
                @endif
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', 'Title', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('title', old('title'), ['id' => 'title', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
            </div>
          </div>

          <div class="row">
          <div class="col-md-12">
              <div class="box-footer text-center">          
               <button type="submit" id="submit" class="btn btn-primary " >Submit</button>
              </div>
            </div>
        </div>
        </div>
      </div>

  {!! Form::close() !!}
@endsection