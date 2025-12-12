@if (config("price-list.useBreadcrumbs"))
    @php($homeUrl = Route::has("web.home") ? route("web.home") : "/")
    @php($indexUrl = route("web.price-lists.index"))
    <x-tt::breadcrumbs>
        <x-tt::breadcrumbs.item :url="$homeUrl">Главная</x-tt::breadcrumbs.item>
        <x-tt::breadcrumbs.item :url="$indexUrl">{{ config("price-list.priceListPageTitle") }}</x-tt::breadcrumbs.item>
        @foreach($parents as $parent)
            @php($parentUrl = route("web.price-lists.show", ["priceList" => $parent->slug]))
            <x-tt::breadcrumbs.item :url="$parentUrl">{{ $parent->title }}</x-tt::breadcrumbs.item>
        @endforeach
        <x-tt::breadcrumbs.item>{{ $priceList->title }}</x-tt::breadcrumbs.item>
    </x-tt::breadcrumbs>
@endif
