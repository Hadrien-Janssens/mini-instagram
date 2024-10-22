<x-app-layout class="flex justify-between">

    {{-- POST LIST  --}}
    <div>
        <x-searchbar></x-searchbar>
        {{-- si le paramatre 'search' est dans l'url --}}
        @if (request()->has('search') && request('search') != '' && $users->count() > 0)
            <p class="mb-1">
                Compte pour la
                recherche :
                <span class="font-semibold italic">{{ request('search') }}</span>

            </p>
            <div class="text-gray-400  border border-gray-500 rounded py-2 p-3 max-h-32   overflow-scroll no-scrollbar">



                <div>
                    @foreach ($users as $user)
                        <div class="flex items-end gap-2 space-y-3 hover:bg-gray-700 rounded p-1">
                            <x-avatar :user="$user" :width=6 class="w-8 h-8"></x-avatar>
                            <a href="{{ route('user.index', $user) }}">{{ $user->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr class="m-5 border-gray-400">

        @endif


        @if (request()->has('search') && request('search') != '')
            <p class="mb-1">Publication pour la recherche : <span
                    class="font-semibold italic">{{ request('search') }}</span></p>
        @endif

        @foreach ($followedUserPosts as $post)
            <x-post :post=$post :comments='$comments'></x-post>
        @endforeach

        @forelse ($posts as $post)
            <x-post :post=$post :comments='$comments'></x-post>
        @empty
            <div class="text-gray-400 italic text-center border border-gray-500 rounded py-2">Aucun post n'a été trouvé
                pour
                ta
                recherche</div>
        @endforelse
    </div>

</x-app-layout>
