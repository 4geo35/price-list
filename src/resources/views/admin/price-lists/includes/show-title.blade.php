<div class="flex justify-between items-center overflow-x-auto beautify-scrollbar">
    <h2 class="font-medium text-2xl text-nowrap mr-indent-half">
        {{ $priceList->title }}
    </h2>

    <div class="flex justify-end">
        <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                @cannot("update", $priceList) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="showEdit({{ $priceList->id }})">
            <x-tt::ico.edit />
        </button>
        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                @cannot("delete", $priceList) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="showDelete({{ $priceList->id }})">
            <x-tt::ico.trash />
        </button>

        <button type="button" class="btn {{ $priceList->published_at ? 'btn-success' : 'btn-danger' }} px-btn-x-ico ml-indent-half"
                @cannot("update", $priceList) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="switchPublish({{ $priceList->id }})">
            @if ($priceList->published_at)
                <x-tt::ico.toggle-on />
            @else
                <x-tt::ico.toggle-off />
            @endif
        </button>
    </div>
</div>
