<x-guest-layout>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-cyan-50 via-white to-cyan-50 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-cyan-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 right-0 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/2 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-blob animation-delay-4000"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="text-center">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-cyan-100 rounded-full mb-8">
                    <span class="w-2 h-2 bg-cyan-500 rounded-full mr-2 animate-pulse"></span>
                    <span class="text-cyan-800 text-sm font-semibold">Platform Konsultasi Psikologi Terpercaya</span>
                </div>
                
                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                    Kesehatan Mental Anda,
                    <span class="bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent block mt-2">
                        Prioritas Kami
                    </span>
                </h1>
                
                <!-- Subtitle -->
                <p class="text-lg sm:text-xl text-gray-600 mb-10 max-w-3xl mx-auto leading-relaxed">
                    Terhubung dengan psikolog profesional dan bersertifikat untuk mendapatkan dukungan yang Anda butuhkan. Konsultasi mudah, aman, dan terpercaya.
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('list-psikolog') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-xl hover:shadow-2xl hover:shadow-cyan-500/50 transition-all duration-300 hover:scale-105">
                        <span>Mulai Konsultasi</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#fitur" class="inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-cyan-700 bg-white border-2 border-cyan-600 rounded-xl hover:bg-cyan-50 transition-all duration-300">
                        <span>Pelajari Lebih Lanjut</span>
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-cyan-600 mb-2">100+</div>
                        <div class="text-sm text-gray-600">Psikolog Profesional</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-cyan-600 mb-2">5000+</div>
                        <div class="text-sm text-gray-600">Konsultasi Selesai</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-cyan-600 mb-2">4.9</div>
                        <div class="text-sm text-gray-600">Rating Pengguna</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl sm:text-4xl font-bold text-cyan-600 mb-2">24/7</div>
                        <div class="text-sm text-gray-600">Layanan Tersedia</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white" id="fitur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih <span class="text-cyan-600">Kami?</span>
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Kami menyediakan layanan terbaik untuk mendukung kesehatan mental Anda
                </p>
            </div>

            <!-- Feature Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group relative bg-gradient-to-br from-cyan-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-cyan-100">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-cyan-200 rounded-full -mr-10 -mt-10 opacity-20 group-hover:scale-150 transition-transform duration-300"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-video text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Konsultasi Online</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Akses mudah ke psikolog profesional kapan saja dan di mana saja melalui platform online yang aman dan nyaman.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="group relative bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-blue-100">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-200 rounded-full -mr-10 -mt-10 opacity-20 group-hover:scale-150 transition-transform duration-300"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-user-md text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Psikolog Bersertifikat</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Semua psikolog kami terverifikasi, berpengalaman, dan memiliki sertifikasi profesional yang terpercaya.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="group relative bg-gradient-to-br from-cyan-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-cyan-100">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-cyan-200 rounded-full -mr-10 -mt-10 opacity-20 group-hover:scale-150 transition-transform duration-300"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-shield-alt text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Privasi Terjamin</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Kerahasiaan dan privasi Anda adalah prioritas utama kami dengan sistem keamanan tingkat tinggi.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="group relative bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-blue-100">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-200 rounded-full -mr-10 -mt-10 opacity-20 group-hover:scale-150 transition-transform duration-300"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-clock text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Fleksibel & Praktis</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Jadwal konsultasi yang fleksibel sesuai dengan waktu luang Anda tanpa perlu antri panjang.
                        </p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="group relative bg-gradient-to-br from-cyan-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-cyan-100">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-cyan-200 rounded-full -mr-10 -mt-10 opacity-20 group-hover:scale-150 transition-transform duration-300"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-comments text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Chat Real-time</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Fitur chat langsung memudahkan komunikasi dengan psikolog Anda kapan saja dibutuhkan.
                        </p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="group relative bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border border-blue-100">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-200 rounded-full -mr-10 -mt-10 opacity-20 group-hover:scale-150 transition-transform duration-300"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-credit-card text-2xl text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pembayaran Mudah</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Sistem pembayaran yang aman dan mudah dengan berbagai metode pembayaran yang tersedia.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 bg-gradient-to-br from-cyan-600 via-blue-600 to-cyan-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -ml-48 -mt-48"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full -mr-48 -mb-48"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6">
                Siap Memulai Perjalanan Anda?
            </h2>
            <p class="text-xl text-cyan-50 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan orang yang telah merasakan manfaat konsultasi dengan psikolog profesional kami
            </p>
            <a href="{{ route('list-psikolog') }}" class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold text-cyan-600 bg-white rounded-xl hover:bg-gray-50 hover:shadow-2xl transition-all duration-300 hover:scale-105">
                <span>Mulai Konsultasi Sekarang</span>
                <i class="fas fa-arrow-right ml-3"></i>
            </a>
        </div>
    </section>

    <!-- Custom Animations -->
    <style>
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-guest-layout>