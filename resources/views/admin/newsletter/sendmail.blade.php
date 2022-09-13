@extends('admin.layouts.layout')

@section('content')

{!! Form::open(array('route' => 'send-newsletter')) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
          Add
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', 'Subject', ['class' => 'control-label']) !!} <span class="color-red">*</span>
                {!! Form::text('title', old('title'), ['id' => 'title', 'required' =>'required', 'class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 form-group {{ $errors->has('content') ? ' has-error' : '' }}">
               {!! Form::label('content', 'Message', ['class' => 'control-label']) !!} <span class="color-red">*</span>
               <textarea id="content" name="content" required>
               </textarea>
               @if($errors->has('content'))
                <p class="help-block">
                      {{ $errors->first('content') }}
                </p>
              @endif
              <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="box-footer text-center">          
                 <button type="submit" id="submit" class="btn btn-primary">Send Mail</button>
                 <a href="\admin\newsletters" class="btn btn-danger ">Cancel</a>
                </div>
              </div>
          </div>
        </div>
    </div>

{!! Form::close() !!}

<script>
    $(document).ready(function(){

    var ckconfig = {
      toolbarGroups: [
          {"name":"basicstyles","groups":["basicstyles"]},
          // {"name":"links","groups":["links"]}
          {"name":"paragraph","groups":["list","align"]},
          {"name":"insert","groups":["insert"]},
          {"name":"colors" },
          {"name":"document","groups":["mode"]},
          {"name":"styles","groups":["styles"]},
          {"name":"tools","groups":[ 'Maximize']},
        ],
        // Remove the redundant buttons from toolbar groups defined above.
        removeButtons: 'Strike,Subscript,Superscript,Anchor,Specialchar,NewPage,Save,ShowBlocks,Flash,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format',
        height : 350
      };

      CKEDITOR.replace( 'content', ckconfig );
  });
</script>

@endsection