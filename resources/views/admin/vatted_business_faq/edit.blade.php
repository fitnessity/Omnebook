@extends('admin.layouts.layout')

@section('content')

         <div class="panel panel-default">

            <div class="panel-heading">
            List
                <div class="col-md-6 pull-right"><a href="{{route('vatted_business_faq')}}" class="btn btn-xs btn-info pull-right"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a></div>
            </div>
             <div class="panel-body">
                   {!! Form::open(array('url' => route('vatted_business_faq_update'))) !!}
                   <input type="hidden" value="{{$help->id}}" name="id">
                     
                    <div class="form-group">
                    {!! Form::label('Question', 'Question') !!}
                    
                    {!!Form::text('question', $help->qustion,['class'=>'form-control'])!!}
                    
                    </div>
                    <div class="form-group">
                    {!! Form::label('Answer', 'Answer') !!}
                    
                    <textarea id="answer_content" name="answer_content" required>
                    {{$help->answer}}
                    </textarea>
                    </div>
                    {!!Form::submit('Update',['class'=>'btn active btn-success'])!!}
                    {!! Form::close() !!}
                       
             </div>

        </div>
<script>
 $(document).ready(function(){
    CKEDITOR.replace( 'answer_content');
  });   
 </script>
@endsection