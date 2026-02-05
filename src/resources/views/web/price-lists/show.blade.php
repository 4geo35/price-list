<x-app-layout>
    @include("pl::web.price-lists.includes.show-metas")
    @include("pl::web.price-lists.includes.show-breadcrumbs")

    <div class="container">
        <div class="row">
            <div class="col w-full lg:w-1/3 order-last lg:order-first mb-indent">
                <x-pl-tree-sidebar :$priceList :$parents />
            </div>
            <div class="col w-full lg:w-2/3 mb-indent">
                <x-tt::h1 class="mb-indent">{{ $priceList->title }}</x-tt::h1>

                @if ($renderPriceTree)
                    <x-pl::price-tree :$tree />
                @else
                    @include("pl::web.price-lists.includes.children-list", ["children" => $tree])
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
