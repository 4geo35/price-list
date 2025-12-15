@props(["children"])

@include("pl::web.price-lists.includes.short", ["model" => $priceList])

<div class="row">
    @foreach($children as $child)
        <div class="col w-1/2 mb-indent">
            <a href="{{ route('web.price-lists.show', ['priceList' => $child]) }}"
               class="h-full flex items-center justify-center text-center p-indent-half border border-primary rounded-base bg-primary/20 hover:bg-primary/30 font-semibold text-lg">
                {{ $child->title }}
            </a>
        </div>
    @endforeach
</div>

@include("pl::web.price-lists.includes.description", ["model" => $priceList])
@include("pl::web.price-lists.includes.info", ["model" => $priceList])
