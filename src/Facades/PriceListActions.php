<?php

namespace GIS\PriceList\Facades;

use GIS\PriceList\Helpers\PriceListActionsManager;
use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\TraitsHelpers\Interfaces\ShouldTreeInterface;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void cascadeShutdown(PriceListInterface $list)
 *
 * @method static array getCategoryTree(array $newOrder = null)
 * @method static bool rebuildTree(array $newOrder)
 *
 * @method static array buildNestedTree(ShouldTreeInterface $item = null)
 *
 * @method static ShouldTreeInterface findNestedChild(ShouldTreeInterface $item)
 * @method static ShouldTreeInterface|null findRootNested(ShouldTreeInterface $item)
 *
 * @method static array getElementIds(ShouldTreeInterface $list, bool $includeSubs = false)
 * @method static array getChildrenIds(ShouldTreeInterface $list, bool $includeSelf = false)
 * @method static array getParents(ShouldTreeInterface $list)
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
