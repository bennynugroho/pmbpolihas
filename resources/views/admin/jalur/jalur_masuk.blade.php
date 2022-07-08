@extends('layout.admin')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')
    <div class="row">    
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title mb-0">Data Jalur Masuk</h3>
                </div>
                <div class="col-6 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalJalur"><i class="bi bi-plus-circle-fill"></i> Tambah</button>
                </div>
            </div>
        </div>

        @foreach ($jalur as $jlr)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <img src="{{ $jlr->getFoto }}" class="img-fluid mb-3 rounded card-img" alt="">
                            <h5 class="card-title mb-0">{{ $jlr->judul }}</h5>
                            <p class="text-secondary">Pendaftaran Berakhir : {{ $jlr->getTanggalakhir }}</p>
                            <p class="card-text">{{ $jlr->keterangan }}</p>
                            <button class="btn btn-danger btn-sm round" onclick="deleteData('{{ route('jalur.destroy', ['jalur' => $jlr->id]) }}')"><i class="bi bi-trash"></i></button>

                            <a href="{{ route('jalur.edit', ['jalur' => $jlr->id]) }}" class="btn btn-success btn-sm round"><i class="bi bi-pencil-square"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Jalur -->
    <div class="modal fade" id="modalJalur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Jalur Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('jalur.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan nama jalur masuk" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_akhir" class="form-label">Tanggal Berakhir</label>
                            <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="Masukkan tanggal" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Masukkan keterangan jalur masuk" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="foto">Gambar</label>
                            <input type="file" name="foto" id="foto" class="dropify" data-height="200" data-default-file="{{ asset('') }}" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end Modal Prodi -->
@endsection

@push('after-script')
    @include('partials.deleteData')
    <script src="{{ asset('assets/vendor/dropify/js/dropify.min.js') }}"></script>

    <script>
        $('.dropify').dropify();
    </script>
@endpush