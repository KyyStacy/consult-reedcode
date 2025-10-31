<div class="mt-14 inset-0 flex">
    <!-- Sidebar backdrop (mobile only) -->
    <div class="inset-0 bg-black bg-opacity-50 z-40 lg:hidden lg:z-auto transition-opacity duration-300" :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak @click="sidebarOpen = false"></div>
    
    <!-- Sidebar -->
    <div id="sidebar" 
        class="flex flex-col justify-between absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-gradient-to-b from-white to-gray-50 border-r border-gray-200 shadow-xl pl-4 pr-4 pb-8 transition-all duration-300 ease-in-out" 
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" 
        @click.outside="sidebarOpen = false" 
        @keydown.escape.window="sidebarOpen = false" 
        x-cloak="lg">
        <!-- Sidebar header -->
        <div class="flex justify-between items-center mt-5 pr-3 sm:px-2">
            <button class="lg:hidden text-gray-500 hover:text-cyan-600 transition-colors duration-200 p-2 hover:bg-cyan-50 rounded-lg" @click.stop="sidebarOpen = !sidebarOpen" aria-controls="sidebar" :aria-expanded="sidebarOpen">
                <span class="sr-only">Close sidebar</span>
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Links -->
        <div class="space-y-6 h-screen justify-between flex flex-col pb-4">
            <!-- Pages group -->
            <div>
                <!-- User Profile Section -->
                <div class="flex flex-col items-center mb-6 px-3">
                    <div class="relative mb-3">
                        <div class="w-20 h-20 rounded-2xl border-4 border-cyan-400 shadow-lg overflow-hidden bg-gradient-to-br from-cyan-100 to-blue-100">
                        @if (Auth::user()->photo)
                                <img class="w-full h-full object-cover" src="{{ asset('storage/photos/' . Auth::user()->photo) }}" alt="Profile Photo">
                        @else
                                <img class="w-full h-full object-cover" src="{{ asset('images/default-photo.png') }}" alt="Default Photo">
                        @endif
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 border-2 border-white rounded-full"></div>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900 text-center leading-tight">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-gray-500 text-center mt-1">{{ Auth::user()->email }}</p>
                </div>
                <ul class="space-y-2">
                    <!-- Dashboard -->
                    <li>
                        @if(auth()->user()->hasRole('admin'))
                            <a class="flex items-center px-4 py-3 rounded-xl mb-1 transition-all duration-200 {{ Request::segment(1) === 'psikolog' || Request::segment(1) === 'admin' ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg' : 'text-gray-700 hover:bg-cyan-50 hover:text-cyan-600' }}" href="{{ route('user-admin') }}">
                        @elseif(auth()->user()->hasRole('psikolog'))
                            <a class="flex items-center px-4 py-3 rounded-xl mb-1 transition-all duration-200 {{ Request::segment(1) === 'psikolog' || Request::segment(1) === 'admin' ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg' : 'text-gray-700 hover:bg-cyan-50 hover:text-cyan-600' }}" href="{{ route('psikolog') }}">
                        @endif
                            <div class="flex items-center w-full">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ Request::segment(1) === 'psikolog' || Request::segment(1) === 'admin' ? 'bg-white/20' : 'bg-cyan-100' }}">
                                    <i class="fas fa-tachometer-alt {{ Request::segment(1) === 'psikolog' || Request::segment(1) === 'admin' ? 'text-white' : 'text-cyan-600' }}"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <!-- Messages -->
                    @if(auth()->user()->hasRole('psikolog'))
                        <li>
                            <a class="flex items-center px-4 py-3 rounded-xl mb-1 transition-all duration-200 {{ Request::segment(1) === 'preview-chat' || Request::segment(1) === 'chat' ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg' : 'text-gray-700 hover:bg-cyan-50 hover:text-cyan-600' }}" href="{{ route('preview-chat') }}">
                                <div class="flex items-center w-full">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ Request::segment(1) === 'preview-chat' || Request::segment(1) === 'chat' ? 'bg-white/20' : 'bg-cyan-100' }}">
                                        <i class="fas fa-comments {{ Request::segment(1) === 'preview-chat' || Request::segment(1) === 'chat' ? 'text-white' : 'text-cyan-600' }}"></i>
                                    </div>
                                    <span class="text-sm font-semibold ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Pesan</span>
                                </div>
                            </a>
                        </li>
                    @endif
                    <!-- Order History -->
                    @if(auth()->user()->hasRole('admin'))
                        <li>
                            <a class="flex items-center px-4 py-3 rounded-xl mb-1 transition-all duration-200 {{ Request::segment(1) === 'transaksi' ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg' : 'text-gray-700 hover:bg-cyan-50 hover:text-cyan-600' }}" href="{{ route('transaksi') }}">
                                <div class="flex items-center w-full">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ Request::segment(1) === 'transaksi' ? 'bg-white/20' : 'bg-cyan-100' }}">
                                        <i class="fas fa-receipt {{ Request::segment(1) === 'transaksi' ? 'text-white' : 'text-cyan-600' }}"></i>
                                    </div>
                                    <span class="text-sm font-semibold ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Data Transaksi</span>
                                </div>
                            </a>
                        </li>
                    @elseif(auth()->user()->hasRole('psikolog'))
                        <li>
                            <a class="flex items-center px-4 py-3 rounded-xl mb-1 transition-all duration-200 {{ Request::segment(1) === 'riwayat' ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg' : 'text-gray-700 hover:bg-cyan-50 hover:text-cyan-600' }}" href="{{ route('riwayat') }}">
                                <div class="flex items-center w-full">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ Request::segment(1) === 'riwayat' ? 'bg-white/20' : 'bg-cyan-100' }}">
                                        <i class="fas fa-history {{ Request::segment(1) === 'riwayat' ? 'text-white' : 'text-cyan-600' }}"></i>
                                    </div>
                                    <span class="text-sm font-semibold ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Riwayat Konsultasi</span>
                                </div>
                            </a>
                        </li>
                    @endif
                    <!-- Edit Profile -->
                    <li>
                        <a class="flex items-center px-4 py-3 rounded-xl mb-1 transition-all duration-200 {{ Request::segment(1) === 'profile' ? 'bg-gradient-to-r from-cyan-500 to-blue-600 text-white shadow-lg' : 'text-gray-700 hover:bg-cyan-50 hover:text-cyan-600' }}" href="{{ route('profile.edit') }}">
                            <div class="flex items-center w-full">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center {{ Request::segment(1) === 'profile' ? 'bg-white/20' : 'bg-cyan-100' }}">
                                    <i class="fas fa-user-edit {{ Request::segment(1) === 'profile' ? 'text-white' : 'text-cyan-600' }}"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Edit Profile</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="pb-6 pt-4 border-t border-gray-200">
                <!-- Logout -->
                <div>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <a class="flex items-center px-4 py-3 rounded-xl mb-2 transition-all duration-200 text-red-600 hover:bg-red-50 hover:text-red-700" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                            <div class="flex items-center w-full">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-red-100">
                                    <i class="fas fa-sign-out-alt text-red-600"></i>
                                </div>
                                <span class="text-sm font-semibold ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Logout</span>
                            </div>
                        </a>
                    </form>
                </div>
            </div>
        </div>
        <!-- Expand / collapse button -->
        <div class="pt-4 hidden lg:inline-flex 2xl:hidden justify-center border-t border-gray-200 mt-auto">
            <button 
                @click="sidebarExpanded = !sidebarExpanded" 
                class="w-full mx-3 py-3 px-4 rounded-xl bg-cyan-50 hover:bg-cyan-100 text-cyan-600 transition-all duration-200 flex items-center justify-center"
            >
                <i class="fas fa-chevron-right transition-transform duration-200" :class="sidebarExpanded ? 'rotate-180' : ''"></i>
                <span class="ml-2 text-sm font-medium opacity-0 sidebar-expanded:opacity-100 transition-opacity duration-200">Collapse</span>
            </button>
        </div>
    </div>
</div>