<x-tt::modal.dialog wire:model="displayOrder">
    <x-slot name="title">Порядок цен</x-slot>
    <x-slot name="content">
        @if ($list)
            <ul drag-root>
                @foreach($list as $key => $item)
                    <li class="py-indent-half"
                        drag-item="{{ $item->id }}" drag-item-order="{{ $key }}"
                        wire:key="{{ $item->id }}">
                        <div class="flex items-center">
                            <x-tt::ico.bars drag-grab class="text-secondary cursor-grab mr-indent" />
                            <span class="">{{ $item->title }}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </x-slot>
</x-tt::modal.dialog>

@include("tt::admin.draggable-script")
