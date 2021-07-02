<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }
    table {
        width: 100%;
        text-align: left;
        border-spacing: 5px;
    }

    tr, td, th {
        text-align: left;
    }

    th, td {
        padding: 10px 0;
        font-size: 14px;
    }

    .container {
        width: 90%;
        margin: 0 auto;
    }

    .total_gaji {
        width: 100%;
        text-align: center;
    }
    .header {
        width:  70%;
        margin: 0 auto;
        padding-top: 50px;
        padding-bottom: 30px;
        text-align: center;
    }
    .header p {
        font-size: 14px;
    }
</style>

<div class="container">
<div class="header">
    <h3>PT SOLUSI INTEK INDONESIA</h3>
    <p>Head Office : Jl. Tebet Barat Dalam Raya No.31, RT.7/RW.3, Tebet Bar., Kec. Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12810</p>
    <p>Telp. 021-89454790</p>
</div>
<table style="margin-bottom: 10px">
    <tr>
        <th>Nomer Slip</th>
        <td>{{ $salary->no }}</td>
        <th>Posisi</th>
        <td>{{ $salary->user->role->name }}</td>
        <th>Gaji Bulan</th>
        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $salary->date)->format('M Y') }}</td>
    </tr>
    <tr>
        <th>Nama</th>
        <td>{{ $salary->user->name }}</td>
        <th>NIK</th>
        <td>{{ $salary->user->nik }}</td>
    </tr>
</table>

<table style="margin-bottom: 10px">
    <tr style="background-color: #eee;">
        <th colspan="6" style="text-align: center;">DATA INCOME</th>
    </tr>
    <tr>
        {{-- 1 --}}
        <th>Gaji Pokok</th>
        <td>Rp. {{ number_format($salary->gaji_pokok) }}</td>
        <th>Kehadiran</th>
        <td>Rp. {{ number_format($salary->kehadiran) }}</td>
        <th>Jaminan Pensiun (2%)</th>
        <td>Rp. {{ number_format(2 / 100 * ($salary->gaji_pokok + $salary->tunjangan_jabatan + $salary->tunjangan_kinerja)) }}</td>
    </tr>

    <tr>
        {{-- 2 --}}
        <th>Tunjangan Jabatan</th>
        <td>Rp. {{ number_format($salary->tunjangan_jabatan) }}</td>
        <th>Jaminan Kecelakaan (0.24%)</th>
        <td>Rp. {{ number_format(0.24 / 100 * ($salary->gaji_pokok + $salary->tunjangan_jabatan + $salary->tunjangan_kinerja)) }}</td>
        <th>BPJS Kesehatan (4%)</th>
        <td>Rp. {{ number_format(4 / 100 * ($salary->gaji_pokok + $salary->tunjangan_jabatan + $salary->tunjangan_kinerja)) }}</td>
    </tr>

    <tr>
        {{-- 3 --}}
        <th>Tunjangan Kinerja</th>
        <td>Rp. {{ number_format($salary->tunjangan_kinerja) }}</td>
        <th>Jaminan Kematian (0.30%)</th>
        <td>Rp. {{ number_format(0.30 / 100 * ($salary->gaji_pokok + $salary->tunjangan_jabatan + $salary->tunjangan_kinerja)) }}</td>
        <th>Lembur</th>
        <td>Rp. {{ number_format($salary->lembur) }}</td>
    </tr>

    <tr>
        {{-- 4 --}}
        <th>Tunjangan Project</th>
        <td>Rp. {{ number_format($salary->tunjangan_project) }}</td>
        <th>Jaminan Kematian (3.7%)</th>
        <td>Rp. {{ number_format(3.7 / 100 * ($salary->gaji_pokok + $salary->tunjangan_jabatan + $salary->tunjangan_kinerja)) }}</td>
    </tr>
</table>


<table style="margin-bottom: 10px">
    <tr style="background-color: #eee;">
        <th colspan="6" style="text-align: center;">DATA POTONGAN</th>
    </tr>
    <tr>
        {{-- 1 --}}
        <th>BPJS TK - Perusahaan</th>
        <td>Rp. {{ number_format($salary->bpjs_ketenagakerjaan()) }}</td>
        <th>Jaminan Hari Tua (2%)</th>
        <td>Rp. {{ number_format(2 / 100 * ($salary->gaji_pokok + $salary->tunjangan_jabatan + $salary->tunjangan_kinerja)) }}</td>
        <th>Pinjaman Karyawan</th>
        <td>Rp. {{ number_format($salary->pinjaman_karyawan) }}</td>
    </tr>
    <tr>
        {{-- 2 --}}
        <th colspan="2">BPJS TK - Karyawan</th>
        <th>Ditanggung Perusahaan (4%)</th>
        <td>Rp. {{ number_format($salary->bpjs_kesehatan()) }}</td>
        <th>Ditanggung Karyawan (1%)</th>
        <td>Rp. {{ number_format(1 / 100 * ($salary->gaji_pokok + $salary->tunjangan_jabatan + $salary->tunjangan_kinerja)) }}</td>
    </tr>
    <tr>
        {{-- 3 --}}
        <th>PPH psl 21 - karyawan</th>
        <td>Rp. {{ number_format($salary->pph) }}</td>
        <th>Jaminan Pensiun (1%)</th>
        <td>Rp. {{ number_format(1 / 100 * ($salary->gaji_pokok + $salary->tunjangan_jabatan + $salary->tunjangan_kinerja)) }}</td>
    </tr>
</table>

<div class="total_gaji">
    <h3>JUMLAH GAJI</h3>
    <h1>Rp. {{ number_format($salary->total_pendapatan() - $salary->total_potongan()) }}</h1>
</div>
</div>
