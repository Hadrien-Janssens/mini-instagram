@props(['post'])
<div class="bg-white rounded-xl shadow-md p-6 my-10">
    {{-- HEADER  POST --}}
    <div class="flex justify-between">
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
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <x-polaris-menu-vertical-icon class=" h-10 text-gray-500 cursor-pointer" />
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('profil') }}
                </x-dropdown-link>

                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('voir plus') }}
                </x-dropdown-link>
                <hr>
                <!-- Auth::user() modification -->
                @if (Auth::id() === $post->user_id)
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('modifier') }}
                        </x-dropdown-link>
                    </form>
                    <form method="POST" action="{{ route('post.destroy', $post) }}">
                        @csrf
                        @method('DELETE')

                        <button
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('supprimer') }}
                        </button>
                    </form>
                @endif
                <hr>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('signaler') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>

    </div>
    {{-- BODY POST --}}
    <div>
        @if ($post->img_path)
            <img src="{{ Storage::url($post->img_path) }}" alt="" width="200px" height="200px"
                class=" w-full h-[450px] rounded-md object-cover">
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
