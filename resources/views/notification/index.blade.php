<x-app-layout class="flex justify-between">

    <h2 class="text-xl font-semibold mb-3">Notifications</h2>

    <div class="flex flex-col gap-5">
        @foreach ($notifications as $notification)
            <div class="border border-gray-400 rounded p-3 hover:bg-slate-200 dark:hover:bg-slate-700 transition">

                <a href="{{ $notification->link }}">

                    <p>{!! $notification->content !!}</p>
                </a>



            </div>
        @endforeach
    </div>
</x-app-layout>
