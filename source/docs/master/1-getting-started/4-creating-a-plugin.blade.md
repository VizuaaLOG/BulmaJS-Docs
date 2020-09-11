---
extends: _layouts.docs
title: Creating a plugin
category: 'Getting started'
section: 'body'
version: 'master'
next:
    - Core API
    - ../5-core-api
prev:
    - Usage
    - ../3-usage
---

@notification(['level' => 'info'])
This page has not been updated for 0.11, an example plugin is being worked on to help illustrate how everything ties together and is configured.
@endnotification

BulmaJS uses a simple plugin system allowing anyone to create their own and hook into the BulmaJS core. A BulmaJS plugin is a simple class with some static methods to integrate into the core's API. Within this short guide we're going to create a simple plugin that attaches a click handler to any element with the class `click-me`.

## Setup
The first thing you need to do is create a new folder for your project. In this example we will call our folder `bulmajs-click-me`. You can structure this folder however you like. But we're going to use the structure below.

![Folder structure](/assets/images/{{ $page->version }}/creating-a-plugin-folder-structure.png)

+ **dist** This is used for our production ready files once they have processed (we're not going to cover this in this guide, there are many webpack (or other bundling tools) guides out there, and they'll do a better job of explaining that.)
+ **src** This is where our source files will live.
+ **package.json** This is our node package file

## Installing dependencies
Your plugin will need to have a reference to the BulmaJS core. This will allow you to make use of the core API. If you publish your plugin on NPM, it is recommended to include a notice about using a bundler. Otherwise, your end user will be including multiple copies of the core.

To begin, install BulmaJS as a dev-dependency:
```bash
npm install --save-dev @vizuaalog/bulmajs
```

## Creating your plugin
Now our project is setup we can start creating our plugin. To start create a new file inside the `src` folder. For example `ClickMe.js`.

Open the newly created file and start by including the BulmaJS core:
```javascript
import Bulma from '@vizuaalog/bulmajs/src/core';
```

Now, create a new class representing your new plugin:
```javascript
class ClickMe {

}
```

Your plugin will need a constructor which is responsible for setting up your plugin. A good use is for parsing the options object, or registering events. We're going to use the constructor to register our click event onto the `element` element provided via the options object. We will get back to how `element` is passed through later on.

```javascript
constructor(options) {
    options.element.addEventListener('click', this.handleClick.bind(this));
}
```

If your plugin also needs to support being automatically instanced via the `parseDocument` process, you can do this by specifying a static `parseDocument` method. The method will accept the context, this is passed from the core's `parseDocument` method. You then use your own selector logic that will match the HTML element you are looking for, and then be able to loop over each one and follow the logic you need to create a new instance.

```javascript
...
static parseDocument(context) {
    let elements = context.querySelectorAll('.click-me');

    Bulma.each(elements, (element) => {
        new ClickMe({
            element: element
        });
    });
}
...
```

Depending on what your plugin does you can now add the additional methods and logic to your class. In this example we'll also add our event handler.

```javascript
handleClick(event) {
    alert('You clicked on an element with the class click-me');
}
```

The last thing our class needs is a method that is called by BulmaJS when the `traverseDom` method is called. This method will be passed the element that needs the plugin attaching to it. This is how we build our options object, we then return a new instance of our plugin. For this simple plugin, our `handleDomParsing` method will look like:

```javascript
static handleDomParsing(element) {
    new ClickMe({
        element: element
    });
}
```

Finally, we need to register our plugin with Bulma and export our new module. This is why we needed access to the Bulma core at the beginning on this guide. You can also make use of the various helper methods used internally.

```javascript
Bulma.registerPlugin('click-me', ClickMe);

export default ClickMe;
```

As of version `0.7` you can pass a third argument to `registerPlugin`. This specifies the priority of the plugin being called during the `traverseDOM` process. By default the core BulmaJS plugins have a priority of `0`, increasing the priority of your plugin will have your plugin called before the core plugins. Omitting the priority argument will set the priority to `0`.

This means our final ClickMe plugin file will look like:

```javascript
import Bulma from '@vizuaalog/bulmajs/src/core';

class ClickMe {
    static getRootClass() {
        return 'click-me';
    }

    constructor(options) {
        options.element.addEventListener('click', this.handleClick.bind(this));
    }

    handleClick(event) {
        alert('You clicked on an element with the class click-me');
    }

    static handleDomParsing(element) {
        new ClickMe({
            element: element
        });
    }
}

Bulma.registerPlugin('click-me', ClickMe);

export default ClickMe;
```

You have now created your own BulmaJS plugin. A quick note about the BulmaJS import, if you do not self-register your plugin i.e. ask your users to register themselves, and you do not use any BulmaJS helper methods then you can remove the import, and NPM install.

## Adding custom events
Since BulmaJS 0.11 you can setup custom events users of your plugin can listen to. This is useful for providing 'hooks' during certain lifecycle events of your plugin. To expand on the Click Me plugin created above, we'll add a new custom event allowing users of our plugin to run custom code when the click handler is called.

Adding a custom event is very easy, simply call `this.trigger('eventname')`. Let's update our `handleClick` method.

```javascript
...
handleClick(event) {
    alert('You clicked on an element with the class click-me');

    this.trigger('click');
}
...
```

Your users can then use the `on` method to listen to these events. The caveat of this is that any events called before the event is listened to will not be included.

## Storing the plugin instance on the element
If your plugin supports being instantiated automatically via BulmaJS's `parseDocument` process then you may want to store the instance on the element. This will allow your users to grab the instance and then call methods on the plugin.

This has been possible since BulmaJS 0.11. Simply, update your `parseDocument` method to get the Bulma element instance and then save the new instance to it's data store.

```javascript
...
static parseDocument(context) {
    let elements = context.querySelectorAll('.click-me');

    Bulma.each(elements, (element) => {
        Bulma(element)
            .data('click-me', new ClickMe(configObject))
            .data('click-me');
    });
}
...
```