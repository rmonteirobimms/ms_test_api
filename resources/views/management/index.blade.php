@extends('layout')

@section('content')
<x-form-message/>
@include('partials._banner')

<div class="all_centered_parent">

    <h1>Project management for «{{auth()->user()->name}}»</h1>
    <table class="management_table">
        <thead>
            <tr class="table_header">
                @php
                    $headers = array_keys($projects->first()->toArray());
                @endphp
                @foreach($headers as $header)
                    <th class="t-align-center">{{$header}}</th>
                @endforeach
                <th class="t-align-center">Edit</th>
                <th class="t-align-center">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $key=>$project)
                <tr>
                    @foreach($headers as $header)
                        <td>{{$project[$header]}}</td>
                    @endforeach
                    <td class="t-align-center"><a href="/projects/{{$project->id}}/edit"><i class="fa-solid fa-pen"></i></a></td>
                    <td class="t-align-center"><form action="/projects/{{$project->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button><i class="fa-solid fa-trash"></i></button>
                    </form></td>
                </tr>
                
            @endforeach
        </tbody>
    </table>

    {{$projects->links()}}

</div>

@endsection