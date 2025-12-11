<x-admin-layout>
    <x-slot name="title">Цены прайс-листа</x-slot>
    <x-slot name="pageTitle">Цены прайс-листа</x-slot>

    <div class="space-y-indent">
        <livewire:pl-admin-price-list-show :$priceList />
        <livewire:pl-admin-price-list-items :$priceList />
        <livewire:ma-metas :model="$priceList" />
    </div>
</x-admin-layout>
