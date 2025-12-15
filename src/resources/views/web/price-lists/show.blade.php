<x-app-layout>
    @include("pl::web.price-lists.includes.show-metas")
    @include("pl::web.price-lists.includes.show-breadcrumbs")

    <div class="container">
        <div class="row">
            <div class="col w-1/3">
                <x-pl-tree-sidebar :$priceList :$parents />
            </div>
            <div class="col w-2/3">
                <x-tt::h1 class="mb-indent">{{ $priceList->title }}</x-tt::h1>

                @if ($renderPriceTree)
                    @include("pl::web.price-lists.includes.table-header")
                    <x-pl::price-tree :$tree />
                @else
                    @include("pl::web.price-lists.includes.children-list", ["children" => $tree])
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
