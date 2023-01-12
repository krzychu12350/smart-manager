<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyUserRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyEmployeeController extends Controller
{
    /*
 * https://laracasts.com/discuss/channels/laravel/best-practice-for-crud-updating-an-existing-belongstomany-in-api
    GET 	/api/companies/:id/employees 	retrieve all Employees  of a Company(CompanyController)
    GET 	/api/employees/:id/companies	retrieve all Companies of an User(UserController)
    POST 	/api/companies/:id/employees 	add User for a Company
    PUT 	/api/companies/:id/employees 	update User's Company
    DELETE 	/api/companies/:id/employees 	remove User from  a Company

*/
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Company $company)
    {
        return response()->json([
            'status' => true,
            //'employees' => $company->employees()->get()
            //'companies' => new CompanyCollection(Company::paginate(10))
            'employees' => new UserCollection($company->employees()->paginate(10))
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyUserRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function store(CompanyUserRequest $request, Company $company)
    {
        //dd($request['employees']);
        $employeesIds = $request->only('user');


        $company->employees()->syncWithoutDetaching($request->validated());

        return response()->json([
            'status' => true,
            'message' => "Employees was assigned to the company successfully",
            'company' => new CompanyResource($company)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyUserRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function update(CompanyUserRequest $request, Company $company)
    {
        $company->employees()->sync($request['employees']);

        return response()->json([
            'status' => true,
            'message' => "Company's employees was updated successfully",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CompanyUserRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function destroy(CompanyUserRequest $request, Company $company)
    {
        $company->employees()->detach($request['employees']);

        return response()->json([
            'status' => true,
            'message' => "Company's employees was deleted successfully"
        ], 200);
    }
}
