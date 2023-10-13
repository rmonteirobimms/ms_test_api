@extends('layout')

@section('content')
<x-form-message/>
@include('partials._banner')

<div class="all_centered_parent">
    <div class="all_centered_parent">
        <p>Assigned Tasks</p>
    </div>
    
    
    <table>
        <thead>
            <tr>
                <th class="th_title">Title</th>
                <th class="th_desc">Description</th>
                <th class="th_timestamp">Created At</th>
                <th class="th_timestamp">Updated At</th>
                <th class="th_id">Assigned By</th>
            </tr>
        </thead>
        <tbody>
            @if(count($tasks_assigned))
                @foreach($tasks_assigned as $k=>$task)
                    <tr>
                        <td>{{$task->title}}</td>
                        <td>{{$task->description}}</td>
                        <td class="centered">{{$task->created_at}}</td>
                        <td class="centered">{{$task->updated_at}}</td>
                        <td class="centered">{{$task->creator_id}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" style="text-align:center">
                        No tasks found!
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="all_centered_parent">
        <p>Tasks created</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="th_title">Title</th>
                <th class="th_desc">Description</th>
                <th class="th_timestamp">Created At</th>
                <th class="th_timestamp">Updated At</th>
                <th class="th_id">Assigned To</th>
            </tr>
        </thead>
        <tbody>
            @if(count($tasks_created))
                @foreach($tasks_created as $k=>$task)
                    <tr>
                        <td>{{$task->title}}</td>
                        <td>{{$task->description}}</td>
                        <td class="centered">{{$task->created_at}}</td>
                        <td class="centered">{{$task->updated_at}}</td>
                        <td class="centered">{{$task->assigned_to}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="centered">
                        No tasks found!
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

@endsection