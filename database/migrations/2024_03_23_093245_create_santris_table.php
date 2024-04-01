<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 10);
            $table->string('nama', 100);
            $table->string('jenis_kelamin', 10);
            $table->string('jenjang', 10);
            $table->string('alamat', 100);
            $table->char('khd_ngaji', 10);
            $table->char('khd_piket', 10);
            $table->char('poin_pelanggaran', 10);
            $table->char('tingkat_bacaan', 10);
            $table->char('tingkat_makna', 10);
            $table->char('hasil_ngaji', 5);
            $table->char('hasil_piket', 5);
            $table->char('hasil_pelanggaran', 5);
            $table->char('hasil_bacaan', 5);
            $table->char('hasil_makna', 5);
            $table->char('rata', 5);
            $table->char('kelompok_sementara', 10);
            $table->char('kelompok_hasil', 10);
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
        Schema::dropIfExists('santri');
    }
};
