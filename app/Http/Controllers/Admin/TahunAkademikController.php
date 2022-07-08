<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
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
        $view = '
            <div class="mb-3">
            <label for="tahun_akd" class="form-label">Tahun Akademik</label>
                <input type="text" class="form-control id="tahun_akd" name="tahun" placeholder="Masukkan tahun akademik" required>
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
        $data = [
            'tahun'  => $request->tahun,
            'status' => 0,
        ];

        TahunAkademik::create($data);

        return back()->with('success', 'Tahun akademik berhasil ditambahkan');
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
        $tahun = TahunAkademik::find($id);

        $view = '
            <div class="mb-3">
                <label for="tahun_akd" class="form-label">Tahun Akademik</label>
                <input type="text" class="form-control" id="tahun_akd" name="tahun" value="'. $tahun->tahun .'" placeholder="Masukkan tahun akademik" required>
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
        $tahun = TahunAkademik::find($id);

        $tahun->update([
            'tahun' => $request->tahun,
        ]);

        return back()->with('success', 'Tahun akademik berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tahun = TahunAkademik::find($id);

        $tahun->delete();

        // return back()->with('success', 'Tahun akademik berhasil dihapus');
        return 'Tahun akademik berhasil dihapus';
    }

    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $tahun = TahunAkademik::find($id);
        $thn = TahunAkademik::where('status', 1)->count();

        if($status == 0 && $thn > 0){
            $tahun->update([
                'status' => $status,
            ]);
            return 1;
        }elseif($status == 1 && $thn == 0){
            $tahun->update([
                'status' => $status,
            ]);
            return 2;
        }else{
            return 3;
        }
    }
}
