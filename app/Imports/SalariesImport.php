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
        return new Salary([
            'user_id' => User::where('email', $row['email'])->first()->id,
            'no' => $row['no'],
            'date' => $row['date'],
            'gaji_pokok' => $row['gaji_pokok'],
            'tunjangan_jabatan' => $row['tunjangan_jabatan'],
            'tunjangan_kinerja' => $row['tunjangan_kinerja'],
            'tunjangan_project' => $row['tunjangan_project'],
            'kehadiran' => $row['kehadiran'],
            'lembur' => $row['lembur'],
            'pinjaman_karyawan' => $row['pinjaman_karyawan'],
            'pph' => $row['pph'],
        ]);
    }
}
