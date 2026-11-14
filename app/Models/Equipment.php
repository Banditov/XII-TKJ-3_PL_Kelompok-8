<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';

    // class_id wajib masuk di sini agar bisa diisi lewat create()/updateOrCreate()
    protected $fillable = ['class_id', 'name', 'total', 'description'];

    protected function casts(): array
    {
        return ['total' => 'integer'];
    }

    // Kelas pemilik perlengkapan ini
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }
}
