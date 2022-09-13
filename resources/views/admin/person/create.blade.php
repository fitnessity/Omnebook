@extends('admin.layouts.layout')

@section('content')

  {!! Form::open(array('route' => 'create-person', 'id' => 'createPerson','enctype' => 'multipart/form-data')) !!}

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
            <div class="col-xs-12 form-group {{ $errors->has('heading') ? ' has-error' : '' }}">
                {!! Form::label('heading', 'Heading', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('heading', old('heading'), ['id' => 'heading', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('heading'))
                        <p class="help-block">
                            {{ $errors->first('heading') }}
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
            <div class="col-xs-12 form-group {{ $errors->has('duration') ? ' has-error' : '' }}">
                {!! Form::label('duration', 'Duration', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('duration', old('duration'), ['id' => 'duration', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('duration'))
                        <p class="help-block">
                            {{ $errors->first('duration') }}
                        </p>
                    @endif
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('level') ? ' has-error' : '' }}">
                {!! Form::label('level', 'Level', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('level', old('level'), ['id' => 'level', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('level'))
                        <p class="help-block">
                            {{ $errors->first('level') }}
                        </p>
                    @endif
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('timings') ? ' has-error' : '' }}">
                {!! Form::label('timings', 'Timings', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::time('timings', old('timings'), ['id' => 'timings', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('timings'))
                        <p class="help-block">
                            {{ $errors->first('timings') }}
                        </p>
                    @endif
            </div>
          </div>

          

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                {!! Form::label('price', 'Price ($)', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::number('price', old('price') ? old('price') : 1, ['min' => 1, 'id' => 'price', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('price'))
                        <p class="help-block">
                            {{ $errors->first('price') }}
                        </p>
                    @endif
            </div>
          </div>


          <div class="row">
          <div class="col-md-12">
              <div class="box-footer text-center">          
               <button type="submit" id="submit" class="btn btn-primary " >Submit</button>
               <a href="\admin\person" class="btn btn-danger ">Cancel</a>
              </div>
            </div>
        </div>
        </div>
      </div>

  {!! Form::close() !!}
@endsection