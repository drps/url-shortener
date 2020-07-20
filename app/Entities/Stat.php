<?php

namespace App\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $url_id
 * @property string $ip
 * @property string $img
 * @property Carbon $created_at
 *
 * @method forUrl(Url $url)
 */
class Stat extends Model
{
    protected $table = 'stat';

    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function url()
    {
        return $this->belongsTo(Url::class, 'url_id', 'id');
    }

    public function scopeForUrl(Builder $query, Url $url)
    {
        return $query->where('url_id', $url->id);
    }
}
