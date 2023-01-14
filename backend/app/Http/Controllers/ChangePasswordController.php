<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function passwordResetProcess(UpdatePasswordRequest $request)
    {
        return $this->updatePasswordRow($request)
            ->count() > 0 ? $this->resetPassword($request) : $this->tokenNotFoundError();
    }

    // Verify if token is valid
    private function updatePasswordRow($request)
    {
        return DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ]);
    }

    // Token not found response
    private function resetPassword($request)
    {
        // find email
        $userData = User::whereEmail($request->email)->first();
        // update password
        $userData->update([
            'password' => bcrypt($request->password)
        ]);
        // remove verification data from db
        $this->updatePasswordRow($request)->delete();
        // reset password response
        return response()->json([
            'data' => 'Password has been updated.'
        ], Response::HTTP_CREATED);
    }

    // Reset passwordEither your email or token is wrong
    private function tokenNotFoundError()
    {
        return response()->json([
            'error' => '.'
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
