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
     * @var array[]
     */
    protected $fillable = [
        'id',
        'user_id',
        'BlackList_id'
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne('users');
    }
}
