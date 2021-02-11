<?php

namespace App\Http\Controllers;

use App\Models\BlackList;
use Illuminate\Http\JsonResponse;

class BlackListsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param BlackList $blacklist
     * @return JsonResponse
     */
    public function create(BlackList $blacklist): JsonResponse
    {
        BlackList::query()->findOrFail($blacklist);
        $BlackLists = new BlackList;
        $BlackLists->update();
        $BlackLists->save();
        return response()->json($BlackLists, 201);

    }


    /**
     * Display the specified resource.
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        return response()->json(BlackList::query()->get(), 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param BlackList $blacklist
     * @return JsonResponse
     */
    public function destroy(BlackList $blacklist): JsonResponse
    {
        $result = BlackList::query()->findOrFail($blacklist);
        $result->query()->delete();
        return response()->json('', 200);
    }
}
