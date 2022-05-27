<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
class TaskService
{
    public function store($request)
    {
      $task = Task::create([
        'name' => $request->name,
        'description' => $request->description,
        'completed_flag' => $request->completed_flag
      ]);

      // $task->users()->attach($task->id);
      return $task;
    }

    public function getTask($id)
    {
      return Task::find($id);
    }

    public function allTasks()
    {
      return Task::with('users')->get();
    }

    public function destroy($id)
    {
      return Task::find($id)->delete();
    }

    public function updateTask(Request $request, $id)
    {
      return Task::find($id)->update([
        'name' => $request['name'],
        'description' => $request['description'],
        'completed_flag' => $request['completed_flag']
      ]);
    }

}
