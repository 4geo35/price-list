<?php

use Illuminate\Support\Facades\Route;
use GIS\PriceList\Http\Controllers\Web\PriceListController;

Route::middleware(["web"])
    ->as("web.")
    ->group(function () {
        Route::prefix(config("price-list.priceListPrefix"))
            ->as("price-lists.")
            ->group(function () {
                $controllerClass = config("price-list.customWebPriceListController") ?? PriceListController::class;
                Route::get("/", [$controllerClass, "index"])->name("index");
                Route::get("/{priceList}", [$controllerClass, "show"])->name("show");
            });
    });
