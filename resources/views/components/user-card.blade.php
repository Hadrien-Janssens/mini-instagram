@props(['followed'])

<div class="shadow-md p-3 rounded-lg bg-white dark:bg-slate-700">
    <div class="flex justify-between gap-2 items-center">

        @if ($followed->img_path)
            <div>
                <img src="{{ Storage::url($followed->img_path) }}" alt="" width="200px" height="200px"
                    class="object-cover w-12 h-12 rounded-full border-[2px] border-orange-900">
            </div>
        @else
            <div
                class="rounded-full w-12  h-12 bg-orange-500 flex justify-center items-center  border-[2px] border-orange-900 text-orange-50 overflow-hidden cursor-pointer ">
                {{ $followed->name[0] }}
            </div>
        @endif

        <a href="{{ route('user.index', $followed) }}" class="font-bold">{{ $followed->name }}</a>

        <form action="{{ route('friend.destroy', $followed->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <x-btn-secondary>ne plus suivre</x-btn-secondary>
        </form>

    </div>

</div>
