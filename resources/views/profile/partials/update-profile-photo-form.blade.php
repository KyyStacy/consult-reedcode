<section>
    <header class="mb-4 pb-4 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center text-white">
                <i class="fas fa-camera"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    {{ __('Foto Profil') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Perbarui foto profil Anda.') }}
                </p>
            </div>
        </div>
    </header>

    <form method="post" action="{{ route('profile.update-photo') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="flex">
            <div class="relative">
                <div class="w-52 h-52 rounded-md overflow-hidden">
                    @if ($user->photo)
                        <img id="photoPreview" class="w-full h-full rounded-md object-cover" src="{{ asset('storage/photos/' . $user->photo) }}" alt="Profile Photo">
                    @else
                        <img id="photoPreview" class="w-full h-full rounded-md object-cover" src="{{ asset('images/default-photo.png') }}" alt="Default Photo">
                    @endif
                    <div class="absolute inset-0 bg-black bg-opacity-50 rounded-md flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300 cursor-pointer" onclick="document.getElementById('photo').click()">
                        <label class="text-white text-sm font-semibold cursor-pointer">
                            <i class="fas fa-camera mr-1"></i> {{ __('Ganti Foto') }}
                        </label>
                    </div>
                </div>
                <input id="photo" name="photo" type="file" class="hidden" accept="image/*" onchange="updatePhotoPreview(this)">
            </div>
        </div>

        <x-input-error class="mt-2" :messages="$errors->get('photo')" />

        <div class="flex gap-4">
            <x-primary-button class="bg-gradient-to-r from-cyan-600 to-blue-600 border-0 hover:from-cyan-700 hover:to-blue-700">{{ __('Simpan') }}</x-primary-button>
        </div>
    </form>
</section>

<script>
    function updatePhotoPreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('photoPreview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>