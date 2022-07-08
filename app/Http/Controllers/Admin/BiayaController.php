<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        $biaya = Biaya::find($id);

        $view = '
            <div class="mb-3">
                <label for="uang_pangkal" class="form-label">Uang Pangkal</label>
                <input type="number" class="form-control" id="uang_pangkal" name="uang_pangkal" value="'. $biaya->uang_pangkal .'" min="0" placeholder="Masukkan uang pangkal" required>
            </div>
            <div class="mb-3">
                <label for="spp" class="form-label">SPP</label>
                <input type="number" class="form-control" id="spp" name="spp" value="'. $biaya->spp .'" min="0" placeholder="Masukkan spp" required>
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
        $biaya = Biaya::find($id);

        $biaya->update([
            'uang_pangkal' => $request->uang_pangkal,
            'spp'          => $request->spp,
        ]);

        return back()->with([
            'success' => 'Biaya kuliah berhasil diupdate',
            'tab'     => 'biaya',
        ]);
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
