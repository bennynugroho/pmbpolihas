@extends('layout.app')

@section('main')
    <div class="row pt-110">
        <div class="col justify-content-center text-center">
            <img src="{{ asset('assets/img/picture/registration_success.png') }}" width="266px" height="266px" alt="">

            <h3>Yay! Pendaftaran Sukses</h3>
            <p>Kami akan menghubungi anda terkait pendaftaran PMB Polihasnur</p>
            
            <a href="/" class="btn btn-outline-app" id="btn-home">Home Page</a>
            <a href="{{ route('download.formulir', ['email' => $pendaftar->email]) }}" target="_blank" onclick="showBtnHome()" class="btn btn-app-secondary">Download Formulir</a>
        </div>
    </div>
@endsection

@push('after-script')
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <script>
        localStorage.clear();
        
        $(document).ready(function(){
            $('#btn-home').hide();
        });

        function showBtnHome(){
            $('#btn-home').show();
        }
    </script>
@endpush