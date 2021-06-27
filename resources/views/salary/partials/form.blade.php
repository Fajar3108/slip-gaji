@csrf

<div>
    <label for="nik" class="form-label">NIK Karyawan</label>
    <input type="text" name="nik" id="nik" class="form-control" value="{{ old('nik') ?? (isset($salary->user->nik) ? $salary->user->nik : '') }}">
    @error('nik')
        <small class="text-danger">{{ $message }}</small>
    @enderror
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
    <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" value="{{ old('gaji_pokok') ?? $salary->gaji_pokok ?? 0 }}">
    @error('gaji_pokok')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="tunjangan_jabatan" class="form-label">Tunjangan Jabatan</label>
    <input type="number" name="tunjangan_jabatan" id="tunjangan_jabatan" class="form-control" value="{{ old('tunjangan_jabatan') ?? $salary->tunjangan_jabatan ?? 0 }}">
    @error('tunjangan_jabatan')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="tunjangan_kinerja" class="form-label">Tunjangan Kinerja</label>
    <input type="number" name="tunjangan_kinerja" id="tunjangan_kinerja" class="form-control" value="{{ old('tunjangan_kinerja') ?? $salary->tunjangan_kinerja ?? 0 }}">
    @error('tunjangan_kinerja')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="tunjangan_project" class="form-label">Tunjangan Project</label>
    <input type="number" name="tunjangan_project" id="tunjangan_project" class="form-control" value="{{ old('tunjangan_project') ?? $salary->tunjangan_project ?? 0 }}">
    @error('tunjangan_project')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="kehadiran" class="form-label">Kehadiran</label>
    <input type="number" name="kehadiran" id="kehadiran" class="form-control" value="{{ old('kehadiran') ?? $salary->kehadiran ?? 0 }}">
    @error('kehadiran')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="lembur" class="form-label">Lembur</label>
    <input type="number" name="lembur" id="lembur" class="form-control" value="{{ old('lembur') ?? $salary->lembur ?? 0 }}">
    @error('lembur')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="pinjaman_karyawan" class="form-label">Pinjaman Karyawan</label>
    <input type="number" name="pinjaman_karyawan" id="pinjaman_karyawan" class="form-control" value="{{ old('pinjaman_karyawan') ?? $salary->pinjaman_karyawan ?? 0 }}">
    @error('pinjaman_karyawan')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mt-3">
    <label for="pph" class="form-label">PPH</label>
    <input type="number" name="pph" id="pph" class="form-control" value="{{ old('pph') ?? $salary->pph ?? 0 }}">
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
