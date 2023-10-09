@extends('layout')

@section('content')
@include('partials._banner')

<div class="all_centered_parent">
    <div class="all_centered_parent project_page" style="min-width: 40%">
        <h1 style="margin-bottom: 0">Create a new account!</h1>

        <form class="all_centered_parent create_form" action="/register" method="POST">
            @csrf
            <div class="title_with_searchbar create_form_label">
                <label for="first_name" >First name*</label>
                <input name ="first_name" type="text" class="create_input" placeholder="Example: Ricardo" value="{{old('first_name')}}" id="first_name" required/>
                
                @error('first_name')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="last_name" >Last name*</label>
                <input name ="last_name" type="text" class="create_input" placeholder="Example: Monteiro" value="{{old('last_name')}}" id="last_name" required/>
                
                @error('last_name')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="username">Username*</label>
                <input name ="username" type="text" class="create_input" placeholder="Example: rmonteiro" id="username" value="{{old('username')}}" required/>
                @error('username')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="password">Password*</label>
                <input name ="password" type="password" class="create_input" value="{{old('password')}}" id="password" required/>
                @error('password')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="password_confirmation">Re-type your password*</label>
                <input name ="password_confirmation" type="password" class="create_input" value="{{old('r-password')}}" id="password_confirmation" required/>
                @error('password_confirmation')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>
            
            <button type="submit" class="add_button">Register</button>
            <a style="color:black" href="/login">Already have account? Login <strong>here</strong></a>
        </form>
    </div>
    
    
</div>

@endsection