<?php

namespace App\Http\Controllers;

use App\Models\BlackList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlackListsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @param BlackList $blacklist
     * @return JsonResponse
     */
    public function create(Request $request, BlackList $blacklist): JsonResponse
    {
        $BlackLists = BlackList::query()->findOrFail($blacklist);
        $BlackLists->update($request->all());
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
