@extends('layouts.app')

@section('content')
    <section class="hero" id="hero"
        style="
          background-repeat: no-repeat;
          background-size: cover;
          height: 50vh;
          background-image: url('https://media.istockphoto.com/photos/tropical-beach-with-boats-and-blue-ocean-in-tropical-island-picture-id1068291116?b=1&k=20&m=1068291116&s=170667a&w=0&h=9Bsc3HJkFdNRr0ESpdMeAlfSVLX68mVrz3UY-Ye0p0s=');
        ">
        <div class="hero-content h-100 d-flex justify-content-center align-items-center flex-column">
            <h1 class="text-center text-white display-4">Kontak Kami</h1>
            <p class="text-white">Kami membutuhkan feedback anda untuk pelayanan yang lebih baik</p>
            <hr width="40" class="text-center" />
        </div>
    </section>

    <main class="container mb-5 position-relative" style="margin-top: -180px;z-index: 2;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card p-4">

                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Form dengan JavaScript --}}
                    <form id="whatsappForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea name="message" class="form-control" rows="5" id="message" required></textarea>
                        </div>

                        <button type="button" class="btn btn-contact" id="btn-wa">
                            <i class="fab fa-whatsapp"></i> Kirim via WhatsApp
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('script-alt')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('btn-wa').addEventListener('click', function() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

            if (!name || !email || !message) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Form Tidak Lengkap',
                    text: 'Harap lengkapi semua field!',
                    confirmButtonColor: '#3085d6',
                });
                return;
            }

            Swal.fire({
                title: 'Kirim via WhatsApp?',
                text: "Pesan akan dikirim melalui WhatsApp",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#25D366',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim Sekarang!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const encodedName = encodeURIComponent(name);
                    const encodedEmail = encodeURIComponent(email);
                    const encodedMessage = encodeURIComponent(message);

                    const whatsappUrl = `https://api.whatsapp.com/send?phone=6281360503971&text=Nama%20:%20${encodedName}%0AEmail%20:%20${encodedEmail}%0APesan%20:%20${encodedMessage}`;

                    const newWindow = window.open(whatsappUrl, '_blank');

                    if (newWindow) {
                        newWindow.focus();
                        document.getElementById('whatsappForm').reset();

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'WhatsApp telah dibuka di tab baru',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Popup Diblokir',
                            text: 'Silakan izinkan popup untuk website ini',
                            confirmButtonColor: '#3085d6',
                        });
                    }
                }
            });
        });
    </script>
@endpush
