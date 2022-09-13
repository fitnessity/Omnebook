@extends('admin.layout')

@section('content')

  {!! Form::open(array('id' => 'editPlan', 'route' => ['update-plan', $plan->id])) !!}
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
          
      <ol class="breadcrumb">
        <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a href="{!! route('plan-list') !!}">Manage Plan</a></li>
        <li class="active">Edit Membership Plan</li>
      </ol>
      <h3>Edit Membership Plan</h3>
    </section>
    <section class="content-header">
      
      <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info', ] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
          @if (isset($status))
            @foreach ($status as $key=>$msg) 
              <div class="alert alert-{{ $key }}">
                  {{ $msg }}
              </div>
            @endforeach
            @endif
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          Edit
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 form-group">
                {!! Form::label('title', 'Title*', ['class' => 'control-label']) !!}
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
            <div class="col-xs-12 form-group">
                {!! Form::label('price_per_month', 'Price Per Month ($)*', ['class' => 'control-label']) !!}
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
            <div class="col-xs-12 form-group">
                {!! Form::label('quote_per_month', 'Quote Per Month*', ['class' => 'control-label']) !!}
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
            <div class="col-xs-12 form-group">
                {!! Form::label('description', 'Detail', ['class' => 'control-label']) !!}
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
            <div class="col-xs-12 form-group">
                {!! Form::label('is_deleted', 'Is Active?*', ['class' => 'control-label']) !!}
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
      <!-- <section class="content">
    
      <div class="box box-default">
        <div class="box-body">
          
          <div class="row">
            <div class="col-md-12 form-group">
              <label class="col-md-3 text-right">Title : </label>
              <div class="col-md-6">
              {!! Form::text('title', $plan->title, array('id' => 'title', 'class' => 'form-control', 'required' =>'required')) !!}
              </div>
            </div>
          </div>
      
          <div class="row">
            <div class="col-md-12 form-group">
              <label class="col-md-3 text-right">Price Per Month : </label>
              <div class="col-md-2">
              {!! Form::number('price_per_month', $plan->price_per_month, array('min' => 1, 'id' => 'price_per_month', 'class' => 'form-control', 'required' =>'required')) !!}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label class="col-md-3 text-right">Quote Per Month : </label>
              <div class="col-md-2">
              {!! Form::number('quote_per_month', $plan->quote_per_month, array('min' => 1, 'id' => 'quote_per_month', 'class' => 'form-control', 'required' =>'required')) !!}
              </div>
            </div>
          </div>

            <div class="row">
            <div class="col-md-12 form-group">
              <label class="col-md-3 text-right">Quote Per Month : </label>
              <div class="col-md-6">
              {!! Form::textarea('description', $plan->description, array('id' => 'description', 'class' => 'form-control', 'required' =>'required')) !!}
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 form-group">
              <label class="col-md-3 text-right">Plan Status : </label>
              <div class="col-md-6">
                <label>{!! Form::radio('is_deleted', 1, $plan->is_deleted ? true : false, ['class' => 'form-field']) !!}Active</label>
                <label>{!! Form::radio('is_deleted', 0, $plan->is_deleted ? false : true, ['class' => 'form-field']) !!}Inactive</label>
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
    </section> -->

  </div>

  {!! Form::close() !!}
 

@endsection