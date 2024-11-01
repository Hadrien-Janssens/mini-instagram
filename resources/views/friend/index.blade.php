<x-app-layout class="flex justify-between">
    <h2 class="text-xl font-semibold mb-3">Membre{{ count($followeds) > 1 ? 's' : '' }}
        suivi{{ count($followeds) > 1 ? 's' : '' }}</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
        @forelse ($followeds as $followed)
            <x-user-card :followed="$followed" />
        @empty
            <div>
                <p class="font-bold text-xl"> Tu ne suis encore personne. </p>
                <p class="p-4 bg-blue-300 dark:bg-blue-800 text-white ">Fonctionnalité à venir : lister les suggestions
                </p>
            </div>
        @endforelse
    </div>
</x-app-layout>
