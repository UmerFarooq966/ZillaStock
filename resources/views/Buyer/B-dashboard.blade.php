@extends('Buyer.B-layouts.index-master')


@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            <h1>User Dashboard</h1>
            <p class="lead">Only authenticated users can access this section.</p>
        <!-- <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here &raquo;</a>
        -->
        @endauth

        @guest
            <h1>User Dashboard</h1>
            <p class="lead">Your viewing the home page. Please log in to view the restricted data.</p>
        @endguest
    </div>
@endsection

