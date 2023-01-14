<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserToCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\UserCollection;
use App\Models\Company;
use Illuminate\Http\JsonResponse;

class CompanyEmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Company $company)
    {
        return response()->json([
            'status' => true,
            'employees' => new UserCollection($company->employees()->paginate(2))
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AddUserToCompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function store(AddUserToCompanyRequest $request, Company $company)
    {
        $company->employees()->syncWithoutDetaching($request->validated());

        return response()->json([
            'status' => true,
            'message' => "Employees was assigned to the company successfully",
            'company' => new CompanyResource($company)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AddUserToCompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function update(AddUserToCompanyRequest $request, Company $company)
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
     * @param AddUserToCompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function destroy(AddUserToCompanyRequest $request, Company $company)
    {
        $company->employees()->detach($request['employees']);

        return response()->json([], 204);
    }
}
