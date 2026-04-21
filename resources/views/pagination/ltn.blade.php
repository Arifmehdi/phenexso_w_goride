@if ($paginator->hasPages())
    <div class="ltn__pagination-area text-center">
        <div class="ltn__pagination">
            <ul>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="disabled"><span><i class="fas fa-angle-double-left"></i></span></li>
                @else
                    <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fas fa-angle-double-left"></i></a></li>
                @endif

                {{-- Pagination Numbers --}}
                @foreach ($elements as $element)
                    {{-- Dots --}}
                    @if (is_string($element))
                        <li><span>{{ $element }}</span></li>
                    @endif

                    {{-- Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active"><a href="#">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fas fa-angle-double-right"></i></a></li>
                @else
                    <li class="disabled"><span><i class="fas fa-angle-double-right"></i></span></li>
                @endif
            </ul>
        </div>
    </div>
@endif
