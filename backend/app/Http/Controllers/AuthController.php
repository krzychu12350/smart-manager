<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        /*
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Inputs',
                'error' => $validator->errors()
            ], 422);
        }

        if (!$token = auth('api')->attempt($validator->validated())) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email or password',
            ], 400);
        }*/

        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        //return $this->respondWithToken($token);
        $currentUser = Auth::user();
        return response()->json([
            'status' => true,
            'message' => 'You have been logged in successfully',
            'authorization' => $this->respondWithToken($token),
            //'user' => $currentUser,
        ], 200);
    }

    /**
     * Get the token array structure.
     * @param string $token
     * @return array
     */
    protected function respondWithToken($token)
    {
        $minutes = auth('api')->factory()->getTTL() * 60;
        $timestamp = now()->addMinute($minutes);
        $expires_at = date('M d, Y H:i A', strtotime($timestamp));
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_at' => $expires_at,
        ];
    }

    /**
     * Register a User.
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        /*
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid inputs',
                'error' => $validator->errors()
            ], 401);
        }

        */
        //dd($request->all());

        $employee = Employee::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'You have been successfully registered',
            'employee' => $employee
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            auth('api')->logout();
            return response()->json([
                'status' => true,
                'message' => 'You have been logged out successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry, we cannot logout'
            ], 500);
        }
    }

    /**
     * Refresh a token.
     * @return JsonResponse
     */
    public function refresh(Request $request)
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function userProfile()
    {
        $currentUser = Auth::user();
        return response()->json([
            'status' => true,
            'user' => $currentUser
        ], 200);
    }
}
