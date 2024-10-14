<x-app-layout class="flex justify-between">



    {{-- NEW POST FORM  --}}
    <form action="{{ route('post.store') }}" class="mb-10 flex w-full gap-5" method="POST">
        @csrf
        <input type="text" placeholder="Que ressens-tu ?" class="grow text-neutral-900" name="title">
        <button class="border px-5">Publier</button>
    </form>


    {{-- POST LIST  --}}
    @foreach ($posts as $post)
        <div class="py-5">
            @if ($post->img_path)
                <img src="{{ Storage::url($post->img_path) }}" alt="" width="200px" height="200px"
                    class="w-full">
            @endif

            <p>{{ $post->title }}</p>
        </div>
    @endforeach

</x-app-layout>
