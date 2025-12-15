@props(["item", "key"])
<div class="flex items-center justify-between p-indent-half rounded-base {{ $key % 2 ? '' : 'bg-secondary/15' }}">
    <div>
        <div class="text-lg">{{ $item->title }}</div>
        @if ($item->short)
            <div class="text-body/60">{{ $item->short }}</div>
        @endif
    </div>
    <div class="text-lg font-semibold">{{ $item->price }}</div>
</div>
