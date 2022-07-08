<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SumberInfo;
use Illuminate\Http\Request;

class SumberInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sumber = SumberInfo::all();

        $view = '';

        foreach($sumber as $s => $sum){
            $view .= '
                <tr>
                    <td>'. ($s+1) .'</td>
                    <td>'. $sum->info .'</td>
                    <td class="text-nowrap">
                        <button class="btn btn-danger btn-sm" onclick="deleteData(`'. route("sumber_info.destroy", ["sumber_info" => $sum->id]) .'`)"><i class="bi bi-trash"></i></button>
                        <button class="btn btn-success btn-sm" onclick="showEditSumber('. $sum->id .', `Ubah Sumber Informasi`)"><i class="bi bi-pencil-square"></i></button>
                    </td>
                </tr>
            ';
        }

        return $view;
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
        SumberInfo::create([
            'info' => $request->sumber_info,
        ]);

        return back()->with([
            'success' => 'Sumber informasi berhasil ditambahkan',
            'tab'     => 'formulir',
        ]);
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
        $sumber = SumberInfo::find($id);

        $view = '
            <div class="mb-3">
                <label for="sumber_info" class="form-label">Sumber Informasi</label>
                <input type="text" class="form-control" id="sumber_info" name="sumber_info" value="'. $sumber->info .'" placeholder="Masukkan sumber informasi pendaftaran" required>
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
        $sumber = SumberInfo::find($id);

        $sumber->update([
            'info' => $request->sumber_info,
        ]);

        return back()->with('success', 'Sumber informasi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sumber = SumberInfo::find($id);

        $sumber->delete();

        return 'Sumber Informasi berhasil dihapus';
    }
}
