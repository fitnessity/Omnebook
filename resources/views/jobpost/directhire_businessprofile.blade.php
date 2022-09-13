@extends('layouts.app')



@section('content')



<section class="direc-hire ">



@include('includes.search_category_sidebar')



<div class="direc-right viewprfl-sec">

    <a href="/directhire/bookprofile/{{ $UserProfileDetail['id'] }}" class="view-more-right" style="float:right;">

      BOOK THIS COMPANY

    </a>

    @include('jobpost.viewbusinessprofile')
    <div id="mySidenav" class="sidenav">
  <a href="#" id="about">About Info</a>
  <a href="#" id="Services">Services</a>
  <a href="#" id="Address">Address</a>
  <a href="#" id="Reviews">Reviews</a>
</div>

</div>

@endsection

<style>
	.col-lg-8.col-md-8.col-sm-8.col-xs-12.nw-user-detail.profiledetail {
    padding-left: 80px;
    width: 56.66%;
}
	.nw-user-detail-block{
		margin-top: 15px !important;
	}
	.direct-hire-sidebar {
    display: none;
}
.direc-right {
    padding: 0px 90px !important;
    width: 100% !important;
}
.nw-profile_block {
	margin-top: 15px !important;
}
.business-offer-main{
	background : none !important;
}
.col-lg-4.col-md-4.col-sm-4.col-xs-4.text-center {
    background: #fff !important;
    padding: 30px !important;
    border-radius: 10px !important;
    margin-left: 30px;
    box-shadow: 0px 0px 22px 0px #80808040;
}
.network_block.nw-profile_block{
  background: #efefef !important;
}

.col-lg-8.col-md-8.col-sm-8.col-xs-12.nw-user-detail.profiledetail {
    padding-left: 50px;
}

#mySidenav a {
  position: fixed;
  right: -65px;
  transition: 0.3s;
  padding: 15px;
  width: 100px;
  text-decoration: none;
  font-size: 13px;
  color: white;
  border-radius: 9px 0px 0px 9px;
  
}

#mySidenav a:hover {
  right: 0;
}

#about {
  top: 273px;
  background-color: #4CAF50;
}

#Services {
  top: 322px;
  background-color: #2196F3;
}

#Address {
  top: 371px;
  background-color: #f44336;
}

#reviews {
  top: 420px;
  background-color: #555
}
</style>