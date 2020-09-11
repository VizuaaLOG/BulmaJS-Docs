---
extends: _layouts.docs
title: Navbar
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
next:
    - Notification
    - ../notification
prev:
    - Modal
    - ../modal
---

The navbar plugin provides a range of different functionality for the Bulma navbar. By simply including the plugin you'll get the mobile navigation functionality, no configuration is required.

An example of this plugin is being used on this documentation!

## Dropdown support
@tag(['type' => 'new', 'since' => '0.12'])@endtag
Bulma has support for dropdowns within the navbar component, these can optionally have the `is-hoverable` class. However, if you would instead like the dropdowns to be toggled via a mouse click the Navbar plugin will automatically detect these and enable the click toggling.

@snippet(['example' => true, 'language' => 'html'])
<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="/">
            <img src="/assets/images/bulmajs-logo-white.svg" width="112" height="28">
        </a>

        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
            data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item">
                Home
            </a>

            <a class="navbar-item">
                Documentation
            </a>

            <div class="navbar-item has-dropdown">
                <a class="navbar-link">
                    More
                </a>

                <div class="navbar-dropdown">
                    <a class="navbar-item">
                        About
                    </a>
                    <a class="navbar-item">
                        Jobs
                    </a>
                    <a class="navbar-item">
                        Contact
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item">
                        Report an issue
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
@endsnippet

## Sticky navbar
Since 0.6.1 Bulma has provided a `is-fixed-top` class for the navbar, along with `has-navbar-fixed-top` for the html/body elements. This allows you to fix the navbar to the top of the page when scrolling. However, what if your navbar is not directly at the top? You need to be able to offset the sticky feature.

Since `0.7.0` BulmaJS has provided the functionality to do just this! First, specify the `data-sticky` attribute on your navbar. This will enable the event listener for scroll, by default the offset is set to `0` which does nothing extra than just adding the class to the element.

You can control the offset of the navbar using `data-sticky-offset` this access a number and is the number of pixels the user needs to scroll before the navbar sticks to the top.

You can also add `data-sticky-shadow` to your navbar element, this will add the `has-shadow` class to the navbar when it becomes sticky.

If you ever need to dynamically enable/disable a navbar's sticky state, you can do so by using the `enableSticky` and `disableSticky` methods.

@snippet(['example' => false, 'language' => 'javascript'])
let navbar = Bulma('.navbar').data('navbar');
navbar.enableSticky();
navbar.disableSticky();
@endsnippet

## Hide the navbar when scrolling
It can sometimes be useful to hide the navbar when your user is scrolling down, and then show it again when scrolling up. As of `0.7.0` the navbar plugin provides this functionality. To enable it, add the `data-hide-on-scroll` attribute to your navbar element. Do note this also needs `data-sticky` to be enabled as well.

You can specify the `tolerance` before the navbar is hidden/shown by adding a `data-tolerance` attribute. This accepts an integer and is the number of pixels between each scroll event. I.e. the 'force' required to hide/show the navbar.

When the navbar is hidden the `is-hidden-scroll` class is added to it, allowing you to detect this via CSS and hide the navbar. This also allows you to add CSS animations. An example implemention would be:

```css
.navbar {
    transform: translateY(0);
    transition: transform 0.2s ease-in-out;
}

.navbar.is-hidden-scroll {
    transform: translateY(-100%);
}
```

If you ever need to dynamically enable/disable a navbar's hide when scrolling state, you can do so by using the `enableHideOnScroll` and `disableHideOnScroll` methods.

@snippet(['example' => false, 'language' => 'javascript'])
let navbar = Bulma('.navbar').data('navbar');
navbar.enableHideOnScroll();
navbar.disableHideOnScroll();
@endsnippet