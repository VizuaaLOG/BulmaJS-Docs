---
extends: _layouts.docs
title: Core API
category: 'Getting started'
section: 'body'
version: 'master'
next:
    - Alert
    - ../../2-core-components/alert
prev:
    - Creating a Plugin
    - ../4-creating-a-plugin
---

The BulmaJS core has a few helper methods to aid with plugin developers and anyone who wishes to tweak their usage to suit their application and hook into some more advanced functionality. You can find all of the methods documented below.

## `Bulma.parseDocument([context: HTMLElement = document])`
This method allows you to trigger the parsing of the data attributes for all of the registered plugins. By default this will use `document` as the content, however, you can also provide a custom context.

Should you need the automatic calling of this method when BulmaJS loads disabling, you can do so by specifying the `autoParseDocument` option within the global `bulmaOptions` object. This should be defined before BulmaJS has loaded.


```javascript
window.bulmaOptions {
    autoParseDocument: false
}
```

@tag(['type' => 'new', 'since' => '0.12'])@endtag
Since 0.12 this method will verify if the given context is a valid plugin element, if it is, then it will skip further processing and initialise the given element as the plugin instance. If the context is not a valid plugin element then this method will behave as it did before 0.12 by checking the children for a valid plugin element.