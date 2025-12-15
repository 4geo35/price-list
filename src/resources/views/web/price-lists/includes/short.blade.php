@props(["model"])
@if ($model->short)
    <div class="py-indent-half">{{ $model->short }}</div>
@endif
