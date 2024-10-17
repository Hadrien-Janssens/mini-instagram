<x-app-layout class="flex justify-between">

    {{-- POST LIST  --}}
    @foreach ($posts as $post)
        <x-post :post=$post></x-post>
    @endforeach

</x-app-layout>
