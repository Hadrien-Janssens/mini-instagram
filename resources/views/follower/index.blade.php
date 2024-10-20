<x-app-layout>
    <h2 class="text-xl font-semibold mb-3">Followers</h2>

    <div class="grid grid-cols-2 gap-4 ">
        @forelse ($followers as $follower)
            <x-user-card :followed="$follower" />
        @empty
            <div>
                <p class="font-bold text-xl"> Tu n'as pas encore de followers </p>
        @endforelse
    </div>
</x-app-layout>
