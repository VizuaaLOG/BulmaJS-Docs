---
extends: _layouts.docs
title: Tabs
category: 'Core components'
section: 'body'
version: '0.10'
stats:
    version: 0.4.0
    data_api: true
    javascript_api: false
next:
    - Accordion
    - ../../3-wikiki-extensions/accordion
prev:
    - Notification
    - ../notification
---

<style>
    .tabs-content li {
        display: none;
        list-style: none;
    }

    .tabs-content li.is-active {
        display: block;
    }
</style>

Tabs are a common visual component used through the web. In fact, this documentation uses tabs! Bulma only provides the required styles for the navigation part of the tabs. Because of this, we do need to modify the HTML so that we can correctly add the tabs etc. into our project.

Using the example from the Bulma docs, we'll need to change the HTML to look like the below.

@snippet(['language' => 'html'])
    <div class="tabs-wrapper">
        <div class="tabs">
            <ul>
                <li class="is-active">
                    <a>Pictures</a>
                </li>
                <li>
                    <a>Music</a>
                </li>
                <li>
                    <a>Videos</a>
                </li>
                <li>
                    <a>Documents</a>
                </li>
            </ul>
        </div>

        <div class="tabs-content">
            <ul>
                <li class="is-active">
                    <h1>Pictures</h1>
                </li>
                <li>
                    <h1>Music</h1>
                </li>
                <li>
                    <h1>Videos</h1>
                </li>
                <li>
                    <h1>Documents</h1>
                </li>
            </ul>
        </div>
    </div>
@endsnippet

*Note: Due to the HTML changes you'll need to implement your own CSS styling to hide the inactive content boxes. An example of how to do this is below.*

@snippet(['example' => false, 'language' => 'css'])
.tabs-content li {
    display: none;
    list-style: none;
}

.tabs-content li.is-active {
    display: block;
}
@endsnippet

You can also choose to have the content boxes change by just hoving over the tab nav item. To enable this simply add `data-hover` to your tabs.

@snippet(['language' => 'html'])
    <div class="tabs-wrapper" data-hover>
        <div class="tabs">
            <ul>
                <li class="is-active">
                    <a>Pictures</a>
                </li>
                <li>
                    <a>Music</a>
                </li>
                <li>
                    <a>Videos</a>
                </li>
                <li>
                    <a>Documents</a>
                </li>
            </ul>
        </div>

        <div class="tabs-content">
            <ul>
                <li class="is-active">
                    <h1>Pictures</h1>
                </li>
                <li>
                    <h1>Music</h1>
                </li>
                <li>
                    <h1>Videos</h1>
                </li>
                <li>
                    <h1>Documents</h1>
                </li>
            </ul>
        </div>
    </div>
@endsnippet