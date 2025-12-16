@props(["item", "key"])
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pt-indent-half px-indent-half rounded-base {{ $key % 2 ? '' : 'bg-secondary/15' }}">
    <div class="sm:mb-indent-half mr-indent-half">
        <div class="text-lg">{{ $item->title }}</div>
        @if ($item->short)
            <div class="text-body/60">{{ $item->short }}</div>
        @endif
    </div>
    <div class="text-lg font-semibold mb-indent-half">{{ $item->price }}</div>
</div>
