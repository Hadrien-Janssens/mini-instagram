@props(['user', 'width'])

<a href="{{ route('user.index', $user) }}">
    @if ($user->img_path)
        <div>
            <img src="{{ Storage::url($user->img_path) }}" alt="" width="200px" height="200px"
                class="object-cover w-{{ $width }} h-{{ $width }} rounded-full border-[2px] border-orange-900">
        </div>
    @else
        <div
            class="rounded-full w-{{ $width }}  h-{{ $width }} bg-orange-500 flex justify-center items-center  border-[2px] border-orange-900 text-orange-50 overflow-hidden cursor-pointer ">

            {{ $user->name[0] }}
        </div>
    @endif
</a>
