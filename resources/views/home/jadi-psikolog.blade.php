<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 p-5 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl shadow-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-white"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-base font-semibold text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Header Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl shadow-lg mb-4">
                    <i class="fas fa-graduation-cap text-white text-2xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Bergabung Sebagai Psikolog</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Isi form di bawah ini untuk mengajukan lamaran sebagai psikolog profesional di platform kami
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-700 px-8 py-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                            <i class="fas fa-file-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Form Lamaran</h3>
                            <p class="text-cyan-100 text-sm">Lengkapi informasi di bawah ini</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form method="POST" action="{{ route('jadi-psikolog.submit') }}" enctype="multipart/form-data" id="applicationForm">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user mr-2 text-cyan-600"></i>Nama Lengkap
                            </label>
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                required 
                                autofocus
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 focus:outline-none transition-colors duration-200"
                                placeholder="Masukkan nama lengkap Anda"
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope mr-2 text-cyan-600"></i>Alamat Email
                            </label>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                required
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 focus:outline-none transition-colors duration-200"
                                placeholder="nama@email.com"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CV/Resume -->
                        <div class="mb-6">
                            <label for="cv" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-file-pdf mr-2 text-cyan-600"></i>CV/Resume (PDF)
                            </label>
                            <div class="relative">
                                <input 
                                    id="cv" 
                                    name="cv" 
                                    type="file" 
                                    required 
                                    accept=".pdf"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-cyan-50 file:text-cyan-700 hover:file:bg-cyan-100 cursor-pointer"
                                >
                            </div>
                            <p class="mt-2 text-sm text-gray-500 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-cyan-500"></i>
                                Format file: PDF, ukuran maksimal: 5MB
                            </p>
                            @error('cv')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Surat Lamaran -->
                        <div class="mb-8">
                            <label for="cover_letter" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-pen mr-2 text-cyan-600"></i>Surat Lamaran
                            </label>
                            <textarea 
                                id="cover_letter" 
                                name="cover_letter" 
                                rows="6" 
                                required
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 focus:outline-none transition-colors duration-200 resize-none"
                                placeholder="Ceritakan tentang diri Anda, pengalaman, dan alasan ingin bergabung sebagai psikolog..."
                            ></textarea>
                            @error('cover_letter')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
                            <button 
                                type="submit" 
                                id="submitBtn"
                                class="relative inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-xl hover:shadow-lg hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-all duration-200 min-w-[180px]"
                            >
                                <span id="buttonText" class="flex items-center">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Kirim Lamaran
                                </span>
                                <span id="loadingIcon" class="hidden absolute inset-0 items-center justify-center">
                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-blue-50 rounded-xl p-6 border border-blue-100">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-info-circle text-white"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-base font-semibold text-blue-900 mb-2">Informasi Penting</h4>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-500"></i>
                                <span>Tim kami akan meninjau lamaran Anda dalam 3-5 hari kerja</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-500"></i>
                                <span>Pastikan CV dan surat lamaran Anda lengkap dan profesional</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mr-2 mt-0.5 text-blue-500"></i>
                                <span>Anda akan menerima notifikasi via email mengenai status lamaran</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('applicationForm').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBtn');
            const buttonText = document.getElementById('buttonText');
            const loadingIcon = document.getElementById('loadingIcon');

            submitBtn.disabled = true;
            buttonText.classList.add('hidden');
            loadingIcon.classList.remove('hidden');
            loadingIcon.classList.add('flex');

            const overlay = document.createElement('div');
            overlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            overlay.innerHTML = `
                <div class="bg-white p-6 rounded-lg shadow-xl max-w-md">
                    <div class="flex flex-col items-center space-y-4">
                        <svg class="animate-spin h-8 w-8 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <div class="text-center">
                            <p class="text-gray-700 font-medium mb-2">Mengirim lamaran...</p>
                            <p class="text-sm text-gray-500">Mohon tunggu sebentar. Proses pengiriman membutuhkan waktu 1-2 menit karena melibatkan pengiriman file CV.</p>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(overlay);
        });
    </script>
</x-guest-layout>