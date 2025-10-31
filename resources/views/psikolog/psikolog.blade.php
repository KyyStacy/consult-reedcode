<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex items-center space-x-3 mb-6">
                <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-user-md text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Dashboard Psikolog</h1>
                    <p class="text-gray-600 mt-1">Selamat datang kembali, {{ Auth::user()->name }}</p>
                </div>
            </div>

            <!-- Main Card -->
            <div class="bg-white overflow-hidden shadow-xl border border-gray-100 rounded-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6 md:p-8">
                    <!-- Content Section -->
                    <div class="flex flex-col justify-center space-y-4">
                        <div class="inline-flex items-center space-x-2 bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-700 px-4 py-2 rounded-full w-fit">
                            <i class="fas fa-sparkles"></i>
                            <span class="text-sm font-semibold">Dashboard Kerja Anda</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">
                            Halo, {{ Auth::user()->name }}
                        </h2>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Selamat datang di dashboard kerja Anda. Siap untuk membantu pasien hari ini?
                        </p>
                        <div class="flex items-center space-x-4 mt-6">
                            <div class="flex items-center space-x-2 text-cyan-600">
                                <i class="fas fa-check-circle"></i>
                                <span class="text-sm font-medium">Siap Konsultasi</span>
                            </div>
                            <div class="flex items-center space-x-2 text-blue-600">
                                <i class="fas fa-comments"></i>
                                <span class="text-sm font-medium">Chat Aktif</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Section -->
                    <div class="relative rounded-xl overflow-hidden shadow-lg">
                        <img src="https://www.goodtherapy.org/blog/blog/wp-content/uploads/2012/01/woman-talking-with-therapist2.jpg" alt="Psikolog" class="w-full h-96 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-cyan-900/50 via-transparent to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="bg-white/90 backdrop-blur-sm rounded-lg p-4">
                                <p class="text-gray-800 font-semibold flex items-center">
                                    <i class="fas fa-quote-left text-cyan-500 mr-2"></i>
                                    "Membantu seseorang adalah hadiah terbesar"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>