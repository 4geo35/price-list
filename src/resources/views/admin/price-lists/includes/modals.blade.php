<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">Удалить прайс-лист</x-slot>
    <x-slot name="text">Будет невозможно восстановить прайс-лист!</x-slot>
</x-tt::modal.confirm>

<x-tt::modal.dialog wire:model="displayData">
    <x-slot name="title">
        {{ $priceListId ? "Редактировать прайс-лист" : "Добавить " . ($parentId ? "дочерний прайс-лист" : "прайс-лист") }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $priceListId ? 'update' : 'store' }}"
              class="space-y-indent-half"
              id="priceListDataForm">
            <div>
                <label for="title" class="inline-block mb-2">
                    Заголовок<span class="text-danger">*</span>
                </label>
                <input type="text" id="title"
                       class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title"/>
            </div>

            <div>
                <label for="slug" class="inline-block mb-2">
                    Адресная строка
                </label>
                <input type="text" id="slug"
                       class="form-control {{ $errors->has("slug") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="slug">
                <x-tt::form.error name="slug"/>
            </div>

            <div>
                <label for="short" class="inline-block mb-2">
                    Краткое описание
                </label>
                <input type="text" id="short"
                       class="form-control {{ $errors->has("short") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="short">
                <x-tt::form.error name="short"/>
            </div>

            <div>
                <label for="description" class="flex justify-start items-center mb-2">
                    Описание
                    @include("tt::admin.description-button")
                </label>
                @include("tt::admin.description-info")
                <textarea id="description"
                          class="form-control !min-h-52 {{ $errors->has('description') ? 'border-danger' : '' }}"
                          rows="10"
                          wire:model.live="description">
                        {{ $description }}
                    </textarea>
                <x-tt::form.error name="description"/>

                <div class="prose prose-sm mt-indent-half">
                    {!! \Illuminate\Support\Str::markdown($description) !!}
                </div>
            </div>

            <div>
                <label for="accent" class="inline-block mb-2">
                    Акцент
                </label>
                <input type="text" id="accent"
                       class="form-control {{ $errors->has("accent") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="accent">
                <x-tt::form.error name="accent"/>
            </div>

            <div>
                <label for="info" class="flex justify-start items-center mb-2">
                    Информация
                    @include("tt::admin.description-button", ["id" => "infoFieldHidden"])
                </label>
                @include("tt::admin.description-info", ["id" => "infoFieldHidden"])
                <textarea id="info"
                          class="form-control !min-h-52 {{ $errors->has('info') ? 'border-danger' : '' }}"
                          rows="10"
                          wire:model.live="info">
                        {{ $info }}
                    </textarea>
                <x-tt::form.error name="info"/>

                <div class="prose prose-sm mt-indent-half">
                    {!! \Illuminate\Support\Str::markdown($info) !!}
                </div>
            </div>

            @if (! config("price-list.singlePage"))
                <div class="form-check">
                    <input type="checkbox" wire:model="showNested" id="showNested"
                           class="form-check-input {{ $errors->has('showNested') ? 'border-danger' : '' }}"/>
                    <label for="showNested" class="form-check-label">
                        Раскрыть вложенные листы
                    </label>
                </div>
            @endif

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    Отмена
                </button>
                <button type="submit" form="priceListDataForm" class="btn btn-primary" wire:loading.attr="disabled">
                    {{ $priceListId ? "Обновить" : "Добавить" }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.dialog>
