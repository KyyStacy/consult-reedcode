<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Success Icon Animation -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full shadow-lg animate-bounce mb-4">
                    <i class="fas fa-check text-white text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Hasil Kuis Kesehatan Mental</h2>
                <p class="text-gray-600">Berikut adalah hasil evaluasi kuis Anda</p>
            </div>

            <!-- Result Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Header -->
                <div class="bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-700 px-8 py-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                            <i class="fas fa-brain text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Analisis Hasil</h3>
                            <p class="text-cyan-100 text-sm">Konsultasi dengan psikolog profesional direkomendasikan</p>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8">
                    <div class="bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl p-6 border-l-4 border-cyan-500 mb-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-cyan-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-info-circle text-cyan-600"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-lg text-gray-800 leading-relaxed">{{ $hasil }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('list-psikolog') }}" class="flex-1 inline-flex items-center justify-center px-6 py-4 text-base font-semibold text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200">
                            <i class="fas fa-user-md mr-2"></i>
                            Konsultasi dengan Psikolog
                        </a>
                        <a href="{{ route('home') }}" class="flex-1 inline-flex items-center justify-center px-6 py-4 text-base font-semibold text-cyan-600 bg-white border-2 border-cyan-600 rounded-xl hover:bg-cyan-50 transition-all duration-200">
                            <i class="fas fa-home mr-2"></i>
                            Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-lightbulb text-blue-500 mt-1"></i>
                                <div>
                                    <p class="text-sm font-semibold text-blue-900 mb-1">Tips Kesehatan Mental</p>
                                    <p class="text-sm text-blue-700">
                                        Jika Anda merasa memerlukan bantuan lebih lanjut, jangan ragu untuk berkonsultasi dengan psikolog profesional kami. Mereka siap membantu Anda dalam perjalanan menuju kesehatan mental yang lebih baik.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>