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
            $table->string('khd_ngaji', 10);
            $table->string('khd_piket', 10);
            $table->string('poin_pelanggaran', 10);
            $table->string('tingkat_bacaan', 10);
            $table->string('tingkat_makna', 10);
            $table->string('hasil_ngaji', 5);
            $table->string('hasil_piket', 5);
            $table->string('hasil_pelanggaran', 5);
            $table->string('hasil_bacaan', 5);
            $table->string('hasil_makna', 5);
            $table->string('rata', 5);
            $table->string('kelompok_sementara', 10);
            $table->string('kelompok_hasil', 10);
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
