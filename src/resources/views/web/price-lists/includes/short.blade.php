@props(["model"])
@if ($model->short)
    <div class="mb-indent">{{ $model->short }}</div>
@endif
