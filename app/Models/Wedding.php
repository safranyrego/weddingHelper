<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wedding extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'planned_from',
        'planned_to',
        'final',
    ];

    /**
     * User - Wedding BelongsTo relation
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Wedding - Budget HasOne relation
     *
     * @return HasOne
     */
    public function budget(): HasOne
    {
        return $this->hasOne(Budget::class);
    }

    public function remainingBudget(): Attribute
    {
        return Attribute::make(get: fn () => 20000000);
    }

    public function budgetItemsQuery(): Builder
    {
        return Item::query()->where('budget_id', $this->budget->id);
    }
}
