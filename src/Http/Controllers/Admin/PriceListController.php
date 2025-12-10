<?php

namespace GIS\PriceList\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\PriceList\Models\PriceList;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PriceListController extends Controller
{
    public function index(): View
    {
        $priceListModelClass = config("price-list.customPriceListModel") ?? PriceList::class;
        Gate::authorize("viewAny", $priceListModelClass);
        return view("pl::admin.price-lists.index");
    }

    public function show(PriceListInterface $category): View
    {
        $priceListModelClass = config("price-list.customPriceListModel") ?? PriceList::class;
        Gate::authorize("viewAny", $priceListModelClass);
        $list = $category;
        return view("pl::admin.price-lists.show", compact("list"));
    }
}
