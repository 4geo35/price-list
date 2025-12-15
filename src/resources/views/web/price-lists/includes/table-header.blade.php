@if (config("price-list.useTableHeader"))
    <div class="mb-indent flex items-center justify-between rounded-base bg-primary/25 font-semibold text-lg p-indent-half">
        <div>{{ config('price-list.tableListTitle') }}</div>
        <div>{{ config('price-list.tablePriceTitle') }}</div>
    </div>
@endif
