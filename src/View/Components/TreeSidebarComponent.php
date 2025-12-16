<?php

namespace GIS\PriceList\View\Components;

use GIS\PriceList\Facades\PriceListActions;
use GIS\PriceList\Interfaces\PriceListInterface;
use Illuminate\View\Component;
use Illuminate\View\View;
class TreeSidebarComponent extends Component
{
    public array $parentIds = [];
    public bool $useAnchors = false;

    public function __construct(
        public array $parents = [],
        public PriceListInterface|null $priceList = null
    ){
        $array = [];
        if ($this->priceList) {
            $array[] = $this->priceList->id;
        }
        foreach ($this->parents as $parent) {
            $array[] = $parent->id;
        }
        $this->parentIds = array_unique($array);
        $this->useAnchors = config("price-list.singlePage");
    }

    public function render(): View
    {
        $tree = $this->makeTree();
        return view("pl::web.price-lists.components.tree-sidebar.index", compact("tree"));
    }

    protected function makeTree(): array
    {
        $rawTree = PriceListActions::getCategoryTree();
        return $this->checkTree($rawTree);
    }

    protected function checkTree(array &$tree): array
    {
        foreach ($tree as $key => &$item) {
            if (!$item["published_at"]) {
                unset($tree[$key]);
            }
            if ($item["show_nested"] && ! config("price-list.singlePage")) {
                $item["children"] = [];
            } else {
                $item["children"] = $this->checkTree($item["children"]);
            }
            $item["hasChildren"] = count($item["children"]) > 0;
            $item["expanded"] = in_array($item["id"], $this->parentIds);
            $item["isActive"] = $item["id"] == $this->priceList->id;
        }
        return $tree;
    }
}
