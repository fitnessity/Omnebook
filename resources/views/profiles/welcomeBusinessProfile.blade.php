@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        
        @include('profiles.businessLeftNavigation')

        <div class="col-md-10">
         
                <form method="post" action="{{route('createNewBusinessProfile')}}">
                    @csrf
                    <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                    <div class="container-fluid p-0" id="comp-info">
                        <div class="tab-hed">Create Your Business Profile</div>
                        <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                        <section class="row">
                            <div class="col-md-12 text-center">
                                <h1 class="tab-hed">Welcome To Omnebook For Business Profile Setup</h1>
                            </div>
                            <div class="col-md-12 text-center">
                                <div class="tab-para">Ready To Start Earning More ? </div>
                                <br>
                                <p class="tab-para1">Omnebook was designed to make the world of fitness accessible from one platform.<br> We connect customer swith trainers to coaches, classes to therapists, adventures & tours.</p>
                                <p class="tab-para1">Offer your services online, at your place of business or on location</p>
                                <p class="tab-para1">Add your business information, images, videos, services, prices, get verified by completed a background check, start getting reviews,<br>
                                    manage your customers and accounts and much more. Start receiving bookings from customers looking for activites and services your offer.</p>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <button type="button" class="btn-bck"><i class="fa fa-arrow-left"></i> Back</button> -->
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn-nxt" id="next-btn">Continue <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                                <br />
                            </div>
                        </section>
                    </div>
                </form>

        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
