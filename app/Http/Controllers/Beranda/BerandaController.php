<?php

namespace App\Http\Controllers\Beranda;

use App\Http\Controllers\Controller;
use App\Models\InfoPendaftaran;
use App\Models\Kurikulum;
use App\Models\Pendaftar;
use App\Models\Persyaratan;
use App\Models\Pesan;
use App\Models\Prodi;
use App\Models\Seleksi;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Traits\AppTraits;

class BerandaController extends Controller
{
    use AppTraits;

    public function index()
    {
        $data = [
            'syarat'      => Persyaratan::all(), 
            'info_daftar' => InfoPendaftaran::all()->first(),
            'ormawa'      => Http::get(env('PH_URL') . '/ormawa')->object(),
            'testimoni'   => Http::get(env('PH_URL') . '/testimoni')->object(),
            'page'        => 'beranda',
        ];

        $data += $this->primary();

        return view('user.beranda', $data);
    }

    public function jalur_masuk()
    {
        $data = [
            'page' => 'jalur-masuk',
        ];

        $data += $this->primary();

        return view('user.jalur_masuk', $data);
    }

    
    public function pengumuman() 
    {
        $data = [
            'pengumuman' => Seleksi::with(['daftar', 'tahun_akademik'])->get(), // relasi tabel pendaftar dan tahun akademik
            'page'       => 'pendaftaran',
        ];

        $data += $this->primary();

        return view('user.pengumuman', $data);
    }

    public function prodi()
    {
        $data = [
            'page' => 'prodi',
        ];

        $data += $this->primary();

        return view('user.prodi', $data);
    }

    public function kurikulum($slug)
    {
        $detail_prodi = Prodi::where('slug', $slug)->first();

        $data = [
            'detail_prodi' => $detail_prodi,
            'kurikulum'    => Kurikulum::where('prodi_id', $detail_prodi->id)->get(),
            'page'         => 'prodi',
        ];

        $data += $this->primary();

        return view('user.kurikulum', $data);
    }

    public function contact()
    {
        $data = [
            'page' => 'hubungi',
        ];

        $data += $this->primary();    

        return view('user.hubungi', $data);
    }

    public function kirimPesan(Request $request)
    {
        $validatedData = $request->validate([
            'nama'   => 'required',
            'subyek' => 'required',
            'email'  => 'required',
            'pesan'  => 'required',
        ]);

        $validatedData['tgl_pesan'] = today();

        Pesan::create($validatedData);

        return back()->with('success', 'Pesan telah terkirim, terimakasih telah menghubungi kami');
    }

    public function registration_success($email)
    {
        $data = [
            'pendaftar' => Pendaftar::with(['jalur', 'kelas1', 'kelas2', 'tahun_akd'])->where('email', $email)->first(),
            'navbar'    => 'regis_success',
        ];

        return view('user.pendaftaran.sukses', $data);
    }
}
