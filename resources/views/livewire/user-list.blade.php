<div class="p-6">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-700 px-8 py-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 backdrop-blur-lg rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Data User</h2>
                        <p class="text-cyan-100 text-sm">Kelola pengguna sistem</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <!-- Filter Role -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-filter text-gray-400"></i>
                        </div>
                        <select wire:model="role" class="pl-10 pr-8 py-2.5 rounded-xl border-2 border-gray-200 bg-white text-gray-700 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200 appearance-none">
                            <option value="allrole">Semua Peran</option>
                            <option value="1">Admin</option>
                            <option value="2">Psikolog</option>
                            <option value="3">User</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>
                    
                    <!-- Search Input -->
                    <div class="relative flex-1 sm:flex-initial sm:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            wire:model="search" 
                            placeholder="Cari dengan email" 
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 border-gray-200 bg-white text-gray-700 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200"
                        >
                    </div>
                    
                    <!-- Action Buttons -->
                    <button 
                        wire:click="$refresh" 
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-white/20 backdrop-blur-lg text-white rounded-xl hover:bg-white/30 transition-all duration-200 border border-white/30"
                    >
                        <i class="fas fa-sync-alt mr-2"></i>Refresh
                    </button>
                    <a 
                        href="{{ route('admin.create') }}" 
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-white text-cyan-600 font-semibold rounded-xl hover:bg-cyan-50 hover:shadow-lg transition-all duration-200"
                    >
                        <i class="fas fa-user-plus mr-2"></i>Tambah User
                    </a>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto max-h-[37rem]">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-hashtag mr-2 text-cyan-600"></i>No
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-user mr-2 text-cyan-600"></i>Nama
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-envelope mr-2 text-cyan-600"></i>Email
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-user-tag mr-2 text-cyan-600"></i>Peran
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-circle mr-2 text-cyan-600"></i>Status
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                            <i class="fas fa-cog mr-2 text-cyan-600"></i>Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full text-xs font-semibold bg-cyan-100 text-cyan-800">
                                    {{ $loop->iteration }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-gray-700">{{ $user->email }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @foreach ($user->modelHasRoles as $peran)
                                    @if($peran->role_id == 1)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                            <i class="fas fa-crown mr-1"></i>Admin
                                        </span>
                                    @elseif($peran->role_id == 2)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                            <i class="fas fa-user-md mr-1"></i>Psikolog
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                            <i class="fas fa-user mr-1"></i>User
                                        </span>
                                    @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" wire:poll.5s>
                                @if ($user->is_online)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <span class="w-2 h-2 mr-2 bg-green-500 rounded-full animate-pulse"></span>
                                        Online
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                        <span class="w-2 h-2 mr-2 bg-gray-400 rounded-full"></span>
                                        Offline
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <a 
                                        href="{{ route('admin.edit', $user->id) }}" 
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-200"
                                    >
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </a>
                                    <form 
                                        action="{{ route('admin.destroy', $user->id) }}" 
                                        method="POST" 
                                        onsubmit="return confirm('Akun akan terhapus, Yakin?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-200"
                                        >
                                            <i class="fas fa-trash mr-2"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-users text-gray-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Tidak Ada Data User</h3>
                                    <p class="text-gray-500 text-sm">Belum ada user yang ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>