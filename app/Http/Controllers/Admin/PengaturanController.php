<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Formulir;
use App\Models\InfoPendaftaran;
use App\Models\JalurMasuk;
use App\Models\TahunAkademik;
use App\Models\User;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $data = [
            'tahun_akd'  => TahunAkademik::all(),
            'akun'       => User::where('role', 'admin')->first(),
            'infoDaftar' => InfoPendaftaran::all()->first(),
            'jalur'      => JalurMasuk::all(),
            'biaya'      => Biaya::with(['prodi'])->get(),
            'formulir'   => Formulir::all()->first(),
        ];

        return view('admin.pengaturan', $data);
    }
}
