@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')

<head>
    <title> Fitnessity </title>
    <meta charset="utf-8">
    <meta name="description" content="Looking for a place to grow your career. There are many good reasons to consider the great insurance jobs available through Legends United.">
    <meta name="keywords" content="Great Insurance Jobs">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.FRONT_CSS'); ?>stylenew.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/pixelarity.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link href="{{ url('public/emoji/lib/css/emoji.css') }}" rel="stylesheet">
    <?php /*?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php */?>
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/comment-icons.css') }}">

    
    <link rel="stylesheet" href="{{ url('public/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/date-range-picker.css') }}">
</head>

@section('content')
<style>
	.ml-10{ margin-left: 10px; }
	.theme-red-bgcolor{ background-color: #f91942 !important; }
	.theme-round-btn{ font-size: 13px; font-weight: 500; border: medium none; border-radius: 30px; color: #fff; }
	.post-meta .removepost{ border: none !important; }
    .delimgpost3{
        color: #f91942;
        position: absolute;
        top: 8px;
        margin-left: 8px;
        background: white;
        padding: 6px;
        font-size: 16px;
        right: 8px;
    }
    .emoji-picker-icon{
		right: 61%;
		top: 67%;
		font-size: 17px;
	}
	.emoji-menu{ right: 354px; top: 209px; }
    .veri-icon-new span a{ margin:17px; width:57px; height:58px; }
    .dropzone{ border:0 }
    .dz-progress{ display:none; }
    .dz-image-preview img{ width:120px; height:120px; }
    table.dp_monthpicker.dp_body td { padding: 15px !important; }
    .modal-body.login-pad .signup .emplouyee-form .result { width: 150px; height: auto; padding: 20px; }
    a:hover, a:focus {
        /*color: #fff !important;*/
        text-decoration: none !important;
    }
    .img-bunch-two > .row { margin: 0; }
	.img-bunch-two { float: left; width: 100%; position: relative; }
	.img-bunch-two > .row > div { padding: 0; }
	.img-bunch-two figure {
		float: left; margin: 0; padding: 1px; width: 100%; position: relative;
	}
	.img-bunch-two .strip { display: unset; }
	.img-bunch-two figure img { float: left; width: 100%; height: 99%; }
    .btn { top: 6px !important; right: -1px !important; }
    /*.button {
      display: block;
      width: 135px;
      height: 41px;
      background: #f53b49;
      padding: 10px;
      text-align: center;
      border-radius: 0px;
      color: #fff;
      font-weight: bold;
      line-height: 25px; 
      font-size: 17px;
    }*/
    .Zebra_DatePicker{ width: 70% !important; }
    img.header_img { position: absolute; left: 0; }
    hr.heading_hr { width: 10%; color: #f53b49; margin-top: 0; border-top: 3px solid; position: absolute;
        margin-bottom: 0 !important;
    }
    .introduction_section,.Education_section,.Company_section{ padding-left: 16.7%; }
    h3{ color: #f53b49; }
    .modal_buttons{ text-align: center; }
    .btn.btn-secondary{
        width: 249px;
        display: inline-block;
        font-size: 23px;
        margin: 40px 0 25px;
        background: #f53b49 none repeat scroll 0 0;
        border: 1px solid #f53b49;
        padding: 12px 0;
        cursor: pointer;
        text-transform: uppercase;
        color: #fff;
        border-radius: 0px;
    }
    .user_img{ text-align: center; margin: 5% 0px; }
    .avatar { vertical-align: middle; width: 120px; height: 120px; border-radius: 50%; }
    .user_img_content { margin: 3% 0px; }
    .header_content { padding: 0px 7%; }
    span.user-img > img { width: 100%; height: 100%; border-radius: 100px; }
    h4.heading {
        font-size: 22px;
        font-weight: 600;
        text-transform: uppercase;
        margin: 20px 0;
        border-bottom: 3px solid #f53b49;
        width: 70%;
        text-align: center;
        margin: 0px auto 20px auto;
        color: #f53b49;
    }
    span.Zebra_DatePicker_Icon_Wrapper { width: 100% !important; }
    .Zebra_DatePicker {
        background: #666;
        border-radius: 4px;
        box-shadow: 0 0 10px #888;
        color: #222;
        font: 13px Tahoma,Arial,Helvetica,sans-serif;
        padding: 3px;
        position: absolute;
        display: table;
        *width: 255px;
        z-index: 1200
    }
    .Zebra_DatePicker *,
    .Zebra_DatePicker :after,
    .Zebra_DatePicker :before { box-sizing: content-box!important }
    .Zebra_DatePicker * { padding: 0 }
    .Zebra_DatePicker table {
        border-collapse: collapse;
        border-radius: 4px;
        border-spacing: 0;
        width: 100%;
    }
    .Zebra_DatePicker td,
    .Zebra_DatePicker th {
        padding: 5px;
        cursor: pointer;
        text-align: center;
        min-width: 25px;
        width: 25px;
    }
    .Zebra_DatePicker .dp_body td, .Zebra_DatePicker .dp_body th { border: 1px solid #bfbfbf; }
    .Zebra_DatePicker .dp_body td:first-child, .Zebra_DatePicker .dp_body th:first-child { border-left: none; }
    .Zebra_DatePicker .dp_body td:last-child, .Zebra_DatePicker .dp_body th:last-child { border-right: none; }
    .Zebra_DatePicker .dp_body tr:first-child td, .Zebra_DatePicker .dp_body tr:first-child th { border-top: none; }
    .Zebra_DatePicker .dp_body tr:last-child td, .Zebra_DatePicker .dp_body tr:last-child th { border-bottom: none; }
    .Zebra_DatePicker .dp_body td { background: #e6e5e5; }
    .Zebra_DatePicker .dp_body .dp_weekend { background: #d6d6d6; }
    .Zebra_DatePicker .dp_body .dp_not_in_month { background: #e0e6f2; color: #98acd4; }
    .Zebra_DatePicker .dp_body .dp_time_controls_condensed td { width: 25%; }
    .Zebra_DatePicker .dp_body .dp_current { color: #cc236b; }
    .Zebra_DatePicker .dp_body .dp_selected { background: #b56a6a; color: #fff; }
    .Zebra_DatePicker .dp_body .dp_disabled { background: #f2f2f2; color: #ccc; cursor: text; }
    .Zebra_DatePicker .dp_body .dp_disabled.dp_current { color: #b56a6a; }
    .Zebra_DatePicker .dp_body .dp_hover { color: #fff; background: #88a09e; }
    .Zebra_DatePicker .dp_body .dp_hover.dp_time_control { background-color: #8c8c8c; color: #fff; }
    .Zebra_DatePicker .dp_monthpicker td, .Zebra_DatePicker .dp_timepicker td,
    .Zebra_DatePicker .dp_yearpicker td { width: 33.3333% }
    .Zebra_DatePicker .dp_timepicker .dp_disabled { border: none; color: #222; font-size: 26px; font-weight: 700; }
    .Zebra_DatePicker .dp_time_separator div { position: relative; }
    .Zebra_DatePicker .dp_time_separator div:after {
        content: ":"; color: 1px solid #bfbfbf; font-size: 20px; left: 100%; margin-left: 2px; margin-top: -13px;
        position: absolute; top: 50%; z-index: 1;
    }
    .Zebra_DatePicker .dp_header { margin-bottom: 3px; }
    @supports (-ms-ime-align:auto) {
        .Zebra_DatePicker .dp_header {
            font-family: 'Segoe UI Symbol',Tahoma,Arial,Helvetica,sans-serif
        }
    }
    .Zebra_DatePicker .dp_footer { margin-top: 3px; }
    .Zebra_DatePicker .dp_footer .dp_icon { width: 50%; }
    .Zebra_DatePicker .dp_actions td { border-radius: 4px; color: #fff; }
    .Zebra_DatePicker .dp_actions .dp_caption { font-weight: 700; width: 100%; }
    .Zebra_DatePicker .dp_actions .dp_next, .Zebra_DatePicker .dp_actions .dp_previous { *padding: 0 10px; }
    .Zebra_DatePicker .dp_actions .dp_hover { background-color: #8c8c8c; color: #fff; }
    .Zebra_DatePicker .dp_daypicker th { background: #fc3; cursor: text; font-weight: 700; }
    .Zebra_DatePicker.dp_hidden { display: none; }
    .Zebra_DatePicker .dp_icon { height: 16px; background-image: url(icons.png); background-repeat: no-repeat;
        text-indent: -9999px; *text-indent: 0; }
    .Zebra_DatePicker .dp_icon.dp_confirm { background-position: center -123px; }
    .Zebra_DatePicker .dp_icon.dp_view_toggler { background-position: center -91px; }
    .Zebra_DatePicker .dp_icon.dp_view_toggler.dp_calendar { background-position: center -59px; }
    button.Zebra_DatePicker_Icon {
        background: url(icons.png) center top no-repeat;
        border: none;
        cursor: pointer;
        display: block;
        height: 16px;
        line-height: 0;
        padding: 0;
        position: absolute;
        text-indent: -9000px;
        width: 16px
    }
    button.Zebra_DatePicker_Icon.Zebra_DatePicker_Icon_Disabled { background-position: center -32px; cursor: default; }
    .pad{ padding-top:10px; }
    .mt83{ margin-top: 83px; }
    .close{ opacity: 1 !important; }
    .signleft-customer form a { font-size: 13.5px; color: #777; padding-bottom: 0; text-align: left; float: none; }
    .t_c { font-size: 13.5px !important; color: #777 !important; padding-bottom: 0; text-align: left; float: none; }
    button.FITNESS_ENTHUSIASTS_signup { margin-top: 22.4%; }
    .signleft { float: left; width: 45%; }
    .signright{ width: 45%; }
    input,select { margin: 2.2% 0.5%; border: 1px solid #828282; padding: 16px 10px; width: 100%; }
    .modallink.mt20 { margin-top: 8% !important; }
    .pac-container { z-index: 999999999; }
    table.dp_monthpicker.dp_body td { padding: 15px !important; }
    .Zebra_DatePicker .dp_body .dp_selected {
        background: #f53b49 !important;
        color: #fff !important;
    }
    .Zebra_DatePicker .dp_daypicker th {
        background: #f53b49 !important;
        cursor: text;
        font-weight: 700;
        color: #fff !important;
    }
    input#frm1_birthday{
        padding-right: 0px !important;
    }
    .Zebra_DatePicker{
        width: 100% !important;
    }
    button.Zebra_DatePicker_Icon {
        display: none !important;
    }
    .lbl{
        float:left;
    }
    .Zebra_DatePicker_Icon_Wrapper{
        width:150px !important;
    }
    .hide-bullets {
        list-style:none;
        margin-top:8px;
    }
    /*------- changes ----------*/
    .gallery-box{
        padding: 0;
    }
    div#main_area {
        padding: 40px;
    }
    .wrapper{
        width:660px;
        height: 580px;
        /*background-color: #fff;*/
        float:left;
        /*margin:20px;*/
    }
    #big_img {
        width:600px;
        height: 420px;
        /*margin:20px 20px 0px 20px;*/
    }
    .thumbnail-inner{
        width:600px;
        height: 120px;
        /*background-color: #000;*/
        /*float: left;*/
        /*margin-left: 20px;*/
        overflow-y:auto;
    }
    .thumbnail-inner img{
        width:130px;
        height: 100px;
        margin:8px 11px 0px 0px;
        border:3px solid white;
        border-radius: 5px;
        opacity: 0.5;
        cursor: pointer;
        border-radius: 8px;
    }
    .thumbnail-inner img:hover{
        opacity: 1;
    }
    .img-wrap {
        position: relative;
        float:left;
    }
    .img-wrap .selectPhoto {
        position: absolute;
        top: 55px;
        right: 0;
        z-index: 100;
        font-size:14px;
        color:#ffffff;
        text-align:center;
    }
    .img-wrap .unselectPhoto {
        position: absolute;
        top: 55px;
        right: 19px;
        z-index: 100;
        font-size:13px;
        color:#00ff00;
        /*text-align:center;*/
    }
    .img-wrap .delPhoto {
        position: absolute;
        top: 16px;
        right: 20px;
        z-index: 100;
        font-size:12px;
        color:#ff0000;
    }
    .mt-70
    {
        margin-top:70px;
    }
    .mt-20
    {
        margin-top:20px;
    }
    .box-red{
        width: 100%;
        background: #f91942;
        margin-bottom: 20px;
    }
    .red-box-font{
        color: aliceblue;
        font-weight: 450;
        text-align: center;
        padding: 25px 15px 25px 15px;
    }
    .veri-icon-new-1 {
        text-align: center;
        padding: 0px 10px 20px 10px;
    }
    .veri-icon-new-1 span a {
        margin: 4px;
        width: 57px;
        height: 58px;
    }
    .veri-icon-new-1 span a {
        width: 50px;
        height: 50px;
        text-align: center;
        border: 1px solid #fff;
        line-height: 50px;
        font-size: 25px;
        color: #fff;
        border-radius: 100px;
        display: inline-block;
    }
    .veri-icon-new-1 span a>i {
        line-height: 50px;
    }
    .box-white{
        background: white;
        width: 100%;
        height: auto%;
    }
    .title-statistics{
        border-bottom: 1px solid #c9c9c9;
    }
    .title-statistics a{
        color: black;
        font-weight: 600;
        padding: 10px 10px 15px 10px;
    }
    .list-st{
        margin-top: 10px;
        /*width: 50%;*/
        display: inline-block;
        /*padding: 0px 10px 10px 10px;*/
    }
    .list-st a{
        color: black;
        margin-left: 10px;
    }
    .list-items{
        margin-bottom: 4px;
    }
    .border{
        width: 565px;
        height: 400px;
        border-radius: 8px;
    }
    .file-upload .image-upload-wrap {
        border: 2px dashed #dddddd;
        background-color: #f7f9fb;
        position: relative;
        padding: 15px 0;
        border-radius: 6px;
        width: 94%;
    }
    .top-1{
        margin-top: 105px;
    }
    .url-copy{
        display: block ruby;
        color: #777777;
    }
    .social {
        float: left;    
    }
    .family_edit{
        color: #f53b49;
        font-size: 20px;
        font-weight: 300;
        background: white;
        padding: 10px;
        top: 91px;
        margin-left: 292px;
        position: absolute;
    }
    .4img-slider{
        height: 305px; 
        overflow: hidden; 
        background: #000;  
        padding-bottom: 5px;
    }
    .banner-fs{
        height: 371px;
        padding-top: 83px;
        overflow: hidden;
    }
    .con-width{
        width: 100%;    
        display: flex;
        position: relative;
    }
    .one{
        /* width: 25%; */
    }
    .one img{
        width: 100%;
        height: 300px;
        display: block; 
    }
    .editpic-fs{
        /*
        color: #f91942;
        position: absolute;
        top: 8px;
        background: white;
        padding: 8px;
        font-size: 18px;
        margin-left: 298px;
        */
        color: #f91942;
        position: absolute;
        top: 8px;
        margin-left: 8px;
        background: white;
        padding: 8px;
        font-size: 18px;
    }

    .boot-banner img{
        width: 100%;
        height: 265px;
    }
    .p0{ padding: 0px;}
	.menu {
	  z-index: 8;
	  position: absolute;
	  padding: 0;
	  margin: 0;
	  list-style-type: none;
	}
	.menu .share i.fa {
	  height: 50px;
	  width: 50px;
	  text-align: center;
	  line-height: 50px;
	  background-color: #fff;
	  border-radius: 2px;
	}
	.menu .share:hover.right .submenu li:nth-child(1) {
	  opacity: 1;
	  left: 50px;
	  transform: rotate(0deg);
	  transition-delay: 0.08s;
	  border-left: 1px dashed #cccccc;
	}
	.menu .share:hover.right .submenu li:nth-child(2) {
	  opacity: 1;
	  left: 100px;
	  transform: rotate(0deg);
	  transition-delay: 0.16s;
	  border-left: 1px dashed #cccccc;
	}
	.menu .share:hover.right .submenu li:nth-child(3) {
	  opacity: 1;
	  left: 150px;
	  transform: rotate(0deg);
	  transition-delay: 0.24s;
	  border-left: 1px dashed #cccccc;
	}
	.menu .share:hover.right .submenu li:nth-child(4) {
	  opacity: 1;
	  left: 200px;
	  transform: rotate(0deg);
	  transition-delay: 0.32s;
	  border-left: 1px dashed #cccccc;
	}
	.menu .share:hover.right .submenu li:nth-child(5) {
	  opacity: 1;
	  left: 250px;
	  transform: rotate(0deg);
	  transition-delay: 0.4s;
	  border-left: 1px dashed #cccccc;
	}
	.menu .submenu {
	  list-style-type: none;
	  padding: 0;
	  margin: 0;
	}
	.menu .submenu li {
	  transition: all ease-in-out 0.5s;
	  position: absolute;
	  top: 0;
	  left: 0;
	  z-index: -1;
	  opacity: 0;
	}
	.menu .submenu li a {
	  color: #212121;
	  padding-left: 0;
	}
	.menu .submenu li a:hover i.fa {
	  color: #fff;
	}
	.menu .submenu li a:hover.facebook i.fa {
	  background-color: #3b5999;
	}
	.menu .submenu li a:hover.twitter i.fa {
	  background-color: #55acee;
	}
	.menu .submenu li a:hover.googlePlus i.fa {
	  background-color: #dd4b39;
	}
	.menu .submenu li a:hover.linkedin i.fa {
	  background-color: #0077b7;
	}
	.menu .submenu li:nth-child(1) {
	  transform: rotateX(45deg);
	}
	.menu .submenu li:nth-child(2) {
	  transform: rotateX(90deg);
	}
	.menu .submenu li:nth-child(3) {
	  transform: rotateX(135deg);
	}
	.menu .submenu li:nth-child(4) {
	  transform: rotateX(180deg);
	}
	.menu.bottomLeft {
	  bottom: -15px;
	  left: 183px;
	}
	
	.submenu li a {
		padding: 0px 0px 0px 0px;
	}
	.mobile-social{
		display: none;
	}

	/*--------------- New Index Page -------------*/
	
	.postbox {
	  z-index: 6;
	  position: relative;
	}
	.central-meta {
	  background: #fff none repeat scroll 0 0;
	  /*border: 1px solid #ede9e9;*/
	  border-radius: 5px;
	  display: inline-block;
	  width: 100%;
	  margin-bottom: 20px;
	  padding: 20px;
	  position: relative;
	}

	.create-post {
	  border-bottom: 1px solid #e6ecf5;
	  display: block;
	  font-weight: 500;
	  font-size: 15px;
	  line-height: 15px;
	  margin-bottom: 20px;
	  padding-bottom: 12px;
	  text-transform: capitalize;
	  width: 100%;
	  color: #515365;
	  position: relative;
	}
	
	.post-img img{
		border-radius: 100%;
		width: 50px;
		height: 50px;
	}

	.newpst-input { display: inline-block; vertical-align: top; width: 90%; }
	.newpst-input > form { display: inline-block; width: 100%; }
	.newpst-input textarea { float: left; width: 100%; border: none; }
	.post-img { display: inline-block; margin-bottom: 0; vertical-align: top; }
	.attachments { display: block; text-align: left; background: #fff; }
	.attachments li { display: inline-block; margin-left: 10px; vertical-align: middle; font-size: 16px; line-height: 0; }
	.attachments li:first-child { margin-left: 0; }
	.fileContainer { display: inline-block; font-size: 14px; position: relative; text-align: center; text-transform: capitalize; }
	.attachments > ul .add-loc {
	  cursor: pointer;
	  display: block;
	  font-size: 20px;
	  margin-top: -5px;
	  color: #f91942;
	}
	.attachments li.preview-btn { float: right }
	.attachments > ul input { display: none !important; }
	.attachments li.preview-btn button {
	  background: #f91942;
	  border: 1px solid #f91942;
	  border-radius: 30px;
	  color: white;
	  font-size: 12px;
	  font-weight: 500;
	  padding: 12px 10px;
	  transition: all 0.2s linear 0s;
	}	
	.attachments li.preview-btn button:hover {
	  background: #2e2e2e;
	  border: 1px solid #2e2e2e;
	}
	.post-btn {
	  background: #f91942;
	  border: medium none;
	  border-radius: 5px;
	  color: #fff;
	  font-weight: 500;
	  margin-top: 11px;
	  padding: 5px;
	  width: 100%;
	  transition: all 0.2s linear 0s;
	}
	.post-btn:hover { background: #2e2e2e; }
	.promote-baner {
	  display: inline-block;
	  margin-bottom: 20px;
	  padding: 20px;
	  position: relative;
	  width: 100%;
	  border-radius: 6px;
	}
	.promote-baner.blackish::before { border-radius: 6px; }
	.promote-baner .bg-image { z-index: 0; border-radius: 6px; }
	.bg-image {
	  float: left;
	  height: 100%;
	  left: 0;
	  position: absolute;
	  top: 0;
	  width: 100%;
	  z-index: -1;
	  background-position: center center;
	  background-repeat: no-repeat;
	  background-size: cover;
	}
	.promote-baner > span {
	  color: #fff;
	  display: inline-block;
	  font-size: 17px;
	  font-weight: 500;
	  line-height: 25px;
	  margin-bottom: 12px;
	  position: relative;
	  width: 100%;
	  z-index: 1;
	}
	.ads-links {
	  display: inline-block;
	  list-style: outside none none;
	  margin-bottom: 0;
	  padding: 0;
	  position: relative;
	  padding: 7px;
	  border-radius: 5px;
	  z-index: 2;
	  background: #f91942;
	  float: right;
	}
	.ads-links:hover {
	  background: #2e2e2e;
	}
	.ads-links > li {
	  display: inline-block;
	  margin-right: 10px;
	}
	.ads-links > li a{
	  color: white;
	}
	.ads-links > li > a > i {
	  background: #fff none repeat scroll 0 0;
	  color: #515365;
	  border-radius: 100%;
	  height: 25px;
	  line-height: 25px;
	  text-align: center;
	  transition: all 0.2s linear 0s;
	  width: 25px;
	}
	.central-meta {
	  background: #fff none repeat scroll 0 0;
	  border: 1px solid #ede9e9;
	  border-radius: 5px;
	  display: inline-block;
	  width: 100%;
	  margin-bottom: 20px;
	  padding: 20px;
	  position: relative;
	}
	.create-post > a {
	  display: inline-block;
	  float: right;
	  font-size: 11px;
	  font-weight: normal;
	  color: #f91942;
	}
	.create-post > a:hover { color: #2e2e2e !important; }
	textarea { resize: none; }
	/*--- top stories ---*/
	.story-postbox {
		display: inline-block;
		position: relative;
		width: 100%;
	}
	.story-postbox > .row > div {
		padding: 0 3px;
	}
	.story-box > figure {
		border-radius: 10px;
		margin-bottom: 0;
		overflow: hidden;
	}
	.story-box {
		display: inline-block;
		overflow: hidden;
		width: 100%;
		cursor: pointer;
		position: relative;
	}
	.story-box:before{
		content: "";
		background: rgba(0,0,0,.2);
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		transition: all 0.2s linear 0s;
		z-index: 1;
		border-radius: 10px;
	} 
	.story-box:hover:before{
		z-index: 0;
	}
	.story-postbox .row {
		margin: 0;
	}
	.story-thumb {
		left: 12px;
		position: absolute;
		top: 12px;
		z-index: 1;
	}
	.story-thumb img {
		border: 2px solid #fff;
		border-radius: 100%;
		transition: all 0.25s linear 0s;
	}
	.story-box:hover figure img {
		transform: scale(1.05);
	}
	.story-box figure img {
		transition: all 0.2s linear 0s;
		width: 100%;
		border-radius: 10px;
	}
	.story-box figure span {
		bottom: -15px;
		color: #000;
		font-size: 12px;
		font-weight: 500;
		left: 50%;
		opacity: 0;
		position: absolute;
		text-align: center;
		text-transform: capitalize;
		transform: translateX(-50%);
		transition: all 0.2s linear 0s;
		visibility: hidden;
		width: 100%;
		z-index: 9;
	}
	.story-box:hover figure span {
		bottom: 9px;
		left: 50%;
		opacity: 1;
		visibility: visible;
	}
	.story-thumb > i {
		background: transparent none repeat scroll 0 0;
		border: 2px solid #fff;
		border-radius: 100%;
		color: #fff;
		font-size: 18px;
		height: 40px;
		line-height: 36px;
		text-align: center;
		width: 40px;
		transition: all 0.2s linear 0s;
	}
	.story-thumb > i:hover {
		background: transparent none repeat scroll 0 0;
		border: 2px solid #2e2e2e;
		border-radius: 100%;
		color: #2e2e2e;
		font-size: 18px;
		height: 40px;
		line-height: 36px;
		text-align: center;
		width: 40px;
		transition: all 0.2s linear 0s;
	}
	.add-del-friends {
		position: absolute;
		right: 30px;
		top: 8px;
	}
	.add-del-friends > a {
		font-size: 15px;
		margin-right: 10px;
		transition: all 0.2s linear 0s;
	}
	.add-del-friends > a:hover i {
		transform: scale(1.1);
	}
	
	/*--- central posts meta box ---*/
	.central-meta {
		background: #fff none repeat scroll 0 0;
		border: 1px solid #ede9e9;
		border-radius: 5px;
		display: inline-block;
		width: 100%;
		margin-bottom: 20px;
		padding: 20px;
		position: relative;
	}
	
	.central-meta.padding30 {
		padding: 30px;
	}
	
	.new-postbox {
		display: inline-block;
		width: 100%;
	}
	
	.new-postbox > figure {
		display: inline-block;
		margin-bottom: 0;
		vertical-align: top;
	}
	
	.newpst-input {
		display: inline-block;
		vertical-align: top;
		width: 90%;
	}
	
	.newpst-input > form {
		display: inline-block;
		width: 100%;
	}
	.newpst-input textarea {
		float: left;
		width: 100%;
		border: none;
	}
	.newpst-input textarea:focus, 
	.newpst-input textarea:active {
		outline: medium none;
		border: none;
	}
	.create-post {
		border-bottom: 1px solid #e6ecf5;
		display: block;
		font-weight: 500;
		font-size: 15px;
		line-height: 15px;
		margin-bottom: 20px;
		padding-bottom: 12px;
		text-transform: capitalize;
		width: 100%;
		color: #515365;
		position: relative;
	}
	.create-post::before {
		content: "";
		height: 90%;
		left: -20px;
		position: absolute;
		top: -5px;
		width: 3px;
	}
	.create-post > i {
		font-size: 20px;
		vertical-align: sub;
	}
	.create-post > a {
		display: inline-block;
		float: right;
		font-size: 11px;
		font-weight: normal;
	}
	.attachments { display: block; text-align: left; background: #fff; }
	.attachments > ul { list-style: outside none none; margin-bottom: 0; padding-left: 0; line-height: initial; }
	.attachments li { display: inline-block; margin-left: 10px; vertical-align: middle; font-size: 16px; line-height: 0; }
	.attachments li:first-child{ margin-left: 0; }
	.attachments li.preview-btn { float: right; }
	.attachments li.preview-btn button {
		background: #fff none repeat scroll 0 0; border: 1px solid; border-radius: 30px; color: inherit;
		font-size: 12px; font-weight: 500; padding: 12px 10px; transition: all 0.2s linear 0s;
	}
	.attachments li.preview-btn button:hover { color: #fff; }
	textarea { border: 1px solid #eeeeee; border-radius: 6px 6px 0 0; padding: 10px; width: 100%; border-bottom: 0; }
	form button {
		border: medium none; border-radius: 30px; color: #fff; float: right; font-size: 13px; font-weight: 500;
		padding: 10px 30px; transition: all 0.2s linear 0s;
	}
	.new-postbox .post-btn {
		background: #23d2e2 none repeat scroll 0 0; border: medium none; border-radius: 5px; color: #fff;
		font-weight: 500; margin-top: 11px; padding: 5px; width: 100%; transition: all 0.2s linear 0s;
	}
	.attachments .fileContainer [type="file"] { right: 2px; top: -10px; width: 20px; height: 20px; }
	.friend-info { display: inline-block; position: relative; width: 100%; }
	.friend-info > figure {
		display: inline-block; margin-bottom: 0; margin-top: 0; position: relative; vertical-align: middle; width: 40px;
	}
	.friend-info > figure > i {
		border: 2px solid #636175; border-radius: 100%; color: #636175; display: inline-block; font-size: 20px;
		height: 40px; line-height: 38px; text-align: center; width: 40px;
	}
	.friend-name { display: inline-block; padding-left: 10px; vertical-align: middle; width: 91.2%; }
	.friend-name > em { color: #aaa; display: inline-block; font-size: 12px; font-style: normal; }
	.friend-name > em.verify{ color: mediumseagreen; }
	.friend-name > ins { display: inline-block; width: 90%; font-size: 12px; text-decoration: none; }
	.friend-name > ins > a { font-size: 13.5px; font-weight: 500; color: #f91942; }
	.friend-name > ins > a:hover { color: #2e2e2e !important; }
	.friend-info > figure img{ border-radius: 100%; height: auto; max-width: 100%; width: 35px; height: 35px; }
	.more { float: right; position: relative; }
	.more-post-optns { cursor: pointer; display: inline-block; position: relative; }
	.more-post-optns::before {
		background: #eee none repeat scroll 0 0; border-radius: 100%; content: ""; height: 33px; left: 50%; position: absolute;
		top: 45%; transform: translate(-50%, -50%) scale(0); transition: all 0.2s linear 0s; width: 33px; z-index: 1;
	}
	.more-post-optns > i { position: relative; z-index: 2; }
	.more-post-optns > ul > li > a:hover{ color: #2e2e2e !important; }
	.more-post-optns > ul > li > a{ color: #f91942 !important; }
	.ti-more-alt::before { content: "\e6e2"; }
	.user-post {
		border-bottom: 1px dashed #ccc; display: inline-block; margin-bottom: 20px; padding-bottom: 20px; width: 100%;
	}
	.central-meta .user-post:last-child {
		border: 0 none; margin-bottom: 0; padding: 0;
	}

	.more-post-optns > ul {
		background: #fff none repeat scroll 0 0;
		border-radius: 5px;
		box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
		display: inline-block;
		list-style: outside none none;
		margin: 0;
		opacity: 0;
		padding: 15px;
		position: absolute;
		right: -100px;
		top: -220%;
		transform: scale(0);
		transition: all 0.2s linear 0s;
		visibility: hidden;
		width: 175px;
		z-index: 9;
	}
	.more-post-optns {
		cursor: pointer; display: inline-block; position: relative;
	}
	.more-post-optns > ul > li {
		cursor: pointer; display: inline-block; font-size: 11.5px; margin-bottom: 7px; transition: all 0.2s linear 0s;
		width: 100%; font-weight: 400; color: #f91942;
	}
	.more-post-optns > ul > li:hover {
		cursor: pointer; display: inline-block; font-size: 11.5px; margin-bottom: 7px; transition: all 0.2s linear 0s; 
		width: 100%; font-weight: 400; color: #2e2e2e;
	}
	.more-post-optns > ul > li:last-child{ margin-bottom: 0; }
	.more-post-optns > ul > li i {
		color: #f91942; display: inline-block; font-size: 14px; margin-right: 8px; transition: all 0.1s linear 0s;
		vertical-align: middle;
	}
	
	.more-post-optns > ul > li:hover i { transform: scale(1.1); color: #2e2e2e; }
	.more-post-optns:hover > ul {
		opacity: 1; right: -1px; top: 100%; transform: scale(1); visibility: visible;
	}
	.more-post-optns::before {
		background: #eee none repeat scroll 0 0; border-radius: 100%; content: ""; height: 33px; left: 50%; position: absolute;
		top: 45%; transform: translate(-50%, -50%) scale(0); transition: all 0.2s linear 0s; width: 33px; z-index: 1;
	}
	.more-post-optns > i { position: relative; z-index: 2; }
	.more-post-optns:hover::before { transform: translate(-50%, -50%) scale(1); }
	.friend-name > span { color: #999; float: left; font-size: 12px; text-transform: capitalize; width: 90%; }
	.like-dislike {
		left: 50%; list-style: outside none none; margin-bottom: 0px; padding: 0; position: absolute;
		top: 50%; transform: translate(-50%, -50%); width: auto; z-index: 88;
	}
	.like-dislike > li {
		display: inline-block; opacity: 0; visibility: hidden; margin: 0 3px; transform: scale(0); transition: all 0.2s linear 0s;
	}
	.like-dislike > li:nth-child(1){ transition: all 0.2s linear 0.1s; }
	.like-dislike > li:nth-child(2){ transition: all 0.2s linear 0.2s; }
	.like-dislike > li:nth-child(3){ transition: all 0.2s linear 0.3s; }
	.post-meta:hover .like-dislike > li{ visibility: visible; opacity: 1; transform: scale(1); }
	.like-dislike > li a {
		background: #f91942; border-radius: 100%; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3); width: 34px;
		color: #fff; display: inline-block; font-size: 20px; height: 34px; padding-top: 6px; text-align: center;
		transition: all 0.2s linear 0s; 
	}
	.like-dislike > li a.activethumblike { background: #2e2e2e; }
	.like-dislike > li:hover a { transform: scale(1.1); }
	.like-dislike { list-style: outside none none; }
	.like-dislike > li a:hover { background: #2e2e2e; transform: scale(1.1); }
	.post-meta { float: left; margin-top: 15px; width: 100%; position: relative; }
	.post-meta > figure,
	.post-map{ display: inline-block; margin: 0; position: relative; width: 100%; }
	.post-meta > figure .like-dislike,
	.post-map .like-dislike{ bottom: -12px; top: auto; transform: translate(-50%, 0px); }
	.post-meta > figure img { float: left; width: 100%; }
	.post-meta .description:first-child { margin-top: 10px; }
	.description { float: left; margin-top: 30px; width: 100%; position: relative; }
	.description > h2 { color: #515365; font-weight: 400; font-size: 23px; margin-bottom: 20px; }
	.description p a { font-size: 13px; }
	.description p a:hover { text-decoration: underline; }
	.blog-post .friend-info > figure { width: 11%; }
	.blog-post .friend-name { width: 87.7%; }
	.blog-post .we-video-info > ul { width: 100%; }
	.vdeo-link {
		display: inline-block;
		position: relative;
		width: 100%;
	}
	.vdeo-link > h2 {
		color: #fff;
		font-size: 20px;
		font-weight: 500;
		left: 0;
		margin: 0;
		position: absolute;
		text-align: center;
		top: 30px;
		width: 100%;
		z-index: 2;
	}
	
	a.learnmore {
		border-radius: 30px;
		color: #fff;
		display: inline-block;
		font-size: 12px;
		line-height: initial;
		padding: 6px 10px;
		position: absolute;
		right: 20px;
		top: -50px;
		transition: all 0.2s linear 0s;
		background: #f91942;
	}
	a.learnmore:hover{ background: #2e2e2e; }
	.description > p { margin-bottom: 20px; }
	.description > span {
		color: #2a2a2a;
		font-size: 18px;
		font-weight: 500;
		line-height: 28px;
		display: inline-block;
		margin-bottom: 5px;
	}
	/*--- image punch post style ---*/
	.img-bunch > .row { margin: 0; }
	.img-bunch { float: left; width: 100%; position: relative; }
	.img-bunch > .row > div { padding: 0; }
	.img-bunch figure { float: left; margin: 0; padding: 1px; width: 100%; position: relative; }
	.img-bunch .strip { display: unset; }
	.more-photos {
		color: #fff;
		font-size: 30px;
		font-weight: 500;
		height: 100%;
		left: 50%;
		position: absolute;
		text-align: center;
		top: 50%;
		transform: translate(-50%, -50%);
		width: 100%;
	}
	.more-photos > span {
		left: 50%;
		position: absolute;
		top: 50%;
		transform: translate(-50%, -50%);
	}
	.more-photos::before {
		background: rgba(247, 87, 87, 0.83) none repeat scroll 0 0;
		bottom: 0;
		content: "";
		left: 0;
		position: absolute;
		right: 0;
		top: 0;
		z-index: 0;
	}
	/*-- sharing post area ----*/
	
	.we-video-info {
		border-top: 1px solid #ede9e9;
		float: left;
		padding: 8px 0 0;
		position: relative;
		width: 100%;
		z-index: 0;
	}
	
	.we-video-info > ul {
		float: left;
		line-height: 27px;
		margin-bottom: 0;
		margin-top: 13px;
		padding-left: 0;
		width: 66%;
	}
	
	.social-media {
		vertical-align: sub;
	}
	.heart {
	  height: 20px;
	  transform: translateZ(0);
	  color: #b3b1c5;
	  font-size: 16px;
	  cursor: pointer;
	  position: relative;
	  transition: all .3s ease;
	}
	.users-thumb-list > span {
	  color: #23d2e2;
	}
	.heart:hover {
	  color: #2e2e2e;
	}
	.heart::before {
	  content: "❤";
	  position: absolute;
	  color: #A12B2B;
	  opacity: 0;
	}
	.heart.broken {
	  color: #aaa;
	  position: relative;
	  transition: all .3s ease;
	}
	.heart.happy {
	  color: #A12B2B;
	}
	.share-pst {
	  transition: all 0.1s linear 0s;
	  color: #adadfd;
	}
	.share-pst:hover {
	  color: #2e2e2e !important
	}
	.we-video-info > ul li span:hover{
		color: #2e2e2e;
	}
	.we-video-info > ul li {
		display: inline-block;
		font-size: 13px;
		margin-right: 32px;
		vertical-align: middle;
	}
	
	.we-video-info > ul li span {
		font-size: 16px;
		font-weight: 400;
		position: relative;
		color: #adadfd;
	}
	.we-video-info > ul li span.comment{cursor: pointer;}
	.we-video-info > ul li span:hover i{
		animation: 0.6s linear 0s normal none 1 running pulse;
	}
	
	.we-video-info > .users-thumb-list {
		float: right;
		text-align: center;
		width: 32%;
	}
	.we-video-info > ul li:last-child {
		margin-right: 0;
	}
	.we-video-info > .users-thumb-list > span {
		display: block;
		font-size: 11px;
	}
	.we-video-info > .users-thumb-list > span b{
		color: #222;
		font-weight: 500;
	}
	.we-video-info > ul li.upload-date {
		float: right;
		font-size: 12px;
		font-weight: 500;
		text-transform: uppercase;
	}
	.upload-date > i {
		font-size: 13px;
		font-style: normal;
		font-weight: normal;
		margin-left: 5px;
		text-transform: capitalize;
	}
	
	.we-video-info > ul li span.dislike {
		cursor: pointer;
		transition: all 0.2s linear 0s;
	}
	
	.we-video-info > ul li span ins {
		font-size: 11px;
		left: 20px;
		position: absolute;
		text-decoration: none;
		top: -10px;
	}
	
	.we-video-info > ul li span.like {
		cursor: pointer;
		transition: all 0.2s linear 0s;
	}
	
	.we-video-info > ul li span.like:hover 
	.we-video-info > ul li span.dislike:hover {
		transform: scale(1.1);
	}
	.we-video-info > ul li span i{
		font-size: 17px;
	}
	
	.we-video-info ul li .heart {
		display: inline-block;
		font-size: 20px;
		position: relative;
		vertical-align: sub;
	}
	.we-video-info ul li .heart > span {
		color: inherit;
		font-size: 11px;
		left: 20px;
		position: absolute;
		top: -10px;
	}
	
	.rate-n-apply {
		display: inline-block;
		margin-bottom: 20px;
		width: 100%;
	}
	.job-price {
		display: inline-block;
		margin-top: 5px;
		vertical-align: middle;
	}
	.rate-n-apply .main-btn {
		float: right;
		padding: 6px 15px;
	}
	.job-price > span {
		color: #535165;
		font-size: 13px;
		font-weight: 500;
	}
	.job-price > ins {
		font-weight: 500;
		text-decoration: none;
	}
	
	.users-thumb-list > a {
		display: inline-block;
		margin-left: -17px;
		position: relative;
	}
	
	.users-thumb-list > a:first-child {
		margin-left: 0;
	}
	
	.users-thumb-list > a img {
		border: 2px solid #fff;
		border-radius: 50%;
	}
	.users-thumb-list > span > a{
		color: #f91942;
	}
	.users-thumb-list > span > a:hover{
		color: #2e2e2e !important;
	}
	
	
	/*--- comment area ---*/
	
	.coment-area {
		margin-top: 20px;
		width: 100%;
		display: none;
		float: left;
	}
	.we-comet {
	  list-style: none;
	}
	.we-comet {
		float: left;
		width: 100%;
		padding-left: 0;
		list-style: none;
		margin-bottom: 0;
	}
	
	.we-comet > li {
		display: inline-block;
		margin-bottom: 20px;
		width: 100%;
	}
	
	.we-comet > li:last-child {
		margin-bottom: 0;
	}
	
	.comet-avatar {
		display: inline-block;
		max-width: 36px;
		vertical-align: top;
		width: 36px;
	}
	.comet-avatar > img{
		border-radius: 100%;
		width: 35px;
		height: 35px;
	}
	.we-comment {
		border-bottom: 1px solid #ede9e9;
		display: inline-block;
		padding-bottom: 8px;
		padding-left: 8px;
		position: relative;
		vertical-align: top;
		width: 92%;
	}
	
	.inline-itms > a i {
		margin-right: 3px;
		color: #2e2e2e;
	}
	.inline-itms > a span {
		font-size: 11px;
		color: #2e2e2e;
	}
	.inline-itms > a i:hover {
		margin-right: 3px;
		color: #f91942
	}
	.inline-itms > a span:hover {
		font-size: 11px;
		color: #f91942;
	}
	.inline-itms {
		display: inline-block;
		margin-top: 5px;
		width: 100%;
	}
	
	
	.we-comet > li ul {
		border-left: 2px solid #23d2e2;
		list-style: outside none none;
		margin-left: 20px;
		margin-top: 20px;
		padding-left: 15px;
	}
	
	.we-comet > li ul li {
		margin-bottom: 20px;
	}
	
	.we-comet li a.showmore {
		display: table;
		font-size: 12px;
		margin: 0 auto;
		text-transform: capitalize;
		font-weight: 500;
		color: #f91942;
	}
	.we-comet li a.showmore:hover {
		color: #2e2e2e !important;
		text-decoration: underline !important;
	}
	a.underline {
	  position: relative;
	}
	.we-comet > li ul li:last-child {
		margin-bottom: 0;
	}
	
	.coment-head {
		display: inline-block;
		width: 100%;
	}
	
	.we-comment > h5 {
		color: #515365;
		display: inline-block;
		font-size: 14px;
		font-weight: 500;
		margin-bottom: 0;
		margin-right: 8px;
		width: auto;
		text-transform: capitalize;
	}
	.we-comment > h5 a{color: #f91942;}
	.we-comment > h5 a:hover{color: #2e2e2e !important;}
	.we-comment > p {
		display: inline;
		font-size: 14px;
		line-height: 20px;
		margin-bottom: 0;
		margin-top: 0;
	}
	
	.inline-itms > a, 
	.inline-itms > span {
		display: inline-block;
		font-size: 12px;
		margin-right: 10px;
		text-transform: capitalize;
	}
	
	.coment-head > span {
		color: #999;
		font-size: 12px;
		padding-left: 10px;
		display: inline-block;
	}
	
	li.post-comment .comet-avatar {
		display: inline-block;
		max-width: 30px;
		vertical-align: top;
		width: 30px;
	}
	
	.post-comt-box {
		display: inline-block;
		padding-left: 15px;
		position: relative;
		width: 93%;
	}
	
	.post-comt-box form textarea {
		background: #edf2f6 none repeat scroll 0 0;
		border-color: transparent;
		border-radius: 5px;
		color: inherit;
		font-size: 13px;
		height: 80px;
		line-height: 16px;
	}
	.post-comt-box form textarea:focus{
		border-color: rgba(0,0,0,.1);
	}
	
	.add-smiles {
		position: absolute;
		right: 10px;
		top: 50%;
		transform: translateY(-50%);
		width: auto;
		line-height: 10px;
	}
	
	.add-smiles > span {
		font-size: 12px;
		cursor: pointer;
	}
	
	.smiles-bunch {
		background: #fff none repeat scroll 0 0;
		border-radius: 5px;
		top: -63px;
		font-size: 13px;
		padding: 5px;
		position: absolute;
		right: -8px;
		text-align: center;
		width: 150px;
		display: none;
		box-shadow: 0px 3px 7px #ccc;
	}
	
	.smiles-bunch.active {
		display: block;
	}
	
	.smiles-bunch > i {
		cursor: pointer;
		display: inline-block;
		margin-bottom: 4px;
	}
	
	.smiles-bunch::before {
		border-top: 7px solid #fff;
		border-left: 7px solid transparent;
		border-right: 7px solid transparent;
		content: "";
		position: absolute;
		right: 11px;
		bottom: -7px;
		width: auto;
	}
	
	.smiles-bunch > i:hover {
		transform: scale(1.1);
	}
	
	.post-comt-box form button {
		bottom: 2px;
		position: absolute;
		right: 0;
		background: none;
	}
	
	.uploadimage {
		display: inline-block;
		margin-right: 5px;
		vertical-align: middle;
	}
	.uploadimage input{
		display: none;
	}
	.uploadimage .fileContainer [type="file"] {
		left: -22px;
		top: -10px;
		width: 20px;
	}
	.uploadimage > i {
		font-size: 16px;
		position: relative;
		top: 1px;
	}
	.description > p a{
		color: #f91942;
	}
	.description > p a:hover{
		color: #2e2e2e !important;
	}
	.post-meta {
	  float: left;
	  margin-top: 15px;
	  width: 100%;
	  position: relative;
	}
	.align-left {
	  float: left;
	  margin-right: 20px;
	}
	.linked-image {
	  width: 30%;
	  margin-bottom: 15px;
	}
	.linked-image img{
	  max-width: 165px;
	}
	.post-meta .detail > span{
		color: #f91942;
		font-size: 24px;
	  font-weight: 300;
	}
	.post-meta .detail > p {
	  font-size: 15px;
	  letter-spacing: 0.1px;
	  line-height: 26px;
	  margin-bottom: 25px;
	}

	.post-meta .detail > a {
	  font-size: 12px;
	  letter-spacing: 1px;
	  color: #f91942;
	}
	.post-meta .detail > a:hover {
	  color: #2e2e2e !important;
	}
	.strip {
	  display: inline-block;
	  position: relative;
	}
	.play {
	  cursor: pointer;
	  position: absolute;
	  top: 50%;
	  left: 50%;
	  transform: translateY(-50%) translateX(-50%);
	}
	svg {
	  stroke: #fff;
	}
	svg {
	  display: block;
	  margin: 0 auto;
	  overflow: visible !important;
	}
	.stroke-solid {
	  fill: #dd5a58;
	}
	
	.stroke-solid {
	  stroke-dashoffset: 0;
	  stroke-dashArray: 300;
	  stroke-width: 4px;
	  transition: stroke-dashoffset 1s ease, opacity 1s ease;
	  opacity: 0.7;
	}
	.play {
	  cursor: pointer;
	}
	path.icon {
	  fill: #fff;
	}
	.icon {
	  transform: scale(0.8);
	  transform-origin: 50% 50%;
	  transition: transform 200ms ease-out;
	}
	.widget {
	  display: inline-block;
	  position: relative;
	  width: 100%;
	  margin-bottom: 20px;
	  background: #fff;
	  border: 1px solid #ede9e9;
	  border-radius: 6px;
	}
	.widget-title {
	  border-bottom: 1px solid #e6ecf5;
	  color: #515365;
	  display: inline-block;
	  font-size: 16px;
	  font-weight: 500;
	  margin-bottom: 20px;
	  padding: 15px 20px;
	  position: relative;
	  text-transform: capitalize;
	  width: 100%;
	}
	.widget-title::before {
		background: #f91942; 
	}
	.widget-title::before {
	  content: "";
	  height: 15px;
	  left: 0;
	  position: absolute;
	  top: 50%;
	  transform: translateY(-50%);
	  width: 3px;
	}
	.widget-dt{
		font-size: 16px;
		font-weight: 500;
	}
	.wid-sp{
		padding: 0px 11px 0px 11px; 
	}
	.border-wid{
		border-bottom: 1px solid #dedede;
		margin-bottom: 20px;
		margin-top: 20px;
	}
	.border-wid-sp{
		padding: 0px 32px;
	}
	.spoti-dis{
		display: flex;
		margin-bottom: 25px;
	}
	.img-fluid {
	  max-width: 100%;
	  height: auto;
	  margin-right: 4px;
	}
	.spoti-dis label{
		font-size: 10px;
	}
	.spoti-dis p{
		font-size: 15px;
	}
	.widget > ul {
	  display: inline-block;
	  list-style: outside none none;
	  margin-bottom: 0;
	  padding: 0 19px 20px;
	  width: 100%;
	}
	.badgez-widget > li {
	  margin-bottom: 7px;
	  margin-right: 3px;
	  width: 38.4px;
	}
	.widget li > a {
	  display: inline-block;
	  font-size: 13px;
	  font-weight: 400;
	  position: relative;
	  text-transform: capitalize;
	  vertical-align: top;
	}
	.widget li {
	  display: inline-block;
	  position: relative;
	}
	.badgez-widget img{
		height: auto;
	max-width: 100%;
	}
	.see-all {
	  float: right;
	  font-size: 11px;
	  margin-top: 2px;
	  color: #f91942;
	}
	.see-all:hover{
		color: #2e2e2e !important; 
	}
	.link-share{
		float: right;
	}
	.profile-controls {
	  /*background: rgba(255, 255, 255, 0.4) none repeat scroll 0 0;*/
	  border-radius: 7px 0 0 7px;
	  bottom: 20px;
	  display: inline-block;
	  list-style: outside none none;
	  margin: 0;
	  padding: 7px 14px;
	  position: absolute;
	  right: 0;
	  z-index: 8;
	  margin-bottom: -35px;
	}
	.profile-controls > li {
	  color: #fff;
	  display: inline-block;
	  margin: 0 2px;
	  position: relative;
	  vertical-align: middle;
	}
	.profile-controls > li > a, .profile-controls > li > div {
	  background: #888da8 none repeat scroll 0 0;
	  border-radius: 100%;
	  display: inline-block;
	  height: 40px;
	  padding-top: 11px;
	  text-align: center;
	  width: 40px;
	  font-size: 16px;
	  color: white;
	}
	.profile-controls > li:first-child > a {
	  background: #f91942;
	}
	.profile-controls > li:nth-child(2) > a {
	  background: #7750f8;
	}
	.profile-controls > li:nth-child(3) > a {
	  background: #23d2e2;
	}
	.profile-controls > li:nth-child(4) > div {
	  background: #857ec3;
	}
	.banner-below-sec {
	  padding: 0px 0px 0px 0px;
	  margin-bottom: 20px;
	  margin-top: 20px;
	}
	.create-post::before{
		background: #f91942;
	}
	.profile-menu {
		  display: inline-block;
		  line-height: 33px;
		  list-style: outside none none;
		  padding: 0 0px;
		  width: 100%;
		  padding-right: 0;
		  list-style: outside none none;
	}
	
	.profile-menu > li {
	  display: inline-block;
	  margin: 0 13px;
	  vertical-align: middle;
	}
	.profile-menu > li > a {
	  color: #515365;
	  /*display: inline-block;*/
	  font-size: 14px;
	  font-weight: 500;
	  position: relative;
	}
	.profile-menu > li > a.active::after {
	  border-bottom: 10px solid #f91942;
	  border-left: 10px solid transparent;
	  border-right: 10px solid transparent;
	  bottom: -14px;
	  content: "";
	  left: 50%;
	  position: absolute;
	  transform: translate(-50%);
	}
	.profile-menu > li > a.active{
		color: #f91942 !important;
		background: none;
		border: none !important;
	}
	.profile-menu .more {
	  display: inline-block;
	  float: none;
	  position: relative;
	  cursor: pointer;
	}
	.profile-menu .more::before {
	  background: rgba(173, 173, 253, 0.4) none repeat scroll 0 0;
	  border-radius: 100%;
	  content: "";
	  height: 35px;
	  left: 50%;
	  position: absolute;
	  top: 47%;
	  transform: translate(-50%, -50%);
	  transition: all 0.2s linear 0s;
	  width: 35px;
	}
	.profile-menu .more > i {
	  font-size: 18px;
	}
	.profile-menu > li > a:hover{
		color: #2e2e2e !important;
	}
	.fa-ellipsis-h::before {
	  content: "\f141";
	}
	.more .more-dropdown {
	  background: #fff none repeat scroll 0 0;
	  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
	  left: 50%;
	  line-height: initial;
	  list-style: outside none none;
	  padding: 0;
	  position: absolute;
	  text-align: left;
	  top: 100%;
	  transform: translate(-50%) scale(0);
	  visibility: hidden;
	  width: 150px;
	  z-index: 999;
	  transition: all 0.2s linear 0s;
	  border-radius: 8px;
	}
	.more .more-dropdown > li {
	  display: inline-block;
	  font-size: 13px;
	  width: 100%;
	}
	.more .more-dropdown > li a {
	  display: inline-block;
	  padding: 10px 12px;
	  transition: all 0.2s linear 0s;
	  width: 100%;
	}
	
	.more:hover .more-dropdown {
	  transform: translate(-50%) scale(1);
	  visibility: visible;
	}
	.folw-detail {
		display: inline-block;
		list-style: outside none none;
		margin: 0;
		float: right;
		vertical-align: middle;
	}
	.folw-detail > li {
	  display: inline-block;
	  margin: 0 2px;
	  text-align: center;
	}
	.folw-detail > li span {
	  color: #535165;
	  display: inline-block;
	  font-weight: 500;
	  width: 100%;
	}
	.folw-detail ins{
		color: #f91942;
		font-style: normal;
		text-decoration: none;
	}
	.widget-follower{
		display: inline-block;
		position: relative;
		width: 100%;
		margin-bottom: 20px;
		background: #fff;
		border: 1px solid #ede9e9;
		border-radius: 6px;
	}
	.widget-follower > ul {
	  display: inline-block;
	  list-style: outside none none;
	  margin-bottom: 0;
	  padding: 0 20px 20px;
	  width: 100%;
	}
	.widget-follower li {
	  display: inline-block;
	  margin-bottom: 14px;
	  position: relative;
	  width: 100%;
	}
	.followers > li figure {
	  display: inline-block;
	  margin-bottom: 0;
	  max-width: 40px;
	  min-width: 40px;
	  vertical-align: middle;
	  width: 40px;
	}
	.friend-meta > h4 a{
		color: #515365 !important;
	}
	.friend-meta > a{
		color: #f91942 !important;
	}
	.followers > li figure img{
		border-radius: 100%;
	}
	.friend-meta {
	  display: inline-block;
	  padding-left: 10px;
	  vertical-align: middle;
	  width: 80%;
	}
	.friend-meta > h4 {
	  color: #535165;
	  display: inline-block;
	  font-size: 13px;
	  font-weight: 500;
	  margin-bottom: 0;
	  width: 60%;
	}
	.shareicons{
		color: #777777 !important;
		font-size: 15px;
	}
	.your-page{
		  display: inline-block;
	  padding: 0 20px 10px;
	  width: 100%;
	}
	.your-page > figure {
	  display: inline-block;
	  margin-bottom: 0;
	  max-width: 55px;
	  vertical-align: middle;
	  width: 55px;
	}
	.page-meta {
	  display: inline-block;
	  padding-left: 10px;
	  vertical-align: middle;
	  width: 69.8%;
	}
	.page-meta > a {
	  display: inline-block;
	  font-size: 14px;
	  font-weight: 500;
	  text-transform: capitalize;
	  width: auto;
	  color: #515365 !important;
	}
	a.underline::before{
		background: #fa6342;
	}
	.page-meta > span {
	  display: inline-block;
	  font-size: 12px;
	  width: 100%;
	}
	.page-meta > span i {
	  margin-right: 5px;
	  vertical-align: sub;
	}
	.page-meta > span a {
	  color: #515365 !important;
	}
	.page-publishes {
	  border-bottom: 1px solid #e6ecf5;
	  border-top: 1px solid #e6ecf5;
	  display: inline-block;
	  list-style: outside none none;
	  margin-bottom: 0;
	  margin-top: 20px;
	  padding: 7px 0 5px;
	  width: 100%;
	}
	.your-page ul.page-publishes > li {
	  margin-bottom: 0;
	  text-align: center;
	  width: 23.7%;
	}
	.your-page ul.page-publishes > li span {
	  cursor: pointer;
	  display: inline-block;
	  text-align: center;
	  font-size: 12px;
	  line-height: initial;
	}
.your-page ul.page-publishes > li span i {
  font-size: 16px;
  margin: 0;
  display: block;
}
.your-page figure a img {
  border: 1px solid rgba(0,0,0,.2);
}
.your-page > figure img{border-radius: 100%;}
.page-likes {
  float: left;
  margin: 20px 0;
  width: 100%;
}
.nav.nav-tabs.likes-btn {
  border-bottom: medium none;
  display: inline-block;
  width: 100%;
}
.nav.nav-tabs.likes-btn > li {
  float: left;
  margin-bottom: 10px;
  text-align: center;
  width: 50%;
}
.nav.nav-tabs.likes-btn > li a.active{
    background: #f91942;
	color: white !important;
}
.tab-content > .active {
  display: block;
}
.nav.nav-tabs.likes-btn > li a {
  background: #edf2f6 none repeat scroll 0 0;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 500;
  padding: 7px 0;
  text-transform: capitalize;
  width: 100%;
  color: #515365;
}
.nav.nav-tabs.likes-btn > li a:hover { color: #515365 !important; }
.page-likes .tab-content .tab-pane > span {
	color: #515365; float: left; font-size: 20px; font-style: normal; font-weight: 400; text-align: center; width: 100%;
}
.page-likes .tab-content .tab-pane > span i { color: inherit; font-size: 15px; margin-right: 6px; }
.page-likes .tab-content .tab-pane > a{color: #f91942;}
.page-likes .tab-content .tab-pane > a {
	float: left; font-size: 13px; text-align: center; text-transform: capitalize; width: 100%;
}
.page-likes .users-thumb-list { float: left; text-align: center; width: 100%; margin-top: 10px; }
.bnr-information span{ font-size: 13px; color: #f91942; padding: 10px; }
.rating-pro{ background: #f91942; color: white; padding: 8px; font-size: 18px; border-radius: 6px; }
.reatingbox > h5 > span { color: #2a2a2a; font-size: 18px; padding: 0px 0px 0px 7px; }
.reatingbox > h5 { text-align: left; font-size: 14px; color: #777; margin-bottom: 10px; padding: 20px; }
.emoji-wysiwyg-editor{ border: none; }
.cal-time{
	color: #fff;display: block ruby;font-size: 16px;font-weight: 500;margin-bottom: 20px;padding: 15px 20px;position: relative;
	text-transform: capitalize;width: 100%;background: #3e3e3e;border-radius: 6px;
}
.cal-time > span{ color: #f91942; padding: 12px; font-size: 14px; }
.your-page dl{ line-height: 42px; }
.your-page dt{ position: relative; float: left; width: 28px; padding: 0 151px 0 0; line-height: 35px; }
.your-page dd { border-bottom: 1px solid #e6ecf5; line-height: 35px; }
.your-page dd:last-child { border: 0; float: right; color: green; }
.your-page dt:hover{ color: #f91942; }
.direction{ color: #515365; float: right; font-size: 12px; margin-top: 2px; }
.direction:hover{ color: #f91942 !important; }
.fa-direction{ color: #f91942; font-size: 16px; margin-right: 5px; }
.google-map{ display: inline-block; padding: 0 20px 15px; width: 100%; }
.map-fa{ font-size: 18px; color: #333; margin-right: 25px; }
.map-info{ display: inline-block; padding: 0 20px 0px; width: 100%; }
.map-info span{ display: flex; width: 100%; margin-bottom: 16px; }
.map-report{ padding: 0px 0px 20px 60px; }
.map-report a{ font-size: 10px; color: #f91942; }
.pro-intro{ display: flex;}
.profile-section{
	background: #fff none repeat scroll 0 0; display: inline-block; position: relative; width: 100%; border: 1px solid #ede9e9;
    border-radius: 5px; margin-bottom: 20px;
}
/*calender*/
.widget-calender {
	display: inline-block; position: relative; width: 100%; margin-bottom: 20px; background: #fff;
	border: 1px solid #ede9e9; border-radius: 6px;
}
.post-btn-booking{
    background: #f91942; border: medium none; border-radius: 5px; color: #fff; font-weight: 500; padding: 5px;
    width: 35%; transition: all 0.2s linear 0s; font-size: 10px; float: right;
}
.post-btn-booking:hover { background: #2e2e2e; }
.widget-calender .calender-sp{ margin-bottom: 15px; }
.widget-calender .nav-tabs .nav-link{ text-transform: none; font-size: 12px; border: 1px solid #e6ecf5; }
.widget-calender .nav > li > a{ padding: 10px 17px; }
.widget-calender .nav > li > a:active{ color: #f91942 !important; text-decoration: none; border: none; }
.widget-calender a.active, .review-btn-links:hover { color: #f91942 !important; text-decoration: none !important; border: none !important; }
.widget-calender .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus{
    color: #f91942; cursor: default; background-color: #8a1b1b00; border: 1px solid #e6ecf5; font-weight: 500;
}
.widget-calender .main-calendar-tab-content{ display: inline-block; }
.widget-calender .calendar-tab-content{ padding: 5px; float: left; display: grid; }
.widget-calender .calendar-tab-content h5{ font-weight: 600; font-size: 11px; float: left; }
.widget-calender .calendar-tab-content p{ font-size: 11px; }
.widget-calender .calendar-tab-content-right{ padding: 5px; float: right; display: grid; }
.widget-calender .calendar-tab-content-right h5{ font-weight: 600; font-size: 11px; float: right; }
.widget-calender .calendar-tab-content-right p{ font-size: 11px; float: right; }
.widget-calender .calendar-tab-content-right a{ text-decoration: underline; }
.widget-calender .calendar-content-border{ border-bottom: 1px solid #ede9e9; }
.ui-widget-header {
	border: 1px solid #f91942 !important; background: #f91942 50% 50% repeat-x !important; color: #ffffff; font-weight: bold;
}
.ui-widget.ui-widget-content { border: 1px solid #cccccc; width: 100%; }
.ui-datepicker table{ background: #fff !important; }
.ui-state-default, .ui-widget-content .ui-state-defaul{ color: #030303 !important; }
.ui-state-active{ border: 1px solid #f91942 !important; background: #f91942 !important; }
/*.ui-state-default{ border: none !important; background: #fefefe !important; }*/
.ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight{border: 1px solid #000 !important; background: #f91942 !important;}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{border: 1px solid #fff !important; background: #fff;}

/*calender end*/

/* tabs */
.nav-tabs .nav-link{
	margin-right: 0px; background-color: #fff; text-transform: uppercase; font-size: 14px; color: #555; font-weight: 500;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
	color: #f91942; cursor: default; background-color: transparent; font-weight: 500; border-bottom: 2px solid #f91942;
}
.nav-tabs .nav-item .active{ color: #f91942 !important; text-decoration: none; border: none !important; }
.nav-tabs a.active{ color: #f91942 !important; border: none !important; }
.photo-tab-imgs img{ margin-bottom: 25px; border: 1px solid #ddd; }
.bixrwtb6 { object-fit: cover; }
.video-tab-iframe{ margin-bottom: 20px; }
.video-tab-iframe iframe{
  max-width: 100%;
  border-color: white;
  height: auto;
  width: 886px;
}
.checkwebcam label{ margin-top: 5px; }
.share.sharefb.facebook { margin-left: 10px; }
.share.sharefb.facebook i{ font-size: 14px; padding-right: 5px; }
/*.share.sharefb.facebook i { display: inline-block; font: normal normal normal 14px/1 FontAwesome; font-size: inherit;text-rendering: auto; -webkit-font-smoothing: antialiased; } */

/* tabs end */
    @media screen and (max-width: 400px){
        .video-box {
            background-color: #fff;
            padding: 25px;
            margin-bottom: 20px;
        }
        .border {
            width: 46%;
            height: 400px;
            border-radius: 8px;
        }
        .img-wrap {
            position: relative;
            /* float: left; */
            width: 100%; 
        }
        .thumbnail-inner img {
            width: 270px;
            height: auto;
            margin: 7px 0px 0px 0px;
            border: 3px solid white;
            border-radius: 5px;
            opacity: 0.5;
            cursor: pointer;
            border-radius: 8px;
        }
        .file-upload .image-upload-wrap {
            border: 2px dashed #dddddd;
            background-color: #f7f9fb;
            position: relative;
            padding: 15px 0;
            border-radius: 6px;
            width: 45%;
        }
        .top-1 {
            margin-top: 25px;
            margin-bottom: 20px;
            margin-left: 45px;
        }
        .family_edit {
          color: #f53b49;
          font-size: 15px;
          font-weight: 300;
          background: white;
          padding: 5px;
          top: 171px;
          margin-left: 250px;
          position: absolute;
        }
        .banner-fs {
          height: 371px;
          padding-top: 164px;
          overflow: hidden;
        }
        .mobile-social img{
            width: 20px;
        }
        .mobile-social{
            display: flex;
        }
        .menu{
            display: none;
        }
        .social-icon-ph ul li {
            margin-left: 15px;
        }
        .story-postbox > .row > div {
            width: 25%;
            display: table-cell;
        }
        .friend-name {
          width: 84%;
        }
        .post-meta .we-video-info > ul {
          width: 100%;
        }
        .we-video-info > .users-thumb-list {
          width: 100%;
          margin-top: 10px;
        }
        .we-comment {
          width: 85%;
        }
        .we-comment {
          width: 85%;
        }
        .post-comt-box {
          width: 87%;
          padding-left: 11px;
        }
        .post-meta .detail {
          width: 100%;
        }
        .linked-image img {
          max-width: 86px;
        }
        
        .profile-menu > li {
          display: inline-block;
          margin: 0 8px;
          vertical-align: middle;
        }
        .newpst-input {
          width: 81%;
        }
        .profile-controls{
            
            display: contents;
        }
        
            /*calender*/
        .widget-calender .calendar-tab-content-right {
          float: none;
        }
        .widget-calender .calendar-tab-content-right h5{
            float: none;
            font-size: 14px;
        }
        .widget-calender .calendar-tab-content-right p {
            font-size: 13px;
            float: none;
        }
        .widget-calender .calendar-tab-content h5 {
          font-weight: 600;
          font-size: 14px;
        }
        .widget-calender .calendar-tab-content p {
          font-size: 13px;
        }
        
        /*calender end*/
    }
    @media screen and (min-width: 401px) and (max-width: 767px){
        .video-box {
            background-color: #fff;
            padding: 25px;
            margin-bottom: 20px;
        }
        .border {
            width: 55%;
            height: 400px;
            border-radius: 8px;
        }
        .img-wrap {
            position: relative;
            /* float: left; */
            width: 100%; 
        }
        .thumbnail-inner img {
            width: 330px;
            height: auto;
            margin: 7px 0px 0px 0px;
            border: 3px solid white;
            border-radius: 5px;
            opacity: 0.5;
            cursor: pointer;
            border-radius: 8px;
        }
        .file-upload .image-upload-wrap {
            border: 2px dashed #dddddd;
            background-color: #f7f9fb;
            position: relative;
            padding: 15px 0;
            border-radius: 6px;
            width: 55%;
        }
        .top-1 {
            margin-top: 25px;
            margin-bottom: 20px;
            margin-left: 70px;
        }
        .family_edit {
          color: #f53b49;
          font-size: 15px;
          font-weight: 300;
          background: white;
          padding: 5px;
          top: 170px;
          margin-left: 281px;
          position: absolute;
        }
        .banner-fs {
          height: 371px;
          padding-top: 165px;
          overflow: hidden;
        }
        .mobile-social img{
            width: 20px;
        }
        .mobile-social{
            display: flex;
        }
        .menu{
            display: none;
        }
        .social-icon-ph ul li {
            margin-left: 15px;
        }
        .story-postbox > .row > div {
            width: 25%;
            display: table-cell;
        }
        .friend-name {
          width: 86%;
        }
        .post-meta .we-video-info > ul {
          width: 100%;
        }
        .we-video-info > .users-thumb-list {
          width: 100%;
          margin-top: 10px;
        }
        .we-comment {
          width: 87%;
        }
        .post-comt-box {
          width: 89%;
        }
        .linked-image img {
          max-width: 110px;
        }
        .post-meta .detail {
          width: 100%;
        }
        .profile-menu > li {
          display: inline-block;
          margin: 0 13px;
          vertical-align: middle;
        }
        .newpst-input {
          width: 81%;
        }
        .profile-controls{
            padding: 0px 71px 20px 71px;
            display: contents;
        }
            /*calender*/
        .widget-calender .calendar-tab-content-right {
          float: none;
        }
        .widget-calender .calendar-tab-content-right h5{
            float: none;
            font-size: 14px;
        }
        .widget-calender .calendar-tab-content-right p {
            font-size: 13px;
            float: none;
        }
        .widget-calender .calendar-tab-content h5 {
          font-weight: 600;
          font-size: 14px;
        }
        .widget-calender .calendar-tab-content p {
          font-size: 13px;
        }
        /*calender end*/
}
    @media screen and (min-width: 768px) and (max-width: 992px){
        .video-box {
            background-color: #fff;
            padding: 40px;
            margin-bottom: 20px;
        }
        .border {
            width: 100%;
            height: 400px;
            border-radius: 8px;
        }
        .img-wrap {
            position: relative;
            /* float: left; */
            width: 100%; 
        }
        .thumbnail-inner img {
            width: 100%;
            height: auto;
            margin: 7px 0px 0px 0px;
            border: 3px solid white;
            border-radius: 5px;
            opacity: 0.5;
            cursor: pointer;
            border-radius: 8px;
        }
        .file-upload .image-upload-wrap {
            border: 2px dashed #dddddd;
            background-color: #f7f9fb;
            position: relative;
            padding: 15px 0;
            border-radius: 6px;
            width: 94%;
        }
        .img-wrap .unselectPhoto {
            position: absolute;
            top: 55px;
            right: 235px;
            z-index: 100;
            font-size: 16px;
            color: #00ff00;
        }
        .top-1 {
          margin-top: 15px;
          margin-left: 245px;
          margin-bottom: 15px;
        }
        .family_edit {
              color: #f53b49;
              font-size: 17px;
              font-weight: 300;
              background: white;
              padding: 7px;
              top: 133px;
              margin-left: 371px;
              position: absolute;
        }
        .banner-fs {
          height: 371px;
          padding-top: 126px;
          overflow: hidden;
        }.mobile-social img{
            width: 20px;
        }
        .mobile-social{
            display: flex;
        }
        .menu{
            display: none;
        }
        .social-icon-ph ul li {
            margin-left: 15px;
        }
        .story-postbox > .row > div {
            width: 25%;
            display: table-cell;
        }
        .profile-menu > li {
          display: inline-block;
          margin: 0 13px;
          vertical-align: middle;
        }
        .newpst-input {
          width: 81%;
        }
        .profile-controls{
            padding: 0px 71px 20px 71px;
            display: contents;
        }
        
        .profile-menu > li > a.active::after{
            bottom: -25px;
        }
    }
	@media screen and (min-width: 1000px) and (max-width: 1049px){
		.emoji-picker-icon{ right: 39%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1050px) and (max-width: 1099px){
		.emoji-picker-icon{ right: 43%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1100px) and (max-width: 1149px){
		.emoji-picker-icon{ right: 45%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1150px) and (max-width: 1199px){
		.emoji-picker-icon{ right: 48%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1200px) and (max-width: 1249px){
		.emoji-picker-icon{ right: 51%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1250px) and (max-width: 1299px){
		.emoji-picker-icon{ right: 53%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1300px) and (max-width: 1349px){
		.emoji-picker-icon{ right: 55%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1350px) and (max-width: 1399px){
		.emoji-picker-icon{ right: 56%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1400px) and (max-width: 1449px){
		.emoji-picker-icon{ right: 58%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1450px) and (max-width: 1499px){
		.emoji-picker-icon{ right: 59%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1500px) and (max-width: 1549px){
		.emoji-picker-icon{ right: 61%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1550px) and (max-width: 1599px){
		.emoji-picker-icon{ right: 62%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1600px) and (max-width: 1649px){
		.emoji-picker-icon{ right: 63%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1650px) and (max-width: 1699px){
		.emoji-picker-icon{ right: 64%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1700px) and (max-width: 1749px){
		.emoji-picker-icon{ right: 65%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
	@media screen and (min-width: 1750px) and (max-width: 1799px){
		.emoji-picker-icon{ right: 66%; top: 67%; font-size: 17px; }
		.newpst-input { width: 85%; }
	}
    @media screen and (min-width: 1920px) and (max-width: 2500px){
        .family_edit {
            color: #f53b49;
            font-size: 20px;
            font-weight: 300;
            background: white;
            padding: 10px;
            top: 81px;
            margin-left: 434px;
            position: absolute;
        }
        .banner-fs {
          height: 371px;
          padding-top: 73px;
          overflow: hidden;
        }
        .border {
          width: 848px;
          height: 400px;
          border-radius: 8px;
        }
        .table-responsive {
          min-height: 4.01%;
          overflow-x: inherit;
        }
        .thumbnail-inner {
          width: 848px;
          height: 190px;
          overflow-y: auto;
        }
        
        .your-page dt{
            padding: 0 293px 0 0;
        }
            /*calender*/
        .widget-calender .calendar-tab-content-right {
          float: right;
          display: grid;
        }
        .widget-calender .calendar-tab-content-right h5{
            float: right;
            font-size: 14px;
        }
        .widget-calender .calendar-tab-content-right p {
            font-size: 13px;
            float: right;
        }
        .widget-calender .calendar-tab-content h5 {
          font-weight: 600;
          font-size: 14px;
        }
        .widget-calender .calendar-tab-content p {
          font-size: 13px;
        }
        /*calender end*/
    }
    
	.selfieresult{ padding-top:20px; text-align: center; }
	#cameradiv .theme-red-bgcolor{ padding: 10px 30px; }
	
</style>

<?php
use App\CompanyInformation;
use App\Review; 
use App\User; 
use App\PostLike;
use App\PostReport;
use App\PostComment;
use App\ProfileSave;
use App\ProfilePost;

?>

<?php
$loggedinUser = Auth::user();
$customerName = $loggedinUser->firstname . ' ' . $loggedinUser->lastname;

$profilePicture = $loggedinUser->profile_pic;
$coverPicture = $loggedinUser->cover_photo;
if (isset($_GET['cover']) && $_GET['cover'] == 1) {
    ?>
    <script type="text/javascript">
        alert("Cover photo updated successfully.");
        var uri = window.location.href.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }
    </script>
    <?php
}
?>
<div class="banner banner-fs">
    <a href="javascript:void(0);">
        <?php        
        if (!empty($viewgallery)) {
            $totalwid = count($viewgallery);
            $width = 100/$totalwid;
            ?>
			<div class="4img-slider">
				<div class="con-width">
				<?php foreach (array_slice($viewgallery, 0, 4) as $pic) { ?>
					<div class="one" style="width:{{$width}}%">
						<img style="padding:0; margin:0;"  width="{{$width}}%" height="300" src="/public/uploads/gallery/<?= $loggedinUser->id ?>/thumb/<?= $pic['name'] ?>" />
						<i class="fa fa-pen editpic editpic-fs" id="{{$pic['id']}}"  imgname="{{$pic['name']}}" data-toggle="modal" data-target="#uploadgalaryPic"></i>
					</div>    
                <?php } ?>
                 </div>
            </div>
        <?php } else { ?> 
            <a href="javascript:void(0);" data-toggle="modal" data-target="#uploadCoverPic">
                @if(!empty($coverPicture))
                <img src="{{ url('/public/uploads/cover-photo/'.$UserProfileDetail['cover_photo']) }}" alt="images" class="img-fluid">
                @else
                <img src="/public/images/newimage/banner.jpg" alt="images" class="img-fluid">
                @endif
            </a>
        <?php } ?>
    </a>
</div>
@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
        	@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success fade in alert-dismissible show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
            <span aria-hidden="true" style="font-size:20px">×</span>
        </button> {{ session()->get('success') }}
    </div>
@elseif(session()->has('error'))
	<div class="alert alert-danger fade in alert-dismissible show">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
			<span aria-hidden="true" style="font-size:20px">×</span>
		</button> {{ session()->get('error') }}
	</div>
@endif
<section class="banner-below-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-2">
                <div class="comp-mark">
                    @if(File::exists(public_path("/uploads/profile_pic/thumb/".$UserProfileDetail['profile_pic'])))
                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.$UserProfileDetail['profile_pic']) }}" alt="images" class="img-fluid">
                    @else
                    <img alt="" src="http://2.gravatar.com/avatar/?s=35&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/?s=70&amp;d=mm&amp;r=g 2x" class="avatar avatar-35 photo avatar-default" height="35" width="35" loading="lazy">
                    @endif
                    <a href="javascript:void(0);" class="edit-pic" data-toggle="modal" data-target="#editProfilePic" title="Click here to change picture">
                        <div id="mycamera"  style="color:#fff;background-color:#000;height:30px;width:30px;border-radius:15px;position: absolute;right: 23px;bottom: 2px;">
                            <span class="fa fa-camera" style="position: relative; left: -7px; top: 7px;"></span>
                        </div>
                    </a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="get_started" role="dialog">
					{!! Form::open(array('url'=>url('/profile/inquirySubmit'),'method'=>'POST','class'=>'get_started')) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
						<div class="modal-content">
							<div class="modal-body login-pad">
                                <div class="pop-title employe-title"><h3>Inquiry Box </h3></div> 
                                <button type="button" class="close modal-close" data-dismiss="modal">
                                	<img src="/public/images/close.jpg" height="70" width="34">
                            	</button>                              
                                <div class="signup">
                                    <div class="emplouyee-form">
                                        <input class="" type="text" name="name" id="name" class="form-control" placeholder="Name">
                                        <span class="error" id="err_name_sign"></span>

                                        <input class="" type="text" name="email" id="email" class="form-control" placeholder="Email">
                                        <span class="error" id="err_email_sign"></span>

                                        <input class="" type="text" name="message" id="message" class="form-control" placeholder="Message">
                                        <span class="error" id="err_message_sign"></span>
                                     
                                        <button type="button" class="inquiryfrm">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- Modal Ends -->
                <!-- Modal -->
                <div class="modal fade" id="editProfilePic" role="dialog">
                    {!! Form::open(array('url'=>url('/profile/editProfilePicture'),'method'=>'POST','files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmeditProfile_side')) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body login-pad">
                                <div class="pop-title employe-title"><h3>EDIT PROFILE PICTURE</h3></div>
                                <button type="button" class="close modal-close" data-dismiss="modal">
                                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                                </button>
                                <div class="signup">
                                    <div id='systemMessage'></div>
                                    <div class="emplouyee-form">
                                        <input class="upload-pic" type="file" name="profile_pic" id="profile_pic" class="form-control">
                                        <input type="hidden" name="croped_img" id="croped_img">
                                        <img class="result" id="result">
                                        <button type="submit" id="submit_profilepic">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- Modal Ends -->
                <!-- Modal -->
                <div class="modal fade" id="editusername" role="dialog">
                    {!! Form::open(array('url'=>url('editUsername'),'method'=>'POST')) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body login-pad">
                                <div class="pop-title employe-title"><h3>EDIT USERNAME</h3></div>
                                <div class="signup">
                                    <div class="emplouyee-form">
                                        <input class="" type="text" name="username" id="username" class="form-control">
                                        <button type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- Modal Ends -->
            </div>

            <div class="col-lg-6">
                <div class="bnr-information">
                    <h2 style="text-transform: capitalize;">{{$customerName}}</h2>
                    <h6>@if(isset($UserProfileDetail['quick_intro'])) {!! nl2br(@$UserProfileDetail['quick_intro']) !!} @else  @endif</h6>
                    <div class="url-copy">  
                        <div>
                            <p>http://fitnessity.co/yournamehere </p>
                            <!-- <button onclick="myFunction()" style="background: white;border: none; margin-left: 10px;">Copy URL</button>-->
                       </div>
                       <div class="link-share"><p> Share Link </p></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 top-1">
                <div class="reatingbox"><!-- <h5><i class="fa fa-star rating-pro"></i><span>5.0 </span>(100) </h5> --> <div>
				<ul class="profile-controls">
					<!-- <li><div class=""><i class="fa fa-star"></i></div></li>-->
					<li><a href="#" title="Add friend" data-toggle="tooltip"><i class="fa fa-user-plus"></i></a></li>
					<li><a href="#" title="Follow" data-toggle="tooltip"><i class="fa fa-star"></i></a></li>
					<li><a class="send-mesg" href="#" title="Send Message" data-toggle="tooltip"><i class="fa fa-comment"></i></a></li>
                    <!--<li>
                    		<div class="edit-seting" title="Edit Profile image"><i class="fa fa-sliders"></i>
								<ul class="more-dropdown">
									<li><a href="../../index.html" title="">Update Profile Photo</a></li>
									<li><a href="../../index.html" title="">Update Header Photo</a></li>
									<li><a href="../../index.html" title="">Account Settings</a></li>
									<li><a href="../../index.html" title="">Find Support</a></li>
									<li><a class="bad-report" href="#" title="">Report Profile</a></li>
									<li><a href="#" title="">Block Profile</a></li>
								</ul>
							</div>
						</li>-->
					<li class="shareicons"><i class="fa fa-share-alt"></i> Share</li>
				</ul>
                <!--<a><img src="/public/images/newimage/share.png" alt="icon">Share</a>-->
			</div>
			<div class="social">
			</div>
		</div>

    </div>
</section>

<!-- Modal -->
<div class="modal" id="uploadCoverPic" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body login-pad">
                <div class="pop-title employe-title">
                    <h3>Change Cover Photo</h3>
                </div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div class="signup">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="cover-tagbox">
                                <i class="fas fa-info-circle"></i>
                                <span>Your Cover Photo will be used to customize the header of your profile.</span>
                            </div>
                            <div class="file-upload">
                                <form name="frm_cover" id="frm_cover" action="{{Route('savemycoverphoto')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="image-upload-wrap piccrop_block" id="file1"@if(@$UserProfileDetail['cover_photo']!="" ) style="display: none;" @endif>
                                         <input class="file-upload-input" name="coverphoto" id="coverphoto" type='file' onchange="readURL(this);" accept="image/*" />

                                        <div class="drag-text">
                                            <h3>Drop your image here</h3>
                                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger('click')">Select Your File</button>
                                        </div>
                                        <img class="card-img-top" id="thumb-2" src="">
                                    </div>
                                    @if ($errors->has('coverphoto'))
                                    <span class="help-block" style="color:red">
                                        <strong>Upload your photo</strong>
                                    </span>
                                    @endif
                                    <div class="file-upload-content piccrop_block" id="file1"@if(@$UserProfileDetail['cover_photo']!="" ) style="display: block;" @endif>
                                         @php
                                         if(@$UserProfileDetail['cover_photo']!="")
                                         $path='public/uploads/cover-photo/'.$UserProfileDetail['cover_photo'];
                                         else
                                         $path="#"

                                         @endphp
                                         <img class="file-upload-image" src="/{{$path}}" alt="your image" height="100px" />
                                    </div>
                                    <div class="highlighted-txt-yellow">
                                        For best result, upload an image that is 1950px by 450px or larger.
                                    </div>
                                    <p>If you'd like to delete your current cover photo, use the delete Cover Photo button.</p>
                                    <div class="image-title-wrap">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                        <button type="submit" id="submit_cover" name="submit_cover" class="remove-image">Save My Cover Photo</button>&nbsp;&nbsp;
                                        <button type="button" style="background:#000" onclick="removeUpload_coverphoto()" class="remove-image">Delete My Cover Photo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal" id="uploadgalaryPic" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body login-pad">  
                <div class="pop-title employe-title"><h3>Change Photo</h3></div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div class="signup">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="cover-tagbox">
                                <i class="fas fa-info-circle"></i>
                                <span>Your Cover Photo will be used to customize the header of your profile.</span>
                            </div>
                            <div class="file-upload">
                                <form name="frm_cover" id="frm_cover" action="{{Route('savemyprofilepic')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="image-upload-wrap piccrop_block" id="file1"@if(@$UserProfileDetail['cover_photo']!="" ) style="display: none;" @endif>
                                         <input class="file-upload-input" name="galaryphoto" id="galaryphoto" type='file' onchange="readURL(this);" accept="image/*" />
                                        <div class="drag-text">
                                            <h3>Drop your image here</h3>
                                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger('click')">Select Your File</button>
                                        </div>
                                        <img class="card-img-top" id="thumb-2" src="">
                                    </div>
                                    @if ($errors->has('coverphoto'))
                                    <span class="help-block" style="color:red">
                                        <strong>Upload your photo</strong>
                                    </span>
                                    @endif
                                    <div class="" id="file1"@if(@$UserProfileDetail['cover_photo']!="" ) style="display: block;" @endif>
                                        <input type="hidden" name="imgId" id="imgId">
                                        <input type="hidden" name="imgname" id="imgname">
                                         <img class="file-upload-image srcappend" src="/{{$path}}" alt="your image" height="100px" />
                                    </div>
                                    <div class="image-title-wrap">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                        <button type="submit" id="submit_cover" name="submit_cover" class="remove-image">Save My Cover Photo</button>&nbsp;&nbsp;
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- preview Modal -->
<div class="modal" id="previewmodel" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body login-pad">  
                <div class="pop-title employe-title"><h3>Preview Post</h3></div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div>                  
                    <div class="loadMore">
                        <!-- foreach -->
                        <div class="central-meta item">
                                <div class="user-post">
                                    <div class="friend-info">
                                        <figure><img src="/public/images/newimage/nearly1.jpg" alt=""></figure>
                                        <div class="friend-name">
                                            <ins><a href="#" title="">{{ucfirst($loggedinUser->firstname)}} {{ucfirst($loggedinUser->lastname)}}</a> Post Album</ins>
                                        </div>
                                        <div class="post-meta">
                                           <p class="postText"></p>
                                            <figure>
                                                <div class="img-bunch" id="add_image">
                                                    <div class="row" >
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                               	</a>
                                                            </figure>
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                              	</a>
                                                            </figure>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                </a>
                                                            </figure>
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                </a>
                                                            </figure>
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                </a>
                                                                <div class="more-photos"><span>+12</span></div>
                                                            </figure>
                                                        </div>
                                                    </div> <!-- row -->
                                                </div><!-- img-bunch -->
                                            </figure>  
                                        </div>
                                    </div><!-- friend-info -->
                                </div>
                            </div>
                        <!-- end foreach -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- edit Modal -->
<div class="modal" id="edit_post" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body login-pad">  
                <div class="pop-title employe-title"><h3>Edit Post</h3></div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div>                  
                    <div class="loadMore">
                        <!-- foreach -->
                        <div class="central-meta item">
                                <div class="user-post">
                                    <div class="friend-info">
                                        <form method="post" action="{{route('profilePostupdate')}}" enctype="multipart/form-data" >
                                            @csrf

                                            <figure><img src="/public/images/newimage/nearly1.jpg" alt=""></figure>
                                            <div class="friend-name">
                                                <ins><a href="#" title="">{{ucfirst($loggedinUser->firstname)}} {{ucfirst($loggedinUser->lastname)}}</a> Post Album</ins>
                                            </div>
                                            <input type="text" class="post_textemoji" id="post_textemoji"  name="post_text_upd" data-emojiable="true" >     
                                            <div class="post-meta" id="edit_image"></div>
                                            <button class="post-btn " type="submit" data-ripple="">Update Post</button>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- central-meta -->
                        <!-- end foreach -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="editProfileDetailModal" role="dialog">
    {!! Form::open(array('id' => 'frmeditProfileDetail')) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body login-pad">
                <div class="pop-title employe-title"><h3>EDIT Personal Info</h3></div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div class="signup">
                    <div id='systemMessage_detail'></div>
                    <div class="emplouyee-form">
                        <input type="text" name="firstname" id="frm_firstname" placeholder="First Name" value="{{ old('firstname',$UserProfileDetail['firstname']) }}">
                        <input type="text" name="lastname" id="frm_lastname" placeholder="Last Name" value="{{ old('lastname',$UserProfileDetail['lastname']) }}">
                        <input type="text" name="username" id="frm_username" placeholder="User Name" value="{{ old('username',$UserProfileDetail['username']) }}">
                        <?php $gender = array('' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'); ?>
                        <div class="select-style review-select2">
                            <!--{!! Form::select('gender', $gender, $UserProfileDetail['gender'], ['class' => 'selectpicker', 'id' => 'frm_gender']) !!}-->
                            <select name="gender" class="form-control" id="frm_gender">
                                <option hidden>Select Gender</option>
                                <option value="male" {{ (old('gender',$UserProfileDetail['gender'])=='male')?'selected':'' }}>Male</option>
                                <option value="female" {{ (old('gender',$UserProfileDetail['gender'])=='female')?'selected':'' }}>Female</option>
                            </select>
                        </div>
                        <input type="text" name="email" id="frm_email" placeholder="Email" readonly class="disable-input" value="{{ old('email',$UserProfileDetail['email']) }}">
                            <!-- <input type="text" name="phone_number" id="frm_phone_number" placeholder="(XXX) XXX XXX" value=""> -->
                        <input type="text" name="phone_number" required placeholder="(xxx)xxx-xxxx" class="form-control" data-inputmask='"mask": "(999)999-9999"' data-mask value="{{ old('phone_number',$UserProfileDetail['phone_number']) }}">
                            <!--<input type="text" name="address" id="frm_address" placeholder="Address" maxlength="255">-->
                        <input autocomplete="nope" type="text" name="address" id="frm_address" oninput="initialize1(this)" placeholder="Address" value="{{ old('address',$UserProfileDetail['address']) }}">
                        <input type="text" name="city" id="frm_city" placeholder="City" value="{{ old('city',$UserProfileDetail['city']) }}">
                        <input type="text" name="state" id="frm_state" placeholder="State" value="{{ old('state',$UserProfileDetail['state']) }}">
                        <input type="text" name="country" id="frm_country" placeholder="Country" value="{{ old('country',$UserProfileDetail['country']) }}">
                        <input type="text" name="zipcode" id="frm_zipcode" placeholder="Zipcode" maxlength="6" value="{{ old('zipcode',$UserProfileDetail['zipcode']) }}">
                        <textarea placeholder="Intro ..." name="intro" id="message_area" rows="7" maxlength="120" required>@if(isset($UserProfileDetail['intro'])){!! $UserProfileDetail['intro'] !!}@endif</textarea>
                        <p>
                            <span class="hint" style="color:red" id="textarea_message">
                        </p>
                        <textarea placeholder="Tell Us Somthing About You..." name="about_me" id="about_msg" rows="7" maxlength="300" required>@if(isset($UserProfileDetail['about_me'])){!! $UserProfileDetail['about_me'] !!}@endif</textarea>
                        <p>
                            <span class="hint" style="color:red" id="aboutarea_message">
                        </p>
                        <button type="button" id="submit_profiledetail" onclick="$('#frmeditProfileDetail').submit();">Submit</button>
                    </div> <!-- emplouyee-form -->
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<section class="desc-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="widget">            
                	<h4 class="widget-title">Profile Intro</h4>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="wid-sp">
                                <h4 class="widget-dt">Details</h4>
                            </div>
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="wid-sp">
                                <b> Username: </b>
                                @if(isset($UserProfileDetail['username'])) {{ "@".$UserProfileDetail['username']}}
                                @else - @endif
                            </div>
                        </div>
                    </div>
                	<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="wid-sp">
                                <div class="pro-intro">
                                    <b> Member Since:  </b> <p> 08/21</p>
                                </div>
                                <div class="pro-intro">
                                    <b> Gender: </b> <p> Male</p>
                                </div>
                                <div class="pro-intro">
                                    <b> Birthday:  </b> <p> June 21st, 1982</p>
                                </div>
                            </div>
                    	</div>
                	</div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="wid-sp img-bot">
                                <img src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" alt="images" class="img-fluid" width="25" height="15">
                        		New York, NY United States
                        	</div>
                        	<div class="border-wid-sp"><div class="border-wid"></div></div>
                            <div class="wid-sp">
                                <h4 class="widget-dt">Favorite Activities To Do</h4> &nbsp;
                                <p>Tae Kwon Do - ATV - Kickboxing - BJJ - Yoga Badmitton - Running – Swimming </p>
                            </div>
                            <div class="border-wid-sp"><div class="border-wid"></div></div>
                            <div class="wid-sp">
                                <h4 class="widget-dt">Favorite Workout Music</h4> &nbsp;
                                <div class="spoti-dis">
                                    <img src="/images/newimage/spotify.png" alt="images" class="img-fluid" width="20" height="12">
                                        <p>Spotify Play List</p>
                                        <label>View List</label>
                                </div>
                            </div>
                    	</div>
                	</div>  
          		</div>  
            	<!-- calender-->
            	<div class="widget-calender">
            		<h4 class="widget-title">BOOKING REMINDER
						<button class="post-btn-booking" type="button" data-ripple="">View Bookings</button>    
					</h4>
                    <div class="calender-sp"><div id="myDate" name="myDate"></div></div>
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item active">
							<a class="nav-link" data-toggle="tab" href="#tabs-11" role="tab">Todays Activities: 3</a>
						</li>
                        <li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#tabs-22" role="tab">Upcoming Activities: 10</a>
						</li>
					</ul>
                	<div class="tab-content">
						<div class="tab-pane active" id="tabs-11" role="tabpanel">
							<div class="row">
								<div class="col-sm-12 col-md-6 col-lg-6 ">
									<div class="calendar-tab-content">
										<h5>Kickboxing For Adults</h5>
										<p>Valor Mixed Martial Arts</p><p>New York, United States</p>
									</div>
								</div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
									<div class="calendar-tab-content-right">
										<h5>Nov. 11,2021</h5>
										<p>9:00am - 10:00am(1h)</p><p>Spots(4/20)<a href="#">Invite Friend</a></p>
									</div>
								</div>
							</div>
                            <div class="calendar-content-border"></div>
                            	<div class="row">
									<div class="col-sm-12 col-md-6 col-lg-6">
										<div class="calendar-tab-content">
											<h5>Mini Ninjas MArtial Arts</h5>
											<p>Adams Fitness Center</p><p>New York, United States</p>
										</div>
									</div>                              
									<div class="col-sm-12 col-md-6 col-lg-6">
										<div class="calendar-tab-content-right">
											<h5>Nov. 11,2021</h5>
											<p>11:00am - 11:30am(30m)</p><p>Spots(10/20)<a href="#">Invite Friend</a></p>
										</div>
									</div>
								</div>
                                <div class="calendar-content-border"></div>
                                <div class="row">
									<div class="col-sm-12 col-md-6 col-lg-6">
										<div class="calendar-tab-content">
											<h5>Vinyasa Yoga</h5>
											<p>Yoga Works</p><p>New York, United States</p>
										</div>
									</div>
									<div class="col-sm-12 col-md-6 col-lg-6">
										<div class="calendar-tab-content-right">
											<h5>Nov. 11,2021</h5>
											<p>2:00pm - 3:00am(1h)</p><p>Spots(15/20)<a href="#">Invite Friend</a></p>
										</div>
									</div>
								</div>
							</div>
                            <div class="tab-pane" id="tabs-22" role="tabpanel">
								<p>Second Panel</p>
							</div>
						</div>
           			</div><!-- calender end -->
            
            		<div class="row">
            			<div class="col-sm-12 col-md-12 col-lg-12">
                			<div class="box-red">
								<h1 class="red-box-font">VERIFICATION</h1>
								<div class="veri-icon-new-1">
									<span>
                                    	<a href="{{'tel:'.$UserProfileDetail['phone_number']}}" title="phone" class="cophone"><i class="fa fa-phone" aria-hidden="true"></i></a>
									</span>
									<span>
                                    	<a href="{{'mailto:'.$UserProfileDetail['email']}}" title="email"  class="coemail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
									</span>
									<span>
                                    	<a href="#" title="link"  class="coemail"><i class="fa fa-link" aria-hidden="true"></i></a>
									</span> 
									<span>
                                    	<a href="{{'http://maps.google.com/?q='.$UserProfileDetail['address']}}" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
									</span>
								</div>
                                <!--<img src="/public/img/verification.png" />-->
							</div>
               			</div>
          			</div>
            
            		<div class="widget">
            			<h4 class="widget-title">User Badges <a class="see-all" href="#" title="">See All</a></h4>
                        <ul class="badgez-widget">
							<li>
                            	<a href="#" title="Male User" data-toggle="tooltip">
                                <img src="/images/badges/badge2.png" alt="fitnessity"></a>
							</li>
                            <li>
                            	<a href="#" title="Earned $5000+" data-toggle="tooltip">
                                <img src="/images/badges/badge12.png" alt="fitnessity"></a>
                            </li>
                            <li>
                            	<a href="#" title="10 Years old User" data-toggle="tooltip">
                                <img src="/images/badges/year10.png" alt="fitnessity"></a>
                            </li>
                            <li>
                            	<a href="#" title="Page Admin" data-toggle="tooltip">
                                <img src="/images/badges/badge1.png" alt="fitnessity"></a>
							</li>
                            <li>
                            	<a href="#" title="100+ Refferal" data-toggle="tooltip">
                                <img src="/images/badges/badge8.png" alt="fitnessity"></a>
                            </li>
                            <li>
                            	<a href="#" title="Tranding Posts" data-toggle="tooltip">
                                <img src="/images/badges/badge21.png" alt="fitnessity"></a>
                            </li>
                            <li>
                            	<a href="#" title="1000+ Subscribers" data-toggle="tooltip">
                                <img src="/images/badges/badge3.png" alt="fitnessity"></a>
                            </li>
                            <li>
                            	<a href="#" title="fitness Shirt winner" data-toggle="tooltip">
                                <img src="/images/badges/badge20.png" alt="fitnessity"></a>
                            </li>
                            <li>
                            	<a href="#" title="500+ Followers" data-toggle="tooltip">
                                <img src="/images/badges/badge10.png" alt="fitnessity"></a>
                            </li>
						</ul>
					</div>
            	</div>
            	<div class="col-sm-12 col-md-9 col-lg-9">
            		<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<div class="profile-section">
								<div class="row">
									<div class="col-sm-12 col-md-9 col-lg-9">
										<ul class="nav nav-tabs" role="tablist">
											<li class="active">
												<a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab">Timeline</a>
											</li>
                                            <li>
                                            	<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">About</a>
											</li>
                                            <li>
                                            	<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Photos</a>
											</li>
                                            <li>
                                            	<a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Videos</a>
											</li>
                                            <li>
                                            	<a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Saved</a>
											</li>
                                            <li>
                                            	<a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Tagged</a>
											</li>
										</ul>
									</div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
										<ol class="folw-detail">
											<!-- <li><span>Posts</span><ins>101</ins></li> -->
											<li><span>Followers</span><ins>1.3K</ins></li>
											<li><span>Following</span><ins>22</ins></li>
										</ol>
									</div>
								</div>
							</div>
						</div>
                        <div class="col-sm-12 col-md-8 col-lg-8">
							<div class="tab-content">
								<div class="tab-pane active" id="tabs-1" role="tabpanel">
									<div class="central-meta postbox">
										<form method="post" action="{{route('profilePost')}}" enctype="multipart/form-data" id="profilepostfrm">
                                        	@csrf
                                            <span class="create-post">Post Your Experiences</span>
											<div class="post-img figure">
												<img src="/public/images/newimage/test.jpeg" alt="images">
											</div>
                                            <div class="newpst-input">
												<textarea rows="4" id="post_text" name="post_text" placeholder="Share some of your experiences with activites you booked!" data-emojiable="true" ></textarea>
												<span class="error" id="err_post_sign"></span>
											</div>
                                            <div class="postImage"></div>
											<div class="attachments">
												<ul>
                                                	<li>
                                                    	<span class="add-loc"><i class="fa fa-location-dot"></i></span>
													</li>
                                                    <li>
                                                    	<label for="music_post"><i class="fa fa-music"></i> </label>
														<input id="music_post" name="music_post" type="file"/>
													</li>
                                                    <li>
                                                    	<label for="image_post"><i class="fa fa-image"></i></label>
														<input id="image_post" type="file" name="image_post[]" multiple />
														<span class="error" id="err_image_sign"></span>
													</li>
                                                    <li>
                                                    	<label for="video"><i class="fa fa-video-camera"></i></label>
														<input id="video" name="video" type="file"/>
													</li>
                                                    <li class="checkwebcam">
														<label for="file-input" onclick="return showWebCam()" id="webCamButton"><i class="fa fa-camera"></i></label>
														<?php /*?><button type="button" class="btn btn-light ml-10 @error('selfie') is-invalid @enderror" onclick="return showWebCam()" id="webCamButton" style="color: red;"><b>Take Selfie </b></button><?php */?>
														<!-- <input id="file-input" type="file" onclick="return showWebCam()" id="webCamButton"/> -->
													</li>
                                                    <li class="emojili"><div class="emojilidiv"> </div></li>
													<li class="preview-btn">
                                                    	<button class="post-btn-preview preview" type="button" data-ripple="">Preview</button>
                                                    </li>
												</ul>
                                                <div id="results" class="selfieresult"></div>
                                                <input type="hidden" name="selfieimg" id="selfieimg" class="image-tag">
												<button class="post-btn profilepostbtn" type="button" data-ripple="">Post</button>
											</div>
										</form>
									</div>
                                    <div id="cameradiv" style="display:none" class="central-meta postbox">
										<div class="col-md-12 login_wrapper">
											<div class="row justify-content-md-center">
												<div class="col-md-12" style="display: contents;">
													<div id="my_camera"></div>
													<button type="button" class="btn theme-red-bgcolor theme-round-btn" value="Click" onClick="take_snapshot()">Capture</button>
                                                    <?php /*?><input type="hidden" name="selfieimg" id="selfieimg" class="image-tag"><?php */?>
												</div>
                                        		<?php /*?><div class="col-md-6">
													<div id="results" class="selfieresult">
                                                    	Your captured image will appear here...</div>
												</div><?php */?>
											</div>
										</div>  
									</div>
            						<div class="loadMore">
										@foreach($profile_posts as $profile_post)
											<?php $userData = User::where('id',$profile_post->user_id)->first(); ?>
											<div class="central-meta item">
												<div class="user-post">
													<div class="friend-info">
														<figure>
                                                        	<img src="{{ url('/public/uploads/profile_pic/thumb/'.$userData->profile_pic) }}" alt="pic">
                                                        </figure>
														<div class="friend-name">
														<?php
															$postreport = PostReport::where('user_id',Auth::user()->id)->where('post_id',$profile_post->id)->first(); ?>
                                                        <div class="more">
															<div class="more-post-optns">
                                                            	<i class="fa fa-ellipsis-h"></i>
																<ul>
                                                                	@if($loggedinUser->id == $profile_post->user_id)
																		<li><a id="{{$profile_post->id}}" class="editpopup" href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Edit Post</a></li>
                                                                        <li><a href="{{route('delPost',$profile_post->id)}}"><i class="fa fa-trash"></i>Delete Post</a></li>
                                                                    @endif
																	@if($loggedinUser->id != $profile_post->user_id)
																		<li><a href="{{route('savePost',['pid'=>$profile_post->id,'uid'=>$profile_post->user_id])}}"><i class="fa fa-trash-o"></i>Save Post</a></li>
																	@endif
                                                                    @if(empty($postreport))
																		<li class="bad-report"><a is_report="1" id="{{$profile_post->id}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Report Post</a></li>
																	@elseif($postreport->report_post==1)
																		<li class="bad-report"><a is_report="0" id="{{$profile_post->id}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Un Report Post</a></li>
                        											@elseif($postreport->report_post==0)
																		<li class="bad-report"><a is_report="1" id="{{$profile_post->id}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Report Post</a></li>
																	@endif
                        											<li><i class="fa fa-address-card"></i>Boost This Post</li>
                                                                    <li><i class="fa fa-clock-o"></i>Schedule Post</li>
                                                                    <li><i class="fab fa-wpexplorer"></i>Select as featured</li>
                                                                    <li><i class="fa fa-bell-slash"></i>Turn off Notifications</li>
																</ul>
															</div><!-- more-post-optns -->
														</div>
                                                        <ins><a href="#" title="">{{ucfirst($userData->firstname)}} {{ucfirst($userData->lastname)}} </a> Post Album</ins>
                                                        <span><i class="fa fa-globe"></i> published: {{date('F, j Y H:i:s A', strtotime($profile_post->created_at))}}</span>
													</div><!-- friend-info -->
													<div class="post-meta">
														<input type="text" name="abc" data-emojiable="true" data-emoji-input="image" class="removepost" value="{{$profile_post->post_text}}" disabled="">
														<?php 
															$userid = $profile_post->user_id;
															$count = count(explode("|",$profile_post->images));
															$countimg = $count-5;
															$getimages = explode("|",$profile_post->images);
														?> 
														<figure>
                                                        	<!-- video post -->
															@if(isset($profile_post->video))
																<div class="img-bunch">
																	<div class="row">
																		<div class="col-lg-12 col-md-12 col-sm-12">
																			<figure>
																				<a href="#" title="" data-toggle="modal" data-target="#img-comt">
																					<video controls class="thumb"  style="width: 100%;">
																						<source src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/video/{{$profile_post->video}}" type="video/mp4">
																					</video>
																				</a>
																			</figure>
																		</div>
																	</div>
																</div>
															@elseif(isset($profile_post->music))   
																<div class="img-bunch">
																	<div class="row">
																		<div class="col-lg-12 col-md-12 col-sm-12">
																			<figure>
                                                                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                	<audio src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/music/{{$profile_post->music}}" controls></audio>
																				</a>
																			</figure>
																		</div>
																	</div>
																</div>
                                                                <!-- more than 4 images -->
															@elseif(isset($getimages[4]) && !empty($getimages[4]))
																<div class="img-bunch">
																	<div class="row">
																		<div class="col-lg-6 col-md-6 col-sm-6">
																			@if(isset($getimages[0]))
																				<figure>
                                                                                	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                                                                    </a>
																				</figure>
																			@endif
                                                                            @if(isset($getimages[1]))
																				<figure>
                                                                                	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="">
                                                                                    </a>
																				</figure>
																			@endif
																		</div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6">
																			@if(isset($getimages[2]))
																				<figure>
                                                                                	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="">
                                                                                    </a>
																				</figure>
																			@endif
                                                                            @if(isset($getimages[3]))
																				<figure>
                                                                                	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="">
                                                                                    </a>
																				</figure>
																			@endif
                                                                            @if(isset($getimages[4]))
																				<figure>
                                                                                	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[4]}}" alt="">
                                                                                   	</a>
                                                                                    <div class="more-photos">
																						<span>+{{$countimg}}</span>
																					</div>
																				</figure>
																			@endif
																		</div>
																	</div>
																</div>
            													<!-- 4 images -->
															@elseif(isset($getimages[3]) && !empty($getimages[3]))
																<div class="img-bunch">
																	<div class="row">                   
																		<div class="col-lg-12 col-md-12 col-sm-12">
																			<figure>
                                                                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                                                                </a>
																			</figure>
																		</div>
																	</div>
                                                                    <div class="row">   
																		<div class="col-lg-4 col-md-4 col-sm-4"> 
																			<figure>
                                                                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="" height="170">
																				</a>
																			</figure>   
																		</div> 
                                                                        <div class="col-lg-4 col-md-4 col-sm-4"> 
																			<figure>
                                                                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="" height="170">
																				</a>
																			</figure>    
																		</div> 
                                                                        <div class="col-lg-4 col-md-4 col-sm-4">  
																			<figure>
                                                                            	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="" height="170">
																				</a>
																			</figure>   
																		</div> 
																	</div>
            														<!-- 3 images -->
																	@elseif(isset($getimages[2]) && !empty($getimages[2]))
																		<div class="img-bunch">
																			<div class="row">
																				<div class="col-lg-6 col-md-6 col-sm-6">
																					<figure>
																						<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                        	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="" width="100" height="335">
																						</a>
																					</figure>
																				</div>
																				<div class="col-lg-6 col-md-6 col-sm-6">
																					<figure>
																						<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                        	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="" width="100" height="165">
																						</a>
																					</figure>
																					<figure>
                                                                                    	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                        	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="" width="100" height="165">
																						</a>
																					</figure>
																				</div>
																			</div>
																		</div>
            														@elseif(isset($getimages[1]) && !empty($getimages[1]))
																		<div class="img-bunch-two">
																			<div class="row">
																				<div class="col-lg-6 col-md-6 col-sm-6">
																					<figure>
                                                                                    	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                        	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                                                                        </a>
																					</figure>
																				</div>
                                                                                <div class="col-lg-6 col-md-6 col-sm-6">
																					<figure>
																						<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                        	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="">
                                                                                        </a>
																					</figure>
																				</div>
																			</div>
																		</div>
            															<!-- 1 images -->
																	@elseif(isset($getimages[0]) && !empty($getimages[0]))
																		<div class="img-bunch">
																			<div class="row">
																				<div class="col-lg-12 col-md-12 col-sm-12">
																					<figure>
																						<a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                        	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                                                                        </a>
																					</figure>
																				</div>
																			</div>
																		</div>
																	@endif
                                                                    <?php
																		$profile_posts_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->count();
                                                                        $likemore = $profile_posts_like-2;
                                                                        $loginuser_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id',$loggedinUser->id)->first();
                                                                        $seconduser_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->first();
                        
                                                                        $profile_posts_comment = PostComment::where('post_id',$profile_post->id)->count();
																		$activethumblike='';																		
																	?>
																	<ul class="like-dislike">
																		<li><a href="#" title="Save to Pin Post">
                                                                        		<i class="thumbtrack  fas fa-thumbtack"></i>
																			</a>
                                                                        </li>                                                                        
                                                                        @if(!empty($loginuser_like))
                                                                         	<?php $activethumblike='activethumblike'; ?>
                                                                        @endif
                                                                        <li><a href="javascript:void(0);" title="Like Post" class="<?php echo $activethumblike; ?>"><i id="{{$profile_post->id}}" is_like="1" class="thumbup thumblike fas fa-thumbs-up"></i></a></li>
                                                                        <li><a href="javascript:void(0);" title="dislike Post"><i id="{{$profile_post->id}}" is_like="0" class="thumpdown thumblike fas fa-thumbs-down"></i></i></a></li>
																	</ul>
																</figure>   
                                                                <div class="we-video-info">
																	
                                                                    <ul>
                                                                    	<li>
                                                                        	<span class="views" title="views">
																				<i class="eyeview fas fa-eye"></i>
																				<ins>1.2k</ins>
																			</span>
																		</li>
																		<li>
                                                                        	<div class="likes heart" title="Like/Dislike">❤ <span id="likecount{{$profile_post->id}}">{{$profile_posts_like}}</span></div>
																		</li>
																		<li>
                                                                        	<span class="comment" title="Comments">
																				<i class="commentdots fas fa-comment-dots"></i>
																				<ins>{{$profile_posts_comment}}</ins>
																			</span>
																		</li>
																		<li>
                                                                        	<span>
                                                                            	<a class="share-pst" href="javascript:void(0);" onclick="fbPost()" title="Share">
                                                                                	<i class="sharealt fas fa-share-alt"></i>
																				</a>
                                                                                <a id="{{$profile_post->id}}" href="{{route('postDetail',$profile_post->id)}}" class="share sharefb facebook btn btn-primary"><i class="fb fab fa-facebook-f"></i> Facebook</a>
                                                                                    <!-- <ins>20</ins> -->
																			</span> 
																		</li>
																	</ul>
                                                                    @if($profile_posts_like>0)
																		<div class="users-thumb-list">
																			@if(!empty($loginuser_like))
																				<a data-toggle="tooltip" title="" href="#">
                                                                                	<img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic) }}" height="32" width="32">  
                                                                                </a>
																			@endif
																			<?php 
                                                                                $profile_posts_all = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->limit(4)->get();?>
                                                                                @if(isset($profile_posts_all[0]))
																					<?php $seconduser = User::find($profile_posts_all[0]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="" href="#">
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$seconduser->profile_pic) }}" height="32" width="32">  
                                                                                    </a>
                                                                                @endif
                                                                                @if(isset($profile_posts_all[1]))
																					<?php $thirduser = User::find($profile_posts_all[1]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="" href="#">
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$thirduser->profile_pic) }}" height="32" width="32">  
                                                                                    </a>
                                                                                @endif
                                                                                @if(isset($profile_posts_all[2]))
																					<?php $fourthuser = User::find($profile_posts_all[2]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="" href="#">
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fourthuser->profile_pic) }}" height="32" width="32">  
                                                                                    </a>
                                                                                @endif
                                                                                @if(isset($profile_posts_all[3]))
																					<?php $fifthuser = User::find($profile_posts_all[3]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="" href="#">
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fifthuser->profile_pic) }}" height="32" width="32">  
                                                                                    </a>
                                                                                @endif
                                                                                <span>
                                                                                    <strong>
                                                                                        @if(!empty($loginuser_like))
                                                                                        	You
                                                                                        @endif
                                                                                    </strong>
                                                                                    @if(!empty($seconduser_like))
                                                                                        <?php   $secondusername = User::where('id',$seconduser_like->user_id)->first(); ?>,<b>{{$secondusername->username}}</b>
                                                                                    @endif
            
                                                                                    @if($profile_posts_like>2)
                                                                                        And <a href="#" title="">{{$likemore}}+ More</a> 
                                                                                    @endif
                                                                                    Liked
                                                                                </span>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="coment-area" style="display: block;">
                                                                    <ul class="we-comet">
                                                                        <?php 
                                                                        $comments = PostComment::where('post_id',$profile_post->id)->limit(2)->get();
                                                                        $allcomments = PostComment::where('post_id',$profile_post->id)->get();
                                                                        ?>
                                                                        @if(count($comments) > 0)
                                                                            @foreach($comments as $comment)
                                                                                <?php
                                                                                 $username = User::find($comment->user_id);
                                                                                ?>
                                                                                <li class="commentappendremove">
                                                                                    <div class="comet-avatar">
                                                                                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$username->profile_pic) }}" alt="">
                                                                                    </div>
                                                                                    <div class="we-comment">
                                                                                        <h5><a href="javascript:void(0);" title="">{{$username->firstname}} {{$username->lastname}}</a></h5>
                                                                                        <p>{{$comment->comment}}</p>
                                                                                        <div class="inline-itms">
                                                                                            <span>{{$comment->created_at->diffForHumans()}}</span>
                                                                                            <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                                                            <a href="#" title=""><i class="fa fa-heart"></i><span>20</span></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
                                                                        @endif
                                                                        <li class="commentappend{{$profile_post->id}}"></li>
                                                                        @if(count($allcomments) > 2)
                                                                            <input type="hidden" name="commentdisplay" id="commentdisplay" value="5">
                                                                            <li>
                                                                                <a id="{{$profile_post->id}}" href="javascript:void(0);" title="" class="showcomments showmore underline">more comments+</a>
                                                                            </li>
                                                                        @endif
                                                                        <li class="post-comment">
                                                                            <div class="comet-avatar">
                                                                                <img src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic) }}" alt="pic">
                                                                            </div>
                                                                            <div class="post-comt-box">
                                                                                <form method="post" id="commentfrm">
                                                                                    <textarea placeholder="Post your comment" name="comment" id="comment{{$profile_post->id}}"></textarea>
                                                                                    <span class="error" id="err_comment{{$profile_post->id}}"></span>
                                                                                    <div class="add-smiles">
                                                                                        
                                                                                        <span class="em em-expressionless" title="add icon"></span>
                                                                                        <div class="smiles-bunch">
                                                                                            <i class="em em---1"></i>
                                                                                            <i class="em em-smiley"></i>
                                                                                            <i class="em em-anguished"></i>
                                                                                            <i class="em em-laughing"></i>
                                                                                            <i class="em em-angry"></i>
                                                                                            <i class="em em-astonished"></i>
                                                                                            <i class="em em-blush"></i>
                                                                                            <i class="em em-disappointed"></i>
                                                                                            <i class="em em-worried"></i>
                                                                                            <i class="em em-kissing_heart"></i>
                                                                                            <i class="em em-rage"></i>
                                                                                            <i class="em em-stuck_out_tongue"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <button id="{{$profile_post->id}}" class="postcomment theme-red-bgcolor" type="button">Post</button>
                                                                                </form> 
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- album post -->
                                                @endforeach
                                                <!-- append page scroll result -->
                                                <div class="content-dash" id="scroll_pagination"></div>
											</div>
                            				<div class="desc-box-new">
                                            	<!-- <div class="desc-text" id="mydesc">
													<h5>About</h5>
                                                    <?php $gender = array('' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'); ?>
                                                    <p>@if(isset($UserProfileDetail['business_info'])) {!! nl2br(@$UserProfileDetail['business_info']) !!} @else - @endif</p>
                                                    <p>@if(isset($UserProfileDetail['intro'])) {!! nl2br(@$UserProfileDetail['intro']) !!} @endif</p>
                                                </div> -->
                                                <div class="gallery-box" id="photo">
													<div id="main_area" style="padding:0">
														<!-- Slider -->
														<div class="row" style="display:none">
															<div class="col-xs-12" id="slider">
																<h5> Photos </h5>
																<!-- Top part of the slider -->
                                                                <div class="" id="carousel-bounding-box">
																	<div class="carousel slide round5px" id="myCarousel" data-ride="carousel">
                                                                    	<!-- Carousel items -->
																		<div class="carousel-inner">
																			@foreach($gallery as $key=>$pic)
																				@if($key==0)
																					<div class="active item" data-slide-number="{{ $pic['id'] }}">
                                                                                @else
                                                                                	<div class="item"  data-slide-number="{{ $pic['id'] }}">
                                                                                @endif
																					<img src="/public/uploads/gallery/<?= $loggedinUser->id ?>/<?= $pic['name'] ?>" style="width:100%;">
																				</div>
																			@endforeach
																		</div>
																		<!-- Carousel nav -->
																	</div><!--/Slider-->
																	<div id="slider-thumbs">
																		<!-- Bottom switcher of slider -->
																		<ul class="hide-bullets">
																			<?php
                                                                                foreach ($gallery as $pic) { ?>
																					<li>
                                                                                        <img class="short-cru-img" style="width:100%;" src="/public/uploads/gallery/<?= $loggedinUser->id ?>/thumb/<?= $pic['name'] ?>" id="<?= $pic['id'] ?>" />
                                                                                    </li>
                                                                                <?php } ?> 
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
                                                    <div class="video-box" id="video-box" style="display:none">
														<h5> Video </h5>
														<div class="video-responsive">
															<iframe width="560" height="315" src="https://www.youtube.com/embed/Ol2QjF53OPQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
														</div>
													</div>
                        							<div class="pr-listing-amerties" id="family-id" style="display:none">
                                                    	<!-- Modal -->
														<div class="modal fade" id="addFamilyDetailModal" role="dialog">
															<!-- <form  id="frmeditProfileDetail" method="post"> -->
                                                            {!! Form::open(array('id' => 'frmaddFamilyDetail')) !!}
																<input type="hidden" name="_token" value="{{ csrf_token() }}">
																<div class="modal-dialog modal-lg">
																	<!-- Modal content-->
																	<div class="modal-content">
																		<div class="modal-body login-pad">
																			<div class="pop-title employe-title">
																				<h3 id="familyModal">Add Family Member Info</h3>
																			</div>
                                                                            <button type="button" class="close modal-close" data-dismiss="modal">
                                                                            	<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                                                                            </button>
                            												<div class="signup">
																				<div id='systemMessage_detail'></div>
																				<div class="emplouyee-form">
																					<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">First Name:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<input type="text" name="first_name" id="frm1_firstname" placeholder="First Name">
                                                                                        </div>
																					</div>
                            														<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Last Name:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<input type="text" name="last_name" id="frm1_lastname" placeholder="Last Name">
                                                                                        </div>
																					</div>
                            														<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Gender Name:</label>
                                                                                        </div>
                                                                                        <div class="col-sm-8">
																							<div class="select-style review-select2">
                                                                                            	{!! Form::select('gender', $gender,null, ['class' => 'form-control', 'id' => 'frm1_gender']) !!}
                                                                                            </div>
																						</div>
																					</div>
                            														<input type="hidden" style="display:none;" name="family_id" id="family_id" value="0" />
                                                                                    <div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Email:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<input type="text" name="email" id="frm1_email" placeholder="Email">
                                                                                        </div>
																					</div>
                                													<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Relationship:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<?php
                                                                                                $relationship = array('' => 'Select Relationship', 'Brother' => 'Brother', 'Sister' => 'Sister', 'Father' => 'Father', 'Mother' => 'Mother', 'Wife' => 'Wife'
                                                                                                    , 'Husband' => 'Husband', 'Son' => 'Son', 'Daughter' => 'Daughter');
																							?>
                                															<div class="select-style review-select2">
                                                                                            	{!! Form::select('relationship', $relationship, null, ['class' => 'form-control', 'id' => 'frm1_relationship']) !!}
                                                                                            </div>
																						</div>
																					</div>
                                													<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Birthday:</label>
                                                                                        </div>
																						<div class="col-sm-8" id="datepicker-position">
                                                                                        	<input type="text" class="form-control" autocomplete="off" name="birthday"   placeholder="MM-DD-YYYY" id="frm1_birthday" />
                                                                                            <!--<input type="text" autocomplete="off" name="birthday" id="my_date_picker" placeholder="Birthday">-->
                                														</div>
																					</div>
                                													<!-- <input type="text" name="phone_number" id="frm_phone_number" placeholder="(XXX) XXX XXX" value=""> -->
                                                                                    <div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Mobile:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<input type="text" name="mobile" maxlength="10" id="frm1_mobile" required placeholder="Mobile" />
                                                                                        </div>
																					</div>
                                													<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Emergency Contact:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<input type="text" name="emergency_contact" maxlength="10" id="frm1_emergency_contact" placeholder="Emergency Contact" />
																						</div>
																					</div>
																					<button type="button" id="submit_familydetail">Submit</button>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															{!! Form::close() !!}<!-- </form> -->
														</div>
														<h5> Family Details</h5>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail">
															<a href="javascript: void(0);" style="float: right" data-toggle="modal" id="addFamily" data-target="#addFamilyDetailModal"><i class="fa fa-plus"></i> Add Family Member</a>
														</div> 
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" id="uplogradProfileBtn">Name</th>
                                                                    <th scope="col">Relationship</th>
                                                                    <th scope="col">Email</th>
                                                                    <th scope="col">Emergency Contact</th>
                                                                    <th scope="col">Mobile</th>
                                                                    <th scope="col">Gender</th>
                                                                    <th scope="col">Action</th>
                                                                    <!--<th scope="col">Birthday</th>-->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(count($family) == 0)
                                                                    <tr>
                                                                        <td colspan="8"><h3 class="nw-user-nm text-center">Family Details not added yet.</h3></td>
                                                                    </tr>
                                                                @else
                                                                    @foreach($family as $value)
                                                                    <tr>
                                                                        <td>{{$value->first_name}} {{$value->last_name}}</td>
                                                                        <td>{{$value->relationship}}</td>
                                                                        <td>{{$value->email}}</td>
                                                                        <td>{{$value->emergency_contact}}</td>
                                                                        <td>{{$value->mobile}}</td>
                                                                        <td>{{$value->gender}}</td>
                                                                        <td><a href="javascript: void(0);" data-toggle="modal" data-target="#addFamilyDetailModal"><i class="fa fa-pencil family_edit" user_id="{{$value}}" style="color: #f53b49"></i></a> 
                                                                            <a href="javascript: void(0);" ><i class="fa fa-trash family_delete" user_id="{{$value->id}}" style="color: #f53b49"></i></a></td>
                                                                        <?php /*?><td style="display: flex!important;">{{ date('m-d-Y', strtotime($value->birthday)) }}</td><?php */?>
                                                                    </tr>    
                                                                    @endforeach                        
                                                                @endif
                                                            </tbody>
                                                        </table>
													</div>
                                                    <!-- Thumbnail images of users from company_images objects are 
                                                        rendering here and also publishing in the buiness profile page -->                   
                                                    @isset(Auth::user()->company_images)
														<div class="row" style="padding: 10px 20px;" id="delimgbox">
															@foreach(json_decode(Auth::user()->company_images) as $key=>$value)
                            									<div class="col-md-4" class="imgdeletediv" style="position:relative;padding: 15px;">
                                                                	<img src="<?php echo Config::get('constants.USER_IMAGE_THUMB') . $value; ?>" style="width:100%;height:200px;" />
                                                                	<button type="button" myindex="{{$key}}" class="btn btn-primary delimg" style="margin-top: 15px;"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                            	</div>
                                                            @endforeach
                                                        </div>
													@endisset
                        							<div id="Modal" class="modal fade" role="dialog">
														<div class="modal-dialog">
															<!-- Modal content-->
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" style="color:black;">Add User Images</h4>
                                                                </div>
																<div class="modal-body">
																	<form method="POST" action="{{url('/user-multi-image-upload')}}" enctype="multipart/form-data">
                                                                    	<input required type="file" class="form-control" name="images[]" placeholder="Company Image" multiple>
                                                                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
																</div>
																<div class="modal-footer">
																	<button type="submit" class="btn btn-default">Save</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                </div>
															</div>
                            							</div>
													</div>
                        						</div>
											</div>
            							</div>
										<div class="tab-pane" id="tabs-2" role="tabpanel">
											<div class="desc-text" id="mydesc">
												<?php $gender = array('' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'); ?>
												<p>@if(isset($UserProfileDetail['business_info'])) {!! nl2br(@$UserProfileDetail['business_info']) !!} @else - @endif</p>
												<p>@if(isset($UserProfileDetail['intro'])) {!! nl2br(@$UserProfileDetail['intro']) !!} @endif</p>
											</div>
										</div>
                                        <div class="tab-pane" id="tabs-3" role="tabpanel">
											<div class="video-box">
                                            	<?php 
													if (!empty($images)) 
                                                    {
														foreach($images as $data)
														{
															$img_part = explode("|",$data->images);
															$imgCount = count($img_part);
															for ($i=0; $i <$imgCount ; $i++) 
                                                        	{ ?>
                                                            	<div class="row">
																	<div class="col-sm-3 col-md-4 col-lg-4">
																		<div class="photo-tab-imgs">
																			<img height="170" width="170" class="bixrwtb6" src="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/{{$img_part[$i]}}">
																		</div>
                                                                	</div>
																 	<div class="col-sm-3 col-md-4 col-lg-4">
																		<div class="photo-tab-imgs">
																			<img height="170" width="170" class="bixrwtb6" src="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/{{$img_part[$i]}}">
																		</div>
                                                                	</div>
																 	<div class="col-sm-3 col-md-4 col-lg-4">
																		<div class="photo-tab-imgs">
																			<img height="170" width="170" class="bixrwtb6" src="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/{{$img_part[$i]}}">
																		</div>
                                                                	</div>
                                                             	</div>
                                                        	<?php 
                                                            }
														}
													}
												?>
											</div>
										</div>
										<div class="tab-pane" id="tabs-4" role="tabpanel">
											<div class="video-box">
                                            	<?php 
													if (!empty($videos)) 
													{
														foreach($videos as $data)
														{ ?>
                                                        	<div class="row">
																<div class="col-sm-4 col-md-6 col-lg-6">
																	<div class="video-tab-iframe">
																		<iframe src="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/video/{{$data->video}}" frameborder="0" allowfullscreen></iframe>
																	</div>
                                                                </div>
																 <div class="col-sm-4 col-md-6 col-lg-6">
																	<div class="video-tab-iframe">
																		<iframe src="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/video/{{$data->video}}" frameborder="0" allowfullscreen></iframe>
																	</div>
                                                                </div>
                                                         	</div>
                                                        <?php 
														}
													}
												?>
											</div>
										</div>
										<div class="tab-pane" id="tabs-5" role="tabpanel">
											<div class="loadMore">
												@foreach($profilesave as $profile_ids)
                                                <?php
                                                    $profile_post = ProfilePost::where('id',$profile_ids->profile_id)->first();
                                                    $userData = User::where('id',$profile_post['user_id'])->first();
                                                ?>
                                                    <div class="central-meta item">
                                                        <div class="user-post">
                                                            <div class="friend-info">
                                                                <figure>
                                                                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.$userData->profile_pic) }}" alt="pic">
                                                                </figure>
                                                                <div class="friend-name">
                                                                    <?php
                                                                    $postreport = PostReport::where('user_id',Auth::user()->id)->where('post_id',$profile_post['id'])->first();
                                                                    ?>                                           
                                                                    <div class="more">
                                                                        <div class="more-post-optns"><i class="fa fa-ellipsis-h"></i>
                                                                            <ul>
                                                                                 @if($loggedinUser->id == $profile_post['user_id'])
                                                                                <li><a id="{{$profile_post['id']}}" class="editpopup" href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Edit Post</a></li>
                                                                                <li><a href="{{route('delPost',$profile_post['id'])}}"><i class="fa fa-trash-o"></i>Delete Post</a></li>
                                                                                @endif

                                                                                @if($loggedinUser->id != $profile_post['user_id'])
                                                                                    <li><a href="{{route('savePost',['pid'=>$profile_post['id'],'uid'=>$profile_post['user_id']])}}"><i class="fa fa-trash-o"></i>Save Post</a></li>
                                                                                @endif
                                                                                
                                                                                @if(empty($postreport))
                                                                                <li class="bad-report"><a is_report="1" id="{{$profile_post['id']}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Report Post</a></li>
                                                                                @elseif($postreport->report_post==1)
                                                                                <li class="bad-report"><a is_report="0" id="{{$profile_post['id']}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Un Report Post</a></li>
                        
                                                                                 @elseif($postreport->report_post==0)
                                                                                 <li class="bad-report"><a is_report="1" id="{{$profile_post['id']}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Report Post</a></li>
                                                                                 @endif
                        
                                                                                
                                                                                <li><i class="fa fa-address-card-o"></i>Boost This Post</li>
                                                                                <li><i class="fa fa-clock-o"></i>Schedule Post</li>
                                                                                <li><i class="fa fa-wpexplorer"></i>Select as featured</li>
                                                                                <li><i class="fa fa-bell-slash-o"></i>Turn off Notifications</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <ins><a href="#" title="">{{ucfirst($userData->firstname)}} {{ucfirst($userData->lastname)}} </a> Post Album</ins>
                                                                    <span><i class="fa fa-globe"></i> published: {{date('F, j Y H:i:s A', strtotime($profile_post['created_at']))}}</span>
                                                                </div><!-- friend-name -->
                                                                <div class="post-meta">
                                                                    <input type="text" name="abc" data-emojiable="true" data-emoji-input="image" class="removepost" value="{{$profile_post['post_text']}}" disabled="">
                                    								<?php 
																		$userid = $profile_post['user_id'];
																		$count = count(explode("|",$profile_post['images']));
																		$countimg = $count-5;
																		$getimages = explode("|",$profile_post['images']);
																	?> 
                                    								<figure>
                                                                        <!-- video post -->
                                                                        @if(isset($profile_post['video']))
                                                                            <div class="img-bunch">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                            <video controls class="thumb"  style="width: 100%;">
                                                                                                <source src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/video/{{$profile_post['video']}}" type="video/mp4">
                                                                                            </video>
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @elseif(isset($profile_post['music']))   
                                                                            <div class="img-bunch">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                            <audio src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/music/{{$profile_post['music']}}" controls></audio>
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- more than 4 images -->
                                                                        @elseif(isset($getimages[4]))
                                                                            <div class="img-bunch">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                        @if(isset($getimages[0]))
                                                                                            <figure>
                                                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                                	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                                                                                </a>
                                                                                            </figure>
                                                                                        @endif
                                                                                        @if(isset($getimages[1]))
                                                                                            <figure>
                                                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                                	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="">
                                                                                                </a>
                                                                                            </figure>
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                        @if(isset($getimages[2]))
                                                                                            <figure>
                                                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                                	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="">
                                                                                                </a>
                                                                                            </figure>
                                                                                        @endif
                                                                                        @if(isset($getimages[3]))
                                                                                            <figure>
                                                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                                	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="">
                                                                                                </a>
                                                                                            </figure>
                                                                                        @endif
                                                                                        @if(isset($getimages[4]))
                                                                                            <figure>
                                                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                                	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[4]}}" alt="">
                                                                                                </a>
                                                                                                <div class="more-photos">
                                                                                                    <span>+{{$countimg}}</span>
                                                                                                </div>
                                                                                            </figure>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div><!-- img-bunch -->
                                                                        <!-- 4 images -->
                                                                        @elseif(isset($getimages[3]))
                                                                            <div class="img-bunch">
                                                                                <div class="row">                   
                                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                           		<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">   
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4"> 
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="" height="170">
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div> 
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4"> 
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="" height="170">
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div> 
                                                                                    <div class="col-lg-4 col-md-4 col-sm-4">  
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                                <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="" height="170">
                                                                                            </a>
                                                                                        </figure>
                                                                                	</div> 
																				</div>
            																</div><!-- img-bunch -->
                                                                        <!-- 3 images -->
                                                                        @elseif(isset($getimages[2]))
                                                                            <div class="img-bunch">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="" width="100" height="335">
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="" width="100" height="165">
                                                                                            </a>
                                                                                        </figure>
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="" width="100" height="165">
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div>
                                                                                </div>
                                                                            </div> <!-- img-bunch -->
                                                                        <!-- 2 images -->
                                                                        @elseif(isset($getimages[1]))
                                                                            <div class="img-bunch-two">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="">
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div>
                                                                                </div>
                                                                            </div> <!-- img-bunch -->
                                                                        <!-- 1 images -->
                                                                        @elseif(isset($getimages[0]))
                                                                            <div class="img-bunch">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                                        <figure>
                                                                                            <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                                                                            </a>
                                                                                        </figure>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <ul class="like-dislike">
                                                                            <li><a class="bg-purple" href="#" title="Save to Pin Post">
                                                                                <i class="thumbtrack  fas fa-thumbtack"></i>
                                                                                </a>
                                                                            </li>
                                                                            <li><a class="bg-blue" href="javascript:void(0);" title="Like Post"><i id="{{$profile_post['id']}}" is_like="1" class="thumbup thumblike fas fa-thumbs-up"></i></a></li>
                                                                            <li><a class="bg-red" href="javascript:void(0);" title="dislike Post"><i id="{{$profile_post['id']}}" is_like="0" class="thumpdown thumblike fas fa-thumbs-down"></i></i></a></li>
                                                                        </ul>
                                                                    </figure>   
                                                                    <div class="we-video-info">
                                                                        <?php
																			$profile_posts_like = PostLike::where('post_id',$profile_post['id'])->where('is_like',1)->count();
																			$likemore = $profile_posts_like-2;
																			$loginuser_like = PostLike::where('post_id',$profile_post['id'])->where('is_like',1)->where('user_id',$loggedinUser->id)->first();
																			$seconduser_like = PostLike::where('post_id',$profile_post['id'])->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->first();
                                                                        	$profile_posts_comment = PostComment::where('post_id',$profile_post['id'])->count();
                                                                        ?>
                                                                        <ul>
                                                                            <li>
                                                                                <span class="views" title="views">
                                                                                    <i class="eyeview fas fa-eye"></i>
                                                                                    <ins>1.2k</ins>
                                                                                </span>
                                                                            </li>
                                                                            <li>
                                                                                <div class="likes heart" title="Like/Dislike">❤ <span id="likecount{{$profile_post['id']}}">{{$profile_posts_like}}</span></div>
                                                                            </li>
                                                                            <li>
                                                                                <span class="comment" title="Comments">
                                                                                    <i class="commentdots fas fa-comment-dots"></i>
                                                                                    <ins>{{$profile_posts_comment}}</ins>
                                                                                </span>
                                                                            </li>
                                                                            <li>
                                                                                <span>
                                                                                    <a class="share-pst" href="javascript:void(0);" onclick="fbPost()" title="Share">
                                                                                        <i class="sharealt fas fa-share-alt"></i>
                                                                                    </a>
                                                                                    <a id="{{$profile_post['id']}}" href="{{route('postDetail',$profile_post['id'])}}" class="share sharefb facebook btn btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
                                                                                    <!-- <ins>20</ins> -->
                                                                                </span> 
                                                                            </li>
                                                                        </ul>
                                                                        @if($profile_posts_like>0)
                                                                            <div class="users-thumb-list">
                                                                                @if(!empty($loginuser_like))
                                                                                    <a data-toggle="tooltip" title="Anderw" href="#">
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic) }}" height="32" width="32">  
                                                                                    </a>
                                                                                @endif
                                                                                <?php 
                                                                                $profile_posts_all = PostLike::where('post_id',$profile_post['id'])->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->limit(4)->get();?>
                                                                                @if(isset($profile_posts_all[0]))
                                                                                <?php $seconduser = User::find($profile_posts_all[0]->user_id); ?>
                                                                                	<a data-toggle="tooltip" title="frank" href="#">
                                                                                    	<img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$seconduser->profile_pic) }}" height="32" width="32">  
                                                                               		</a>
                                                                                @endif
                                                                                @if(isset($profile_posts_all[1]))
                                                                                <?php $thirduser = User::find($profile_posts_all[1]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="Sara" href="#">
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$thirduser->profile_pic) }}" height="32" width="32">  
                                                                                    </a>
                                                                                @endif
            
                                                                                @if(isset($profile_posts_all[2]))
                                                                                <?php $fourthuser = User::find($profile_posts_all[2]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="Amy" href="#">
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fourthuser->profile_pic) }}" height="32" width="32">  
                                                                                    </a>
                                                                                @endif
            
                                                                                @if(isset($profile_posts_all[3]))
                                                                                <?php $fifthuser = User::find($profile_posts_all[3]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="Ema" href="#">
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fifthuser->profile_pic) }}" height="32" width="32">  
                                                                                    </a>
                                                                                @endif
                                                                                <span>
                                                                                    <strong>
                                                                                        @if(!empty($loginuser_like))
                                                                                        You
                                                                                        @endif
                                                                                    </strong>
                                                                                    @if(!empty($seconduser_like))
                                                                                        <?php   $secondusername = User::where('id',$seconduser_like->user_id)->first(); ?>,<b>{{$secondusername->username}}</b>
                                                                                    @endif
            
                                                                                    @if($profile_posts_like>2)
                                                                                        And <a href="#" title="">{{$likemore}}+ More</a> 
                                                                                    @endif
                                                                                    Liked
                                                                                </span>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="coment-area" style="display: block;">
                                                                    <ul class="we-comet">
                                                                        <?php 
																			$comments = PostComment::where('post_id',$profile_post['id'])->limit(2)->get();
																			$allcomments = PostComment::where('post_id',$profile_post['id'])->get();
                                                                        ?>
                                                                        @if(count($comments) > 0)
                                                                            @foreach($comments as $comment)
																				<?php
                                                                                	$username = User::find($comment->user_id);
                                                                                ?>
                                                                                <li class="commentappendremove">
                                                                                    <div class="comet-avatar">
                                                                                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$username->profile_pic) }}" alt="">
                                                                                    </div>
                                                                                    <div class="we-comment">
                                                                                        <h5><a href="javascript:void(0);" title="">{{$username->firstname}} {{$username->lastname}}</a></h5>
                                                                                        <p>{{$comment->comment}}</p>
                                                                                        <div class="inline-itms">
                                                                                            <span>{{$comment->created_at->diffForHumans()}}</span>
                                                                                            <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                                                                                            <a href="#" title=""><i class="fa fa-heart"></i><span>20</span></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
                                                                        @endif
                                                                        <li class="commentappend{{$profile_post['id']}}"></li>
                                                                        @if(count($allcomments) > 2)
                                                                           	<input type="hidden" name="commentdisplay" id="commentdisplay" value="5">
                                                                           	<li>
                                                                               	<a id="{{$profile_post['id']}}" href="javascript:void(0);" title="" class="showcomments showmore underline">more comments+</a>
																			</li>
																		@endif
                                                                        <li class="post-comment">
																			<div class="comet-avatar">
																				<img src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic) }}" alt="pic">
                                                                            </div>
                                                                            <div class="post-comt-box">
                                                                                <form method="post" id="commentfrm">
                                                                                    <textarea placeholder="Post your comment" name="comment" id="comment{{$profile_post['id']}}"></textarea>
                                                                                    <span class="error" id="err_comment{{$profile_post['id']}}"></span>
                                                                                    <div class="add-smiles">
                                                                                        
                                                                                        <span class="em em-expressionless" title="add icon"></span>
                                                                                        <div class="smiles-bunch">
                                                                                            <i class="em em---1"></i>
                                                                                            <i class="em em-smiley"></i>
                                                                                            <i class="em em-anguished"></i>
                                                                                            <i class="em em-laughing"></i>
                                                                                            <i class="em em-angry"></i>
                                                                                            <i class="em em-astonished"></i>
                                                                                            <i class="em em-blush"></i>
                                                                                            <i class="em em-disappointed"></i>
                                                                                            <i class="em em-worried"></i>
                                                                                            <i class="em em-kissing_heart"></i>
                                                                                            <i class="em em-rage"></i>
                                                                                            <i class="em em-stuck_out_tongue"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <button style="background-color: #ef3e46" id="{{$profile_post['id']}}" class="postcomment" type="button">Post</button>
                                                                                </form> 
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- album post -->
                                                @endforeach
                                                <!-- append page scroll result -->
                                                <div class="content-dash" id="scroll_pagination"></div>
											</div>
                            				<div class="desc-box-new">
												<!-- <div class="desc-text" id="mydesc">
													<h5>About</h5>
													<?php $gender = array('' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'); ?>
                                                    <p>@if(isset($UserProfileDetail['business_info'])) {!! nl2br(@$UserProfileDetail['business_info']) !!} @else - @endif</p>
                                                    <p>@if(isset($UserProfileDetail['intro'])) {!! nl2br(@$UserProfileDetail['intro']) !!} @endif</p>
                                                    </div> -->
												<div class="gallery-box" id="photo">
													<div id="main_area" style="padding:0">
														<!-- Slider -->
														<div class="row" style="display:none">
															<div class="col-xs-12" id="slider">
																<h5> Photos </h5>
																<!-- Top part of the slider -->
																<div class="" id="carousel-bounding-box">
																	<div class="carousel slide round5px" id="myCarousel" data-ride="carousel">
                                                                    	<!-- Carousel items -->
																		<div class="carousel-inner">
																			@foreach($gallery as $key=>$pic)
																				@if($key==0)
																					<div class="active item" data-slide-number="{{ $pic['id'] }}">
                                                                                @else
                                                                                	<div class="item"  data-slide-number="{{ $pic['id'] }}">
                                                                                @endif
																					<img src="/public/uploads/gallery/<?= $loggedinUser->id ?>/<?= $pic['name'] ?>" style="width:100%;">
                                                                         		</div>
																			@endforeach
																		</div><!-- Carousel nav -->
																	</div>
																	<!--/Slider-->
																	<div id="slider-thumbs">
                                                                    	<!-- Bottom switcher of slider -->
																		<ul class="hide-bullets">
																			<?php
																				foreach ($gallery as $pic) { ?>
                                                                                    <li>
                                                                                        <img class="short-cru-img" style="width:100%;" src="/public/uploads/gallery/<?= $loggedinUser->id ?>/thumb/<?= $pic['name'] ?>" id="<?= $pic['id'] ?>" />
                                                                                    </li>
																			<?php } ?> 
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="video-box" id="video-box" style="display:none">
														<h5> Video </h5>
														<div class="video-responsive">
															<iframe width="560" height="315" src="https://www.youtube.com/embed/Ol2QjF53OPQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
														</div>
													</div>
                        							<div class="pr-listing-amerties" id="family-id" style="display:none">
														<!-- Modal -->
														<div class="modal fade" id="addFamilyDetailModal" role="dialog">
															<!-- <form  id="frmeditProfileDetail" method="post"> -->
															{!! Form::open(array('id' => 'frmaddFamilyDetail')) !!}
																<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                <div class="modal-dialog modal-lg">
																	<div class="modal-content">
																		<div class="modal-body login-pad">
																			<div class="pop-title employe-title">
																				<h3 id="familyModal">Add Family Member Info</h3>
																			</div>
																			<button type="button" class="close modal-close" data-dismiss="modal">
                                                                            	<img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
																			</button>
                            												<div class="signup">
																				<div id='systemMessage_detail'></div>
																				<div class="emplouyee-form">
																					<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">First Name:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<input type="text" name="first_name" id="frm1_firstname" placeholder="First Name">
                                                                                        </div>
																					</div>
                            														<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Last Name:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<input type="text" name="last_name" id="frm1_lastname" placeholder="Last Name">
                                                                                        </div>
																					</div>
                            														<div class="row">
                                                                                    	<div class="col-sm-4">
																							<label for="usr" class="lbl">Gender Name:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<div class="select-style review-select2">
                                                                                            	{!! Form::select('gender', $gender,null, ['class' => 'form-control', 'id' => 'frm1_gender']) !!}
																							</div>
																						</div>
																					</div>
                            
                                                                                    <input type="hidden" style="display:none;" name="family_id" id="family_id" value="0" />
                                                                                    <div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Email:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<input type="text" name="email" id="frm1_email" placeholder="Email">
																						</div>
																					</div>
                                													<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Relationship:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<?php
                                                                                                $relationship = array('' => 'Select Relationship', 'Brother' => 'Brother', 'Sister' => 'Sister', 'Father' => 'Father', 'Mother' => 'Mother', 'Wife' => 'Wife'
                                                                                                    , 'Husband' => 'Husband', 'Son' => 'Son', 'Daughter' => 'Daughter');
                                                                                            ?>
                                															<div class="select-style review-select2">
                                
                                																{!! Form::select('relationship', $relationship, null, ['class' => 'form-control', 'id' => 'frm1_relationship']) !!}
																							</div>
																						</div>
																					</div>
                                													<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Birthday:</label>
                                                                                        </div>
																						<div class="col-sm-8" id="datepicker-position">
                                                                                        	<input type="text" class="form-control" autocomplete="off" name="birthday" placeholder="MM-DD-YYYY" id="frm1_birthday" />
                                														</div>
																					</div>
                                													<div class="row">
																						<div class="col-sm-4">
                                                                                        	<label for="usr" class="lbl">Mobile:</label>
																						</div>
																						<div class="col-sm-8">
																							<input type="text" name="mobile" maxlength="10" id="frm1_mobile" required placeholder="Mobile" />
                                                                                        </div>
																					</div>
                                													<div class="row">
																						<div class="col-sm-4">
																							<label for="usr" class="lbl">Emergency Contact:</label>
                                                                                        </div>
																						<div class="col-sm-8">
																							<input type="text" name="emergency_contact" maxlength="10" id="frm1_emergency_contact" placeholder="Emergency Contact" />
																						</div>
																					</div>
                                                                                    <button type="button" id="submit_familydetail">Submit</button>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															{!! Form::close() !!} <!-- </form> -->
														</div>
                                                        <h5> Family Details</h5>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail">
															<a href="javascript: void(0);" style="float: right" data-toggle="modal" id="addFamily" data-target="#addFamilyDetailModal"><i class="fa fa-plus"></i> Add Family Member</a>
														</div> 
														<table class="table">
															<thead>
																<tr>
                                                                    <th scope="col" id="uplogradProfileBtn">Name</th>
                                                                    <th scope="col">Relationship</th>
                                                                    <th scope="col">Email</th>
                                                                    <th scope="col">Emergency Contact</th>
                                                                    <th scope="col">Mobile</th>
                                                                    <th scope="col">Gender</th>
                                                                    <th scope="col">Action</th>
                                                                    <!--<th scope="col">Birthday</th>-->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(count($family) == 0)
                                                                    <tr>
                                                                        <td colspan="8"><h3 class="nw-user-nm text-center">Family Details not added yet.</h3></td>
                                                                    </tr>
                                                                @else
                                                                    @foreach($family as $value)
                                                                        <tr>
                                                                            <td>{{$value->first_name}} {{$value->last_name}}</td>
                                                                            <td>{{$value->relationship}}</td>
                                                                            <td>{{$value->email}}</td>
                                                                            <td>{{$value->emergency_contact}}</td>
                                                                            <td>{{$value->mobile}}</td>
                                                                            <td>{{$value->gender}}</td>
                                                                            <td><a href="javascript: void(0);" data-toggle="modal" data-target="#addFamilyDetailModal"><i class="fa fa-pencil family_edit" user_id="{{$value}}" style="color: #f53b49"></i></a> 
                                                                                <a href="javascript: void(0);" ><i class="fa fa-trash family_delete" user_id="{{$value->id}}" style="color: #f53b49"></i></a></td>
                                                                            <?php /*?><td style="display: flex!important;">{{ date('m-d-Y', strtotime($value->birthday)) }}</td><?php */?>
                                                                        </tr>
                                                                	@endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
													</div>
                                                   	<!-- Thumbnail images of users from company_images objects are 
                                                        rendering here and also publishing in the buiness profile page -->                   									@isset(Auth::user()->company_images)
														<div class="row" style="padding: 10px 20px;" id="delimgbox">
															@foreach(json_decode(Auth::user()->company_images) as $key=>$value)
                            									<div class="col-md-4" class="imgdeletediv" style="position:relative;padding: 15px;">
                                                                	<img src="<?php echo Config::get('constants.USER_IMAGE_THUMB') . $value; ?>" style="width:100%;height:200px;" />
                                                                	<button type="button" myindex="{{$key}}" class="btn btn-primary delimg" style="margin-top: 15px;"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                            	</div>
                                                            @endforeach
                                                        </div>
													@endisset
                        							<div id="Modal" class="modal fade" role="dialog">
														<div class="modal-dialog">
                            								<div class="modal-content">
                                                            	<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title" style="color:black;">Add User Images</h4>
																</div>
                                                                <div class="modal-body">
																	<form method="POST" action="{{url('/user-multi-image-upload')}}" enctype="multipart/form-data">
                                                                    	<input required type="file" class="form-control" name="images[]" placeholder="Company Image" multiple>
                                                                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
																</div>
																<div class="modal-footer">
																	<button type="submit" class="btn btn-default">Save</button>
                                                                    </form>
																	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																</div>
															</div>
                            							</div>
													</div>
                        						</div>
											</div>
										</div>
									</div>
								</div>
                         		<div class="col-sm-12 col-md-4 col-lg-4">
									<div class="right-box">
            							<div class="static hide">
											<h5><i class="far fa-bookmark mr-2"></i> Statistic </h5>
											<div class="static-soc">
												<ul>
                                                	<li><a href="#"><i class="far fa-eye mr-2"></i> 0 Views </a></li>
													<li><a href="#"><i class="far fa-star mr-2"></i> 0 Ratings </a></li>
													<li><a href="#"><i class="far fa-heart mr-2"></i> 0 Favorites</a></li>
													<li><a href="#"><i class="fas fa-share mr-2"></i> 0 Shares </a></li>
												</ul>
											</div>
										</div>
                                    	<div class="widget">
                                        	<h4 class="widget-title">Your page</h4> 
                                        	<div class="your-page">
                                            	<figure>
                                                	<a href="#" title=""><img src="/images/newimage/friend-avatar9.jpg" alt=""></a>
                                            	</figure>
                                                <div class="page-meta">
                                                    <a href="#" title="" class="underline">My Creative Page</a>
                                                    <span><i class="far fa-comment-alt"></i><a href="#" title="">Messages </a></span>
                                                    <span><i class="fa fa-bell-o"></i><a href="#" title="">Notifications </a></span>
                                                </div>
                                                <ul class="page-publishes">
                                                    <li>
                                                        <span><i class="fa fa-user-circle"></i>Profile Views</span>
                                                        <span>1.3m</span>
                                                    </li>
                                                    <li>
                                                        <span><i class="fa fa-mobile"></i>Post</span><br>
                                                        <span>1.3k</span>
                                                    </li>
                                                    <li>
                                                        <span><i class="fa fa-thumbs-up"></i>Reviewed</span><br>
                                                        <span>350</span>
                                                    </li>
                                                    <li>
                                                        <span><i class="fa fa-calendar"></i>Bookings Made</span>
                                                        <span>245</span>
                                                    </li>
                                                </ul>
                                            	<div class="page-likes">
                                                    <ul class="nav nav-tabs likes-btn">
                                                        <li class="nav-item"><a class="active" href="#link1" data-toggle="tab" data-ripple="">likes</a></li>
                                                        <li class="nav-item"><a class="" href="#link2" data-toggle="tab" data-ripple="">views</a></li>
                                                    </ul>
                                                    
                                                    <div class="tab-content">
                                                        <div class="tab-pane active fade show " id="link1" >
                                                            <span><i class="fa fa-heart-o"></i>884</span>
                                                            <a href="#" title="weekly-likes">35 new likes this week</a>
                                                            <div class="users-thumb-list">
                                                                <a href="#" title="Anderw" data-toggle="tooltip">
                                                                    <img src="{{ url('public/images/newimage/userlist-1.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="frank" data-toggle="tooltip">
                                                                    <img src="{{ url('public/images/newimage/userlist-2.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="Sara" data-toggle="tooltip">
                                                                    <img src="{{ url('public/images/newimage/userlist-3.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="Amy" data-toggle="tooltip">
                                                                    <img src="{{ url('public/images/newimage/userlist-4.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="Ema" data-toggle="tooltip">
                                                                    <img src="{{ url('public/images/newimage/userlist-5.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="Sophie" data-toggle="tooltip">
                                                                    <img src="{{ url('public/images/newimage/userlist-6.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="Maria" data-toggle="tooltip">
                                                                    <img src="{{ url('public/images/newimage/userlist-7.jpg') }}" alt="">  
                                                                </a>  
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="link2" >
                                                            <span><i class="fa fa-eye"></i>440</span>
                                                            <a href="#" title="weekly-likes">440 new views this week</a>
                                                            <div class="users-thumb-list">
                                                                <a href="#" title="Anderw" data-toggle="tooltip">
                                                                	<img src="{{ url('public//images/newimage/userlist-1.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="frank" data-toggle="tooltip">
                                                                	<img src="{{ url('public/images/newimage/userlist-2.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="Sara" data-toggle="tooltip">
																	<img src="{{ url('public/images/newimage/userlist-3.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="Amy" data-toggle="tooltip">
																	<img src="{{ url('public/images/newimage/userlist-4.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="Ema" data-toggle="tooltip">
																	<img src="{{ url('public/images/newimage/userlist-5.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="Sophie" data-toggle="tooltip">
																	<img src="{{ url('public/images/newimage/userlist-6.jpg') }}" alt="">  
                                                                </a>
                                                                <a href="#" title="Maria" data-toggle="tooltip">
																	<img src="{{ url('public/images/newimage/userlist-7.jpg') }}" alt="">  
                                                                </a>  
                                                            </div>
                                                        </div>
                                                    </div>
                                            	</div>
											</div>
                                    	</div><!-- page like widget -->
                                    	<div class="widget-follower stick-widget" style="">
                                        	<h4 class="widget-title">Who's follownig</h4>
                                        	<ul class="followers ps-container ps-theme-default ps-active-y" data-ps-id="5cd3a8d3-6387-6733-d2b2-cf500179e453">
                                            	<li>
                                                    <figure><img src="/images/newimage/friend-avatar2.jpg" alt=""></figure>
                                                    <div class="friend-meta">
                                                        <h4><a href="#" title="">Kelly Bill</a></h4>
                                                        <a href="#" title="" class="underline">Follow</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure><img src="/images/newimage/friend-avatar4.jpg" alt=""></figure>
                                                    <div class="friend-meta">
                                                        <h4><a href="#" title="">Issabel</a></h4>
                                                        <a href="#" title="" class="underline">Follow</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure><img src="/images/newimage/friend-avatar6.jpg" alt=""></figure>
                                                    <div class="friend-meta">
                                                        <h4><a href="#" title="">Andrew</a></h4>
                                                        <a href="#" title="" class="underline">Follow</a>
                                                    </div>
                                                </li>
                                                <li>
                                                    <figure><img src="/images/newimage/friend-avatar8.jpg" alt=""></figure>
                                                    <div class="friend-meta">
                                                        <h4><a href="#" title="">Sophia</a></h4>
                                                        <a href="#" title="" class="underline">Follow</a>
                                                    </div>
                                                </li>
                                                <li> 
                                                    <figure><img src="/images/newimage/friend-avatar3.jpg" alt=""></figure>
                                                    <div class="friend-meta">
                                                        <h4><a href="#" title="">Allen</a></h4>
                                                        <a href="#" title="" class="underline">Follow</a>
                                                    </div>
                                                </li>
                                        	</ul>
                                    	</div><!-- who's following -->
                                    	<div class="get-started">
                                            <div class="get-img"><img src="/public/images/newimage/get-started.jpg" alt="images" class="img-fluid"></div>
                                                <div class="get-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</div>
                                                <div class="get-btn-box"><a href="#" data-toggle="modal" data-target="#get_started" class="get-btn"> Get Started </a> </div>
                                            </div>
                                            <div class="ad-img">
                                                <img src="/public/images/newimage/ad-img.jpg" alt="images" class="img-fluid">
                                            </div>
                                        </div>
                                	</div>
                    			</div>
							</div>
						</div>
					</div>
				<!--</div>--> <!-- comment by nnn -->
			</section>

@include('layouts.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<link href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css" />
<!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.src.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<?php /*?><script src="{{ url('public/js/pixelarity-face.js') }}"></script><?php */?>
<script src="{{ url('public/js/jquery.shares.js') }}"></script>
<!-- emoji -->
<script src="{{ url('public/emoji/lib/js/config.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/util.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/jquery.emojiarea.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/emoji-picker.js') }}"></script>
<script src="{{ url('public/js/date-range-picker.js') }}"></script>
<script src="{{ url('public/js/webcam.min.js') }}"></script>
<script type="text/javascript"> 
	
	function take_snapshot() {
		Webcam.snap( function(data_uri) {
			$(".image-tag").val(data_uri);
				document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/><button style="margin-top:2%;; background-color:white; color:#bd2025;" onclick="myFunction()"> Click to verify </p>';
		} );
	}
	function showWebCam() 
	{
		//$("#webCamButton").hide();
		$("#cameradiv").show();
		Webcam.set({
			 width: 650,
			 height: 400,
			 image_format: 'jpeg',
			 jpeg_quality: 90
		 });
		 Webcam.attach( '#my_camera' );
	}
	function myFunction() {
		alert("Image verified!");
	}
	$(document).ready(function(){ 
		function detectWebcam(callback) {
			let md = navigator.mediaDevices;
			if (!md || !md.enumerateDevices) return callback(false);
				md.enumerateDevices().then(devices => {
					callback(devices.some(device => 'videoinput' === device.kind));
				})
			}
			detectWebcam(function(hasWebcam) {
				var checkwebcam = (hasWebcam ? 'yes' : 'no');
				if(checkwebcam == 'no'){
					//$('.checkwebcam').css("display","none");
				}
			}) 
			$(document).on('click', '.sharefb', function(){ 
				var id = $(this).attr("id");
                $.ajax({
					url: "{{route('postDetail')}}",
					type: 'get',
					data:{
						id:id,
					},
					success: function (response) {
					}
				});
			});
            $(document).on('click', '.editpopup', function(){
				var id = $(this).attr("id");
				$.ajax({
					url: "{{route('editpost')}}",
					type: 'get',
					data:{
						id:id,
					},
					success: function (response) {
						$('#edit_image').html(response.html);
						$('.post_textemoji').html(response.data_textarea);
						$('#someid').attr('name', 'value'); 
						$('#edit_post').modal('show');
					}
				});
			});
		});
		
		$('.preview').click(function () {
			//var imgsrc = $('.').attr('src');
			//$('.postText').text($('#post_text').val());
			$('.postText').html($('.newpst-input .emoji-wysiwyg-editor').html());
			var img_array = [];
			var video = $('#videourl').val();
			var music = $('#musicurl').val();
			var sources = $(".postimgarray").map(function() {
				img_array.push(this.src);
			}).get();  
			var imgcount = img_array.length-5;
			var totimgcount = img_array.length;
			var html = '<div class="row" ><div class="col-lg-6 col-md-6 col-sm-6">';
			/* video preview */                
			if(String(video) != 'undefined'){
				html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><video width="320" height="240" src='+video+' controls>Your browser does not support the video tag.</video></a></figure>';
			}
			/* music preview*/
			if(String(music) != 'undefined'){
				html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><audio src="'+music+'" controls></audio></a></figure>';
			}
			/* Image preview */
			if(String(img_array[0]) != 'undefined'){
				html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><img src='+img_array[0]+' alt="" width="100" height ="210"></a></figure>'
			}
			if(String(img_array[1]) != 'undefined'){
				html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><img src='+img_array[1]+' alt="" width="100" height ="210"></a></figure>'
			}
			html += '</div>';
			html += '<div class="col-lg-6 col-md-6 col-sm-6">';
			if(String(img_array[2]) != 'undefined'){
				html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><img src='+img_array[2]+' alt="" width="100" height ="140"></a></figure>'
            }
			if(String(img_array[3]) != 'undefined'){
				html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><img src='+img_array[3]+' alt="" width="100" height ="140"></a></figure>'
			}
			if(String(img_array[4]) != 'undefined'){
				html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><img src='+img_array[4]+' alt="" width="100" height ="140"></a><div class="more-photos"><span>+ '+imgcount+'</span></div></figure>'
			}
			html += '</div>';
			html += '</div>';
            $('#add_image').html(html);
				$('#previewmodel').modal('show');
            });
		</script>

<script>
	$(document).ready(function(){
		$('a.share').shares();
	});
</script>
<script>
	/*$(function() {
		// Initializes and creates emoji set from sprite sheet
		window.emojiPicker = new EmojiPicker({
			emojiable_selector: '[data-emojiable=true]',
			assetsPath: '../public/emoji/lib/img/',
			popupButtonClasses: 'fas fa-smile'
		});
		// Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
		// You may want to delay this step if you have dynamically created input fields that appear later in the loading process
		// It can be called as many times as necessary; previously converted input fields will not be converted again
		window.emojiPicker.discover();
	});*/
</script>
<script>
	// Google Analytics
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-49610253-3', 'auto');
    ga('send', 'pageview');
</script>
<!--  <script type="text/javascript">
	var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
	_gaq.push(['_setDomainName', 'axc']);
	_gaq.push(['_trackPageview']);
	(function() {
    	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script> -->

<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('.blah').attr('src', e.target.result);
				var html = '<img src="' + e.target.result + '">';
				$('.uploadedpic').html(html);
			};
			profile_pic_var = input.files[0];
			reader.readAsDataURL(input.files[0]);
		}
	}
	//window.onload = gallery;
	//when we load your gallery in browser then gallery function is loaded
	function gallery() {
		// gallery is the name of function
		//var allimages = document.images;
		var allimages = $("img.gallarychangeimg");
		for (var i = 0; i < allimages.length; i++) {
			//if(allimages[i].id.indexOf("small") > -1){
			allimages[i].onclick = imgChanger;
			//in above line we are adding a listener to all the thumbs stored inside the allimages array on onclick event.
			//}
		}
	}
	//declaring the imgChanger function
	function imgChanger() {
		//changing the src attribute value of the large image.
		document.getElementById('myPicturechange').src = this.id;
	}
	$(document).ready(function () {
		$("#profile_pic").change(function (e) {
			var img = e.target.files[0];
			if (!pixelarity.open(img, false, function (res, faces) {
				//console.log(faces);
				$("#result").attr("src", res);
				$("#croped_img").val(res);
				$(".face").remove();
				for (var i = 0; i < faces.length; i++) {
					$("body").append("<div class='face' style='height: " + faces[i].height + "px; width: " + faces[i].width + "px; top: " + ($("#result").offset().top + faces[i].y) + "px; left: " + ($("#result").offset().left + faces[i].x) + "px;'>");
				}
			}, "jpg", 0.7, true)) {
				alert("Whoops! That is not an image!");
			}
		});
	});

</script>
<script>
	function initialize1(q) {
		console.log(q.value);
		var input = q;
		console.log(input.value);
		var s = input.value;
		// var streetaddress= input.substr(0, input.indexOf(',')); 
    	var autocomplete = new google.maps.places.Autocomplete(input);
		//  if(s != ''){
			//     var streetaddress= s.substr(0, s.indexOf(','));
            //     input.value = streetaddress
		// }
		$('.pac-container').css('z-index', '999999999');
			autocomplete.addListener('place_changed', function () {
				var place = autocomplete.getPlace();
                lat = place.geometry.location.lat();
				long = place.geometry.location.lng();
				for (var i = 0; i < place.address_components.length; i++) {
					for (var j = 0; j < place.address_components[i].types.length; j++) {
						if (place.address_components[i].types[j] == "postal_code") {
							$('#frm_zipcode').val(place.address_components[i].long_name);
						}
						if (place.address_components[i].types[j] == "locality") {
							$('#frm_city').val(place.address_components[i].long_name);
							// document.getElementById('b_address').value = place.address_components[i].short_name;
							//document.getElementById('b_city').value = place.address_components[i].short_name;
						}
						if (place.address_components[i].types[j] == "country") {
							$('#frm_country_dd').val(place.address_components[i].short_name);
						}
						if (place.address_components[i].types[j] == "administrative_area_level_1") {
							$('#frm_state').val(place.address_components[i].long_name);
						}
					}
				}
			});
		}
</script>
<script>
	function readURLCOVER(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function(e) {
			$('#thumb-2').attr('src', e.target.result);
			}
			
			reader.readAsDataURL(input.files[0]); //  convert to base64 string
		}
	}
	/* page load scroll*/
	var page =0;
	var cnfload = true;
	
	//for mobile and web scroll
	var addition_constant = 0;
	$(document.body).on('touchmove', onScroll); // for mobile
	$(window).on('scroll', onScroll);
	
	function onScroll() {
	  var addition = ($(window).scrollTop() + window.innerHeight);
	  //var footerHeight = $('#footer').height();
	  var scrollHeight = (document.body.scrollHeight - 1);
	  //scrollHeight = scrollHeight-footerHeight;
	  if (addition > scrollHeight && addition_constant < addition) {
	
		addition_constant = addition;
	
		cnfload = false;
		page++;
		//alert(page);
		load_data(page);
	  }
	}
	
	function load_data(page){
		$('.loader').show();
		$.ajax({
			url: "{{url('/loadmorepost')}}",
			type: 'get',
			data:{
				page:page,
			},  
			success: function (data) {
				if(data.success=='success'){
					$('#scroll_pagination').append(data.html);
					cnfload = true;
				}
			}
		});
	}
	//load_data(page);

$('#image_post').on("change", previewImages);
$('#video').on("change", previewVideo);
function previewVideo(){
    var $preview = $('.postImage').empty(); 
    $preview.append('<input type="hidden" id="videourl"></span><video width="320" height="240" controls>Your browser does not support the video tag.</video>');
	let file = event.target.files[0];
	let blobURL = URL.createObjectURL(file);
	document.querySelector("video").src = blobURL;
	$('#videourl').val(blobURL);
}
$('#music_post').on("change", previewMusic);
function previewMusic(){
    var $preview = $('.postImage').empty(); 
    $preview.append('<input type="hidden" id="musicurl"></span><video width="320" height="240" controls>Your browser does not support the video tag.</video>');
	let file = event.target.files[0];
	let blobURL = URL.createObjectURL(file);
	document.querySelector("video").src = blobURL;
	$('#musicurl').val(blobURL);
}

function previewImages() {
	var $preview = $('.postImage').empty(); 
	if (this.files) $.each(this.files, readAndPreview);
	function readAndPreview(i, file) {
    	if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
      		return alert(file.name +" is not an image");
    	} // else...
    	var reader = new FileReader();
    	$(reader).on("load", function() {
        	$preview.append($('<img>', {src:this.result, height:100, width:100, class:'postimgarray'}));
    	});
		reader.readAsDataURL(file);
  	}
}

$(document).on('click', '.editpic', function(){
	//$('.editpic').click(function () {
	var imgname = $(this).attr('imgname');
	var id = $(this).attr('id');
	var foldernm = '<?php echo $loggedinUser->id;  ?>';
	$('#imgId').val(id);
	$('#imgname').val(imgname);
	$(".srcappend").attr("src","/public/uploads/gallery/"+foldernm+"/thumb/"+imgname);
});

$(document).on('click', '.reportPost', function(){
	//$('.reportPost').click(function () {
	var _token = $("input[name='_token']").val();
    var postId =$(this).attr('id');
	var is_report = $(this).attr('is_report');
    $.ajax({
		url: "{{url('/reportPost')}}" + "/"+postId,
		type: 'post',
		data:{
			_token:_token,
			is_report:is_report
		},
		success: function (data) {
			if(data.success=='success'){
				$('#likecount'+postId).html(data.count);
			}
		}
	}); 
});

$(document).on('click', '.showcomments', function(){
    var commentdisplay = $('#commentdisplay').val();
    var postId =$(this).attr('id');
    $('.commentappendremove').html("");
    $.ajax({
		url: "{{url('/showcomments')}}" + "/"+postId,
		type: 'get',
		data:{
			commentdisplay:commentdisplay
		},
		success: function (data) {
			if(data.success=='success'){
				//$('#likecount'+postId).html(data.count);
				$('.commentappend'+postId).html(data.html);
				var commentsum = parseInt(commentdisplay)+parseInt(5);
				$('#commentdisplay').val(commentsum);
			}
		}
	}); 
});

$(document).on('click', '.thumblike', function(){
	//$('html, body').stop();
	var _token = $("input[name='_token']").val();
	var postId =$(this).attr('id');
	var is_like = $(this).attr('is_like');
    $.ajax({
		url: "{{url('/like-post')}}" + "/"+postId,
		type: 'post',
		data:{
			_token:_token,
			is_like:is_like
		},
		success: function (data) {
			if(data.success=='success'){
				$('#likecount'+postId).html(data.count);
			}
		}
	});
});

$("#coverphoto").change(function() {
	readURLCOVER(this);
});

function delPostImg(vl){
	var id = $(vl).data("delpostid");
    var imgname = $(vl).data("imgname");
	var txt;
	var r = confirm("Are you sure, you want to delete?");
	if (r == true) {
		$.ajax({
			url: "{{url('/delete-image-post')}}" + "/"+id,
			type: 'get',
			data:{
				imgname:imgname
			},
			success: function (data) {  
				if(data.success=='success'){
					$.ajax({
						url: "{{route('editpost')}}",
						type: 'get',
						data:{ id:id, },
						success: function (response) {
							$('#edit_image').html(response.html);
							//$('#edit_post').modal('show');
						}
					});
				}      
			}
		});
	}
}
</script>
<script>
$(document).ready(function () {
	$('.delimg').click(function () {
		$.ajax({
			url: "{{url('/delete-image-user?myindex=')}}" + $(this).attr('myindex'),
			type: 'get',
			beforeSend: function () {
				$('.loader').show();
			},
			complete: function () {
				$('.loader').hide();
			},
			success: function (response) {
				//if(response.status ==200){
				window.location.reload()
				$(this).parent().remove();
				//}
			}
		});
	});

	$('.delPhoto').click(function () {
		var txt;
		var r = confirm("Are you sure, you want to delete?");
		if (r == true) {
			$.ajax({
				url: "{{url('/delete-image-gallery?delId=')}}" + $(this).attr('delId'),
				type: 'get',
				beforeSend: function () { $('.loader').show(); },
				complete: function () { $('.loader').hide(); },
				success: function (response) {
					//if(response.status ==200){
					window.location.reload();
					$(this).parent().remove();
					//}
				}
			});
		}
	});

	$('.selectPhoto').click(function () {
		var txt;
		var r = confirm("Are you sure, you want to set cover photo?");
		if (r == true) {
			$.ajax({
				url: "{{url('/set-cover-photo?selectId=')}}" + $(this).attr('selectId'),
				type: 'get',
				beforeSend: function () { $('.loader').show(); },
				complete: function () { $('.loader').hide(); },
				success: function (response) {
					//if(response.status ==200){
					window.location.reload();
					$(this).parent().remove();
					//}
				}
			});
		}
	});
                    
	$('.unselectPhoto').click(function () {
		var txt;
		var r = confirm("Are you sure, you want to unset cover photo?");
		if (r == true) {
			$.ajax({
				url: "{{url('/unset-cover-photo?selectId=')}}" + $(this).attr('selectId'),
				type: 'get',
				beforeSend: function () { $('.loader').show(); },
				complete: function () { $('.loader').hide(); },
				success: function (response) {
					//if(response.status ==200){
					window.location.reload();
					$(this).parent().remove();
					//}
				}
			});
		}
	});

	//Loads the html to each slider. Write in the "div id="slide-content-x" what you want to show in each slide
	$('#carousel-text').html($('#slide-content-0').html());
	//Handles the carousel thumbnails
	$('[id^=carousel-selector-]').click(function () {
		var id = this.id.substr(this.id.lastIndexOf("-") + 1);
		var id = parseInt(id);
		$('#myCarousel').carousel(id);
	});
	// When the carousel slides, auto update the text
	$('#myCarousel').on('slid.bs.carousel', function (e) {
		var id = $('.item.active').data('slide-number');
		$('#carousel-text').html($('#slide-content-' + id).html());
	});

	$('.coemail').attr('href', "{{'mailto:'.$UserProfileDetail['email']}}");
	$('.cophone').attr('href', "{{'tel:'.$UserProfileDetail['phone_number']}}");
	$('.coaddress').attr('href', "{{'http://maps.google.com/?q='.$UserProfileDetail['address']}}");
	$('.prfl-nme').html('');
	if (window.location.href.split('?').pop() == 'companyCreate=1') {
		$('#create_company_btn').click()
	}

	$("#resetPassword").click(function () {
		formdata = new FormData();
		var token = '{{csrf_token()}}';
		var email = '{{Auth::user()->email}}';
		formdata.append("_token", token);
		formdata.append("email", email);
		$.ajax({
			url: '/password/email',
			type: 'POST',
			dataType: 'json',
			data: formdata,
			processData: false,
			contentType: false,
			beforeSend: function () {
				// $('#submit_profiledetail').prop('disabled', true);
			},
			complete: function () {
				// $('#submit_profiledetail').prop('disabled', false);
			},
			success: function (response) {
				showSystemMessages('#systemMessage_detail', response.type, response.msg);
			}
		});
	});
	$('#datepicker-on-change').Zebra_DatePicker({
		default_position: 'below',
		container: $('.datepicker-position')
	});
	$('#frm1_birthday').Zebra_DatePicker({
		default_position: 'below',
		direction: -1,
		format: 'm-d-Y',
		container: $('#datepicker-position')
	});
});

                $(function () {
                    $("#my_date_picker").datepicker({
                        format: 'yy/mm/dd',
                    });
                });

                $(document).on('click', '.delete', function () {
                    var j = $(this).attr('num')
                    var hell = $('.add-more-div').toArray();
                    hell[j].remove();
                    console.log($(this).attr('num'))
                });

                $('.add-more').click(function () {
                    var lastcount = $('.delete').length + 1;
                    var html = '<div class="row add-more-div"><hr />'
                            + '<div class="col-sm-6">'
                            + '<div class="row col-sm-12 text-left">'
                            + '<label>Company Name<span class="color-red">*</span></label>'
                            + ' </div>'
                            + '<input type="text" name="Companyname" id="b_companyname" size="30" maxlength="80" placeholder="Company Name">'
                            + ' <span class="error" id="b_cmpo"></span>'
                            + '<div class="row col-sm-12 text-left">'
                            + '<label>City<span class="color-red">*</span></label>'
                            + '</div>'
                            + '<input type="text" name="City" id="b_city" size="30" placeholder="City" size="30" maxlength="80"> '
                            + '<span class="error" id="b_ct"></span>'
                            + '<div class="row col-sm-12 text-left">'
                            + '<label>Zip Code<span class="color-red">*</span></label>'
                            + '</div>'
                            + '<input type="number" name="Zip Code" id="b_zipcode" size="30" placeholder="Zip Code">'
                            + '<span class="error" id="b_zip"></span>'
                            + '<div class="row col-sm-12 text-left">'
                            + '<label>EIN Number<span class="color-red">*</span></label>'
                            + '</div>'
                            + '<input type="text" name="b_EINnumber" maxlength="10" id="b_EINnumber" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="EIN Number">'
                            + '<span class="error" id="b_ein"></span>'
                            + '</div>'

                            + '<div class="col-sm-6">'
                            + '<div class="row col-sm-12 text-left">'
                            + ' <label>Address<span class="color-red">*</span></label>'
                            + ' </div>'
                            + ' <input type="text" name="Address" id="b_address" placeholder="Address">'
                            + ' <span class="error" id="b_addr"></span>'
                            + ' <div class="row col-sm-12 text-left">'
                            + ' <label>State<span class="color-red">*</span></label>'
                            + ' </div>'
                            + '<input type="text" name="State" id="b_state" size="30" placeholder="State" size="30" maxlength="80">'
                            + '<span class="error" id="b_sta"></span>'

                            + '<div class="row col-sm-12 text-left">'
                            + '<label>Country<span class="color-red">*</span></label>'
                            + '</div>'
                            + '<input type="text" name="Country" value="" id="b_country" size="30" placeholder="Country">'

                            + '<span class="error" id="b_cont"></span>'
                            + '<div class="row col-sm-12 text-left">'
                            + '<label>Establishment Year<span class="color-red">*</span></label>'
                            + '</div>'
                            + '<input type="number" name="b_Establishmentyear" id="b_Establishmentyear" size="30" maxlength="4" placeholder="Establishment Year" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">'
                            + '<span class="error" id="b_estb"></span>'
                            + '</div>'
                            + '<div class="text-right">'
                            + '<button type="button" class="btn btn-secondary delete" num="' + lastcount + '">Delete</button>'
                            + '</div>'
                            + '</div>'
                    $("div.add-more-div:last").after(html);
                    lastcout = lastcount + 1;
                })

                $('#b_v_2').click(function () {
                    $(".error").empty();
                    if ($("#frm_organisationname").val() != '') {
                        if ($("#frm_position").val() != '') {
                            if ($("#dp1").val() != '') {
                                if ($("#dp2").val() != '') {
                                    if ($("#frm_course").val() != '') {
                                        if ($("#frm_university").val() != '') {
                                            if ($("#passingyear").val() != '') {
                                                if ($("#certification").val() != '') {
                                                    if ($("#completionyear").val() != '') {
                                                        if ($("#skiils_achievments_awards").val() != '') {
                                                            if ($("#skillcompletionpicker").val() != '') {
                                                                $('#fitnessity_for_business_step2').hide();
                                                                $('#fitnessity_for_business_step3').show();
                                                            } else {
                                                                $("#b_skillyear").text("Please Enter the skill completion date");
                                                            }
                                                        } else {
                                                            $("#b_skilltype").text("Please select skill type");
                                                        }
                                                    } else {
                                                        $("#b_certificateyear").text("Please Enter the Certication completion date");
                                                    }
                                                } else {
                                                    $("#b_certification").text("Please Enter the certification");
                                                }
                                            } else {
                                                $("#b_year").text("Please select passing year ");
                                            }

                                        } else {
                                            $("#b_university").text("Please Enter the university ");
                                        }
                                    } else {
                                        $("#b_degree").text("Please enter the course ");
                                    }
                                } else {
                                    $("#b_employmentto").text("Please enter the to date ");
                                }
                            } else {
                                $("#b_employmentfrom").text("Please enter the from date ");
                            }
                        } else {
                            $("#b_position").text("Please enter the position ");
                        }
                    } else {
                        $("#b_organisationname").text("Please enter the organisation name ");
                    }

                });
                $("label.present_work_btn").click(function () {
                    $("#frm_ispresentcheck").attr("checked", !$("#frm_ispresentcheck").attr("checked"));
                    changeDateBasedonPresent();
                });

                function changeDateBasedonPresent()
                {
                    if ($("#frm_ispresentcheck").attr("checked")) {
                        $("#frm_ispresent").val("1");
                        $("#dp2").val("Till Date");
                        $("#dp2").attr("disabled", true);
                    } else {
                        $("#frm_ispresent").val("0");
                        $("#dp2").val("");
                        $("#dp2").attr("disabled", false);
                    }
                }

                //     $('#passingyear').Zebra_DatePicker({
                //          view: 'years',
                //          format: 'Y',
                //         default_position: 'below',
                //         container : $('#passingpicker-position')      
                // });
                $('#dp1').Zebra_DatePicker({
                    default_position: 'below',
                    container: $('#dp1-position')
                });
                $('#dp2').Zebra_DatePicker({
                    default_position: 'below',
                    container: $('#dp2-position')
                });
                $('#completionyear').Zebra_DatePicker({
                    default_position: 'below',
                    container: $('#completionpicker-position')
                });
                $('#skillcompletionpicker').Zebra_DatePicker({
                    default_position: 'below',
                    container: $('#skillcompletionpicker-position')
                });

                $('#imagedropbox').click(function () {
                    console.log("Photo Upload");
                    $('#Modal').modal('show');
                });

                $('#uplogradProfileBtn').click(function () {
                    $('#upgradeProfileForm').modal('show');
                    //         $.ajax({
                    //   url:'customer/upgradeProfile/{{Auth::user()->upgrade_profile_link}}',
                    //   type:'GET',
                    // success: function (response) {
                    //     if(response.type === 'success'){
                    //             $('#upgradeProfileForm').modal('show'); 
                    //       }else{
                    //           showSystemMessages('#systemMessage', response.type, response.msg);
                    //       }
                    //     }
                    // });
                });

                $(".family_edit").click(function () {
                    var data = JSON.parse($(this).attr('user_id'))
                    $('#family_id').val(data.id)
                    $('#frm1_firstname').val(data.first_name)
                    $('#frm1_lastname').val(data.last_name)
                    $('#frm1_email').val(data.email)
                    $('#frm1_mobile').val(data.mobile)
                    $('#frm1_emergency_contact').val(data.emergency_contact)
                    $('#frm1_gender').val(data.gender)
                    $('#frm1_relationship').val(data.relationship)
                    console.log(moment("YYYY-MM-DD", data.birthday))
                    $('#frm1_birthday').val(moment(data.birthday, "YYYY-MM-DD").format("MM-DD-YYYY"))
                    $('#familyModal').text('Edit Family Detail')
                });

                $("#addFamily").click(function () {
                    //var data = JSON.parse($(this).attr('user_id'))
                    $('#family_id').val(0)
                    $('#frm1_firstname').val('')
                    $('#frm1_lastname').val('')
                    $('#frm1_email').val('')
                    $('#frm1_mobile').val('')
                    $('#frm1_gender').val('')
                    $('#frm1_relationship').val('')
                    $('#frm1_birthday').val('')
                    $('#frm1_emergency_contact').val('')
                    $('#familyModal').text('Add Family Detail')
                });

                $(".family_delete").click(function () {
                    var family_id = $(this).attr('user_id')
                    swal({
                        title: "Are you sure?",
                        text: "You want to delete this family member!",
                        icon: "warning",
                        buttons: [
                            'Cancel',
                            'Delete'
                        ],
                        dangerMode: true,
                    }).then(function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: '/family-member-delete/' + family_id,
                                type: 'GET',
                                beforeSend: function () {
                                    // $('#register_submit').prop('disabled', true);
                                    showSystemMessages('#systemMessage', 'info', 'Please wait while we delete family member with Fitnessity.');
                                },
                                complete: function () {
                                    //$('#register_submit').prop('disabled', true);
                                },
                                success: function (response) {
                                    showSystemMessages('#systemMessage', response.type, response.msg);
                                    if (response.type === 'success') {
                                        window.location.reload();
                                    } else {
                                        // $('#register_submit').prop('disabled', false);    
                                    }
                                }
                            });
                        } else {
                            swal("Cancelled", "Your data is safe");
                        }
                    });
                });

                //var phonecode = '<?php //echo $phonecode;     ?>';
                $('#country').change(function () {
                    var country_code = $('#frm_country').val();
                    if (country_code) {
                        $.ajax({
                            type: "GET",
                            url: "{{url('/get-state-list')}}?country_code=" + country_code,
                            success: function (res) {
                                if (res) {
                                    $("#frm_state").empty();
                                    $("#frm_state").append('<option>Select</option>');
                                    $.each(res, function (key, value) {
                                        $("#frm_state").append('<option value="' + key + '">' + value + '</option>');
                                    });
                                } else {
                                    $("#frm_state").empty();
                                }
                            }
                        });
                    } else {
                        $("#frm_state").empty();
                        $("#frm_city").empty();
                    }
                });

                $('#frm_state').on('change', function () {
                    var state_id = $(this).val();
                    if (state_id) {
                        $.ajax({
                            type: "GET",
                            // url: '/get-city-list/'+state_id,
                            url: "{{url('/get-city-list')}}?state_id=" + state_id,
                            success: function (res) {
                                if (res) {
                                    $("#frm_city").empty();
                                    $.each(res, function (key, value) {
                                        $("#frm_city").append('<option value="' + key + '">' + value + '</option>');
                                    });
                                } else {
                                    $("#frm_city").empty();
                                }
                            }
                        });
                    } else {
                        $("#frm_city").empty();
                    }
                });

                //   $("#frm_phone_number").keydown(function(e) {
                //        var field=this;
                //        setTimeout(function () {
                //            if(field.value.indexOf(phonecode) !== 0) {
                //                $(field).val(phonecode);
                //            } 
                //        }, 1);
                //    });

                var form = document.querySelector('form');
                // edit profile picture
                $('#frmeditProfile').submit(function (e) {
                    e.preventDefault();
                    $('#frmeditProfile').validate({
                        rules: {
                            profile_pic: {
                                required: true,
                                accept: "image/*"
                            },
                        },
                        messages: {
                            profile_pic: {
                                required: "Upload a Profile picture",
                                accept: "Please upload an image"
                            },
                        }
                    });

                    if (!$('#frmeditProfile').valid()) {
                        return false;
                    }
                    var inputData = new FormData($(this)[0]);
                    $.ajax({
                        url: '/profile/editProfilePicture',
                        type: 'POST',
                        dataType: 'json',
                        data: inputData,
                        processData: false,
                        contentType: false,
                        beforeSend: function () {
                            $('#submit_profilepic').prop('disabled', true);
                        },
                        complete: function () {
                            $('#submit_profilepic').prop('disabled', false);
                        },
                        success: function (response) {
                            console.log('dfsfddsf')
                            if (response.type == 'success') {
                                showSystemMessages('#systemMessage', 'success', 'Profile updated scuccessfully');
                                // $("#display_user_profile_pic").attr("src", response.returndata.profile_pic);
                                // $(".display_user_profile_pic_view_profile").attr("src", response.returndata.profile_pic);
                                $(".display_user_profile_pic_view_profile").each(function () {
                                    $(this).attr("src", response.returndata.profile_pic);
                                });
                                $('#editProfilePic').modal('hide');
                            } else {
                                showSystemMessages('#systemMessage', response.type, response.msg);
                            }
                        }
                    });
                });

                // fill modal form with user details
                var UserProfileDetail = <?php echo json_encode($UserProfileDetail); ?>;
                var ProfessionalDetail = <?php echo json_encode($UserProfileDetail['ProfessionalDetail']); ?>;

                $("#editProfileDetailModal").on("show.bs.modal", function () {
                    $('#editProfileDetailModal').find('#frm_firstname').val(UserProfileDetail.firstname);
                    $('#editProfileDetailModal').find('#frm_lastname').val(UserProfileDetail.lastname);
                    $('#editProfileDetailModal').find('#frm_username').val(UserProfileDetail.username);
                    $('#editProfileDetailModal').find('#frm_gender').val(UserProfileDetail.gender);
                    $('#editProfileDetailModal').find('#frm_email').val(UserProfileDetail.email);
                    $('#editProfileDetailModal').find('#frm_phone_number').val(UserProfileDetail.phone_number);
                    $('#editProfileDetailModal').find('#frm_address').val(UserProfileDetail.address);
                    if (UserProfileDetail.state != null) {
                        $('#editProfileDetailModal').find('#frm_state').val(UserProfileDetail.state);
                        // $('#frm_state').change(function() {
                        //     if(UserProfileDetail.city != null)
                        $('#editProfileDetailModal').find('#frm_city').val(UserProfileDetail.city);
                        // });
                    }
                    $('#editProfileDetailModal').find('#frm_country').val(UserProfileDetail.country);
                    $('#editProfileDetailModal').find('#frm_zipcode').val(UserProfileDetail.zipcode);
                    $('#editProfileDetailModal').find('#message_area').val(UserProfileDetail.intro);
                });

                $("#submit_familydetail").click(function () {
                    $('#frmaddFamilyDetail').submit()
                });

                // validate user detail form
                $('#frmeditProfileDetail').submit(function (e) {
                    e.preventDefault();
                    // check for validation
                    $('#frmeditProfileDetail').validate({
                        rules: {
                            company_name: {
                                required: true
                            },
                            firstname: {
                                required: true
                            },
                            lastname: {
                                required: true
                            },
                            gender: {
                                required: true

                            },
                            phone_number: {
                                // phoneUS: true
                            },
                            address: {
                                required: true
                            },
                            city: {
                                required: true
                            },
                            state: {
                                required: true
                            },
                            zipcode: {
                                required: true
                            },
                            intro: {
                                required: true
                            },
                            about_me: {
                                required: true
                            },
                        },
                        messages: {
                            company_name: {
                                required: "Provide a company name",
                            },
                            firstname: {
                                required: "Provide a first name",
                            },
                            lastname: {
                                required: "Provide a last name",
                            },
                            username: {
                                required: "Provide a last name",
                            },
                            gender: {
                                required: "Select a Gender",
                            },
                            phone_number: {
                                // phoneUS: "Phone number format is invalid. Please enter phone in format of (XXX) XXX XXX",
                            },
                            address: {
                                required: "Provide an adderess",
                            },
                            city: {
                                required: "Provide a city",
                            },
                            state: {
                                required: "Provide a state",
                            },
                            zipcode: {
                                required: "Provide a zipcode",
                            },
                            intro: {
                                required: "Provide a intro",
                            },
                            about_me: {
                                required: "Provide about me",
                            },
                        },
                        submitHandler: saveProfileDetail
                    });
                });

                // $("#submit_familydetail").click(function(){
                //       console.log("called2")
                //     $('#frmaddFamilyDetail').submit();
                //   });


                // validate user detail form
                $('#frmaddFamilyDetail').submit(function (e) {
                    //console.log("callled")
                    e.preventDefault();
                    // check for validation
                    $('#frmaddFamilyDetail').validate({
                        rules: {
                            first_name: {
                                required: true
                            },
                            last_name: {
                                required: true
                            },
                            gender: {
                                required: true
                            },
                            // email:{
                            //     required:true
                            // },
                            relationship: {
                                required: true
                            },
                            birthday: {
                                required: true

                            },
                            mobile: {
                                required: true,
                                maxlength: 10,
                                minlength: 10,
                                // phoneUS: true

                            },
                            emergency_contact: {
                                maxlength: 10,
                                minlength: 10,
                            },
                        },
                        messages: {
                            mobile: {
                                required: "Provide a phone number",
                                minlength: "Please enter a valid contact number",
                                maxlength: "Please enter a valid contact number",
                            },
                            first_name: {
                                required: "Provide a first name",
                            },
                            last_name: {
                                required: "Provide a last name",
                            },
                            gender: {
                                required: "Select a Gender",
                            },
                            relationship: {
                                required: "Select relationship",
                            },
                            birthday: {
                                required: "Select Birthdate",
                            },
                            // email: {
                            //   required: "Email field is required",
                            // },
                            emergency_contact: {
                                minlength: "Please enter a valid contact number",
                                maxlength: "Please enter a valid contact number",
                            },
                        },
                        submitHandler: saveFamilyDetail
                    });
                });

                //$("#submit_cover")
                // save user profile
                function saveProfileDetail() {
                    if ($('#frmeditProfileDetail').valid()) {
                        var formData = $("#frmeditProfileDetail").serialize();
                        $.ajax({
                            url: '/profile/editProfileDetail',
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                            beforeSend: function () {
                                $('#submit_profiledetail').prop('disabled', true);
                            },
                            complete: function () {
                                $('#submit_profiledetail').prop('disabled', false);
                            },
                            success: function (response) {
                                showSystemMessages('#systemMessage_detail', response.type, response.msg);
                                console.log(response);
                                if (response.type == 'success') {
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                    // window.location = "/profile/viewProfile";
                                }
                            }
                        });
                    }
                }

                function saveFamilyDetail() {
                    if ($('#frmaddFamilyDetail').valid()) {
                        var formData = $("#frmaddFamilyDetail").serialize();
                        $.ajax({
                            url: '/add-family-detail',
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                            beforeSend: function () {
                                $('#submit_familydetail').prop('disabled', true);
                            },
                            complete: function () {
                                $('#submit_familydetail').prop('disabled', false);
                            },
                            success: function (response) {
                                showSystemMessages('#systemMessage_detail', response.type, response.msg);
                                console.log(response);
                                if (response.type == 'success') {
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                    // window.location = "/profile/viewProfile";
                                }
                            }
                        });
                    }
                }

                $('textarea#message_area').on('keyup', function () {
                    var maxlen = $(this).attr('maxlength');

                    var length = $(this).val().length;
                    if (length > (maxlen - 10)) {
                        $('#textarea_message').text('max length ' + maxlen + ' characters only!')
                    } else
                    {
                        $('#textarea_message').text('');
                    }
                });

                $('textarea#about_msg').on('keyup', function () {
                    var maxlen = $(this).attr('maxlength');
                    var length = $(this).val().length;
                    if (length > (maxlen - 10)) {
                        $('#aboutarea_message').text('max length ' + maxlen + ' characters only!')
                    } else
                    {
                        $('#aboutarea_message').text('');
                    }
                });

                function removeUpload_coverphoto() {
                    if (confirm("Are you sure you want to delete cover photo?")) {
                        var _token = $("input[name='_token']").val();
                        $.ajax({
                            type: 'POST',
                            url: '{{route("removeusercoverphoto")}}',
                            data: {
                                _token: _token
                            },
                            success: function (data) {
                                alert("Cover photo removed successfully.");
                                window.location.reload();
                            }
                        });
                    }
                }

                   // Follow script
/*    $(".follower-fun").click(function () {
        var _token = $("input[name='_token']").val();
       
        $.ajax({
            type: 'POST',
            url: '{{route("follow_profile")}}',
            data: {
                _token: _token,
            },
            success: function (data) {
                //window.location.reload();
            }
        });
    });*/
                

$('.usernameedit').click(function () {
   var edituser = $(this).attr('id');
   $('#username').val(edituser);

    });

 $(document).on('click', '.inquiryfrm', function () {
        
        var name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();

        var ret = true;
        
        $('#err_name_sign').html('');
        $('#err_email_sign').html('');
        $('#err_message_sign').html('');
        
        if(name == ''){
            $('#err_name_sign').html('Please enter name');
            $('#name').focus();
            //return false;
            return false;
        }
        if(email == ''){
            $('#err_email_sign').html('Please enter email');
            $('#email').focus();
            //return false;
            return false;
        }
        if(message == ''){
            $('#err_message_sign').html('Please enter message');
            $('#message').focus();
            //return false;
            return false;
        }
        
        if(ret == true){
        $('.get_started').submit();

    }
});

function sharediv(){
    $(".shareapp").css("display", "block");
}

$( document ).ready(function() {
      $('.removepost').removeClass('emoji-wysiwyg-editor');
      $('.removepost').removeAttr("data-id");
      $('.removepost').removeAttr("data-type");
      $('.removepost').removeAttr("contenteditable");
      $('.removepost').closest('.clickable').removeClass('grown').addClass('spot');
      $(".post-meta").find('i').removeClass("emoji-picker emoji-picker-icon fa fas fa-smile");

        var ret = true;
        $(document).on('click', '.profilepostbtn', function () {
        
			var post_text = $('#post_text').val();
			var image_post = $('#image_post').val();
			var video_post = $('#video').val();
			var music_post = $('#music_post').val();
			var selfieimg = $('#selfieimg').val();
			
			var ret = true;
			$('#err_image_sign').html('');
			$('#err_post_sign').html('');
			
			/*if(post_text == ''){
				$('#err_image_sign').html('Please enter text!');
				$('#post_text').focus();
				return false;
			}        
			else if( (image_post == '' && video_post == '' && music_post == '') && post_text == '' ){
				$('#err_post_sign').html('Please select image or video or music!');
				$('#image_post').focus();
				return false;
			} */ 
			if(post_text == '' && image_post == '' && video_post == '' && music_post == '' && selfieimg=="")
			{
				$('#err_post_sign').html('Please add your post data!!!');
				$('#post_text').focus();
				ret=false;
				return false;	
			}
			if(ret == true){
				$('#profilepostfrm').submit();
			}       
		});

    $(document).on('click', '.postcomment', function () {
        var postId =$(this).attr('id');
        var comment = $('#comment'+postId).val();     
        var ret_post = true;
        $('#err_comment'+postId).html('');
        if(comment == ''){
            $('#err_comment'+postId).html('Please enter comment!');
            $('#comment').focus();
            return false;
        }
        if(ret_post == true){
            var _token = $("input[name='_token']").val();
                $.ajax({
                url: "{{url('/postcomment')}}" + "/"+postId,
                type: 'post',
                data:{
                    _token:_token,
                    comment:comment
                },          
                success: function (data) {
                    $('.commentappend'+postId).append(data.html);
					$('#comment'+postId).val('');
                }
            });
        }       
    });      
});
</script>
<script>
function fbPost(){
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '320348730100999',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v12.0'
    });
  };
}
</script>

<script>
$("#myDate").datepicker({ 
// OPTIONS HERE
});
</script>

<script>
$("#myDate").datepicker({ 
	// an array of excluded dates
	disableddates: [new Date("04/24/2015"), new Date("04/21/2015")],
	// an array of pre-selected dates
	daterange = [new Date("3/1/2014"),new Date("3/2/2014"),new Date("3/3/2014")
	// appearance options
	showButtonPanel:true,  
	showWeek: true,
	firstDay: 1
});
});
</script>

<script>
	var r = $("#myDate").datepicker({ 
	// OPTIONS HERE
	});
	r.getDateRange()
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

@endsection
            
