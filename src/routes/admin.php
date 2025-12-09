<?php

use Illuminate\Support\Facades\Route;
use GIS\PriceList\Http\Controllers\Admin\PriceListController;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix(config("price-list.priceListPrefix"))
            ->as("price-lists.")
            ->group(function () {
                $controllerClass = config("price-list.customAdminPriceListController") ?? PriceListController::class;
                Route::get("/", [$controllerClass, "index"])->name("index");
                Route::get("/{list}", [$controllerClass, "show"])->name("show");
            });
    });
