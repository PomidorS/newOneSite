<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestComment;
use App\Models\Comment;
use App\Models\User;
use App\Services\BlacklistService;
use App\Services\UserCreatorService;
use Exception;
use Illuminate\Http\JsonResponse;

class CommentsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param RequestComment $request
     * @param User $user_id
     * @return string
     */
    public function create(RequestComment $request, User $user_id): string
    {
        BlacklistService::userInBlackList((int)$user_id);
        $comment = Comment::query()->create($request->only('text'));
        return response()->json($comment, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @param User $user_id
     * @return JsonResponse
     */
    public function show(Comment $comment, User $user_id): JsonResponse
    {
        BlacklistService::userInBlackList((int)$user_id);
        return response()->json(Comment::query()->findOrFail($comment), 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RequestComment $request
     * @param Comment $comment
     * @param User $user_id
     * @return JsonResponse
     */
    public function edit(RequestComment $request, Comment $comment, User $user_id): JsonResponse
    {
        UserCreatorService::creatorComment((int)$user_id);
        $result = Comment::query()->findOrFail($comment);
        $result->update($request->only(['text']));
        $result->save();
        return response()->json($result, 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @param User $user_id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Comment $comment, User $user_id): JsonResponse
    {
        UserCreatorService::creatorComment((int)$user_id);
        $result = Comment::query()->findOrFail($comment);
        $result->delete();
        return response()->json('', 200);
    }
}
