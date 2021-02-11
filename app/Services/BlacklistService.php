<?php


namespace App\Services;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BlacklistService
{
    /**
     * @param int $user_id
     * @return bool|JsonResponse
     */
    static public function userInBlackList(int $user_id)
    {
        $inBlackList = DB::table('black_lists')->select('blacklist_id')->find($user_id);
        if (!$inBlackList) {
            return response()->json('вы в черном списке.', 200);
        } else {
            return true;
        }
    }

}
