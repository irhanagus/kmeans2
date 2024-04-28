<?php

namespace App\Http\Controllers;

use App\Models\santri;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $jumlah_santri = santri::count();
        $jumlah_dataC1 = santri::where('kelompok_hasil', 1)->count();
        $jumlah_dataC2 = santri::where('kelompok_hasil', 2)->count();
        $jumlah_dataC3 = santri::where('kelompok_hasil', 3)->count();
        return view('home', compact('jumlah_santri', 'jumlah_dataC1', 'jumlah_dataC2', 'jumlah_dataC3'));
    }

}
