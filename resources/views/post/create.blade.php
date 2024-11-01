<x-app-layout>
    <div class="bg-white dark:bg-slate-700 rounded-xl shadow-md p-6">
        <form action="{{ route('post.store') }}" class="flex flex-col w-full gap-3" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="flex w-full gap-3 items-center">
                <label for="title" class="basis-40">Titre :</label>
                <input type="text"
                    class="grow border dark:bg-slate-800 text-neutral-900 border-slate-200 rounded-md dark:text-white"
                    value="{{ old('title') }}" name="title" id="title">
                @error('title')
                    <p class="text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex w-full gap-3 items-center">
                <label for="legende" class="basis-40">Légende :</label>
                <input type="text"
                    class="grow border dark:bg-slate-800 text-neutral-900 border-slate-200 rounded-md dark:text-white"
                    name="legende" value="{{ old('legende') }}" id="legende">
                @error('legende')
                    <p class="text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 items-center">
                <label for="img" class="basis-40">Photo :</label>
                <label for="img"
                    class="flex gap-1 border rounded-md py-0.5 px-1 items-center grow hover:dark:bg-slate-600 hover:bg-slate-100 hover:cursor-pointer transition">
                    <x-letsicon-img-box-duotone-line class="h-6 text-green-500" />
                    <p class="font-semibold text-gray-500 text-sm dark:text-white">Parcourir</p>
                    <input type="file" name="img_path" id="img" hidden>
                </label>
            </div>

            <!-- Conteneur pour l'aperçu de l'image -->
            <div id="preview-container" class="mt-3 flex justify-end">
                <img id="preview" src="" alt="Aperçu de la photo"
                    class="hidden w-32 h-32 object-cover rounded-md border" />
            </div>

            <button
                class="bg-blue-500 dark:bg-cyan-800 rounded-md shadow-sm text-blue-50 px-5 py-1 self-end hove:dark:bg-cyan-900 hover:bg-blue-600 hover:cursor-pointer transition">Publier</button>
            @error('img_path')
                <p class="text-red-400">{{ $message }}</p>
            @enderror
        </form>
    </div>

    <!-- Script JavaScript pour l'aperçu de l'image -->
    <script>
        document.getElementById('img').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('preview-container');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
