@if (config("price-list.useTableHeader"))
    <div class="row hidden md:flex text-white text-lg font-semibold border-b border-stroke bg-body">
        <div class="col w-full md:w-2/3">
            <div class="ml-5 my-indent-xs">
                {{ config('price-list.tableListTitle') }}
            </div>
        </div>
        <div class="col w-full md:w-1/3">
            <div class="ml-5 my-indent-xs">
                {{ config('price-list.tablePriceTitle') }}
            </div>
        </div>
    </div>
@endif
