<?php


namespace App\Services;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserCreatorService
{
    /**
     * @param int $user_id
     * @return bool|JsonResponse
     */
    static public function creatorPost(int $user_id)
    {
        $postUser = DB::table('posts')->select('user_id')->find($user_id);
        if (!$postUser) {
            throw new ModelNotFoundException('вы не являетесь создателем.');
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
            throw new ModelNotFoundException('вы не являетесь создателем.');
        }
    }
}
