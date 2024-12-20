@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

<script src="https://js.stripe.com/v3/"></script>

	
@section('content')
    <!-- Begin page -->

    <div id="layout-wrapper">
        @include('layouts.business.business_topbar')

        <!-- ========== App Menu ========== -->
        @include('layouts.business.businesssidebar')
        <!-- Left Sidebar End -->

        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid text-center">
                    <div class="row">
                        <div class="col">
                             
                            <h1>Stripe Digital Wallet Payment</h1>
                            <form id="payment-form">
                                <div id="payment-element">
                                    <!-- Stripe Payment Element will be inserted here -->
                                </div>
                                <button id="submit">Pay</button>
                                <div id="error-message"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config('services.stripe.pkey') }}');  // Use config('services.stripe.key')

        let clientSecret = null;

        fetch("{{ route('payment.process') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",  // Ensure CSRF token is included
            },
        })
        .then((response) => response.json())
        .then((data) => {
            clientSecret = data.clientSecret;
            initializeStripeElements(clientSecret);
        })
        // .catch((error) => console.error("Error fetching clientSecret:", error));

        function initializeStripeElements(clientSecret) {
            const elements = stripe.elements({
                clientSecret: clientSecret,  // Pass clientSecret here
            });

            const paymentElement = elements.create('payment');
            paymentElement.mount('#payment-element');
        }
    </script>

    
	@include('layouts.business.footer')
    @include('layouts.business.scripts')
    
@endsection