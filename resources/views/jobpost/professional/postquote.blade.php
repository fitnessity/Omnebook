@extends('layouts.profile')

@section('content')

<!-- <section class="direc-hire"> -->

<!-- <div class="direc-right"> -->

<div class="business-offer-main">

    @include('includes.sidebar_profile_left')

    <div class="business-middle">    
    <div class="network_block nw-profile_block">
        <div style="padding-left:20px;text-transform:uppercase;">
                  <?php $quote_limit_reach  = 0; ?>
                    @if(@$totalAndMaxQuotesForBooking['total_quotes'] == 0)
                      <span class="boking-openall-text">Be the first to quote this.</span>
                    @elseif(@$totalAndMaxQuotesForBooking['total_quotes'] > 0)
                      @if(@$totalAndMaxQuotesForBooking['total_quotes'] == @$totalAndMaxQuotesForBooking['max_quotes'] && count($userQuote)==0)
                        <?php $quote_limit_reach  = 1; ?>
                        <span class="booking-rejected-text">Sorry, no more quotes are allowed for this job.</span>
                      @elseif(count($userQuote)==0)
                        <span class="booking-pending-text">Hurry up, Only {!! ( @$totalAndMaxQuotesForBooking['max_quotes'] - @$totalAndMaxQuotesForBooking['total_quotes']) !!} Quote/s remaining.</span>
                      @endif
                    @endif
                  </div>

        <div class="social-connect">
            <div class="row">
                <div class="nw-dtl-edit">
                  <div id='systemMessage_booking'></div>                  
                </div>
                @if($quote_limit_reach == 0 || count($userQuote)>0)
                <div class="nw-user-detail-block">
                    @if(count($userQuote)>0)
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail" id="quote_detail_div">
                        @if($data['jobsObj']['status'] == "requested" && $data['jobsObj']['business_id'] == null)
                        <div style="float: right">
                            <a class="btn btn-primary" href="javascript:void(0);" id="edit_quote" aria-label="Edit" title="Edit Quote">
                              <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            &nbsp;&nbsp;
                            <a class="btn btn-danger" href="javascript:void(0);" id="delete_quote" aria-label="Delete" title="Delete Quote">
                              <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </div>
                        @endif
                        <div class="form-control">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <label>Quote Price</label>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <label id="quote_price_val">{{$userQuote['quote_price']}}</label>
                            </div>
                        </div>

                        <div class="form-control">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <label>Rate Type</label>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <label id="quote_price_val">{{$userQuote['rate_type']}}</label>
                            </div>
                        </div>
                        <div class="form-control">
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <label>Quotes</label>
                            </div>
                            <div class="col-lg-10 col-md-1 col-sm-12 col-xs-12">
                                <p id="quote_desc_val">
                                    <?php
                                    $quote = str_replace(PHP_EOL,"<br>",$userQuote['quote']);
                                    echo $quote;
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-control"></div>
                    </div>
                    @endif
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail" style="display:none;" id="quote_form_div">
                        {!! Form::open(array('id' => 'frmPostQuote')) !!}
                            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                            <input type="hidden" name="booking_id" value="{{ $data['jobsObj']['id'] }}">
                            <input type="hidden" name="quote_id" id="quote_id" value="">
                            <div class="form-control">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <label>Quote Price</label>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <input type="text" name="quote_price" id="quote_price" value="$">
                                </div>
                            </div>
                            
                            <div class="form-control">
                              <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                  <label>Rate Type</label>
                              </div>
                             
                              <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                  <!-- <label><input type="radio" class="chk" value="hourly" name="rate_type" autocomplete="off" id="rate_type_hourly"> Hourly</label>
                                  <label><input type="radio" class="chk" value="weekly" name="rate_type" autocomplete="off" id="rate_type_weekly"> Weekly</label> -->

                                  <div class="quote_rate_type">
                                  <div class="col-md-3 qh-steps-form">
                                    <div class="form-control">
                                        <div class="btn-group rate_type_hourly nw-dtl-edit" data-toggle="buttons">
                                            <label class="btn btn-primary">
                                            <input type="radio" class="chk" value="hourly" name="rate_type" autocomplete="off"> 
                                            <span class="glyphicon glyphicon-ok"></span> </label>
                                            <span>Hourly</span>
                                        </div>
                                    </div>
                                    
                                  </div>
                        
                                  <div class="col-md-3 qh-steps-form">
                                    <div class="form-control">
                                      <div class="btn-group rate_type_weekly nw-dtl-edit" data-toggle="buttons">
                                        <label class="btn btn-primary">
                                          <input type="radio" class="chk" value="weekly" name="rate_type" autocomplete="off">
                                          <span class="glyphicon glyphicon-ok"></span> </label>
                                          <span>Weekly</span>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3 qh-steps-form"></div>
                                  </div>
                  
                              </div>
                            </div>
                            <div class="form-control">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <label>Quotes</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                    <textarea name="quote_desc" id="quote_desc" style="height: 198px;"></textarea>
                                </div>
                            </div>
                            <div class="form-control"></div>
                            <div class="form-control">                                
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <button class="nw-view-profile" id="save_quote">Post Quote</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="nw-user-detail-line"></div>
                </div>
                @endif
            </div>
        </div>
        
        <div class="row">
        <div class="nw-user-detail-block">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
            <div class="nw-user-img">
              <?php
              $userDetail = $data['jobsObj']['user'];
              if($userDetail['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$userDetail['profile_pic'])) {
                echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$userDetail['profile_pic'].'" width="254" height="275" id="display_user_profile_pic" />';
              }
              else {
                echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="254" height="275" id="display_user_profile_pic" />';
              }
              ?>
            </div>
          </div>
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">
            <h1 class="nw-user-nm" style="width:65% !important;">{{ $userDetail['firstname']." ".$userDetail['lastname'] }}</h1>            
            <!-- <p>Lobortis nisl ut aliquip ex ea commodo  Duis autem vel eum iriure 
              dolor in hendrerit in vulputate velit esse molestie consequat </p> -->
            <div class="nw-user-edit">
              <a href="javascript:void();" style="float: right" data-toggle="modal" data-target="#editProfileDetailModal">
              </a>
              <div class="nw-dtl-edit">
                <span class="nw-label">Company Name:</span>
                <span id="display_user_company">{{ $userDetail['company_name'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Name:</span>
                <span id="display_user_name">{{ $userDetail['firstname'] }} {{ $userDetail['lastname']}}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Email : </span><span>{{ $userDetail['email'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label" id="display_user_phone">Phone : </span><span>{{ $userDetail['phone_number'] }}</span>
              </div>
              <div class="nw-dtl-edit">
                <span class="nw-label">Address :  </span>
                <span class="nw-detail-txt" id="display_user_address">
                  {{ $userDetail['address'] }}
                  <div class="clearfix"></div>
                  <a href="#"><i class="fa fa-phone"></i></a><a href="#"><i class="fa fa-map-marker"></i></a><a href="#"><i class="fa fa-envelope"></i></a>
                </span>
              </div>
            </div>
          </div>
          <div class="nw-user-detail-line"></div>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="row">
        @if($data['jobsObj']['booking_type'] == "direct")
            <?php $UserBookingDetail = $data['jobsObj']['user_booking_detail']; ?>
            <div class="nw-user-detail-sumry">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-sumry">
                    <h1>Sport</h1>
                    <span class="timenplace border-rgt">
                    </span>
                    <div class="clearfix"></div>
                    <p>{{@$sportsList[$UserBookingDetail['sport']]}}</p>
                    <div class="clearfix"></div>
                    <div class="nw-user-detail-line full-width"></div>
                  </div>
              </div>
              <div class="nw-user-detail-sumry">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-sumry">
                    <h1>Booking Details</h1>
                    <span class="timenplace border-rgt">
                    </span>
                    <div class="clearfix"></div>
                    <p>
                        <?php 
                        $detail = substr(str_replace(PHP_EOL,"<br>",$UserBookingDetail['booking_detail']), 0, 500);
                        echo $detail;
                        ?>
                    </p>
                    <div class="clearfix"></div>
                    <div class="nw-user-detail-line full-width"></div>
                  </div>
              </div>
          @else
            <?php $jobpostquestions = $data['jobsObj']['jobpostquestions']; ?>
            @if(count($jobpostquestions) > 0)              
              @foreach($jobpostquestions as $k => $job)
                <div class="nw-user-detail-sumry">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-sumry">
                    <h1>{{$job['question']}}</h1>
                    <!-- <a href="#" class="pull-right"><i class="fa fa-pencil"></i></a> -->
                    <!-- <div class="clearfix"></div> -->
                    <span class="timenplace border-rgt">
                    </span>
                    <!-- <span class="timenplace"></span> -->
                    <div class="clearfix"></div>
                    <!-- <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. </p> -->
                    <p>
                      @if($job['full_answer'] == '')
                        {{$job['answer']}}
                      @else
                        {{$job['full_answer']}}
                      @endif
                    </p>
                    <p>{{$job['other']}}</p>
                    <div class="clearfix"></div>
                    <div class="nw-user-detail-line full-width"></div>
                  </div>
                </div>
              @endforeach
            @endif
          @endif
      </div>

    </div>
  </div>
  @include('includes.sidebar_profile_right')
</div>
<!-- </div> -->
<!-- </section> -->
<script>
$(document).ready(function(){
    
    var userQuote = <?php echo json_encode($userQuote); ?>;
    var quote_limit_reach = <?php echo $quote_limit_reach;?>;
    if(userQuote.length == 0 && !quote_limit_reach)
        $("#quote_form_div").show();
    
    $("#delete_quote").click(function(){
        if(confirm("Are you sure to delete this quote ?")) {
            $.ajax({
                url:'/booking/deletepostquote',
                type:'POST',
                dataType: 'json',
                data: 'id='+userQuote.id + "&_token="+$('input[name="_token"]').val(),
                beforeSend: function () {
                  $("#frmPostQuote").css('opacity', '0.5');
//                  showSystemMessages('#systemMessage_booking', 'info', 'Please wait while we delete your quote.');
                },
                complete: function () {
                  $("#frmPostQuote").css('opacity', '1');
                },
                success: function (response) {
                    showSystemMessages('#systemMessage_booking', response.type, response.msg);
                    $("#quote_detail_div").hide();
                    $("#quote_form_div").show();
                }
          });
        }
    });
   
    $("#edit_quote").click(function(){
        $("#quote_id").val(userQuote.id);
        $("#quote_price").val(userQuote.quote_price);
        $("#quote_desc").html(userQuote.quote);
        $(".rate_type_"+userQuote.rate_type).find("input[type='radio']").prop("checked", true);
        $(".rate_type_"+userQuote.rate_type).find('label').addClass('active');
        $("#quote_detail_div").hide();
        $("#quote_form_div").show();
    });
    $("#cancel_edit").click(function(){
        $("#quote_detail_div").show();
        $("#quote_form_div").hide();
    })

    $("#quote_price").keydown(function(e) {
       var field=this;
       setTimeout(function () {
           if(field.value.indexOf('$') !== 0) {
               $(field).val('$');
           } 
       }, 1);
    });

    $("#frmPostQuote").submit(function(e) {
        e.preventDefault();
        var msg = '';
        var returnVal;
        returnVal = true;                
        if($("#quote_price").val() == "") {
            msg += '<br>Enter Quote Price';
            returnVal = false;
        }else {
            var price = $("#quote_price").val();
            var valid = /^\$?(\d{1,3}(\,\d{3})*|(\d+))(\.\d{0,2})?$/.test(price);                    
            if(!valid) {
                msg += '<br>Enter proper Quote Price';
                returnVal = false;
            }
        }
        if(!$("input:radio[name='rate_type']").is(":checked")) {
            msg += '<br>Select Rate Type';
            returnVal = false;
        }
        if($("#quote_desc").val() == "") {
            msg += '<br>Enter Quote';
            returnVal = false;
        }
        if(!returnVal) {
            showSystemMessages('#systemMessage_booking', 'danger', msg);
            return false;
        }
        var inputData = new FormData($(this)[0]);
        $.ajax({
            url:'/booking/savepostquote',
            type:'POST',
            dataType: 'json',
            data:inputData,
            processData:false,
            contentType:false,
            beforeSend: function () {
              $('#save_quote').attr('disabled', true);
              $("#frmPostQuote").css('opacity', '0.5');
              showSystemMessages('#systemMessage_booking', 'info', 'Please wait while we save your quote.');
            },
            complete: function () {
              $('#save_quote').attr('disabled', false);
              $("#frmPostQuote").css('opacity', '1');
            },
            success: function (response) {
                showSystemMessages('#systemMessage_booking', response.type, response.msg);
                if(response.type != 'danger'){
                  setTimeout(
                  function() 
                  {
                    location.reload();
                  }, 1000);
                }
            }
        });
    });

    $("label.btn").click(function() {
              // find clicked button radio option name
              var radio_option = $(this).find('input[type=radio]');
              if ($(radio_option).is(':radio')) {
                var radio_option_name = $(radio_option).attr('name');
                // make all other options to null
                $('input[type=radio][name="'+radio_option_name+'"]').each(function() {
                  $(this).closest('label.btn').removeClass('active');
                });
                // make current selection active
                $(this).addClass('active');
              }              
        });   
});
</script>
@endsection