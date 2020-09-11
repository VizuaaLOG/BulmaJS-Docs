---
extends: _layouts.docs
title: Message
category: 'Core components'
section: 'body'
version: '0.11'
stats:
    version: 0.1.0
    data_api: true
    javascript_api: true
events:
    init:
        - Init
        - on('init')
        - Called once the plugin has finished initialisation.
    open:
        - Open
        - on('open')
        - Called when the message is opened.
    close:
        - Close
        - on('close')
        - Called when the message is closed.
    dismissed:
        - Dismissed
        - on('dismissed')
        - Called when the message has been dismissed.
    destroy:
        - Destroyed
        - on('destroyed')
        - Called when the message instance is destroyed.
next:
    - Modal
    - ../modal
prev:
    - File
    - ../file
---

The message component can be used to provide a note to the user. One use case could be to notify the user of upcoming maintenance to your platform. If you want to permanently display the message without any interactivity then the default behaviour provided by Bulma will be perfect. However, should you wish to create messages via Javascript, automatically dismiss messages or provide a dismiss button you'll need BulmaJS's message component?

## Creating a message
BulmaJS doesn't stop you from creating a message via HTML. In fact, this is the easiest way to get started. However, in some situation, you may need to create your message via Javascript. With BulmaJS this is easy!

@snippet
<div class="message-example-1"></div>

<script>
    window.addLoadScript(function() {
        //start
        Bulma('.message-example-1').message({
            title: 'Optional title',
            body: 'I\'m a large message.'
        })
        //end
        .show();
    });
</script>
@endsnippet

In the above example, we're providing a `title`, `body` and `parent`. `title` and `body` are self-explanatory, these will be placed in the same positions within the message component. `parent` is where you supply the parent element. This element will be the container for this message. The message will be appended to its parent once it has been constructed.

You can also supply additional options to a message when you're creating it. These include:

- `isDismissable` - This is a boolean value and determines if the close button is added to the message.
- `dismissInterval` - This is an integer and specifies the number of milliseconds the message is visible before it is automatically hidden.
- `destroyOnDismiss` - This is a boolean value and determines if the message should be removed from the DOM when it is dismissed via the button or automatically after the `dismissInterval` has passed.
- `color` - This is a string value and determines the color of the message. Any color property from Bulma is supported such as `success` or `info`. This simply adds a class to the element for example `is-success` and so can be used with your own color modifiers.
- `size` - This is a string value and determines the size of the message. Any size property from Bulma is supported such as `large` or `small`. This simply adds a class to the element for example `is-large` and so can be used with your own size modifiers.

## Showing/hiding a message
In some situations, you may wish to show/hide a message via Javascript. Creating a message via the Javascript API returns the `message` object allowing you to call the `show()` and `hide()` messages on it.

@snippet
<div class="message-example-2"></div>

<script>
    window.addLoadScript(function() {
        //start
        Bulma('.message-example-2').message({
            title: 'Optional title',
            body: 'I\'m a large message.',
            parent: document.getElementById('size-message')
        }).show();
        //end
    });
</script>
@endsnippet

## Without Javascript
If you would rather stay away from writing your own Javascript, you don't have too! BulmaJS extends the message component's HTML to allow you to specify the options via data attributes. The only one you will need to use is the `data-dismiss-interval` this will take an integer of the number of milliseconds to wait before hiding the message.

If you would like to provide the user with the ability to dismiss a message, simply include the delete button!

@snippet(['language' => 'html'])
<div class="message is-success">
    <div class="message-header">
        <p>Message title</p>
        <button class="delete"></button>
    </div>
    <div class="message-body">
        I have to be manually dismissed.
    </div>
</div>
@endsnippet