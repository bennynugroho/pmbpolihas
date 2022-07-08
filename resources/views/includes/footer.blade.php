@if (!isset($navbar))
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="footer-info">
                    <h3>Lokasi Kampus</h3>
                    <p class="pb-3"><em>Ray V, Jl. Brigjen H. hasan Basri, Handil Bakti, Kec. Alalak, Kabupaten Barito Kuala, Kalimantan Selatan 70582</em></p>
                    <p>
                        <strong>Phone:</strong> {{ $kontak->telepon }}<br>
                        <strong>Email:</strong> {{ $kontak->email }}<br>
                    </p>
                    <div class="social-links mt-3">
                        <a href="{{ $kontak->twitter }}" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="{{ $kontak->facebook }}" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="{{ $kontak->instagram }}" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-6 footer-links">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3983.462502632767!2d114.6201257146738!3d-3.2344798976450995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de4230bff29bd8b%3A0x9b8228278b99e443!2sPoliteknik%20Hasnur!5e0!3m2!1sid!2sid!4v1642410669893!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            Copyright &copy; 2022 <strong><span>Politeknik Hasnur</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/multi-responsive-bootstrap-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer>
@endif