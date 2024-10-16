<x-app-layout class="flex justify-between">
    {{-- HEADER  --}}
    <div class="h-64  bg-slate-200 w-full rounded-lg">
        {{-- AVATAR --}}
        <div
            class="rounded-full w-56  h-56 bg-orange-500 flex justify-center items-center  border-[2px] border-orange-900 text-orange-50 overflow-hidden  relative translate-y-1/2 translate-x-1/4 ">
            <div>
                @if ($user->img_path)
                    <img src="{{ Storage::url($user->img_path) }}" alt="" class="object-cover  ">
                @else
                    <p class="font-extrabold ">{{ Str::ucfirst($user->name[0]) }}</p>
                @endif
            </div>
        </div>

    </div>

    <div class="w-7/12 ml-auto">
        <p class="text-3xl font-extrabold">{{ $user->name }}</p>
        <p class="text-gray-500">{{ $user->bio }}</p>
    </div>
    <div>
        @foreach ($posts as $post)
            <x-post :post='$post' :user='$user'></x-post>
        @endforeach
    </div>
</x-app-layout>
