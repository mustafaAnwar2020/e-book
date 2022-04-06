@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">@lang('site.dashboard')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart.index') }}">@lang('site.cart')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('site.checkout')</li>
                </ol>
            </nav>
        </div>
        <div class="container">

            @if (session()->has('success_message'))
                <div class="spacer"></div>
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="spacer"></div>
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="checkout-heading stylish-heading">@lang('site.checkout')</h1>
            <div class="checkout-section">
                <div>
                    @if (!is_null($cart))
                        <form action="{{ route('checkout', $cart) }}" method="POST" id="payment-form">
                            @csrf

                            <div class="form-group">
                                <label for="email">@lang('site.email')</label>
                                @if (auth()->user())
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ auth()->user()->email }}" readonly>
                                @else
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">@lang('site.name')</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="address">@lang('site.address')</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address') }}" required>
                            </div>

                            <div class="half-form">
                                <div class="form-group">
                                    <label for="city">@lang('site.city')</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ old('city') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="province">@lang('site.province')</label>
                                    <input type="text" class="form-control" id="province" name="province"
                                        value="{{ old('province') }}" required>
                                </div>
                            </div> <!-- end half-form -->

                            <div class="half-form">
                                <div class="form-group">
                                    <label for="postalcode">@lang('site.zip')</label>
                                    <input type="text" class="form-control" id="postalcode" name="postalcode"
                                        value="{{ old('postalcode') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">@lang('site.phone')</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone') }}" required>
                                </div>
                            </div> <!-- end half-form -->

                            <div class="spacer"></div>

                            <h2>@lang('site.payment')</h2>

                            <div class="form-group">
                                <label for="name_on_card">@lang('site.credit_name')</label>
                                <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
                            </div>

                            <div class="form-group">
                                <label for="card-element">
                                    @lang('site.credit_number')
                                </label>
                                <div id="card-element">
                                    <!-- a Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <div class="spacer"></div>

                            <button type="submit" id="complete-order"
                                class="button-primary full-width">@lang('site.confirmcheckout')</button>


                        </form>

                </div>



                <div class="checkout-table-container">
                    <h2>@lang('site.yourOrder')</h2>

                    <div class="checkout-table">
                        @foreach ($cart->books as $book)
                            <div class="checkout-table-row">
                                <div class="checkout-table-row-left">

                                    <div class="checkout-item-details">
                                        <div class="checkout-table-item">{{ $book->translate()->name }}</div>
                                        <div class="checkout-table-price">{{ $book->price }}</div>
                                    </div>
                                </div> <!-- end checkout-table -->

                                <div class="checkout-table-row-right">
                                    <div class="checkout-table-quantity">{{ $book->pivot->quantity }}</div>
                                </div>
                            </div> <!-- end checkout-table-row -->
                        @endforeach

                    </div> <!-- end checkout-table -->
                    <li class="list-group-item d-flex justify-content-between">
                        <span>@lang('site.total')</span>
                        <strong>{{ $cart->total_price }}</strong>
                    </li>

                </div>
            @else
                <tr>
                    <td colspan="4">
                        <div class="alert alert-info" role="alert">
                            @lang('site.no orders')
                        </div>
                    </td>
                </tr>
                @endif

            </div> <!-- end checkout-section -->
        </div>

        <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script>
            (function() {
                // Create a Stripe client
                var stripe = Stripe('{{ env('STRIPE_KEY') }}');
                // Create an instance of Elements
                var elements = stripe.elements();
                // Custom styling can be passed to options when creating an Element.
                // (Note that this demo uses a wider set of styles than the guide below.)
                var style = {
                    base: {
                        color: '#32325d',
                        lineHeight: '18px',
                        fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                };
                // Create an instance of the card Element
                var card = elements.create('card', {
                    style: style,
                    hidePostalCode: true
                });
                // Add an instance of the card Element into the `card-element` <div>
                card.mount('#card-element');
                // Handle real-time validation errors from the card Element.
                card.addEventListener('change', function(event) {
                    var displayError = document.getElementById('card-errors');
                    if (event.error) {
                        displayError.textContent = event.error.message;
                    } else {
                        displayError.textContent = '';
                    }
                });
                // Handle form submission
                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    // Disable the submit button to prevent repeated clicks
                    document.getElementById('complete-order').disabled = true;
                    var options = {
                        name: document.getElementById('name_on_card').value,
                        address_line1: document.getElementById('address').value,
                        address_city: document.getElementById('city').value,
                        address_state: document.getElementById('province').value,
                        address_zip: document.getElementById('postalcode').value
                    }
                    stripe.createToken(card, options).then(function(result) {
                        if (result.error) {
                            // Inform the user if there was an error
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                            // Enable the submit button
                            document.getElementById('complete-order').disabled = false;
                        } else {
                            // Send the token to your server
                            stripeTokenHandler(result.token);
                        }
                    });
                });

                function stripeTokenHandler(token) {
                    // Insert the token ID into the form so it gets submitted to the server
                    var form = document.getElementById('payment-form');
                    console.log(form);
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', token.id);
                    form.appendChild(hiddenInput);
                    // Submit the form
                    form.submit();
                }


            })();
        </script>
    @endsection
