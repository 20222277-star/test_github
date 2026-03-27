@if ($paginator->hasPages())
    <div style="display: flex; justify-content: center; gap: 8px; margin-top: 30px; align-items: center; flex-wrap: wrap;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <button disabled style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 4px; background-color: #f0f0f0; color: #999; cursor: not-allowed;">← Trước</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" style="padding: 8px 15px; border: 1px solid #007bff; border-radius: 4px; background-color: #007bff; color: white; text-decoration: none; display: inline-block;">← Trước</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button disabled style="padding: 8px 12px; border: 1px solid #007bff; border-radius: 4px; background-color: #007bff; color: white; font-weight: bold; cursor: default; min-width: 38px;">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; background-color: white; color: #007bff; text-decoration: none; display: inline-block; min-width: 38px; text-align: center;">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" style="padding: 8px 15px; border: 1px solid #007bff; border-radius: 4px; background-color: #007bff; color: white; text-decoration: none; display: inline-block;">Sau →</a>
        @else
            <button disabled style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 4px; background-color: #f0f0f0; color: #999; cursor: not-allowed;">Sau →</button>
        @endif
    </div>
@endif

