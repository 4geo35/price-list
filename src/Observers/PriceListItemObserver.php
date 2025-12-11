<?php

namespace GIS\PriceList\Observers;

use GIS\PriceList\Interfaces\PriceListItemInterface;
use GIS\PriceList\Models\PriceListItem;

class PriceListItemObserver
{
    public function creating(PriceListItemInterface $item): void
    {
        $itemModelClass = config("price-list.customPriceListItemModel") ?? PriceListItem::class;
        $priority = $itemModelClass::query()
            ->select("id", "priority")
            ->where("price_list_id", $item->priceList->id)
            ->max("priority");
        if (empty($priority)) { $priority = 0; }
        $item->priority = $priority + 1;
    }
}
