<?php

namespace GIS\PriceList\Livewire\Admin\PriceLists;

use GIS\PriceList\Facades\PriceListActions;
use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\PriceList\Models\PriceList;
use GIS\PriceList\Traits\PriceListEditActions;
use GIS\TraitsHelpers\Interfaces\WireTreeInterface;
use GIS\TraitsHelpers\Interfaces\WireTreePublishInterface;
use Illuminate\View\View;
use Livewire\Component;

class ListWire extends Component implements WireTreeInterface, WireTreePublishInterface
{
    use PriceListEditActions;

    public array|null $tmpTree = null;

    public function render(): View
    {
        $tree = PriceListActions::getCategoryTree($this->tmpTree);
        $this->dispatch("re-init-script");
        return view("pl::livewire.admin.price-lists.list-wire", compact("tree"));
    }

    public function showCreate(int $parentId = null): void
    {
        $this->resetFields();
        if (! $this->checkAuth("create")) { return; }

        $this->parentId = $parentId;
        $this->displayData = true;
    }

    public function store(): void
    {
        if (! $this->checkAuth("create")) { return; }
        if ($this->parentId) {
            $parent = $this->findModel($this->parentId);
            if (! $parent) { return; }
        }
        $this->validate();
        $data = [
            "title" => $this->title,
            "slug" => $this->slug,
            "short" => $this->short,
            "accent" => $this->accent,
            "description" => $this->description,
            "info" => $this->info,
            "show_nested" => $this->showNested ? now() : null,
        ];
        if ($this->parentId) {
            $priceList = $parent->children()->create($data);
        } else {
            $priceListModelClass = config("price-list.customPriceListModel") ?? PriceList::class;
            $priceList = $priceListModelClass::create($data);
        }
        /**
         * @var PriceListInterface $priceList
         */
        session()->flash("success", "Прайс-лист успешно добавлен");
        $this->closeData();
    }

    public function tmpOrder(array $tree): void
    {
        $this->tmpTree = $tree;
        $this->dispatch("change-tree");
    }

    public function updateOrder(): void
    {
        if (! $this->checkAuth("order")) { return; }
        $result = PriceListActions::rebuildTree($this->tmpTree);
        $this->tmpTree = null;
        if ($result) { session()->flash("success", "Дерево прайс-листов изменено"); }
        else { session()->flash("error", "Ошибка при обновлении дерева"); }
    }
}
