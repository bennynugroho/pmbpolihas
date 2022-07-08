<?php

namespace App\Exports;

use App\Models\Seleksi;
use App\Models\TahunAkademik;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SeleksiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $tahun_akd = TahunAkademik::where('status', 1)->first();

        $data = [
            'seleksi' => Seleksi::with(['daftar', 'tahun_akademik'])->where('thn_akd_id', $tahun_akd->id)->get(),
        ];

        return view('admin.seleksi-export', $data);
    }
}