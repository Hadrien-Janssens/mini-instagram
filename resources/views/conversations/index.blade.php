<x-app-layout class="flex justify-between">
    <h2 class="text-xl font-semibold mb-3">Conversations</h2>

    <div class="flex flex-col gap-3  ">
        @foreach ($conversations as $conversation)
            <a href="{{ route('message.show', $conversation) }}">
                <div class="flex gap-2 border rounded items-center p-2 cursor-pointer hover:bg-slate-700 transition  ">
                    @if ($conversation->sender_id == Auth::user()->id)
                        <x-avatar :user='$conversation->receiver' :width='8' :linkMode="false"></x-avatar>
                        <div>
                            <p>{{ $conversation->receiver->name }}</p>
                            <p>le dernier message</p>
                        </div>
                    @else
                        <x-avatar :user='$conversation->sender' :width='8' :linkMode='false'></x-avatar>
                        <div>
                            <p>{{ $conversation->sender->name }}</p>
                            <p>le dernier message</p>
                        </div>
                    @endif

                </div>
            </a>
        @endforeach
    </div>

</x-app-layout>
