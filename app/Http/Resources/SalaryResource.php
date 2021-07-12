<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
                'nik' => $this->user->nik,
                'position' => $this->user->role->name,
            ],
            'absensi' => [
                'hari_masuk' => $this->hari_masuk,
                'hari_absen' => $this->hari_absen,
                'telat_konfirmasi' => $this->telat_konfirmasi,
                'telat_non_konfirmasi' => $this->telat_non_konfirmasi,
                'sakit_ket_dokter' => $this->sakit_ket_dokter,
                'sakit_non_ket_dokter' => $this->sakit_non_ket_dokter,
                'izin' => $this->izin,
            ],
            'id' => $this->id,
            'no_slip' => $this->no,
            'gaji_pokok' => $this->gaji_pokok,
            'tunjangan_jabatan' => $this->tunjangan_jabatan,
            'tunjangan_kinerja' => $this->tunjangan_kinerja,
            'tunjangan_project' => $this->tunjangan_project,
            'kehadiran' => $this->kehadiran,
            'lembur' => $this->lembur,
            'pinjaman_karyawan' => $this->pinjaman_karyawan,
            'pph' => $this->pph,
            'date' => $this->date
        ];
    }
}
