@extends('admin.layouts.layout')



@section('content')

@foreach($fees as $fee)

{!! Form::open(array('id' => 'editFees','enctype' => 'multipart/form-data', 'route' => ['update-fees', $fee->id])) !!}



      <div class="panel panel-default">

        <div class="panel-heading">

          Edit

        </div>

        <div class="panel-body">

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('verification_fees') ? ' has-error' : '' }} ">
                {!! Form::label('price', 'Verification Fees ($)', ['class' => 'control-label']) !!} 
                {!! Form::text('price', $fee->price, ['id' => 'price', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('price'))
                        <p class="help-block">
                            {{ $errors->first('price') }}
                        </p>
                    @endif
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('service_fees') ? ' has-error' : '' }} ">
                {!! Form::label('service_fee', 'Service Fees', ['class' => 'control-label']) !!} 
                {!! Form::text('service_fee', $fee->service_fee, ['id' => 'service_fee', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('service_fee'))
                        <p class="help-block">
                            {{ $errors->first('service_fee') }}
                        </p>
                    @endif
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('stext') ? ' has-error' : '' }} ">
                {!! Form::label('site_tax', 'Tax', ['class' => 'control-label']) !!} 
                {!! Form::text('site_tax', $fee->site_tax, ['id' => 'site_tax', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('site_tax'))
                        <p class="help-block">
                            {{ $errors->first('site_tax') }}
                        </p>
                    @endif
            </div>
          </div>

         

        <div class="row">
            <div class="col-md-12">
              <div class="box-footer text-center"> 
              <input type="hidden" name="id" id="id" value="{{$fee->id}}">         
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