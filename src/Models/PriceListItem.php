<?php

namespace GIS\PriceList\Models;

use GIS\PriceList\Interfaces\PriceListItemInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceListItem extends Model implements PriceListItemInterface
{
    public function priceList(): BelongsTo
    {
        $priceListModelClass = config("price-list.customPriceListModel") ?? PriceList::class;
        return $this->belongsTo($priceListModelClass, 'price_list_id');
    }
}
