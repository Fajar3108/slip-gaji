<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('no');
            $table->integer('gaji_pokok');
            $table->integer('tunjangan_jabatan');
            $table->integer('tunjangan_kinerja');
            $table->integer('tunjangan_project');
            $table->integer('kehadiran');
            $table->integer('lembur');
            $table->integer('pinjaman_karyawan');
            $table->integer('pph');
            // Absensi
            $table->integer('hari_masuk');
            $table->integer('hari_absen');
            $table->integer('telat_konfirmasi');
            $table->integer('telat_non_konfirmasi');
            $table->integer('sakit_ket_dokter');
            $table->integer('sakit_non_ket_dokter');
            $table->integer('izin');

            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
