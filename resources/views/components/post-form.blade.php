<div class=" bg-white rounded-xl shadow-md p-6 ">
    <form action="{{ route('post.store') }}" class=" flex flex-col w-full gap-3" method="POST">
        @csrf
        <div class=" flex w-full gap-3">
            <input type="text" placeholder="Que ressens-tu ?" class="grow text-neutral-900 border-slate-200 rounded-md"
                name="title">
            <button class="border bg-blue-500 rounded-md shadow-sm text-blue-50 px-5">Publier</button>
        </div>

        <label for="img" class="border">
            <input type="file" name="" id="img" hidden>
        </label>
    </form>
</div>
