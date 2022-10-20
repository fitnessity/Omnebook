@extends('admin.layouts.layout')



@section('content')

@foreach($hometracker as $home)

{!! Form::open(array('id' => 'edithometracker','enctype' => 'multipart/form-data', 'route' => ['update-hometracker', $home->id])) !!}

      <div class="panel panel-default">

        <div class="panel-heading">

          Edit

        </div>

        <div class="panel-body">

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('verification_fees') ? ' has-error' : '' }} ">
                {!! Form::label('trainers', 'Trainers', ['class' => 'control-label']) !!} 
                {!! Form::text('trainers', $home->trainers, ['id' => 'trainers', 'class' => 'form-control', 'placeholder' => '','required'=>'required']) !!}
                <p class="help-block"></p>
                    @if($errors->has('trainers'))
                        <p class="help-block">
                            {{ $errors->first('trainers') }}
                        </p>
                    @endif
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('locations') ? ' has-error' : '' }} ">
                {!! Form::label('locations', 'Locations', ['class' => 'control-label']) !!} 
                {!! Form::text('locations', $home->locations, ['id' => 'locations', 'class' => 'form-control', 'placeholder' => '','required'=>'required']) !!}
                <p class="help-block"></p>
                    @if($errors->has('locations'))
                        <p class="help-block">
                            {{ $errors->first('locations') }}
                        </p>
                    @endif
            </div>
          </div>

        <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('activities') ? ' has-error' : '' }} ">
                {!! Form::label('activities', 'Activities', ['class' => 'control-label']) !!} 
                {!! Form::text('activities', $home->activities, ['id' => 'activities', 'class' => 'form-control', 'placeholder' => '','required'=>'required']) !!}
                <p class="help-block"></p>
                    @if($errors->has('activities'))
                        <p class="help-block">
                            {{ $errors->first('activities') }}
                        </p>
                    @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('businesses') ? ' has-error' : '' }} ">
                {!! Form::label('businesses', 'Businesses', ['class' => 'control-label']) !!} 
                {!! Form::text('businesses', $home->businesses, ['id' => 'businesses', 'class' => 'form-control', 'placeholder' => '','required'=>'required']) !!}
                <p class="help-block"></p>
                    @if($errors->has('businesses'))
                        <p class="help-block">
                            {{ $errors->first('businesses') }}
                        </p>
                    @endif
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('bookings') ? ' has-error' : '' }} ">
                {!! Form::label('bookings', 'Bookings', ['class' => 'control-label']) !!} 
                {!! Form::text('bookings', $home->bookings, ['id' => 'bookings', 'class' => 'form-control', 'placeholder' => '','required'=>'required']) !!}
                <p class="help-block"></p>
                    @if($errors->has('bookings'))
                        <p class="help-block">
                            {{ $errors->first('bookings') }}
                        </p>
                    @endif
            </div>
        </div>

         

        <div class="row">
            <div class="col-md-12">
              <div class="box-footer text-center"> 
              <input type="hidden" name="id" id="id" value="{{$home->id}}">         
               <button type="submit" id="submit" class="btn btn-primary " >Submit</button>
               <a href="\admin\dashboard" class="btn btn-danger ">Cancel</a>
              </div>
            </div>
          </div>

        </div>

      </div>



  {!! Form::close() !!}

@endforeach

<style>
  button.btn.dropdown-toggle.btn-default{
    margin-left: -13px;
    margin-top: -7px;
  }
  select#category_id {
    display: none;
}
.dropdown-menu.open{
  overflow: visible !important;
}
</style>
@endsection