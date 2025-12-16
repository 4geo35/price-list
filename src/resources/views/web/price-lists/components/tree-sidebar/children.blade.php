@props(["tree", "depth"])
@php
    $sizeClasses = $depth <= 0 ? 'text-lg font-semibold' : ''; // TODO: change size for more depth
@endphp

@foreach($tree as $child)
    @if ($child["hasChildren"])
        <li x-data="{ expanded: '{{ $useAnchors ? true : $child['expanded'] }}' }" class="">
            <button type="button" @click="expanded = !expanded"
                    class="w-full flex items-center justify-between text-left cursor-pointer {{ $sizeClasses }} hover:text-primary-hover {{ $child['isActive'] ? 'text-primary' : '' }}">
                <span>{{ $child["webTitle"] }}</span>
                <span class="transition-all" :class="expanded ? 'rotate-180' : ''">
                    <x-tt::ico.arrow-down />
                </span>
            </button>
            <ul x-collapse x-show="expanded" class="ml-indent-half mb-2">
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
