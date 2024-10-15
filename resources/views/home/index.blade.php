<x-app-layout class="flex justify-between">

    {{-- NEW POST FORM  --}}
    @include('components.post-form')

    {{-- POST LIST  --}}
    @foreach ($posts as $post)
        <x-post :post=$post></x-post>
    @endforeach

</x-app-layout>
