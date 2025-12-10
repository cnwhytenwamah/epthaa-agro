@extends('front-pages.layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h1 class="text-success">Order Successful ✅</h1>

    <p>Your Order has been submitted successfully.  
       We will contact you shortly.</p>

    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
        Back to Home
    </a>
</div>
@endsection
