---
extends: _layouts.docs
title: Calendar
category: 'Wikiki components'
section: 'body'
version: 'master'
stats:
    version: 0.3.0
    data_api: false
    javascript_api: true
events:
    init:
        - Init
        - on('init')
        - Called once the plugin has finished initialisation.
    destroy:
        - Destroyed
        - on('destroyed')
        - Called when the calendar instance is destroyed.
prev:
    - Accordion
    - ../accordion
---

<link rel="stylesheet" href="/assets/bulma-calendar.css">

@notification(['level' => 'warning'])
    <strong>Deprecated</strong> This plugin has now been Deprecated from the core and will be removed in the 1.0 release. If you're still require the JS implementation then it's recommended to use the offical JS library.
@endnotification

@notification(['level' => 'info'])
    This is a BulmaJS ES6 plugin to integrate the JS functionality needed to use <a href="https://wikiki.github.io/components/calendar/" target="_blank">Wikiki's Calendar Bulma extension</a>. BulmaJS does not come with the CSS styling, this will need to be downloaded separately.
@endnotification

The simplest form of the calendar plugin is to show an interactive calendar. This is very easy to do. First, you'll need to create an element that will contain your calendar. Then you create the calendar using the `Bulma.create` method.

@snippet(['language' => 'html'])
    <div id="calendar-demo1"></div>

    <script>
        window.addLoadScript(function() {
            Bulma.create('calendar', {
                parent: document.getElementById('calendar-demo1'),
                navButtons: true
            });
        });
    </script>
@endsnippet

If you would like to hide the navigation buttons simply set `navButtons` to `false`.

## Using the calendar as input
You can also use the calendar for input. By attaching it to an input field you can ask the user to select a date in an easy and visual way. When attaching the calendar to an input you have two options. You can either attach it inline, it'll be shown below the input field, or as an overlay, which will show the calendar as a modal.

To begin with, attaching the calendar to an input field couldn't be easier. Simply follow the same steps above, except instead of specifying the container as the element you instead specify an input field.

@snippet(['language' => 'html'])
    <input type="text" id="calendar-demo3" class="input">

    <script>
        window.addLoadScript(function() {
            Bulma.create('calendar', {
                parent: document.getElementById('calendar-demo3'),
                navButtons: true
            });
        });
    </script>
@endsnippet

To make the input show a modal, simply add `overlay: true` to the options object.

You change the format of the date by specifying the `format` option this will be a string containting `yy`, `yyyy`, `mm` or `dd`. These combinations of characters will be replaced with the correct value.