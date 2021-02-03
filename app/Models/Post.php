<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    /**
     * @var array[]
     */
    protected $fillable = [
        'id',
        'text',
        'user_id',
        'comment_id'
    ];

    public static function get()
    {
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany('comments');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne('users');
    }
}
