<div class="docs-nav">
    <div class="docs-nav-item">
        @if($page->prev)
            <a class="docs-nav-prev docs-nav-item" href="{{ $page->prev[1] }}">{{ $page->prev[0] }}</a>
        @endif
    </div>
    
    <div class="docs-nav-item">
        <a class="docs-nav-next docs-nav-item" href="{{ $page->next[1] }}">{{ $page->next[0] }}</a>
    </div>
</div>