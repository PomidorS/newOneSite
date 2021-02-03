<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostsController extends Controller {

    /**
     * Show the form for creating a new resource.
     *
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request): string {
        $post = Post::create($request->all());
        return response()->json($post,200);

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse {

        return response()->json(Post::find((int) $id), 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function edit(Request $request, int $id): JsonResponse {
        $result = Post::find((int) $id);
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
        $result = Post::find((int) $id);
        $result->delete();
        return response()->json('', 200);
    }
}
