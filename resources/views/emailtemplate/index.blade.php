@extends('layouts.app')

@section('content')

<script>
    function confirmDelete()
    {
        return confirm('Are you sure you want to delete Template?');
    }
    function confirmDeleteAll()
    {
        var template_list = $('#example').find(':checkbox');
        var selected_templates = new Array();
        for(var i=0;i<template_list.length;i++){
            if(template_list[i].checked){
                selected_templates[i] = template_list[i].value;
            }
        }
        $('#delete_template_form #selected_templates').val(selected_templates.join());
        if(selected_templates.length == 0) {
            alert('Please select any template first');
            return false;
        }
        if(confirm('Are you sure you want to delete selected Template?')){
            $('#delete_template_form').submit();
        }else {
            $('#example').find(':checkbox').removeAttr("checked");
        }
    }
</script>
<div class="m-b-md">
    <center><h2 class="m-b-none">Manage Templates </h2></center>
</div>

<section class="panel panel-default">
    <header class="panel-heading"></eader>

    <!-- display flash message -->
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))

          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
    </div>
    <!-- end flash-message -->

    @if (count($templatelist) > 0)
    <form id='delete_template_form' action='/template/deleteAll' method="post">
        {{ csrf_field() }}
        <input type="hidden" name="selected_templates" id="selected_templates" value="">
    </form>
    <button id="delete-admin-all" class="btn btn-danger" onclick="confirmDeleteAll();">Delete Template
    </button>
    @endif

    <div class="adv-table">
        <table class="display table table-bordered table-striped" id="example" >
          <thead>
            <tr>
                        <th width="20%"></th>
                        <th width="10%">Name</th>
                        <th width="10%">Subject</th>
                        <th width="20%"></th>

            </tr>
          </thead>
          <tbody>
              @if (count($templatelist) > 0)
                @foreach ($templatelist as $template)
                <tr class='gradeA'>
                        <td>
                            <input type="checkbox" name="template_{!!$template->id!!}" value="{!!$template->id!!}">
                        </td>
                        <td><a href="/emailtemplate/{{ $template->id }}">{{ $template->name }}</a></td>
                        <td>{{ $template->subject }}</td>
                        <td>
                            <form action="/emailtemplate/{{ $template->id }}" method="POST" onclick="return confirmDelete();">
                                {{ csrf_field() }}
				{{ method_field('DELETE') }}
                                <button type="submit" id="delete-template-{{ $template->id }}" class="btn btn-danger">
                                    <img src ="/images/delete_new.png"/>
				</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
              @endif
          </tbody>
      </table>
    </div>
</section>
@endsection