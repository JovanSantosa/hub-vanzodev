<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'priority',
        'target_quarter',
        'is_private',
        'order',
    ];

    protected $casts = [
        'is_private' => 'boolean',
        'order' => 'integer',
    ];
}
