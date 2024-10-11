@extends('admin.layouts.layout')

@section('content')
   
      <div class="panel panel-default">
        <div class="panel-heading">
          View
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-xs-12 form-group">
               <div class="box box-solid">
            <div class="box-header with-border">
              <!-- <i class="fa fa-text-width"></i>

              <h3 class="box-title">View Feedback</h3> -->
            </div>
            
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>User Name :</dt>
                <dd>
                    @if ($feedback_detail->user_id > 0)
                     {{ $feedback_detail->user_full_name }}
                    @else
                     {{ $feedback_detail->name }}
                    @endif 
                </dd>
                <br>
                <dt>Email Id :</dt>
                <dd>
                    @if ($feedback_detail->user_id > 0)
                     {{ $feedback_detail->user_email }}
                    @else
                     {{ $feedback_detail->email }}
                    @endif 
                </dd>
                <br>
                <dt>Rating :</dt>
                <dd>
                  <div class="review-rate-block">
                      <div class="rate-star">
                          @for($i=1; $i<=$feedback_detail->rating; $i++)
                            <span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>
                          @endfor                              
                          <?php $remaining_rating = 5 - $feedback_detail->rating; ?>
                          @for($i=1; $i<=$remaining_rating; $i++)
                            <span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>
                          @endfor
                      </div>
                    </div>
                </dd>
                <br>
                <dt>Comment :</dt>
                <dd>{{ $feedback_detail->comment }}</dd>
                <br>
                <dt>Suggestion :</dt>
                <dd>{{ $feedback_detail->suggestion }}</dd>
                <br>
                <dt>Created Date :</dt>
                <dd><?php echo date('j<\s\up>S</\s\up> M Y', strtotime($feedback_detail->created_at)); ?></dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="box-footer text-center">          
               <a href="\admin\feedbacks" class="btn btn-primary"><i class="fa fa-fw fa-mail-reply"></i> Return</a>
              </div>
            </div>
          </div>

        </div>
      </div>

@endsection