<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_Kelamin extends Model
{
    use HasFactory;

    protected $table = "jenis_kelamin";
    protected $primarykey = "id";
    protected $fillable = ['id','jenis_kelamin'];

    public function santri(){
        return $this->hasMany(santri::class);
    }
}
