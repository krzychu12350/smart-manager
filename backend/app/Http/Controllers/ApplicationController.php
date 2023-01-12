<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Http\Resources\ApplicationCollection;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Models\Company;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompanyApplications(Company $company): \Illuminate\Http\JsonResponse
    {
        // dd($company->id);
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
            'message' => "Application was created successfully!",
            'application' => new ApplicationResource($application)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Application $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
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

        $company = Company::findOrFail($application->company_id);
        //dd($application);
        $company->employees()->syncWithoutDetaching($application->user_id);
        //$application->delete();

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
