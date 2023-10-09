@extends('layout')

@section('content')

<div class="all_centered_parent">
    
    <x-back-button />

    @if(isset($project))
        <section class="all_centered_parent project_page">
            <div class="all_centered_parent m-width-60 "> 
                <h1>{{ $project->name }}</h1>

                <img class="image-with-border-radius show_image"  src="{{ $project->imageURL }}">

                <div class = "location_card" style="justify-content: center">
                    <span>📌</span>
                    <p class = "bold underline">{{ $project->city .', '. $project->country}} </p>
                </div>

                

                <p class="justify-text">{{  $project->description }}</p>

                <x-tags :all_tags="$project->tags" :category="'projects'" />
            </div>
        </section>

        <div class="control_buttons">
            @if(auth()->id() == $project->user_id || auth()->user()->permission_level()>=2)

                <x-edit-button :category="'projects'" :id="$project->id" :text="'Edit project'"/>
                
                @if(auth()->id() == $project->user_id || auth()->user()->permission_level()>=3)
                    <form method = "POST" action="/projects/{{$project->id}}" class="control_buttons">
                        @csrf
                        @method('DELETE')
                        <x-delete-button :category="'projects'" :id="$project->id" :text="'Delete project'"/> 
                    </form>
                @endif
            @endif
        </div>
    @else
        <p>No project found with that ID!</p>
    @endif
    
</div>

@endsection
