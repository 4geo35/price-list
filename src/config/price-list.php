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

    // Facades
    "customPriceListActionsManager" => null,

    // Components
    "customAminPriceListsListComponent" => null,

    // Policy
    "priceListPolicyTitle" => "Управление прайс-листом",
    "priceListPolicy" => \GIS\PriceList\Policies\PriceListPolicy::class,
    "priceListPolicyKey" => "price_lists",
];
