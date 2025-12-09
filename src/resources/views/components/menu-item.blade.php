@can("viewAny", config("price-list.customPriceListModel") ?? \GIS\PriceList\Models\PriceList::class)
    <x-tt::admin-menu.item
        href="{{ route('admin.price-lists.index') }}"
        :active="in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.price-lists.index', 'admin.price-lists.show'])">
        <x-slot name="ico"><x-pl::ico.ruble /></x-slot>
        {{ config("price-list.priceListPageTitle") }}
    </x-tt::admin-menu.item>
@endcan
