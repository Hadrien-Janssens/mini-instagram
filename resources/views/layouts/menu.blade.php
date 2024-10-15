<div class="basis-60   h-[calc(100vh-64px)] shrink-0  flex flex-col justify-between py-5 px-5 font-bold  text-md ">
    <ul class="bg-white rounded-xl shadow-md p-6 flex flex-col ">
        <li>
            <a class="hover:bg-slate-100 transition block py-3 rounded-lg pl-2" href="{{ route('home.index') }}">
                {{ __('Accueil') }}
            </a>
        </li>
        <li> <a class="hover:bg-slate-100 transition block py-3 rounded-lg pl-2" href="{{ route('friend.index') }}">
                {{ __('Followers') }}
            </a></li>
        <li>
            <a class="hover:bg-slate-100 transition block py-3 rounded-lg pl-2" href="{{ route('notification.index') }}">
                {{ __('Notifications') }}
            </a>
        </li>
        <li>
            <a class="hover:bg-slate-100 transition block py-3 rounded-lg pl-2" href="{{ route('message.index') }}">
                {{ __('Messages') }}
            </a>
        </li>
        <li>
            <a class="hover:bg-slate-100 transition block py-3 rounded-lg pl-2" href="{{ route('user.index') }}">
                {{ __('Profile') }}
            </a>
        </li>
        <li>
            <a class="hover:bg-slate-100 transition block py-3 rounded-lg pl-2" href="{{ route('profile.edit') }}">
                {{ __('Compte') }}
            </a>
        </li>
    </ul>
    <div class=" bg-white rounded-xl shadow-md py-3 pl-6 ">
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
