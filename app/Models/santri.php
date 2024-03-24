<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class santri extends Model
{
    use HasFactory;

    protected $table = "santri";
    protected $primarykey = "id";
    protected $fillable = [
        'id','nis','nama','jenis_kelamin','jenjang','alamat','khd_ngaji','khd_piket','poin_pelanggaran','tingkat_bacaan','tingkat_makna','hasil_ngaji','hasil_piket','hasil_pelanggaran','hasil_bacaan','hasil_makna','rata','kelompok_sementara','kelompok_hasil',
    ];
}
