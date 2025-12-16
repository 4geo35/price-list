<?php

namespace GIS\PriceList\Templates;


use Intervention\Image\Interfaces\ImageInterface;
use Intervention\Image\Interfaces\ModifierInterface;

class TabletPriceTeaser implements ModifierInterface
{
    public function apply(ImageInterface $image): ImageInterface
    {
        return $image->cover(256, 230);
    }
}
