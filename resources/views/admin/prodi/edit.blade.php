@extends('layout.admin')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <form action="{{ route('prodi.update', ['prodi' => $prodi->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="row align-items-center mb-3">
                            <div class="col-6">
                                <h3 class="card-title mb-0">Edit Prodi</h3>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('prodi.index') }}" class="btn btn-sm btn-warning"><i class="bi bi-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nama-prodi" class="form-label">Nama Program Studi</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama-prodi" value="{{ old('nama', $prodi->nama) }}" onchange="createSlug(this.value)" placeholder="Masukkan nama program studi">
                            @error('nama')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="visi" class="form-label">Visi</label>
                            <textarea name="visi" id="visi" class="form-control" cols="30" rows="4" oninput="handleInputVisi(event)" placeholder="Masukkan visi program studi">{{ old('visi', $prodi->visi) }}</textarea>
                            @error('visi')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="misi" class="form-label">Misi</label>
                            <textarea name="misi" id="misi" class="form-control" cols="30" rows="4" oninput="handleInputMisi(event)" placeholder="Masukkan misi program studi">{{ old('misi', $prodi->misi) }}</textarea>
                            @error('misi')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="foto">Gambar</label>
                            <input type="file" name="foto" id="foto" class="dropify" data-height="200" data-default-file="{{ $prodi->getFoto }}"/>
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

    <script>
        let previousLengthVisi = 0;
        const handleInputVisi = (event) => {
            const bullet = "•";
            const newLength = event.target.value.length;
            const characterCode = event.target.value.substr(-1).charCodeAt(0);

            if (newLength > previousLengthVisi) {
                if (characterCode === 10) {
                event.target.value = `${event.target.value}${bullet} `;
                } else if (newLength === 1) {
                event.target.value = `${bullet} ${event.target.value}`;
                }
            }
        
            previousLengthVisi = newLength;
        }

        let previousLengthMisi = 0;
        const handleInputMisi = (event, lengthMisi = previousLengthMisi) => {
            const bullet = "•";
            const newLength = event.target.value.length;
            const characterCode = event.target.value.substr(-1).charCodeAt(0);

            if (newLength > previousLengthMisi) {
                if (characterCode === 10) {
                event.target.value = `${event.target.value}${bullet} `;
                } else if (newLength === 1) {
                event.target.value = `${bullet} ${event.target.value}`;
                }
            }
        
            previousLengthMisi = newLength;
        }
    </script>
@endpush