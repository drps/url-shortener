<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $url
 * @property string $short_url
 * @property bool $is_commercial
 * @property Carbon $expire_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @method Builder active()
 */
class Url extends Model
{
    protected $table = 'urls';

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'expire_at' => 'datetime',
        'is_commercial' => 'bool',
    ];

    public function scopeActive(Builder $query)
    {
        return $query->where(function (Builder $query) {
            $query
                ->where('expire_at', null)
                ->orWhere('expire_at', '>=', DB::raw('now()'));
        });
    }
}
