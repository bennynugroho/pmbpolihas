@extends('layout.admin')

@section('content')
    @if (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: {{ session('success') }},
                showConfirmButton: true,
            }).then(function(){
                location.reload();
            });
        </script>
    @endif

    <div class="row">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3 class="mb-0">Data Kurikulum</h3>
                </div>
                <div class="col-6 text-end">
                    <button class="btn btn-primary" onclick="showCreateKurikulum('{{ route('kurikulum.store') }}', 'Tambah Kurikulum')"><i class="bi bi-plus-circle-fill"></i> Tambah</button>
                </div>
            </div>
        </div>

        {{-- card Kurikulum --}}
        <div class="col-12">
            <div class="card my-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableKurikulum" class="table table-hover table-striped py-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Program Studi</th>
                                    <th>Semester</th>
                                    <th>Kode</th>
                                    <th>Mata Kuliah</th>
                                    <th>SKS Teori</th>
                                    <th>SKS Praktek</th>
                                    <th>Jam</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kurikulum as $k => $kur)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $kur->prodi->nama }}</td>
                                        <td>{{ $kur->semester }}</td>
                                        <td>{{ $kur->kode }}</td>
                                        <td>{{ $kur->mata_kuliah }}</td>
                                        <td>{{ $kur->sks_teori }}</td>
                                        <td>{{ $kur->sks_praktek }}</td>
                                        <td>{{ $kur->jam }}</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-danger btn-sm" onclick="deleteData('{{ route('kurikulum.destroy', ['kurikulum' => $kur->id]) }}')"><i class="bi bi-x"></i></button>
                                            <button class="btn btn-success btn-sm" onclick="showEditKurikulum({{ $kur->id }}, '{{ route('kurikulum.update', ['kurikulum' => $kur->id]) }}', 'Edit Kurikulum')"><i class="bi bi-pencil-square"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- end card kurikulum --}}
    </div>

    {{-- modal kurikulum --}}
    <div class="modal fade" id="modalKurikulum" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKurikulumTitle">Tambah Kurikulum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kurikulum.store') }}" id="formModalKurikulum" method="POST">
                    <input type="hidden" name="_method" id="method-kurikulum" value="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3" id="headerModalKurikulum">
                            <div class="col-md-2 text-nowrap">
                                <button onclick="tambah()" type="button" data-toggle="tooltip" data-placement="top"
                                    title="Tambah Baris" class="btn btn-sm btn-primary"><i class="bi bi-plus-circle"></i>
                                </button>
                                <button onclick="hapus()" type="button" data-toggle="tooltip" data-placement="top"
                                    title="Hapus Baris" class="btn btn-sm btn-danger"><i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                            <div class="col-md-5" id="cover-prodi">
                                <select id="prodi-select" class="form-select" onchange="cek_prodi(this.value)">
                                    <option value="">-Pilih-</option>
                                    @foreach ($prodi as $pro)
                                        <option value="{{ $pro->id }}">{{ $pro->nama }}</option>
                                    @endforeach
                                </select>
                                <small id="alert-prodi" style="display: none;">wajib dipilih !</small>
                            </div>
                        </div>

                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Semester</th>
                                    <th>Kode</th>
                                    <th>Matkul</th>
                                    <th>SKS Teori</th>
                                    <th>SKS Praktik</th>
                                    <th>Jam</th>
                                </tr>
                            </thead>
                            <tbody id="insert-form">
                                <tr>
                                    <td>
                                        1.
                                    </td>
                                    <td>
                                        <input type="hidden" name="prodi[]">
                                        <input type="text" class="form-control" name="semester[]" id="semester" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="kode[]" id="kode-kur" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="mata_kuliah[]" id="mata_kuliah" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="sks_teori[]" id="sks_teori" class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="sks_praktek[]" id="sks_praktek"  class="form-control">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="jam[]" id="jam-kur" class="form-control">
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <input type="hidden" id="jumlah-form" value="1">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end modal kurikulum --}}
@endsection

@push('after-script')
    @include('partials.deleteData')

    <script>
        let tableKurikulum = document.querySelector('#tableKurikulum');
        let dataTableKur = new simpleDatatables.DataTable(tableKurikulum);

        // Kurikulum
        function cek_prodi(val) {
            $("#alert-prodi").slideUp();
            let prodi = $("input[name='prodi[]']").map(function() {
                return $(this).val(val)
            }).get()
        }

        function tambah() {
            let pd = $("#prodi-select").val()
            let jm = parseInt($("#jumlah-form").val());
            let next = jm + 1;

            if (pd == '') {
                $("#alert-prodi").css('color', 'red');
                $("#alert-prodi").slideDown();
            } else {
                $("#alert-prodi").slideUp();

                $("#insert-form").append(

                        '<tr class="row-insert-'+next+'"">'+
                            '<td>'+next+'.&nbsp; </td>'+
                            '<td>'+
                                '<input type="hidden" name="prodi[]" value="'+pd+'">'+
                                '<input type="text" name="semester[]" class="form-control">'+
                            '</td>'+
                            '<td>'+
                                '<input type="text" name="kode[]" class="form-control">'+
                            '</td>'+
                            '<td>'+
                                '<input type="text" name="mata_kuliah[]" class="form-control">'+
                            '</td>'+
                            '<td>'+
                                '<input type="text" name="sks_teori[]" class="form-control">'+
                            '</td>'+
                            '<td>'+
                                '<input type="text" name="sks_praktek[]" class="form-control">'+
                            '</td>'+
                            '<td>'+
                                '<input type="number" name="jam[]" class="form-control">'+
                            '</td>'+
                        '</tr>'
                );
                $("#jumlah-form").val(next);
            }
        }

        function hapus() {
            let total_row = $('#jumlah-form').val();
            
            $('.row-insert-'+ total_row).remove();
            if(total_row > 1){
                $("#jumlah-form").val(total_row - 1);
            }
        }

        function showCreateKurikulum(url, title){
            $('#modalKurikulumTitle').html(title);
            $('#formModalKurikulum').attr('action', url);
            $('#method-kurikulum').val('post');
            $('#headerModalKurikulum').show();
            $('#semester').val('');
            $('#kode-kur').val('');
            $('#mata_kuliah').val('');
            $('#sks_teori').val('');
            $('#sks_praktek').val('');
            $('#jam-kur').val('');
            $('#semester').attr('name', 'semester[]');
            $('#kode-kur').attr('name', 'kode[]');
            $('#mata_kuliah').attr('name', 'mata_kuliah[]');
            $('#sks_teori').attr('name', 'sks_teori[]');
            $('#sks_praktek').attr('name', 'sks_praktek[]');
            $('#jam-kur').attr('name', 'jam[]');
            $('#modalKurikulum').modal('show');
        }

        function showEditKurikulum(id, url, title){
            $.ajax({
                url: `/admin/kurikulum/${id}/edit`,
                type: 'get',
                success: function(data) {
                    $('#modalKurikulumTitle').html(title);
                    $('#formModalKurikulum').attr('action', url);
                    $('#method-kurikulum').val('put');
                    $('#headerModalKurikulum').hide();
                    $('#semester').val(data.semester);
                    $('#kode-kur').val(data.kode);
                    $('#mata_kuliah').val(data.mata_kuliah);
                    $('#sks_teori').val(data.sks_teori);
                    $('#sks_praktek').val(data.sks_praktek);
                    $('#jam-kur').val(data.jam);
                    $('#semester').attr('name', 'semester');
                    $('#kode-kur').attr('name', 'kode');
                    $('#mata_kuliah').attr('name', 'mata_kuliah');
                    $('#sks_teori').attr('name', 'sks_teori');
                    $('#sks_praktek').attr('name', 'sks_praktek');
                    $('#jam-kur').attr('name', 'jam');
                    $('#modalKurikulum').modal('show');
                }
            });
        }
    </script>
@endpush