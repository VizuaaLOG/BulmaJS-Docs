<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
    </head>
    <body class="has-background-light">
        @include('_partials.navbar')

        <div class="docs-wrapper">
            <div class="columns">
                <div class="column is-3">
                    @include('_partials.docs_sidebar', ['versionUrl' => $page->versionUrl])
                </div>

                <div class="column is-expanded">
                    <div class="content has-background-white">
                        @yield('body')
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="content has-text-centered">
                    <p>
                        <strong>BulmaJS</strong> by <a href="https://github.com/VizuaaLOG">Thomas Erbe</a>. Found a typo? File an <a href="https://github.com/VizuaaLOG/BulmaJS/issues">issue on Github</a>! Or <a href="https://github.com/VizuaaLOG/BulmaJS/pulls">submit a pull request</a>.
                    </p>
                </div>
            </div>
        </footer>

        <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
    </body>
</html>
