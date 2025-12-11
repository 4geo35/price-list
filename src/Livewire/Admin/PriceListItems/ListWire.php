<?php

namespace GIS\PriceList\Livewire\Admin\PriceListItems;

use GIS\PriceList\Interfaces\PriceListInterface;
use GIS\PriceList\Interfaces\PriceListItemInterface;
use GIS\PriceList\Models\PriceListItem;
use GIS\TraitsHelpers\Traits\WireDeleteImageTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ListWire extends Component
{
    use WithFileUploads, WireDeleteImageTrait;

    public PriceListInterface $priceList;

    public bool $displayData = false;
    public bool $displayDelete = false;
    public bool $displayOrder = false;

    public string $title = "";
    public string $price = "";
    public string $short = "";
    public TemporaryUploadedFile|null $cover = null;
    public string|null $coverUrl = null;

    public int|null $itemId = null;

    public Collection|null $list = null;
    public bool $hasSearch = false;

    public function rules(): array
    {
        return [
            "title" => ["required", "string", "max:250"],
            "price" => ["required", "string", "max:250"],
            "short" => ["nullable", "string", "max:250"],
            "cover" => ["nullable", "image", "mimes:jpg,jpeg,png,webp"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "title" => "Заголовок",
            "price" => "Цена",
            "short" => "Краткое описание",
            "cover" => "Изображение",
        ];
    }

    public function render(): View
    {
        $query = $this->priceList->items()->orderBy("priority");
        $items = $query->get();
        return view("pl::livewire.admin.price-list-items.list-wire", compact("items"));
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showCreate(): void
    {
        $this->resetFields();
        if (! $this->checkAuth()) { return; }
        $this->displayData = true;
    }

    public function store(): void
    {
        if (! $this->checkAuth()) { return; }
        $this->validate();

        $item = $this->priceList->items()->create([
            "title" => $this->title,
            "price" => $this->price,
            "short" => $this->short,
        ]);
        /**
         * @var PriceListItemInterface $item
         */
        $item->livewireImage($this->cover);
        $this->closeData();
        session()->flash("item-success", "Цена успешно добавлена");
    }

    public function showEdit(int $itemId): void
    {
        $this->resetFields();
        $this->itemId = $itemId;
        $item = $this->findModel();
        if (! $item) { return; }
        if (! $this->checkAuth()) { return; }

        $this->title = $item->title;
        $this->price = $item->price;
        $this->short = $item->short;
        if ($item->image_id) {
            $item->load("image");
            $this->coverUrl = route("thumb-img", ["filename" => $item->image->filename, "template" => "original"]);
        } else { $this->coverUrl = null; }
        $this->displayData = true;
    }

    public function update(): void
    {
        $item = $this->findModel();
        if (! $item) { return; }
        if (! $this->checkAuth()) { return; }

        $item->update([
            "title" => $this->title,
            "price" => $this->price,
            "short" => $this->short,
        ]);
        $item->livewireImage($this->cover);
        session()->flash("item-success", "Цена успешно обновлена");
        $this->closeData();
    }

    public function closeDelete(): void
    {
        $this->resetFields();
        $this->displayDelete = false;
    }

    public function showDelete(int $itemId): void
    {
        $this->resetFields();
        $this->itemId = $itemId;
        $item = $this->findModel();
        if (! $item) { return; }
        if (! $this->checkAuth("update")) { return; }
        $this->displayDelete = true;
    }

    public function confirmDelete(): void
    {
        $item = $this->findModel();
        if (! $item) { return; }
        if (! $this->checkAuth("update")) { return; }
        $item->delete();
        session()->flash("item-success", "Цена успешно удалена");
        $this->closeDelete();
    }

    public function showOrder(): void
    {
        if (! $this->checkAuth()) { return; }
        $this->displayOrder = true;
        $this->setListItems();
        $this->dispatch("update-list");
    }

    public function reorderItems(array $newOrder): void
    {
        if (! $this->checkAuth()) { return; }

        foreach ($newOrder as $priority => $id) {
            $this->itemId = $id;
            $item = $this->findModel();
            if (! $item) { continue; }
            $item->priority = $priority;
            $item->save();
        }

        $this->resetFields();
        $this->setListItems();
    }

    protected function setListItems(): void
    {
        $this->list = $this->priceList->items()
            ->select("id", "title", "priority")
            ->orderBy("priority")
            ->get();
    }

    protected function resetFields(): void
    {
        $this->reset("title", "price", "short", "cover", "itemId");
    }

    protected function findModel(): ?PriceListItemInterface
    {
        $itemModelClass = config("price-list.customPriceListItemModel") ?? PriceListItem::class;
        $item = $itemModelClass::find($this->itemId);
        if (!$item) {
            session()->flash("item-error", "Цена не найдена");
            $this->closeData();
            $this->closeDelete();
            return null;
        }
        return $item;
    }

    protected function checkAuth(string $action = "update"): bool
    {
        try {
            $this->authorize($action, $this->priceList);
            return true;
        } catch (AuthorizationException $e) {
            session()->flash("item-error", "Неавторизованное действие");
            $this->closeData();
            $this->closeDelete();
            return false;
        }
    }
}
