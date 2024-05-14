<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;
use Illuminate\Support\Facades\DB;

class KMeansController extends Controller
{
    public function atribut(){
        return view('kmeans.atribut');
    }

    public function preprocessing(){
        $aktivsantri = santri::paginate(10);
        return view('kmeans.preprocessing', compact('aktivsantri'));
    }

    public function hitungiterasi() {
        $aktivsantri = santri::all();
        $count_santri = santri::count();
        $tengah_santri = $count_santri / 2;

        $aktivsantriterbesar = santri::orderBy('rata', 'desc')->skip(14)->first();
        $aktivsantriterkecil = santri::orderBy('rata', 'asc')->first();
        $aktivsantritengah = santri::orderBy('rata', 'desc')->skip($tengah_santri)->first();

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

            if ($hasil == $hasilC3) {
                $santri->kelompok_hasil = 3;
            } elseif ($hasil == $hasilC2) {
                $santri->kelompok_hasil = 2;
            } elseif ($hasil == $hasilC1) {
                $santri->kelompok_hasil = 1;
            } else {
                $santri->kelompok_hasil = 0;
            }

            // Simpan perubahan ke dalam database
            $santri->save();
        }

        $jumlah_dataC1 = santri::where('kelompok_hasil', 1)->count();
        $jumlah_dataC2 = santri::where('kelompok_hasil', 2)->count();
        $jumlah_dataC3 = santri::where('kelompok_hasil', 3)->count();


        //MASUK KE ITERASI SELANJUTNYA
        $threshold = 1; // ambil sesuai kebutuhan
        $max_iter = 5; // ambil sesuai kebutuhan

        $iterasi_count = 1;
        do {
            $santri = santri::all();
            //pindahkan data kelompok_hasil ke kelompok_sementara
            Santri::whereNotNull('kelompok_hasil')
                ->update([
                    'kelompok_sementara' => \DB::raw('kelompok_hasil'),
                    'kelompok_hasil' => 0
                ]);

            $centroidbaru_1 = Santri::where('kelompok_sementara', 1)->get();
            $centroidbaru_2 = Santri::where('kelompok_sementara', 2)->get();
            $centroidbaru_3 = Santri::where('kelompok_sementara', 3)->get();

            // Hitung jumlah santri sesuai cluster sementara
            $jumlah_santri1 = $centroidbaru_1->count();
            $jumlah_santri2 = $centroidbaru_2->count();
            $jumlah_santri3 = $centroidbaru_3->count();

            // Hitung total hasil ngaji
            $total_hasil_ngaji1 = $centroidbaru_1->sum('hasil_ngaji');
            $total_hasil_ngaji2 = $centroidbaru_2->sum('hasil_ngaji');
            $total_hasil_ngaji3 = $centroidbaru_3->sum('hasil_ngaji');

            // Hitung total hasil piket
            $total_hasil_piket1 = $centroidbaru_1->sum('hasil_piket');
            $total_hasil_piket2 = $centroidbaru_2->sum('hasil_piket');
            $total_hasil_piket3 = $centroidbaru_3->sum('hasil_piket');

            // Hitung total hasil pelanggaran
            $total_hasil_pelanggaran1 = $centroidbaru_1->sum('hasil_pelanggaran');
            $total_hasil_pelanggaran2 = $centroidbaru_2->sum('hasil_pelanggaran');
            $total_hasil_pelanggaran3 = $centroidbaru_3->sum('hasil_pelanggaran');

            // Hitung total hasil bacaan
            $total_hasil_bacaan1 = $centroidbaru_1->sum('hasil_bacaan');
            $total_hasil_bacaan2 = $centroidbaru_2->sum('hasil_bacaan');
            $total_hasil_bacaan3 = $centroidbaru_3->sum('hasil_bacaan');

            // Hitung total hasil makna
            $total_hasil_makna1 = $centroidbaru_1->sum('hasil_makna');
            $total_hasil_makna2 = $centroidbaru_2->sum('hasil_makna');
            $total_hasil_makna3 = $centroidbaru_3->sum('hasil_makna');

            // Hitung rata-rata hasil ngaji
            $rata_rata_ngaji1 = $jumlah_santri1 > 0 ? $total_hasil_ngaji1 / $jumlah_santri1 : 0;
            $rata_rata_ngaji2 = $jumlah_santri2 > 0 ? $total_hasil_ngaji2 / $jumlah_santri2 : 0;
            $rata_rata_ngaji3 = $jumlah_santri3 > 0 ? $total_hasil_ngaji3 / $jumlah_santri3 : 0;

            // Hitung rata-rata hasil piket
            $rata_rata_piket1 = $jumlah_santri1 > 0 ? $total_hasil_piket1 / $jumlah_santri1 : 0;
            $rata_rata_piket2 = $jumlah_santri2 > 0 ? $total_hasil_piket2 / $jumlah_santri2 : 0;
            $rata_rata_piket3 = $jumlah_santri3 > 0 ? $total_hasil_piket3 / $jumlah_santri3 : 0;

            // Hitung rata-rata hasil pelanggaran
            $rata_rata_pelanggaran1 = $jumlah_santri1 > 0 ? $total_hasil_pelanggaran1 / $jumlah_santri1 : 0;
            $rata_rata_pelanggaran2 = $jumlah_santri2 > 0 ? $total_hasil_pelanggaran2 / $jumlah_santri2 : 0;
            $rata_rata_pelanggaran3 = $jumlah_santri3 > 0 ? $total_hasil_pelanggaran3 / $jumlah_santri3 : 0;

            // Hitung rata-rata hasil bacaan
            $rata_rata_bacaan1 = $jumlah_santri1 > 0 ? $total_hasil_bacaan1 / $jumlah_santri1 : 0;
            $rata_rata_bacaan2 = $jumlah_santri2 > 0 ? $total_hasil_bacaan2 / $jumlah_santri2 : 0;
            $rata_rata_bacaan3 = $jumlah_santri3 > 0 ? $total_hasil_bacaan3 / $jumlah_santri3 : 0;

            // Hitung rata-rata hasil bacaan
            $rata_rata_makna1 = $jumlah_santri1 > 0 ? $total_hasil_makna1 / $jumlah_santri1 : 0;
            $rata_rata_makna2 = $jumlah_santri2 > 0 ? $total_hasil_makna2 / $jumlah_santri2 : 0;
            $rata_rata_makna3 = $jumlah_santri3 > 0 ? $total_hasil_makna3 / $jumlah_santri3 : 0;


            // Looping data santri
            $santri = Santri::all();
            foreach ($santri as $santri) {
                // Hitung jarak antara santri saat ini dengan setiap kelompok
                $hasilC1 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji1, 2) +
                                pow($santri->hasil_piket - $rata_rata_piket1, 2) +
                                pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran1, 2) +
                                pow($santri->hasil_bacaan - $rata_rata_bacaan1, 2) +
                                pow($santri->hasil_makna - $rata_rata_makna1, 2));

                $hasilC2 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji2, 2) +
                                pow($santri->hasil_piket - $rata_rata_piket2, 2) +
                                pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran2, 2) +
                                pow($santri->hasil_bacaan - $rata_rata_bacaan2, 2) +
                                pow($santri->hasil_makna - $rata_rata_makna2, 2));

                $hasilC3 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji3, 2) +
                                pow($santri->hasil_piket - $rata_rata_piket3, 2) +
                                pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran3, 2) +
                                pow($santri->hasil_bacaan - $rata_rata_bacaan3, 2) +
                                pow($santri->hasil_makna - $rata_rata_makna3, 2));

                // Tentukan kelompok sementara berdasarkan jarak terdekat
                $hasil = min($hasilC1, $hasilC2, $hasilC3);

                if ($hasil == $hasilC3) {
                    $santri->kelompok_hasil = 3;
                } elseif ($hasil == $hasilC2) {
                    $santri->kelompok_hasil = 2;
                } elseif ($hasil == $hasilC1) {
                    $santri->kelompok_hasil = 1;
                } else {
                    $santri->kelompok_hasil = 0;
                }

                // Simpan perubahan ke dalam database
                $santri->save();
            }

            $jumlah_dataC1_sebelumnya = santri::where('kelompok_sementara', 1)->count();
            $jumlah_dataC2_sebelumnya = santri::where('kelompok_sementara', 2)->count();
            $jumlah_dataC3_sebelumnya = santri::where('kelompok_sementara', 3)->count();

            $jumlah_dataC1_sekarang = santri::where('kelompok_hasil', 1)->count();
            $jumlah_dataC2_sekarang = santri::where('kelompok_hasil', 2)->count();
            $jumlah_dataC3_sekarang = santri::where('kelompok_hasil', 3)->count();

            $iterasi_count++;

            if ($jumlah_dataC1_sebelumnya == $jumlah_dataC1_sekarang && $jumlah_dataC2_sebelumnya == $jumlah_dataC2_sekarang && $jumlah_dataC3_sebelumnya == $jumlah_dataC3_sekarang) {
                break;
            } elseif ($iterasi_count == $max_iter) {
                break;
            }

        } while ($this->checkConvergence());

        return view('kmeans.iterasi', compact('aktivsantri',
            'rata_rata_ngaji1', 'rata_rata_ngaji2', 'rata_rata_ngaji3', 'rata_rata_piket1', 'rata_rata_piket2', 'rata_rata_piket3',
            'rata_rata_pelanggaran1', 'rata_rata_pelanggaran2', 'rata_rata_pelanggaran3', 'rata_rata_bacaan1', 'rata_rata_bacaan2', 'rata_rata_bacaan3',
            'rata_rata_makna1', 'rata_rata_makna2', 'rata_rata_makna3', 'hasilC1', 'hasilC2', 'hasilC3',
            'iterasi_count'
        ));

    }

    private function checkConvergence()
    {
        // Periksa apakah semua kelompok_hasil sama dengan kelompok_sementara
        return Santri::whereColumn('kelompok_hasil', 'kelompok_sementara')->exists();
    }


    public function iterasi1() {
        $aktivsantri = santri::all();
        $dtsantri = santri::paginate(10);
        $count_santri = santri::count();
        $tengah_santri = $count_santri / 2;

        $aktivsantriterbesar = santri::orderBy('rata', 'desc')->skip(14)->first();
        $aktivsantriterkecil = santri::orderBy('rata', 'asc')->first();
        $aktivsantritengah = santri::orderBy('rata', 'desc')->skip($tengah_santri)->first();

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
                $santri->kelompok_hasil = 1;
            } elseif ($hasil == $hasilC2) {
                $santri->kelompok_hasil = 2;
            } elseif ($hasil == $hasilC3) {
                $santri->kelompok_hasil = 3;
            } else {
                $santri->kelompok_hasil = 0;
            }

            // Simpan perubahan ke dalam database
            $santri->save();
        }

        $jumlah_dataC1 = santri::where('kelompok_hasil', 1)->count();
        $jumlah_dataC2 = santri::where('kelompok_hasil', 2)->count();
        $jumlah_dataC3 = santri::where('kelompok_hasil', 3)->count();

        return view('kmeans.iterasi1', compact('aktivsantri', 'dtsantri', 'aktivsantriterbesar', 'aktivsantritengah', 'aktivsantriterkecil', 'jumlah_dataC1', 'jumlah_dataC2', 'jumlah_dataC3'))->with('success', 'Kelompok sementara berhasil dihitung dan disimpan.');
    }

    public function iterasi2() {
        $aktivsantri = santri::all();
        $dtsantri = santri::paginate(10);

        Santri::whereNotNull('kelompok_hasil')
               ->update([
                   'kelompok_sementara' => \DB::raw('kelompok_hasil'),
                   'kelompok_hasil' => 0
               ]);

        $centroidbaru_1 = Santri::where('kelompok_sementara', 1)->get();
        $centroidbaru_2 = Santri::where('kelompok_sementara', 2)->get();
        $centroidbaru_3 = Santri::where('kelompok_sementara', 3)->get();

        // Hitung jumlah santri sesuai cluster sementara
        $jumlah_santri1 = $centroidbaru_1->count();
        $jumlah_santri2 = $centroidbaru_2->count();
        $jumlah_santri3 = $centroidbaru_3->count();

        // Hitung total hasil ngaji
        $total_hasil_ngaji1 = $centroidbaru_1->sum('hasil_ngaji');
        $total_hasil_ngaji2 = $centroidbaru_2->sum('hasil_ngaji');
        $total_hasil_ngaji3 = $centroidbaru_3->sum('hasil_ngaji');

        // Hitung total hasil piket
        $total_hasil_piket1 = $centroidbaru_1->sum('hasil_piket');
        $total_hasil_piket2 = $centroidbaru_2->sum('hasil_piket');
        $total_hasil_piket3 = $centroidbaru_3->sum('hasil_piket');

        // Hitung total hasil pelanggaran
        $total_hasil_pelanggaran1 = $centroidbaru_1->sum('hasil_pelanggaran');
        $total_hasil_pelanggaran2 = $centroidbaru_2->sum('hasil_pelanggaran');
        $total_hasil_pelanggaran3 = $centroidbaru_3->sum('hasil_pelanggaran');

        // Hitung total hasil bacaan
        $total_hasil_bacaan1 = $centroidbaru_1->sum('hasil_bacaan');
        $total_hasil_bacaan2 = $centroidbaru_2->sum('hasil_bacaan');
        $total_hasil_bacaan3 = $centroidbaru_3->sum('hasil_bacaan');

        // Hitung total hasil makna
        $total_hasil_makna1 = $centroidbaru_1->sum('hasil_makna');
        $total_hasil_makna2 = $centroidbaru_2->sum('hasil_makna');
        $total_hasil_makna3 = $centroidbaru_3->sum('hasil_makna');

        // Hitung rata-rata hasil ngaji
        $rata_rata_ngaji1 = $total_hasil_ngaji1 / $jumlah_santri1;
        $rata_rata_ngaji2 = $total_hasil_ngaji2 / $jumlah_santri2;
        $rata_rata_ngaji3 = $total_hasil_ngaji3 / $jumlah_santri3;

        // Hitung rata-rata hasil piket
        $rata_rata_piket1 = $total_hasil_piket1 / $jumlah_santri1;
        $rata_rata_piket2 = $total_hasil_piket2 / $jumlah_santri2;
        $rata_rata_piket3 = $total_hasil_piket3 / $jumlah_santri3;

        // Hitung rata-rata hasil pelanggaran
        $rata_rata_pelanggaran1 = $total_hasil_pelanggaran1 / $jumlah_santri1;
        $rata_rata_pelanggaran2 = $total_hasil_pelanggaran2 / $jumlah_santri2;
        $rata_rata_pelanggaran3 = $total_hasil_pelanggaran3 / $jumlah_santri3;

        // Hitung rata-rata hasil bacaan
        $rata_rata_bacaan1 = $total_hasil_bacaan1 / $jumlah_santri1;
        $rata_rata_bacaan2 = $total_hasil_bacaan2 / $jumlah_santri2;
        $rata_rata_bacaan3 = $total_hasil_bacaan3 / $jumlah_santri3;

        // Hitung rata-rata hasil bacaan
        $rata_rata_makna1 = $total_hasil_makna1 / $jumlah_santri1;
        $rata_rata_makna2 = $total_hasil_makna2 / $jumlah_santri2;
        $rata_rata_makna3 = $total_hasil_makna3 / $jumlah_santri3;


        // Looping data santri
        $santri = Santri::all();
        foreach ($santri as $santri) {
            // Hitung jarak antara santri saat ini dengan setiap kelompok
            $hasilC1 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji1, 2) +
                            pow($santri->hasil_piket - $rata_rata_piket1, 2) +
                            pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran1, 2) +
                            pow($santri->hasil_bacaan - $rata_rata_bacaan1, 2) +
                            pow($santri->hasil_makna - $rata_rata_makna1, 2));

            $hasilC2 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji2, 2) +
                            pow($santri->hasil_piket - $rata_rata_piket2, 2) +
                            pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran2, 2) +
                            pow($santri->hasil_bacaan - $rata_rata_bacaan2, 2) +
                            pow($santri->hasil_makna - $rata_rata_makna2, 2));

            $hasilC3 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji3, 2) +
                            pow($santri->hasil_piket - $rata_rata_piket3, 2) +
                            pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran3, 2) +
                            pow($santri->hasil_bacaan - $rata_rata_bacaan3, 2) +
                            pow($santri->hasil_makna - $rata_rata_makna3, 2));

            // Tentukan kelompok sementara berdasarkan jarak terdekat
            $hasil = min($hasilC1, $hasilC2, $hasilC3);

            if ($hasil == $hasilC1) {
                $santri->kelompok_hasil = 1;
            } elseif ($hasil == $hasilC2) {
                $santri->kelompok_hasil = 2;
            } elseif ($hasil == $hasilC3) {
                $santri->kelompok_hasil = 3;
            } else {
                $santri->kelompok_hasil = 0;
            }

            // Simpan perubahan ke dalam database
            $santri->save();
        }

        $jumlah_dataC1_sebelumnya = santri::where('kelompok_sementara', 1)->count();
        $jumlah_dataC2_sebelumnya = santri::where('kelompok_sementara', 2)->count();
        $jumlah_dataC3_sebelumnya = santri::where('kelompok_sementara', 3)->count();

        $jumlah_dataC1_sekarang = santri::where('kelompok_hasil', 1)->count();
        $jumlah_dataC2_sekarang = santri::where('kelompok_hasil', 2)->count();
        $jumlah_dataC3_sekarang = santri::where('kelompok_hasil', 3)->count();

        return view('kmeans.iterasi2', compact('aktivsantri', 'dtsantri',
            'rata_rata_ngaji1', 'rata_rata_ngaji2', 'rata_rata_ngaji3', 'rata_rata_piket1', 'rata_rata_piket2', 'rata_rata_piket3',
            'rata_rata_pelanggaran1', 'rata_rata_pelanggaran2', 'rata_rata_pelanggaran3', 'rata_rata_bacaan1', 'rata_rata_bacaan2', 'rata_rata_bacaan3',
            'rata_rata_makna1', 'rata_rata_makna2', 'rata_rata_makna3', 'hasilC1', 'hasilC2', 'hasilC3',
            'jumlah_dataC1_sebelumnya', 'jumlah_dataC2_sebelumnya', 'jumlah_dataC3_sebelumnya',
            'jumlah_dataC1_sekarang', 'jumlah_dataC2_sekarang', 'jumlah_dataC3_sekarang'
        ));
    }

    public function iterasiAkhir() {
        $aktivsantri = santri::all();
        $dtsantri = santri::paginate(10);
        $count_santri = santri::count();
        $tengah_santri = $count_santri / 2;

        $aktivsantriterbesar = santri::orderBy('rata', 'desc')->skip(14)->first();
        $aktivsantriterkecil = santri::orderBy('rata', 'asc')->first();
        $aktivsantritengah = santri::orderBy('rata', 'desc')->skip($tengah_santri)->first();

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

            if ($hasil == $hasilC3) {
                $santri->kelompok_hasil = 3;
            } elseif ($hasil == $hasilC2) {
                $santri->kelompok_hasil = 2;
            } elseif ($hasil == $hasilC1) {
                $santri->kelompok_hasil = 1;
            } else {
                $santri->kelompok_hasil = 0;
            }

            // Simpan perubahan ke dalam database
            $santri->save();
        }

        $jumlah_dataC1 = santri::where('kelompok_hasil', 1)->count();
        $jumlah_dataC2 = santri::where('kelompok_hasil', 2)->count();
        $jumlah_dataC3 = santri::where('kelompok_hasil', 3)->count();


        //MASUK KE ITERASI SELANJUTNYA
        $threshold = 1; // ambil sesuai kebutuhan
        $max_iter = 5; // ambil sesuai kebutuhan

        $iterasi_count = 1;
        do {
            $santri = santri::all();
            //pindahkan data kelompok_hasil ke kelompok_sementara
            Santri::whereNotNull('kelompok_hasil')
                ->update([
                    'kelompok_sementara' => \DB::raw('kelompok_hasil'),
                    'kelompok_hasil' => 0
                ]);

            $centroidbaru_1 = Santri::where('kelompok_sementara', 1)->get();
            $centroidbaru_2 = Santri::where('kelompok_sementara', 2)->get();
            $centroidbaru_3 = Santri::where('kelompok_sementara', 3)->get();

            // Hitung jumlah santri sesuai cluster sementara
            $jumlah_santri1 = $centroidbaru_1->count();
            $jumlah_santri2 = $centroidbaru_2->count();
            $jumlah_santri3 = $centroidbaru_3->count();

            // Hitung total hasil ngaji
            $total_hasil_ngaji1 = $centroidbaru_1->sum('hasil_ngaji');
            $total_hasil_ngaji2 = $centroidbaru_2->sum('hasil_ngaji');
            $total_hasil_ngaji3 = $centroidbaru_3->sum('hasil_ngaji');

            // Hitung total hasil piket
            $total_hasil_piket1 = $centroidbaru_1->sum('hasil_piket');
            $total_hasil_piket2 = $centroidbaru_2->sum('hasil_piket');
            $total_hasil_piket3 = $centroidbaru_3->sum('hasil_piket');

            // Hitung total hasil pelanggaran
            $total_hasil_pelanggaran1 = $centroidbaru_1->sum('hasil_pelanggaran');
            $total_hasil_pelanggaran2 = $centroidbaru_2->sum('hasil_pelanggaran');
            $total_hasil_pelanggaran3 = $centroidbaru_3->sum('hasil_pelanggaran');

            // Hitung total hasil bacaan
            $total_hasil_bacaan1 = $centroidbaru_1->sum('hasil_bacaan');
            $total_hasil_bacaan2 = $centroidbaru_2->sum('hasil_bacaan');
            $total_hasil_bacaan3 = $centroidbaru_3->sum('hasil_bacaan');

            // Hitung total hasil makna
            $total_hasil_makna1 = $centroidbaru_1->sum('hasil_makna');
            $total_hasil_makna2 = $centroidbaru_2->sum('hasil_makna');
            $total_hasil_makna3 = $centroidbaru_3->sum('hasil_makna');

            // Hitung rata-rata hasil ngaji
            $rata_rata_ngaji1 = $jumlah_santri1 > 0 ? $total_hasil_ngaji1 / $jumlah_santri1 : 0;
            $rata_rata_ngaji2 = $jumlah_santri2 > 0 ? $total_hasil_ngaji2 / $jumlah_santri2 : 0;
            $rata_rata_ngaji3 = $jumlah_santri3 > 0 ? $total_hasil_ngaji3 / $jumlah_santri3 : 0;

            // Hitung rata-rata hasil piket
            $rata_rata_piket1 = $jumlah_santri1 > 0 ? $total_hasil_piket1 / $jumlah_santri1 : 0;
            $rata_rata_piket2 = $jumlah_santri2 > 0 ? $total_hasil_piket2 / $jumlah_santri2 : 0;
            $rata_rata_piket3 = $jumlah_santri3 > 0 ? $total_hasil_piket3 / $jumlah_santri3 : 0;

            // Hitung rata-rata hasil pelanggaran
            $rata_rata_pelanggaran1 = $jumlah_santri1 > 0 ? $total_hasil_pelanggaran1 / $jumlah_santri1 : 0;
            $rata_rata_pelanggaran2 = $jumlah_santri2 > 0 ? $total_hasil_pelanggaran2 / $jumlah_santri2 : 0;
            $rata_rata_pelanggaran3 = $jumlah_santri3 > 0 ? $total_hasil_pelanggaran3 / $jumlah_santri3 : 0;

            // Hitung rata-rata hasil bacaan
            $rata_rata_bacaan1 = $jumlah_santri1 > 0 ? $total_hasil_bacaan1 / $jumlah_santri1 : 0;
            $rata_rata_bacaan2 = $jumlah_santri2 > 0 ? $total_hasil_bacaan2 / $jumlah_santri2 : 0;
            $rata_rata_bacaan3 = $jumlah_santri3 > 0 ? $total_hasil_bacaan3 / $jumlah_santri3 : 0;

            // Hitung rata-rata hasil bacaan
            $rata_rata_makna1 = $jumlah_santri1 > 0 ? $total_hasil_makna1 / $jumlah_santri1 : 0;
            $rata_rata_makna2 = $jumlah_santri2 > 0 ? $total_hasil_makna2 / $jumlah_santri2 : 0;
            $rata_rata_makna3 = $jumlah_santri3 > 0 ? $total_hasil_makna3 / $jumlah_santri3 : 0;


            // Looping data santri
            $santri = Santri::all();
            foreach ($santri as $santri) {
                // Hitung jarak antara santri saat ini dengan setiap kelompok
                $hasilC1 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji1, 2) +
                                pow($santri->hasil_piket - $rata_rata_piket1, 2) +
                                pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran1, 2) +
                                pow($santri->hasil_bacaan - $rata_rata_bacaan1, 2) +
                                pow($santri->hasil_makna - $rata_rata_makna1, 2));

                $hasilC2 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji2, 2) +
                                pow($santri->hasil_piket - $rata_rata_piket2, 2) +
                                pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran2, 2) +
                                pow($santri->hasil_bacaan - $rata_rata_bacaan2, 2) +
                                pow($santri->hasil_makna - $rata_rata_makna2, 2));

                $hasilC3 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji3, 2) +
                                pow($santri->hasil_piket - $rata_rata_piket3, 2) +
                                pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran3, 2) +
                                pow($santri->hasil_bacaan - $rata_rata_bacaan3, 2) +
                                pow($santri->hasil_makna - $rata_rata_makna3, 2));

                // Tentukan kelompok sementara berdasarkan jarak terdekat
                $hasil = min($hasilC1, $hasilC2, $hasilC3);

                if ($hasil == $hasilC3) {
                    $santri->kelompok_hasil = 3;
                } elseif ($hasil == $hasilC2) {
                    $santri->kelompok_hasil = 2;
                } elseif ($hasil == $hasilC1) {
                    $santri->kelompok_hasil = 1;
                } else {
                    $santri->kelompok_hasil = 0;
                }

                // Simpan perubahan ke dalam database
                $santri->save();
            }

            $jumlah_dataC1_sebelumnya = santri::where('kelompok_sementara', 1)->count();
            $jumlah_dataC2_sebelumnya = santri::where('kelompok_sementara', 2)->count();
            $jumlah_dataC3_sebelumnya = santri::where('kelompok_sementara', 3)->count();

            $jumlah_dataC1_sekarang = santri::where('kelompok_hasil', 1)->count();
            $jumlah_dataC2_sekarang = santri::where('kelompok_hasil', 2)->count();
            $jumlah_dataC3_sekarang = santri::where('kelompok_hasil', 3)->count();

            $iterasi_count++;

            if ($jumlah_dataC1_sebelumnya == $jumlah_dataC1_sekarang && $jumlah_dataC2_sebelumnya == $jumlah_dataC2_sekarang && $jumlah_dataC3_sebelumnya == $jumlah_dataC3_sekarang) {
                break;
            } elseif ($iterasi_count == $max_iter) {
                break;
            }

        } while ($this->checkConvergence2());

        return view('kmeans.iterasiAkhir', compact('aktivsantri', 'dtsantri',
            'rata_rata_ngaji1', 'rata_rata_ngaji2', 'rata_rata_ngaji3', 'rata_rata_piket1', 'rata_rata_piket2', 'rata_rata_piket3',
            'rata_rata_pelanggaran1', 'rata_rata_pelanggaran2', 'rata_rata_pelanggaran3', 'rata_rata_bacaan1', 'rata_rata_bacaan2', 'rata_rata_bacaan3',
            'rata_rata_makna1', 'rata_rata_makna2', 'rata_rata_makna3', 'hasilC1', 'hasilC2', 'hasilC3',
            'jumlah_dataC1_sebelumnya', 'jumlah_dataC2_sebelumnya', 'jumlah_dataC3_sebelumnya',
            'jumlah_dataC1_sekarang', 'jumlah_dataC2_sekarang', 'jumlah_dataC3_sekarang', 'iterasi_count'
        ));

    }

    private function checkConvergence2()
    {
        // Periksa apakah semua kelompok_hasil sama dengan kelompok_sementara
        return Santri::whereColumn('kelompok_hasil', 'kelompok_sementara')->exists();
    }

    public function resetperhitungan() {
        $santri = santri::all();
        Santri::whereNotNull('kelompok_hasil')
               ->update([
                   'kelompok_sementara' => 0,
                   'kelompok_hasil' => 0
               ]);

        return view('kmeans.resetperhitungan', compact(
            'santri'
        ));
    }
}
