@if ($paginator->hasPages())
<div class="col-lg-12 text-center gnv99">
    <div class="product__pagination blog__pagination">
        @if ($paginator->onFirstPage())
            <a href="#" class="my-paginate-active">1</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-long-arrow-left"></i></a>

            @if (!$paginator->hasMorePages())
                <a href="{{ $paginator->url($paginator->currentPage() - 1) }}">{{ $paginator->currentPage() - 1 }}</a>
            @endif
        @endif

        @if ($paginator->hasMorePages())
            @if (!$paginator->onFirstPage())
                <a href="#" class="my-paginate-active">{{ $paginator->currentPage() }}</a>
            @endif
            <a href="{{ $paginator->url($paginator->currentPage() + 1) }}">{{ $paginator->currentPage() + 1 }}</a>
            <a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-long-arrow-right"></i></a>
        @else
            <a href="#" class="my-paginate-active">{{ $paginator->currentPage() }}</a>
        @endif
    </div>
</div>
@endif
