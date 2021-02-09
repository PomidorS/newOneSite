<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return string
     */
    public function create(Request $request): string
    {
        $validate_Data = $request->validate([
            'text' => 'required|string|max:1024 '
        ]);
        if (!$validate_Data) {
            return response()->json(Comment::ERROR, 400);
        }

        $comment = Comment::query()->create($request->only('text'));
        return response()->json($comment, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return JsonResponse
     */
    public function show(Comment $comment): JsonResponse
    {

        return response()->json(Comment::query()->findOrFail($comment), 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Comment $comment
     * @return JsonResponse
     */
    public function edit(Request $request, Comment $comment): JsonResponse
    {
        $validate_Data = $request->validate([
            'text' => 'required|string|max:1024 '
        ]);
        if (!$validate_Data) {
            return response()->json(Comment::ERROR, 400);
        }

        $result = Comment::query()->findOrFail($comment);
        $result->update($request->only(['text']));
        $result->save();
        return response()->json($result, 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Comment $comment): JsonResponse
    {
        $result = Comment::query()->findOrFail($comment);
        $result->delete();
        return response()->json('', 200);
    }
}
