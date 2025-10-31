<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
        <div class="max-w-5xl w-full mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
                <!-- Left Side - Branding -->
                <div class="hidden lg:flex bg-gradient-to-br from-cyan-600 via-blue-600 to-cyan-700 p-12 flex-col justify-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full -ml-32 -mb-32"></div>
                    
                    <div class="relative z-10">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-white/80 hover:text-white mb-8 transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span>Kembali ke Beranda</span>
                        </a>
                        
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-user-plus text-white text-3xl"></i>
                        </div>
                        
                        <h2 class="text-4xl font-bold text-white mb-4">Bergabung dengan Kami</h2>
                        <p class="text-cyan-100 text-lg mb-8 leading-relaxed">
                            Buat akun Anda sekarang dan mulai perjalanan menuju kesehatan mental yang lebih baik bersama psikolog profesional kami.
                        </p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center text-white/80">
                                <i class="fas fa-check-circle mr-3 text-cyan-300"></i>
                                <span>Akses ke psikolog profesional dan bersertifikat</span>
                            </div>
                            <div class="flex items-center text-white/80">
                                <i class="fas fa-check-circle mr-3 text-cyan-300"></i>
                                <span>Konsultasi mudah dan aman</span>
                            </div>
                            <div class="flex items-center text-white/80">
                                <i class="fas fa-check-circle mr-3 text-cyan-300"></i>
                                <span>Privasi dan keamanan data terjamin</span>
                            </div>
                        </div>
                        
                        <div class="mt-8 pt-8 border-t border-white/20">
                            <p class="text-white/80 text-sm mb-4">Sudah punya akun?</p>
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center w-full px-6 py-3 text-cyan-600 bg-white font-semibold rounded-lg hover:bg-cyan-50 transition-all duration-300">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Registration Form -->
                <div class="p-8 lg:p-12">
                    <!-- Mobile Back Button -->
                    <a href="{{ route('home') }}" class="lg:hidden inline-flex items-center text-gray-600 hover:text-cyan-600 mb-6 transition-colors duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali</span>
                    </a>

                    <!-- Mobile Header -->
                    <div class="lg:hidden text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl shadow-lg mb-4">
                            <i class="fas fa-user-plus text-white text-2xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h2>
                        <p class="text-gray-600">Bergabung dengan kami untuk memulai konsultasi</p>
                    </div>

                    <!-- Desktop Header -->
                    <div class="hidden lg:block mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Daftar</h2>
                        <p class="text-gray-600">Isi form di bawah untuk membuat akun baru</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user mr-2 text-cyan-600"></i>Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input 
                                    id="name" 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    autofocus 
                                    autocomplete="name"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200"
                                    placeholder="Masukkan nama lengkap Anda"
                                >
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope mr-2 text-cyan-600"></i>Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autocomplete="email"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200"
                                    placeholder="nama@email.com"
                                >
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock mr-2 text-cyan-600"></i>Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    required 
                                    autocomplete="new-password"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200"
                                    placeholder="Minimal 8 karakter"
                                >
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-lock mr-2 text-cyan-600"></i>Konfirmasi Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input 
                                    id="password_confirmation" 
                                    type="password" 
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200"
                                    placeholder="Ulangi password Anda"
                                >
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button 
                                type="submit" 
                                class="w-full py-3.5 px-6 text-white font-semibold bg-gradient-to-r from-cyan-600 to-blue-600 rounded-xl hover:shadow-lg hover:scale-[1.02] transition-all duration-200 flex items-center justify-center"
                            >
                                <i class="fas fa-user-plus mr-2"></i>
                                Buat Akun
                            </button>
                        </div>

                        <!-- Mobile Login Link -->
                        <div class="lg:hidden text-center pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600 mb-2">Sudah punya akun?</p>
                            <a href="{{ route('login') }}" class="inline-flex items-center text-cyan-600 hover:text-cyan-700 font-medium transition-colors duration-200">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Login di sini
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-blue-50 rounded-xl p-6 border border-blue-100 text-center">
                <div class="flex items-start justify-center space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                    </div>
                    <div class="flex-1 max-w-2xl">
                        <h4 class="text-base font-semibold text-blue-900 mb-2">Keamanan & Privasi</h4>
                        <p class="text-sm text-blue-800">
                            Data pribadi Anda akan dijaga kerahasiaannya dan dilindungi dengan teknologi enkripsi tingkat tinggi. Kami berkomitmen untuk memberikan layanan yang aman dan terpercaya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>