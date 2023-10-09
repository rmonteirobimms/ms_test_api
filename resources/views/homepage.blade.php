@extends('layout')

@section('content')
<x-form-message/>
@include('partials._banner')


<div class="all_centered_parent">
    @auth
        <script type="text/javascript">
            window.location = "{{ url('/profiles') }}";//here double curly bracket
        </script>
    @else
        <h1>Welcome to MS4AECO</h1>
        <p>Please login to continue</p>
        <button><a href="/login">Login</a></button>
    @endauth
    
</div>

@endsection