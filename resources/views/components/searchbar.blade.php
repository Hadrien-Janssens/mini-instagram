<form action="" class=" flex flex-col grow gap-3 max-w-[800px] sticky -top-8">
    @csrf
    <div class=" flex w-full gap-3 dark:bg-slate-700 p-3 rounded-lg mb-5 bg-white shadow-md">
        <input type="text" placeholder="Rechercher un titre, autheur ou tag" name="search"
            value="{{ request('search') }}"
            class="grow dark:bg-slate-800  text-neutral-900 dark:text-slate-300 border-none rounded-md" name="title">
        <x-btn-secondary>Rechercher</x-btn-secondary>
    </div>
</form>
