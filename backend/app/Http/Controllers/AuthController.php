<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    /**
     * Get a JWT via given credentials.
     * @return JsonResponse
     */
    public function login(LoginUserRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }

        return response()->json(['status' => true,
            'message' => 'You have been logged in successfully',
            'authorization' => $this->respondWithToken($token),//'user' => $currentUser,
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
        return ['access_token' => $token, 'token_type' => 'bearer', 'expires_at' => $expires_at,];
    }

    /**
     * Register a User.
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $employee = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_owner' => $request->is_owner,
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
                'message' => 'You have been logged out successfully'], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry, we cannot logout'],
                500);
        }
    }

    /**
     * Refresh a token.
     * @return array
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
        $currentUser = new UserResource(Auth::user());
        return response()->json(['status' => true, 'user' => $currentUser], 200);
    }

    /**
     * Send password reset link.
     */
    public function sendPasswordResetLink(Request $request)
    {
        //dd($request);
        return $this->sendResetLinkEmail($request);
    }

    /**
     * Handle reset password
     */
    public function callResetPassword(Request $request)
    {
        return $this->reset($request);
    }

    /**
     * Get the response for a successful password reset link.
     * @param Request $request
     * @param string $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     **/
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Password reset email sent.', 'data' => $response]);
    }

    /**
     * Get the response for a failed password reset link.
     * @param Request $request
     * @param string $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     **/
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Email could not be sent to this email address.']);
    }

    /** * Reset the given user's password.
     * @param CanResetPassword $user
     * @param string $password
     * @return void
     **/
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
        event(new PasswordReset($user));
    }

    /**
     * Get the response for a successful password reset.
     * @param Request $request * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     **/
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Password reset successfully.']);
    }

    /**
     * Get the response for a failed password reset.
     * @param Request $request
     * @param string $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     **/
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Failed, Invalid Token.']);
    }
}
