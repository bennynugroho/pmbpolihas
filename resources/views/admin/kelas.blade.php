@extends('layout.admin')

@push('after-script')
    @include('partials.deleteData')
    @include('partials.alert')
    
    <script>
        let tableKelas = document.querySelector('#tableKelas');
        let dataTable = new simpleDatatables.DataTable(tableKelas);
        
        function showEditKelas(url_edit, url_update, title){
            $.ajax({
                url: url_edit,
                type: 'get',
                success: function(data) {
                    $('#titleModalKelas').html(title);
                    $('#formModalKelas').attr('action', url_update);
                    $('#methodModalKelas').val('put');
                    $('#nama').val(data.nama);
                    $('#prodi').val(data.prodi_id);
                    
                    $('#modalKelas').modal('show');
                }
            });
        }
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="page-title">
            <div class="row text-nowrap">
                <div class="col-6">
                    <h3 class="card-title mb-0">Data Kelas</h3>
                </div>
                <div class="col-6 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKelas"><i class="bi bi-plus-circle-fill"></i> Tambah</button>
                </div>
            </div>
        </div>

        {{-- card kelas --}}
        <div class="col-12">
            <div class="card my-3">
                <div class="card-body">
                    <div class="table-responsive py-3">
                        <table id="tableKelas" class="table table-hover table-striped py-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Program Studi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kelas as $kls)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kls->nama }}</td>
                                        <td>{{ $kls->prodi->nama }}</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-danger btn-sm" onclick="deleteData('{{ route('kelas.destroy', ['kela' => $kls->id]) }}')"><i class="bi bi-x"></i></button>
                                            <button class="btn btn-success btn-sm" onclick="showEditKelas('{{ route('kelas.edit', ['kela' => $kls->id]) }}', '{{ route('kelas.update', ['kela' => $kls->id]) }}', 'Edit Kelas')"><i class="bi bi-pencil-square"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>  
        {{-- end card kelas --}}
    </div>

    <div class="modal fade" id="modalKelas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="mb-0" id="titleModalKelas">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formModalKelas" action="{{ route('kelas.store') }}" method="POST">
                    <input type="hidden" name="_method" id="methodModalKelas" value="post">
                    @csrf
                    <div class="modal-body" id="bodyModalkelas">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama kelas" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="prodi">Program Studi</label>
                            <select class="form-select" id="prodi" name="prodi" required>
                                <option value="">-Pilih Prodi-</option>
                                @foreach ($prodi as $pro)
                                    <option value="{{ $pro->id }}">{{ $pro->nama }}</option>
                                @endforeach
                            </select>
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