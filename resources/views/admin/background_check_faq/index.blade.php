@extends('admin.layouts.layout')

@section('content')
         <div class="panel panel-default">

            <div class="panel-heading">
            List
                
                <div class="col-md-6 pull-right"><a href="{{route('background_check_faq-add')}}" class="btn btn-xs btn-info pull-right"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
            </div>
             <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        
                        <th scope="col">Question</th>
                        <th scope="col">Answer</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    @foreach ($help as $record)
                        <tr>
                         
                        <td>{{substr($record->qustion,0,50)}}</td>
                        <td>{{substr(strip_tags($record->answer),0,50)}}</td>
                        <td>
                        <a href="{{route('background_check_faq_view',['id'=>$record->id])}}" title="Click for more details" class="btn btn-xs btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a href="{{route('background_check_faq_delete',['id'=>$record->id])}}" title="Click for more details" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div> 
                    {!! $help->render() !!}
             </div>

        </div>
@endsection
{{--   <nav aria-label="Page navigation example">
            <ul class="pagination">
            <li class="page-item"><a class="page-link" href="{{$help->previousPageUrl()}}"><< Prev</a></li>
            <li class="page-item"><a class="page-link" href=" {{$help->nextPageUrl()}}">Next</a></li>
            <li class="page-item"><a class="page-link" href=" {{$help->lastPage()}}">Last >></a></li>
            </ul>
            </nav>  --}}