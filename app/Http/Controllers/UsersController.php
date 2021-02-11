<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestUser;
use App\Models\User;
use App\Services\BlacklistService;
use Exception;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @param User $user_id
     * @return JsonResponse
     */
    public function show(User $user, User $user_id): JsonResponse
    {
        BlacklistService::userInBlackList((int)$user_id);
        $result = User::query()->findOrFail($user);
        if (!$result) return response()->json(User::ERROR, 400);
        return response()->json($result, 201);
    }

    /**
     * @return JsonResponse
     */
    public function showMe(): JsonResponse
    {
        return response()->json(User::query()->get(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RequestUser $request
     * @param User $user
     * @return JsonResponse
     */
    public function edit(RequestUser $request, User $user): JsonResponse
    {
        $result = User::query()->findOrFail($user);
        $result->update($request->only(['name', 'email', 'password']));
        $result->save();
        return response()->json($result, 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(User $user): JsonResponse
    {
        $result = User::query()->findOrFail($user);
        $result->delete();
        return response()->json('', 200);
    }
}
