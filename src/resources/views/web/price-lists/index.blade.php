<x-app-layout>
    @include("pl::web.price-lists.includes.metas")
    @include("pl::web.price-lists.includes.breadcrumbs")
    @include("pl::web.price-lists.includes.h1")

    <div class="container">
        <div class="row">
            <div class="col w-1/3">
                <x-pl-tree-sidebar />
            </div>
        </div>
    </div>
</x-app-layout>
