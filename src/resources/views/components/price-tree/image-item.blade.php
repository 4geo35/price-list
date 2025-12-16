@props(["item"])
<div class="col w-full xs:w-1/2 md:w-1/3 lg:w-1/2 xl:w-1/3 2xl:w-1/4 mb-indent">
    <div class="h-full flex flex-col border border-stroke rounded-base overflow-hidden bg-white">
        <div class="shrink-0 block xs:h-[192px] sm:h-[230px] md:h-[192px] lg:h-[276px] xl:h-[225px] 2xl:h-[204px]">
            @if ($item->image)
                <picture>
                    <source media="(min-width: 1024px)"
                            srcset="{{ route('thumb-img', ['template' => "price-list-item-teaser", 'filename' => $item->image->file_name]) }}">
                    <source media="(min-width: 480px)"
                            srcset="{{ route('thumb-img', ['template' => "tablet-price-list-item-teaser", 'filename' => $item->image->file_name]) }}">
                    <img src="{{ route('thumb-img', ['template' => 'mobile-price-list-item-teaser', 'filename' => $item->image->file_name]) }}" alt="">
                </picture>
            @else
                @include("pl::web.price-lists.includes.empty")
            @endif
        </div>
        <div class="h-full p-indent-half flex flex-col justify-between">
            <div class="mb-indent-half leading-tight">
                <div class="text">{{ $item->title }}</div>
                @if ($item->short)
                    <div class="text-body/60">{{ $item->short }}</div>
                @endif
            </div>
            <div class="text-lg font-semibold">{{ $item->price }}</div>
        </div>
    </div>
</div>
