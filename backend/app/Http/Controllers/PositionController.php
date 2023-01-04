<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Http\Resources\PositionCollection;
use App\Http\Resources\PositionResource;
use App\Models\Company;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'status' => true,
            'positions' => new PositionCollection(Position::paginate(8))
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePositionRequest $request)
    {
        $position = Position::create($request->validated());
        //dd($request->company_id);
        //$company = Company::where('id',$request->company_id)->get();
        //$company->positions()->syncWithoutDetaching($request->company_id);
        $position->companies()->syncWithoutDetaching($request->company_id);
        return response()->json([
            'status' => true,
            'message' => "Position was created successfully.",
            'post' => new PositionResource($position)
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $position->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => "Position was updated successfully.",
            'post' => new PositionResource($position)
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return response()->json([null], 204);
    }
}
