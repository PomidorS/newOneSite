<?php

namespace App\Http\Controllers;

use App\Models\BlackList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlackListsController extends Controller {

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function create(Request $request, int $id): JsonResponse {
        $result = BlackList::findOrFail($id);
        $result->update($request->all());
        $result->save();
        return response()->json($result, 201);

    }


    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse {
        return response()->json(BlackList::get(), 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $result = BlackList::findOrFail($id);
        $result->delete();
        return response()->json('', 200);
    }
}
