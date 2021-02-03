<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BlackList extends Model
{
    use HasFactory;
    protected $table = "black_lists";

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
    public function users(): HasOne
    {
        return $this->hasOne('users');
    }
}
