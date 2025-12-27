    <footer class="py-5 border-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 text-center text-sm-start mb-3">
            <a href="{{ route('home') }}">
              <img
                width="250"
                style="height: 120px; object-fit: cover"
                src="{{ asset('frontend/assets/images/icon_web.png') }}"
                alt="logo"
              />
            </a>
            <p class="title-alt mt-4">
              Toba Travel: Mitra Perjalanan Terpercaya Anda ke Danau Toba dan Sekitarnya. Melayani dengan Hati, Sampai ke Tujuan.
            </p>
          </div>
          <div class="col-lg-3 mb-3">
            <ul class="list-group list-group-flush">
              <li class="list-group-item" style="border-bottom: none">
                <a href="{{ route('home') }}" class="title">Home</a>
              </li>
              <li class="list-group-item" style="border-bottom: none">
                <a href="{{ route('posts') }}" class="title">Berita</a>
              </li>
              <li class="list-group-item" style="border-bottom: none">
                <a href="{{ route('package') }}" class="title">Paket Travel</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-2 mb-3">
            <ul class="list-group list-group-flush">
              <li class="list-group-item" style="border-bottom: none">
                <a href="#" class="title">Facebook</a>
              </li>
              <li class="list-group-item" style="border-bottom: none">
                <a href="#" class="title">Instagram</a>
              </li>
              <li class="list-group-item" style="border-bottom: none">
                <a href="#" class="title">Youtube</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-3 mb-3">
            <ul class="list-group list-group-flush">
              <li class="list-group-item" style="border-bottom: none">
                <a href="mailto:grahadim178@gmail.com" class="title">
                  example@gmail.com
                </a>
              </li>
              <li class="list-group-item" style="border-bottom: none">
                <span class="title">Jln medan raya kode post 12345</span>
              </li>
            </ul>
          </div>
        </div>
        <div class="container-fluid text-center py-4 border-top mt-4">
          <small>@Copyright • Travel Medan <?= "2019-".date('Y') ?> • All reserved</small>
        </div>
      </div>
    </footer>
