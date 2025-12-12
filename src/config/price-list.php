<?php

return [
    // Web
    "priceListPrefix" => "price-list",
    "priceListPageTitle" => "Прайс-лист",
    "useBreadcrumbs" => true,
    "useH1" => true,
    "singlePage" => false,
    "useImages" => false,

    "customWebPriceListController" => null,

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
    "customAdminPriceListShowComponent" => null,

    // Blade components
    "customWebTreeSidebarComponent" => null,

    // Policy
    "priceListPolicyTitle" => "Управление прайс-листом",
    "priceListPolicy" => \GIS\PriceList\Policies\PriceListPolicy::class,
    "priceListPolicyKey" => "price_lists",
];
