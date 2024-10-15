<x-app-layout class="flex justify-between">
    {{-- NEW POST FORM  --}}
    @include('components.post-form')


    {{-- POST LIST  --}}
    @foreach ($posts as $post)
        <div class="bg-white rounded-xl shadow-md p-6 my-10">
            {{-- HEADER  POST --}}
            <div class="mb-3 flex items-center gap-3">
                @if ($post->user->img_path)
                    <div>
                        <img src="{{ Storage::url($post->user->img_path) }}" alt="" width="200px" height="200px"
                            class="object-cover w-12 h-12 rounded-full border-[2px] border-orange-900">
                    </div>
                @else
                    <div
                        class="rounded-full w-12  h-12 bg-orange-500 flex justify-center items-center  border-[2px] border-orange-900 text-orange-50 overflow-hidden cursor-pointer ">
                        {{ $post->user->name[0] }}
                    </div>
                @endif
                <div>
                    <p class="font-extrabold  text-sm">{{ $post->user->name }}</p>
                    <p class="text-gray-400 font-bold text-sm">il y a 5 minutes</p>
                </div>

            </div>
            {{-- BODY POST --}}
            <div>
                @if ($post->img_path)
                    <img src="{{ Storage::url($post->img_path) }}" alt="" width="200px" height="200px"
                        class="w-full rounded-md">
                @endif

            </div>

            {{-- FOOTER POST --}}
            <div class="flex flex-col gap-2">
                <p class="font-medium text-lg ">{{ $post->title }}</p>
                <p class="text-gray-500"> {{ $post->content }} </p>
                <div class="flex gap-3 justify-end ">
                    <button class="border rounded-md px-3 py-0.5">Commenter</button>
                    <button class="border rounded-md px-3 py-0.5">Liker</button>
                </div>
            </div>

        </div>
    @endforeach

</x-app-layout>
