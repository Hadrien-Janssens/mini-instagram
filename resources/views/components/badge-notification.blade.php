@if (isset($notificationsNotSeen) && $notificationsNotSeen !== 0)
    <div
        {{ $attributes->merge(['class' => 'absolute rounded-full bg-red-500 text-white w-4 h-4 flex justify-center items-center']) }}>
        <p class="text-xs font-extrabold">{{ $notificationsNotSeen }}</p>
    </div>
@endif
