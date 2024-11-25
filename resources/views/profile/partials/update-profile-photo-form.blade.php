<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Foto Profil
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Perbarui foto profil akun Anda.
        </p>
    </header>

    <form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex items-center space-x-6">
            <div class="shrink-0">
                <img id="preview_photo" class="h-32 w-32 object-cover rounded-md border-2 border-blue-300 shadow-md"src="{{ $user->foto_profil ? asset('storage/' . $user->foto_profil) : asset('images/default-photo.png') }}" alt="Foto Profil Saat Ini">
            </div>            
            <label class="block">
                <span class="sr-only">Pilih foto profil baru</span>
                <input type="file" name="photo" id="photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
            </label>
        </div>

        <div class="mt-6 flex items-center gap-4">
            <x-primary-button>Simpan Foto</x-primary-button>

            @if (session('status') === 'profile-photo-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>

<script>
document.getElementById('photo').onchange = function(evt) {
    const [file] = this.files;
    if (file) {
        document.getElementById('preview_photo').src = URL.createObjectURL(file);
    }
}
</script>