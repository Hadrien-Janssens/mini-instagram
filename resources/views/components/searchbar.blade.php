@props(['placeholder' => 'Rechercher un article ou un utilisateur'])

<form action="" class=" flex flex-col grow gap-3 sticky -top-0 z-50">
    @csrf
    <div class=" flex w-full gap-3 dark:bg-slate-700 p-3 rounded-lg mb-5 bg-white shadow-md">
        <input type="text" placeholder="{{ $placeholder }}"" name="search" value="{{ request('search') }}"
            class="grow dark:bg-slate-800  text-neutral-900 dark:text-slate-300 border-none rounded-md">
        <x-btn-secondary>Rechercher</x-btn-secondary>
    </div>
</form>
