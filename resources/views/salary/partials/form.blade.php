@csrf

<div>
    <label for="nik" class="form-label">Karyawan</label>
    <select id="userSearch" name="nik" id="nik" class="form-select" autocomplete="off">
        @foreach ($users as $user)
        <option value="{{ $user->nik }}">{{ $user->name }} | {{ $user->role->name }}</option>
        @endforeach
    </select>
    @error('nik')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="card w-100 border mt-3 py-3">
  <h5 class="card-header py-0 h4 mb-3">Absensi</h5>
  <div class="card-body py-0">
        <div>
            <label for="hari_masuk" class="form-label">Hari Masuk</label>
            <input type="number" name="hari_masuk" id="hari_masuk" class="form-control" value="{{ old('hari_masuk') ?? $salary->hari_masuk ?? 0 }}">
            @error('hari_masuk')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="hari_absen" class="form-label">Hari Absen</label>
            <input type="number" name="hari_absen" id="hari_absen" class="form-control" value="{{ old('hari_absen') ?? $salary->hari_absen ?? 0 }}">
            @error('hari_absen')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="telat_konfirmasi" class="form-label">Telat Konfirmasi</label>
            <input type="number" name="telat_konfirmasi" id="telat_konfirmasi" class="form-control" value="{{ old('telat_konfirmasi') ?? $salary->telat_konfirmasi ?? 0 }}">
            @error('telat_konfirmasi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="telat_non_konfirmasi" class="form-label">Telat Non Konfirmasi</label>
            <input type="number" name="telat_non_konfirmasi" id="telat_non_konfirmasi" class="form-control" value="{{ old('telat_non_konfirmasi') ?? $salary->telat_non_konfirmasi ?? 0 }}">
            @error('telat_non_konfirmasi')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="sakit_ket_dokter" class="form-label">Sakit Keterangan Dokter</label>
            <input type="number" name="sakit_ket_dokter" id="sakit_ket_dokter" class="form-control" value="{{ old('sakit_ket_dokter') ?? $salary->sakit_ket_dokter ?? 0 }}">
            @error('sakit_ket_dokter')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="sakit_non_ket_dokter" class="form-label">Sakit Non Keterangan Dokter</label>
            <input type="number" name="sakit_non_ket_dokter" id="sakit_non_ket_dokter" class="form-control" value="{{ old('sakit_non_ket_dokter') ?? $salary->sakit_non_ket_dokter ?? 0 }}">
            @error('sakit_non_ket_dokter')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mt-3">
            <label for="izin" class="form-label">Izin</label>
            <input type="number" name="izin" id="izin" class="form-control" value="{{ old('izin') ?? $salary->izin ?? 0 }}">
            @error('izin')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
  </div>
</div>

<div class="mt-3">
    <label for="no" class="form-label">NO Slip</label>
    <input type="text" name="no" id="no" class="form-control" value="{{ old('no') ?? $salary->no }}">
    @error('no')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
    <input type="text" name="gaji_pokok" id="gaji_pokok" class="form-control currency-input" value="{{ old('gaji_pokok') ?? $salary->gaji_pokok ?? 0 }}">
    @error('gaji_pokok')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="tunjangan_jabatan" class="form-label">Tunjangan Jabatan</label>
    <input type="text" name="tunjangan_jabatan" id="tunjangan_jabatan" class="form-control currency-input" value="{{ old('tunjangan_jabatan') ?? $salary->tunjangan_jabatan ?? 0 }}">
    @error('tunjangan_jabatan')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="tunjangan_kinerja" class="form-label">Tunjangan Kinerja</label>
    <input type="text" name="tunjangan_kinerja" id="tunjangan_kinerja" class="form-control currency-input" value="{{ old('tunjangan_kinerja') ?? $salary->tunjangan_kinerja ?? 0 }}">
    @error('tunjangan_kinerja')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="tunjangan_project" class="form-label">Tunjangan Project</label>
    <input type="text" name="tunjangan_project" id="tunjangan_project" class="form-control currency-input" value="{{ old('tunjangan_project') ?? $salary->tunjangan_project ?? 0 }}">
    @error('tunjangan_project')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="kehadiran_input" class="form-label">Kehadiran</label>
    <input type="text" name="kehadiran" id="kehadiran_input" class="form-control currency-input" value="{{ old('kehadiran') ?? $salary->kehadiran ?? 0 }}">
    @error('kehadiran')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="lembur_input" class="form-label">Lembur</label>
    <input type="text" name="lembur" id="lembur_input" class="form-control currency-input" value="{{ old('lembur') ?? $salary->lembur ?? 0 }}">
    @error('lembur')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="pinjaman_karyawan" class="form-label">Pinjaman Karyawan</label>
    <input type="text" name="pinjaman_karyawan" id="pinjaman_karyawan" class="form-control currency-input" value="{{ old('pinjaman_karyawan') ?? $salary->pinjaman_karyawan ?? 0 }}">
    @error('pinjaman_karyawan')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="pph_input" class="form-label">PPH</label>
    <input type="text" name="pph" id="pph_input" class="form-control currency-input" value="{{ old('pph') ?? $salary->pph ?? 0 }}">
    @error('pph')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="date" class="form-label">Tanggal Gajian</label>
    <input type="date" name="date" id="date" class="form-control" value="{{ old('date') ?? $salary->date }}">
    @error('date')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
