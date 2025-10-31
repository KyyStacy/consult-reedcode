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
                            @role('admin|user')
                            <a href="/preview-chat" class="text-white focus:outline-none hover:text-cyan-100 transition-colors">
                                <button class="p-2 hover:bg-white/10 rounded-lg transition-colors">
                                    <i class="fas fa-arrow-left text-lg"></i>
                                </button>
                            </a>
                            @endrole
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="fas fa-comments text-xl"></i>
                                </div>
                                <h1 class="text-xl font-bold">Pesan</h1>
                            </div>
                        </header>
                        <!-- Contact List -->
                        <div class="overflow-y-auto h-[36rem] p-3" wire:poll="pollConversations">
                            @foreach ($conversations as $conversation)
                                @php
                                    $conversationUser = $conversation['user'];
                                @endphp
                                <a href="{{ route('chat', ['from_user_id' => auth()->id(), 'user' => $conversationUser->id]) }}">
                                    <div class="flex items-center mb-3 cursor-pointer hover:bg-cyan-50 p-3 rounded-xl transition-all duration-200 border border-transparent hover:border-cyan-200">
                                        @foreach ($conversationUser->modelHasRoles as $peran)
                                            <div class="w-12 h-12 rounded-full flex items-center justify-center mr-3 ring-2 ring-cyan-100">
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
                            @endforeach
                        </div>
                    </div>
                    <!-- Main Chat Area -->
                    <div class="flex-1 flex flex-col">
                        <!-- Chat Header -->
                        <header class="text-white bg-gradient-to-r from-cyan-500 to-blue-600 p-4 flex justify-between items-center" wire:poll="pollChatStatus">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full ring-2 ring-white/30 overflow-hidden">
                                    @if ($user->photo)
                                        <img class="w-full h-full object-cover" src="{{ asset('storage/photos/' . $user->photo) }}" alt="Profile Photo">
                                    @else
                                        <img class="w-full h-full object-cover" src="{{ asset('images/default-photo.png') }}" alt="Default Photo">
                                    @endif
                                </div>
                                <h1 class="text-xl font-bold">{{ $user->name}}</h1>
                            </div>
                            @role('psikolog')
                                @if (!$chatEnded)
                                    <form wire:submit.prevent="endChat">
                                        <button type="submit" class="flex items-center space-x-2 bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition-all duration-200 disabled:bg-gray-400 disabled:hover:bg-gray-500 disabled:cursor-not-allowed shadow-lg hover:shadow-xl" @if(!$canSendMessage) disabled @endif>
                                            <i class="fas fa-times-circle"></i>
                                            <span>Akhiri Chat</span>
                                        </button>
                                    </form>
                                @endif
                            @endrole
                        </header>
                        <!-- Chat Messages -->
                        <div id="chatMessages" class="flex-1 overflow-y-auto p-6 bg-gradient-to-b from-gray-50 to-white space-y-4" wire:poll>
                            @foreach ($messages as $message)
                                @if($message->from_user_id == auth()->id())
                                    <div class="flex justify-end">
                                        <div class="flex items-end space-x-2 max-w-[70%]">
                                            <div class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-2xl rounded-br-md px-4 py-3 shadow-lg">
                                                <p class="text-sm whitespace-pre-wrap break-words">{{ $message->message }}</p>
                                            </div>
                                            <div class="w-8 h-8 rounded-full ring-2 ring-cyan-100 flex-shrink-0 overflow-hidden">
                                                @if (Auth::user()->photo)
                                                    <img class="w-full h-full object-cover" src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="Profile Photo">
                                                @else
                                                    <img class="w-full h-full object-cover" src="{{ asset('images/default-photo.png') }}" alt="Default Photo">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex justify-start">
                                        <div class="flex items-end space-x-2 max-w-[70%]">
                                            <div class="w-8 h-8 rounded-full ring-2 ring-cyan-100 flex-shrink-0 overflow-hidden">
                                                @if ($user->photo)
                                                    <img class="w-full h-full object-cover" src="{{ asset('storage/photos/' . $user->photo) }}" alt="Profile Photo">
                                                @else
                                                    <img class="w-full h-full object-cover" src="{{ asset('images/default-photo.png') }}" alt="Default Photo">
                                                @endif
                                            </div>
                                            <div class="bg-white text-gray-800 rounded-2xl rounded-bl-md px-4 py-3 shadow-md border border-gray-200">
                                                <p class="text-sm whitespace-pre-wrap break-words">{{ $message->message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <!-- Chat Input -->
                        <div class="border-t border-gray-200 bg-white">
                            <form wire:submit.prevent="sendMessage" id="messageForm" class="p-4">
                                @csrf
                                <div class="flex items-end space-x-3">
                                    <div class="flex-1 relative">
                                        <textarea 
                                            class="w-full rounded-xl border-2 border-gray-200 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 focus:ring-opacity-50 px-4 py-3 pr-12 resize-none transition-all duration-200 disabled:bg-gray-100 disabled:cursor-not-allowed" 
                                            wire:model="message" 
                                            placeholder="{{ $canSendMessage && !$chatEnded ? 'Tulis pesan...' : ($chatEnded ? (auth()->user()->hasRole('psikolog') ? 'Chat telah diakhiri. Menunggu pasien membuat transaksi baru.' : 'Chat telah diakhiri. Silakan buat transaksi baru untuk melanjutkan konsultasi.') : (auth()->user()->hasRole('psikolog') ? 'Menunggu pasien membuat transaksi.' : 'Silakan buat transaksi terlebih dahulu untuk memulai konsultasi.')) }}" 
                                            id="messageTextarea" 
                                            rows="1"
                                            {{ $canSendMessage && !$chatEnded ? '' : 'disabled' }}
                                        ></textarea>
                                    </div>
                                    <button 
                                        type="submit" 
                                        class="flex items-center justify-center w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-xl transition-all duration-200 disabled:bg-gray-300 disabled:hover:bg-gray-300 disabled:cursor-not-allowed shadow-lg hover:shadow-xl" 
                                        {{ $canSendMessage && !$chatEnded ? '' : 'disabled' }}
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
<script>
    document.getElementById('messageForm').addEventListener('submit', function() {
        // Reset textarea value to empty string after form submission
        document.getElementById('messageTextarea').value = '';
    });
    document.addEventListener('DOMContentLoaded', function() {
        var chatMessages = document.getElementById('chatMessages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    });
</script>