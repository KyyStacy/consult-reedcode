<section>
    <header class="mb-4 pb-4 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white">
                <i class="fas fa-key"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    {{ __('Perbarui Kata Sandi') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Pastikan akun Anda menggunakan kata sandi acak yang panjang agar tetap aman.') }}
                </p>
            </div>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-gradient-to-r from-cyan-600 to-blue-600 border-0 hover:from-cyan-700 hover:to-blue-700">{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
