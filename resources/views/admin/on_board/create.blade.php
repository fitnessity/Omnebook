@extends('admin.layouts.layout')

@section('content')

    {!! Form::open(array('id' => 'editquestion', 'route' => 'on_board_questions.store' , 'files' => true)) !!}
   
        <div class="panel panel-default">
            <div class="panel-heading">Create</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 form-group {{ $errors->has('name') ? ' has-error' : '' }} ">
                        {!! Form::label('title', 'Title', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::text('title', old('title'), ['id' => 'title', 'required' =>'required', 'class' => 'form-control', 'placeholder' => 'Title' ]) !!}
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
                        {!! Form::label('content', 'Content', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                        {!! Form::textarea('content', null, array('id' => 'content', 'class' => 'form-control', 'required' =>'required')) !!}

                        <p class="help-block"></p>
                        @if($errors->has('content'))
                            <p class="help-block">
                                {{ $errors->first('content') }}
                            </p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="box-footer text-center">          
                           <button type="submit" id="submit" class="btn btn-primary " >Submit</button>
                           <a href="\admin\on-board-questions" class="btn btn-danger ">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    {!! Form::close() !!}
 <script>
 $(document).ready(function(){
    CKEDITOR.replace( 'content');
  });   
 </script>

@endsection