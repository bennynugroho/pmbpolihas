@extends('layout.admin')

@push('after-script')
    @include('partials.deleteData')
    
    <script>
        let tableChat = document.querySelector('#tableChat');
        let dataTable = new simpleDatatables.DataTable(tableChat);
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="page-title">
            <div class="row text-nowrap">
                <div class="col-6">
                    <h3 class="card-title mb-0">Data Chat Bot</h3>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('chat.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i> Tambah</a>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card my-3">
                <div class="card-body">
                    <div class="table-responsive py-3">
                        <table id="tableChat" class="table table-hover table-striped py-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chat as $cht)
                                    <tr>
                                        <td class="align-baseline">{{ $loop->iteration }}</td>
                                        <td class="align-baseline">{{ $cht->pertanyaan }}</td>
                                        <td class="align-baseline">{!! $cht->jawaban !!}</td>
                                        <td class="text-nowrap align-baseline">
                                            <button class="btn btn-danger btn-sm" onclick="deleteData('{{ route('chat.destroy', ['chat' => $cht->id]) }}')"><i class="bi bi-x"></i></button>
                                            <a href="{{ route('chat.edit', ['chat' => $cht->id]) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
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
@endsection

@push('after-script')
    @include('partials.deleteData')
@endpush