<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimRecord extends Model
{
    protected $fillable = [
        'name',
        'nis',
        'has_sim',
    ];

    protected function casts(): array
    {
        return [
            'has_sim' => 'boolean',
        ];
    }
}
