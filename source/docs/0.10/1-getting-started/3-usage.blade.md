---
extends: _layouts.docs
title: Usage
category: 'Getting started'
section: 'body'
version: '0.10'
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