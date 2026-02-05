@props(["depth" => 0, "tree"])
<div>
    @foreach($tree as $treeItem)
        @php($model = $treeItem["model"])
        <div class="mb-indent-lg">
            @if ($depth > 0 || config("price-list.singlePage"))
                @php($addToHeaderSize = config("price-list.addToHeaderSize"))
                @php($headerSize = $depth <= 3 ? $depth + $addToHeaderSize : 3 + $addToHeaderSize)
                @php($headerComponent = "tt::h" . $headerSize)
                @php($headerClass = $depth <= 2 ? "mb-indent" : "mb-indent-half")
                <x-dynamic-component :component="$headerComponent"
                                     id="list-{{ $model->slug }}"
                                     class="{{ $headerClass }}">
                    {{ $model->title }}
                </x-dynamic-component>
            @endif

            @include("pl::web.price-lists.includes.short", ["model" => $model])

            @if(count($treeItem["items"]))
                @if (config('price-list.useImages'))
                    <div class="row mb-indent-half -mx-2">
                        @foreach($treeItem["items"] as $key => $item)
                            <x-pl::price-tree.image-item :$item />
                        @endforeach
                    </div>
                @else
                    <div class="border border-stroke rounded-base overflow-hidden mb-indent-half">
                        @include("pl::web.price-lists.includes.table-header")
                        @foreach($treeItem["items"] as $key => $item)
                            <x-pl::price-tree.item :$item :$key :is-last="$loop->last" />
                        @endforeach
                    </div>
                @endif
            @endif

            @include("pl::web.price-lists.includes.description", ["model" => $model])
            @include("pl::web.price-lists.includes.info", ["model" => $model])

            @if (count($treeItem["children"]))
                <x-pl::price-tree :depth="$depth + 1" :tree="$treeItem['children']" />
            @endif
        </div>
    @endforeach
</div>
