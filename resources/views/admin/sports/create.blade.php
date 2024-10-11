@extends('admin.layouts.layout')



@section('content')



  {!! Form::open(array('route' => 'store-new-sport', 'id' => 'storeSport','files' => true , 'enctype' => 'multipart/form-data',)) !!}



      <div class="panel panel-default">

        <div class="panel-heading">

          Add

        </div>

        <div class="panel-body">

          <div class="row">

            <div class="col-xs-12 form-group {{ $errors->has('sport_name') ? ' has-error' : '' }}">

                {!! Form::label('sport_name', 'Sport Name', ['class' => 'control-label']) !!} <span class="color-red">*</span>

                {!! Form::text('sport_name', old('sport_name'), ['id' => 'sport_name', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}

                 @if($errors->has('sport_name'))

                  <p class="help-block">

                        {{ $errors->first('sport_name') }}

                  </p>

                @endif

            </div>

          </div>

          

          <div class="row">

            <div class="col-xs-12 form-group">

                {!! Form::label('parent_sport_id', 'Parent Sport', ['class' => 'control-label']) !!}

                <select name="parent_sport_id" id="parent_sport_id" class="form-control">

                  <option value="">Select Parent Sport</option>

                  @foreach ($parent_sports as $key=>$value)

                  <option value="{{$value->id}}" >{{$value->sport_name}}</option>

                  @endforeach

                </select>

            </div>

          </div>



          <div class="row categories_picker">

            <div class="col-xs-12 form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">

                {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!} <span class="color-red">*</span>

                <select name="category_id[]" id="category_id" multiple>

                  @foreach ($all_sports_cats as $key=>$value)

                  <option value="{{$value->id}}">{{$value->category_name}}</option>

                  @endforeach

                </select>
                <script>
                  var p = new SlimSelect({
                    select: '#category_id'
                  });

                </script>
                @if($errors->has('category_id'))

                  <p class="help-block">

                        {{ $errors->first('category_id') }}

                  </p>

                @endif

            </div>
          </div>
          
          <div class="row">

            <div class="col-xs-12 form-group {{ $errors->has('booking_option') ? ' has-error' : '' }}">

                {!! Form::label('booking_option', 'Booking Option', ['class' => 'control-label']) !!} <span class="color-red">*</span>

                <select name="booking_option" id="booking_option" class="form-control">
                  <option value="Professional">Professional</option>
                  <option value="Training Facility">Training Facility</option>
                  <option value="Adventure">Adventure</option>
                  <option value="All">All</option>
                </select>

                @if($errors->has('booking_option'))

                  <p class="help-block">

                        {{ $errors->first('booking_option') }}

                  </p>

                @endif

            </div>

          </div>

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

            <div class="col-xs-12 form-group {{ $errors->has('description') ? ' has-error' : '' }}">

                {!! Form::label('description', 'Description', ['class' => 'control-label']) !!} <span class="color-red">*</span>

                {!! Form::textarea('description', null, array('id' => 'description', 'class' => 'form-control', 'required' =>'required', 'maxlength' =>'255')) !!}

                <p class="help-block"></p>

                    @if($errors->has('description'))

                        <p class="help-block">

                            {{ $errors->first('description') }}

                        </p>

                    @endif

            </div>

          </div>

          <div class="row">

          <div class="col-md-12">

              <div class="box-footer text-center">          

               <button type="submit" id="submit" class="btn btn-primary">Submit</button>

               <a href="\admin\sports" class="btn btn-danger ">Cancel</a>

              </div>

            </div>

        </div>

        </div>

      </div>



  {!! Form::close() !!}



<script type="text/javascript">

$( document ).ready(function() {

  $('.selectpicker').selectpicker({

    size: 5,

    title:'Select Category'

  });



  $("#parent_sport_id").change(function () {

        if(this.value == ''){

          $(".categories_picker").css("display", "block");

          $("#category_id").prop('required',true);

        } else{

          $(".categories_picker").css("display", "none");

          $("#category_id").prop('required',false);

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

@endsection
<style>
  select#category_id {
    margin-left: -13px;
    margin-top: -7px;
    width: 102.5%;
}
button.btn.dropdown-toggle.btn-default {
    display: none;
}
</style>