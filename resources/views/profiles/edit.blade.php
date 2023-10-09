@extends('layout')

@section('content')
@include('partials._banner')

<div class="all_centered_parent">
    <div class="all_centered_parent project_page" style="min-width: 40%">
        <h1 style="margin-bottom: 0">Edit project</h1>
        <p style="font-size: smaller;">Edit «{{$project->name}}»</p>

        <form class="all_centered_parent create_form" action="/projects/{{$project->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="title_with_searchbar create_form_label">
                <label for="name" >Name*</label>
                <input name ="name" type="text" pattern="[A-Za-z ]+" class="create_input" placeholder="Example: Empire State Bulding" value="{{$project->name}}" id="name" />
                
                @error('name')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="city">City*</label>
                <input name ="city" type="text" pattern="[A-Za-z ]+" class="create_input" placeholder="Example: New York" id="city" value="{{$project->city}}" required/>
                @error('city')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="country">Country*</label>
                <input name ="country" type="text" pattern="[A-Za-z ]+" class="create_input" placeholder="Example: United States of America"  value="{{$project->country}}" id="country" required/>
                @error('country')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="imageURL">Image URL</label>
                <input name ="imageURL" type="url"  class="create_input"  value="{{$project->imageURL}}" id="imageURL"/>
                @error('imageURL')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label">
                <label for="description">Description*</label>
                <textarea name ="description" class="create_input create_textarea" id="description"  placeholder="Include some of it's history, purpose and facts" required>{{$project->description}}</textarea>
                @error('description')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <div class="title_with_searchbar create_form_label" style="min-width: 70%;">
                <label for="type">Type of Project*</label>
                <select name ="type" class="create_input" id="type">
                    <option <?php if($project->type == "Subway Station") echo "selected";?>>Subway Station</option>
                    <option <?php if($project->type == "Building") echo "selected";?>>Building</option>
                    <option <?php if($project->type == "Data Center") echo "selected";?>>Data Center</option>
                    <?php if($project->type == "Other") echo "<option selected disabled>Other</option>";?>
                </select>
                @error('type')
                    <p class="small_p_error">{{$message}}</p>
                @enderror
            </div>

            <button type="submit" class="add_button">Create new project!</button>
        </form>
    </div>
</div>

@endsection