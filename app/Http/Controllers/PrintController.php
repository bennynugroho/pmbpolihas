<?php

namespace App\Http\Controllers;

use App\Models\JalurMasuk;
use App\Models\Pendaftar;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printFormulir($email)
    {
        date_default_timezone_set("Asia/Singapore");
        include(base_path() . '/vendor/autoload.php');
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $pendaftar = Pendaftar::where('email', $email)->first();

        $mpdf->SetTitle('Cetak Formulir Pendaftaran '. $pendaftar->nama .' ');

        $data = [
            'description' => '',
            'tahun_akd' => TahunAkademik::where('status', 1)->first(),
            'pendaftar' => $pendaftar,
            'header_image' => public_path() .'/assets/img/picture/Polihasnur.png',
            'jalur' => JalurMasuk::all(),
        ];

        $html = view('admin.formulir', $data);

        $mpdf->WriteHTML($html);

        $mpdf->Output('Formulir Pendaftaran '. $pendaftar->nama .'.pdf', 'I');
    }
}
