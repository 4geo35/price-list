@props(["item", "key", "isLast"])
<div class="row {{ $isLast ? '' : 'border-b border-stroke' }} {{ $key % 2 ? '' : 'bg-light' }}">
    <div class="col w-full md:w-2/3">
        <div class="mr-5 md:mr-0 ml-5 mt-indent-xs md:mb-indent-xs">
            <div class="text-lg">{{ $item->title }}</div>
            @if ($item->short)
                <div class="text-sm text-body/60 mt-indent-xs">{{ $item->short }}</div>
            @endif
        </div>
    </div>
    <div class="col w-full md:w-1/3">
        <div class="mr-5 md:mr-0 ml-5 my-indent-xs">
            <div class="text-lg font-semibold">{{ $item->price }}</div>
        </div>
    </div>
</div>
