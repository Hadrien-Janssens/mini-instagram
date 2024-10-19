<x-app-layout class="flex justify-between">

    {{-- POST LIST  --}}
    <div>

        @foreach ($posts as $post)
            <x-post :post=$post></x-post>
        @endforeach
    </div>

</x-app-layout>
