<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentsController extends Controller {

    /**
     * Show the form for creating a new resource.
     *
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request): string {
        $validate_Data = $request->validate([
            'text' => 'required|string|max:1024 '
        ]);
        if(!$validate_Data) return response()->json(Comment::error , 400);
        $comment = Comment::create($request->all());
        return response()->json($comment,200);

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse {

        return response()->json(Comment::find((int) $id), 201);
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
            'text' => 'required|string|max:1024 '
        ]);
        if(!$validate_Data) return response()->json(Comment::error , 400);
        $result = Comment::find((int) $id);
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
        $result = Comment::find((int) $id);
        $result->delete();
        return response()->json('', 200);
    }
}
