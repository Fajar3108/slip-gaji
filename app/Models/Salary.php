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

    public function bpjs_ketenagakerjaan()
    {
        $total_salary = $this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja;
        return
        ((0.24 / 100) * $total_salary) +
        ((0.30 / 100) * $total_salary) +
        ((3.7 / 100) * $total_salary) +
        ((2 / 100) * min($total_salary, 8754600))
        ;
    }

    public function bpjs_kesehatan()
    {
        $total_salary = $this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja;
        return (4 / 100) * min($total_salary, 12000000);
    }

    public function total_pendapatan()
    {
        return $this->gaji_pokok +
        $this->tunjangan_jabatan +
        $this->tunjangan_kinerja +
        $this->tunjangan_project +
        $this->kehadiran +
        $this->bpjs_ketenagakerjaan() +
        $this->bpjs_kesehatan() +
        $this->lembur;
    }

    public function total_potongan()
    {
        $total_salary = $this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja;
        return $this->bpjs_ketenagakerjaan() +
        ((1 / 100) * min($total_salary, 8754600)) +
        ((2 / 100) * $total_salary) +
        $this->bpjs_kesehatan() +
        ((1 / 100) * min($total_salary, 12000000)) +
        $this->pinjaman_karyawan +
        $this->pph
        ;
    }
}
