@props(["item", "key", "isLast"])
<div class="row {{ $isLast ? '' : 'border-b border-stroke' }} {{ $key % 2 ? '' : 'bg-light' }}">
    <div class="col w-full md:w-2/3">
        <div class="ml-5 my-indent-xs">
            <div class="text-lg">{{ $item->title }}</div>
            @if ($item->short)
                <div class="text-sm text-body/60 mt-indent-xs">{{ $item->short }}</div>
            @endif
        </div>
    </div>
    <div class="col w-full md:w-1/3">
        <div class="ml-5 my-indent-xs">
            <div class="text-lg font-semibold">{{ $item->price }}</div>
        </div>
    </div>
</div>
{{--
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-indent-half px-indent-half rounded-base {{ $key % 2 ? '' : 'bg-secondary/15' }}">
    <div class="sm:mb-indent-half mr-indent-half">
        <div class="text-lg">{{ $item->title }}</div>
        @if ($item->short)
            <div class="text-body/60">{{ $item->short }}</div>
        @endif
    </div>
    <div class="text-lg font-semibold mb-indent-half">{{ $item->price }}</div>
</div>
--}}
