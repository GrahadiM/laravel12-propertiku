<footer class="py-5 border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 text-center text-sm-start mb-3">
                <a href="{{ route('home') }}">
                    <img width="250" style="height: 120px; object-fit: cover" src="{{ asset('frontend/assets/images/icon_web.png') }}" alt="logo" />
                </a>
                <p class="title-alt mt-4">
                    <strong>{{ config('app.name', 'Studio Naadi - Hunian Impian Anda') }}</strong>: Temukan hunian impian dan investasi properti terbaik. Keamanan transaksi dan kenyamanan hunian adalah prioritas kami.
                </p>
            </div>
            <div class="col-lg-3 mb-3">
                <h5 class="mb-3">Navigasi</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0 p-1">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted">Beranda</a>
                    </li>
                    <li class="list-group-item border-0 p-1">
                        <a href="{{ route('property') }}" class="text-decoration-none text-muted">Daftar Properti</a>
                    </li>
                    <li class="list-group-item border-0 p-1">
                        <a href="{{ route('posts') }}" class="text-decoration-none text-muted">Artikel & Berita</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-2 mb-3">
                <h5 class="mb-3">Ikuti Kami</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0 p-1"><a href="#" class="text-decoration-none text-muted">Facebook</a></li>
                    <li class="list-group-item border-0 p-1"><a href="#" class="text-decoration-none text-muted">Instagram</a></li>
                    <li class="list-group-item border-0 p-1"><a href="#" class="text-decoration-none text-muted">Youtube</a></li>
                </ul>
            </div>
            <div class="col-lg-3 mb-3">
                <h5 class="mb-3">Hubungi Kami</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0 p-1">
                        <a href="mailto:grahadim178@gmail.com" class="text-decoration-none text-muted">grahadim178@gmail.com</a>
                    </li>
                    <li class="list-group-item border-0 p-1">
                        <span class="text-muted">3rd floor, 301, 2nd Main Rd, East of NGEF Layout Kasturi Nagar, Bengaluru, Karnataka – 560043</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container-fluid text-center py-4 border-top mt-4">
            <small>&copy; {{ date('Y') }} Grahadim Property • All rights reserved</small>
        </div>
    </div>
</footer>
