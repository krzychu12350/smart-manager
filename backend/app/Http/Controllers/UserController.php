<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Income;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        $employees = User::query()->paginate(1);
        $employees2 = UserResource::collection(User::all());
        return response()->json([
            'status' => true,
            'employees' => $employees2
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        $employee = User::create($request->validated());
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
            'message' => "User was created successfully.",
            'employee' => new UserResource($employee)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return response()->json([
            'status' => true,
            'employee' => new UserResource($user)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
       // dd($user->id);
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
        $user->update($request->validated());


        Income::create([
            'user_id' => $user->id,
            'amount' => $request->salary
        ]);

        return response()->json([
            'status' => true,
            'message' => "User was updated successfully!",
            'employee' => new UserResource($user)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => "User was deleted successfully!",
        ], 204);
    }


}
