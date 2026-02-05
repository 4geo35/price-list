@props(["children"])

@include("pl::web.price-lists.includes.short", ["model" => $priceList])

<div class="row mb-indent-lg">
    @foreach($children as $child)
        <div class="col w-full md:w-1/2 lg:w-full xl:w-1/2 mb-indent-sm">
            <a href="{{ route('web.price-lists.show', ['priceList' => $child]) }}"
               class="h-full flex items-center justify-center text-center p-indent-xs border border-primary rounded-base font-medium text-sm text-primary hover:bg-primary hover:text-white transition-colors">
                {{ $child->title }}
            </a>
        </div>
    @endforeach
</div>

@include("pl::web.price-lists.includes.description", ["model" => $priceList])
@include("pl::web.price-lists.includes.info", ["model" => $priceList])
