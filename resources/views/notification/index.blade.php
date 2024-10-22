<x-app-layout class="flex justify-between">

    <h2 class="text-xl font-semibold mb-3">Notifications</h2>

    <div class="flex flex-col gap-5">
        @foreach ($notifications as $notification)
            <div class="border border-gray-600 rounded p-3">

                <p>{{ $notification->content }} <a class="font-extrabold italic underline"
                        href="{{ route('user.index', $notification->byUser->id) }}">
                        {{ $notification->byUser->name }}
                    </a></p>



            </div>
        @endforeach
    </div>
</x-app-layout>
