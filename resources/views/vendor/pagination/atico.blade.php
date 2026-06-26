@if ($paginator->hasPages())
    <nav class="pagination-nav" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        @if ($paginator->total() > 0)
            <p class="pagination-info">
                Showing
                <strong>{{ $paginator->firstItem() ?? 0 }}</strong>
                to
                <strong>{{ $paginator->lastItem() ?? 0 }}</strong>
                of
                <strong>{{ $paginator->total() }}</strong>
                results
            </p>
        @endif

        <ul class="pagination-list">
            {{-- Previous --}}
            <li class="pagination-item">
                @if ($paginator->onFirstPage())
                    <span class="pagination-link pagination-link--arrow is-disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        <span class="pagination-link-text">Prev</span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="pagination-link pagination-link--arrow" rel="prev" aria-label="{{ __('pagination.previous') }}">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                        <span class="pagination-link-text">Prev</span>
                    </a>
                @endif
            </li>

            {{-- Page numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="pagination-item">
                        <span class="pagination-link pagination-link--dots" aria-disabled="true">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="pagination-item">
                            @if ($page == $paginator->currentPage())
                                <span class="pagination-link is-current" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="pagination-link" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            <li class="pagination-item">
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="pagination-link pagination-link--arrow" rel="next" aria-label="{{ __('pagination.next') }}">
                        <span class="pagination-link-text">Next</span>
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                @else
                    <span class="pagination-link pagination-link--arrow is-disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span class="pagination-link-text">Next</span>
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </span>
                @endif
            </li>
        </ul>
    </nav>
@endif
