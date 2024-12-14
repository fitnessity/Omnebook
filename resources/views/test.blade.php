@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')

<script src="https://js.stripe.com/v3/"></script>

    <form id="payment-form" style="margin-top:12%;">
        <button id="pay-button" type="button">Pay $50</button>
    </form>

    <script>
        const stripe = Stripe('{{ env('STRIPE_PKEY') }}'); 

        $('#pay-button').on('click', function () {
            $.ajax({
                url: '{{ route('create-checkout-session') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                },
                success: function (response) {
                    if (response.id) {
                        stripe.redirectToCheckout({ sessionId: response.id })
                            .then(function (result) {
                                if (result.error) {
                                    console.error('Error redirecting to checkout:', result.error.message);
                                }
                            });
                    } else {
                        console.error('Unexpected response from server:', response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', error);
                },
            });
        });
    </script>
    {{-- @include('layouts.business.footer') --}}
    @include('layouts.business.scripts')
@endsection