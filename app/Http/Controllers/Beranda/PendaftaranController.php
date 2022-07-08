<?php

namespace App\Http\Controllers\Beranda;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\InfoPendaftaran;
use App\Models\Kelas;
use App\Models\Pendaftar;
use App\Models\Persyaratan;
use App\Models\SumberInfo;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use App\Traits\AppTraits;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use AppTraits;

    public function index()
    {
        $data = [
            'biaya'      => Biaya::with(['prodi'])->get(),
            'infoDaftar' => InfoPendaftaran::all()->first(),
            'syarat'     => Persyaratan::all(),
            'page'       => 'pendaftaran',
        ];

        $data += $this->primary();

        return view('user.pendaftaran.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $organisasi = Http::get(env('PH_URL') . '/polihasnur/ormawa')->object();

        // dd($organisasi);
        $data = [
            'sumber' => SumberInfo::all(),
            'kelas'  => Kelas::all(),
            'page'   => 'pendaftaran',
        ];

        $data += $this->primary();

        return view('user.pendaftaran.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            'email'            => 'email|unique:pendaftar,email|required',
            'foto'             => 'required|image|file|max:1536',
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
            'nama_rekomendasi' => '',
            'tlp_rekomendasi'  => '',
            'sumber_info'      => 'required',
        ];

        $validatedData = $request->validate($rules);

        $foto = $request->file('foto');

        $foto->storeAs('public/pendaftar', $request->email.'_'.$foto->getClientOriginalName());        

        $validatedData['foto'] = $request->email.'_'.$foto->getClientOriginalName();        

        $tahun = TahunAkademik::where('status', 1)->first();
        
        $validatedData['tgl_daftar'] = today();
        $validatedData['thn_akd_id'] = $tahun->id;

        $pendaftar = Pendaftar::create($validatedData);

        return back()->with('success', '/registration-success/'. $pendaftar->email);
        // return redirect('/registration-success/'. $pendaftar->email)->with('success', 'Pendaftaran berhasil dikirimkan');
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
