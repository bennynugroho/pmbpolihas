@extends('layout.app')

@section('main')
    <section id="prodi" class="about pb-0 pt-110 mb-5">
        <div class="container" data-aos="fade-up">
            <div class="row content">
                <div class="col-lg-6">
                    <div class="section-title pb-3">
                        <h2>Prodi</h2>
                        <p>{{ $detail_prodi->nama }}</p>
                    </div>
                    <div class="mb-3">
                        <h5>Visi :</h5>
                        <ul>
                            @foreach ($detail_prodi->getVisi as $visi)
                                <li><i class="ri-check-double-line"></i> {{ trim($visi, '\r\n') }}</li>
                            @endforeach
                        </ul>
                    </div>
        
                    <div class="mb-3">
                        <h5>Misi :</h5>
                        <ul>
                            @foreach ($detail_prodi->getMisi as $misi)
                                <li><i class="ri-check-double-line"></i> {{ trim($misi, '\r\n') }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 text-end pt-4 pt-lg-0">
                    <img src="{{ $detail_prodi->getFoto }}" class="img-thumbnail" width="450" alt="">
                </div>
            </div>
        </div>
    </section>

    <section id="kurikulum" class="section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title pb-3">
                <h2>Kurikulum</h2>
                <p>{{ $detail_prodi->nama }}</p>
            </div>
            <table class="table table-responsive">
                <thead>
                    <th>No.</th>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>Semester</th>
                    <th>SKS Teori</th>
                    <th>SKS Praktik</th>
                    <th>Total SKS</th>
                    <th>Jam</th>
                </thead>
                <tbody>
                    @foreach ($kurikulum as $kur)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kur->kode }}</td>
                            <td>{{ $kur->mata_kuliah }}</td>
                            <td>{{ $kur->semester }}</td>
                            <td>{{ $kur->sks_teori }}</td>
                            <td>{{ $kur->sks_praktek }}</td>
                            <td>{{ $kur->sks_teori + $kur->sks_praktek }}</td>
                            <td>{{ $kur->jam }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection