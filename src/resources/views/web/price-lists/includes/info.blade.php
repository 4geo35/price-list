@props(["model"])
@if ($model->info)
    <div class="prose prose-sm max-w-none py-indent-half">
        {!! $model->info_markdown !!}
    </div>
@endif
