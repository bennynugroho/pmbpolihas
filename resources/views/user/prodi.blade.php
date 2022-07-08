@extends('layout.app')

@section('main')
    <div class="pt-5">
        @foreach ($prodi as $pro)
            <section id="prodi" class="about {{ $loop->iteration % 2 == 0 ? 'section-bg' : '' }}">
                <div class="container" data-aos="fade-up">
                    <div class="row content">
                        <div class="col-lg-6">
                            <div class="section-title">
                                <h2>Prodi</h2>
                                <p>{{ $pro->nama }}</p>
                            </div>
                            <div class="mb-3">
                                <h5>Visi :</h5>
                                <ul>
                                    @foreach ($pro->getVisi as $visi)
                                        <li><i class="ri-check-double-line"></i> {{ trim($visi, '\r\n') }}</li>
                                    @endforeach
                                </ul>
                            </div>
        
                            <h5>Misi :</h5>
                            <ul>
                                @foreach ($pro->getMisi as $misi)
                                    <li><i class="ri-check-double-line"></i> {{ trim($misi, '\r\n') }}</li>
                                @endforeach
                            </ul>
                            <a href="/prodi/{{ $pro->slug }}">Kurikulum »</a>
                        </div>
                        <div class="col-lg-6 text-end pt-4 pt-lg-0">
                            <img src="{{ $pro->getFoto }}" class="img-thumbnail" width="450" alt="">
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    </div>
@endsection