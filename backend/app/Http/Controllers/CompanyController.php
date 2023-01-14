<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
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
            'companies' => CompanyResource::collection(Company::all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => "Company was created successfully!",
            'company' => new CompanyResource($company)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Company $company)
    {
        return response()->json([
            'status' => true,
            'company' => new CompanyResource($company)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @param Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        return response()->json([
            'status' => true,
            'message' => "Company was updated successfully!",
            'company' => new CompanyResource($company)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json([], 204);
    }
}
