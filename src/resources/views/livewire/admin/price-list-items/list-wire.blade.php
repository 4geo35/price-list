<div>
    <div class="card">
        <div class="card-header border-b-0">
            <div class="space-y-indent-half">
                @include("pl::admin.price-list-items.includes.list-title")
                <x-tt::notifications.error prefix="item-" />
                <x-tt::notifications.success prefix="item-" />
            </div>
        </div>
        @include("pl::admin.price-list-items.includes.table")
        @include("pl::admin.price-list-items.includes.table-modals")
        @include("pl::admin.price-list-items.includes.order-modal")
    </div>
</div>
