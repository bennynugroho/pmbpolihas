@extends('layout.app')

@push('after-style')
    <style>
        .img-fluid{
            height: 100%;
            border-radius: 5px;
        }

        .icon-box{
            border-radius: 5px;
        }
    </style>
@endpush

@section('main')
    <!-- ======= Services Section ======= -->
    <section id="services" class="services pt-110">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Jalur</h2>
                <p>Jalur Masuk di Politeknik Hasnur</p>
            </div>

            @foreach ($jalur as $jlr)
                <div class="row mb-5" id="{{ $jlr->judul }}">
                    <div class="d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="col icon-box">
                            <div class="row">
                                <div class="col-lg-8 mb-lg-0 mb-5 text-start">
                                    <h4><a href="">{{ $jlr->judul }}</a></h4>
                                    <p>{{ $jlr->keterangan }}</p>
                                    <p>Pendaftaran untuk beasiswa ini akan berakhir pada: <strong>{{ $jlr->getTanggalAkhir }}</strong></p>
                                </div>
                                <div class="col-lg-4">
                                    <div class="icon" style="width: 100%; height: 100%;"><img src="{{ $jlr->getFoto }}" class="img-fluid" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section><!-- End Services Section -->
@endsection