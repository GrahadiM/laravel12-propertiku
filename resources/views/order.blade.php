@extends('layouts.app')

@section('content')
    <main>
        <section class="container mt-5" style="margin-bottom: 70px">
            <div class="col-12 col-md">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="title-alt" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item main-color">Form Order</li>
                    </ol>
                </nav>
            </div>
        </section>

        <!--=============== Package Travel ===============-->
        <section class="container detail">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card bordered card-form" style="padding: 30px 40px">
                        <h4 class="text-center">Form Order</h4>

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Auto Redirect Notification -->
                        <div class="alert alert-info" id="redirect-notification" style="display: none;">
                            <i class="fa fa-info-circle"></i>
                            <strong>Redirecting...</strong> Anda akan diarahkan ke halaman riwayat order dalam <span id="countdown">3</span> detik.
                        </div>

                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Name:</strong> {{ auth()->user()->name }}
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Email:</strong> {{ auth()->user()->email }}
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Paket Travel:</strong> {{ $travelPackage->name }}
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Duration:</strong> {{ $travelPackage->duration }}
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Harga:</strong>
                            <span class="text-gray-500 font-weight-light">
                                {{ 'Rp ' . number_format($travelPackage->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="alert alert-secondary" style="background-color: #f5f5f5; border: 1px solid #f5f5f5" role="alert">
                            <strong>Order ID:</strong> {{ $transaction->order_id }}
                        </div>

                        {{-- <button id="pay-button" class="btn btn-primary btn-lg btn-block mt-3">
                            <i class="fa fa-credit-card"></i> Bayar Sekarang
                        </button> --}}

                        <!-- Manual Redirect Button -->
                        <a href="{{ route('profile.orders') }}" class="btn btn-primary btn-md btn-block mt-2" id="manual-redirect">
                            <i class="fa fa-history"></i> Lihat Riwayat Order Sekarang
                        </a>

                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Pilih metode pembayaran yang tersedia
                            </small>
                        </div>

                        <div class="mt-4">
                            <h6>Metode Pembayaran yang Tersedia:</h6>
                            <div class="row">
                                <div class="col-6 col-md-4 mb-2">
                                    <span class="badge badge-success">Credit Card</span>
                                </div>
                                <div class="col-6 col-md-4 mb-2">
                                    <span class="badge badge-info">GoPay</span>
                                </div>
                                <div class="col-6 col-md-4 mb-2">
                                    <span class="badge badge-warning">ShopeePay</span>
                                </div>
                                <div class="col-6 col-md-4 mb-2">
                                    <span class="badge badge-primary">Bank Transfer</span>
                                </div>
                                <div class="col-6 col-md-4 mb-2">
                                    <span class="badge badge-secondary">Alfamart/Indomaret</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('script-alt')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const payButton = document.getElementById('pay-button');
            const redirectNotification = document.getElementById('redirect-notification');
            const countdownElement = document.getElementById('countdown');
            const manualRedirect = document.getElementById('manual-redirect');

            let countdown;
            let seconds = 3;

            // Function to start auto redirect
            function startAutoRedirect() {
                redirectNotification.style.display = 'block';

                countdown = setInterval(function() {
                    seconds--;
                    countdownElement.textContent = seconds;

                    if (seconds <= 0) {
                        clearInterval(countdown);
                        window.location.href = '{{ route("profile.orders") }}';
                    }
                }, 1000);
            }

            // Function to stop auto redirect
            function stopAutoRedirect() {
                if (countdown) {
                    clearInterval(countdown);
                    redirectNotification.style.display = 'none';
                }
            }

            payButton.addEventListener('click', function() {
                // Show loading state
                const button = this;
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Memproses...';
                button.disabled = true;

                // Trigger snap popup
                window.snap.pay('{{ $snap_token }}', {
                    onSuccess: function(result) {
                        console.log('Payment success:', result);

                        // Show success message and start redirect
                        showPaymentResult('success', 'Pembayaran berhasil!');
                        startAutoRedirect();
                    },
                    onPending: function(result) {
                        console.log('Payment pending:', result);

                        // Show pending message and start redirect
                        showPaymentResult('warning', 'Menunggu konfirmasi pembayaran...');
                        startAutoRedirect();
                    },
                    onError: function(result) {
                        console.log('Payment error:', result);

                        // Show error message and start redirect
                        showPaymentResult('danger', 'Pembayaran gagal. Silakan coba lagi.');
                        startAutoRedirect();
                    },
                    onClose: function() {
                        console.log('Payment popup closed');

                        // Reset button if user closes the popup
                        button.innerHTML = originalText;
                        button.disabled = false;
                    }
                });
            });

            // Function to show payment result
            function showPaymentResult(type, message) {
                const alertClass = type === 'success' ? 'alert-success' :
                                 type === 'warning' ? 'alert-warning' : 'alert-danger';

                const resultAlert = document.createElement('div');
                resultAlert.className = `alert ${alertClass} alert-dismissible fade show`;
                resultAlert.innerHTML = `
                    <i class="fa fa-${type === 'success' ? 'check' : type === 'warning' ? 'exclamation-triangle' : 'times'}-circle"></i>
                    <strong>${type === 'success' ? 'Berhasil!' : type === 'warning' ? 'Perhatian!' : 'Gagal!'}</strong> ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;

                // Insert after the existing error alert or at the top
                const existingErrorAlert = document.querySelector('.alert-danger');
                if (existingErrorAlert) {
                    existingErrorAlert.parentNode.insertBefore(resultAlert, existingErrorAlert.nextSibling);
                } else {
                    document.querySelector('.card-form').insertBefore(resultAlert, document.querySelector('.card-form').firstChild);
                }
            }

            // Manual redirect button click handler
            manualRedirect.addEventListener('click', function(e) {
                e.preventDefault();
                stopAutoRedirect(); // Stop the auto redirect
                window.location.href = '{{ route("profile.orders") }}';
            });

            // Stop auto redirect if user interacts with the page
            document.addEventListener('click', function() {
                stopAutoRedirect();
            });

            document.addEventListener('keydown', function() {
                stopAutoRedirect();
            });

            document.addEventListener('scroll', function() {
                stopAutoRedirect();
            });
        });
    </script>

    <style>
        .alert-info {
            background-color: #d1ecf1;
            border-color: #bee5eb;
            color: #0c5460;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeaa7;
            color: #856404;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        #redirect-notification {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }

        .btn-outline-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }
    </style>
@endpush
