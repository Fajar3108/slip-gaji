<?php

namespace App\Imports;

use App\Models\{Salary, User};
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SalariesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!$row['nik']) return;
        return new Salary([
            'user_id' => User::where('nik', $row['nik'])->first()->id,
            'no' => $row['no'],
            'date' => $row['date'],
            'gaji_pokok' => $row['gaji_pokok'] ?? 0,
            'tunjangan_jabatan' => $row['tunjangan_jabatan'] ?? 0,
            'tunjangan_kinerja' => $row['tunjangan_kinerja'] ?? 0,
            'tunjangan_project' => $row['tunjangan_project'] ?? 0,
            'kehadiran' => $row['kehadiran'] ?? 0,
            'lembur' => $row['lembur'] ?? 0,
            'pinjaman_karyawan' => $row['pinjaman_karyawan'] ?? 0,
            'pph' => $row['pph'] ?? 0,
            'hari_masuk' => $row['hari_masuk'] ?? 0,
            'hari_absen' => $row['hari_absen'] ?? 0,
            'telat_konfirmasi' => $row['telat_konfirmasi'] ?? 0,
            'telat_non_konfirmasi' => $row['telat_non_konfirmasi'] ?? 0,
            'sakit_ket_dokter' => $row['sakit_ket_dokter'] ?? 0,
            'sakit_non_ket_dokter' => $row['sakit_non_ket_dokter'] ?? 0,
            'izin' => $row['izin'] ?? 0,
        ]);
    }
}
