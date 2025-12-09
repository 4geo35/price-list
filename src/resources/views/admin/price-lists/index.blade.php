<x-admin-layout>
    <x-slot name="title">{{ config("price-list.priceListPageTitle") }}</x-slot>
    <x-slot name="pageTitle">{{ config("price-list.priceListPageTitle") }}</x-slot>

    <livewire:pl-admin-price-lists-list />

    @include("tt::admin.draggable-tree-script")
</x-admin-layout>
