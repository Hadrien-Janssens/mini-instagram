<form action="{{ route('post.store') }}" class=" flex flex-col grow gap-3 max-w-[800px]" method="POST">
    @csrf
    <div class=" flex w-full gap-3 bg-slate-700 p-3 rounded-lg mb-5">
        <input type="text" placeholder="Rechercher un titre, autheur ou tag"
            class="grow dark:bg-slate-800 text-neutral-900 border-none rounded-md" name="title">
        <x-btn-secondary>Rechercher</x-btn-secondary>
    </div>
</form>
