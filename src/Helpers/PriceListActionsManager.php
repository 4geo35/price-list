<?php

namespace GIS\PriceList\Helpers;

use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\PriceList\Models\PriceList;
use GIS\PriceList\Models\PriceListItem;
use GIS\TraitsHelpers\Interfaces\ShouldTreeInterface;
use GIS\TraitsHelpers\Traits\ManagerTreeTrait;
use GIS\TraitsHelpers\Traits\ManagerTreeWithNestedTrait;
use Illuminate\Database\Eloquent\Builder;

class PriceListActionsManager
{
    use ManagerTreeTrait, ManagerTreeWithNestedTrait;

    public function __construct()
    {
        $this->modelClass = config("price-list.customPriceListModel") ?? PriceList::class;
        $this->hasImage = false;
        $this->elementModelClass = config("price-list.customPriceListItemModel") ?? PriceListItem::class;
        $this->elementRelationCol = "price_list_id";
    }

    public function cascadeShutdown(PriceListInterface $list): void
    {
        foreach ($list->children as $child) {
            if (! $child->published_at) { continue; }
            $child->update([
                "published_at" => null,
            ]);
        }
    }

    protected function expandItemData(&$data, ShouldTreeInterface $category): void
    {
        $data["published_at"] = $category->published_at ?? null;
        $showNested = (bool)$category->show_nested;
        $data["show_nested"] = $showNested;
        $data["webTitle"] = $data["title"];
        if ($showNested) {
            $data["title"] .= " (Раскрыто)";
        }
    }

    protected function expandRawDataQueryWith(Builder $query, ShouldTreeInterface $item = null): void
    {
        $query->with(["items" => function ($query) {
            if (config("price-list.useImages")) {
                $query->with("image");
            }
            $query->orderBy("priority");
        }]);
    }

    protected function expandNestedData(array &$data, ShouldTreeInterface $item): void
    {
        $data["items"] = $item->items;
    }
}
