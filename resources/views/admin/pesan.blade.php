@extends('layout.admin')

@section('content')
    <div class="row">
        <div class="page-title">
            <h3>Data Pesan Masuk</h3>
        </div>

        <div class="col-12">
            <div class="card my-3">
                <div class="card-body">
                    <div class="table-responsive py-3">
                        <table id="tablePesan" class="table table-hover table-striped py-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Pesan</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesan as $p => $pes)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $pes->nama }}</td>
                                        <td>{{ $pes->email }}</td>
                                        <td>{{ $pes->subyek }}</td>
                                        <td>{{ $pes->pesan }}</td>
                                        <td>{{ $pes->getTanggalPesan }}</td>
                                        <td class="text-nowrap">
                                            <button class="btn btn-danger btn-sm" onclick="deleteData('{{ route('pesan.destroy', ['pesan' => $pes->id]) }}')"><i class="bi bi-x"></i></button>
                                            @if ($pes->balasan)
                                                <button class="btn btn-success btn-sm" onclick="showReadPesan('{{ route('pesan.show', ['pesan' => $pes->id]) }}')"><i class="bi bi-envelope-check"></i></button>
                                            @else
                                                <button class="btn btn-primary btn-sm" onclick="showBalasPesan('{{ route('pesan.show', ['pesan' => $pes->id]) }}', '{{ route('pesan.store', ['pesan_id' => $pes->id]) }}')"><i class="bi bi-arrow-return-left"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalPesan" tabindex="-1" aria-labelledby="modalPesan" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModalPesan">Balas Email</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formModalPesan" action="{{ route('pesan.store') }}" method="POST">
                @csrf
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Kepada</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="pesan" class="col-sm-2 col-form-label">Isi Pesan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="pesan" id="pesan" rows="4" readonly></textarea>
                            </div>
                        </div>

                        <hr>
                        <h5 class="text-center">Balasan Anda</h5>
                        <hr>

                        <div class="mb-3 row">
                            <label for="myEmail" class="col-sm-2 col-form-label">Email Saya</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="myEmail" id="myEmail" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="subjek" class="col-sm-2 col-form-label">Subjek</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subjek" id="subjek">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="balasan" class="col-sm-2 col-form-label">Balasan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="balasan" id="balasan" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="footerModalPesan">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    @include('partials.deleteData')

    <script>
        // $(document).ready(function() {
        //     $('#table-pesan').DataTable();
        // });

        let tablePesan = document.querySelector('#tablePesan');
        let dataTable = new simpleDatatables.DataTable(tablePesan);

        function showBalasPesan(url_show, url_store){
            $.ajax({
                url: url_show,
                type: 'GET',
                success: function(data) {
                    $('#titleModalPesan').html('Balas Email');
                    $('#formModalPesan').attr('action', url_store);
                    $('#email').val(data.email);
                    $('#pesan').val(data.pesan);
                    $('#myEmail').val(data.myEmail);
                    $('#subjek').val('-');
                    $('#balasan').val('');
                    $('#subjek').attr('readonly', false);
                    $('#balasan').attr('readonly', false);
                    $('#footerModalPesan').show();

                    $('#modalPesan').modal('show');
                }
            });
        }

        function showReadPesan(url_show){
            $.ajax({
                url: url_show,
                type: 'GET',
                success: function(data) {
                    $('#titleModalPesan').html('Balasan Anda');
                    $('#email').val(data.email);
                    $('#pesan').val(data.pesan);
                    $('#myEmail').val(data.myEmail);
                    $('#subjek').val(data.balasan.subjek);
                    $('#balasan').val(data.balasan.isi);
                    $('#subjek').attr('readonly', true);
                    $('#balasan').attr('readonly', true);
                    $('#footerModalPesan').hide();

                    $('#modalPesan').modal('show');
                }
            });
        }
    </script>
@endpush