<?php

namespace App\Http\Controllers;

use App\Exceptions\API\BlacklistSearch;
use App\Http\Requests\RequestBlackList;
use App\Http\Requests\RequestFollower;
use App\Models\Follower;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;

class FollowersController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param RequestFollower $request
     * @param Follower $follower
     * @param User $user_id
     * @return JsonResponse
     */
    public function create(RequestFollower $request, Follower $follower, User $user_id): JsonResponse
    {
        BlacklistSearch::userInBlackList((int)$user_id);
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
