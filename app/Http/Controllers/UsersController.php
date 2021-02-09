<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
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
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function edit(Request $request, User $user): JsonResponse
    {
        $validate_Data = $request->validate([
            'name' => 'required|string|max:30',
            'password' => 'required|min:6|max:40',
            'email' => 'required|email'
        ]);
        if (!$validate_Data) return response()->json(User::ERROR, 400);
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
