@extends('Editor.E-layouts.index-master')

@section('content')
    <div class="bg-light p-5 rounded">
        @auth
            <h1>Editor</h1>
            <p class="lead">Only authenticated users can access this section.</p>
            <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here &raquo;</a>
        @endauth

        @guest
            <h1>Editor</h1>
            <p class="lead">Your viewing the Editor. Please log in to use the other features.</p>
        @endguest
    </div>
@endsection

