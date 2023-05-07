<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'budget_id',
        'title',
        'value',
    ];

    /**
     * Budget - Item BelongsTo relation
     *
     * @return BelongsTo
     */
    public function wedding(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }
}
