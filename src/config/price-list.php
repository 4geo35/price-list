<?php

return [
    // Web
    "priceListPrefix" => "price-list",
    "priceListPageTitle" => "Прайс-лист",
    "useBreadcrumbs" => true,
    "useH1" => true,
    "singlePage" => false, // Если включить, то лучше поставить addToHeaderSize в значение 1
    "useImages" => false,
    "useTableHeader" => true,
    "tableListTitle" => "Наименование услуги",
    "tablePriceTitle" => "Цена",
    "addToHeaderSize" => 2,
    "stickySidebarPosition" => "top-0",

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

    // Templates
    "templates" => [
        "price-list-item-teaser" => \GIS\PriceList\Templates\PriceTeaser::class,
        "tablet-price-list-item-teaser" => \GIS\PriceList\Templates\TabletPriceTeaser::class,
        "mobile-price-list-item-teaser" => \GIS\PriceList\Templates\MobilePriceTeaser::class,
    ]
];
