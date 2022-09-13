@extends('layouts.app')

@section('content')
<script src="{{ asset('/js/tinymce-4.3.7/tinymce.min.js') }}"></script>
<script>tinymce.init({ selector:'textarea' });</script>

<div class="m-b-md">
    <center><h2 class="m-b-none">Edit Template </h2></center>
</div>

<section class="panel panel-default">
    <header class="panel-heading"></header>

    <!-- display flash message -->
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
    </div>
    <!-- end flash-message -->

    @if(isset($success))
        <div class="alert alert-success"> {{$success}} </div>
    @endif

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Template Form -->
        {!! Form::open(array('url' => '/emailtemplate', 'class' => 'form-horizontal', 'files' => true, 'id' => 'editTemplate' )) !!}
        <!--<form action="/template" method="POST" class="form-horizontal">-->
                {{ csrf_field() }}

                <input type="hidden" name="id" id="id" value="{!! $template['id'] !!}">

                <!-- Template Name -->
                <div class="form-group">
                        <label for="template-name" class="col-sm-3 control-label">Name<font color="red">*</font></label>

                        <div class="col-sm-6">
                                <input type="text" name="name" id="template-name" class="form-control" value="{!! $template['name'] !!}" style="text-transform:uppercase;">
                        </div>
                </div>

                <!-- Template Subject -->
                <div class="form-group">
                        <label for="template-subject" class="col-sm-3 control-label">Subject<font color="red">*</font></label>

                        <div class="col-sm-6">
                            <input type="text" name="subject" id="subject" class="form-control" value="{!! $template['subject'] !!}">
                        </div>
                </div>

                <!-- Template Sender Name -->
                <div class="form-group">
                        <label for="template-sender_name" class="col-sm-3 control-label">Sender Name<font color="red">*</font></label>

                        <div class="col-sm-6">
                            <input type="text" name="sender_name" id="sender_name" class="form-control" value="{!! $template['sender_name'] !!}">
                        </div>
                </div>

                <!-- Template Sender Email -->
                <div class="form-group">
                        <label for="template-sender_email" class="col-sm-3 control-label">Sender Email<font color="red">*</font></label>

                        <div class="col-sm-6">
                            {!! Form::email('sender_email', $template['sender_email'] , $attributes = array('class' => "form-control", 'placeholder' => "example@domain.com", 'autocomplete' => 'off')) !!}
                        </div>
                </div>

                <!-- Template Description -->
                <div class="form-group">
                        <label for="template-description" class="col-sm-3 control-label">Email Description<font color="red">*</font></label>

                        <div class="col-sm-6">
                            <textarea name="description" id="description" class="form-control">
                            @if((old('description')))
                                {!! old('description') !!}
                            @else
                                {!! $template['description'] !!}
                            @endif
                            </textarea>
                        </div>
                </div>

                <!-- Edit Template Button -->
                <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                        <i class="fa fa-btn fa-plus"></i>Edit Template
                                </button>
                        </div>
                </div>
        <!--</form>-->
       {!! Form::close() !!}

</div>
</section>
@endsection