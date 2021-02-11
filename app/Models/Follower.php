<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Follower extends Model
{
    use HasFactory;

    protected $table = 'followers';

    /**
     * @var array[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'follower_id'
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne('users');
    }
}
