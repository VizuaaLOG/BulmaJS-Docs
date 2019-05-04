---
extends: _layouts.docs
title: Accordion
category: 'Wikiki components'
section: 'body'
version: 'master'
stats:
    version: 0.3.0
    data_api: false
    javascript_api: true
next:
    - Calendar
    - ../calendar
prev:
    - Tabs
    - ../../2-core-components/notification
---

<link rel="stylesheet" href="/assets/bulma-accordion.css">

@notification(['level' => 'warning'])
    <strong>Deprecated</strong> This plugin has now been Deprecated from the core and will be removed in the 1.0 release. If you're still require the JS implementation then it's recommended to use the offical JS library.
@endnotification

@notification(['level' => 'info'])
    This is a BulmaJS ES6 plugin to integrate the JS functionality needed to use <a href="https://wikiki.github.io/components/accordion/" target="_blank">Wikiki's Accordion Bulma extension</a>. BulmaJS does not come with the CSS styling, this will need to be downloaded separately.
@endnotification

To add the Javascript functionality to the accordion HTML, you simply need to create a BulmaJS accordion instance padding the accordion as the `element` option.

@snippet(['language' => 'javascript', 'example' => false])
    Bulma.create('accordion', {
        element: document.querySelector('.accordions')
    });
@endsnippet

@snippet(['language' => 'html'])
    <section class="accordions" id="accordion-demo1">
        <article class="accordion is-active">
            <div class="accordion-header toggle">
                <p>Hello World</p>
            </div>
            <div class="accordion-body">
                <div class="accordion-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus
                    ac ex sit amet fringilla. Nullam gravida purus diam, et dictum
                    <a>felis venenatis</a> efficitur. Aenean ac
                    <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor
                    urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis
                    sodales sem.
                </div>
            </div>
        </article>
        <article class="accordion">
            <div class="accordion-header">
                <p>Hello World</p>
                <button class="toggle" aria-label="toggle"></button>
            </div>
            <div class="accordion-body">
                <div class="accordion-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus
                    ac ex sit amet fringilla. Nullam gravida purus diam, et dictum
                    <a>felis venenatis</a> efficitur. Aenean ac
                    <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor
                    urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis
                    sodales sem.
                </div>
            </div>
        </article>
        <article class="accordion">
            <div class="accordion-header">
                <p>Hello World</p>
                <button class="toggle" aria-label="toggle"></button>
            </div>
            <div class="accordion-body">
                <div class="accordion-content">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    <strong>Pellentesque risus mi</strong>, tempus quis placerat ut, porta nec nulla. Vestibulum rhoncus
                    ac ex sit amet fringilla. Nullam gravida purus diam, et dictum
                    <a>felis venenatis</a> efficitur. Aenean ac
                    <em>eleifend lacus</em>, in mollis lectus. Donec sodales, arcu et sollicitudin porttitor, tortor
                    urna tempor ligula, id porttitor mi magna a neque. Donec dui urna, vehicula et sem eget, facilisis
                    sodales sem.
                </div>
            </div>
        </article>
    </section>

    <script>
        window.addLoadScript(function() {
            Bulma.create('accordion', {
                element: document.querySelector('.accordions')
            });
        });
    </script>
@endsnippet