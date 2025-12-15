@props(["model"])
@if ($model->description)
    <div class="prose max-w-none py-indent-half">
        {!! $model->markdown !!}
        @if ($model->accent)
            <div class="font-semibold text-lg py-indent-half">{{ $model->accent }}</div>
        @endif
    </div>
@endif
