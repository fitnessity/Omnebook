@extends('admin.layouts.layout')



@section('content')

@foreach($person as $persons)

{!! Form::open(array('id' => 'editOn','enctype' => 'multipart/form-data', 'route' => ['update-person', $persons->id])) !!}



      <div class="panel panel-default">

        <div class="panel-heading">

          Edit

        </div>

        <div class="panel-body">

          <div class="row">
            <br>
            <div class="col-xs-12 form-group{{ $errors->has('image') ? ' has-error' : '' }}">

            @if($persons['image'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'person'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$persons['image']))

              <img src="{{ asset('public/uploads/person/thumb/'.$persons->image) }}" height="100px" width="100px"/> 

              <!-- <b>Sport Image</b> -->

            @endif
            <br><br>

            {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}

                <input type="file" name="image" id="image" class="form-control" onchange="validateImage()">

                @if($errors->has('image'))

                  <p class="help-block">

                        {{ $errors->first('image') }}

                  </p>
                @endif
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('heading') ? ' has-error' : '' }} ">
                {!! Form::label('heading', 'Heading', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('heading', $persons->heading, ['id' => 'heading', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('heading'))
                        <p class="help-block">
                            {{ $errors->first('heading') }}
                        </p>
                    @endif
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('title') ? ' has-error' : '' }} ">
                {!! Form::label('title', 'Title', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('title', $persons->title, ['id' => 'title', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('duration') ? ' has-error' : '' }} ">
                {!! Form::label('duration', 'Duration', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('duration', $persons->duration, ['id' => 'duration', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('duration'))
                        <p class="help-block">
                            {{ $errors->first('duration') }}
                        </p>
                    @endif
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('level') ? ' has-error' : '' }} ">
                {!! Form::label('level', 'Level', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('level', $persons->level, ['id' => 'level', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('level'))
                        <p class="help-block">
                            {{ $errors->first('level') }}
                        </p>
                    @endif
            </div>
          </div>

           <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('timings') ? ' has-error' : '' }} ">
                {!! Form::label('timings', 'Timings', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('timings', $persons->timings, ['id' => 'timings', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('timings'))
                        <p class="help-block">
                            {{ $errors->first('timings') }}
                        </p>
                    @endif
            </div>
          </div>
          

          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('price') ? ' has-error' : '' }} ">
                {!! Form::label('price', 'Price', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('price', $persons->price, ['id' => 'price', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
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
              <input type="hidden" name="id" id="id" value="{{$persons->id}}">         
               <button type="submit" id="submit" class="btn btn-primary " >Submit</button>
               <a href="\admin\person" class="btn btn-danger ">Cancel</a>
              </div>
            </div>
          </div>

        </div>

      </div>



  {!! Form::close() !!}

@endforeach

<script type="text/javascript">

$( document ).ready(function() {

  $('.selectpicker').selectpicker({

    size: 5,

    title:'Select Category'

  });



  $("#parent_sport_id").change(function () {

        if(this.value == ''){

          $(".categories_picker").css("display", "block");

        } else{

          $(".categories_picker").css("display", "none");

        }

    });

});

function validateImage() 

    {

        var formData = new FormData();

     

        var file = document.getElementById("image").files[0];

     

        formData.append("Filedata", file);

        var t = file.type.split('/').pop().toLowerCase();

        if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {

            alert('Please select a valid image file');

            document.getElementById("image").value = '';

            return false;

        }

        if (file.size > 1000000) {

            alert('Please Upload picture less than 1MB size');

            document.getElementById("image").value = '';

            return false;

        }

        return true;

    }

</script>
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