@extends('_layouts.master')

@section('body')
    <div class="hero is-primary is-medium">
        <div class="hero-body">
            <div class="container has-text-centered">
                <img src="/assets/images/bulmajs-logo-white.svg" alt="BulmaJS" width="448" height="112">
                
                <h2 class="subtitle is-4">Open source, pluggable Javascript library for Bulma.</h2>

                @snippet(['highlight' => false, 'classes' => 'has-background-black-20 has-text-white is-inline-block'])
                    npm install @vizuaalog/bulmajs
                @endsnippet

                <div class="buttons has-margin-top-4 is-centered">
                    <a href="/docs/{{ $page->documentation_version }}/" class="button is-white is-block">Get started</a>
                    <a href="https://github.com/VizuaaLOG/BulmaJS/releases" class="button is-white is-block is-outlined">Download <strong>{{ $page->released_version }}</strong></a>
                </div>
            </div>
        </div>
    </div>

    <section class="section featured-points">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <div class="feature-icon">
                        <span class="fab fa-js fa-4x" style="color: #ff3860;"></span>
                    </div>
                    <p class="title is-4">Modern</p>
                    <p class="feature-description">Built with ES6 and pre-compiled for backwards compatibility, BulmaJS is ready for the next generation of the web.</p>
                </div>
        
                <div class="column">
                    <div class="feature-icon">
                        <span class="fas fa-plug fa-4x" style="color: #ffdd57;"></span>
                    </div>
                    <p class="title is-4">Pluggable</p>
                    <p class="feature-description">BulmaJS contains a very small core, providing base functionality. Everything else is a plugin! Don't need a modal, don't include it!</p>
                </div>
        
                <div class="column">
                    <div class="feature-icon">
                        <span class="fas fa-puzzle-piece fa-4x" style="color: #209cee;"></span>
                    </div>
                    <p class="title is-4">Dependency free</p>
                    <p class="feature-description">In the mobile world, every byte counts. BulmaJS comes with no dependencies and uses only vanilla Javascript.</p>
                </div>
        
                <div class="column">
                    <div class="feature-icon">
                        <span class="fa-stack fa-2x" style="color: #23d160;">
                            <i class="fas fa-dollar-sign fa-stack-1x"></i>
                            <i class="fas fa-ban fa-stack-2x"></i>
                        </span>
                    </div>
                    <p class="title is-4">Open source</p>
                    <p class="feature-description">BulmaJS is 100% open source, free to use on any project. No strings attached. It really is that simple!</p>
                </div>
            </div>
        </div>
    </section>
@stop