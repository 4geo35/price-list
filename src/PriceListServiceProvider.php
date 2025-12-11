<?php

namespace GIS\PriceList;

use GIS\PriceList\Helpers\PriceListActionsManager;
use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\PriceList\Interfaces\PriceListItemInterface;
use GIS\PriceList\Models\PriceList;
use GIS\PriceList\Models\PriceListItem;
use GIS\PriceList\Observers\PriceListItemObserver;
use GIS\PriceList\Observers\PriceListObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use GIS\PriceList\Livewire\Admin\PriceLists\ListWire as AdminPriceListsListWire;
use GIS\PriceList\Livewire\Admin\PriceLists\ShowWire as AdminPriceListShowWire;
use GIS\PriceList\Livewire\Admin\PriceListItems\ListWire as AdminPriceListItemsListWire;

class PriceListServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->mergeConfigFrom(
            __DIR__ . '/config/price-list.php', 'price-list'
        );

        $this->loadRoutesFrom(__DIR__ . '/routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->initFacades();
        $this->bindInterfaces();
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'pl');

        $this->addLivewireComponents();

        $this->expandConfiguration();
        $this->observeModels();
        $this->setPolicies();
    }

    protected function expandConfiguration(): void
    {
        $pl = app()->config["price-list"];

        $um = app()->config["user-management"];
        $permissions = $um["permissions"];
        $permissions[] = [
            "title" => $pl["priceListPolicyTitle"],
            "key" => $pl["priceListPolicyKey"],
            "policy" => $pl["priceListPolicy"],
        ];
        app()->config["user-management.permissions"] = $permissions;
    }

    protected function bindInterfaces(): void
    {
        $priceListModelClass = config("price-list.customPriceListModel") ?? PriceList::class;
        $this->app->bind(PriceListInterface::class, $priceListModelClass);

        $priceListItemModelClass = config("price-list.customPriceListItemModel") ?? PriceListItem::class;
        $this->app->bind(PriceListItemInterface::class, $priceListItemModelClass);
    }

    protected function addLivewireComponents(): void
    {
        $component = config("price-list.customAminPriceListsListComponent");
        Livewire::component(
            "pl-admin-price-lists-list",
            $component ?? AdminPriceListsListWire::class
        );

        $component = config("price-list.customAdminPriceListShowComponent");
        Livewire::component(
            "pl-admin-price-list-show",
            $component ?? AdminPriceListShowWire::class
        );

        $component = config("price-list.customPriceListItemsListComponent");
        Livewire::component(
            "pl-admin-price-list-items",
            $component ?? AdminPriceListItemsListWire::class
        );
    }

    protected function initFacades(): void
    {
        $this->app->singleton("price-list-actions", function () {
            $managerClass = config("price-list.customPriceListActionsManager") ?? PriceListActionsManager::class;
            return new $managerClass();
        });
    }

    protected function observeModels(): void
    {
        $modelClass = config("price-list.customPriceListModel") ?? PriceList::class;
        $observerClass = config("price-list.customPriceListObserver") ?? PriceListObserver::class;
        $modelClass::observe($observerClass);

        $modelClass = config("price-list.customPriceListItemModel") ?? PriceListItem::class;
        $observerClass = config("price-list.customPriceListItemModelObserver") ?? PriceListItemObserver::class;
        $modelClass::observe($observerClass);
    }

    protected function setPolicies(): void
    {
        Gate::policy(config("price-list.customPriceListModel") ?? PriceList::class, config("price-list.priceListPolicy"));
    }
}
