@extends('layout.admin')

@push('after-script')
    @include('partials.alert')

    <script>
        function showEditModal(id, link) {
            $.ajax({
                url: link,
                type: 'GET',
                success: function(data) {
                    $('#facebook').val(data.facebook);
                    $('#twitter').val(data.twitter);
                    $('#instagram').val(data.instagram);
                    $('#youtube').val(data.youtube);
                    $('#email').val(data.email);
                    $('#telepon').val(data.telepon);

                    $('#modalEditData').modal('show');
                }
            });
        }
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="page-title">
                <h3>Data Kontak</h3>
            </div>
        </div>
        <div class="col-6 text-end">
            <button class="btn btn-success" onclick="showEditModal('{{ $kontak->id }}', '{{ route('kontak.edit', ['kontak' => $kontak->id]) }}')">
                <i class="bi bi-pencil-square"></i> Ubah
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-3">
                <div class="card-body">
                    <div class="table-responsive my-3">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Facebook</td>
                                    <td>:</td>
                                    <td><a href="{{ $kontak->facebook }}">{{ $kontak->facebook }}</a></td>
                                </tr>
                                <tr>
                                    <td>Twitter</td>
                                    <td>:</td>
                                    <td><a href="{{ $kontak->twitter }}">{{ $kontak->twitter }}</a></td>
                                </tr>
                                <tr>
                                    <td>Instagram</td>
                                    <td>:</td>
                                    <td><a href="{{ $kontak->instagram }}">{{ $kontak->instagram }}</a></td>
                                </tr>
                                <tr>
                                    <td>Youtube</td>
                                    <td>:</td>
                                    <td><a href="{{ $kontak->youtube }}">{{ $kontak->youtube }}</a></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><a href="{{ $kontak->email }}">{{ $kontak->email }}</a></td>
                                </tr>
                                <tr>
                                    <td>Telepon</td>
                                    <td>:</td>
                                    <td>{{ $kontak->telepon }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEditData" tabindex="-1" aria-labelledby="modalEditData" aria-hidden="true">
        <div class="modal-dialog" id="modalDialogEdit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditData">Edit Kontak</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kontak.update', ['kontak' => 1]) }}" method="POST" id="formEditModal">
                    @method('put')
                    @csrf
                    <div class="modal-body" id="bodyModalUpdate">
                        <div class="mb-3 row">
                            <label for="facebook" class="col-md-3 col-form-label">Facebook</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Masukkan link facebook" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="twitter" class="col-md-3 col-form-label">Twitter</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Masukkan link twitter" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="instagram" class="col-md-3 col-form-label">Instagram</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Masukkan link instagram" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="youtube" class="col-md-3 col-form-label">Youtube</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="youtube" id="youtube" placeholder="Masukkan link youtube" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-md-3 form-label">Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan link email" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="telepon" class="col-md-3 col-form-label">Telepon</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Masukkan nomor telepon" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btnSubmitUpdate">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection