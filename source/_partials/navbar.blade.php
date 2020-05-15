<nav id="navigation-menu" class="navbar is-primary" data-sticky data-sticky-shadow>
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img src="/assets/images/bulmajs-logo-white.svg" alt="BulmaJS" width="112" height="28">
            </a>
            <div class="navbar-burger burger" data-trigger data-target="navbar">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navbar" class="navbar-menu">
            <div class="navbar-end">
                <a class="navbar-item" href="/">
                    Home
                </a>

                <a class="navbar-item" href="/docs/{{ $page->documentation_version }}">
                    Documentation
                </a>

                <a class="navbar-item" href="/blog">
                    Blog
                </a>

                <a class="navbar-item" href="/patrons">
                    Patrons
                </a>
                
                @if($page->getPath() != '')
                    <div class="navbar-item">
                        <div class="field">
                            <div class="control">
                                <div class="select version-selector">
                                    <select name="version-selector" id="version-selector">
                                        @foreach($page->versions as $version)
                                            <option value="{{ $version }}">{{ $version }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>