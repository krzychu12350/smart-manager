<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Resources\ApplicationCollection;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Models\Company;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $applications = Application::all()->paginate(2);

        return response()->json([
            'status' => true,
            'applications' => new ApplicationCollection($applications)
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanyApplications(Company $company): \Illuminate\Http\JsonResponse
    {
        $applications = Application::where('company_id', $company->id)->get();

        return response()->json([
            'status' => true,
            'applications' => ApplicationResource::collection($applications)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreApplicationRequest $request)
    {
        $application = Application::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => "Application was created successfully!",
            'application' => new ApplicationResource($application)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        $application->update($request->validated());
        if ($request->status == "accepted") {
            $company = Company::findOrFail($application->company_id);
            $company->employees()->syncWithoutDetaching($application->user_id);
        }

        return response()->json([
            'status' => true,
            'message' => "Application was updated successfully!",
            'employee' => new ApplicationResource($application)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return response()->json([], 204);
    }
}
