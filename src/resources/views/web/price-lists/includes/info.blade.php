@props(["model"])
@if ($model->info)
    <div class="prose max-w-none py-indent-half">
        {!! $model->info_markdown !!}
    </div>
@endif
