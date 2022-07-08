<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Persyaratan;
use Illuminate\Http\Request;

class PersyaratanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syarat = Persyaratan::all();

        return response()->json($syarat);        
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
        Persyaratan::create([
            'syarat' => $request->syarat,
        ]);

        return back()->with('success', 'Syarat berhasil ditambahkan');
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
        $syarat = Persyaratan::find($id);

        $view = '
            <div class="mb-3">
                <label for="syarat" class="form-label">Syarat</label>
                <input type="text" class="form-control" id="syarat" name="syarat" value="'. $syarat->syarat .'" placeholder="Masukkan syarat pendaftaran" required>
            </div>
        ';

        return $view;
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
        $syarat = Persyaratan::find($id);

        $syarat->update([
            'syarat' => $request->syarat,
        ]);

        return back()->with('success', 'Syarat berhasil diupdate',);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $syarat = Persyaratan::find($id);

        $syarat->delete();

        return 'Persyaratan berhasil dihapus';
    }
}
