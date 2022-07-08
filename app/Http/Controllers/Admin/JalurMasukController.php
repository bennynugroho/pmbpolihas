<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JalurMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JalurMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'jalur' => JalurMasuk::all(),
        ];

        return view('admin.jalur.jalur_masuk', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = '
            <div class="mb-3">
                <label for="judul" class="form-label">Nama</label>
                <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan nama jalur masuk" required>
            </div>
            <div class="mb-3">
                <label for="tgl_akhir" class="form-label">Tanggal Berakhir</label>
                <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="Masukkan tanggal" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Masukkan keterangan jalur masuk" required></textarea>
            </div>
        ';

        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $foto = $request->file('foto');
        $foto->storeAs('public/jalur/', $foto->hashName());

        JalurMasuk::create([
            'judul'      => $request->judul,
            'keterangan' => $request->keterangan,
            'tgl_akhir'  => $request->tgl_akhir,
            'foto'       => $foto->hashName(),
        ]);

        return back()->with('success', 'Jalur masuk berhasil ditambahkan');
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
        $data = [
            'jalur' => JalurMasuk::find($id),
        ];

        return view('admin.jalur.edit', $data);
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
        $jalur = JalurMasuk::find($id);

        $validate = $request->validate([
            'judul'      => 'required',
            'keterangan' => 'required',
            'tgl_akhir'  => 'required|date',
            'foto'       => 'image',
        ]);

        if($request->file('foto')){
            $foto = $request->file('foto');

            if($jalur->foto){
                Storage::disk('local')->delete('public/jalur/'. $jalur->foto);
            }

            $foto->storeAs('public/jalur/', $foto->hashName());

            $validate['foto'] = $foto->hashName();
        }

        $jalur->update($validate);

        return redirect(route('jalur.index'))->with('success', 'Jalur masuk berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $jalur = JalurMasuk::find($id);

        if ($jalur->pendaftar->count() > 0) {
            return response()->json([
                'status' => 'danger',
                'message' => 'jalur masuk telah di gunakan pendaftar' 
            ]);
        }

        Storage::disk('local')->delete('public/jalur/'. $jalur->foto);

        $jalur->delete();

        return 'Jalur masuk berhasil dihapus';
    }
}
