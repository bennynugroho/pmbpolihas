<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Formulir Pendaftaran {{ $pendaftar->nama }}</title>

    <style type="text/css">
        table td{
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .table {
            width: 100%;
            max-width: 100%;
            background-color: transparent;
            border-collapse: collapse;     
            margin-bottom: 2px;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-data tbody tr td{
            padding-left: 25px;
        }

        .w-50{
            width: 50%;
        }

        .w-10{
            width: 10px;
        }

        @page {
            margin: 0px 10px 0px 10px;
        }

        .footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 1px;
            background-color: #203764;
            color: white;
            text-align: center;
            padding: 0px;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        @media screen and (max-width:600px) {
            .column {
                width: 100%;
            }

            .column {
                float: left;
                width: 33.33%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <table class="table" style="background-color: #1F4E78; color: white; margin-bottom: 3px;">
        <tr>
            <td style="padding: 5px;">
                <img src="{{ $header_image }}" width="50px" height="50px" alt="">
            </td>
            <td>
                <b>
                    Formulir Pendaftaran Mahasiswa Baru
                    <br>
                    Politeknik Hasnur
                </b>
            </td>
            <td>
                Nomor Formulir : 
                <input style="width: 28px; height: 25px;" type="" name="">
                <input style="width: 28px; height: 25px;" type="" name="">
                <input style="width: 28px; height: 25px;" type="" name="">
                <input style="width: 28px; height: 25px;" type="" name="">
            </td>
        </tr>
    </table>
    <table class="table" style="background-color: #FFD966;">
        <tr>
            <td style="padding-left: 50px;">
                Tahun Akademik {{ $tahun_akd->tahun }}
            </td>
        </tr>
    </table>
    <table class="table" style="background-color: #FFE699;">
        <tr>
            @foreach ($jalur as $jlr)
                <td style="width: 210px; text-align: center; padding-left: 30px;">
                    <input type="checkbox" {{ $pendaftar->jalur_id == $jlr->id ? 'checked=""' : '' }}> {{ $jlr->judul }}
                </td>
            @endforeach
        </tr>
    </table>
    <table class="table table-data">
        <thead>
            <tr>
                <td style="width: 40px; background-color: #A9D08E;" colspan="2">I. &emsp; DATA DIRI</td>
                <td style="width: 20px; background-color: #E2EFDA;" colspan="2"></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="w-10">a.</td>
                <td style="">Nama Lengkap</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->nama }}</td>
            </tr>
            <tr>
                <td class="w-10">b.</td>
                <td style="">Jenis Kelamin</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->kelamin }}</td>
            </tr>
            <tr>
                <td class="w-10">c.</td>
                <td style="">Agama</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->agama }}</td>
            </tr>
            <tr>
                <td class="w-10">d.</td>
                <td style="">Tempat / Tanggal Lahir</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->tempat_lahir }}, {{ $pendaftar->getTanggalLahir }}</td>
            </tr>
            <tr>
                <td class="w-10">e.</td>
                <td style="">Alamat</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->alamat }}</td>
            </tr>
            <tr>
                <td class="w-10">f.</td>
                <td style="">NIK</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->nik }}</td>
            </tr>
            <tr>
                <td class="w-10">g.</td>
                <td style="">No. Kartu Keluarga</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->kk }}</td>
            </tr>
            <tr>
                <td class="w-10">h.</td>
                <td style="">Kelurahan</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->kel }}</td>
            </tr>
            <tr>
                <td class="w-10">i.</td>
                <td style="">Kecamatan</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->kec }}</td>
            </tr>
            <tr>
                <td class="w-10">j.</td>
                <td style="">Kode Pos</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->kp }}</td>
            </tr>
            <tr>
                <td class="w-10">k.</td>
                <td style="">Telepon / HP</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->tlp }}</td>
            </tr>
            <tr>
                <td class="w-10">l.</td>
                <td style="">No. Whatsapp</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->wa }}</td>
            </tr>
            <tr>
                <td class="w-10">m.</td>
                <td style="">Email</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->email }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-data">
        <thead>
            <tr>
                <td style="width: 40px; background-color: #A9D08E;" colspan="2">II. &emsp; PENDIDIKAN</td>
                <td style="width: 20px; background-color: #E2EFDA;" colspan="2"></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="w-10">a.</td>
                <td style="">Sekolah Asal</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->slta }}</td>
            </tr>
            <tr>
                <td class="w-10">b.</td>
                <td style="">Tahun Masuk</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->thn_slta }}</td>
            </tr>
            <tr>
                <td class="w-10">c.</td>
                <td style="">Nomor Induk Siswa Nasional (NISN)</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->nisn }}</td>
            </tr>
            <tr>
                <td class="w-10">d.</td>
                <td style="">Nomor Pokok Sekolah Nasional (NPSN)</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->npsn }}</td>
            </tr>
            <tr>
                <td class="w-10">e.</td>
                <td style="">Jurusan / Program Keahlian</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->jur_slta }}</td>
            </tr>
            <tr>
                <td class="w-10" style="vertical-align: baseline;">f.</td>
                <td style="vertical-align: baseline;">Prestasi Akademik dan Non Akademik</td>
                <td class="w-10" style="padding-left: 0px; vertical-align: baseline;">:</td>
                <td class="w-50" style="vertical-align: baseline;">
                    1. {{ $pendaftar->prestasi_akd }}
                    <br>
                    2. {{ $pendaftar->prestasi_non_akd }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-data">
        <thead>
            <tr>
                <td style="width: 40px; background-color: #A9D08E;" colspan="2">III. &emsp; KELUARGA</td>
                <td style="width: 20px; background-color: #E2EFDA;" colspan="2"></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="w-10">a.</td>
                <td style="">Nama Ayah / Wali</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->ayah }}</td>
            </tr>
            <tr>
                <td class="w-10">b.</td>
                <td style="">Pekerjaan Ayah</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->kerja_ayah }}</td>
            </tr>
            <tr>
                <td class="w-10">c.</td>
                <td style="">Nama Ibu / Wali</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->ibu }}</td>
            </tr>
            <tr>
                <td class="w-10">d.</td>
                <td style="">Pekerjaan Ibu</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->kerja_ibu }}</td>
            </tr>
            <tr>
                <td class="w-10">e.</td>
                <td style="">Jumlah Anak</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->jum_anak }}</td>
            </tr>
            <tr>
                <td class="w-10">f.</td>
                <td style="">Penghasilan</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->penghasilan_ortu }}</td>
            </tr>
            <tr>
                <td class="w-10">g.</td>
                <td style="">Alamat</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->alamat_ortu }}</td>
            </tr>
            <tr>
                <td class="w-10">h.</td>
                <td style="">Telepon / HP</td>
                <td class="w-10" style="padding-left: 0px;">:</td>
                <td class="w-50">{{ $pendaftar->tlp_ortu }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-data">
        <thead>
            <tr>
                <td style="width: 40px; background-color: #A9D08E;" colspan="2">IV. &emsp; PILIHAN PROGRAM STUDI</td>
                <td style="width: 20px; background-color: #E2EFDA;" colspan="2"></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="vertical-align: baseline;" colspan="2">Program Studi</td>
                <td class="w-10" style="padding-left: 0px; vertical-align: baseline;">:</td>
                <td class="w-50" style="vertical-align: baseline;">
                    Pilihan 1 : {{ $pendaftar->kelas1->nama }}
                    <br>
                    Pilihan 2 : {{ $pendaftar->kelas2->nama }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table" style="margin-top: 10px;">
        <tr>
            <td style="padding-left: 100px;">
                <img src="{{ public_path() .'/storage/pendaftar/'. $pendaftar->foto }}" width="3.5cm" height="4cm" alt="">
            </td>
            <td></td>
            <td style="text-align: center">
                <?php date_default_timezone_set("Asia/Makassar"); ?>
                Barito Kuala, {{ date('d-M-Y') }}
                <br><br><br><br><br>
                <hr style="margin-bottom: 0px; width: 65%; color: black;">                
                <p>{{ $pendaftar->nama }}</p>
            </td>
        </tr>
    </table>
    <table class="table" style="margin-top: 10px;">
        <tr style="text-align: left;">
            <td style="padding-left: 25px;">
                Sumber Informasi
            </td>
            <td></td>
            <td style="width: 50%; padding-left: 25px;">
                @foreach ($pendaftar->getSumberInfo as $sumber)
                    *{{ $sumber->info }} 
                @endforeach
            </td>
        </tr>
    </table>
    <table class="table" style="margin-top: 10px;">
        <tr>
            <td style="padding-left: 25px; vertical-align: baseline;">Orang yang merekomendasikan</td>
            <td></td>
            <td style="width: 50%; padding-left: 25px; vertical-align: baseline;">
                @if ($pendaftar->nama_rekomendasi)
                    <p style="margin-bottom: 0px;">{{ $pendaftar->nama_rekomendasi }}</p>
                    <hr style="margin-top: 0px; width: 50%; text-align: left; color: black;">
                @else
                <hr style="margin-top: 15px; width: 50%; text-align: left; color: black;">
                @endif
            </td>
        </tr>
    </table>

    <div class="footer">
        <h3 style="padding-bottom: 10px;">Informasi Pengiriman Formulir : 085100156666</h3>
    </div>
</body>
</html>