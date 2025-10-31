<div x-data="{ open: false, showLoginModal: {{ $errors->any() ? 'true' : 'false' }} }" 
    x-init="
        if (typeof window !== 'undefined' && new URL(window.location.href).searchParams.get('showLogin') === 'true') {
            showLoginModal = true;
        }
    ">
<nav class="bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-cyan-600 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-brain text-white text-xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">
                            Reed Code
                        </span>
                        <span class="text-xs text-gray-500 -mt-1">Consult Platform</span>
                    </div>
                </a>
                
                <!-- Navigation Links -->
                <div class="hidden lg:flex lg:items-center lg:ml-12 lg:space-x-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('home') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                        <i class="fas fa-home mr-2"></i>Beranda
                    </a>
                    <a href="{{ route('tes-kuis') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('tes-kuis', 'kuis.submit') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                        <i class="fas fa-clipboard-check mr-2"></i>Tes Kuis
                    </a>
                    <a href="{{ route('list-psikolog') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('list-psikolog') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                        <i class="fas fa-user-md mr-2"></i>List Psikolog
                    </a>
                    <a href="{{ route('jadi-psikolog') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('jadi-psikolog') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                        <i class="fas fa-graduation-cap mr-2"></i>Jadi Psikolog
                    </a>
                    @auth
                        @if(!auth()->user()->hasRole('admin|psikolog'))
                            <a href="{{ route('riwayat') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('riwayat') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                                <i class="fas fa-history mr-2"></i>Riwayat
                            </a>
                            <a href="{{ route('preview-chat') }}" class="px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('preview-chat', 'chat') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                                <i class="fas fa-comments mr-2"></i>Chat
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
            <!-- Settings Dropdown -->
            @if (Route::has('login'))
                <div class="flex items-center gap-3">
                    @auth
                        @if(auth()->user()->hasRole('user'))
                            <div class="hidden lg:flex lg:items-center">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:border-cyan-300 focus:outline-none transition-all duration-200">
                                            <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center mr-2">
                                                <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                            </div>
                                            <div>{{ Auth::user()->name }}</div>
                
                                            <div class="ms-2">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>
                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')">
                                            <i class="fas fa-user mr-2"></i>{{ __('Profile') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                <i class="fas fa-sign-out-alt mr-2"></i>{{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        @elseif(auth()->user()->hasRole('admin|psikolog'))
                            <div class="hidden lg:flex lg:items-center">
                                @if(auth()->user()->hasRole('admin'))
                                    <a href="{{ route('user-admin') }}">
                                        <button class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-200">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                        </button>
                                    </a>
                                @elseif (auth()->user()->hasRole('psikolog'))
                                    <a href="{{ route('psikolog') }}">
                                        <button class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-200">
                                            <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                                        </button>
                                    </a>
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="hidden lg:flex lg:items-center lg:space-x-3">
                            <!-- Tombol untuk membuka pop-up login -->
                            <button @click.prevent="showLoginModal = true" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-cyan-600 bg-white border-2 border-cyan-600 rounded-lg hover:bg-cyan-50 transition-all duration-200">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login
                            </button>
                            
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                    <button class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-200">
                                        <i class="fas fa-user-plus mr-2"></i>Daftar
                                    </button>
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>
            @endif
            <!-- Hamburger -->
            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-cyan-600 hover:bg-gray-50 focus:outline-none transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-gray-100">
        <div class="px-4 pt-4 pb-3 space-y-2">
            <a href="{{ route('home') }}" class="flex items-center px-4 py-3 text-base font-medium rounded-lg {{ request()->routeIs('home') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                <i class="fas fa-home w-6"></i>
                <span>Beranda</span>
            </a>
            <a href="{{ route('tes-kuis') }}" class="flex items-center px-4 py-3 text-base font-medium rounded-lg {{ request()->routeIs('tes-kuis', 'kuis.submit') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                <i class="fas fa-clipboard-check w-6"></i>
                <span>Tes Kuis</span>
            </a>
            <a href="{{ route('list-psikolog') }}" class="flex items-center px-4 py-3 text-base font-medium rounded-lg {{ request()->routeIs('list-psikolog') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                <i class="fas fa-user-md w-6"></i>
                <span>List Psikolog</span>
            </a>
            <a href="{{ route('jadi-psikolog') }}" class="flex items-center px-4 py-3 text-base font-medium rounded-lg {{ request()->routeIs('jadi-psikolog') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                <i class="fas fa-graduation-cap w-6"></i>
                <span>Jadi Psikolog</span>
            </a>
            
            @auth
                @if(!auth()->user()->hasRole('admin|psikolog'))
                    <a href="{{ route('riwayat') }}" class="flex items-center px-4 py-3 text-base font-medium rounded-lg {{ request()->routeIs('riwayat') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                        <i class="fas fa-history w-6"></i>
                        <span>Riwayat</span>
                    </a>
                    <a href="{{ route('preview-chat') }}" class="flex items-center px-4 py-3 text-base font-medium rounded-lg {{ request()->routeIs('preview-chat', 'chat') ? 'text-cyan-600 bg-cyan-50' : 'text-gray-700 hover:text-cyan-600 hover:bg-gray-50' }} transition-all duration-200">
                        <i class="fas fa-comments w-6"></i>
                        <span>Chat</span>
                    </a>
                @endif
            @endauth
        </div>

        <!-- Responsive User Settings -->
        @auth
            <div class="pt-4 pb-4 border-t border-gray-100">
                <div class="px-4 mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                <div class="px-4 space-y-2">
                    @if(auth()->user()->hasRole('user'))
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-cyan-600 hover:bg-gray-50 rounded-lg transition-all duration-200">
                            <i class="fas fa-user w-6"></i>
                            <span>Profile</span>
                        </a>
                    @elseif(auth()->user()->hasRole('admin'))
                        <a href="{{ route('user-admin') }}" class="flex items-center px-4 py-3 text-base font-medium text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-lg">
                            <i class="fas fa-tachometer-alt w-6"></i>
                            <span>Dashboard</span>
                        </a>
                    @elseif(auth()->user()->hasRole('psikolog'))
                        <a href="{{ route('psikolog') }}" class="flex items-center px-4 py-3 text-base font-medium text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-lg">
                            <i class="fas fa-tachometer-alt w-6"></i>
                            <span>Dashboard</span>
                        </a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-base font-medium text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200">
                            <i class="fas fa-sign-out-alt w-6"></i>
                            <span>Log Out</span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="px-4 pt-4 pb-4 border-t border-gray-100 space-y-3">
                <a href="{{ route('login') }}" class="flex items-center justify-center px-5 py-3 text-base font-semibold text-cyan-600 bg-white border-2 border-cyan-600 rounded-lg hover:bg-cyan-50 transition-all duration-200">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="flex items-center justify-center px-5 py-3 text-base font-semibold text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-lg hover:shadow-lg transition-all duration-200">
                        <i class="fas fa-user-plus mr-2"></i>Daftar
                    </a>
                @endif
            </div>
        @endauth
    </div>
</nav>

<!-- Login Modal - Outside navigation for proper overlay -->
<div x-show="showLoginModal" 
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[9999] overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4"
    style="display: none;"
    @keydown.escape.window="showLoginModal = false">
    <div @click.away="showLoginModal = false" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full mx-4 overflow-hidden relative">
        <div class="flex flex-col md:flex-row">
            <!-- Left Side - Branding -->
            <div class="bg-gradient-to-br from-cyan-600 via-blue-600 to-cyan-700 p-12 md:w-1/2 flex flex-col justify-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full -ml-32 -mb-32"></div>
                
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center mb-6">
                        <i class="fas fa-brain text-white text-3xl"></i>
                    </div>
                    <h2 class="text-4xl font-bold text-white mb-4">Selamat Datang Kembali!</h2>
                    <p class="text-cyan-100 text-lg mb-8 leading-relaxed">
                        Login ke akun Anda dan lanjutkan perjalanan kesehatan mental bersama kami.
                    </p>
                    
                    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 mb-6">
                        <p class="text-white text-sm mb-4">Belum memiliki akun?</p>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center w-full px-6 py-3 text-cyan-600 bg-white font-semibold rounded-lg hover:bg-cyan-50 transition-all duration-300">
                            <i class="fas fa-user-plus mr-2"></i>Buat Akun Sekarang
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center text-white/80">
                            <i class="fas fa-shield-alt mr-2"></i>
                            <span class="text-sm">Aman & Terpercaya</span>
                        </div>
                        <div class="flex items-center text-white/80">
                            <i class="fas fa-lock mr-2"></i>
                            <span class="text-sm">Data Terenkripsi</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Login Form -->
            <div class="p-12 md:w-1/2">
                <div class="flex justify-end mb-6">
                    <button @click="showLoginModal = false" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Login</h3>
                <p class="text-gray-600 mb-8">Masukkan kredensial Anda untuk melanjutkan</p>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="modal_email">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input
                                class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-cyan-500 transition-colors duration-200"
                                id="modal_email"
                                type="email"
                                placeholder="nama@email.com"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                                autofocus
                            >
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2" for="modal_password">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input
                                class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-cyan-500 transition-colors duration-200"
                                id="modal_password"
                                type="password"
                                placeholder="••••••••"
                                name="password"
                                required
                                autocomplete="current-password"
                            >
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" id="modal_remember" class="w-4 h-4 text-cyan-600 border-gray-300 rounded focus:ring-cyan-500" {{ old('remember') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">Ingat saya</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a class="text-sm text-cyan-600 hover:text-cyan-700 font-medium transition-colors duration-200" href="{{ route('password.request') }}">
                                Lupa kata sandi?
                            </a>
                        @endif
                    </div>
                    
                    <button type="submit" class="w-full py-3.5 px-6 text-white font-semibold bg-gradient-to-r from-cyan-600 to-blue-600 rounded-xl hover:shadow-lg hover:scale-[1.02] transition-all duration-200">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
</div>

