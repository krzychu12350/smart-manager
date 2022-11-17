<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyEmployeeRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyEmployeeController extends Controller
{
    /*
 * https://laracasts.com/discuss/channels/laravel/best-practice-for-crud-updating-an-existing-belongstomany-in-api
    GET 	/api/companies/:id/employees 	retrieve all Employees  of a Company(CompanyController)
    GET 	/api/employees/:id/companies	retrieve all Companies of an Employee(EmployeeController)
    POST 	/api/companies/:id/employees 	add Employee for a Company
    PUT 	/api/companies/:id/employees 	update Employee's Company
    DELETE 	/api/companies/:id/employees 	remove Employee from  a Company

*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyEmployeeRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function store(CompanyEmployeeRequest $request, Company $company)
    {
        //dd($request['employees']);
        $employeesIds = $request->only('employees');


        $company->employees()->syncWithoutDetaching($request['employees']);

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
     * @param CompanyEmployeeRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function update(CompanyEmployeeRequest $request, Company $company)
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
     * @param CompanyEmployeeRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function destroy(CompanyEmployeeRequest $request, Company $company)
    {
        $company->employees()->detach($request['employees']);

        return response()->json([
            'status' => true,
            'message' => "Company's employees was deleted successfully"
        ], 200);
    }
}
