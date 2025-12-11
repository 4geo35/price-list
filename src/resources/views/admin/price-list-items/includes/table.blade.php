<x-tt::table>
    <x-slot name="head">
        <tr>
            <x-tt::table.heading class="text-left">Заголовок</x-tt::table.heading>
            <x-tt::table.heading class="text-left">Цена</x-tt::table.heading>
            <x-tt::table.heading class="text-left">Краткое описание</x-tt::table.heading>
            <x-tt::table.heading>Действия</x-tt::table.heading>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach($items as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->short }}</td>
                <td>
                    <div class="flex items-center justify-center">
                        @if ($item->image_id)
                            <a href="{{ route('thumb-img', ['filename' => $item->image->filename, 'template' => 'original']) }}"
                               class="btn btn-primary px-btn-x-ico mr-indent-half" target="_blank">
                                <x-tt::ico.image />
                            </a>
                        @endif
                        <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                                @cannot("update", $priceList) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="showEdit({{ $item->id }})">
                            <x-tt::ico.edit />
                        </button>
                        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                @cannot("delete", $priceList) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="showDelete({{ $item->id }})">
                            <x-tt::ico.trash />
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-tt::table>
