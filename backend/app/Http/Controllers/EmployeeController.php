<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        return response()->json([
            'status' => true,
            'employees' => EmployeeResource::collection(Employee::with('companies')->get())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());
        /*
        $company = Company::create([
            'name' => $request->name,
            'city' => $request->city,
            'industry' => $request->industry,
            'description' => $request->description,
        ]);
        */

        return response()->json([
            'status' => true,
            'message' => "Employee was created successfully.",
            'post' => new EmployeeResource($employee)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Employee $employee)
    {
        return response()->json([
            'status' => true,
            'employee' => new EmployeeResource($employee)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        /*
        $employee->update($request->only([
            "name',
            'surname',
            'position',
            'salary",
            'email',
            'is_admin'
        ]));
        */
        //dd($request->validated());
        $employee->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => "Employee was updated successfully!",
            'employee' => new EmployeeResource($employee)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return response()->json([
            'status' => true,
            'message' => "Employee was deleted successfully!",
        ], 204);
    }


}
