@extends('admin.layouts.layout')



@section('content')

    

    <div id="systemMessage"></div>

    

    <div class="panel panel-default">



        <div class="panel-heading">

            List

        </div>



        <div class="panel-body">

            <div class="table-responsive">
              <table id="feedbacks_list" class="table table-bordered table-striped {{ count($feedbacks) > 0 ? 'datatable' : '' }} table-hover ">

                <thead>

                    <tr>

                      <th>#</th>

                      <th>Rating</th>

                      <th>User Name</th>

                      <th>Email Id</th>

                      <th>Comment</th>

                      <th>Suggestion</th>

                      <th>Created Date</th>

                      <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                @if (count($feedbacks) > 0)

                <?php $j = 0;?>

                    @foreach ($feedbacks as $value)

                      <?php $j++ ?>

                  <tr id="item-{!! $value->id !!}">

                  <td>{{$j}}</td>

                  <td nowrap="">

                    <div class="review-rate-block">

                      <div class="rate-star">

                          @for($i=1; $i<=$value->rating; $i++)

                            <span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>

                          @endfor                              

                          <?php $remaining_rating = 5 - $value->rating; ?>

                          @for($i=1; $i<=$remaining_rating; $i++)

                            <span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>

                          @endfor

                      </div>

                      

                    </div>

                  </td>

                  <td>

                    @if ($value->user_id > 0)

                     {{ $value->user_full_name }}

                    @else

                     {{ $value->name }}

                    @endif 

                  </td>

                  <td>

                    @if ($value->user_id > 0)

                     {{ $value->user_email }}

                    @else

                     {{ $value->email }}

                    @endif 

                  </td>

                  <td>{{ Str::limit($value->comment,25) }}</td>

                  <td>{{ Str::limit($value->suggestion,25) }}</td>

                  <td><?php echo date('j<\s\up>S</\s\up> M Y', strtotime($value->created_at)); ?></td>

                  <!-- <td>{{ date('jS M Y', strtotime($value->created_at)) }}</td> -->

                  <!-- <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td> -->

                  <td>
                    <a href="\admin\feedbacks\view\{{$value->id}}" title="Click for more details" class="btn btn-xs btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="\admin\feedbacks\delete\{{$value->id}}" title="Click for more details" class="btn btn-xs btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>

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



<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">



@endsection