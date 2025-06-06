<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
        protected $fillable = [
        'name',
        'bio',
        'skills'
    ];

    protected $casts = [
        'skills' => 'array',
    ];
}
