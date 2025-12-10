<?php

namespace GIS\PriceList\Models;

use GIS\Metable\Traits\ShouldMeta;
use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\TraitsHelpers\Traits\ShouldHumanDate;
use GIS\TraitsHelpers\Traits\ShouldHumanPublishDate;
use GIS\TraitsHelpers\Traits\ShouldMarkdown;
use GIS\TraitsHelpers\Traits\ShouldSlug;
use GIS\TraitsHelpers\Traits\ShouldTree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PriceList extends Model implements PriceListInterface
{
    use ShouldSlug, ShouldMeta, ShouldMarkdown, ShouldTree, ShouldHumanDate, ShouldHumanPublishDate;

    protected $fillable = [
        "title",
        "slug",
        "short",
        "accent",
        "description",
        "info",
        "show_nested",
        "published_at",
    ];

    public function items(): HasMany
    {
        $priceListItemModelClass = config("price-list.customPriceListItemModel") ?? PriceListItem::class;
        return $this->hasMany($priceListItemModelClass, "price_list_id");
    }

    public function getInfoMarkdownAttribute(): ?string
    {
        $value = $this->info;
        if (! $value) return $value;
        return Str::markdown($value);
    }
}
