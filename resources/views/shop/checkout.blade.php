@extends('layouts.app')

@section('title')
Laravel Shopping Cart
@endsection

@section('styles')
<link rel="stylesheet" href="{{ URL::to('css/checkout.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-8 col-md-5 col-md-offset-4 col-sm-offset-3">
        <h1>Checkout</h1>
        <h4>Your Total: ${{ $total }}</h4>
        <script src="https://js.stripe.com/v3/"></script>

        <form action="{{route('checkout')}}" method="post" id="payment-form">
            @csrf

            <div class="form-group">
                <label for="name">
                  Name
                </label>
                <input id="name" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="address">
                  Address
                </label>
                <input id="address" class="form-control" name="address" required>
            </div>

            <div class="form-row">
                <label for="card-element">
                Credit or debit card
                </label>
                <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
                </div><br>

                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
            </div>
            <br>
            <button class="btn btn-primary">Submit Payment</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ URL::to('js/checkout.js') }}"></script>
@endsection
