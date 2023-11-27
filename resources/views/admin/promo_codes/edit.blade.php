@extends('admin.layouts.layout')

@section('content')

    {!! Form::open(array('id' => 'editPromoCode', 'route' => ['promo_codes.update', $promoCode->id] , 'files' => true)) !!}
   
        <div class="panel panel-default">
            <div class="panel-heading">Edit</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('name') ? ' has-error' : '' }} ">
                        {!! Form::label('title', 'Title', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::text('title', $promoCode->title, ['id' => 'title', 'required' =>'required', 'class' => 'form-control', 'placeholder' => 'Title'  ]) !!}
                        <p class="help-block"></p>
                        @if($errors->has('title'))
                            <p class="help-block">
                                {{ $errors->first('title') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('code') ? ' has-error' : '' }} ">
                        {!! Form::label('code', 'Code', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::text('code', $promoCode->code, ['id' => 'code', 'required' =>'required', 'class' => 'form-control', 'placeholder' => 'Promo Code']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('code'))
                            <p class="help-block">
                                {{ $errors->first('code') }}
                            </p>
                        @endif
                    </div>
                </div>

                {!! Form::label('discount', '', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                <div class="row">
                    <div class="col-xs-2 form-group {{ $errors->has('price_in') ? ' has-error' : '' }} ">
                        <select name="price_in" id="price_in" required class="form-control">
                            <option value="$" {{@$promoCode->price_in == '$' ? 'selected' : ''}}>$</option>
                            <option value="%" {{@$promoCode->price_in == '%' ? 'selected' : ''}}>%</option>
                        </select>
                    </div>
                    <div class="col-xs-2 form-group {{ $errors->has('code') ? ' has-error' : '' }} ">
                        {!! Form::text('price', @$promoCode->price, ['id' => 'price', 'required' =>'required', 'class' => 'form-control', 'placeholder' => 'Price' ,'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '');",]) !!}
                    </div>
                </div>

                {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                <div class="row">
                    <div class="col-xs-3 form-group {{ $errors->has('status') ? ' has-error' : '' }} ">
                        <select name="status" id="status" required class="form-control">
                            <option value="active" {{$promoCode->status == 'active' ? 'selected' : ''}}>Active</option>
                            <option value="inactive" {{$promoCode->status == 'inactive' ? 'selected' : ''}}>InActive</option>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-footer text-center">          
                           <button type="submit" id="submit" class="btn btn-primary " >Submit</button>
                           <a href="\admin\promo_codes" class="btn btn-danger ">Cancel</a>
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