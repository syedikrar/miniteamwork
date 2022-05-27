<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;

class AuthController extends Controller
{
    use ApiResponser;

    /**
         * @OA\POST(
         *      path="/api/auth/register",
         *      operationId="createuser",
         *      tags={"createuser"},
         *      summary="Create User",
         *      description="Register new user",
         *   @OA\Parameter(
         *      name="first_name",
         *      in="query",
         *      required=true,
         *      @OA\Schema(
         *           type="string"
         *      )
         *   ),
         *   @OA\Parameter(
         *      name="last_name",
         *      in="query",
         *      required=true,
         *      @OA\Schema(
         *          type="string"
         *      )
         *   ),
         *   @OA\Parameter(
         *      name="email",
         *      in="query",
         *      required=true,
         *      @OA\Schema(
         *          type="string"
         *      )
         *   ),
         *   @OA\Parameter(
         *      name="password",
         *      in="query",
         *      required=true,
         *      @OA\Schema(
         *          type="string"
         *      )
         *   ),
         *   @OA\Parameter(
         *      name="password_confirmation",
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
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:55',
            'last_name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        return response([ 'user' => $user, 'token' => $user->createToken('API Token')->plainTextToken, 'message' => 'Register successfully'], 201);
    }

    /**
         * @OA\POST(
         *      path="/api/auth/login",
         *      operationId="userLogin",
         *      tags={"userLogin"},
         *      summary="Login user",
         *      description="Login user",
         *   @OA\Parameter(
         *      name="email",
         *      in="query",
         *      required=true,
         *      @OA\Schema(
         *          type="string"
         *      )
         *   ),
         *   @OA\Parameter(
         *      name="password",
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
    public function login(Request $request)
    {
      $loginData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials']);
        }
        // $user = User::where
        // $token = auth()->user()->createToken('authToken')->accessToken;

        return response([ 'user' => auth()->user(), 'token' => auth()->user()->createToken('API Token')->plainTextToken, 'message' => 'Register successfully'], 200);

        // $attr = $request->validate([
        //     'email' => 'required|string|email|',
        //     'password' => 'required|string|min:6'
        // ]);
        //
        // if (!Auth::attempt($attr)) {
        //     return $this->error('Credentials not match', 401);
        // }
        //
        // return $this->success([
        //     'token' => auth()->user()->createToken('API Token')->plainTextToken
        // ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
    /**
     * @OA\Get(
     *      path="/api/auth/getUsers",
     *      operationId="getUsersList",
     *      tags={"getUsers"},
     *      summary="Get list of users",
     *      description="Returns list of users",
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
    public function getUsers()
    {
      $users = (new UserService())->getUsers();

      $response = [
        'details' => $users
      ];
      return response()->json($response);

    }
}
