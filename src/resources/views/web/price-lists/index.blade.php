<x-app-layout>
    @include("pl::web.price-lists.includes.metas")
    @include("pl::web.price-lists.includes.breadcrumbs")
    @include("pl::web.price-lists.includes.h1")

    <div class="container">
        <div class="row">
            <div class="col w-full lg:w-1/3 order-last lg:order-first mb-indent">
                <div class="sticky {{ config('price-list.stickySidebarPosition') }}">
                    <x-pl-tree-sidebar />
                </div>
            </div>
            <div class="col w-full lg:w-2/3 mb-indent">
                @include("pl::web.price-lists.includes.table-header")
                <x-pl::price-tree :$tree />
            </div>
        </div>
    </div>
</x-app-layout>
