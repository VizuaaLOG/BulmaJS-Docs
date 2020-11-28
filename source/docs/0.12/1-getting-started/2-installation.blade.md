---
extends: _layouts.docs
title: Installation
category: 'Getting Started'
section: body
version: '0.12'
next:
    - Usage
    - ../3-usage
prev:
    - Introduction
    - ../1-introduction
---

Installing BulmaJS couldn't easier. There are two ways to install BulmaJS in your project. The first is using the recommended ES6 way and the not-recommended pre-compiled way.

## Install using ES6
The recommended way to install and use BulmaJS is by pulling it in via NPM:

```bash
npm install --save-dev @vizuaalog/bulmajs
```

Once BulmaJS has been downloaded you can now include it in your project. Within your un-compiled ES6 Javascript source you can include all of BulmaJS or only the plugins you need.

```javascript
// All of bulma
import Bulma from '@vizuaalog/bulmajs';

// Only the plugins you need
import Navbar from '@vizuaalog/bulmajs/src/plugins/navbar';
```

That's it! BulmaJS is now ready and working in your project. If you have any problems getting BulmaJS working in your project, please open an issue on [Github]({{ $page->github_issues_url }}).

## Install using ES5
This method is not recommended due to the lack of flexibility, however, for quick prototyping, it will be the quickest.

First, you need to download the repository as a zip. The easiest way to do that is to [click this link](https://github.com/VizuaaLOG/BulmaJS/archive/master.zip). This will download the latest 'master' version of BulmaJS, do note, this may have bugs. If you would prefer to use a released version then visit the [releases](https://github.com/VizuaaLOG/BulmaJS/releases) section on Github.

You can then include one of the files in the `dist` folder.

```html
<!-- All of BulmaJS -->
<script src="path/to/the/downloaded/folder/dist/bulma.js"></script>

<!-- Single plugins -->
<script src="path/to/the/downloaded/folder/dist/navbar.js"></script>
```

@notification(['level' => 'info'])
    Using this method and including multiple single plugins will include the core multiple times. This may cause conflicts and will increase the download size. To include multiple singular plugins it is best to use the ES6 installation method.
@endnotification