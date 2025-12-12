<x-app-layout>
    @include("pl::web.price-lists.includes.show-metas")
    @include("pl::web.price-lists.includes.show-breadcrumbs")

    <div class="container">
        <div class="row">
            <div class="col w-1/3">
                <x-pl-tree-sidebar :$priceList :$parents />
            </div>
        </div>
    </div>
</x-app-layout>
