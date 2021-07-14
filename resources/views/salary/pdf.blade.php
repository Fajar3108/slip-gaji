<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
        /* border: 1px solid red !important; */
    }
    table {
        width: 100%;
        margin: 10px 0;
        text-align: left;
        border-spacing: 5px;
    }
    tr, th, td {
        text-align: left;
    }
    th, td {
        padding: 0;
        font-size: 12px;
    }
    h3, th, b{
        font-weight: bold;
    }

    .container {
        width: 90%;
        margin: 0 auto;
    }        
    .total_gaji {
        margin: 50px 0 30px 0;
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
        margin: auto;
        max-width: 380px;
        font-size: 12px;
    }
    .header img{
        position: absolute;
        left: 80px;
        object-fit: contain;
    }
    .content tr > th,
    .content tr > td{
        width: 25%;
    }
    .title{
        margin-bottom: 10px;
        background-color: #eee;
    }
    .title > th{
        padding: 12px 0;
        font-weight: bold;
    }
    .footer th,
    .footer td{
        text-align: center;
    }
</style>

<?php
    $total_salary = $salary->gaji_pokok + $salary->tunjangan_jabatan + $salary->tunjangan_kinerja;
    $batas_atas_bpjs_ketenagakerjaan = 8754600;
    $batas_atas_bpjs_kesehatan = 12000000;
?>

<div class="container">
    <div class="header">
        <img width="70" height="70" src="{{ public_path('images/intek_logo.png') }}" alt="">
        <h3>PT SOLUSI INTEK INDONESIA</h3>
        <p>Head Office : Jl. Tebet Barat Dalam Raya No.31, RT.7/RW.3, Tebet Barat, Kec. Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12810</p>
        <p>Telp. 021-89454790</p>
    </div>
    <table style="margin-bottom: 10px">
        <tr>
            <th>Nomer Slip</th>
            <td><b>:</b> {{ $salary->no }}</td>
            <th>Posisi</th>
            <td><b>:</b> {{ $salary->user->role->name }}</td>
            <th>Gaji Bulan</th>
            <td><b>:</b> {{ Carbon\Carbon::createFromFormat('Y-m-d', $salary->date)->format('F Y') }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><b>:</b> {{ $salary->user->name }}</td>
            <th>NIK</th>
            <td><b>:</b> {{ $salary->user->nik }}</td>
        </tr>
    </table>

    <table class="content" style="margin-bottom: 10px">
        <tr class="title">
            <th colspan="4" style="text-align: center;">DATA ABSENSI</th>
        </tr>
        <tr>
            <th>Hari Masuk</th>
            <td><b>:</b> {{ $salary->hari_masuk }}</td>
            <th>Sakit Keterangan Dokter</th>
            <td><b>:</b> {{ $salary->sakit_ket_dokter }}</td>
        </tr>

        <tr>
            <th>Hari Absen</th>
            <td><b>:</b> {{ $salary->hari_absen }}</td>
            <th>Sakit Non Keterangan Dokter</th>
            <td><b>:</b> {{ $salary->sakit_non_ket_dokter }}</td>
        </tr>

        <tr>
            <th>Telat Konfirmasi</th>
            <td><b>:</b> {{ $salary->telat_konfirmasi }}</td>
            <th>Izin</th>
            <td><b>:</b> {{ $salary->izin }}</td>
        </tr>

        <tr>
            <th>Telat Non Konfirmasi</th>
            <td><b>:</b> {{ $salary->telat_non_konfirmasi }}</td>
        </tr>
    </table>
    
    <table class="content" style="margin-bottom: 10px">
        <tr class="title">
            <th colspan="4" style="text-align: center;">DATA PENDAPATAN</th>
        </tr>
        <tr>
            <th>Gaji Pokok</th>
            <td><b>:</b> Rp. {{ number_format($salary->gaji_pokok) }}</td>
            <th>Jaminan Kematian (0.30%)</th>
            <td><b>:</b> Rp. {{ number_format(0.30 / 100 * $total_salary) }}</td>
        </tr>

        <tr>
            <th>Tunjangan Jabatan</th>
            <td><b>:</b> Rp. {{ number_format($salary->tunjangan_jabatan) }}</td>
            <th>Jaminan Hari Tua (3.7%)</th>
            <td><b>:</b> Rp. {{ number_format(3.7 / 100 * $total_salary) }}</td>
        </tr>

        <tr>
            <th>Tunjangan Kinerja</th>
            <td><b>:</b> Rp. {{ number_format($salary->tunjangan_kinerja) }}</td>
            <th>Jaminan Pensiun (2%)</th>
            <td><b>:</b> Rp. {{ number_format((2 / 100) * min($total_salary, $batas_atas_bpjs_ketenagakerjaan)) }}</td>
        </tr>

        <tr>
            <th>Tunjangan Project</th>
            <td><b>:</b> Rp. {{ number_format($salary->tunjangan_project) }}</td>
            <th>BPJS Kesehatan (4%)</th>
            <td><b>:</b> Rp. {{ number_format($salary->bpjs_kesehatan()) }}</td>
        </tr>

        <tr>
            <th>Kehadiran</th>
            <td><b>:</b> Rp. {{ number_format($salary->kehadiran) }}</td>
            <th>Lembur</th>
            <td><b>:</b> Rp. {{ number_format($salary->lembur) }}</td>
        </tr>

        <tr>
            <th>Jaminan Kecelakaan (0.24%)</th>
            <td><b>:</b> Rp. {{ number_format((0.24 / 100) * $total_salary) }}</td>
        </tr>
    </table>


    <table class="content" style="margin-bottom: 10px">
        <tr class="title">
            <th colspan="6" style="text-align: center;">DATA PENGELUARAN</th>
        </tr>

        <tr>
            <th>BPJS TK - Perusahaan</th>
            <td><b>:</b> Rp. {{ number_format($salary->bpjs_ketenagakerjaan()) }}</td>
            <th>Ditanggung Karyawan (1%)</th>
            <td><b>:</b> Rp. {{ number_format(1 / 100 * min($total_salary, $batas_atas_bpjs_kesehatan)) }}</td>
        </tr>

        <tr>
            <th>Jaminan Pensiun (1%)</th>
            <td><b>:</b> Rp. {{ number_format(1 / 100 * min($total_salary, $batas_atas_bpjs_ketenagakerjaan)) }}</td>
            <th>Pinjaman Karyawan</th>
            <td><b>:</b> Rp. {{ number_format($salary->pinjaman_karyawan) }}</td>
        </tr>

        <tr>
            <th>Jaminan Hari Tua (2%)</th>
            <td><b>:</b> Rp. {{ number_format(2 / 100 * $total_salary) }}</td>
            <th>PPH psl 21 - karyawan</th>
            <td><b>:</b> Rp. {{ number_format($salary->pph) }}</td>
        </tr>

        <tr>
            <th>Ditanggung Perusahaan (4%)</th>
            <td><b>:</b> Rp. {{ number_format($salary->bpjs_kesehatan()) }}</td>
        </tr>
    </table>

    <table class="content" style="margin-bottom: 10px">
        <tr class="title">
            <th colspan="6" style="text-align: center;">TOTAL PERHITUNGAN</th>
        </tr>

        <tr>
            <th>Total Pendapatan Kotor</th>
            <td><b>:</b> Rp. {{ number_format($salary->total_pendapatan()) }}</td>
            <th>Total Potongan</th>
            <td><b>:</b> Rp. {{ number_format($salary->total_potongan()) }}</td>
        </tr>
    </table>

    <div class="total_gaji">
        <h5>JUMLAH GAJI</h5>
        <h1>IDR {{ number_format($salary->total_pendapatan() - $salary->total_potongan()) }}</h1>
    </div>

    <table class="content footer">
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Jakarta, {{ Carbon\Carbon::createFromFormat('Y-m-d', $salary->date)->format('d F Y') }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <th>(SII Finance)</th>
        </tr>
    </table>
</div>