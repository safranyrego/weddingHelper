<?php

namespace App\Models;

use App\Enums\TodoStatuses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $casts = [
        'status' => TodoStatuses::class
    ];
}
