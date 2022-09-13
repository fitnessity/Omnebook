@extends('layouts.header')
@section('content')
<style>
.category {
    float: left;
    width: 100%;
    padding: 102px 100px 65px 50px;
    background-size: 100% 100%;
    background-position: right;
}
.cate-list {
  padding: 0 15px;
 
}
.viewallcontainer .cate-list {
  float: left;
}
/*.viewallcontainer .cat-item .cat-img-name-allsport-img {
  width: 91.1% !important;
  height: 383px;
}*/
.viewallcontainer .cat-item {
    float: left;
    width: 23%;
    margin-bottom: 20px;
    margin-right: 30px;
}
.cat-img-name.width-img {
    height: 390px;
}

.cat-img-name .sports_name span{
	height: 11px;
	top: 25%;
    background: #f53b49;
    padding: 20px;
	text-align: left;
}
.cat-img-name .sports_name{
    background-color: unset;
}
.cat-item h1 {
  font-size: 20px;
}
.cat-item a{padding: 6px 15px;}
.pop-search-detail-sports h5{
	font-size: 14px;
	text-align: center;
}
.viewallcontainer .cate-list .cat-item .cat-detail {
  background: rgba(21, 24, 31, .89);
}
.style_prevu_sp span:hover .pop-search-detail-sports {
  opacity: 1;
  bottom: 135px;
}
.pop-search-detail-sports {
    right: 12px;
}
.cat-item:hover .cat-img-name img, .cat-item:hover .cat-img-name .sports_name {
  transform: scale(1.25);
}
.form-review-slct div.dropdown-menu{
  min-width: 45%;
}
.cat-item:hover .sports_name{
    display: none;
}
.cat-item:nth-child(5n) {
    margin-right: unset;
}
@media (max-width: 481px)
{
    .cat-img-name .sports_name span {
        line-height:0px;
		top: 20%;
    }
}
@media screen and (min-width: 768px) and (max-width: 991px)
{
    .cat-img-name .sports_name span {
        left: -47%;
        position: absolute;
		top: -20%;
		justify-content: left;
    }
    .pop-search-detail-sports {
        width: 100%;
        right: 0;
    }
}
@media screen and (min-width: 1900px) and (max-width: 2500px)
{
    .cat-img-name .sports_name span {
        left: -45%;
	position: absolute;
	top: 10%;
		justify-content: left;
    }
    .pop-search-detail-sports {
        width: 100%;
        right: 0;
    }
	.cat-container{  max-width: 99%;}
	.src-reviw-topic{width: 77%;}
}

</style>

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>bootstrap-select.min.js"></script> 
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap-select.min.css">
<section class="category viewallcontainer">
    <div class="cat-container">
        <div class="categoryfilter width-auto">
            <div class="src-reviw-topic form-review-slct">
                <span class="title">SELECT CATEGORY</span>
                <select id="categorySelection" class="selectpicker" data-style="btn-primary" >
                    <option id="category_id_most" value="category_id_most">MOST SEARCHED</option>
                    @foreach($product_categories as $key => $value)
                        <option id="category_id_{{$value->id}}" value="category_id_{{$value->id}}">{{$value->category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
	</div>	

    <div class="cate-list col-3 col-sm-12 col-md-3 col-lg-3">
        @if(count($all_sports) > 0)
            @foreach($all_sports as $sports_key => $sports_value)
                @if($sports_key%4 == 0)
                    <div class="row" style="margin-bottom:15px;"></div>
                @endif
                <div class="cat-item style_prevu_sp width-auto">
                    <span>
                        <div class="cat-img-name width-img">
                            
                            <img class="cat-img-name-allsport-img" src="<?php echo Config::get('constants.SPORTS_IMAGE_THUMB'); ?>{{ $sports_value->image }}"/>
                            <span>
                                <div class="sports_name">
                                    <span>{{ $sports_value->sport_name }}</span>
                                </div>
                            </span>
                            <p>&nbsp;</p>
                            <div class="pop-search-detail-sports">
                                <h4>{{ $sports_value->sport_name }}</h4>
                                @if(!empty($sports_value->description))
                                    <h5>{{ $sports_value->description }}</h5>
                                @endif
                            </div>
                        </div>
                        <div class="cat-detail">
                            <h1>{{ $sports_value->sport_name }}</h1>
                            @if($sports_value->has_child == 1)
                                <a type="button" data-toggle="modal" data-target="#child_sports_modal" href="/home/jsModalChildSports/{{ $sports_value->id }}">Book Now</a>
                            @else
                                @if(Auth::user())
                                    @if($sports_value->booking_option == 'Professional')
                                        {{-- <a title="Click here to book professional" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/{{ $sports_value->id }}">
                                            Book Now
                                        </a> --}}

                                        <a title="Click here to book professional" class="gf" sp_id="{{$sports_value->booking_option}}" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/{{ $sports_value->id }}">
                                            Book Now
                                        </a>
                                    @elseif($sports_value->booking_option == 'All') 
                                        <a title="Click here to book professional" class="gf" sp_id="{{$sports_value->booking_option}}" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/{{ $sports_value->id }}">
                                            Book Now
                                        </a>
                                    @else
                                        <a class="gf" sp_id="{{$sports_value->booking_option}}" href= "<?php echo '/direct-hire?selected_sport='.$sports_value->id; ?>">
                                            Book Now
                                        </a>
                                    @endif
                                @else
                                    <a type="button" data-toggle="modal"  data-target="#login_modal" href="/auth/jsModallogin/{{ $sports_value->id }}" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">
                                        Book Now
                                    </a>
                                @endif
                            @endif
                        </div>
                    </span>
                </div>
            @endforeach
        @endif
    </div>

    </div>
    <!-- login modal -->
    <div class="modal fade" id="child_sports_modal" role="dialog">
      <div class="modal-dialog modal-lg" style="width:90%">
            <div class="modal-content" id="child_sports_modal_content"></div>
      </div>
    </div>
</section>

<script type="text/javascript">

$(document).ready(function()
{   
     $('.gf').click(function(){
                localStorage.setItem('myData',$(this).attr('sp_id'))
            })
    //Default selected VIEW ALL SPORTS
    $('#category_id_all').css("font-weight", "500");

    $('#categorySelection').change(function(e){
        var cat_id_arr = $("#categorySelection option:selected").attr('id').split('category_id_');
        if(cat_id_arr[1] != undefined){

            //Unselect all categories
            $(this).parent().parent().find('li').find('a').css("font-weight", "300");

            //Highlight selected categories
            $(this).css("font-weight", "500");
            
            $.ajax({
                method: "POST",
                url: "{!! route('sports-ajax-get-list') !!}", 
                data: { 'cat_id': cat_id_arr[1], '_token': "{{ csrf_token() }}" },
                success: function(result){
                   if(result){
                        var resultObj = jQuery.parseJSON(result);
                        
                        $('.cate-list').html('');
                        
                        $.each(resultObj.sports_list, function( index, value ) {
                          if(index%4 == 0){
                            $('.cate-list').append('<div class="row" style="margin-bottom:15px;"></div>');
                          }
                          
                          //For Most Searched
                          if(value.id === undefined) value.id = value.sport;
                    // console.log(value.sport_name + '--'+value.has_child);
                        var description = '';
                        if(value.description !== undefined && value.description !== null)
                        {
                            var description = value.description;
                        }
                          if(value.has_child == 1){

                            $('.cate-list').append(
                                '<div class="cat-item style_prevu_sp width-auto">'+
                                    '<span>'+
                                        '<div class="cat-img-name">'+
                                            '<span>'+
                                                '<div class="sports_name">'+
                                                    '<span>'+value.sport_name+'</span>'+
                                                '</div>'+
                                            '</span>'+
                                            '<img src="<?php echo Config::get('constants.SPORTS_IMAGE_THUMB'); ?>'+value.image+'" height="466" width="313" />'+
                                                '<p>&nbsp;</p>'+
                                                '<div class="pop-search-detail-sports">'+
                                                    '<h4>'+value.sport_name+'</h4>'+
                                                    '<h5>'+description+'</h5>'+
                                                '</div>'+
                                        '</div>'+
                                        '<div class="cat-detail">'+
                                            '<h1>'+value.sport_name+'</h1>'+
                                            '<a type="button" data-toggle="modal" data-target="#child_sports_modal" href="/home/jsModalChildSports/'+value.id+'">Book Now</a>'+
                                        '</div>'+
                                    '</span>'+
                                '</div>');  
                            } else {
                                
                                <?php if(Auth::user()) { ?>
                                    $('.cate-list').append(
                                        '<div class="cat-item style_prevu_sp width-auto">'+
                                            '<span>'+
                                                '<div class="cat-img-name">'+
                                                    '<span>'+
                                                        '<div class="sports_name">'+
                                                            '<span>'+value.sport_name+'</span>'+
                                                        '</div>'+
                                                    '</span>'+
                                                    '<img src="<?php echo Config::get('constants.SPORTS_IMAGE_THUMB'); ?>'+value.image+'" height="466" width="313" />'+
                                                    '<p>&nbsp;</p>'+
                                                    '<div class="pop-search-detail-sports">'+
                                                        '<h4>'+value.sport_name+'</h4>'+
                                                        '<h5>'+description+'</h5>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="cat-detail">'+
                                                    '<h1>'+value.sport_name+'</h1>'+
                                                        '<a title="Click here to book professional" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/'+value.id+'">Book Now</a>'+
                                                '</div>'+
                                            '</span>'+
                                        '</div>');
                                <?php } else { ?>
                                    $('.cate-list').append(
                                        '<div class="cat-item style_prevu_sp width-auto">'+
                                            '<span>'+
                                                '<div class="cat-img-name">'+
                                                    '<span>'+
                                                        '<div class="sports_name">'+
                                                            '<span>'+value.sport_name+'</span>'+
                                                        '</div>'+
                                                    '</span>'+
                                                    '<img src="<?php echo Config::get('constants.SPORTS_IMAGE_THUMB'); ?>'+value.image+'" height="466" width="313" />'+
                                                        '<p>&nbsp;</p>'+
                                                        '<div class="pop-search-detail-sports">'+
                                                            '<h4>'+value.sport_name+'</h4>'+
                                                            '<h5>'+description+'</h5>'+
                                                        '</div>'+
                                                '</div>'+
                                                '<div class="cat-detail">'+
                                                    '<h1>'+value.sport_name+'</h1>'+
                                                        '<a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/'+value.id+'" title="Login to book professional" onclick="$(\'#child_sports_modal\').modal(\'hide\');">Book Now</a>'+
                                                '</div>'+
                                            '</span>'+
                                        '</div>');
                                <?php } ?>
                           }

                        });

                        if($('.cate-list').html() == '') { $('.cate-list').html('<div class="cat-item"><div style="height:149px; width:100%; clear:both;"></div><div class="cat-detail"><h1>No Sports Found.</h1></div></div>'); }
                   }
                }
            });
        }
    });

    <?php if(session('bookSportAfterLogin') && session('bookSportAfterLogin') > 0 && Auth::user()){ ?>
        $('#lesson_modal').modal({'show':true,'remote':"/lesson/jsModallesson/booklesson/<?php echo session('bookSportAfterLogin') ?>"});
    <?php 
        session(['bookSportAfterLogin' => 0]);
    } ?>

});
</script>
@include('layouts.footer')
@endsection
