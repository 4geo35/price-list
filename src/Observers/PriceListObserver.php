<?php

namespace GIS\PriceList\Observers;

use GIS\PriceList\Facades\PriceListActions;
use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\PriceList\Models\PriceList;

class PriceListObserver
{
    public function creating(PriceListInterface $priceList): void
    {
        $parentId = $priceList->parent_id;
        $listModelClass = config("price-list.customPriceListModel") ?? PriceList::class;
        $priority = $listModelClass::query()
            ->select("id", "priority")
            ->where("parent_id", $parentId)
            ->max("priority");
        if (empty($priority)) { $priority = 0; }
        $priceList->priority = $priority + 1;
    }

    public function updated(PriceListInterface $priceList): void
    {
        if ($priceList->wasChanged("published_at")) {
            if (! $priceList->published_at) { PriceListActions::cascadeShutdown($priceList); }
        }

        if ($priceList->wasChanged("parent_id")) {
            $parent = $priceList->parent;
            if ($parent && ! $parent->published_at) {
                $priceList->published_at = null;
                $priceList->saveQuietly();
                PriceListActions::cascadeShutdown($priceList);
            }
        }
    }
}
