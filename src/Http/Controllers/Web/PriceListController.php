<?php

namespace GIS\PriceList\Http\Controllers\Web;

use GIS\Metable\Facades\MetaActions;
use GIS\PriceList\Facades\PriceListActions;
use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\PriceList\Models\PriceList;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PriceListController
{
    public function index(): RedirectResponse|View
    {
        if (config("price-list.singlePage")) {
            $metas = MetaActions::renderByPage(config("price-list.priceListPrefix"));

            $tree = PriceListActions::buildPriceTree();
            debugbar()->info($tree);
            return view("pl::web.price-lists.index", compact("metas", "tree"));
        } else {
            $modelClass = config("price-list.customPriceListModel") ?? PriceList::class;
            $priceList = $modelClass::query()
                ->whereNull("parent_id")
                ->whereNotNull("published_at")
                ->orderBy("priority")
                ->firstOrFail();

            if (! $priceList->show_nested) {
                $nestedChild = PriceListActions::findNestedChild($priceList);
                if ($nestedChild !== $priceList->id) { $priceList = $nestedChild; }
            }

            return redirect()->route("web.price-lists.show", compact("priceList"));
        }
    }

    public function show(PriceListInterface $priceList): RedirectResponse|View
    {
        if (! $priceList->published_at) { abort(404); }
        if (config("price-list.singlePage")) {
            return redirect()->route("web.price-lists.index", [], 301);
        }

        $rootNested = PriceListActions::findRootNested($priceList);
        if ($rootNested) {
            return redirect()->route("web.price-lists.show", ["priceList" => $rootNested]);
        }

        $metas = MetaActions::renderByModel($priceList);
        $parents = PriceListActions::getParents($priceList);

        $renderPriceTree = $priceList->show_nested || !$priceList->children()->select("id")->count();

        if ($renderPriceTree) { $tree = PriceListActions::buildPriceTree($priceList); }
        else { $tree = $priceList->children()->select("id", "title", "slug")->get(); }

        return view("pl::web.price-lists.show", compact("priceList", "metas", "parents", "tree", "renderPriceTree"));
    }
}
