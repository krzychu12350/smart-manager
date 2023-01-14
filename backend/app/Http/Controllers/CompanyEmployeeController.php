<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Models\Company;
use App\Models\User;
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
     * @param Company $company
     * @param User $user
     * @return JsonResponse
     */
    /*
    public function store(AddUserToCompanyRequest $request, Company $company)
    {
        $company->employees()->syncWithoutDetaching($request->validated());

        return response()->json([
            'status' => true,
            'message' => "Employees was assigned to the company successfully",
            'company' => new CompanyResource($company)
        ], 200);
    }
    */

    /**
     * Update the specified resource in storage.
     * @param Company $company
     * @param User $user
     * @return JsonResponse
     */
    public function update(Company $company, User $user)
    {
        $company->employees()->syncWithoutDetaching($user);

        return response()->json([
            'status' => true,
            'message' => "Company's employees was updated successfully",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(Company $company, User $user)
    {
        $company->employees()->detach($user);

        return response()->json([], 204);
    }
}
