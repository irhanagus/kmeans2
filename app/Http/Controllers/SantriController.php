<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\santri;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $dtsantri = santri::all();
        return view('santri.data_santri', compact('dtsantri'));
    }

    public function indexaktiv(){
        $aktivsantri = santri::all();
        return view('aktivitas.aktiv_santri', compact('aktivsantri'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('santri.tambah_santri');
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
            'jenis_kelamin' => $request->jenis_kelamin,
            'jenjang' => $request->jenjang,
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
        $santri = santri::finderfaill($id);
        return view('santri.edit_santri', compact('santri'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
