<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    use HasFactory;

    protected $table = "jenjang";
    protected $primarykey = "id";
    protected $fillable = ['id','jenjang'];

    public function santri(){
        return $this->hasMany(santri::class);
    }
}
