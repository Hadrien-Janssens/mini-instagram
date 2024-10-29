@php
    $links = [
        [
            'name' => 'Accueil',
            'url' => 'home.index',
            'icon' => 'fas-house',
        ],
        [
            'name' => 'Créer',
            'url' => 'post.create',
            'icon' => 'fas-plus',
        ],
        [
            'name' => 'Suivi(es)',
            'url' => 'friend.index',
            'icon' => 'fas-binoculars',
        ],
        [
            'name' => 'Followers',
            'url' => 'follower.index',
            'icon' => 'fas-user-group',
        ],
        [
            'name' => 'Notifications',
            'url' => 'notification.index',
            'icon' => 'fas-bell',
        ],
        [
            'name' => 'Messages',
            'url' => 'conversation.index',
            'icon' => 'fas-comments',
        ],
        [
            'name' => 'Profile',
            'url' => 'user.index',
            'icon' => 'fas-user',
        ],
        [
            'name' => 'Compte',
            'url' => 'profile.edit',
            'icon' => 'fas-wrench',
        ],
    ];
@endphp

<div class=" h-[calc(100vh-100px)] flex flex-col justify-between font-bold  text-md">
    <ul class="bg-white dark:bg-slate-700 rounded-xl shadow-md py-6 flex flex-col grow-0">
        @foreach ($links as $link)
            <li>
                <a class= "flex items-center  gap-3 hover:bg-slate-100 dark:hover:bg-slate-600 transition py-3 px-5 rounded-lg "
                    href="{{ route($link['url'], Auth::id()) }}">
                    <div class="relative">
                        <x-dynamic-component :component="$link['icon']" class=" text-gray-500 dark:text-gray-300 w-5" />
                        @if ($link['url'] === 'notification.index')
                            <x-notif class="-top-1 -right-1" />
                        @endif
                    </div>
                    <p class="hidden lg:block"> {{ $link['name'] }}</p>

                </a>
            </li>
        @endforeach
    </ul>

    <div class=" bg-white dark:bg-slate-700  rounded-xl shadow-md py-3 ">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                class="hover:bg-slate-100 dark:hover:bg-slate-600 transition block py-3 rounded-lg pl-2"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                {{ __('Logout') }}
            </x-dropdown-link>
        </form>
    </div>
</div>
