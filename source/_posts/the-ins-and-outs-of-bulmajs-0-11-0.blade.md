---
extends: _layouts.blog_post
title: The Ins and Outs of BulmaJS 0.11.0
category: 'Blog'
section: content
published: true
published_date: 2020-05-28
intro: I'm writing this as version 0.11.0 is coming ever so close to release. Currently, giving the docs a read over and adding this handy little blog. 0.11 is the biggest update since I released BulmaJS almost 3 years ago. So, let's dive in!
---

I published the BulmaJS repository Thursday 10th August 2017, almost 3 years ago! It was my first 'real' open source project and when I first starting working on BulmaJS it was mainly to help with adding the JS functionality to client websites I was building. A lot has changed since then, for starters, I changed job! Due to the huge changes with 0.11 I wanted to write a post outlining what's changed and why.

But first, where have you been? Yeah about that. I went through a long period of time where I just wasn't interested on working on projects, I kept starting loads and just abandoning them, so I decided to take a little break and not work on side projects.

## What has changed?
So, if you've read the change log for 0.11 you may not think a huge has changed. While underlying functionality hasn't changed too much, there are some new features that were suggested by some of you, 0.11 marks a huge change in the underlying API, both in terms of how everything is managed internally, but also with how BulmaJS exposes itself to fellow developers.

The main change in 0.11 is the change to a more fluent (in my opinion) API with most plugins now also exposing an JS API. This also meant a vast amount of work had to go into how everything is managed and also allow you to somehow get an instance of a plugin after it had been initialised (for example when auto parsing the document).

## The small things
Let's start with the smaller additions, these are all documented in the updated 0.11 docs, however, a quick overview here cannot hurt!

### File plugin - `getFilename`
Getting the filename from the File component has been relatively easy in the past, since you could just use `innerHTML` on the relevant element. However, I feel since this a JS library, we should probably make that a little bit easier. So you can now:

```javascript
file.getFilename() // cats.jpg
```

This method does do what I mentioned above since the plugin doesn't need to keep an internal record of the filename, so it is just some syntax sugar on top.

### Tabs plugin - `setActive`
Since the idea was to open up the plugins to your JS, allowing for various post initialisation features (more are coming in future updates), it was a perfect time to allow the active tab to be programatically changed. Now you can:

```javascript
tabs.setActive(1); // This will set the second tab active
```

The `setActive` method accepts a number representing the index of the tab you would like to set active, starting at `0`. Neat!

### Navbar plugin - Enable/disable sticky and hide on scroll
The navbar within BulmaJS has the ability to be sticky and as an addition also hide when scrolling. However, this was a decision you had to make on page load and couldn't change. Not with 0.11, you can enable/disable these features whenever you like:

```javascript
navbar.enableSticky();
navbar.disableSticky();
navbar.enableHideOnScroll();
navbar.disableHideOnScroll();
```

### Modal plugin - AJAX content
As from 0.11 you can create a modal that loads it's content via an AJAX call. Simply provide a `bodyUrl` option when creating the modal, and it'll perform an AJAX request and replace the Modal's content with whatever is returned. Please note that any script tags are automatically removed from the response before it's rendered to the page, this is not configurable, and will not be changed.

---
That's the small feature changes out of the way. Now for a change that I didn't expect to make yet...

## Removal of the Accordion and Calendar plugins
The initial idea when deprecating these plugins was to remove them in the 1.0.0 release. However, due to the vast amount of changes and work that has happened behind the scenes it was not feasible to update them for this release.

The plugins that were part of the BulmaJS core were not compatible with the recent versions that Wikiki had published and were very complex and would have needed a lot of changes to be compatible with the new API. This is why the decision was made to remove them as part of this 0.11 release.

If you still require these two plugins then I would suggest either staying on 0.10, or migrating them over to Wikiki's official JS dependencies. If anyone would like to write a third party plugin to continue supporting these, they're welcome to do so (and I'll happily include a section within the readme and on this website) however they're not going to reamin inside the core.

## The big change...
So, that's the smaller things covered. Now it's time to talk about the major change in 0.11.

The internals of BulmaJS have gone through many adjustments, tweaks and revisions as part of 0.11, with the aim of making everything consistent and easier to expand upon, there's still some work to do with this, but 0.11 is a massive step forward.

### Removal of `create`... kinda...
The main breaking change for users of BulmaJS (we'll come back to any plugin authors later in this post) is how plugins are created. In versions 0.10 and earlier if you wanted to create a new message you may do something like:

```javascript
Bulma.create('message', {
    title: 'Optional title',
    body: 'I\'m a large message.',
    parent: document.getElementById('size-message')
});
```

There's nothing wrong with this. However, I always felt the configuration object wasn't the right place to put things such as the containing parent element, or with some plugins the root element we're hooking in to. To counter this, BulmaJS has adopted a jQuery-like approach. The above example would now be called via:

```javascript
Bulma('.size-message').message({
    title: 'Optional title',
    body: 'I\'m a large message.'
});
``` 

I feel this a much cleaner syntax, you're creating a message within the `.size-message` element. The `create` method does still exist within the library, it's now being used as an internal function and so any calls to it will likely throw an error internally data is being prepared in a specific way for it to handle.

Behind the scenes BulmaJS is delegating to either `querySelector` or `getElementById` to get the element internally. It's then being wrapped in a `Bulma` instance which contains some internal methods used for our next topic... fetching plugin instances via the element.

### Fetching initialised plugins with just an element
BulmaJS is a JS library, so why couldn't some plugins be accessed and modified via Javascript? That's a good point! 0.11 is a stepping stone to providing a much more comprehensive Javascript API for all plugins. The primary stone being the ability to fetch an instance of a plugin, even if you didn't intialise it yourself. Navbar anyone?

There are a few plugins within BulmaJS which were implemented in a way that you couldn't really perform any modifications on them (not that any methods existed for that). Instead you would have to disable automatic document parsing and manually instantiate all the plugins you need, that's not very intuative.

As of 0.11 a `data` system has been implemeneted, partially inspired by how jQuery handles this. Internally, when you call `Bulma(selector)` BulmaJS will add a unique ID to the HTMLElement, this is used as a reference within the internal data store. The Javascript representation of the element will contain something like:
```javascript
{
    //...
    bulma-1589484275695: 2
    //...
}
```

So, `bulma-1589484275695` is randomly generated on every page load, and is used to help prevent any potential conflicts with other scripts on the page. `2` is this elements BulmaJS ID, which is linked to this elements internal data object. Why do I need this? You may ask.

Well, this is how BulmaJS keeps track of what data and plugin instances belong to what element. This means, no matter how you choose to get the element, it'll always return the correct data:
```javascript
let file = document.getElementById('#file');
console.log(Bulma(file).data('file')); // File {config: ConfigBag, parent: div.code-snippet.is-example,...}

let file = document.querySelector('input[name=file]');
console.log(Bulma(file).data('file')); // File {config: ConfigBag, parent: div.code-snippet.is-example,...}

let file = Bulma('#file');
console.log(file.data('file'));  // File {config: ConfigBag, parent: div.code-snippet.is-example,...}
```

This will return the full File class. Meaning you could do the following:
```javascript
let file = document.getElementById('#file');
console.log(Bulma(file).data('file').getFilename());
```

This applies to all of the internal plugins. So, do you want to disable your sticky navbar when a very particular action happens?
```javascript
if(myVeryParticularActionHappened) {
    let navbar = Bulma('.navbar');
    navbar.disableSticky();
}
```

This makes it a million times easier to interact with the plugins once the page has loaded, especially if the initialisation happens automatically, such as Navbar.

Of course, the things you can do currently are very limited. However, the plans are to massively expand the API offered for all of the plugins to dynamically adjust configuration.

---

That's the majority of the changes within 0.11. I may have missed a few small details, please post an issue on this websites Github repository if I have.

I would just like to finish by saying a massive thank you to everyone who has been using BulmaJS recently, I've been seeing the stars and downloads slowly increase and I cannot believe how many people are using it. As part of this 0.11 release I have also enabled Github Sponsors, so if you have some loose change to spare and would like to help support continued development of BulmaJS and my other projects, please consider a Github Sponsor.