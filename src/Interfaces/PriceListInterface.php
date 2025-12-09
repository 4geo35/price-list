<?php

namespace GIS\PriceList\Interfaces;

use ArrayAccess;
use GIS\Metable\Interfaces\ShouldMetaInterface;
use GIS\TraitsHelpers\Interfaces\ShouldTreeInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JsonSerializable;
use Stringable;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;
use Illuminate\Contracts\Support\Jsonable;

interface PriceListInterface extends Arrayable, ArrayAccess, CanBeEscapedWhenCastToString,
    HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, Stringable, UrlRoutable, ShouldMetaInterface, ShouldTreeInterface
{
    public function parent(): BelongsTo;
    public function children(): HasMany;
    public function items(): HasMany;
}
