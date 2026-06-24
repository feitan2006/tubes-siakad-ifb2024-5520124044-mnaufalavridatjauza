<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sks',
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'kode_matakuliah', 'kode_matakuliah');
    }
}