<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JalurMasuk;
use App\Models\Kelas;
use App\Models\Pendaftar;
use App\Models\Prodi;
use App\Models\SumberInfo;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun_akademik = TahunAkademik::all();
        $tahun_id = $tahun_akademik->where('status', 1)->first();

        $data = [
            'tahun_akd' => $tahun_akademik,
        ];

        return view('admin.dashboard.index', $data, compact(['tahun_id']));
    }

    public function showPendaftarTable(Request $request)
    {
        $tahun_akd = TahunAkademik::where('status', 1)->first();
        $tahun_id = $tahun_akd->id;

        if($request->tahun_id){
            $tahun_id = $request->tahun_id;
        }

        $pendaftar = Pendaftar::with(['jalur'])->where('thn_akd_id', $tahun_id)->orderBy('tgl_daftar', 'desc')->get();

        $view = '';
        foreach($pendaftar as $p => $pen){
            $view .= '
                <tr>
                    <td><input type="checkbox" class="form-check-input check-item" value="'. $pen->id .'" onclick="unCheckAll(this, `check-all`)"></td>
                    <td>'. ($p+1) .'</td>
                    <td>'. $pen->nama .'</td>
                    <td>'. $pen->tlp .'</td>
                    <td>'. $pen->jalur->judul .'</td>
                    <td>'. $pen->slta .'</td>
                    <td>'. $pen->gettanggalDaftar .'</td>
                    <td id="status-pendaftar-'. $pen->id .'">';
                    
            if($pen->status == 1){
                $view .= '<span class="badge bg-success">Sudah</span>';
            }else{
                $view .= '<span class="badge bg-danger">Belum</span>';
            }

            $view .= '</td>
                    <td>
                        <div class="switch">
                            <label>
                                <input type="checkbox" onchange="updateStatus('. $pen->id .')" id="checkbox-pendaftar-'. $pen->id .'"';
                                
                                if($pen->status == 1){
                                    $view .= 'checked';
                                }

                                $view .= '>
                                <span class="lever switch-col-blue"></span>
                            </label>
                        </div>
                    </td>
                    <td class="text-nowrap">
                        <button class="btn btn-sm btn-danger" onclick="deleteData(`'. route('pendaftar.destroy', ['pendaftar' => $pen->id]) .'`)"><i class="bi bi-x"></i></button>
                        <a href="'. route('pendaftar.show', ['pendaftar' => $pen->id]) .'" class="btn btn-sm btn-primary"><i class="bi bi-person-fill"></i></a>
                        <a href="'. route('download.formulir', ['email' => $pen->email]) .'" target="_blank" class="btn btn-sm btn-warning text-white"><i class="bi bi-printer-fill"></i></a>
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
        $data = [
            'pendaftar'   => Pendaftar::with(['jalur', 'kelas1', 'kelas2', 'tahun_akd', ])->where('id', $id)->first(),
            'jalur'       => JalurMasuk::all(),
            'kelas'       => Kelas::all(),
            'sumber_info' => SumberInfo::all(),
        ];

        return view('admin.dashboard.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // return response($request);

        $rules = [
            'nama'             => 'required',
            'kelamin'          => 'required',
            'agama'            => 'required',
            'tempat_lahir'     => 'required',
            'tanggal_lahir'    => 'date|required',
            'alamat'           => 'required',
            'nik'              => 'required',
            'kk'               => 'required',
            'kel'              => 'required',
            'kec'              => 'required',
            'kp'               => 'required',
            'tlp'              => 'required',
            'wa'               => 'required',
            // 'email'            => 'email|unique:pendaftar,email|required',
            // 'foto'             => 'required|image|file|max:1536',
            'slta'             => 'required',
            'thn_slta'         => 'required',
            'nisn'             => 'required',
            'npsn'             => 'required',
            'jur_slta'         => 'required',
            'prestasi_akd'     => 'required',
            'prestasi_non_akd' => 'required',
            'ayah'             => 'required',
            'kerja_ayah'       => 'required',
            'ibu'              => 'required',
            'kerja_ibu'        => 'required',
            'jum_anak'         => 'required',
            'penghasilan_ortu' => 'required',
            'alamat_ortu'      => 'required',
            'tlp_ortu'         => 'required',
            'jalur_id'         => 'required',
            'kelas1_id'        => 'required',
            'kelas2_id'        => 'required',
            // 'nama_rekomendasi' => '',
            // 'tlp_rekomendasi'  => '',
            'sumber_info'      => 'required',
        ];

        
        $pendaftar = Pendaftar::find($id);

        if($pendaftar->email != $request->email){
            $rules['email'] = 'email|unique:pendaftar,email|required';
        }

        $validatedData = $request->validate($rules);
        
        $pendaftar->update($validatedData);

        return back()->with('success', 'Data pendaftar berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if($request->hapus == 'check-all'){
            $data = [];
            foreach($request->id as $id){
                $pendaftar = Pendaftar::find($id);

                Storage::disk('local')->delete('public/pendaftar/'. $pendaftar->foto);

                array_push($data, [
                    'id' => $id,
                ]);
            }

            Pendaftar::whereIn('id', $data)->delete();

            return 'Data berhasil dihapus';
        }

        $pendaftar = Pendaftar::find($id);

        Storage::disk('local')->delete('public/pendaftar/'. $pendaftar->foto);
        
        $pendaftar->delete();

        return 'Data berhasil dihapus';
    }
    
    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $pendaftar = Pendaftar::find($id);
        
        if($status == 1){
            $pendaftar->update([
                'status' => 1,
            ]);

            return 1;
        }else{
            $pendaftar->update([
                'status' => 0,
            ]);

            return 0;
        }
    }
}
