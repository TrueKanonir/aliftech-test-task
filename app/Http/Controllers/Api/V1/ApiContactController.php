<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ApiContactRequest;
use App\Http\Resources\Api\v1\ApiContactResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param int $userId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(int $userId): AnonymousResourceCollection
    {
        return ApiContactResource::collection(Contact::getContactsByUser($userId));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Api\V1\ApiContactRequest $request
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ApiContactRequest $request, int $userId): JsonResponse
    {
        User::findById($userId)
            ->addContact($request->validated());

        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\Api\v1\ApiContactResource
     */
    public function show(int $id): ApiContactResource
    {
        return ApiContactResource::make(Contact::findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\V1\ApiContactRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ApiContactRequest $request, int $id): JsonResponse
    {
        Contact::findById($id)->update($request->validated());

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
        Contact::findById($id)->delete();

        return response()->json(null, 204);
    }
}
