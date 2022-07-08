@extends('layout.admin')

@push('after-style')
    <style>
        .img-thumbnail{
            height: 250px;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-3">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-center px-3 mb-3">
                        <img src="{{ $pendaftar->getFoto }}" class="img-thumbnail">
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><i class="bi bi-file-person"></i></td>
                                <td>{{ $pendaftar->nama }}</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-person"></i></td>
                                <td>{{ $pendaftar->kelamin }}</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-calendar-event"></i></td>
                                <td>{{ $pendaftar->getTanggalLahir }}</td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-geo-alt"></i></td>
                                <td>{{ $pendaftar->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6>Rekomendasi Dari:</h6>
                    @if ($pendaftar->nama_rekomendasi)
                        <span>{{ $pendaftar->nama_rekomendasi }} - {{ $pendaftar->tlp_rekomendasi }}</span>
                    @else
                        <span class="text-danger">Tidak Ada</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bd-highlight">
                            <h2 class="mb-0">Detail Data Pendaftar</h2>
                        </div>
                        <div class="bd-highlight ms-auto">
                            <a href="{{ route('download.formulir', ['email' => $pendaftar->email]) }}" target="_blank" class="btn btn-danger"><i class="bi bi-printer-fill"></i> Cetak Formulir</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <form action="{{ route('pendaftar.update', ['pendaftar' => $pendaftar->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-profil-tab" data-bs-toggle="pill" data-bs-target="#pills-profil" type="button" role="tab" aria-controls="pills-profil" aria-selected="true"><i class="bi bi-person-circle"></i> Profil</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-ubah-tab" data-bs-toggle="pill" data-bs-target="#pills-ubah" type="button" role="tab" aria-controls="pills-ubah" aria-selected="true"><i class="bi bi-gear"></i> Ubah</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-4" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-profil" role="tabpanel" aria-labelledby="pills-profil-tab">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <h5 class="mb-3"><span class="badge bg-danger shadow">Data Diri</span></h5>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>NIK</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->nik }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kartu Keluarga</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->kk }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kelurahan</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->kel }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kode Pos</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->kp }}</td>
                                                </tr>
                                                <tr>
                                                    <th>No Telepon</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->tlp }}</td>
                                                </tr>
                                                <tr>
                                                    <th>No WA</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->wa }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Agama</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->agama }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Lahir</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->tempat_lahir }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Lahir</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->getTanggalLahir }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <h5 class="mb-3"><span class="badge bg-success shadow">Data Pendidikan</span></h5>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Asal Sekolah</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->slta }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tahun Masuk</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->thn_slta }}</td>
                                                </tr>
                                                <tr>
                                                    <th>NISN</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->nisn }}</td>
                                                </tr>
                                                <tr>
                                                    <th>NPSN</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->npsn }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jurusan</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->jur_slta }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Prestasi Akademik</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->prestasi_akd }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Prestasi Non Akademik</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->prestasi_non_akd }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kontak Orang Tua</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->tlp_ortu }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5 class="mb-3"><span class="badge bg-primary shadow">Data Keluarga</span></h5>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Nama Ayah/Wali</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->ayah }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan Ayah/Wali</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->kerja_ayah }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Ibu/Wali</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->ibu }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan Ibu/Wali</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->kerja_ibu }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah Anak</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->jum_anak }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Penghasilan (Ayah dan Ibu)</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->penghasilan_ortu }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat Orang Tua</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->alamat_ortu }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6 mt-3">
                                        <h5 class="mb-3"><span class="badge bg-warning shadow">Data Lanjutan</span></h5>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Pembiayaan</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->jalur->judul }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pilihan Prodi 1</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->kelas1->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pilihan Prodi 2</th>
                                                    <td>:</td>
                                                    <td>{{ $pendaftar->kelas2->nama }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
            
                                        <h5>Informasi PMB:</h5>
                                        <ul>
                                            @foreach ($pendaftar->getSumberInfo as $sumber)
                                                <li>{{ $sumber->info }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-ubah" role="tabpanel" aria-labelledby="pills-ubah-tab">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <h5 class="mb-3"><span class="badge bg-danger shadow">Data Diri</span></h5>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Nama Lengkap</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{ old('nama', $pendaftar->nama) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Jenis Kelamin</th>
                                                    <td>:</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <div class="bd-highlight me-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input input-daftar input-tabdiri input-tabdiri @error('kelamin') is-invalid @enderror" type="radio" name="kelamin" value="Pria" id="kelamin1" {{ $pendaftar->kelamin == 'Pria' ? 'checked' : '' }} required>
                                                                    <label class="form-check-label" for="kelamin1">
                                                                        Pria
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="bd-highlight">
                                                                <div class="form-check">
                                                                    <input class="form-check-input input-daftar input-tabdiri @error('kelamin') is-invalid @enderror" type="radio" name="kelamin" value="Wanita" {{ $pendaftar->kelamin == 'Wanita' ? 'checked' : '' }} id="kelamin2">
                                                                    <label class="form-check-label" for="kelamin2">
                                                                        Wanita
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>No Telepon</th>
                                                    <td>:</td>
                                                    <td><input type="number" class="form-control @error('tlp') is-invalid @enderror" name="tlp" id="tlp" value="{{ old('tlp', $pendaftar->tlp) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>No WA</th>
                                                    <td>:</td>
                                                    <td><input type="number" class="form-control @error('wa') is-invalid @enderror" name="wa" id="wa" value="{{ old('wa', $pendaftar->wa) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>:</td>
                                                    <td><input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email', $pendaftar->email) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Agama</th>
                                                    <td>:</td>
                                                    <td>
                                                        <select class="form-select input-daftar input-tabdiri @error('agama') is-invalid @enderror" name="agama" id="agama" onchange="checkTabDiri()" required>
                                                            <option value="Islam" {{ $pendaftar->agama == 'Islam' ? 'checked' : '' }}>Islam</option>
                                                            <option value="Protestan" {{ $pendaftar->agama == 'Protestan' ? 'checked' : '' }}>Protestan</option>
                                                            <option value="Katolik" {{ $pendaftar->agama == 'Katolik' ? 'checked' : '' }}>Katolik</option>
                                                            <option value="Hindu" {{ $pendaftar->agama == 'Hindu' ? 'checked' : '' }}>Hindu</option>
                                                            <option value="Budha" {{ $pendaftar->agama == 'Budha' ? 'checked' : '' }}>Budha</option>
                                                            <option value="Lainnya" {{ $pendaftar->agama == 'Lainnya' ? 'checked' : '' }}>Lainnya</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Tempat Lahir</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $pendaftar->tempat_lahir) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal Lahir</th>
                                                    <td>:</td>
                                                    <td><input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $pendaftar->tanggal_lahir) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>NIK</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" value="{{ old('nik', $pendaftar->nik) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Kartu Keluarga</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('kk') is-invalid @enderror" name="kk" id="kk" value="{{ old('kk', $pendaftar->kk) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Kelurahan</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('kel') is-invalid @enderror" name="kel" id="kel" value="{{ old('kel', $pendaftar->kel) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Kecamatan</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('kec') is-invalid @enderror" name="kec" id="kec" value="{{ old('kec', $pendaftar->kec) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat</th>
                                                    <td>:</td>
                                                    <td><textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="3" required>{{ old('alamat', $pendaftar->alamat) }}</textarea></td>
                                                </tr>
                                                <tr>
                                                    <th>Kode Pos</th>
                                                    <td>:</td>
                                                    <td><input type="number" class="form-control @error('kp') is-invalid @enderror" name="kp" id="kp" value="{{ old('kp', $pendaftar->kp) }}" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5 class="mb-3"><span class="badge bg-success shadow">Data Pendidikan</span></h5>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Asal Sekolah</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('slta') is-invalid @enderror" name="slta" id="slta" value="{{ old('slta', $pendaftar->slta) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Tahun Masuk</th>
                                                    <td>:</td>
                                                    <td><input type="number" class="form-control @error('thn_slta') is-invalid @enderror" name="thn_slta" id="thn_slta" value="{{ old('thn_slta', $pendaftar->thn_slta) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>NISN</th>
                                                    <td>:</td>
                                                    <td><input type="number" class="form-control @error('nisn') is-invalid @enderror" name="nisn" id="nisn" value="{{ old('nisn', $pendaftar->nisn) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>NPSN</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('npsn') is-invalid @enderror" name="npsn" id="npsn" value="{{ old('npsn', $pendaftar->npsn) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Jurusan</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('jur_slta') is-invalid @enderror" name="jur_slta" id="jur_slta" value="{{ old('jur_slta', $pendaftar->jur_slta) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Prestasi Akademik</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('prestasi_akd') is-invalid @enderror" name="prestasi_akd" id="prestasi_akd" value="{{ old('prestasi_akd', $pendaftar->prestasi_akd) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Prestasi Non Akademik</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('prestasi_non_akd') is-invalid @enderror" name="prestasi_non_akd" id="prestasi_non_akd" value="{{ old('prestasi_non_akd', $pendaftar->prestasi_non_akd) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Kontak Orang Tua</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('tlp_ortu') is-invalid @enderror" name="tlp_ortu" id="tlp_ortu" value="{{ old('tlp_ortu', $pendaftar->tlp_ortu) }}" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h5 class="mb-3"><span class="badge bg-primary shadow">Data Keluarga</span></h5>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Nama Ayah/Wali</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('ayah') is-invalid @enderror" name="ayah" id="ayah" value="{{ old('ayah', $pendaftar->ayah) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan Ayah/Wali</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('kerja_ayah') is-invalid @enderror" name="kerja_ayah" id="kerja_ayah" value="{{ old('kerja_ayah', $pendaftar->kerja_ayah) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Nama Ibu/Wali</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('ibu') is-invalid @enderror" name="ibu" id="ibu" value="{{ old('ibu', $pendaftar->ibu) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Pekerjaan Ibu/Wali</th>
                                                    <td>:</td>
                                                    <td><input type="text" class="form-control @error('kerja_ibu') is-invalid @enderror" name="kerja_ibu" id="kerja_ibu" value="{{ old('kerja_ibu', $pendaftar->kerja_ibu) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Jumlah Anak</th>
                                                    <td>:</td>
                                                    <td><input type="number" class="form-control @error('jum_anak') is-invalid @enderror" name="jum_anak" id="jum_anak" value="{{ old('jum_anak', $pendaftar->jum_anak) }}" required></td>
                                                </tr>
                                                <tr>
                                                    <th>Penghasilan (Ayah dan Ibu)</th>
                                                    <td>:</td>
                                                    <td>
                                                        <select class="form-select input-daftar input-tabkeluarga @error('penghasilan_ortu') is-invalid @enderror" name="penghasilan_ortu" id="penghasilan_ortu" onchange="checkTabKeluarga()" required>
                                                            <option {{ $pendaftar->penghasilan_ortu == 'Kurang dari Rp 1.000.000' ? 'selected' : '' }} value="Kurang dari Rp 1.000.000">Kurang dari Rp 1.000.000</option>
                                                            <option {{ $pendaftar->penghasilan_ortu == 'Rp 1.000.000 - 2.499.999' ? 'selected' : '' }} value="Rp 1.000.000 - 2.499.999">Rp 1.000.000 - 2.499.999</option>
                                                            <option {{ $pendaftar->penghasilan_ortu == 'Rp 2.499.999 - 4.999.999' ? 'selected' : '' }} value="Rp 2.499.999 - 4.999.999">Rp 2.499.999 - 4.999.999</option>
                                                            <option {{ $pendaftar->penghasilan_ortu == 'Lebih dari Rp 5.000.000' ? 'selected' : '' }} value="Lebih dari Rp 5.000.000">Lebih dari Rp 5.000.000</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Alamat Orang Tua</th>
                                                    <td>:</td>
                                                    <td><textarea name="alamat_ortu" class="form-control @error('alamat_ortu') is-invalid @enderror" id="alamat_ortu" rows="3" required>{{ old('alamat_ortu', $pendaftar->alamat_ortu) }}</textarea></td>
                                                </tr>
                                                <tr>
                                                    <th>Kontak Orang Tua</th>
                                                    <td>:</td>
                                                    <td><input type="number" class="form-control @error('tlp_ortu') is-invalid @enderror" name="tlp_ortu" id="tlp_ortu" value="{{ old('tlp_ortu', $pendaftar->tlp_ortu) }}" required></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <h5 class="mb-3"><span class="badge bg-warning shadow">Data Lanjutan</span></h5>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Pembiayaan</th>
                                                    <td>:</td>
                                                    <td>
                                                        <select class="form-select @error('jalur_id') is-invalid @enderror" name="jalur_id" id="jalur_id" required>
                                                            @foreach ($jalur as $jal)
                                                                <option {{ $jal->id == $pendaftar->jalur_id ? 'selected' : '' }} value="{{ $jal->id }}">{{ $jal->judul }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pilihan Prodi 1</th>
                                                    <td>:</td>
                                                    <td>
                                                        <select class="form-select @error('kelas1_id') is-invalid @enderror" name="kelas1_id" id="kelas1_id" required>
                                                            @foreach ($kelas as $kls)
                                                                <option {{ $kls->id == $pendaftar->kelas1_id ? 'selected' : '' }} value="{{ $kls->id }}">{{ $kls->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Pilihan Prodi 2</th>
                                                    <td>:</td>
                                                    <td>
                                                        <select class="form-select @error('kelas2_id') is-invalid @enderror" name="kelas2_id" id="kelas2_id" required>
                                                            @foreach ($kelas as $kls)
                                                                <option {{ $kls->id == $pendaftar->kelas2_id ? 'selected' : '' }} value="{{ $kls->id }}">{{ $kls->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
            
                                        <h5>Informasi PMB:</h5>
                                        <div class="row">
                                            @foreach ($sumber_info as $si)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="{{ $si->id }}" {{ in_array($si->id, $pendaftar->getIdSumberInfo) ? 'checked' : '' }} name="sumber_info[]" id="sumber-{{ $si->id }}">
                                                        <label class="form-check-label" for="sumber-{{ $si->id }}">
                                                            {{ $si->info }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
    
                                <div class="text-end">
                                    <button type="reset" class="btn btn-danger">Reset</button>                                    
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection