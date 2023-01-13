<?php

use App\Http\Controllers\ApplicationController;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfDownloadController;
use App\Http\Controllers\CompanyEmployeeController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\PasswordResetRequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix' => 'auth', 'middleware' => ['cors', 'forceJSON'],], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/reset-password-request', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);
    Route::post('/change-password', [ChangePasswordController::class, 'passwordResetProcess']);
});

Route::group(['prefix' => 'auth','middleware' => ['auth', 'forceJSON']], function () {

    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'userProfile']);

});

Route::group(['middleware' => ['auth:api', 'forceJSON']], function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('companies', CompanyController::class);

});

Route::group(['middleware' => ['auth:api', 'admin', 'forceJSON']], function () {
    Route::post('/pdf/employee-evaluation', [PdfDownloadController::class, 'downloadPdfEmployeeMarkReport']);
    Route::post('/pdf/salary', [PdfDownloadController::class, 'downloadPdfSalaryReport']);

    // show only for common user
    //Route::apiResource('users', UserController::class);
    //Route::apiResource('companies', CompanyController::class);

    Route::apiResource('applications', ApplicationController::class);
    Route::get('/companies/{company}/applications', [ApplicationController::class, 'getCompanyApplications']);
    Route::get('/companies/{company}/users', [CompanyEmployeeController::class, 'index']);
    Route::post('/companies/{company}/users', [CompanyEmployeeController::class, 'store']);
    Route::put('/companies/{company}/users', [CompanyEmployeeController::class, 'update']);
    Route::delete('/companies/{company}/users', [CompanyEmployeeController::class, 'destroy']);



});





