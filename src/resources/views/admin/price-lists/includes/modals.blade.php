<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">Удалить прайс-лист</x-slot>
    <x-slot name="text">Будет невозможно восстановить прайс-лист!</x-slot>
</x-tt::modal.confirm>

<x-tt::modal.dialog wire:model="displayData">
    <x-slot name="title">
        {{ $priceListId ? "Редактировать прайс-лист" : "Добавить " . ($parentId ? "дочерний прайс-лист" : "прайс-лист") }}
    </x-slot>
    <x-slot name="content">
        Hello
    </x-slot>
</x-tt::modal.dialog>
