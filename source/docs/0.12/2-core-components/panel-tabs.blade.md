---
extends: _layouts.docs
title: Panel Tabs
category: 'Core components'
section: 'body'
version: '0.12'
stats:
    version: 0.12.0
    data_api: true
    javascript_api: yes
events:
    init:
        - Init
        - on('init')
        - Called once the plugin has finished initialisation.
    destroy:
        - Destroyed
        - on('destroyed')
        - Called when the plugin instance is destroyed.
next:
    - Tabs
    - ../tabs
prev:
    - Notification
    - ../notification
---

Panel Tabs is an extension to the Tabs plugin providing a version of it that's compatible with the Panel's layout but also feels more like the panel should behave.

Instead of having multiple 'tabs' the Panel Tabs plugin acts like a filter, allowing each item to control what 'category' it shows. With 'all' being a special show everything category.

Using the example from the Bulma docs, we'll need to change the HTML to look like the below.

@snippet(['language' => 'html'])
    <nav class="panel">
        <p class="panel-heading">Repositories</p>
        <div class="panel-block">
            <p class="control has-icons-left">
                <input class="input" type="text" placeholder="Search">
                <span class="icon is-left">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </span>
            </p>
        </div>
        <p class="panel-tabs">
            <a class="is-active" data-all>All</a>
            <a data-target="public">Public</a>
            <a data-target="private">Private</a>
            <a data-target="sources">Sources</a>
        </p>
        <a class="panel-block is-active" data-category="public">
            <span class="panel-icon">
              <i class="fas fa-book" aria-hidden="true"></i>
            </span>
            bulma
        </a>
        <a class="panel-block" data-category="public">
            <span class="panel-icon">
              <i class="fas fa-book" aria-hidden="true"></i>
            </span>
            marksheet
        </a>
        <a class="panel-block" data-category="public">
            <span class="panel-icon">
              <i class="fas fa-book" aria-hidden="true"></i>
            </span>
            minireset.css
        </a>
        <a class="panel-block" data-category="public">
            <span class="panel-icon">
              <i class="fas fa-book" aria-hidden="true"></i>
            </span>
            jgthms.github.io
        </a>
    
        <a class="panel-block" data-category="public">
            <span class="panel-icon">
              <i class="fas fa-code-branch" aria-hidden="true"></i>
            </span>
            daniellowtw/infboard
        </a>
    
        <a class="panel-block" data-category="public">
            <span class="panel-icon">
              <i class="fas fa-code-branch" aria-hidden="true"></i>
            </span>
            mojs
        </a>
    
        <a class="panel-block" data-category="private">
            <span class="panel-icon">
              <i class="fas fa-code-branch" aria-hidden="true"></i>
            </span>
            private-1
        </a>
    
        <a class="panel-block" data-category="sources">
            <span class="panel-icon">
              <i class="fas fa-code-branch" aria-hidden="true"></i>
            </span>
            private-2
        </a>
    </nav>
@endsnippet

This plugin requires minimal markup changes and no extra CSS. All you need to do is configure the `data-target`, `data-all` and `data-category` attributes:
+ `data-target` - This is applied to the nav items at the top of your panel tabs, it should be a string that matches other items containing a `data-category` with the same string.
+ `data-all` - This is a special attribute that should be applied to a nav item, it will set all items to be visible.
+ `data-category` - This should be applied to each item and contain a string that matches one of the `data-target` values.

## Dynamically change the active items
If you would like to change the active items programmatically, you can do so via the `setActive` method. This method accepts a single parameter which is a `string` representing the category you would like to show.

For example to show all items with the `featured` category, you could do the following.
```javascript
let tabs = Bulma('.panel').data('panel-tabs');
tabs.setActive('featured');
```