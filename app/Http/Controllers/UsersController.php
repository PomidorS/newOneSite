<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller {

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {
        $result = User::findOrFail($id);
        if(!$result) return response()->json(User::error, 400);
        return response()->json($result, 201);
    }

    /**
     * @return JsonResponse
     */
    public function showMe(): JsonResponse
    {
        return response()->json(User::get(), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function edit(Request $request, int $id): JsonResponse {
        $validate_Data = $request->validate([
            'name' => 'required|string|max:30',
            'password' => 'required|min:6|max:40',
            'email' => 'required|email',
            'login' => 'required|max:12'
        ]);
        if(!$validate_Data) return response()->json(User::error , 400);
        $result = User::findOrFail($id);
        $result->update($request->only(['name', 'login', 'email', 'password',]));
        $result->save();
        return response()->json($result, 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse {
        $result = User::findOrFail($id);
        $result->delete();
        return response()->json('', 200);
    }
}
