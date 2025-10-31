<div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-2xl shadow-lg mb-4">
                <i class="fas fa-user-md text-white text-2xl"></i>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-3">Daftar Psikolog Profesional</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Pilih psikolog yang tepat untuk mendukung perjalanan kesehatan mental Anda
            </p>
        </div>

        <!-- Psychologists Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @foreach ($psychologistUsers as $user)
                @if ($user->detailPsikolog && $user->detailPsikolog->harga > 0)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-700 px-6 py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                                        <i class="fas fa-user-md text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-white">{{ $user->name }}</h3>
                                        <p class="text-cyan-100 text-sm">Psikolog Profesional</p>
                                    </div>
                                </div>
                                <div wire:poll.5s class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $user->is_online ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                                        <span class="w-2 h-2 mr-2 {{ $user->is_online ? 'bg-white' : 'bg-white' }} rounded-full {{ $user->is_online ? 'animate-pulse' : '' }}"></span>
                                        {{ $user->is_online ? 'Online' : 'Offline' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Profile Image -->
                                <div class="flex-shrink-0">
                                    <div class="w-32 h-32 md:w-40 md:h-40 rounded-xl overflow-hidden border-4 border-cyan-100 shadow-md">
                                        @if ($user->photo)
                                            <img class="w-full h-full object-cover" src="{{ asset('storage/photos/' . $user->photo) }}" alt="{{ $user->name }}">
                                        @else
                                            <img class="w-full h-full object-cover" src="{{ asset('images/default-photo.png') }}" alt="Default Photo">
                                        @endif
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="flex-1">
                                    <div class="mb-4">
                                        <p class="text-gray-700 leading-relaxed line-clamp-3">
                                            {{ $user->detailPsikolog->bio ?? 'Tidak ada deskripsi tersedia' }}
                                        </p>
                                    </div>

                                    <!-- Price -->
                                    <div class="mb-6 p-4 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl border border-cyan-100">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="text-sm text-gray-600 mb-1">Harga Konsultasi</p>
                                                <p class="text-2xl font-bold text-cyan-700">
                                                    Rp. {{ number_format($user->detailPsikolog->harga, 0, ',', '.') }}
                                                </p>
                                            </div>
                                            <div class="w-12 h-12 bg-cyan-100 rounded-xl flex items-center justify-center">
                                                <i class="fas fa-coins text-cyan-600 text-xl"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Button -->
                                    <div class="flex justify-end">
                                        @auth
                                            @if ($user->is_online && $user->id !== auth()->user()->id)
                                                @if(isset($transactions[$user->id]))
                                                    @if($transactions[$user->id]->status === 'Dibayar')
                                                        <a href="{{ route('chat', ['from_user_id' => auth()->id(), 'user' => $user->id]) }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200">
                                                            <i class="fas fa-comments mr-2"></i>
                                                            Chat Sekarang
                                                        </a>
                                                    @elseif($transactions[$user->id]->status === 'Belum dibayar')
                                                        <button onclick="payNow('{{ $transactions[$user->id]->snap_token }}')" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-amber-600 text-white font-semibold rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200">
                                                            <i class="fas fa-credit-card mr-2"></i>
                                                            Lanjutkan Pembayaran
                                                        </button>
                                                    @endif
                                                @else
                                                    @if($user->transaksiSebagaiPsikolog()->where('status', 'Dibayar')->count() < 3)
                                                        <button onclick="createTransaction({{ $user->id }})" type="button" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-cyan-600 to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200">
                                                            <i class="fas fa-check-circle mr-2"></i>
                                                            Pilih Psikolog
                                                        </button>
                                                    @else
                                                        <button class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-xl cursor-not-allowed" disabled>
                                                            <i class="fas fa-ban mr-2"></i>
                                                            Tidak Tersedia
                                                        </button>
                                                    @endif
                                                @endif
                                            @elseif ($user->id === auth()->user()->id)
                                                <button class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-xl cursor-not-allowed" disabled>
                                                    <i class="fas fa-user mr-2"></i>
                                                    Ini Adalah Anda Sendiri
                                                </button>
                                            @else
                                                <button class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-xl cursor-not-allowed" disabled>
                                                    <i class="fas fa-circle-xmark mr-2"></i>
                                                    Psikolog Offline
                                                </button>
                                            @endif
                                        @else
                                            <a href="{{ route('login')}}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-semibold rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200">
                                                <i class="fas fa-sign-in-alt mr-2"></i>
                                                Login untuk Chat
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Empty State -->
        @if($psychologistUsers->where('detailPsikolog.harga', '>', 0)->count() === 0)
            <div class="text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-user-md text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Psikolog Tersedia</h3>
                <p class="text-gray-500">Mohon coba lagi nanti atau hubungi admin untuk informasi lebih lanjut.</p>
            </div>
        @endif
    </div>
</div>