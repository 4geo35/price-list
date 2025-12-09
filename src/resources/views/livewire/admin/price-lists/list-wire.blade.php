<div>
    @php($priceListModelClass = config("price-list.customPriceListModel") ?? \GIS\PriceList\Models\PriceList::class)
    <div class="card">
        <div class="card-body">
            <div class="space-y-indent-half mb-indent">
                <div class="flex justify-between items-center">
                    @can("create", $priceListModelClass)
                        <button type="button" class="btn btn-primary" wire:click="showCreate">
                            <x-tt::ico.circle-plus />
                            <span class="pl-btn-ico-text">Добавить <span class="hidden sm:inline">корневой прайс-лист</span></span>
                        </button>
                    @endcan
                    @can("order", $priceListModelClass)
                        @if ($tmpTree)
                            <button type="button" class="btn btn-outline-primary" wire:click="updateOrder">
                                Сохранить порядок
                            </button>
                        @endif
                    @endcan
                </div>
                <x-tt::notifications.error />
                <x-tt::notifications.success />
            </div>
            <div class="overflow-x-auto beautify-scrollbar" drag-category-root>
                @include("tt::admin.draggable-tree", ["tree" => $tree, "showUrl" => "admin.price-lists.show"])
            </div>
        </div>
    </div>
    @include("pl::admin.price-lists.includes.modals")
</div>
