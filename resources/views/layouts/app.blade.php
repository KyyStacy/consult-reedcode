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
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="{{ Request::segment(1) !== 'profile' ? 'overflow-hidden' : '' }} font-sans antialiased" 
        :class="{ 'sidebar-expanded': sidebarExpanded }" 
        x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" 
        x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">
        
        <div class="min-h-screen bg-gray-50">
            <!-- Top Banner (Admin/Psikolog) -->
            @if(auth()->user()->hasRole('admin|psikolog'))
                <div class="w-full h-14 bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-700 text-white flex items-center justify-center top-0 left-0 z-50 fixed shadow-lg">
                    <div class="w-full overflow-hidden relative">
                        <div class="flex items-center justify-center space-x-4 px-4">
                            <i class="fas fa-lightbulb text-yellow-300 animate-pulse"></i>
                            <marquee behavior="scroll" direction="left" class="w-full font-semibold text-sm" id="marqueeText" scrollamount="3">
                                Keberhasilan tidak terjadi begitu saja. Ia adalah hasil dari kerja keras, ketekunan, belajar dari kegagalan, loyalitas, dan kegigihan.
                            </marquee>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Hamburger Button -->
                <button 
                    class="mt-14 bg-white shadow-lg rounded-lg p-2 text-cyan-600 hover:text-cyan-700 hover:bg-cyan-50 focus:outline-none lg:hidden fixed top-4 left-4 z-50 transition-all duration-200" 
                    @click.stop="sidebarOpen = !sidebarOpen" 
                    aria-controls="sidebar" 
                    :aria-expanded="sidebarOpen"
                >
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <rect :class="{'rotate-45 translate-y-1.5': sidebarOpen, 'translate-y-0': !sidebarOpen}" class="transition-all duration-300 origin-center" x="4" y="5" width="16" height="2" />
                        <rect :class="{'opacity-0': sidebarOpen}" class="transition-opacity duration-300" x="4" y="11" width="16" height="2" />
                        <rect :class="{'-rotate-45 -translate-y-1.5': sidebarOpen, 'translate-y-0': !sidebarOpen}" class="transition-all duration-300 origin-center" x="4" y="17" width="16" height="2" />
                    </svg>
                </button>
            @else
                @include('layouts.navigation')
            @endif
            
            <div class="flex">
                <!-- Sidebar -->
                @if(auth()->user()->hasRole('admin|psikolog'))
                    <div class="sidebar fixed shadow-lg">
                        @include('components.sidebar')
                    </div>
                @endif
                
                <div class="flex-1">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="bg-white shadow-sm border-b border-gray-100">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif
                    
                    <!-- Page Content -->
                    @if(auth()->user()->hasRole('admin|psikolog'))
                        <main class="ml-64 mt-14 min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50">
                            {{ $slot }}
                        </main>
                    @else
                        <main class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50">
                            {{ $slot }}
                        </main>
                    @endif
                </div>
            </div>
        </div>
    </body>
    <script>
        if (localStorage.getItem('sidebar-expanded') == 'true') {
            document.querySelector('body').classList.add('sidebar-expanded');
        } else {
            document.querySelector('body').classList.remove('sidebar-expanded');
        }

        const texts = [
            "Setiap langkah kecil yang Anda ambil hari ini adalah langkah menuju impian Anda. Tetap semangat!",
            "Rintangan adalah kesempatan untuk menunjukkan seberapa besar Anda memang ingin mencapai tujuan Anda. Jangan pernah menyerah!",
            "Setiap hari adalah kesempatan baru untuk mengejar impianmu. Jadikan setiap hari sebagai kesempatan untuk berkembang.",
            "Jangan fokus pada berapa banyak waktu yang Anda habiskan, tetapi fokuslah pada seberapa baik Anda memanfaatkannya.",
            "Pikirkanlah tantangan sebagai kesempatan untuk tumbuh. Jika semuanya mudah, Anda tidak akan berkembang.",
            "Keberanian adalah kunci untuk membuka pintu kesuksesan. Ambillah langkah maju dengan percaya diri.",
            "Percayalah pada diri sendiri dan kemampuan Anda. Anda lebih kuat daripada yang Anda pikirkan.",
            "Setiap masalah adalah kesempatan untuk menunjukkan kreativitas dan inovasi Anda. Jangan takut untuk mencoba hal baru.",
            "Saat Anda merasa putus asa, ingatlah alasan mengapa Anda memulai. Anda telah melewati begitu banyak, dan Anda mampu melewati ini juga.",
        ];
        let index = 0;

        function getRandomText() {
            return texts[index++ % texts.length];
        }

        setInterval(function() {
            const marqueeElement = document.getElementById('marqueeText');
            if (marqueeElement) {
                marqueeElement.innerText = getRandomText();
            }
        }, 15000);
    </script>
</html>
