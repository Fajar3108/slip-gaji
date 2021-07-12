<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik' => ['required', 'min:4', 'max:8'],
            'no' => ['required'],
            'gaji_pokok' => ['required', 'numeric'],
            'tunjangan_jabatan' => ['required', 'numeric'],
            'tunjangan_kinerja' => ['required', 'numeric'],
            'tunjangan_project' => ['required', 'numeric'],
            'kehadiran' => ['required', 'numeric'],
            'lembur' => ['required', 'numeric'],
            'pinjaman_karyawan' => ['required', 'numeric'],
            'pph' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'hari_masuk' => ['required', 'numeric'],
            'hari_absen' => ['required', 'numeric'],
            'telat_konfirmasi' => ['required', 'numeric'],
            'telat_non_konfirmasi' => ['required', 'numeric'],
            'sakit_ket_dokter' => ['required', 'numeric'],
            'sakit_non_ket_dokter' => ['required', 'numeric'],
            'izin' => ['required', 'numeric'],
        ];
    }
}
