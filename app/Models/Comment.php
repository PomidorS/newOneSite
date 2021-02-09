<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    public const ERROR = 'The number of characters has been exceeded';

    /**
     * @var array[]
     */
    protected $fillable = [
        'id',
        'text',
        'user_id',
        'post_id'
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne('users');
    }

    /**
     * @return HasOne
     */
    public function post(): HasOne
    {
        return $this->hasOne('posts');
    }
}
