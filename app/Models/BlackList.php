<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BlackList extends Model
{
    use HasFactory;

    protected $table = 'blacklists';

    /**
     * property black_list_id
     * property user_id
     * property message
     *
     * @var array[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'blacklist_id',
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne('users');
    }
}
