<?php


namespace App\Exceptions\API;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserCreator
{
    /**
     * @param int $user_id
     * @return bool|JsonResponse
     */
    static public function creatorPost(int $user_id)
    {
        $postUser = DB::table('posts')->select('user_id')->find($user_id);
        if (!$postUser) {
            return response()->json('вы не являетесь создателем.', 200);
        } else {
            return true;
        }
    }

    /**
     * @param int $user_id
     * @return bool|JsonResponse
     */
    static public function creatorComment(int $user_id)
    {
        $postUser = DB::table('comments')->select('user_id')->find($user_id);
        if (!$postUser) {
            return response()->json('вы не являетесь создателем.', 200);
        } else {
            return true;
        }
    }
}
