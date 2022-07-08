@extends('layout.admin')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <form action="{{ route('jalur.update', ['jalur' => $jalur->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="row align-items-center mb-3">
                            <div class="col-6">
                                <h3 class="card-title mb-0">Edit Jalur masuk</h3>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('jalur.index') }}" class="btn btn-sm btn-warning"><i class="bi bi-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Nama</label>
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan nama jalur masuk" value="{{ old('judul', $jalur->judul) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_akhir" class="form-label">Tanggal Berakhir</label>
                            <input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="Masukkan tanggal" value="{{ old('tgl_akhir', $jalur->tgl_akhir) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" rows="3" placeholder="Masukkan keterangan jalur masuk" required>{{ old('keterangan', $jalur->keterangan) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="foto">Gambar</label>
                            <input type="file" name="foto" id="foto" class="dropify" data-height="200" data-default-file="{{ $jalur->getFoto }}"/>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script src="{{ asset('assets/vendor/dropify/js/dropify.min.js') }}"></script>

    <script>
        $('.dropify').dropify();
    </script>
@endpush