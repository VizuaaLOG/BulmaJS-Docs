<div class="docs-nav">
    <div class="docs-nav-item">
        @if($page->prev)
            <a class="docs-nav-prev" href="{{ $page->prev[1] }}">{{ $page->prev[0] }}</a>
        @endif
    </div>
    
    <div class="docs-nav-item">
        @if($page->next)
            <a class="docs-nav-next" href="{{ $page->next[1] }}">{{ $page->next[0] }}</a>
        @endif
    </div>
</div>