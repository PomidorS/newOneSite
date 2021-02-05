<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
    use HasFactory;

    public const error = 'The number of characters has been exceeded';
    protected $table = "comments";

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
    public function users(): HasOne
    {
        return $this->hasOne('users');
    }

    /**
     * @return HasOne
     */
    public function posts(): HasOne
    {
        return $this->hasOne('posts');
    }
}
