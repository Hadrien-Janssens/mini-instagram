<x-app-layout class="flex justify-between">
    <h2 class="text-xl font-semibold mb-3">Conversations</h2>

    <div class="flex flex-col gap-3  ">
        @foreach ($conversations as $conversation)
            @if ($conversation->sender_id == Auth::user()->id)
                <div class="flex gap-2 border rounded items-center p-2 cursor-pointer hover:bg-slate-700 transition  ">
                    <x-avatar :user="$conversation->receiver" :width="8" />
                    <div>
                        <p>{{ $conversation->receiver->name }}</p>
                        <p>le dernier message</p>
                    </div>
                </div>
            @else
                <div class="flex gap-2 border rounded items-center p-2 cursor-pointer hover:bg-slate-700 transition">
                    <x-avatar :user="$conversation->receiver" :width="8" />
                    <div>
                        <p>{{ $conversation->sender->name }}</p>
                        <p>le dernier message</p>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
</x-app-layout>
