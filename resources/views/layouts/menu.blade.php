<div
    class="basis-60 border-r dark:border-gray-700 border-gray-300  h-[calc(100vh-64px)] shrink-0  flex flex-col justify-between py-5 px-10 font-bold  text-lg">
    <ul class="space-y-6">
        <li>
            <a href="{{ route('home.index') }}">
                {{ __('Accueil') }}
            </a>
        </li>
        <li>Amis</li>
        <li>Notifications</li>
        <li>Messages</li>
        <li>
            Profile
        </li>
        <li>
            <a href="{{ route('profile.edit') }}">
                {{ __('Compte') }}
            </a>
        </li>
    </ul>
    <div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
    </div>
</div>
