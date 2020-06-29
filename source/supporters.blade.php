@extends('_layouts.blog')

@section('body')
    <section class="hero is-medium is-bold is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    BulmaJS Supporters ❤️
                </h1>
                <h2 class="subtitle">
                    This page serves as a 'friendlier' copy of the supporters.md file in the main BulmaJS repository. Thank you to everyone who has supported BulmaJS's future. 🙂
                </h2>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="card">
                <div class="card-content">
                    <p class="title">
                        Patrons
                    </p>
                    <p class="subtitle">
                        The supporters below are those who are currently or have been a regular supporter of this project on <a href="https://www.patreon.com/vizuaalog" target="_blank">Patreon</a>.
                    </p>
                    <p>
                        Would you like to become a regular supporter of BulmaJS?
                        <a href="https://www.patreon.com/bePatron?u=12880941" data-patreon-widget-type="become-patron-button">Become a Patron!</a><script async src="https://c6.patreon.com/becomePatronButton.bundle.js"></script>
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <p class="title">
                        Paypal
                    </p>
                    <p class="subtitle">
                        The supports below are those who have generously donated via Paypal.
                    </p>
                    <p><strong class="has-text-primary">
                        Andreas Pantle
                    </strong></p>
                    <p style="margin-top: 1rem;">
                        If you would like to help support BulmaJS development and would prefer a one-off donation, please use <a href="https://paypal.me/tomerbe" target="_blank">Paypal</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection