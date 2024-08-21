@extends('admin.layouts.layout')

@section('content')

         <div class="panel panel-default">

            <div class="panel-heading">
            List
                <div class="col-md-6 pull-right"><a href="{{route('vatted_business_faq')}}" class="btn btn-xs btn-info pull-right"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i></a></div>
            </div>
             <div class="panel-body">
                 
                   {!! Form::open(array('url' => route('vatted_business_faq_create'))) !!}
                    
                    <div class="form-group">
                    {!! Form::label('Question', 'Question') !!}
                    
                    {!!Form::text('question','',['class'=>'form-control'])!!}
                    
                    </div>
                    <div class="form-group">
                    {!! Form::label('Answer', 'Answer') !!}
                    
                    <textarea id="answer_content" name="answer_content" required>
                    
                    </textarea>
                    </div>
                    {!!Form::submit('ADD',['class'=>'btn active btn-success'])!!}
                    {!! Form::close() !!}
                       
             </div>

        </div>
<script>
 $(document).ready(function(){
    CKEDITOR.replace( 'answer_content');
  });   
 </script>
@endsection