<x-app-layout class="flex justify-between">
    {{-- HEADER  --}}
    <div class="h-64 my-6 bg-slate-200 w-full rounded-lg">
        {{-- AVATAR --}}
        <div
            class="rounded-full w-56  h-56 bg-orange-500 flex justify-center items-center  border-[2px] border-orange-900 text-orange-50 overflow-hidden  relative translate-y-1/2 translate-x-1/4 ">
            <div>
                @if ($user->img_path)
                    <img src="{{ Storage::url($user->img_path) }}" alt="" class="object-cover  ">
                @else
                    <p class="font-extrabold text-9xl ">{{ Str::ucfirst($user->name[0]) }}</p>
                @endif
            </div>
        </div>


    </div>

    <div class="w-7/12 ml-auto">
        <div class=" flex justify-between items-center mt-4">
            <p class="text-3xl font-extrabold">{{ $user->name }}</p>
            @if ($user->id !== Auth::id())
                @if ($is_followed)
                    <form action="{{ route('friend.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-btn-secondary>ne plus suivre</x-btn-secondary>
                    </form>
                @else
                    <form action="{{ route('friend.store', $user->id) }}" method="POST">
                        @csrf
                        <x-btn-secondary>suivre</x-btn-secondary>
                    </form>
                @endif
            @endif
        </div>
        <p class="text-gray-500">{{ $user->bio }}</p>


    </div>
    <div class="mt-10">
        @foreach ($posts as $post)
            <x-post :post='$post'></x-post>
        @endforeach
    </div>
</x-app-layout>
