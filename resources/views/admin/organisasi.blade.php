@extends('layout.admin')

@section('content')
    <div class="row">
        <div class="card my-3">
            <div class="card-body">
                <h3>Data Organisasi</h3>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-body">
                <div class="table-responsive py-3">
                    <table id="table-organisasi" class="table table-hover table-striped py-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Organisasi</th>
                                <th>Jumlah Anggota</th>
                                <th>Logo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organisasi as $r => $org)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $org->nama }}</td>
                                    <td>{{ $org->jum_anggota }}</td>
                                    <td>
                                        <img src="{{ $org->getLogo }}" class="img-fluid">
                                    </td>
                                    <td class="text-nowrap">
                                        <button class="btn btn-danger btn-sm"><i class="bi bi-x"></i></button>
                                        <button class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <script>
        $(document).ready(function() {
            $('#table-organisasi').DataTable();
        });
    </script>
@endpush