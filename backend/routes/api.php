<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PositionController;
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
Route::get('/testt',  function () {
    $array = ["data" => ['id' => 1, "name" => "John", "surname" => "Lambert"]];
    return response()->json($array, 200);
});




Route::group(['prefix' => 'auth', 'middleware' => ['cors', 'forceJSON'],], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/reset-password-request', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);
    Route::post('/change-password', [ChangePasswordController::class, 'passwordResetProcess']);
});

Route::group(['prefix' => 'auth', 'middleware' => ['auth:api', 'forceJSON']], function () {
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'userProfile']);

    //Route::post('books/{book}/ratings', 'RatingController@store');
});

Route::group(['middleware' => ['auth:api', 'admin']], function () {
    Route::get('/pdf/formmark', [PdfDownloadController::class, 'downloadPdfEmployeeMarkReport']);
    Route::post('/pdf/salary', [PdfDownloadController::class, 'downloadPdfSalaryReport']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //Route::post('books/{book}/ratings', 'RatingController@store');

});
/*
Route::apiResource('companies', CompanyController::class)
    ->only(['index', 'show']);
Route::apiResource('employees', UserController::class)
    ->only(['index', 'show']);
*/

Route::apiResource('companies', CompanyController::class);
Route::apiResource('employees', UserController::class);
Route::apiResource('positions', PositionController::class);
Route::apiResource('applications', ApplicationController::class);

Route::get('/companies/{company}/applications', [ApplicationController::class, 'getCompanyApplications']);
Route::get('/companies/{company}/employees', [CompanyEmployeeController::class, 'index']);
Route::post('/companies/{company}/employees', [CompanyEmployeeController::class, 'store']);
Route::put('/companies/{company}/employees', [CompanyEmployeeController::class, 'update']);
Route::delete('/companies/{company}/employees', [CompanyEmployeeController::class, 'destroy']);

Route::get('test', function () {

    //return Company::with('employees')->where('id', 1)->get()->groupBy('employees.position');
       // with('companies')->where('id', 1)->get();
    /*
    return User::with(['companies' => function($query) {
        $query->where('companies.id', 1)->get();
    }])->get();*/

    //return Company::find(1)->employees()->get()->groupBy('position');
    //$employees = Company::find(1)->employees()->withAvg('salaries as salary', 'salary')->get()->groupBy('position');
    //return Company::find(1)->withAvg('employees', 'salary')->groupBy('employees.position')->get();
   // return Company::find(1)->withAvg('employees', 'salary')->get()->groupBy('employees.position');

    /*
    return Company::where('id', 1)->with(['employees' => function ($row) {
       return $row->get()->groupBy('position');
    }])->get();
    */

    //$employees = User::whereRelation('companies', 'companies.id', '=', 1)->groupBy('position')->avg('salary');
    $employees = User::whereRelation('companies', 'companies.id', '=', 1)->groupBy('position')->avg('salary');

    $employees = User::whereRelation('companies', 'companies.id', '=', 1)->get()->groupBy('position');
    $valuesByGroups = $employees->map(function ($row) {
        return ['avg' => $row->avg('salary'), 'min' => $row->min('salary'), 'max' => $row->max('salary')];
    });
    return $valuesByGroups;
        //->get()->avg('salary');

    //return Company::find(1)->employees()->get()->groupBy('position');
});




/*
 * https://laracasts.com/discuss/channels/laravel/best-practice-for-crud-updating-an-existing-belongstomany-in-api
    GET 	/api/companies/:id/employees 	retrieve all Employees  of a Company
    GET 	/api/employees/:id/companies	retrieve all Companies of an User
    POST 	/api/companies/:id/employees 	add User for a Company
    PUT 	/api/companies/:id/employees 	update User's Company
    DELETE 	/api/companies/:id/employees 	remove User from  a Company

*/

