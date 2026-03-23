@props(["tree", "depth"])
@php
    $sizeClasses = $depth <= 0 ? 'text-lg font-semibold' : '';
    $spacingClasses = match ($depth) {
        0 => "pt-indent-sm space-y-indent-sm",
        default => "pt-indent-xs space-y-indent-xs",
    };
@endphp

@foreach($tree as $child)
    @if ($child["hasChildren"])
        @php($expandedValue = $useAnchors ? true : $child['expanded'])
        <li x-data="{ expanded: '{{ $expandedValue }}' }" class="">
            <button type="button" @click="expanded = !expanded"
                    class="w-full flex items-center justify-between text-left cursor-pointer {{ $sizeClasses }} hover:text-primary-hover {{ $child['isActive'] ? 'text-primary' : '' }}">
                <span>{{ $child["webTitle"] }}</span>
                <span class="transition-all" :class="expanded ? 'rotate-180' : ''">
                    <x-tt::ico.arrow-down />
                </span>
            </button>
            <ul x-collapse x-show="expanded" class="ml-5 {{ $spacingClasses }}" @if (!$expandedValue) style="display: none" @endif>
                @include("pl::web.price-lists.components.tree-sidebar.children", ["tree" => $child["children"], "depth" => $depth + 1])
            </ul>
        </li>
    @else
        <li class="">
            @php($href = $useAnchors ? "#list-{$child['slug']}" : route('web.price-lists.show', ['priceList' => $child['model']]))
            <a href="{{ $href }}"
               class="{{ $sizeClasses }} hover:text-primary-hover {{ $child['isActive'] ? 'text-primary' : '' }}">
                {{ $child["webTitle"] }}
            </a>
        </li>
    @endif
@endforeach
