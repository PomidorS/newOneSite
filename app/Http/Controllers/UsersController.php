<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller {

    /**
     * Show the form for creating a new resource.
     *
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request): string {
        $user = User::create($request->all());
        return response()->json($user,200);

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {

        return response()->json(User::find((int) $id), 201);
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
        $result = User::find((int) $id);
        $result->update($request->all());
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
        $result = User::find((int) $id);
        $result->delete();
        return response()->json('', 200);
    }
}
