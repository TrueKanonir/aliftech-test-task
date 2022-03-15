<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ApiUserRequest;
use App\Http\Resources\Api\v1\ApiUserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ApiUserResource::collection(User::getAllPaginated());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\V1\ApiUserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ApiUserRequest $request): JsonResponse
    {
        User::query()->create($request->validated());

        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Api\v1\ApiUserResource
     */
    public function show(int $id): ApiUserResource
    {
        return ApiUserResource::make(User::findById($id)->load('contacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\V1\ApiUserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ApiUserRequest $request, int $id): JsonResponse
    {
        User::findById($id)->update($request->validated());

        return response()->json(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        User::findById($id)->delete();

        return response()->json(null, 204);
    }
}
