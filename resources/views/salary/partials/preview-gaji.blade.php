<div class="d-table-cell">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th colspan="2" class="bg-dark text-white">Pendapatan</th>
                </tr>
                <tr>
                    <td>Gaji Pokok</td>
                    <td id="gajiPokok">Rp. {{ number_format($salary->gaji_pokok) ?? 0 }}</td>
                </tr>
                <tr>
                    <td>Tunjangan Jabartan</td>
                    <td id="tunjanganJabatan">Rp. {{ number_format($salary->tunjangan_jabatan) ?? 0 }}</td>
                </tr>
                <tr>
                    <td>Tunjangan Kinerja</td>
                    <td id="tunjanganKinerja">Rp. {{ number_format($salary->tunjangan_kinerja) ?? 0 }}</td>
                </tr>
                <tr>
                    <td>Tunjangan Project</td>
                    <td id="tunjanganProject">Rp. {{ number_format($salary->tunjangan_project) ?? 0 }}</td>
                </tr>
                <tr>
                    <td>Kehadiran</td>
                    <td id="kehadiran">Rp. {{ number_format($salary->kehadiran) ?? 0 }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-light">BPJS Ketenagakerjaan</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;Jaminan Kecelakaan Kerja (0,24%)</td>
                    <td id="jaminanKecelakaanKerja">Rp. 0</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;Jaminan Kematian (0,30%)</td>
                    <td id="jaminanKematian">Rp. 0</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;Jaminan Hari Tua (3,7%)</td>
                    <td id="jaminanHariTua">Rp. 0</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;Jaminan Pensiun (2%)</td>
                    <td id="jaminanPensiun">Rp. 0</td>
                </tr>
                <tr>
                    <td>Lembur</td>
                    <td id="lembur">Rp. {{ number_format($salary->lembur) ?? 0 }}</td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th colspan="2" class="bg-dark text-white">Potongan</th>
                </tr>
                <tr>
                    <td>BPJS TK - Perusahaan</td>
                    <td class="bpjsTKPerusahaan">Rp. 0</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-light">BPJS TK - Perusahaan</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;Jaminan Pensiun (1%)</td>
                    <td id="jaminanPensiun2">Rp. 0</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;Jaminan Hari Tua (2%)</td>
                    <td id="jaminanHariTua2">Rp. 0</td>
                </tr>
                <tr>
                    <td colspan="2" class="bg-light">BPJS Kesehatan</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;Ditanggung Perusahaan (4%)</td>
                    <td id="BPJSDitanggungPerusahaan">Rp. 0</td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;Ditanggung Karyawan (1%)</td>
                    <td id="BPJSDitanggungKaryawan">Rp. 0</td>
                </tr>
                <tr>
                    <td>Pinjaman Karyawan</td>
                    <td class="pinjamanKaryawan">Rp. {{ number_format($salary->pinjaman_karyawan) ?? 0 }}</td>
                </tr>
                <tr>
                    <td>PPH psl 21 - karyawan</td>
                    <td class="pph">Rp. {{ number_format($salary->pph) ?? 0 }}</td>
                </tr>
            </table>
            <table class="table">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Jumlah Gaji</th>
                        <th id="jumlahGaji">Rp. {{ number_format($salary->total_pendapatan() - $salary->total_potongan()) ?? 0 }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
