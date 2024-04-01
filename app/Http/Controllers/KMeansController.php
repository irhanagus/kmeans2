<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;

class KMeansController extends Controller
{
    public function atribut(){
        return view('kmeans.atribut');
    }

    public function preprocessing(){
        $aktivsantri = santri::all();
        return view('kmeans.preprocessing', compact('aktivsantri'));
    }

    public function iterasi1() {
        $aktivsantri = santri::all();
        $aktivsantriterbesar = santri::orderBy('rata', 'desc')->first();
        $aktivsantriterkecil = santri::orderBy('rata', 'asc')->first();
        $aktivsantritengah = santri::orderBy('rata')->skip(1)->first(); // Mengambil data kedua teratas untuk rata tidak besar dan tidak kecil

        // Looping data santri
        $santri = Santri::all();
        foreach ($santri as $santri) {
            // Hitung jarak antara santri saat ini dengan setiap kelompok
            $hasilC1 = sqrt(pow($santri->hasil_ngaji - $aktivsantriterbesar->hasil_ngaji, 2) +
                            pow($santri->hasil_piket - $aktivsantriterbesar->hasil_piket, 2) +
                            pow($santri->hasil_pelanggaran - $aktivsantriterbesar->hasil_pelanggaran, 2) +
                            pow($santri->hasil_bacaan - $aktivsantriterbesar->hasil_bacaan, 2) +
                            pow($santri->hasil_makna - $aktivsantriterbesar->hasil_makna, 2));

            $hasilC2 = sqrt(pow($santri->hasil_ngaji - $aktivsantritengah->hasil_ngaji, 2) +
                            pow($santri->hasil_piket - $aktivsantritengah->hasil_piket, 2) +
                            pow($santri->hasil_pelanggaran - $aktivsantritengah->hasil_pelanggaran, 2) +
                            pow($santri->hasil_bacaan - $aktivsantritengah->hasil_bacaan, 2) +
                            pow($santri->hasil_makna - $aktivsantritengah->hasil_makna, 2));

            $hasilC3 = sqrt(pow($santri->hasil_ngaji - $aktivsantriterkecil->hasil_ngaji, 2) +
                            pow($santri->hasil_piket - $aktivsantriterkecil->hasil_piket, 2) +
                            pow($santri->hasil_pelanggaran - $aktivsantriterkecil->hasil_pelanggaran, 2) +
                            pow($santri->hasil_bacaan - $aktivsantriterkecil->hasil_bacaan, 2) +
                            pow($santri->hasil_makna - $aktivsantriterkecil->hasil_makna, 2));

            // Tentukan kelompok sementara berdasarkan jarak terdekat
            $hasil = min($hasilC1, $hasilC2, $hasilC3);

            if ($hasil == $hasilC1) {
                $santri->kelompok_sementara = 1;
            } elseif ($hasil == $hasilC2) {
                $santri->kelompok_sementara = 2;
            } elseif ($hasil == $hasilC3) {
                $santri->kelompok_sementara = 3;
            } else {
                $santri->kelompok_sementara = 0;
            }

            // Simpan perubahan ke dalam database
            $santri->save();
        }

        $jumlah_dataC1 = santri::where('kelompok_sementara', 1)->count();
        $jumlah_dataC2 = santri::where('kelompok_sementara', 2)->count();
        $jumlah_dataC3 = santri::where('kelompok_sementara', 3)->count();

        return view('kmeans.iterasi1', compact('aktivsantri', 'aktivsantriterbesar', 'aktivsantritengah', 'aktivsantriterkecil', 'jumlah_dataC1', 'jumlah_dataC2', 'jumlah_dataC3'))->with('success', 'Kelompok sementara berhasil dihitung dan disimpan.');
    }

}
