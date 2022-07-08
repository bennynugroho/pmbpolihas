<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Models\Prodi;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'prodi'     => Prodi::all(),
            'kurikulum' => Kurikulum::with(['prodi'])->get(),
        ];

        return view('admin.kurikulum', $data);
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
        $prodi = $request->prodi;
        $data = [];

        foreach($prodi as $p => $pro){
            array_push($data, [
                'prodi_id'    => $pro,
                'semester'    => $request->semester[$p],
                'kode'        => $request->kode[$p],
                'mata_kuliah' => $request->mata_kuliah[$p],
                'sks_teori'   => $request->sks_teori[$p],
                'sks_praktek' => $request->sks_praktek[$p],
                'jam'         => $request->jam[$p],
            ]);
        }

        Kurikulum::insert($data);
        return back()->with('success', 'Kurikulum berhasil ditambahakan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kurikulum  $kurikulum
     * @return \Illuminate\Http\Response
     */
    public function show(Kurikulum $kurikulum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kurikulum  $kurikulum
     * @return \Illuminate\Http\Response
     */
    public function edit(Kurikulum $kurikulum)
    {
        return response()->json($kurikulum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kurikulum  $kurikulum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kurikulum $kurikulum)
    {
        $kurikulum->update([
            'semester'    => $request->semester,
            'kode'        => $request->kode,
            'mata_kuliah' => $request->mata_kuliah,
            'sks_teori'   => $request->sks_teori,
            'sks_praktek' => $request->sks_praktek,
            'jam'         => $request->jam,
        ]);

        return back()->with('success', 'Kurikulum berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kurikulum  $kurikulum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kurikulum $kurikulum)
    {
        $kurikulum->delete();

        return 'Kurikulum berhasil dihapus';
    }
}
