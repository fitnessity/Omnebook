@extends('layouts.header')
@section('content')

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
<!--<div class="claiming-section business-claimed claimyour-business" style="background-image: url(../img/claim-a-business-design.jpg);">-->
<div class="claiming-section claimyour-business" style="background-image: url(/public/img/claim-a-business-design.jpg);">
    <div class="container">

        <div class="col-md-6 claiming-business-block">
            <div class="claiming-boxn claim-text">
                <h5>Welcome back!</h5>
				
                <p>Looks like you already started to claim a business. Continue?</p>
                <p>You can finish the claim process for {{$cname}} now. <br>
					To get access to update the business information, connect with customers, to respond to reviews, showcase services and prices and network with others, you must complete the claim process.</p>
				<div class="claiming-boxn claim-box-wp">
					<div class="claim-img">
						<img src="https://development.fitnessity.co/public/img/business-icon-wp.png" alt="Yoga">
					</div>
					<div class="business-name">
						<h3>PROFILE IS UNCLAIMED</h3>
						<p class="title-bs">{{$cname}}</p>
						<p class="address-bs">{{$address}}</p>
					</div>
				</div>

                <a class="btn btn-red" id="btnclaim"  style="width: 170px;" onclick="unsetsession({{$cid}});">Finish Claiming</a> 
                <a href="/claim-your-business" class="btn btn-red" id="btnedit" value="Edit" style="width: 170px;">Claim another business</a>
            </div>
        </div>
		<div class="col-md-6 claiming-business-block-right">

            <p>
                Claim your business or create a new profile today for free! Update your profile so we can showcase what you do to everyone looking for your services.
            </p>

            <img src="https://development.fitnessity.co/public/img/claim-your-business-detail.jpg">

        </div>
    </div>

</div>
@include('layouts.footer')

<script>

    function unsetsession(cid){
        $.ajax({
            url: "/unset-session-for-claim",
            type:"GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(response){
                window.location.href = "/claim-your-business-detail"+"/"+cid;
            },
        });
    }


</script>


@endsection
