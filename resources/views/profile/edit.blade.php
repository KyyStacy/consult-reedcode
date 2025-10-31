<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-blue-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Page Title -->
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-user-cog"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Pengaturan Profil</h1>
            </div>
            <p class="text-gray-600 mb-4">Kelola informasi akun, foto profil, dan keamanan Anda.</p>

            <div class="p-6 sm:p-8 bg-white shadow-xl border border-gray-100 rounded-2xl">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-photo-form')
                </div>
            </div>
            <div class="p-6 sm:p-8 bg-white shadow-xl border border-gray-100 rounded-2xl">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-6 sm:p-8 bg-white shadow-xl border border-gray-100 rounded-2xl">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <div class="p-6 sm:p-8 bg-white shadow-xl border border-gray-100 rounded-2xl">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>