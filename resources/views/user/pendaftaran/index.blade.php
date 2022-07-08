@extends('layout.app')

@push('after-style')
    <style>
        .count-box{
            border-radius: 5%;
        }
    </style>
@endpush

@section('main')
    <!-- ======= About Section ======= -->
    <section id="alur" class="about pb-0 pt-110">
        <div class="container" data-aos="fade-up">
            <div class="section-title pb-3">
                <h2>Alur</h2>
                <p>Alur Pendaftaran</p>
            </div>
        </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">

        <div class="row no-gutters">

            <div class="col-md-4 d-md-flex my-md-0 my-3 align-items-md-stretch">
                <div class="count-box">
                    <h4>1. Melengkapi Berkas</h4>
                    <p class="pt-0">
                        <strong>Offline</strong>
                        <br>
                        Pendaftaran secara offline dilakukan dengan langsung mendatangi kampus Politeknik Hasnur yang beralamat di Jl. Brigjen H. Hasan Basri, Handil Bakti Kec. Alalak - Kalsel. Pedaftar wajib membawa serta dokumen-dokumen berikut:
                    </p>
                    <p class="pt-0">
                        @foreach ($syarat as $syr)
                            - {{ $syr->syarat }}
                            <br>
                        @endforeach
                        {{-- - Fotocopy Ijazah & SKHU berlegalisir (KTP)
                        <br>
                        - Fotocopy Raport dari semester 1 sampai akhir
                        <br>
                        - Fotocopy KTP/ Kartu Pelajar
                        <br> --}}
                    </p>

                    <p class="pt-3">
                        <strong>Online</strong>
                        <br>
                        Untuk melakukan pendaftaran secara online, silakan klik di sini!
                    </p>

                    <p class="pt-3">
                        <strong>Hubungi Via WA :</strong>
                        <br>
                        <i class="bi bi-whatsapp me-1" style="font-size: inherit;"></i> {{ $kontak->telepon }}
                    </p>
                </div>
            </div>
            <div class="col-md-4 d-md-flex my-md-0 my-3 align-items-md-stretch">
                <div class="count-box">
                    <h4>2. Mengikuti Ujian Masuk</h4>
                    <p class="pt-0">
                        Seluruh peserta PMB wajib mengikuti tes masuk yang akan ditentukan oleh pihak kampus. Hasil seleksi akan diumumkan melalui laman Pengumuman Kelulusan di portal PMB Polihasnur. Selain itu, informasi seleksi juga dapat diakses melalui media penyiaran Polihasnur lainnya, seperti Mading Polihasnur, dan lain sebagainya.
                    </p>
                </div>
            </div>
            <div class="col-md-4 d-md-flex my-md-0 my-3 align-items-md-stretch">
                <div class="count-box">
                    <h4>3. Daftar Ulang</h4>
                    <p class="pt-0">
                        Setelah dinyatakan lulus dari Ujian Masuk, peserta tes melakukan pendaftaran ulang dengan menyetor biaya pendaftaran dan uang pangkal ke Politeknik Hasnur. Pembayaran dilakukan melalui transfer bank pada nomor rekening {{ $infoDaftar->bank }} Politeknik Hasnur {{ $infoDaftar->rekening }}. Selain itu, dapat pula dilakukan secara tunai dengan membayar langsung di Kampus Politeknik Hasnur. Pembayaran dilakukan selambat-lambatnya tanggal <strong>{{ $infoDaftar->getTanggalBayar }}</strong>.
                    </p>
                </div>
            </div>

        </div>

        </div>
    </section><!-- End Counts Section -->

    <section id="biaya" class="section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title pb-3">
                <h2>Biaya</h2>
                <p>Biaya PMB</p>
            </div>
            <table class="table table-responsive">
                <thead>
                    <th>No.</th>
                    <th>Program Studi</th>
                    <th>Uang Pangkal</th>
                    <th>SPP/semester</th>
                </thead>
                <tbody>
                    @foreach ($biaya as $by)
                        @if ($by->uang_pangkal != null && $by->spp != null)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $by->prodi->nama }}</td>
                                <td>{{ $by->getUangPangkal }}</td>
                                <td>{{ $by->getSpp }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection