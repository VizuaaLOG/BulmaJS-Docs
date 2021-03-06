<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-64446221-4"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-64446221-4');
        </script>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.css" />
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
    </head>
    <body>
        @include('_partials.navbar')

        @yield('body')

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

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
        <script type="text/javascript">
            docsearch({
                apiKey: '4604f719b2c677edf16642a7b1411386',
                indexName: 'bulma_js',
                inputSelector: '#search',
                algoliaOptions: { 'facetFilters': ["version:" + getSelectedVersion()] },
                debug: false // Set debug to true if you want to inspect the dropdown
            });
        </script>
    </body>
</html>
