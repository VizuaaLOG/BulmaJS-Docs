---
extends: _layouts.docs
title: Usage
category: 'Getting started'
section: 'body'
version: 'master'
next:
    - Creating a plugin
    - ../4-creating-a-plugin
prev:
    - Installation
    - ../3-installation
---

BulmaJS is fairly straightforward to use. There are two ways you can create and interact with BulmaJS plugins. Some plugins may only implement one of these methods, depending on the plugin. However, this will be visually displayed on the plugins documentation page.

### Using the DOM
Most BulmaJS plugins have a DOM API that will allow you to create and customise the plugins. Creating a plugin instance via the DOM API is as simple as creating the Bulma component via HTML and classes. The BulmaJS plugin will then pick up the element once it is loaded and set up all of the necessary features.

For example, the Navbar plugin requires no additional Javascript, simply import the plugin and as long as you have the correct HTML, as per Bulma's documentation, you will have a responsive navigation menu.

Some plugins will also provide additional options you can add to the element through data attributes. These will be equivalent to the options they provide within Javascript and will allow you to customise the plugin without needing to write any additional Javascript code.


By default BulmaJS will automatically parse the document on page load, looking for plugins to initialise. If you're implementing BulmaJS into an environment that requires this to be manually done, ensure the below snippet is included before BulmaJS loads.

```javascript
window.bulmaOptions {
    autoParseDocument: false
}
```

You can then manually parse the document by calling `Bulma.traverseDOM()`. You can also provide a custom scope to the `traverseDOM` function by providing a HTMLElement as the first parameter, this defaults to `document`.

### Using Javascript
If you would prefer to create the plugin instances within Javascript, you can do this very easily. Plugins that support the Javascript API can be created by using the `Bulma.create` method. This method will take the plugin key, such as `modal`, and an object containing the options for that plugin. The documentation page for a plugin will explain the options it has available.

For example, using `Bulma.create` you can easily link a Javascript modal instance to a Modal element:

```javascript
import Modal from '@vizuaalog/bulmajs/src/plugins/Modal';

var modal = Modal.create({
    element: document.querySelector('#myModal')
});

// You can now call methods on modal
modal.open();
```

You can find more information on how to use the Modal plugin by visiting the Modal documentation page.

### Plugin Events
Some plugins will expose events at certain parts of their life. For example, the file plugin can emit an event when it has changed, and will pass the standard Javascript event object as a parameter. You can hook into a plugins event by calling the `on(eventName: String)` method on an instance of the plugin. For example:

```javascript
    import Modal from '@vizuaalog/bulmajs/src/plugins/Modal';

    var modal = Modal.create({
        element: document.querySelector('#myModal')
    });

    modal.on('open', function() {
        // Do something when a modal is opened
    });

    // You can now call methods on modal
    modal.open();
```

You can see what events a plugin has on the documentation page of each plugin. Most plugins will expose the `init` and `destored` events.

### Grabbing a plugin instance
In some situations you may want to attach events to a plugin instance, however, if the plugin has been created automatically for you via our DOM API you may be wondering how to attach such an event.

Since Bulma 0.11 most plugins will save an instance of themselves to the parent element. You can then grab this element and pull the instance of the plugin, allowing you to then call the various API methods.

For example, let's say we want to listen to when a dropdown opens. First, we need have a dropdown component on our page.

@snippet(['language' => 'html'])
<div class="dropdown" id="grabbing-plugin-instance-example">
    <div class="dropdown-trigger">
        <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
        <span>Dropdown button</span>
        <span class="icon is-small">
            <i class="fas fa-angle-down" aria-hidden="true"></i>
        </span>
        </button>
    </div>
    <div class="dropdown-menu" id="dropdown-menu" role="menu">
        <div class="dropdown-content">
            <a class="dropdown-item">Dropdown item</a>
            <a class="dropdown-item">Other dropdown item</a>
        </div>
    </div>
</div>
@endsnippet

Now that we have a dropdown on our page, you can see BulmaJS has already applied it's magic Javascript dust so that our dropdown behaves as we expact when clicking on it. Now, we need to grab the instance of the Dropdown plugin controlling that component, we can do so by using the new element select feature in 0.11.

**NOTE: **`window` is being used here due to some specific situations with how the docs loads these snippets and may not be suitable for your project.

@snippet(['language' => 'javascript'])
    <script>
        window.addLoadScript(function() {
            //start
            window.dropdown = Bulma('#grabbing-plugin-instance-example').data('dropdown');
            //end
        });
    </script>
@endsnippet

Since BulmaJS 0.11 the majority of the core plugins will store a reference to themselves within memory, this is stored within a 'cache' within the Bulma core. A identifier is added to the HTMLElement to help Bulma keep track of the index the element's data is stored within, this works in a similar way to jQuery's data system and was heavily inspired by that.

Calling the `.data` method will lookup the key, in this case the plugin's unique ID, and then return that element's instance of the plugin. This allows you to then call the normal API methods the plugin exposes. In this example, we want to attach to the `open` event.

@snippet(['language' => 'javascript'])
    <script>
        window.addLoadScript(function() {
            //start
            window.dropdown.on('open', function() {
                alert('Magic!');
            });
            //end
        });
    </script>
@endsnippet

This syntax works with the majority of the core plugins where it makes sense, if you think a plugin is incorrectly missing this feature please open an issue or a PR!

If your using `Bulma.create` it'll not create this reference. It's more of a syntax sugar for instances that are automatically created as using `Bulma.create` will provide you with the instance as it has always done.