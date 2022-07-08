@extends('layout.admin')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
@endpush

@section('content')
    <div class="row">    
        <div class="page-title mb-3">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title mb-0">Data Prodi</h3>
                </div>
                <div class="col-6 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProdi"><i class="bi bi-plus-circle-fill"></i> Tambah</button>
                </div>
            </div>
        </div>

        @foreach ($prodi as $pro)
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <img src="{{ $pro->getFoto }}" class="img-fluid mb-3 rounded card-img" alt="">
                            <h5 class="card-title">{{ $pro->nama }}</h5>
                            <p class="fw-bold card-text" onclick="showDeskProdi({{ $pro->id }})" role="button">Baca Deskripsi</p>
                            <button class="btn btn-danger btn-sm round" onclick="deleteData('{{ route('prodi.destroy', ['prodi' => $pro->id]) }}')"><i class="bi bi-trash"></i></button>
                            <a href="{{ route('prodi.edit', ['prodi' => $pro->id]) }}" class="btn btn-success btn-sm round"><i class="bi bi-pencil-square"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Prodi -->
    <div class="modal fade" id="modalProdi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProdiTitle">Tambah Prodi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('prodi.store') }}" id="formModalProdi" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" id="method-prodi" value="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama-prodi" class="form-label">Nama Program Studi</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama-prodi" value="{{ old('nama') }}" placeholder="Masukkan nama program studi">
                            @error('nama')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="visi" class="form-label">Visi</label>
                            <textarea name="visi" id="visi" class="form-control" cols="30" rows="4" oninput="handleInputVisi(event)" placeholder="Masukkan visi program studi">{{ old('visi') }}</textarea>
                            @error('visi')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="misi" class="form-label">Misi</label>
                            <textarea name="misi" id="misi" class="form-control" cols="30" rows="4" oninput="handleInputMisi(event)" placeholder="Masukkan misi program studi">{{ old('misi') }}</textarea>
                            @error('misi')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="foto">Foto</label>
                            <input type="file" name="foto" id="foto" class="dropify" data-height="200" data-default-file="{{ asset('') }}"/>
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

    <!-- Modal Deskripsi -->
    <div class="modal fade" id="modalDeskripsi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="titleModalDesk">Prodi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodyModalDesk">
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    @include('partials.deleteData')
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

        // Prodi
        function showDeskProdi(id){
            $.ajax({
                url: `/admin/prodi/${id}`,
                type: 'get',
                success: function(data) {
                    $('#bodyModalDesk').html(data);
                    $('#modalDeskripsi').modal('show');
                }
            });
        }

        // function createSlug(prodi){
        //     $.ajax({
        //         url: `/admin/createSlug/${prodi}`,
        //         type: 'get',
        //         success: function(data) {
        //             $(`#slug`).val(data.slug);
        //         }
        //     });
        // }

        // function showEditProdi(id, url, title){
        //     $.ajax({
        //         url: `/admin/prodi/${id}/edit`,
        //         type: 'get',
        //         success: function(data) {
        //             $('#modalProdiTitle').html(title);
        //             $('#formModalProdi').attr('action', url);
        //             $('#method-prodi').val('put');
        //             $('#nama-prodi').val(data.nama);
        //             $('#visi').val(data.visi);
        //             $('#misi').val(data.misi);
        //             $('#foto').attr('data-default-file', '{{ asset("storage/prodi/") }}'+ data.foto);
        //             $('#input-slug').hide();

        //             $('#modalProdi').modal('show');
        //         }
        //     });
        // }
    </script>
@endpush