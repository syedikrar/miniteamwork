<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    public function getUsers()
    {
      $users = (new UserService())->getUsers();

      $response = [
        'details' => $users
      ];
      return response()->json($response);
    }
    /**
     * @OA\Delete(
     *      path="/api/user/delete/{id}",
     *      operationId="deleteUser",
     *      tags={"user"},
     *      summary="Delete existing user",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="user id",
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
    public function deleteUser($id)
    {
      $user = (new UserService())->deleteUser($id);
      $response = [
        'details' => $user,
        'message' => 'User is deleted Successfully'
      ];
      return response()->json($response);
    }
}
