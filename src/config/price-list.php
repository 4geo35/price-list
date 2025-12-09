<?php

return [
    // Web
    "priceListPrefix" => "price-list",
    "priceListPageTitle" => "Прайс-лист",

    // Admin
    "customPriceListModel" => null,
    "customPriceListModelObserver" => null,

    "customPriceListItemModel" => null,
    "customPriceListItemModelObserver" => null,

    "customAdminPriceListController" => null,

    // Policy
    "priceListPolicyTitle" => "Управление прайс-листом",
    "priceListPolicy" => \GIS\PriceList\Policies\PriceListPolicy::class,
    "priceListPolicyKey" => "price_lists",
];
