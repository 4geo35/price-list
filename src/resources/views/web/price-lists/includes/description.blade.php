@props(["model"])
@if ($model->description)
    <div class="prose max-w-none mb-indent-lg">
        {!! $model->markdown !!}
    </div>
    @if ($model->accent)
        <div class="font-medium text-base p-indent mb-indent-lg border border-transparent rounded-base"
             style="
                background:
                    linear-gradient(rgba(var(--color-body-bg), 1), rgba(var(--color-body-bg), 1)) padding-box,
                    linear-gradient(165deg, rgba(var(--color-primary), 1) 0%,rgba(var(--color-primary), 0) 30%) border-box,
                    linear-gradient(165deg, rgba(var(--color-primary), 0) 70%, rgba(var(--color-primary), 1) 100%) border-box
                ">
            {{ $model->accent }}
        </div>
    @endif
@endif

