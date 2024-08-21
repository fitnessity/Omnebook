@extends('admin.layouts.layout')
@section('content')

    <div id="systemMessage"></div>
    <p><a href="{!! route('on_board_questions.create') !!}" class="btn btn-success">Add New</a></p>

    <div class="panel panel-default">
        <div class="panel-heading">List</div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="plan_list" class="table table-bordered table-striped {{ count($questions) > 0 ? 'datatable' : '' }} table-hover ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
                    @if (count($questions) > 0)
                        @foreach ($questions as $i=>$value)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{@$value->title}}</a></td>
                                <td>{!! $value->content !!}</td>
                                <td>
                                    <a href="on-board-questions/edit/{{$value->id}}" title="Click to edit {{@$value->title}}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                    <a onClick="confirmDelete({{ $value->id }})" href="javascript:void(0);" title="Click to Delete" class="delete-item btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">no record found</td>
                        </tr>
                    @endif
                </tbody>
                
            </table>
        </div>
        </div>
    </div>

<script type="text/javascript">
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this FAQ's Code?")) {
            window.location.href = "/admin/on-board-questions/delete/" + id;
        }
    }
</script>

@endsection