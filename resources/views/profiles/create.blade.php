@extends('layout')

@section('content')
@include('partials._banner')

<div class="all_centered_parent">
    <div class="all_centered_parent profile_page" style="min-width: 40%">
        <h1 style="margin-bottom: 0">Create new profile</h1>

        <form class="all_centered_parent create_form" action="/profiles" method="POST">
            @csrf
                <input name ="user_id" type="hidden" class="create_input" value="{{ auth()->user()->id }}" id="user_id" />
                

            <div class="title_with_searchbar create_form_label">
                <label for="name" >Name*</label>
                <input name ="name" type="text" class="create_input" placeholder="Example: Personal Profile" value="{{old('name')}}" id="name" />
                
                @error('name')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="email">Email*</label>
                <input name ="email" type="email"class="create_input" placeholder="Example: rmonteiro@bimms.net"  value="{{old('email')}}" id="email" required/>
                @error('email')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="imageURL">Profile avatar</label>
                <input name ="imageURL" type="file" class="create_input" value="{{old('imageURL')}}" id="imageURL"/>
                @error('imageURL')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <button type="submit" class="add_button">Create new profile!</button>
        </form>
    </div>
</div>
    


@endsection

@section('scripts')
    <script>
        const inputElement = document.querySelector('input[id="imageURL"]');
        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
            server: {
                url: '/api/upload',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
    </script>
@endsection