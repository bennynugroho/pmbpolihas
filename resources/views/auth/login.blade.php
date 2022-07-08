@extends('layout.auth')

@push('after-style')
    <style>
        .card{
            border-radius: 3%;
        }

        .input-group{
            width: 100%;
            margin-bottom: 20px;
            flex-wrap: nowrap;
        }

        .input-group .input-group-addon{
            border: none;
            background-color: transparent;
            padding-left: 0;
            font-weight: bold;
            align-self: center !important;
            margin-right: 15px;
        }

        .input-group input{
            border: none;
        }

        .input-group .form-line{
            display: inline-block;
            width: 100%;
            position: relative;
        }

        .input-group .form-control{
            padding-left: 0px;
            padding-right: 0px;
            border-bottom: 1px solid #ddd;
            border-radius: 0px;
        }

        .input-group .form-control:focus{
            border-bottom: 2px solid #2b7fc4;
            box-shadow: none;
            border-radius: 0px;
        }
    </style>
@endpush

@section('content')
    <div class="row justify-content-center" style="margin-top: 70px">
        <div class="col-4">
            <div class="card">
                <div class="card-body p-4">
                    <div class="text-center" >
                        <img src="{{ asset('assets/img/picture/logo_polihasnur.png') }}" width="125" height="125" alt="">
                        <p class="fs-5 text-dark">Sistem Informasi Penerimaan Mahasiswa Baru Politeknik Hasnur </p>
                        <p class="fs-5 text-dark">LOGIN</p>
                    </div>

                    @if (session('errors'))
                        <div class="col">
                            <div class="alert alert-danger alert-dismissible fade show align-items-center" role="alert">
                                Oopps. Terdapat Kesalahan Pada Inputan :
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('auth.post.login') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <div class="form-line">
                                <input type="email" id="email" placeholder="Email Address" class="form-control" name="email" required autocomplete autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <div class="form-line">
                                <input type="password" id="password" placeholder="Password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <button class="btn btn-sm btn-primary" type="submit">SIGN IN</button>
                            </div>
                        </div>
                    </form>
                </div>              
            </div>
        </div>
    </div>
@endsection