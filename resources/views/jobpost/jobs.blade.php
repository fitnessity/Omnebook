@extends('layouts.profile')

@section('content')
<section class="breadcrumbs">
  <div class="container">
    <ul>
      <li><a href="#">HOME </a></li>
      <li><i class="fa fa-angle-right"></i> </li>
      <li>JOB Details</li>
    </ul>
  </div>
</section>
<div class="profile-div">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="job_menu">
          <ul class="job_menu_list">
            <li><a href="#">Job Details</a></li>
            <!-- <li><a href="#">resume</a></li>
            <li><a href="#">companies</a></li> -->
            <li><a href="#">Profile</a></li>
            <li><a href="/jobs/submit/{{$data['jobid']}}">Get Quote</a></li>
          </ul>
          </div>
      </div>
      <div class="clearfix"></div>
      <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12">
        <div class="job_block">
          <ul id="myTab_1" class="job_topic">
         
            <!-- <li class="active"><a href="#tab_1" data-toggle="tab" >USER JOBS POST</a></li> -->
            <!-- <li><a href="#tab_2" data-toggle="tab" >LATEST RESUME</a></li>
            <li><a href="#tab_3" data-toggle="tab" >companies</a></li> -->
          </ul>
          <div id="myTabContent" class="tab-content">    
             
          <div id="tab_1" class="tab-pane fade in active job_listing_block">
          <div class="job_listing">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 job_lst_dtls">
                  <div class="jb-title" style="border-bottom: medium none;">
                  <h1><b>QUOTE :</b> {{$data['quote']}}</h1>
                  </div>
                </div>
            </div>
          </div>
           @foreach( $data['jobsObj'] as $k => $job )
            <div class="job_listing">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 job_lst_dtls">
                  <div class="jb-title" style="border-bottom: medium none;">
                    <h1>{{$job['question']}}</h1>
                  <div class="job_post_dtls">
                  @if($job['full_answer'] == '')
                    <a href="#" style="cursor:default;"><i class="fa fa-edit"></i>Options : {{$job['answer']}}</a>
                  @else
                    <a href="#" style="cursor:default;"><i class="fa fa-edit"></i>Options : {{$job['full_answer']}}</a>
                  @endif

                  <a href="#" style="cursor:default;"></a> <a href="#" style="cursor:default;"><i class="fa fa-file-text-o"></i>Other : {{$job['other']}}</a> </div>
                </div>
              </div>
           
            </div>
            
          </div>
            @endforeach
          
          </div>
        </div>
      </div>
      
    </div>

    @include('includes.sidebar_profile_right')

  </div>
</div>
@endsection
