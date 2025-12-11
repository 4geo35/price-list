<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">Удалить цену</x-slot>
    <x-slot name="text">Будет невозможно восстановить цену</x-slot>
</x-tt::modal.confirm>

<x-tt::modal.aside wire:model="displayData">
    <x-slot name="title">{{ $itemId ? "Редактировать цену" : "Добавить цену" }}</x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $itemId ? 'update' : 'store' }}"
              class="space-y-indent-half" id="priceListItemDataForm">
            <div>
                <label for="itemTitle" class="inline-block mb-2">
                    Заголовок<span class="text-danger">*</span>
                </label>
                <input type="text" id="itemTitle"
                       class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title"/>
            </div>

            <div>
                <label for="itemPrice" class="inline-block mb-2">
                    Цена<span class="text-danger">*</span>
                </label>
                <input type="text" id="itemPrice"
                       class="form-control {{ $errors->has("price") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="price">
                <x-tt::form.error name="price"/>
            </div>

            <div>
                <label for="itemShort" class="inline-block mb-2">
                    Краткое описание
                </label>
                <input type="text" id="itemShort"
                       class="form-control {{ $errors->has("short") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="short">
                <x-tt::form.error name="short"/>
            </div>

            <div>
                <label for="itemCover" class="inline-block mb-2">Изображение</label>
                <input type="file" id="itemCover"
                       class="form-control {{ $errors->has('cover') ? 'border-danger' : '' }}"
                       wire:loading.attr="disabled"
                       wire:model.lazy="cover">
                <x-tt::form.error name="cover"/>
                @include("tt::admin.delete-image-button")
            </div>

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    Отмена
                </button>
                <button type="submit" form="priceListItemDataForm" class="btn btn-primary" wire:loading.attr="disabled">
                    {{ $itemId ? "Обновить" : "Добавить" }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.aside>
