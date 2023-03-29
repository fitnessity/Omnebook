@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/creditcard.css') }}">

<div class="page-wrapper inner_top" id="wrapper">

    <div class="page-container">

        <!-- Left Sidebar Start -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->

        <div class="page-content-wrapper">

            <div class="content-page">

                <div class="container-fluid">

                    <div class="page-title-box">
                        <h4 class="page-title">Payment Information</h4>
                    </div>

                    <div class="payment_info_section padding-1 white-bg border-radius1">

                        <div class="payment-info-block">

                            <div class="savecard-block">
                                
                                <?php
                                if(!empty($cardInfo)) {
                                ?>
                                    <div class="sacecard-title">Your Saved Cards</div>
                                    <?php
                                    foreach($cardInfo as $card) {
                                        $brandname = strtolower($card['brand']);
                                    ?>
                                        <div class="cards-block dispalycard" style="cursor: pointer" data-name="<?=$card['name']?>" data-cvv="" data-cnumber="<?=$card['last4']?>" data-month="<?=$card['exp_month']?>" data-year="<?=$card['exp_year']?>" data-type="{{$brandname}}" data-id="{{$card['id']}}" data-ptype="update">
                                    <div class="cards-content" style="color:#ffffff; background-image: url({{ url('public/img/visa-card-bg.jpg')}} );">
                                        <img src="{{ url('/public/images/creditcard/'.$brandname.'.jpg') }}" alt="">
                                        <span style="float:right"><?=$card['name']?></span>
                                        <p><?=ucfirst($brandname)?></p>
                                        <span>
                                            <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>{{$card['last4']}} 
                                        </span>

                                        <a style="float:right" data-behavior="delete_card" data-url="{{route('paymentdelete', ['stripe_payment_method' => $card['payment_id']])}}" data-cardid="<?=$card['id']?>" title="Delete Card" class="delCard"><i class="fa fa-trash"></i> </a>
                                    </div>
                                        </div>
                                    <?php } ?>
                                    <div class="cards-block addcard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="" data-month="" data-year="" data-type=""  data-ptype="insert">
                                        <div class="cards-content"style="height:166px; color:#ffffff;     background-image: url({{ url('public/img/visa-card-bg.jpg')}});">
                                            <span style="text-align: center">Add New Card</span>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div style="padding:50px; text-align: center; font-size:14px; color:#585858">Upload a credit card safely so you can process bookings faster.</div>
                                <?php } ?>
                            </div>

                            <div class="row" id="stripediv" style="display:none;">
                                <div class="col-md-6">
                                    @if (session('stripeErrorMsg'))
                                        <div class="col-md-12">
                                            <div class='form-row row'>
                                                <div class='col-md-12  error form-group'>
                                                    <div class="alert-danger alert">
                                                        {{ session('stripeErrorMsg') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <form action="{{route('paymentsave')}}" method="POST" class="validation" data-secret="{{$intent['client_secret']}}" id="payment-form">
                                        <div id="payment-element" style="margin-top: 8px;"></div>
                                        <button class="post-btn-red" type="submit" id="submit">Save</button>
                                    </form>
                                </div>
							</div>
							<!-- <table id="example" class="table table-striped table-bordered" style="width:100%" style="display:none;"> -->
                            <table id="historyTable" class="table table-striped table-bordered" style="width: 100%">
								<thead>
									<tr>
										<th>Sale Date</th>
										<th>Item Description</th>
										<th>Item Type</th>
										<th>Pay Method</th>
										<th>Price</th>
										<th>Qty</th>
									</tr>
								</thead>
								<tbody id="tbodydetail">
                                    @foreach($transactionDetail as $history )
                                    <tr>
                                        <td>{{date('m/d/Y',strtotime($history->created_at))}}</td>
                                        <td>{!!$history->item_description()['itemDescription']!!}</td>
                                        <td>{{$history->item_type_terms()}}</td>
                                        <td>{{$history->getPmtMethod()}}</td>
                                        <td>${{$history->amount}}</td>
                                        <td>{{$history->item_description()['qty']}}</td>
                                    </tr>
                                    @endforeach
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
<script type="text/javascript">
    const stripe = Stripe('{{ env('STRIPE_PKEY') }}');

    const options = {
        clientSecret: '{{$intent['client_secret']}}',
        appearance: {
        theme: 'flat'
        },
    };

    // Set up Stripe.js and Elements to use in checkout form, passing the client secret obtained in step 3
    const elements = stripe.elements(options);

    // Create and mount the Payment Element
    const paymentElement = elements.create('payment');
    paymentElement.mount('#payment-element');

    const form = document.getElementById('payment-form');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        $('#submit').text('loading...')

        const {error} = await stripe.confirmSetup({
        //`Elements` instance that was used to create the Payment Element
            elements,
            confirmParams: {
                return_url: '{{route("paymentsave")}}',
            }
        });

        if (error) {
          // This point will only be reached if there is an immediate error when
          // confirming the payment. Show error to your customer (for example, payment
          // details incomplete)  
          const messageContainer = document.querySelector('#error-message');
          messageContainer.textContent = error.message;
          $('#error-message').show();

        } else {
          // Your customer will be redirected to your `return_url`. For some payment
          // methods like iDEAL, your customer will be redirected to an intermediate
          // site first to authorize the payment, then redirected to the `return_url`.
        }
        $('#submit').text('Add on file')
    });
</script>

<script src="{{ url('public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('public/js/metisMenu.min.js') }}"></script>

<script src="{{ url('public/js/jquery.payform.min.js') }}" charset="utf-8"></script>

<script src="{{ url('public/js/creditcard.js') }}"></script>

<script type="text/javascript">
    
    var query_error = '<?=isset($_GET['error'])?$_GET['error']:0;?>';
    if(query_error == 1) {
        $("#card-error").html("Requested card number is already exists.");
    }

    $(document).on("click", "[data-behavior~=delete_card]", function(e){
        e.preventDefault()

        if (confirm('You are sure to delete card?')) {

            var cardid = $(this).data("cardid");
            $.ajax({
                type: 'post',
                url: $(this).data('url'),
                data: {
                    _token: '{{csrf_token()}}',
                    cardid:cardid
                },
                success: function(data) {

                   /* alert("Card removed successfully.");*/
                    location.reload();
                }
            });
        } else {
            //alert('Why did you press cancel? You should have confirmed');
        }
    });
    
    $(".dispalycard").on("click", function(){
        $('#stripediv').css('display','none');
        /*$('#historyTable').css('display','inline-table');
        var pid = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: '{{route("card_purchase_history")}}',
            data: {
                _token: '{{csrf_token()}}',
                pid: pid
            },
            success: function(data) {
                $('#tbodydetail').html(data);
            }
        });*/
    });

    $(".addcard").on("click", function(){
        $('#stripediv').css('display','block');
       /* $('#historyTable').css('display','none');*/
    });

    /* $(".delCard").on("click", function(){
        $("#owner").val("");
        $("#cvv").val("");
        $("#cardNumber").val("");
        $("#card-error").html("");
        $("#card_month option:selected").text("Mon");
        $("#card_year option:selected").text("Year");
        $("#card_month").val("");
        $("#card_year").val("");
        if (confirm('You are sure to delete card?')) {
            var _token = $("input[name='_token']").val();
            var cardid = $(this).data("cardid");
            $.ajax({
                type: 'POST',
                url: '{{route("paymentdelete")}}',
                data: {
                    _token: _token,
                    cardid: cardid
                },
                success: function(data) {
                    // alert("Card removed successfully.");
                    window.location.reload();
                }
            });
        } else {
            //alert('Why did you press cancel? You should have confirmed');
        }
    });*/
    
    /*$(".cards-block").on("click", function(){
        // alert($(this).data('type'));
        $("#card-error").html('');
        $("#payment_type").val($(this).data('ptype'));
        $("#owner").val($(this).data('name'));
        if($(this).data('month') != "") {
            $("#card_month option:selected").text(chkmonth($(this).data('month')));
            $("#card_year option:selected").text($(this).data('year'));
            $("#cardNumber").val('************'+$(this).data('cnumber'));
            $("#cvv").val('***');
            $("#confirm-purchase").attr('disabled', true);
        } else {
            $("#card_month option:selected").text("Mon");
            $("#card_year option:selected").text("Year");
            $("#cardNumber").val($(this).data('cnumber'));
            $("#cvv").val($(this).data('cvv'));
            $("#confirm-purchase").attr('disabled', false);
        }
        // $("#card_month option:selected").val($(this).data('month'));
        $("#card_type").val($(this).data('type'));
        $("#credit_cards img").addClass('transparent');
        $("#"+$(this).data('type')).removeClass('transparent');
    });*/

    function chkmonth(id) {
        if(id==1)return "Jan";
        if(id==2)return "Feb";
        if(id==3)return "Mar";
        if(id==4)return "Apr";
        if(id==5)return "May";
        if(id==6)return "Jun";
        if(id==7)return "Jul";
        if(id==8)return "Aug";
        if(id==9)return "Sep";
        if(id==10)return "Oct";
        if(id==11)return "Nov";
        if(id==12)return "Dec";
    }
</script>
@endsection