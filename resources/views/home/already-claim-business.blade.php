@extends('layouts.business.header')
@section('content')
<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
<style>
    #suggestions {
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        border: 1px solid black;

        background-color: white;
        font-size: 12px;
    }

    .option {
        display: none;
        color: '#000';
        cursor: pointer;
        padding: 10px;
    }

    #option-box {
        font-size: 15px;
    }
</style>
<div class="claiming-section business-claimed" style="margin-top:50px">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 claiming-business-block">
                <div class="claiming-boxn">
                
                    <h3>Business has already been claimed.</h3>
                    @if(Auth::check())
                        <button class="btn btn-red" type="button" onclick="manageCompany()">Go to the Manage Page</button>
                    @else
                        <p>Someone has already completed the claiming process for this business.If this is your business,<a onclick="setsession();"> Log In</a></p>
                    @endif
                    <button class="btn btn-red ml-5" type="button" onclick="managehome()">Go to the Home Page</button>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 claiming-business-block-right">

                <p>
                    Claim your business or create a new profile today for free! Update your profile so we can showcase what you do to everyone looking for your services.
                </p>

                <img src="{{url('/public/img/claim-your-business-detail.jpg')}}" alt="Omnebook">

            </div>
        </div>
    </div>
</div>
@include('layouts.business.footer')
<script type="text/javascript">
    function manageCompany(){
        window.location.href = "/manage/company";
    }

    function managehome(){
        window.location.href = "{{route('homepage')}}";
    }
    function setsession(){
        $.ajax({
            url: "/set-session-for-managecompany/",
            type:"GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response){
                window.location.href = "/userlogin";
            },
        });
    }
</script>
@endsection
