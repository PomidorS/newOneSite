<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPost;
use App\Models\Post;
use App\Models\User;
use App\Services\BlacklistService;
use App\Services\UserCreatorService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Helpers\Filters\StringFilter;

class PostsController extends Controller
{
    protected int $max_nums = 50, $one = 1;

    /**
     * Show the form for creating a new resource.
     *
     *
     * @param RequestPost $request
     * @param User $user_id
     * @return string
     */
    public function create(RequestPost $request, User $user_id): string
    {
        BlacklistService::userInBlackList((int)$user_id);
        $textPost = (new StringFilter)->keepNumbersAndLettersOnly((string)$request->only(['text']));
        $post = Post::query()->create(['text' => $textPost]);
        return response()->json(Post::query()->findOrFail($post['id']), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user_id
     * @param Post $post
     * @param int $quantity
     * @return JsonResponse
     */
    public function show(User $user_id, Post $post, int $quantity = 1): JsonResponse
    {
        BlacklistService::userInBlackList((int)$user_id);
        if ($quantity == $this->one) {
            return response()->json(Post::query()->findOrFail($post), 201);
        } else {
            $out_post = DB::table('posts')->orderBy('id', 'desc')->take($this->max_nums)->get();
        }

        return response()->json($out_post, 201);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param RequestPost $request
     * @param Post $post
     * @param User $user_id
     * @return JsonResponse
     */
    public function edit(RequestPost $request, Post $post, User $user_id): JsonResponse
    {
        UserCreatorService::creatorPost((int)$user_id);
        $result = Post::query()->findOrFail($post);
        $result->update($request->only(['text']));
        $result->save();
        return response()->json($result, 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user_id
     * @param Post $post
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(User $user_id, Post $post): JsonResponse
    {
        UserCreatorService::creatorPost((int)$user_id);
        $result = Post::query()->findOrFail($post);
        $result->delete();
        return response()->json('', 200);
    }
}
