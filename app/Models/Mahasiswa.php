<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'npm',
        'nama',
    ];

    public function krs()
    {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }
}