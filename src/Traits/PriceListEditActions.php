<?php

namespace GIS\PriceList\Traits;

use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\PriceList\Models\PriceList;
use Illuminate\Auth\Access\AuthorizationException;

trait PriceListEditActions
{
    public bool $displayDelete = false;
    public bool $displayData = false;

    public int|null $priceListId = null;
    public int|null $parentId = null;

    public string $title = "";
    public string $slug = "";
    public string $short = "";
    public string $description = "";
    public string $accent = "";
    public string $info = "";
    public bool $showNested = false;

    public function rules(): array
    {
        $uniqueCondition = "unique:price_lists,slug";
        if ($this->priceListId) { $uniqueCondition .= ",{$this->priceListId}"; }
        return [
            "title" => ["required", "string", "max:250"],
            "slug" => ["nullable", "string", "max:250", $uniqueCondition],
            "short" => ["nullable", "string", "max:250"],
            "accent" => ["nullable", "string", "max:250"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "title" => "Заголовок",
            "slug" => "Адресная строка",
            "short" => "Краткое описание",
            "accent" => "Акцент",
        ];
    }

    public function closeData(): void
    {
        $this->displayData = false;
        $this->resetFields();
    }

    public function showEdit(int $id): void
    {
        $this->priceListId = $id;
        $priceList = $this->findModel();
        if (! $priceList) { return; }
        if (! $this->checkAuth("update", $priceList)) { return; }

        $this->displayData = true;
        $this->title = $priceList->title;
        $this->slug = $priceList->slug;
        $this->short = $priceList->short;
        $this->description = $priceList->description;
        $this->accent = $priceList->accent;
        $this->info = $priceList->info;
        $this->showNested = (bool) $priceList->show_nested;
    }

    public function update(): void
    {
        $priceList = $this->findModel();
        if (! $priceList) { return; }
        if (! $this->checkAuth("update", $priceList)) { return; }
        $this->validate();

        $slugHasChanged = $this->slug !== $priceList->slug;

        $priceList->update([
            "title" => $this->title,
            "slug" => $this->slug,
            "short" => $this->short,
            "accent" => $this->accent,
            "description" => $this->description,
            "info" => $this->info,
            "show_nested" => $this->showNested ? now() : null,
        ]);
        session()->flash("success", "Прайс-лист успешно обновлен");
        $this->closeData();
        if (isset($this->priceList)) {
            $this->priceList = $priceList;
            if ($slugHasChanged) {
                $this->redirectRoute("admin.price-lists.show", ["category" => $this->priceList]);
            }
        }
    }

    public function showDelete(int $id): void
    {
        $this->priceListId = $id;
        $priceList = $this->findModel();
        if (! $priceList) { return; }
        if (! $this->checkAuth("delete", $priceList)) { return; }

        $this->displayDelete = true;
    }

    public function confirmDelete(): void
    {
        $priceList = $this->findModel();
        if (! $priceList) { return; }
        if (! $this->checkAuth("delete", $priceList)) { return; }

        if ($priceList->children->count()) {
            session()->flash("error", "Невозможно удалить прайс-лист, у которого есть дочерние элементы");
            $this->closeDelete();
            return;
        }

        if ($priceList->items->count()) {
            session()->flash("error", "Невозможно удалить прайс-лист, у которого есть цены");
            $this->closeDelete();
            return;
        }

        try {
            $priceList->delete();
            session()->flash("success", "Прайс-лист успешно удален");
        } catch (\Exception $exception) {
            session()->flash("error", "Ошибка при удалении прайс-листа");
        }
        $this->closeDelete();
        if (isset($this->priceList)) {
            $this->redirectRoute("admin.price-lists.index");
        }
    }

    public function closeDelete(): void
    {
        $this->displayDelete = false;
        $this->resetFields();
    }

    public function switchPublish(int $id): void
    {
        $this->priceListId = $id;
        $priceList = $this->findModel();
        if (! $priceList) { return; }
        if (! $this->checkAuth("update", $priceList)) { return; }

        $priceList->update([
            "published_at" => $priceList->published_at ? null : now(),
        ]);
        if (isset($this->priceList)) {
            $this->priceList = $priceList;
            $this->dispatch("switch-price-list-published");
        }
    }

    protected function resetFields(): void
    {
        $this->reset("title", "slug", "short", "accent", "description", "info", "priceListId", "parentId", "showNested");
    }

    protected function checkAuth(string $action, PriceListInterface $list = null): bool
    {
        try {
            $priceListModelClass = config("price-list.customPriceListModel") ?? PriceList::class;
            $this->authorize($action, $list ?? $priceListModelClass);
            return true;
        } catch (AuthorizationException $e) {
            session()->flash("error", "Неавторизованное действие");
            $this->closeData();
            $this->closeDelete();
            return false;
        }
    }

    protected function findModel(int $id = null): ?PriceListInterface
    {
        $priceListModelClass = config("price-list.customPriceListModel") ?? PriceList::class;
        if ($id) { $priceList = $priceListModelClass::find($id); }
        else { $priceList = $priceListModelClass::find($this->priceListId); }
        if (!$priceList) {
            session()->flash("error", "Прайс-лист не найден");
            $this->closeData();
            $this->closeDelete();
            return null;
        }
        return $priceList;
    }
}
