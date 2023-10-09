@extends('layout')

@section('content')
<x-form-message/>
@include('partials._banner')

<div class="all_centered_parent">
    <div class="all_centered_parent">
        <h1><a class="no_decoration_link" href="/profiles">Profile</a></h1>
        <p>Choose your profile</p>
    </div>
    
    
    <div class="three_cards_row">

    @if(count($profiles))
    
        @foreach($profiles as $k=>$profile)
            <x-profile-card :profile="$profile" />
        @endforeach
    @endif

    <button class="add_button"><a class ="no_underline" style="color:white" href="/profiles/create"><i class="fa-solid fa-plus"></i> </a></button>
    </div>
</div>

@endsection