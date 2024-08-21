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
             
              <div class="col-md-6">

                <div class="box box-solid box-warning">
                  <div class="box-header with-border">
                    <h3 class="box-title">Booking Details</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    
                    <!-- <dl class="dl-horizontal"> -->
                    <div class="col-md-6">
                      <dl>
                      <dt>Booking Type :</dt>
                      <dd>
                          {{$bookingDetails['booking_type']}}
                          
                      </dd>
                      <br>
                      <dt>Booking Status :</dt>
                      <dd>
                        @if($bookingDetails['status'] == "confirmed") Booked
                        @elseif($bookingDetails['status'] == "rejected") Rejected
                        @elseif($bookingDetails['business_id'] != null && $bookingDetails['status'] == "requested")  Confirmation Pending
                        @endif
                      </dd>
                     
                      </dl>
                    </div>
                    <div class="col-md-6">
                      <dl>
                      <dt>Sport :</dt>
                      <dd>
                          {{@$sportsList[$bookingDetails['user_booking_detail']['sport']]}}
                          
                      </dd>
                      <br>
                      <dt>Created Date :</dt>
                      <dd>
                          <?php echo date('j<\s\up>S</\s\up> M Y', strtotime($bookingDetails['created_at'])); ?>
                      </dd>
                     
                      </dl>
                    </div>
                        
                     
                  </div>
                </div>

                @if(count($bookingDetails['businessuser']) > 0)
                        
                <div class="box box-solid box-info">
                  <div class="box-header with-border">
                    <h3 class="box-title">Professionals Details</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    
                     
                  </div>
                </div>

                @endif

              </div>
              
              <div class="col-md-6">

                <div class="box box-solid box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Customer Details</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    
                     
                  </div>
                </div>

              </div>

              <div class="col-md-12">

                <div class="box box-solid box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Questions</h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                  </div>
                  <div class="box-body">
                    
                     
                  </div>
                </div>
              </div>

            </div>
           </div>
          </div>
        </div>

          <div class="row">
            <div class="col-md-12" style="background-color: #fbfbfb !important">
              <div class="box-footer text-center">          
               <a href="\admin\bookings" class="btn btn-primary"><i class="fa fa-fw fa-mail-reply"></i> Return</a>
              </div>
            </div>
          </div>

        </div>
      </div>

@endsection