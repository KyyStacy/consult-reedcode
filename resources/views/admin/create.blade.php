<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-plus text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Tambah User</h2>
                        <p class="text-gray-600 mt-1">Buat akun pengguna baru untuk sistem</p>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-700 px-8 py-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-lg rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white">Form Tambah User</h3>
                            <p class="text-cyan-100 text-sm">Lengkapi informasi di bawah ini</p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="p-8">
                    <form id="addUserForm" action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-user mr-2 text-cyan-600"></i>Nama Lengkap
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        required 
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200" 
                                        placeholder="Masukkan nama lengkap"
                                    >
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-envelope mr-2 text-cyan-600"></i>Email
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        required 
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200" 
                                        placeholder="nama@email.com"
                                    >
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-2 text-cyan-600"></i>Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password" 
                                        required 
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200" 
                                        placeholder="Minimal 8 karakter"
                                    >
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-lock mr-2 text-cyan-600"></i>Konfirmasi Password
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input 
                                        type="password" 
                                        name="password_confirmation" 
                                        id="password_confirmation" 
                                        required 
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200" 
                                        placeholder="Ulangi password"
                                    >
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <!-- Role -->
                            <div class="md:col-span-2">
                                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-user-tag mr-2 text-cyan-600"></i>Peran (Role)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-shield-alt text-gray-400"></i>
                                    </div>
                                    <select 
                                        name="role" 
                                        id="role" 
                                        required 
                                        class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 bg-white focus:outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-colors duration-200 appearance-none"
                                    >
                                        <option value="" disabled selected>Pilih Peran</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Psikolog</option>
                                        <option value="3">User</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a 
                                href="{{ route('user-admin') }}" 
                                id="cancelBtn" 
                                class="inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-xl hover:bg-gray-50 transition-all duration-200"
                            >
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                            <button 
                                type="submit" 
                                id="submitBtn" 
                                class="inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-white bg-gradient-to-r from-cyan-600 to-blue-600 rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-200"
                            >
                                <i class="fas fa-check mr-2"></i>Tambah User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>