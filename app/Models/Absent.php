<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absent extends Model
{
    protected $fillable = [
        'student_id',
        'date',
        'status',
        'reason',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}