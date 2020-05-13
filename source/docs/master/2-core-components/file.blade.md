---
extends: _layouts.docs
title: File
category: 'Core components'
section: 'body'
version: 'master'
stats:
    version: 0.1.0
    data_api: true
    javascript_api: true
events:
    init:
        - Init
        - on('init')
        - Called once the plugin has finished initialisation.
    changed:
        - Changed
        - on('changed', eventObject)
        - Called when the file input has changed. Passes the standard file event object as an argument.
next:
    - Message
    - ../message
prev:
    - Dropdown
    - ../dropdown
---

Bulma provides custom styling for the file input. This is great for unifying the design of your form between browsers. One great addon to the Bulma file component is the `file-name` element. This provides a place for you to insert the name of the file you're uploading.

The file plugin can be used to easily add the file name detection to your file component. All you need to do is include BulmaJS and the File component into your page. Everything will then taken care of. You can even include a placeholder value in the filename element, this will then be overridden once a file is deleted.

@snippet(['language' => 'html'])
<div class="file has-name is-boxed">
    <label class="file-label">
        <input class="file-input" type="file" name="resume">
        <span class="file-cta">
            <span class="file-icon">
                <i class="fa fa-upload"></i>
            </span>
            <span class="file-label">
                Choose a file…
            </span>
        </span>
        <span class="file-name">Please select a file.</span>
    </label>
</div>
@endsnippet

But what about a multiple input field? If you want to use the Bulma file component to upload multiple files, just include the `multiple` attribute like you would with a standard HTML form. The file plugin will detect this and say `x files selected`.

@snippet(['language' => 'html'])
<div class="file has-name is-boxed">
    <label class="file-label">
        <input class="file-input" type="file" name="resume" multiple>
        <span class="file-cta">
            <span class="file-icon">
                <i class="fa fa-upload"></i>
            </span>
            <span class="file-label">
                Choose a file…
            </span>
        </span>
        <span class="file-name">Please select a file.</span>
    </label>
</div>
@endsnippet

## Get the filename in Javascript
@tag(['type' => 'new', 'since' => '0.11'])@endtag
If you would like to get the filename for a given File plugin instance you can do so using the `getFilename` method.

This ties in with the new `data` method added to Bulma allowing you get instances of plugins without needing a direct reference. For example you would be able to do the following:
```javascript
let myFile = Bulma('.some-file-selector').data('file');
console.log(myFile.getFilename()) // This will be the filename as shown within the component
```

Combining this with the `on` method you'll be able to dynamically update any background logic you have:
```javascript
let myFile = Bulma('.some-file-selector').data('file');
myFile.on('changed', function() {
    let filename = myFile.getFilename();
});
```