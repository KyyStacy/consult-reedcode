<div class="py-14 bg-gradient-to-br from-cyan-50 via-white to-blue-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl border border-gray-100 rounded-2xl">
            <div class="text-gray-900">
                <!-- component -->
                <div class="h-[40rem] flex overflow-hidden rounded-2xl">
                    <!-- Sidebar -->
                    <div class="w-1/4 bg-white border-r border-gray-200">
                        <!-- Sidebar Header -->
                        <header class="p-4 border-b border-gray-200 flex justify-between items-center bg-gradient-to-r from-cyan-500 to-blue-600 text-white">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="fas fa-comments text-xl"></i>
                                </div>
                                <h1 class="text-xl font-bold">Pesan</h1>
                            </div>
                        </header>
                        <!-- Contact List -->
                        <div class="overflow-y-auto h-[36rem] p-3" wire:poll="loadConversations">
                            @forelse ($conversations as $conversation)
                                @php
                                    $conversationUser = $conversation['user'];
                                @endphp
                                <a href="{{ route('chat', ['from_user_id' => auth()->id(), 'user' => $conversationUser->id]) }}">
                                    <div class="flex items-center mb-3 cursor-pointer hover:bg-cyan-50 p-3 rounded-xl transition-all duration-200 border border-transparent hover:border-cyan-200">
                                        @foreach ($conversationUser->modelHasRoles as $peran)
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center mr-3 ring-2 ring-cyan-100 shrink-0">
                                                @if ($conversationUser->photo)
                                                    <img class="w-full h-full rounded-full object-cover" src="{{ asset('storage/photos/' . $conversationUser->photo) }}" alt="Profile Photo">
                                                @else
                                                    <img class="w-full h-full rounded-full object-cover" src="{{ asset('images/default-photo.png') }}" alt="Default Photo">
                                                @endif
                                            </div>
                                        @endforeach
                                        <div class="flex-1 min-w-0">
                                            <h2 class="text-base font-semibold text-gray-900 truncate">{{ $conversationUser->name }}</h2>
                                            <p class="text-sm text-gray-500 truncate mt-0.5">
                                                @if ($conversation['lastMessage'])
                                                    {{ Illuminate\Support\Str::limit($conversation['lastMessage']->message, 30, '...') }}
                                                @else
                                                    <span class="text-gray-400">No messages</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="flex flex-col items-center justify-center h-full py-8 px-4 text-center">
                                    <div class="w-16 h-16 bg-gradient-to-br from-cyan-100 to-blue-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-inbox text-2xl text-cyan-600"></i>
                                    </div>
                                    <h3 class="text-sm font-semibold text-gray-900 mb-1">Belum Ada Percakapan</h3>
                                    @role('psikolog')
                                        <p class="text-xs text-gray-500">Tunggu pasien untuk memulai konsultasi</p>
                                    @else
                                        <p class="text-xs text-gray-500">Pilih psikolog untuk memulai chat</p>
                                    @endrole
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <!-- Main Chat Area -->
                    <div class="flex-1 flex flex-col">
                        <!-- Chat Header -->
                        <header class="text-white bg-gradient-to-r from-cyan-500 to-blue-600 p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="fas fa-brain text-xl"></i>
                                </div>
                                <h1 class="text-xl font-bold">Consult by Reed Code</h1>
                            </div>
                        </header>
                        <!-- Chat Messages -->
                        <div class="flex-1 p-8 flex flex-col justify-center items-center bg-gradient-to-b from-gray-50 to-white">
                            <div class="text-center space-y-4">
                                <div class="w-24 h-24 mx-auto bg-gradient-to-br from-cyan-100 to-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-comments text-4xl text-cyan-600"></i>
                                </div>
                                <div>
                                    @role('psikolog')
                                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Konsultasi</h2>
                                        <p class="text-gray-600 mb-6">Tunggu pasien untuk memulai konsultasi dengan Anda</p>
                                    @else
                                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Belum Ada Chat</h2>
                                        <p class="text-gray-600 mb-6">Mulai konsultasi dengan memilih psikolog terlebih dahulu</p>
                                    @endrole
                                </div>
                                @role('psikolog')
                                    <div class="inline-flex items-center space-x-2 bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-700 px-6 py-3 rounded-xl">
                                        <i class="fas fa-info-circle"></i>
                                        <span class="font-semibold">Menunggu Pasien</span>
                                    </div>
                                @else
                                    <a href="/list-psikolog" class="inline-flex items-center space-x-2 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-search"></i>
                                        <span class="font-semibold">MULAI KONSULTASI</span>
                                    </a>
                                @endrole
                            </div>
                        </div>
                        <!-- Chat Input -->
                        <div class="border-t border-gray-200 bg-white">
                            <form class="p-4">
                                <div class="flex items-end space-x-3">
                                    <div class="flex-1 relative">
                                        <textarea 
                                            class="w-full rounded-xl border-2 border-gray-200 px-4 py-3 pr-12 resize-none bg-gray-100 cursor-not-allowed" 
                                            disabled 
                                            placeholder="{{ auth()->user()->hasRole('psikolog') ? 'Tunggu pasien untuk memulai konsultasi...' : 'Pilih psikolog terlebih dahulu untuk memulai konsultasi...' }}"
                                        ></textarea>
                                    </div>
                                    <button 
                                        class="flex items-center justify-center w-12 h-12 bg-gray-300 text-white rounded-xl cursor-not-allowed" 
                                        disabled
                                    >
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>