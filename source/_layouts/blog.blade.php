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
        <link rel="stylesheet" href="{{ mix('css/main.css', 'assets/build') }}">
    </head>
    <body class="has-background-light">
        @include('_partials.navbar')

        <div class="docs-wrapper">
            <div class="container">
                <div class="content has-background-white">
                    <h1 class="is-marginless">{{ $page->title }}</h1>
                    <p class="blog-published-date"><strong>Published {{ \Carbon\Carbon::parse($page->published_at)->format('Y/m/d') }}</strong></p>

                    <p class="is-size-5 has-text-primary">{{ $page->intro }}</p>

                    @yield('body')
                </div>
            </div>

            <footer class="footer">
                <div class="content has-text-centered">
                    <p>
                        <strong>BulmaJS</strong> by <a href="https://github.com/VizuaaLOG">Thomas Erbe</a>. Found a typo? File an <a href="https://github.com/VizuaaLOG/BulmaJS/issues">issue on Github</a>! Or <a href="https://github.com/VizuaaLOG/BulmaJS/pulls">submit a pull request</a>.
                    </p>
                </div>
            </footer>
        </div>

        <script src="{{ mix('js/main.js', 'assets/build') }}"></script>
    </body>
</html>
