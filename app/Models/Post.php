<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    public const ERROR = 'The number of characters has been exceeded';

    /**
     * @var array[]
     */
    protected $fillable = [
        'id',
        'text',
        'user_id',
        'comment_id'
    ];

    /**
     * @return HasMany
     */
    public function comment(): HasMany
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
