<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FollowersController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param Follower $follower
     * @return JsonResponse
     */
    public function create(Request $request, Follower $follower): JsonResponse
    {
        $result = Follower::query()->findOrFail($follower);
        $result->update($request->all());
        $result->save();
        return response()->json($result, 201);
    }


    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        return response()->json(Follower::query()->get(), 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Follower $follower
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Follower $follower): JsonResponse
    {
        $result = Follower::query()->findOrFail($follower);
        $result->delete();
        return response()->json('', 200);
    }
}
