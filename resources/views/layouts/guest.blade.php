<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script type="text/javascript" src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow-sm border-b border-gray-100">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="min-h-screen">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gradient-to-br from-gray-900 to-gray-800 text-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <!-- About Section -->
                        <div class="col-span-1 md:col-span-2">
                            <h3 class="text-2xl font-bold mb-4 bg-gradient-to-r from-cyan-400 to-cyan-600 bg-clip-text text-transparent">
                                Consult by Reed Code
                            </h3>
                            <p class="text-gray-300 mb-4 leading-relaxed">
                                Platform konsultasi psikologi online profesional yang menghubungkan Anda dengan psikolog berpengalaman. Kami berkomitmen untuk memberikan layanan terbaik bagi kesehatan mental Anda.
                            </p>
                            <div class="flex space-x-4">
                                <a href="https://www.instagram.com/reedcode.id" target="_blank" class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300">
                                    <i class="fab fa-instagram text-lg"></i>
                                </a>
                                <a href="https://www.tiktok.com/@reedcode.id" target="_blank" class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300">
                                    <i class="fab fa-tiktok text-lg"></i>
                                </a>
                                <a href="https://wa.me/6285171713355" target="_blank" class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-full flex items-center justify-center hover:scale-110 transition-transform duration-300">
                                    <i class="fab fa-whatsapp text-lg"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-lg font-semibold mb-4">Menu Cepat</h4>
                            <ul class="space-y-2">
                                <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-cyan-400 transition-colors duration-200">Beranda</a></li>
                                <li><a href="{{ route('list-psikolog') }}" class="text-gray-300 hover:text-cyan-400 transition-colors duration-200">List Psikolog</a></li>
                                <li><a href="{{ route('tes-kuis') }}" class="text-gray-300 hover:text-cyan-400 transition-colors duration-200">Tes Kuis</a></li>
                                <li><a href="{{ route('jadi-psikolog') }}" class="text-gray-300 hover:text-cyan-400 transition-colors duration-200">Jadi Psikolog</a></li>
                            </ul>
                        </div>

                        <!-- Contact Info -->
                        <div>
                            <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                            <ul class="space-y-3">
                                <li class="flex items-center space-x-3">
                                    <i class="fab fa-whatsapp text-cyan-400"></i>
                                    <span class="text-gray-300">+62 851-7171-3355</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fab fa-instagram text-cyan-400"></i>
                                    <span class="text-gray-300">@reedcode.id</span>
                                </li>
                                <li class="flex items-center space-x-3">
                                    <i class="fab fa-tiktok text-cyan-400"></i>
                                    <span class="text-gray-300">@reedcode.id</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                        <p class="text-gray-400">
                            &copy; {{ date('Y') }} Reed Code. All rights reserved. Made with <i class="fas fa-heart text-red-500"></i> for better mental health.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
<script type="text/javascript">
    function createTransaction(psychologistId) {
        axios.post(`/transaksi/create/${psychologistId}`, {
            _token: '{{ csrf_token() }}'
        })
        .then(function (response) {
            if (response.data.snap_token) {
                payNow(response.data.snap_token);
            } else if (response.data.redirect_url) {
                window.location.href = response.data.redirect_url;
            } else {
                alert('Terjadi kesalahan saat memproses permintaan.');
            }
        })
        .catch(function (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat membuat transaksi. Silakan coba lagi.');
        });
    }

    function payNow(snapToken) {
        snap.pay(snapToken, {
            onSuccess: function(result) {
                console.log('Payment success:', result);
                updateTransactionStatus(result.order_id, 'Dibayar');
            },
            onPending: function(result) {
                console.log('Payment pending:', result);
                updateTransactionStatus(result.order_id, 'Belum dibayar');
            },
            onError: function(result) {
                console.error('Payment error:', result);
                updateTransactionStatus(result.order_id, 'Gagal');
            },
            onClose: function() {
                console.log('Customer closed the popup without finishing the payment');
            }
        });
    }

    function updateTransactionStatus(orderId, status) {
        axios.post('/transaksi/update-status', {
            order_id: orderId,
            status: status,
            _token: '{{ csrf_token() }}'
        })
        .then(function (response) {
            if (response.data.success) {
                location.reload();
            } else {
                alert('Gagal memperbarui status pembayaran.');
            }
        })
        .catch(function (error) {
            console.error('Error updating transaction status:', error);
            alert('Terjadi kesalahan saat memperbarui status pembayaran.');
        });
    }
</script>