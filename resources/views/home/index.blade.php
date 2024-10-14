<x-app-layout class="flex justify-between">
    {{-- MENU --}}
    <div
        class="basis-80  border-r-[1px] border-gray-100 h-[calc(100vh-64px)] shrink-0  flex flex-col justify-between p-4">
        <ul>
            <li>Accueil</li>
            <li>Amis</li>
            <li>Notifications</li>
            <li>Messages</li>
            <li>Profil</li>
            <li>Réglages</li>
        </ul>
        <div>Se deconnecter</div>
    </div>
    {{-- MAIN --}}
    <div class=" shrink-0 grow basis-[800px] bg-slate-800 overflow-scroll h-[calc(100vh-64px)] px-20 py-10">
        <form action="{{ route('post.store') }}" class="mb-10 flex w-full gap-5" method="POST">
            @csrf
            <input type="text" placeholder="Que ressens-tu ?" class="grow text-neutral-900" name="title">
            <button class="border px-5">Publier</button>
        </form>

        @foreach ($posts as $post)
            <div class="py-5">
                @if ($post->img_path)
                    <img src="{{ Storage::url($post->img_path) }}" alt="" width="200px" height="200px"
                        class="w-full">
                @endif

                <p>{{ $post->title }}</p>
            </div>
        @endforeach
    </div>
    {{-- SIDEBAR --}}
    <div class="basis-80 border-l-[1px] border-gray-100 shrink-0 h-[calc(100vh-64px)] p-4">
        <p class="text-xl font-bold text-center mb-3">Connecté</p>
        <ul class="space-y-3">
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
        </ul>

        <p class="text-xl font-bold text-center mb-3">Suggestion</p>
        <ul class="space-y-3">
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
        </ul>
    </div>
</x-app-layout>
