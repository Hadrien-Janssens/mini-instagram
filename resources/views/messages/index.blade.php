<x-app-layout>
    <div class="flex flex-col justify-between gap-5 h-full pb-10 ">
        <div class="flex flex-col gap-5 border rounded-lg p-5 grow overflow-scroll no-scrollbar">
            @foreach ($messages as $message)
                @if ($message->sender_id == Auth::id())
                    <div
                        class="bg-white  p-2 w-2/3 grow-0 rounded-md rounded-bl-none dark:bg-slate-700  text-neutral-900 dark:text-slate-300 shadow">
                        <p>{{ $message->content }}</p>
                    </div>
                @else
                    <div
                        class="bg-blue-500 dark:bg-blue-600 text-white p-2 w-2/3 grow-0 rounded-md self-end rounded-br-none">
                        <p>{{ $message->content }}</p>
                    </div>
                @endif
            @endforeach
            <div></div>
        </div>
        <div class="border rounded-lg p-5 ">
            <form action="{{ route('message.store') }}" class=" flex flex-col grow gap-3 ">
                @csrf
                @method('POST')
                <div class=" flex w-full gap-3 dark:bg-slate-700 p-3 rounded-lg  bg-white shadow-md">
                    <input type="text" name="message"
                        class="grow dark:bg-slate-800  text-neutral-900 dark:text-slate-300 border-none rounded-md">
                    <x-btn-secondary>Envoyer</x-btn-secondary>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
