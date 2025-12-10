<?php

namespace GIS\PriceList\Livewire\Admin\PriceLists;

use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\PriceList\Traits\PriceListEditActions;
use Illuminate\View\View;
use Livewire\Component;

class ShowWire extends Component
{
    use PriceListEditActions;

    public PriceListInterface $priceList;

    public function render(): View
    {
        return view("pl::livewire.admin.price-lists.show-wire");
    }
}
