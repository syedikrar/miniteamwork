<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskStoreRequest;
use App\Services\TaskService;
use App\Models\Task;
class TaskController extends Controller
{
  /**
       * @OA\POST(
       *      path="/api/task/store",
       *      operationId="createTask",
       *      tags={"createTask"},
       *      summary="Create Task",
       *      description="Register new Task",
       *   @OA\Parameter(
       *      name="name",
       *      in="query",
       *      required=true,
       *      @OA\Schema(
       *           type="string"
       *      )
       *   ),
       *   @OA\Parameter(
       *      name="description",
       *      in="query",
       *      required=true,
       *      @OA\Schema(
       *          type="string"
       *      )
       *   ),
       *   @OA\Parameter(
       *      name="completed_flag",
       *      in="query",
       *      required=true,
       *      @OA\Schema(
       *          type="string"
       *      )
       *   ),
       *      @OA\Response(
       *          response=200,
       *          description="Successful operation",
       *       ),
       *      @OA\Response(
       *          response=401,
       *          description="Unauthenticated",
       *      ),
       *      @OA\Response(
       *          response=403,
       *          description="Forbidden"
       *      )
       *     )
       */
    public function store(TaskStoreRequest $request)
    {
      $task = (new TaskService())->store($request);
      return response([ 'task' => $task, 'message' => 'save successfully'], 200);
    }

    /**
     * @OA\Get(
     *      path="/api/task/get/{id}",
     *      operationId="get task",
     *      tags={"getTask"},
     *      summary="Get task",
     *      description="Returns task",
     *      security={ {"sanctum": {} }},
     *      @OA\Parameter(
     *          name="id",
     *          description="task id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function getTask($id)
    {
      $task = (new TaskService())->getTask($id);

      $response = [
        'details' => $task,
        'message' => 'ok'
      ];
      return response()->json($response);
    }
    /**
     * @OA\Get(
     *      path="/api/task/get/all",
     *      operationId="getTasksList",
     *      tags={"getTasks"},
     *      summary="Get list of task",
     *      description="Returns list of tasks",
     *      security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function allTasks()
    {
      $tasks = (new TaskService())->allTasks();

      return response([ 'task' => $tasks], 200);
    }
    /**
     * @OA\Delete(
     *      path="/api/task/delete/{id}",
     *      operationId="deleteTask",
     *      tags={"deleteTask"},
     *      summary="Delete existing task",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="task id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function deleteTask($id)
    {
      $task = (new TaskService())->destroy($id);

      $response = [
        'details' => $task,
        'message' => 'task is deleted Successfully'
      ];
      return response()->json($response);
    }
    /**
         * @OA\PUT(
         *      path="/api/task/update/{id}",
         *      operationId="updateTask",
         *      tags={"updateTask"},
         *      summary="Create Task",
         *      description="update task",
         *   @OA\Parameter(
         *          name="id",
         *          description="task id",
         *          required=true,
         *          in="path",
         *          @OA\Schema(
         *              type="integer"
         *          )
         *      ),
         *   @OA\Parameter(
         *      name="name",
         *      in="query",
         *      required=true,
         *      @OA\Schema(
         *           type="string"
         *      )
         *   ),
         *   @OA\Parameter(
         *      name="description",
         *      in="query",
         *      required=true,
         *      @OA\Schema(
         *          type="string"
         *      )
         *   ),
         *   @OA\Parameter(
         *      name="completed_flag",
         *      in="query",
         *      required=true,
         *      @OA\Schema(
         *          type="string"
         *      )
         *   ),
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *
         *       ),
         *      @OA\Response(
         *          response=401,
         *          description="Unauthenticated",
         *      ),
         *      @OA\Response(
         *          response=403,
         *          description="Forbidden"
         *      )
         *     )
         */
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
