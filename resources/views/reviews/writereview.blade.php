<?php /*@extends('layouts.profile')

@section('content') */ ?>
<?php /*
<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>sweet-alert/sweetalert.css" rel="stylesheet">
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>sweet-alert/sweetalert.min.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>bootstrap-select.min.js"></script> 
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap-select.min.css"> 
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>bootstrap-select.min.js"></script> 
*/?>
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap-select.min.css"> 
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>ratings.js"></script>
<?php /*
<div class="business-offer-main">

    @include('includes.sidebar_profile_left')

  <div class="business-middle">

   

    <div class="review-btns">
      <div class="row" style="margin-bottom: 25px;">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <a href="/reviews/add" class="review-btn-links pull-left mrgn-rght8 active">Write Reviews</a>
                <a href="/reviews" class="review-btn-links pull-left ">Reviews for me</a>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
              <div class="dropdown  review-follow pull-right">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Follow <i class="fa fa-angle-down"></i> </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Lorem ipsum</a></li>
                  <li><a href="#">Lorem ipsum</a></li>
                  <li><a href="#">Lorem ipsum</a></li>
                </ul>
             </div>
            <a href="#" class="review-btn-links pull-right mrgn-rght8">34,546 Followers</a>                
            </div>
            <div class="clearfix"></div>
        </div>
    </div> */ ?>

    <!-- <form id="frmReview" method="post" action="/reviews/save"> -->
    {!! Form::open(array('id' => 'frmReview')) !!}
      {!! csrf_field() !!}

       <div class="review-dtl-block">
        <div class="nw-dtl-edit"><div id='systemMessage_review'></div></div>
        
          <div class="write-review-form">
             
              <div class="src-reviw-topic form-review-slct">
                  
                 <!-- <select class="form-control">
                                            <option>New York</option>
                            <option>California</option>
                            <option>Las Vegas</option>
                            <option>Texas</option>
                            </select>-->
                   <select class="selectpicker" data-style="btn-primary" > 
                           <option>New York</option> 
                           <option>California</option> 
                         <option>Las Vegas</option> 
                           <option>Texas</option> 
                        </select> 
                 <span>SELECT COUNTRY</span> 
               
            </div>
            </div>
         <div class="clearfix"></div>
         <div class="write-review-form">
             <div class="review-form-block rvw-ex-mrgn">
              <div class=" form-review-slct form-review-slct1 ">
                  
                  
                  {!! Form::select('reviewfor_userid', $professional, '', ['class' => 'selectpicker', 'data-style' => 'btn-primary']) !!}
              </div>
            </div>
            <div class="rvw-overall">
              <input type="hidden" name="rating" id="rating" value="0">
              <div class="rvw-overall-rate rvw-ex-mrgn">
                <span>overall</span>
                <div id="stars" class="starrr"></div>
              </div>
                
              <div class="review-form-block rvw-ex-mrgn">
              <div class="row">
                  <div class="col-md-9 col-sm-12 col-xs-12">
                      <input  type="text" name="title" class="rvw-input @if ($errors->has('title')) field-error @endif" placeholder="Title"/>
                    </div>
                    
                </div>
            </div>
            <div class="review-form-block">
              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 rvw-ex-mrgn">
                      <textarea name="review" id="reviewDescription" class="rvw-input @if ($errors->has('review')) field-error @endif" placeholder="Review (atleast 30 words)"></textarea>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <button class="rvw-button" id="saveBtn"> SAVE</button>
                    </div>                  
                </div>
            </div>
            </div>
         </div>

        </div>
      {!! Form::close() !!}
      <div class="clearfix"></div>

    <div class=" review-dtl-block">
        @foreach($ownreviews as $ownreview)
          <div class="review-list-block" id="reviewId-{{ $ownreview->id }}">
          <div class="row">
               <div class="col-lg-2 col-md-2 col-sm-7 col-xs-12">
                  <span class="review-user">
                    <?php
                    $reviewForUser = getUserById($ownreview['reviewfor_userid']);
                    $imgUrl = Config::get('constants.FRONT_IMAGE').'user.png';

                    if($reviewForUser->profile_pic != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$reviewForUser->profile_pic)) 
                    {
                      $imgUrl = Config::get('constants.USER_IMAGE_THUMB150').$reviewForUser->profile_pic;
                    }
                    ?>
                    <img src="<?php echo $imgUrl;?>" width="352" height="314" title="<?php echo $reviewForUser->firstname. ' '.$reviewForUser->lastname;?>" />
                  </span>
                 </div>
                 <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
                  <div class="review-detail" id="reviewContent-{{ $ownreview->id}}">
                      <h1>{{ ucwords($reviewForUser->firstname. ' '.$reviewForUser->lastname)  }}</h1>  
                      <p>{{ $ownreview->title }}</p>
                      
                        <div class="review-rate-block">
                          <div class="rate-star">
                            <?php 
                              $remaining_rating = 5 - $ownreview->rating; ?>
                              @for($i=1; $i<=$remaining_rating; $i++)
                                <span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>
                              @endfor
                              @for($i=1; $i<=$ownreview->rating; $i++)
                                <span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>
                              @endfor                              
                          </div>
                          <span class="fontt14"><?php echo date('j<\s\up>S</\s\up> M Y', strtotime($ownreview->created_at)); ?></span>
                        </div>
                        <div class="clearfix"></div>
                        <p><?php echo nl2br($ownreview->review); ?></p>

                        <div class="like-div" style="border:none !important;">
                            <ul>
                              <li>
                                  <a href="javascript:void(0);" class="edit-review" data-image="<?php echo $imgUrl;?>" data-review-for="<?php echo ucfirst($ownreview->reviewfor['firstname']). ' '.ucfirst($ownreview->reviewfor['lastname']);?>" data-star="{{ $ownreview->rating }}"  data-review="{{ $ownreview->review }}"  data-title="{{ $ownreview->title }}" data-id="{{ $ownreview->id }}">
                                  Edit
                              </a>  
                              </li>
                              <li><i class="fa fa-circle" aria-hidden="true"></i></li>
                              <li>
                                  <a href="javascript:void(0);" class="delete-review" data-id="{{ $ownreview->id }}">
                                    Delete
                                  </a>
                              </li>
                            </ul>                          
                        </div>

                    </div>
                 </div>
            </div>
        </div>
        @endforeach
          <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-17 col-xs-12">
                  {!! $ownreviews->render() !!}
               </div>
          </div>
      </div>

  </div>
<?php /*
  @include('includes.sidebar_profile_right')

</div> */ ?>

<!-- Modal -->
 <div class="modal fade" id="editReviewModalBox" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content" id="modalBoxBody">
          <div class="modal-body login-pad">

                <div class="pop-title employe-title">
                    <h3>EDITz REVIEW</h3>
                </div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                  <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div class="signup">
                    <div class="emplouyee-form">
                        <div class="write-review-form">
                            <div class="review-form-block rvw-ex-mrgn">
                                <div class=" form-review-slct form-review-slct1 ">
                                </div>
                            </div>
                            <div class="rvw-overall">
                                <div id="reviewFor" class="rvw-ex-mrgn"></div>                                
                                <div class="rvw-overall-rate rvw-ex-mrgn">
                                    <span>overall</span>
                                    <div id="modalboxstars" class="starrr modalBoxstarrr"></div>
                                </div>
                                <input id="title"  type="text" name="title" class="rvw-input @if ($errors->has('title')) field-error @endif" placeholder="Title"/>
                                <textarea name="review" id="review" class="rvw-input @if ($errors->has('review')) field-error @endif" placeholder="Review (atleast 30 words)"></textarea>
                            </div>
                            <div class="by-sign">
                                <button class="btn btn-primary update-review-btn"> Update </button>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>        
        <input type="hidden" id="modalboxReviewId" name="modalboxReviewId" value='0'>
        <input type="hidden" id="modalBoxrating" name="modalBoxrating" value='0'>
      </div>      

    </div>
  </div>

<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">

<script>
    var moduleConfig = {
            updateReviewURL : "{!! route('reviews.update-review') !!}",
            deleteReviewURL : "{!! route('reviews.delete-review') !!}"
    };

    jQuery(document).ready(function()
    {
        $("#frmReview").submit(function(e) {
          e.preventDefault();
          var msg = '';
          var returnVal;
          returnVal = true;
          if(jQuery("#reviewDescription").val().length < 30 )
          {
            msg += '<br>Reveiw at least 30 words required';
            returnVal = false;
          }
          if(!returnVal) {
              showSystemMessages('#systemMessage_review', 'danger', msg);
              return false;
          }
          // var inputData = new FormData($(this)[0]);
          var formData = $("#frmReview").serialize();
          $.ajax({
              url:'/reviews/save',
              type:'POST',
              dataType: 'json',
              data:formData,
              beforeSend: function () {
                $('#saveBtn').attr('disabled', true);
                $("#frmReview").css('opacity', '0.5');
                // showSystemMessages('#systemMessage_review', 'info', 'Please wait while we save your quote.');
              },
              complete: function () {
                $('#saveBtn').attr('disabled', false);
                $("#frmReview").css('opacity', '1');
              },
              success: function (response) {
                  showSystemMessages('#systemMessage_review', response.type, response.msg);
                  setTimeout(
                  function() 
                  {
                    location.reload();
                  }, 1000);                
              }
          });
      });
         
      jQuery('.fa-star').click(function() 
      {
        var selected_star = this.id.split("_");
        jQuery('#rating').val(selected_star[1]);
      });

      jQuery(document).on('click', '.modalBoxstarrr', function(){
        var startCount = jQuery("#modalboxstars").find(".glyphicon-star").length;
        jQuery('#modalBoxrating').val(startCount);
      });


        jQuery(document).on('click', '.edit-review', function(event)
        {
          prepareEditReview(this);
        });

        jQuery(document).on('click', '.update-review-btn', function()
        {
          updateReview();
        });

        jQuery(document).on('click', '.delete-review', function()
        {
          deleteReview(this);
        });
    });

function prepareEditReview(element)
{
    
    jQuery("#review").val(jQuery(element).attr('data-review'));
    jQuery("#title").val(jQuery(element).attr('data-title'));
    jQuery('#modalBoxrating').val(jQuery(element).attr('data-star'));
    jQuery("#modalboxReviewId").val(jQuery(element).attr('data-id'));
    var image   = jQuery(element).attr('data-image'),
        Boxhtml = '<div class="col-md-12">'
                + ' <div class="row">'
                + '     <div class="col-md-12">'
                + '         <img style="border-radius: 100%;" width="100px" height="100px"  src="'+image+'">'
                + '             <h4>'+jQuery(element).attr('data-review-for')+' </h4>'
                + '     </div>'
                + ' </div>'
                + '</div>'
                + '<div class="col-md-12"></div>'
                + '<div class="clearfix"></div>';
//        Boxhtml = '<div class="col-md-12">'
//                + ' <div class="row">'
//                + '     <div class="col-md-4">'
//                + '         <img style="border-radius: 100%;" width="100px" height="100px"  src="'+image+'">'
//                + '     </div>'
//                + '     <div class="col-md-8" style="text-align:left;" height="100px">'
//                + '         <h4>'+jQuery(element).attr('data-review-for')+' </h4>'
//                + '     </div>'
//                + ' </div>'
//                + '</div>'
//                + '<br><br><br>'
//                + '<div class="clearfix"></div>';
    
    jQuery("#reviewFor").html(Boxhtml);

    
    var html = '';
    for(var i=1; i <=5; i++)
    {
      if(i <= jQuery(element).attr('data-star'))
      {
        html += '<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>';
      }
      else
      {
          html += '<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>';
      }
    }
    jQuery("#modalboxstars").html(html);
    jQuery('#editReviewModalBox').modal('show'); 
}

function deleteReview(element)
{
  var reviewId = jQuery(element).attr('data-id'),
      status   = confirm("Are you sure you want to Delete Review ?");

  if(status == false)
  {
    return;
  }

  jQuery.ajax(
  {
      url:        moduleConfig.deleteReviewURL,
      type:       'POST',
      dataType:   'JSON',
      data: {
          'id':     reviewId,
          '_token': jQuery("#ajaxToken").val(),
      },
      success: function(data)
      {
          if(data.status == true)
          {
            jQuery("#reviewId-"+reviewId).remove();
          }
          else
          {
            alert("Something went wrong!");
          }
      },
      error: function(data)
      {
        alert("Something went wrong!");
      }
  });
}

function updateReview()
{
  jQuery.ajax(
  {
      url:        moduleConfig.updateReviewURL,
      type:       'POST',
      dataType:   'JSON',
      data: {
          'id':     jQuery("#modalboxReviewId").val(),
          'review': jQuery("#review").val(),
          'title':  jQuery("#title").val(),
          'rating': jQuery("#modalBoxrating").val(),
          '_token': jQuery("#ajaxToken").val(),
      },
      success: function(data)
      {
          if(data.status == true)
          {
            jQuery('#editReviewModalBox').modal('hide');
            location.reload();
          }
          else
          {
            alert("Something went wrong!");
          }
      },
      error: function(data)
      {
        alert("Something went wrong!");
      }
  });
}
</script>
<script>
    $(document).ready(function() {
      var link = "<?php echo Config::get('constants.FRONT_JS'); ?>bootstrap-select.min.js";
      $.getScript(link)
      .done(function() {
        $('.selectpicker').selectpicker();
      });
    });
</script>
<?php // @endsection ?>