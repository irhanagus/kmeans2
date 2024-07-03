<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;
use App\Models\Jenjang;
use App\Models\Jenis_Kelamin;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $dtsantri = santri::with('jk','jenjang')->orderBy('updated_at', 'desc')->paginate(50);
        return view('santri.data_santri', compact('dtsantri'));
    }

    public function indexaktiv(){
        $aktivsantri = santri::paginate(50);
        return view('aktivitas.aktiv_santri', compact('aktivsantri'));
    }

    public function hasilSantri(){
        $dtsantri = santri::with('jk','jenjang')->orderBy('nis','asc')->paginate(50);
        return view('aktivitas.hasil_santri', compact('dtsantri'));
    }

    public function cetakHasil(){
        $dtsantri = santri::with('jk','jenjang')->orderBy('nis','asc')->get();
        return view('aktivitas.cetak_hasil', compact('dtsantri'));
    }

    public function hasilCluster(){
        $dtsantri = santri::with('jk','jenjang')->orderBy('kelompok_hasil','asc')->paginate(50);
        return view('aktivitas.hasil_cluster', compact('dtsantri'));
    }

    public function cetakCluster(){
        $dtsantri = santri::with('jk','jenjang')->orderBy('kelompok_hasil','asc')->get();
        return view('aktivitas.cetak_cluster', compact('dtsantri'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jk = Jenis_Kelamin::all();
        $jen = Jenjang::all();
        return view('santri.tambah_santri', compact('jen','jk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        santri::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jk_id' => $request->jk_id,
            'jenjang_id' => $request->jenjang_id,
            'alamat' => $request->alamat,
            'khd_ngaji' => $request->khd_ngaji ?? '0',
            'khd_piket' => $request->khd_piket ?? '0',
            'poin_pelanggaran' => $request->poin_pelanggaran ?? '0',
            'tingkat_bacaan' => $request->tingkat_bacaan ?? '0',
            'tingkat_makna' => $request->tingkat_makna ?? '0',
            'hasil_ngaji' => $request->hasil_ngaji ?? '0',
            'hasil_piket' => $request->hasil_piket ?? '0',
            'hasil_pelanggaran' => $request->hasil_pelanggaran ?? '0',
            'hasil_bacaan' => $request->hasil_bacaan ?? '0',
            'hasil_makna' => $request->hasil_makna ?? '0',
            'rata' => $request->rata ?? '0',
            'kelompok_sementara' => $request->kelompok_sementara ?? '0',
            'kelompok_hasil' => $request->kelompok_hasil ?? '0',
        ]);

        return redirect('data-santri')->with('toast_success', 'Data Berhasil Tersimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jk = Jenis_Kelamin::all();
        $jen = Jenjang::all();
        $santri = santri::findOrfail($id);
        return view('santri.edit_santri',compact('santri','jk','jen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editaktiv($id)
    {
        $santri = santri::findOrfail($id);
        return view('aktivitas.editaktiv_santri',compact('santri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $santri = santri::findOrfail($id);
        $santri->update($request->all());
        return redirect('data-santri')->with('toast_success', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateaktiv(Request $request, $id)
    {
        // Temukan santri berdasarkan ID
        $santri = Santri::findOrFail($id);

        // Update atribut santri dengan data yang diterima dari request
        $santri->update($request->all());

        // Lakukan perhitungan hasil ngaji
        $hasil_ngaji = $this->hitungHasilNgaji($santri->khd_ngaji);

        // Lakukan perhitungan hasil piket
        $hasil_piket = $this->hitungHasilPiket($santri->khd_piket);

        // Lakukan perhitungan hasil pelanggaran
        $hasil_pelanggaran = $this->hitungHasilPelanggaran($santri->poin_pelanggaran);

        // Lakukan perhitungan hasil bacaan
        $hasil_bacaan = $this->hitungHasilBacaan($santri->tingkat_bacaan);

        // Lakukan perhitungan hasil makna
        $hasil_makna = $this->hitungHasilMakna($santri->tingkat_makna);

        // Simpan hasil ke dalam database
        $santri->hasil_ngaji = $hasil_ngaji;
        $santri->hasil_piket = $hasil_piket;
        $santri->hasil_pelanggaran = $hasil_pelanggaran;
        $santri->hasil_bacaan = $hasil_bacaan;
        $santri->hasil_makna = $hasil_makna;

        // Hitung rata-rata dari hasil-ngaji, hasil-piket, hasil-pelanggaran, hasil-bacaan, dan hasil-makna
        $rata = ($hasil_ngaji + $hasil_piket + $hasil_pelanggaran + $hasil_bacaan + $hasil_makna) / 5;

        // Simpan rata-rata ke dalam atribut santri
        $santri->rata = $rata;

        // Simpan perubahan ke dalam database
        $santri->save();

        return redirect('aktiv-santri')->with('toast_success', 'Data Berhasil Diupdate');
    }

    // Metode untuk menghitung hasil ngaji
    private function hitungHasilNgaji($khd_ngaji)
    {
        if ($khd_ngaji >= 81) {
            return 1.0;
        } elseif ($khd_ngaji >= 61) {
            return 0.8;
        } elseif ($khd_ngaji >= 41) {
            return 0.6;
        } elseif ($khd_ngaji >= 21) {
            return 0.4;
        } else {
            return 0.2;
        }
    }

    // Metode untuk menghitung hasil piket
    private function hitungHasilPiket($khd_piket)
    {
        if ($khd_piket >= 81) {
            return 1.0;
        } elseif ($khd_piket >= 61) {
            return 0.8;
        } elseif ($khd_piket >= 41) {
            return 0.6;
        } elseif ($khd_piket >= 21) {
            return 0.4;
        } else {
            return 0.2;
        }
    }

    // Metode untuk menghitung hasil pelanggaran
    private function hitungHasilPelanggaran($poin_pelanggaran)
    {
        if ($poin_pelanggaran <= 200) {
            return 1.0;
        } elseif ($poin_pelanggaran <= 400) {
            return 0.8;
        } elseif ($poin_pelanggaran <= 600) {
            return 0.6;
        } elseif ($poin_pelanggaran <= 800) {
            return 0.4;
        } else {
            return 0.2;
        }
    }

    // Metode untuk menghitung hasil bacaan
    private function hitungHasilBacaan($tingkat_bacaan)
    {
        switch ($tingkat_bacaan) {
            case "Tahsin":
                return 1.0;
            case 4:
                return 0.8;
            case 3:
                return 0.6;
            case 2:
                return 0.4;
            case 1:
                return 0.2;
            default:
                return 0.0;
        }
    }

    // Metode untuk menghitung hasil makna
    private function hitungHasilMakna($tingkat_makna)
    {
        switch ($tingkat_makna) {
            case "Al-Idlafi":
                return 1.0;
            case "Al-Sarii":
                return 0.75;
            case "At-Taanni":
                return 0.5;
            case "Kitabah":
                return 0.25;
            default:
                return 0.0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $santri = santri::findOrfail($id);
        $santri->delete();
        return back()->with('info', 'Data Berhasil Dihapus');
    }

    public function destroyaktiv($id)
    {
        $santri = santri::findOrfail($id);
        $santri->update([
            'khd_ngaji' => '0',
            'khd_piket' => '0',
            'poin_pelanggaran' => '0',
            'tingkat_bacaan' => '0',
            'tingkat_makna' => '0',
        ]);

        return back()->with('info', 'Data Berhasil Dibersihkan');
    }
}
