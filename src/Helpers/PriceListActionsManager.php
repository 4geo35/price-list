<?php

namespace GIS\PriceList\Helpers;

use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\PriceList\Models\PriceList;
use GIS\PriceList\Models\PriceListItem;
use GIS\TraitsHelpers\Interfaces\ShouldTreeInterface;
use GIS\TraitsHelpers\Traits\ManagerTreeTrait;

class PriceListActionsManager
{
    use ManagerTreeTrait;

    public function __construct()
    {
        $this->modelClass = config("price-list.customPriceListModel") ?? PriceList::class;
        $this->hasImage = false;
    }

    public function findNestedChild(PriceListInterface $priceList): PriceListInterface
    {
        $firstChild = $priceList->children()->whereNotNull("published_at")->orderBy("priority")->first();
        if (! $firstChild) { return $priceList; }
        if ($firstChild->show_nested) { return $firstChild; }
        return $this->findNestedChild($firstChild);
    }

    public function findRootNested(PriceListInterface $priceList): ?PriceListInterface
    {
        $parent = $priceList->parent;
        if (! $parent) { return null; }
        $check = $this->findRootNested($parent);
        if (! $parent->show_nested && ! $check) { return null; }
        if (! $check) { return $parent; }
        return $check;
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

    public function getPriceListItemIds(PriceListInterface $list, bool $includeSubs = false): array
    {
        $itemModelClass = config("price-list.customPriceListItemModel") ?? PriceListItem::class;
        $query = $itemModelClass::query()
            ->select("id")
            ->whereNotNull("published_at");
        if ($includeSubs) {
            $query->whereIn("price_list_id", $this->getChildrenIds($list, true));
        } else {
            $query->where("price_list_id", $list->id);
        }
        $items = $query->get();
        $iIds = [];
        foreach ($items as $item) {
            $iIds[] = $item->id;
        }
        return $iIds;
    }

    public function getChildrenIds(PriceListInterface $list, bool $includeSelf = false): array
    {
        $ids = [];
        if ($includeSelf) { $ids[] = $list->id; }
        $children = $list->children()->select('id')->whereNotNull("published_at")->get();
        foreach ($children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getChildrenIds($child));
        }
        return array_unique($ids);
    }

    public function getParents(PriceListInterface $list): array
    {
        $result = [];
        if ($list->parent) {
            $result[] = (object) [
                "id" => $list->parent->id,
                "slug" => $list->parent->slug,
                "title" => $list->parent->title,
            ];
            $result = array_merge($this->getParents($list->parent), $result);
        }
        return $result;
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
}
