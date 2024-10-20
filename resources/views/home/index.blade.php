<x-app-layout class="flex justify-between">

    {{-- POST LIST  --}}
    <div>
        <x-searchbar></x-searchbar>
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
