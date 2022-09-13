@extends('admin.layouts.layout')

@section('content')

  {!! Form::open(array('id' => 'editPlan', 'route' => ['update-plan', $plan->id])) !!}
   
      <div class="panel panel-default">
        <div class="panel-heading">
          Edit
        </div>
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
            <div class="col-xs-12 form-group {{ $errors->has('price_per_month') ? ' has-error' : '' }}">
                {!! Form::label('price_per_month', 'Price Per Month ($)', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::number('price_per_month', $plan->price_per_month, ['min' => 1, 'id' => 'price_per_month', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('price_per_month'))
                        <p class="help-block">
                            {{ $errors->first('price_per_month') }}
                        </p>
                    @endif
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('quote_per_month') ? ' has-error' : '' }}">
                {!! Form::label('quote_per_month', 'Quote Per Month', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::number('quote_per_month', $plan->quote_per_month, ['min' => 1, 'id' => 'quote_per_month', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('quote_per_month'))
                        <p class="help-block">
                            {{ $errors->first('quote_per_month') }}
                        </p>
                    @endif
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', 'Detail', ['class' => 'control-label']) !!} <span class="color-red">*</span>
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
 

@endsection