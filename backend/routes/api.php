<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PdfDownloadController;
use App\Http\Controllers\CompanyEmployeeController;

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
Route::get('/testt',  function () {
    $array = ["data" => ['id' => 1, "name" => "John", "surname" => "Lambert"]];
    return response()->json($array, 200);
});


Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['prefix' => 'auth', 'middleware' => ['auth:api']], function () {
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //Route::post('books/{book}/ratings', 'RatingController@store');
});

Route::apiResource('employees', EmployeeController::class);
Route::apiResource('companies', CompanyController::class);

Route::get('/pdf', [PdfDownloadController::class, 'index']);

Route::post('/companies/{company}/employees', [CompanyEmployeeController::class, 'store']);
Route::put('/companies/{company}/employees', [CompanyEmployeeController::class, 'update']);
Route::delete('/companies/{company}/employees', [CompanyEmployeeController::class, 'destroy']);
/*
 * https://laracasts.com/discuss/channels/laravel/best-practice-for-crud-updating-an-existing-belongstomany-in-api
    GET 	/api/companies/:id/employees 	retrieve all Employees  of a Company
    GET 	/api/employees/:id/companies	retrieve all Companies of an Employee
    POST 	/api/companies/:id/employees 	add Employee for a Company
    PUT 	/api/companies/:id/employees 	update Employee's Company
    DELETE 	/api/companies/:id/employees 	remove Employee from  a Company

*/

