<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Resources\ApplicationCollection;
use App\Http\Resources\CompanyCollection;
use App\Models\User;
use Illuminate\Http\Request;
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
        //$comapnies = Company::with('employees')->paginate(1);
        return response()->json([
            'status' => true,
            //'companies' => new CompanyCollection(Company::paginate(10))
            'companies' => CompanyResource::collection(Company::all())
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());
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
            'message' => "Company was created successfully!",
            'company' =>  new CompanyResource($company)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
        // check if currently authenticated user is the owner of the book
        /*
        if ($request->user()->id !== $book->user_id) {
            return response()->json(['error' => 'You can only edit your own books.'], 403);
        }


        $company->update($request->only([
            'name',
            'city',
            'industry',
            'description',
        ]));
        */
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
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json([
            'status' => true,
            'message' => "Company was deleted successfully!",
        ], 200);
        //or 204 status
    }

}
