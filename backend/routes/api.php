<?php

use App\Http\Controllers\ApplicationController;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::group(['middleware' => ['cors', 'forceJSON']], function () {
    Route::apiResource('companies', CompanyController::class)->only(['store']);
    //Route::post('/companies/{company}/users', [CompanyEmployeeController::class, 'store']);
    Route::put('/companies/{company}/users/{user}', [CompanyEmployeeController::class, 'update']);
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/reset-password-request', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);
        Route::post('/change-password', [ChangePasswordController::class, 'passwordResetProcess']);
        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('/refresh', [AuthController::class, 'refresh']);
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/me', [AuthController::class, 'userProfile']);
        });
    });
    Route::middleware(['auth:api'])->group(function () {
        Route::apiResource('users', UserController::class)->only(['show']);
        Route::apiResource('companies', CompanyController::class)->only(['index']);;
        Route::apiResource('applications', ApplicationController::class)->only(['store']);
        Route::group(['middleware' => ['admin']], function () {
            Route::apiResource('users', UserController::class)->except('show');
            Route::apiResource('companies', CompanyController::class)->except(['index','store']);
            Route::apiResource('applications', ApplicationController::class)->except('store');
            Route::post('/pdf/employee-evaluation', [PdfDownloadController::class, 'downloadPdfEmployeeMarkReport']);
            Route::post('/pdf/salary', [PdfDownloadController::class, 'downloadPdfSalaryReport']);
            Route::get('/companies/{company}/applications', [ApplicationController::class, 'getCompanyApplications']);
            Route::get('/companies/{company}/users', [CompanyEmployeeController::class, 'index']);
            Route::put('/companies/{company}/users/{user}', [CompanyEmployeeController::class, 'update']);
            Route::delete('/companies/{company}/users/{user}', [CompanyEmployeeController::class, 'destroy']);
        });
    });
});

