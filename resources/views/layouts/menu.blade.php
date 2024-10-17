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
            'url' => 'message.index',
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

<div class="basis-60   h-[calc(100vh-64px)] shrink-0  flex flex-col justify-between py-5 px-5 font-bold  text-md ">
    <ul class="bg-white dark:bg-slate-700 rounded-xl shadow-md p-6 flex flex-col ">
        @foreach ($links as $link)
            <li>
                <a class= "flex items-center  gap-3 hover:bg-slate-100 dark:hover:bg-slate-600 transition py-3 rounded-lg pl-2"
                    href="{{ route($link['url'], Auth::id()) }}">
                    <x-dynamic-component :component="$link['icon']" class="text-gray-500 w-5" />
                    {{ $link['name'] }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class=" bg-white dark:bg-slate-700  rounded-xl shadow-md py-3 pl-6 ">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                class="hover:bg-slate-100 dark:hover:bg-slate-600 transition block py-3 rounded-lg pl-2"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
    </div>
</div>
