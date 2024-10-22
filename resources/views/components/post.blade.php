@props(['post', 'comments'])
<div class="bg-white dark:bg-slate-700 rounded-xl shadow-md p-6 mb-10 flex flex-col gap-5">

    {{-- HEADER  POST --}}
    {{-- si je suis sur la page avec la route post.show , ne pas afficher le header --}}
    @if (Route::currentRouteName() !== 'post.show')
        <div class="flex justify-between">
            <div class="flex items-center gap-3">
                <x-avatar :user='$post->user' :width='12'></x-avatar>
                <div>
                    <a href="{{ route('user.index', $post->user) }}"
                        class="font-extrabold  text-sm">{{ $post->user->name }}</a>
                    <p class="text-gray-400 font-bold text-sm">{{ $post->created_at }} </p>
                </div>

            </div>



            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <x-polaris-menu-vertical-icon class=" h-10 text-gray-500 cursor-pointer" />
                </x-slot>

                <x-slot name="content">




                    @if ($post->user_id !== Auth::id() && Route::currentRouteName() !== 'user.index')
                        <div>
                            @if ($post->is_followed)
                                <form action="{{ route('friend.destroy', $post->user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                        {{ __('ne plus suivre') }}
                                    </x-dropdown-link>
                                </form>
                            @else
                                <form action="{{ route('friend.store', $post->user->id) }}" method="POST">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                        {{ __('suivre') }}
                                    </x-dropdown-link>
                                </form>
                            @endif
                        </div>
                    @endif




                    <x-dropdown-link :href="route('user.index', $post->user)">
                        {{ __('profil') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('post.show', $post)">
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

                            <x-dropdown-link
                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('supprimer') }}
                            </x-dropdown-link>
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
    @endif

    {{-- BODY POST --}}
    <a href="{{ route('post.show', $post) }}" class="flex flex-col">
        <div>
            @if ($post->img_path)
                <img src="{{ Storage::url($post->img_path) }}" alt="" width="200px" height="200px"
                    class=" w-full h-[500px]  rounded-md object-cover">
            @endif
        </div>
        <div class="flex flex-col gap-2">
            <p class="font-medium text-lg ">{{ $post->title }}</p>
            <p class="text-gray-500"> {{ $post->content }} </p>
        </div>
    </a>

    {{-- FOOTER POST --}}
    <div class="flex gap-3 justify-end mt-">

        <x-btn-secondary>Partager</x-btn-secondary>
        <form action="{{ route('likePost', $post) }}" method="POST">
            @csrf
            @if ($post->is_liked)
                <x-btn-secondary>Disliker</x-btn-secondary>
            @else
                <x-btn-secondary>Liker</x-btn-secondary>
            @endif
        </form>
    </div>

    <div class="flex flex-col gap-4 max-h-52    overflow-scroll no-scrollbar">
        @forelse ($post->comments as $comment)
            <div>
                <div class="flex gap-2">
                    <x-avatar :user='$comment->user' :width='8'></x-avatar>
                    <div>
                        <p class="font-bold"> {{ $comment->user->name }}</p>
                        <p class="text-sm"> {{ $comment->content }}</p>
                    </div>
                </div>
                <div class=" border-b border-slate-600 h-1 mx-5 my-2"></div>

            </div>
        @empty
            <p class="text-gray-500">Aucun commentaire</p>
        @endforelse



    </div>
    <div>
        <form action="{{ route('comment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <textarea name="content" id="" cols="20" rows="3"
                class="w-full  dark:bg-slate-800 shadow border-none bg-gray-50  rounded resize-none"></textarea>
            <x-btn-secondary>Commenter</x-btn-secondary>
        </form>
    </div>

</div>
