@extends('layouts.header')

@section('content')

  <section class="inner-banner" style="background-image:url('/public/uploads/cms/{{ $banner_image }}')">
      <div class="container">
            <h1>{{ $pageTitle }}</h1>
          </div>
  </section>
  <section class="breadcrumbs">
  <div class="container">
      <ul>
        <li><a href="/">HOME    </a></li><li><i class="fa fa-angle-right"></i>
      </li>
        <li>{{ $pageTitle }}</li>
        </ul>
    </div>
</section>
  <section class="privacy-block">

  <div class="container">
      <div class="about-title">
          <!-- <h1>{{ $pageTitle }}</h1> -->
        <div class="pagecontent">{!!html_entity_decode($content)!!}  </div>
        </div>
    </div>

  </section>
    @include('layouts.footer')
@endsection