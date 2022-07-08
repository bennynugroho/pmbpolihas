<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SeleksiExport;
use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\Seleksi;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SeleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $tahun_akademik = TahunAkademik::all();

        if($request->tahun_akademik){
            $tahun_id = $request->tahun_akademik;
        }else{
            $tahun_id = $tahun_akademik->where('status', 1)->first()->id;
        }

        $seleksi_id = Seleksi::pluck('daftar_id')->toArray();

        $data = [
            'tahun_akademik' => $tahun_akademik,
            'tahun_id' => $tahun_id,
            'seleksi' => Seleksi::with(['daftar', 'daftar.jalur','tahun_akademik'])->where('thn_akd_id', $tahun_id)->get(),
            'pendaftar' => Pendaftar::where('thn_akd_id', $tahun_id)->whereNotIn('id', $seleksi_id)->get(),
        ];

        return view('admin.seleksi', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        if($request->berkas == 'tidak'){
            $ket_berkas = $request->text_berkas;
        }else{
            $ket_berkas = null;
        }

        Seleksi::create([
            'daftar_id'         => $request->daftar_id,
            'thn_akd_id'        => $request->tahun_id,
            'no_pendaftaran'    => $request->no_pendaftaran,
            'ket_berkas'        => $ket_berkas
        ]);

        return back()->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seleksi  $seleksi
     * @return \Illuminate\Http\Response
     */
    public function show(Seleksi $seleksi)
    {
        //
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seleksi  $seleksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Seleksi $seleksi)
    {
        $seleksi = $seleksi->load(['daftar', 'tahun_akademik']);

        return response()->json($seleksi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seleksi  $seleksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seleksi $seleksi)
    {
        $seleksi->update([
            'daftar_id'      => $request->daftar_id,
            'thn_akd_id'     => $request->tahun_id,
            'no_pendaftaran' => $request->no_pendaftaran,
            'ket_berkas'     => $request->text_berkas,
        ]);

        return back()->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seleksi  $seleksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seleksi $seleksi)
    {
        $seleksi->delete();

        return 'Data berhasil dihapus';
    }

    public function export_seleksi()
    {
        return Excel::download(new SeleksiExport, 'Seleksi.xlsx');
    }
}
