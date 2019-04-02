@php 
$menuItems = getPageList($page->version);
@endphp

<aside class="menu docs-menu has-margin-top-4">
    @foreach($menuItems as $category => $subItems)
        <p class="menu-label">{{ $category }}</p>
        <ul class="menu-list">
            @foreach($subItems as $subItem)
                <li>
                    <a class="{{ $page->is($subItem->path) ? 'is-active' : '' }}" href="{{ $subItem->path }}">{{ $subItem->page }}</a>
                </li>
            @endforeach
        </ul>
    @endforeach
</aside>