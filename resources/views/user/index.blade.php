<x-app-layout class="flex justify-between">
    {{-- HEADER  --}}
    <div class="h-64  bg-slate-200 w-full rounded-lg">
        {{-- AVATAR --}}
        <div
            class="rounded-full w-56  h-56 bg-orange-500 flex justify-center items-center  border-[2px] border-orange-900 text-orange-50 overflow-hidden cursor-pointer relative translate-y-1/2 translate-x-1/4 ">
            <a href="{{ route('user.index') }}">
                @if (Auth::user()->img_path)
                    <img src="{{ Storage::url(Auth::user()->img_path) }}" alt="" class="object-cover  ">
                @else
                    <p class="font-extrabold ">{{ Str::ucfirst(Auth::user()->name[0]) }}</p>
                @endif
            </a>
        </div>

    </div>

    <div class="w-7/12 ml-auto">
        <p class="text-3xl font-extrabold">{{ Auth::user()->name }}</p>
    </div>
</x-app-layout>
