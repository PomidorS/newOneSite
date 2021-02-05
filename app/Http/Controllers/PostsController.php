<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller {
    protected int $max_nums = 50, $One = 1;

    /**
     * Show the form for creating a new resource.
     *
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request): string {
        $validate_Data = $request->validate([
           'text' => 'required|string|max:255 '
        ]);
        if(!$validate_Data) return response()->json(Post::error , 400);
        $post = Post::create($request->all());
        return response()->json(Post::find($post['id']), 201);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param int $quantity
     * @return JsonResponse
     */
    public function show(int $id, int $quantity = 1): JsonResponse {
        if ($quantity == $this->One) return response()->json(Post::find((int) $id), 201);
        else {
            $out_post = DB::table('posts')->orderBy('id')->take($this->max_nums);//->get();
            return response()->json($out_post, 201);
        }
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
            'text' => 'required|string|max:255 '
        ]);
        if(!$validate_Data) return response()->json(Post::error , 400);
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
