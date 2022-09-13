@extends('layouts.app')

@section('content')
<section class="breadcrumbs">
  <div class="container">
    <ul>
      <li><a href="#">HOME </a></li>
      <li><i class="fa fa-angle-right"></i> </li>
      <li>SUBMIT POST</li>
    </ul>
  </div>
</section>
<div class="profile-div">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="job_menu">
          <ul class="job_menu_list">
            <li><a href="#">Submit Post</a></li>
            <!-- <li><a href="#">resume</a></li>
            <li><a href="#">companies</a></li>
            <li><a href="#">features</a></li>
            <li><a href="#">page</a></li> -->
          </ul>
          <!-- <a href="#" class="start_topic">add new job</a></div> -->
      </div>
    </div>

    <div class="location-detail">
      <div class="container">
          <div class="location-left"></div>
      
          <div class="location-right">
          <form method="post" action="/submitQuotes">
              <p><input type="hidden" name="jobid" value="{{$qutObj['jobid']}}" /></p>
              <p><input type="hidden" name="_token" value="{{ csrf_token() }}" /></p>
              <input  name="submitquotes" value="{{ $qutObj['quote']}}" placeholder="Submit Quote"/>
              <button type="submit">Submit <i class="fa fa-angle-right" aria-hidden="true"></i></button>
          </form>
          </div>
        <div class="cont-detail"></div>
      </div>
    </div>
  </div>
</div>
@endsection
