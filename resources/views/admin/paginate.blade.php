@if ($paginator->hasPages())
<div class="d-flex justify-content-end mt-3">

    <div class="pagination-wrap hstack gap-2">

        @if ($paginator->onFirstPage())
        <a class="page-item pagination-prev disabled" href="#">
            Previous
        </a>
		@else

        <a class="page-item pagination-prev disabled" href="{{ $paginator->previousPageUrl() }}">
            Previous
        </a>
		@endif

        <ul class="pagination listjs-pagination mb-0">

        @foreach ($elements as $element)

            @if (is_string($element))
                <li class="page disabled">{{ $element }}</li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active">
                            <a class="page">{{ $page }}</a>
                        </li>
                    @else
                        <li>
                            <a class="page"
                            href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
		@endforeach
        </ul>

        @if ($paginator->hasMorePages())
        <a class="page-item pagination-next" href="{{ $paginator->nextPageUrl() }}">
            Next
        </a>
		@else
        <a class="page-item pagination-next" href="#">
            Next
        </a>
		@endif

    </div>
</div>
@endif
