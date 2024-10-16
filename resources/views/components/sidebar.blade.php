@props(['users'])
<div class="basis-60 shrink-0 h-[calc(100vh-64px)] p-4 pt-0 flex flex-col gap-4">
    <div class="h-1/2 flex flex-col ">
        <p class="text-lg text-neutral-500 font-bold text-center mb-1">Connecté</p>
        <ul class="space-y-3 overflow-scroll  grow  p-3  bg-white dark:bg-slate-700 rounded-xl shadow-md ">
            @foreach ($users as $user)
                <li
                    class="flex items-center gap-3 hover:bg-slate-100 dark:hover:bg-slate-600 transition rounded-full p-1 cursor-pointer">
                    @if ($user->img_path)
                        <div>
                            <img src="{{ Storage::url($user->img_path) }}" alt="" width="200px" height="200px"
                                class="object-cover w-6 h-6 rounded-full border-[2px] border-orange-900">
                        </div>
                    @else
                        <div
                            class="rounded-full w-6  h-6 bg-blue-200 flex justify-center items-center  border-[2px] border-blue-500 text-orange-50 overflow-hidden cursor-pointer ">
                            {{ $user->name[0] }}
                        </div>
                    @endif
                    {{ $user->name }}
                </li>
            @endforeach
        </ul>
    </div>

    <div class="h-1/2 flex flex-col">
        <p class="text-lg text-neutral-500 font-bold text-center mb-1">Suggestion</p>
        <ul class="space-y-3 overflow-scroll  grow  p-3  bg-white dark:bg-slate-700 rounded-xl shadow-md ">
            @foreach ($users as $user)
                <li
                    class="flex items-center gap-3 hover:bg-slate-100 dark:hover:bg-slate-600 transition rounded-full p-1 cursor-pointer">
                    @if ($user->img_path)
                        <div>
                            <img src="{{ Storage::url($user->img_path) }}" alt="" width="200px" height="200px"
                                class="object-cover w-6 h-6 rounded-full border-[2px] border-orange-900">
                        </div>
                    @else
                        <div
                            class="rounded-full w-6  h-6 bg-blue-200 flex justify-center items-center  border-[2px] border-blue-500 text-orange-50 overflow-hidden cursor-pointer ">
                            {{ $user->name[0] }}
                        </div>
                    @endif
                    {{ $user->name }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
