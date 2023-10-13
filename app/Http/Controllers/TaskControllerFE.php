<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Profile;
use Illuminate\Http\Request;

class TaskControllerFE extends Controller
{
    // Show all profiles
    public function index(Request $request)
    {
        $profile = Profile::find($request->profile_id);

        if (!$profile || auth()->user()->id != $profile->user_id) {
            return view('profiles.index', [
                'profiles' => Profile::where('user_id', auth()->user()->id)->get()
            ]);
        }

        $tasks_assigned = Task::where('assigned_to', $request->profile_id)->get();
        $tasks_created = Task::where('creator_id', $request->profile_id)->get();

        return view('tasks.index', [
            'tasks_assigned' => $tasks_assigned,
            'tasks_created' => $tasks_created
        ]);
    }

    // Show single task
    public function show(Task $task)
    {
        return view('profiles.show', [
            'task' => $task
        ]);
    }


    // Delete task
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('profiles')
            ->with('message', 'task deleted successfully!');
    }
}
