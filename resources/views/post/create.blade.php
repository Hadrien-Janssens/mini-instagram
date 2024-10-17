<x-app-layout>
    <div class=" bg-white dark:bg-slate-700 rounded-xl shadow-md p-6 ">
        <form action="{{ route('post.store') }}" class=" flex flex-col w-full gap-3" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class=" flex w-full gap-3 items-center">
                <label for="title" class="basis-40 ">Titre : </label>
                <input type="text" class="grow border dark:bg-slate-800  text-neutral-900 border-slate-200 rounded-md"
                    value="{{ old('title') }}" name="title" id="title">
                @error('title')
                    <p class="text-red-400">{{ $message }}</p>
                @enderror
            </div>


            <div class=" flex w-full gap-3 items-center">
                <label for="legende" class="basis-40">Legende : </label>
                <input type="text"
                    class="grow border dark:bg-slate-800  text-neutral-900 border-slate-200 rounded-md" name="legende"
                    value="{{ old('legende') }}" id="legende">
                @error('legende')
                    <p class="text-red-400">{{ $message }}</p>
                @enderror
            </div>


            <div class=" flex gap-3">
                <label for="img" class="flex gap-1 border rounded-md py-0.5 px-1 items-center">
                    <x-letsicon-img-box-duotone-line class="h-6 text-green-500" />
                    <p class="font-semibold text-gray-500 text-sm ">image</p>
                    <input type="file" name="img_path" id="img" hidden>
                </label>
                <label for="feeling" class="flex gap-1 border rounded-md py-0.5 px-1 items-center">
                    <x-bi-emoji-smile class="h-6 text-yellow-500" />
                    <p class="font-semibold text-gray-500 text-sm">humeur</p>
                    <input type="file" name="feeling" id="feeling" hidden>
                </label>
            </div>


            <button
                class=" bg-blue-500 dark:bg-cyan-800 rounded-md shadow-sm text-blue-50 px-5 self-end  ">Publier</button>
            @error('img_path')
                <p class="text-red-400">{{ $message }}</p>
            @enderror
        </form>
    </div>
</x-app-layout>
