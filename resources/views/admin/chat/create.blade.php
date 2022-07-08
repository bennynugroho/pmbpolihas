@extends('layout.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="bd-highlight">
                            <h4 class="card-title mb-0">{{ $sub }}</h4>
                        </div>
                        <div class="bd-highlight ms-auto">
                            <a href="{{ route('chat.index') }}" class="btn btn-warning"><i class="bi bi-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ $url }}" method="POST">   
                        @if (@$chat)
                            @method('put')
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label for="pertanyaan" class="form-label">Pertanyaan</label>
                            <input type="text" class="form-control" name="pertanyaan" id="pertanyaan" value="{{ $chat->pertanyaan ?? old('pertanyaan') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="editor" class="form-label">Jawaban</label>
                            <textarea name="jawaban" id="editor">{{ $chat->jawaban ?? old('jawaban') }}</textarea>
                        </div>
                        <button class="btn btn-primary btn-block round">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    @include('partials.alert')
    @include('partials.ckeditor')
@endpush