@props(["depth" => 0, "tree"])
<div>
    @foreach($tree as $treeItem)
        @php($model = $treeItem["model"])
        <div class="my-indent-half">
            @if ($depth > 0)
                @php($addToHeaderSize = config("price-list.addToHeaderSize"))
                @php($headerSize = $depth <= 3 ? $depth + $addToHeaderSize : 3 + $addToHeaderSize)
                @php($headerComponent = "tt::h" . $headerSize)
                @php($headerClass = $depth <= 2 ? "mb-indent" : "mb-indent-half")
                <x-dynamic-component :component="$headerComponent" class="{{ $headerClass }} pb-2 border-b border-stroke">
                    {{ $model->title }}
                </x-dynamic-component>
            @endif

            @include("pl::web.price-lists.includes.short", ["model" => $model])

            @foreach($treeItem["items"] as $key => $item)
                <x-pl::price-tree.item :$item :$key />
            @endforeach

            @include("pl::web.price-lists.includes.description", ["model" => $model])
            @include("pl::web.price-lists.includes.info", ["model" => $model])

            @if (count($treeItem["children"]))
                <x-pl::price-tree :depth="$depth + 1" :tree="$treeItem['children']" />
            @endif
        </div>
    @endforeach
</div>
