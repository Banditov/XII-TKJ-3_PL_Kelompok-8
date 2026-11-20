<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'class_id',
        'title',
        'description',
        'date',
        'time',
        'time_end',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
        'time_end' => 'datetime:H:i',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}