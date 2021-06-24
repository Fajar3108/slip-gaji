<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no',
        'gaji_pokok',
        'tunjangan_jabatan',
        'tunjangan_kinerja',
        'tunjangan_project',
        'kehadiran',
        'lembur',
        'pinjaman_karyawan',
        'pph',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
