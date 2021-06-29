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
        return
        ((0.24 / 100) * ($this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja)) +
        ((0.30 / 100) * ($this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja)) +
        ((3.7 / 100) * ($this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja)) +
        ((2 / 100) * ($this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja))
        ;
    }

    public function bpjs_kesehatan()
    {
        return (4 / 100) * ($this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja);
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
        return
        $this->bpjs_ketenagakerjaan() +
        (1 / 100) * ($this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja) +
        (2 / 100) * ($this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja) +
        $this->bpjs_kesehatan() +
        (1 / 100) * ($this->gaji_pokok + $this->tunjangan_jabatan + $this->tunjangan_kinerja) +
        $this->pinjaman_karyawan +
        $this->pph
        ;
    }
}
