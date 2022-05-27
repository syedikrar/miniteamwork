<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskStoreRequest;
use App\Services\TaskService;
use App\Models\Task;
class TaskController extends Controller
{
    public function store(TaskStoreRequest $request)
    {
      $task = (new TaskService())->store($request);
      return response([ 'task' => $task, 'message' => 'Register successfully'], 200);
    }

    public function getTask($id)
    {
      $task = (new TaskService())->getTask($id);

      $response = [
        'details' => $task,
        'message' => 'ok'
      ];
      return response()->json($response);
    }

    public function allTasks()
    {
      $tasks = (new TaskService())->allTasks();

      $response = [
        'details' => $tasks,
        'message' => 'ok'
      ];
      return response()->json($response);
    }

    public function deleteTask($id)
    {
      $task = (new TaskService())->destroy($id);

      $response = [
        'details' => $task,
        'message' => 'task is deleted Successfully'
      ];
      return response()->json($response);
    }

    public function updateTask(Request $request, $id)
    {
      $task = (new TaskService())->updateTask($request, $id);

      $response = [
        'details' => $task,
        'message' => 'task is updated Successfully'
      ];
      return response()->json($response);
    }
}
