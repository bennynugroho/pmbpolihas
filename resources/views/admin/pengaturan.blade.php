@extends('layout.admin')

@push('after-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/dropify/css/dropify.min.css') }}">
@endpush

@push('after-script')
    @include('partials.deleteData')

    <script src="{{ asset('assets/vendor/dropify/js/dropify.min.js') }}"></script>
    <script>
        $('.dropify').dropify({});
    </script>
    
    <script>
        $(document).ready(function(){
            // Persyaratan
            $('#createFormPersyaratan').hide();
            showTableSyarat();

            // Sumber Informasi
            $('#createFormSumber').hide();
            showTableSumber();
        });

        // Tahun Akademik
        function showCreateTahun(url, title){
            $.ajax({
                url: `{{ route('tahun_akd.create') }}`,
                type: 'get',
                success: function(data) {
                    $('#titleModalSmall').html(title);
                    $('#formModalSmall').attr('action', url);
                    $('#bodyModalSmall').html(data);
                    
                    $('#modalSmall').modal('show');
                }
            });
        }

        function showEditTahun(id, url_edit, url_update, title){
            $.ajax({
                url: url_edit,
                type: 'get',
                success: function(data) {
                    $('#titleModalSmall').html(title);
                    $('#formModalSmall').attr('action', url_update);
                    $('#method-small').val('put');
                    $('#bodyModalSmall').html(data);
                    
                    $('#modalSmall').modal('show');
                }
            });
        }

        function updateStatusTahun(id){
            let status = $('#checkbox-status-thn-'+ id).is(':checked') ? '1' : '0';

            $.ajax({
                type: "get",
                url: "/admin/status-tahun",
                data: {
                    "id": id,
                    "status": status
                },
                success: function (d) {
                    if (d == 1) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                            icon: 'warning',
                            title: 'Status dinonaktifkan'
                        })
                    } else if (d == 2) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                            icon: 'success',
                            title: 'Status berhasil diaktifkan'
                        })
                    } else {
                        $('#checkbox-status-thn-'+ id).prop('checked', false);
                        
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                            icon: 'info',
                            title: 'Nonaktifkan status yang ada terlebih dahulu'
                        })
                    }
                }
            })
        }

        // Akun Admin
        function showFormPass(){
            $('#form-pass').slideDown();
            $('#btn-hide-pass').show();
            $('#btn-show-pass').hide();
        }

        function hideFormPass(){
            $('#form-pass').slideUp();
            $('#btn-hide-pass').hide();
            $('#btn-show-pass').show();
            $('#input-password').val('');
        }

        function changeTypePass(){
            let type = $('#input-password').prop('type');

            if(type == 'password'){
                $('#input-password').prop('type', 'text');
                $('#changeTypePass').html('<i class="bi bi-eye-slash"></i>');
            }else{
                $('#input-password').prop('type', 'password');
                $('#changeTypePass').html('<i class="bi bi-eye"></i>');
            }
        }

        function showEditAkun(id, url_edit, url_update, title){
            $.ajax({
                url: url_edit,
                type: 'get',
                data: {
                    'id' : id,
                },
                success: function(data) {
                    $('#titleModalSmall').html(title);
                    $('#formModalSmall').attr('action', url_update);
                    $('#method-small').val('post');
                    $('#bodyModalSmall').html(data);
                    
                    $('#modalSmall').modal('show');
                }
            });
        }


        // Persyaratan
        function showTableSyarat(){
            $.ajax({
                url: '/admin/syarat',
                type: 'get',
                success: function(data) {
                    let view;

                    for (let i = 0; i < data.length; i++) {
                        view += `<tr>
                                    <td>${i+1}</td>
                                    <td>${data[i].syarat}</td>
                                    <td class="text-nowrap">
                                        <button class="btn btn-danger btn-sm" onclick="deleteData('/admin/syarat/${data[i].id}')"><i class="bi bi-x"></i></button>
                                        <button class="btn btn-success btn-sm" onclick="showEditSyarat('${data[i].id}', 'Ubah Persyaratan')"><i class="bi bi-pencil-square"></i></button>
                                    </td>
                                </tr>`;
                    }

                    $('#bodyTablePersyaratan').html(view);
                }
            });
        }

        function showCreateSyarat(){
            $('#createFormPersyaratan').toggle('swing');
        }

        function showEditSyarat(id, title){
            $.ajax({
                url: `/admin/syarat/${id}/edit`,
                type: 'get',
                success: function(data) {
                    $('#titleModalSmall').html(title);
                    $('#formModalSmall').attr('action', `/admin/syarat/${id}`);
                    $('#method-small').val('put');
                    $('#bodyModalSmall').html(data);
                    
                    $('#modalSmall').modal('show');
                }
            });
        }

        // Info Pendaftaran
        function showEditInfo(url_edit, url_update, title){
            $.ajax({
                url: url_edit,
                type: 'get',
                success: function(data) {
                    $('#titleModalNormal').html(title);
                    $('#formModalNormal').attr('action', url_update);
                    $('#method-normal').val('post');
                    $('#bodyModalNormal').html(data);
                    
                    $('#modalNormal').modal('show');
                }
            });
        }

        // Biaya Kuliah
        function showEditBiaya(url_edit, url_update, title){
            $.ajax({
                url: url_edit,
                type: 'get',
                success: function(data) {
                    $('#titleModalSmall').html(title);
                    $('#formModalSmall').attr('action', url_update);
                    $('#method-small').val('put');
                    $('#bodyModalSmall').html(data);
                    
                    $('#modalSmall').modal('show');
                }
            });
        }

        // Formulir Pendaftaran
        function showEditFormulir(url){
            $('#formModalFormulir').prop('action', url);

            $('#modalFormulir').modal('show');
        }

        // Sumber Informasi Pendaftaran
        function showTableSumber(){
            $.ajax({
                url: '/admin/sumber_info',
                type: 'get',
                success: function(data) {
                    $('#bodyTableSumber').html(data);
                }
            });
        }

        function showCreateSumber(){
            $('#createFormSumber').toggle('swing');
        }

        function showEditSumber(id, title){
            $.ajax({
                url: `/admin/sumber_info/${id}/edit`,
                type: 'get',
                success: function(data) {
                    $('#titleModalSmall').html(title);
                    $('#formModalSmall').attr('action', `/admin/sumber_info/${id}`);
                    $('#method-small').val('put');
                    $('#bodyModalSmall').html(data);
                    
                    $('#modalSmall').modal('show');
                }
            });
        }
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-biaya-tab" data-bs-toggle="pill" data-bs-target="#pills-biaya" type="button" role="tab" aria-controls="pills-biaya" aria-selected="true">Biaya Kuliah</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-syarat-tab" data-bs-toggle="pill" data-bs-target="#pills-syarat" type="button" role="tab" aria-controls="pills-syarat" aria-selected="false">Pendaftaran</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-formulir-tab" data-bs-toggle="pill" data-bs-target="#pills-formulir" type="button" role="tab" aria-controls="pills-formulir" aria-selected="false">Formulir</button>
                        </li>
                    </ul>
                    <div class="tab-content mt-4" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-biaya" role="tabpanel" aria-labelledby="pills-biaya-tab">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Program Studi</th>
                                            <th>Uang Pangkal</th>
                                            <th>SPP</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($biaya as $b)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $b->prodi->nama }}</td>
                                                <td>{{ $b->getUangPangkal }}</td>
                                                <td>{{ $b->getSpp }}</td>
                                                <td class="text-nowrap">
                                                    <button class="btn btn-success btn-sm" onclick="showEditBiaya('{{ route('biaya.edit', ['biaya' => $b->id]) }}', '{{ route('biaya.update', ['biaya' => $b->id]) }}', 'Ubah Biaya Kuliah')"><i class="bi bi-pencil-square"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-syarat" role="tabpanel" aria-labelledby="pills-syarat-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex mb-3 align-items-center">
                                        <div class="bd-highlight me-auto">
                                            <h5>Persyaratan :</h5>
                                        </div>
                                        <div class="bd-highlight">
                                            <button class="btn btn-primary" onclick="showCreateSyarat()"><i class="bi bi-plus-circle-fill"></i> Tambah</button>
                                        </div>
                                    </div>

                                    <div id="createFormPersyaratan" class="mb-3">
                                        <form action="{{ route('syarat.store') }}" method="POST">
                                            @csrf
                                            <div class="row align-items-center">
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="syarat" id="nama-syarat" placeholder="Masukkan persyaratan">
                                                </div>
                                                <div class="col-2 text-end">
                                                    <button class="btn btn-primary"><i class="bi bi-send-plus"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Persyaratan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="bodyTablePersyaratan">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <tr>
                                                <td>Masa Pendaftaran</td>
                                                <td>:</td>
                                                <td>{{ $infoDaftar->getTanggalAwal }} - {{ $infoDaftar->getTanggalAkhir }}</td>
                                            </tr>
                                            <tr>
                                                <td>Terakhir Pembayaran</td>
                                                <td>:</td>
                                                <td>{{ $infoDaftar->getTanggalBayar }}</td>
                                            </tr>
                                            <tr>
                                                <td>Bank</td>
                                                <td>:</td>
                                                <td>{{ $infoDaftar->bank }}</td>
                                            </tr>
                                            <tr>
                                                <td>Rekening</td>
                                                <td>:</td>
                                                <td>{{ $infoDaftar->rekening }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-success" onclick="showEditInfo('{{ route('admin.edit.info', ['id' => $infoDaftar->id]) }}', '{{ route('admin.update.info', ['id' => $infoDaftar->id]) }}', 'Ubah Info Pendaftaran')"><i class="bi bi-pencil-square"></i> Ubah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-formulir" role="tabpanel" aria-labelledby="pills-formulir-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="bd-highlight me-auto">
                                            <h5 class="pt-2">Formulir Pendaftaran</h5>
                                        </div>
                                    </div>
                                    <iframe src="{{ $formulir->getPath }}" class="w-100" height="500px" frameborder="0"></iframe>
                
                                    <div class="text-end mt-3">
                                        <button class="btn btn-success" onclick="showEditFormulir('{{ route('admin.update.formulir', ['id' => $formulir->id]) }}')"><i class="bi bi-pencil-square"></i> Ubah</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bd-highlight me-auto">
                                            <h5 class="mb-0">Sumber Informasi Pendaftaran</h5>
                                        </div>
                                        <div class="bd-highlight">
                                            <button class="btn btn-primary" onclick="showCreateSumber()"><i class="bi bi-plus-circle-fill"></i> Tambah</button>
                                        </div>
                                    </div>
                                    <div id="createFormSumber" class="mb-3">
                                        <form action="{{ route('sumber_info.store') }}" method="POST">
                                            @csrf
                                            <div class="row align-items-center">
                                                <div class="col-10">
                                                    <input type="text" class="form-control" name="sumber_info" placeholder="Masukkan Sumber Informasi">
                                                </div>
                                                <div class="col-2 text-end">
                                                    <button type="submit" class="btn btn-primary"><i class="bi bi-send-plus"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Sumber</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="bodyTableSumber">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card my-3">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="bd-highlight me-auto">
                            <h5 class="mb-0"><i class="bi bi-calendar"></i> Tahun Akademik</h5>
                        </div>
                        <div class="bd-highlight">
                            <button class="btn btn-primary" onclick="showCreateTahun('{{ route('tahun_akd.store') }}', 'Tambah Tahun Akademik')"><i class="bi bi-plus-circle-fill"></i> Tambah</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Akademik</th>
                                    <th>Status Aktif</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tahun_akd as $thn)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $thn->tahun }}</td>
                                        <td>
                                            <div class="switch">
                                                <label>
                                                    <input type="checkbox" id="checkbox-status-thn-{{ $thn->id }}" value="{{ $thn->id }}" onchange="updateStatusTahun('{{ $thn->id }}')" {{ $thn->status == 1 ? 'checked' : '' }}>
                                                    <span class="lever switch-col-blue"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-danger btn-sm" onclick="deleteData('{{ route('tahun_akd.destroy', ['tahun_akd' => $thn->id]) }}')"><i class="bi bi-x"></i></button>
                                            <button class="btn btn-success btn-sm" onclick="showEditTahun('{{ $thn->id }}', '{{ route('tahun_akd.edit', ['tahun_akd' => $thn->id]) }}', '{{ route('tahun_akd.update', ['tahun_akd' => $thn->id]) }}', 'Ubah Tahun Akademik')"><i class="bi bi-pencil-square"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card my-3">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="bd-highlight me-auto">
                            <h5 class="mb-0"><i class="bi bi-person-lines-fill"></i> Akun Admin</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $akun->nama }}</td>
                                    <td>{{ $akun->email }}</td>
                                    <td class="text-nowrap">
                                        <button class="btn btn-success btn-sm" onclick="showEditAkun('{{ $akun->id }}', '{{ route('admin.edit.akun') }}', '{{ route('admin.update.akun', ['id' => $akun->id]) }}', 'Ubah Akun Admin')"><i class="bi bi-pencil-square"></i> Ubah</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal small --}}
    <div class="modal fade" id="modalSmall" tabindex="-1" aria-labelledby="modalSmall" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalSmall">Ubah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formModalSmall" action="" method="POST">
                    <input type="hidden" name="_method" id="method-small" value="post">
                    @csrf
                    <div class="modal-body" id="bodyModalSmall">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal small --}}

    {{-- modal normal --}}
    <div class="modal fade" id="modalNormal" tabindex="-1" aria-labelledby="modalNormal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalNormal">Ubah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formModalNormal" action="" method="POST">
                    <input type="hidden" name="_method" id="method-normal" value="post">
                    @csrf
                    <div class="modal-body" id="bodyModalNormal">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal normal --}}

    <!-- Modal Dropify -->
    <div class="modal fade" id="modalFormulir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalFormulir">Ubah Formulir Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="formModalFormulir" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input-formulir" class="form-label">Formulir Pendaftaran</label>
                            <input type="file" class="dropify" name="formulir" id="input-formulir" data-default-file="{{ $formulir->getPath }}" data-height="300" />
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
@endsection