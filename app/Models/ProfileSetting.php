<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'headline',
        'bio_p1',
        'bio_p2',
        'email',
        'github_url',
        'location',
        'status_text',
    ];
}
