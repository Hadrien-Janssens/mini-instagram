@props(['users'])
<div class="basis-60 shrink-0 h-[calc(100vh-64px)] p-4 pt-0 flex flex-col gap-4">
    <div class="h-1/2 flex flex-col ">
        <p class="text-lg text-neutral-500 font-bold text-center mb-1">Connecté</p>
        <ul class="space-y-3 overflow-scroll  grow  pl-6 py-3  bg-white rounded-xl shadow-md ">
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
            <li>john Doe</li>
        </ul>
    </div>

    <div class="h-1/2 flex flex-col">
        <p class="text-lg text-neutral-500 font-bold text-center mb-1">Suggestion</p>
        <ul class="space-y-3 overflow-scroll  grow  pl-6 py-3  bg-white rounded-xl shadow-md ">
            @foreach ($users as $user)
                <li> {{ $user->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
