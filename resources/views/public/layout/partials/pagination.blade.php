<div class="pagination-wrap col-md-12">
    <ul class="pagination">
        <li>
        @if ($paginator->onFirstPage())
            <a class="disabled" aria-label="Next">
                <span aria-hidden="true">&laquo;</span>
            </a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" aria-label="Next">
                <span aria-hidden="true">&laquo;</span>
            </a>
        @endif

        </li>
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page"><a class="disabled active"><span>{{ $page }}</span></a></li>
                    @else
                        <li><a href="{{ $url }}"><span>{{ $page }}</span></a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        <li>
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            @else
                <a class="disabled" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            @endif
        </li>
    </ul><!-- /.pagination -->
</div><!-- /.pagination-wrap -->
