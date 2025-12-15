<?php

namespace GIS\PriceList\Facades;

use GIS\PriceList\Helpers\PriceListActionsManager;
use GIS\PriceList\Interfaces\PriceListInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array buildPriceTree(PriceListInterface $priceList = null)
 *
 * @method static PriceListInterface findNestedChild(PriceListInterface $priceList)
 * @method static PriceListInterface|null findRootNested(PriceListInterface $priceList)
 *
 * @method static array getCategoryTree(array $newOrder = null)
 * @method static bool rebuildTree(array $newOrder)
 *
 * @method static void cascadeShutdown(PriceListInterface $list)
 *
 * @method static array getPriceListItemIds(PriceListInterface $list, bool $includeSubs = false)
 * @method static array getChildrenIds(PriceListInterface $list, bool $includeSelf = false)
 *
 * @method static array getParents(PriceListInterface $list)
 *
 * @see PriceListActionsManager
 */
class PriceListActions extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "price-list-actions";
    }
}
