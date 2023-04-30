<?php

namespace App\Models;

use App\Enums\TodoStatuses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    /**
     * Wedding - Idea HasMany relation
     *
     * @return HasMany
     */
    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    /**
     * Wedding - Todo HasMany relation
     *
     * @return HasMany
     */
    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

    public function remainingBudget(): Attribute
    {
        return Attribute::make(get: fn () => $this->budget->remainingBudget());
    }

    public function budgetItemsQuery(): Builder
    {
        return Item::query()->where('budget_id', $this->budget->id);
    }

    public function todoStatusGrouped()
    {
        $statuses = DB::table('todos')
            ->where('wedding_id', $this->id)
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->keyBy('status')
            ->toArray();

        foreach (TodoStatuses::cases() as $status) {
            if(array_key_exists($status->value, $statuses)){
                $result[$status->value] = $statuses[$status->value]->count;
            } else {
                $result[$status->value] = 0;
            }
        };

        return $result;
    }

    public function ideasForOverview()
    {
        return $this->ideas->inRandomOrder()->get();
    }
}
