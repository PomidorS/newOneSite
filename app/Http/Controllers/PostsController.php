<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    protected int $max_nums = 50, $one = 1;

    /**
     * Show the form for creating a new resource.
     *
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request): string
    {
        $validate_Data = $request->validate([
            'text' => 'required|string|max:255 '
        ]);
        if (!$validate_Data) {
            return response()->json(Post::ERROR, 400);
        }

        $post = Post::query()->create($request->only(['text']));
        return response()->json(Post::query()->findOrFail($post['id']), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @param int $quantity
     * @return JsonResponse
     */
    public function show(Post $post, int $quantity = 1): JsonResponse
    {
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
     * @param Request $request
     * @param Post $post
     * @return JsonResponse
     */
    public function edit(Request $request, Post $post): JsonResponse
    {
        $validate_Data = $request->validate([
            'text' => 'required|string|max:255'
        ]);
        if (!$validate_Data) {
            return response()->json(Post::ERROR, 400);
        }

        $result = Post::query()->findOrFail($post);
        $result->update($request->only(['text']));
        $result->save();
        return response()->json($result, 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Post $post): JsonResponse
    {
        $result = Post::query()->findOrFail($post);
        $result->delete();
        return response()->json('', 200);
    }
}
