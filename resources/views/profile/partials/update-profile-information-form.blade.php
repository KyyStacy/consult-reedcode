<section>
    <header class="mb-4 pb-4 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white">
                <i class="fas fa-id-card"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    {{ __('Informasi Profil') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __("Perbarui informasi profil akun Anda.") }}
                </p>
            </div>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        @if($user->hasRole('psikolog'))
            <div>
                <x-input-label for="bio" :value="__('Biodata')" />
                <x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full" :value="old('bio', $user->detailPsikolog->bio ?? '')" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('bio')" />
            </div>
            <div>
                <x-input-label for="harga" :value="__('Harga')" />
                <x-text-input id="harga" name="harga" type="number" class="mt-1 block w-full" :value="old('harga', $user->detailPsikolog->harga ?? '')" required />
                <x-input-error class="mt-2" :messages="$errors->get('harga')" />
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button class="bg-gradient-to-r from-cyan-600 to-blue-600 border-0 hover:from-cyan-700 hover:to-blue-700">{{ __('Simpan') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
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