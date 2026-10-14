### Установка

Добавить в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/price-list/src/resources/views/components/**/*.blade.php",
    "./vendor/4geo35/price-list/src/resources/views/admin/**/*.blade.php",
    "./vendor/4geo35/price-list/src/resources/views/livewire/admin/**/*.blade.php",

Добавить в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/price-list/src/resources/views/components/**/*.blade.php",
    "./vendor/4geo35/price-list/src/resources/views/web/**/*.blade.php",
    "./vendor/4geo35/price-list/src/resources/views/livewire/web/**/*.blade.php",
    "./vendor/4geo35/price-list/config/price-list.php",

Запустить миграции для создания таблиц `php artisan migrate`

#### Views

Сокращение для представлений: `pl`  
Меню для панели администрирования: `<x-pl::menu-item/>`

#### Config

Название файла: `price-list`

- `priceListPrefix` => `price-list`: адрес станицы
- `priceListPageTitle` => `Прайс-лист`: заголовок страницы
- `useBreadcrumbs` => `true`: выводить хлебные крошки на странице
- `useH1` => `true`: выводить h1
- `singlePage` => `false`: вывод всего дерева на одной странице. Если включить, то лучше поставить addToHeaderSize в значение 1
- `addToHeaderSize` => `2`: какого размера будут заголовки
- `useImages` => `false`: использовать изображения в таблице с ценами 
- `useTableHeader` => `true`: добавить заголовок к таблицам
- `tableListTitle` => `Наименование услуги`: заголовок у таблицы
- `tablePriceTitle` => `Цена`: заголовок у таблицы

#### Routes

Файл `admin.php`, `middleware(["web", "auth", "app-management"])`, `prefix(config("price-list.priceListPrefix"))`

- `admin.price-lists.index` => `admin/{prefix}`
- `admin.price-lists.show` => `admin/{prefix}/{category}`

Файл `web.php`, `middleware(["web"])`, `prefix(config("price-list.priceListPrefix"))`

- `web.price-lists.index` => `{prefix}`
- `web.price-lists.show` => `{prefix}/{category}`
