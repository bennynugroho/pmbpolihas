@extends('layout.app')

@push('after-style')
    <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>
@endpush

@push('after-script')
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <script>
        @if (Session::has('success'))
            $(document).ready(function(){
                Swal.fire(
                    'Terkirim',
                    `{{ session('success') }}`,
                    'success'
                );
            });
        @endif
    </script>
@endpush

@section('main')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg pt-110">
        <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Kontak</h2>
            <p>Kontak Kami</p>
        </div>

        <div class="row">

            <div class="col-lg-6">

            <div class="row">
                <div class="col-md-12">
                    <div class="info-box">
                        <i class="bx bx-map"></i>
                        <h3>Alamat Kampus</h3>
                        <p>Ray V, Jl. Brigjen H. hasan Basri, Handil Bakti, Kec. Alalak, Kabupaten Barito Kuala, Kalimantan Selatan 70582</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box mt-4">
                        <i class="bx bx-envelope"></i>
                        <h3>Email</h3>
                        <p>{{ $kontak->email }}<br>Kirimi kami pertanyaan kapan saja!</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box mt-4">
                        <i class="bx bx-phone-call"></i>
                        <h3>No. Telepon</h3>
                        <p>{{ $kontak->telepon }}<br>Sen s/d Jum | 07.30 - 16.30</p>
                    </div>
                </div>
            </div>

            </div>

            <div class="col-lg-6">
                <form action="{{ route('kirim.pesan') }}" method="post" role="form" class="php-email-form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="nama" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="text" class="form-control" name="subyek" id="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="pesan" rows="5" placeholder="Message" required></textarea>
                    </div>
                    <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div class="text-center"><button type="submit">Send Message</button></div>
                </form>
            </div>

        </div>

        </div>
    </section><!-- End Contact Section -->
@endsection