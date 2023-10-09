@extends('layout')

@section('content')
@include('partials._banner')

<div class="all_centered_parent">
    

    <div class="all_centered_parent project_page" style="min-width: 40%">
        <h1 style="margin-bottom: 0">Login</h1>

        <form class="all_centered_parent create_form" action="/login" method="POST">
            @csrf

            <div class="title_with_searchbar create_form_label">
                <label for="username">User</label>
                <input name ="username" type="text" class="create_input" placeholder="Example: email@bimms.net" id="username" value="{{old('email')}}" required/>
                @error('email')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="password">Password</label>
                <input name ="password" type="password" class="create_input" value="{{old('password')}}" id="password" required/>
                @error('password')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>
            
            <button type="submit" class="add_button">Login</button>
            <a style="color:black" href="/register">Don't have and account? Sign up <strong>here</strong></a>
        </form>
    </div>
    
</div>

@endsection