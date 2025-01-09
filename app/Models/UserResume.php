<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResume extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'address',
        'professional_summary',
        'education',
        'experience',
        'skills',
        'languages',
        'certifications'
    ];

    protected $casts = [
        'education' => 'array',
        'experience' => 'array',
        'skills' => 'array',
        'languages' => 'array',
        'certifications' => 'array'
    ];
}
