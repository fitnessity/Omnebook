@extends('admin.layouts.layout')


@section('content')

@foreach($trainer as $trainers)

{!! Form::open(array('id' => 'editSlider','enctype' => 'multipart/form-data', 'route' => ['update-trainer', $trainers->id])) !!}



      <div class="panel panel-default">

        <div class="panel-heading">

          Edit

        </div>

        <div class="panel-body">

          <div class="row">
            <br>
            <div class="col-xs-12 form-group{{ $errors->has('image') ? ' has-error' : '' }}">

            @if($trainers['image'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'trainer'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$trainers['image']))

              <img src="{{ asset('public/uploads/trainer/thumb/'.$trainers->image) }}" height="100px" width="100px"/> 

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
            <div class="col-xs-12 form-group {{ $errors->has('name') ? ' has-error' : '' }} ">
                {!! Form::label('name', 'Name', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('name', $trainers->name, ['id' => 'name', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
            </div>
          </div>

         

        <div class="row">
            <div class="col-md-12">
              <div class="box-footer text-center"> 
              <input type="hidden" name="id" id="id" value="{{$trainers->id}}">         
               <button type="submit" id="submit" class="btn btn-primary " >Submit</button>
               <a href="\admin\trainer" class="btn btn-danger ">Cancel</a>
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