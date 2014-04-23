html5-quick-template
====================

A simple blank HTML5 template for quick rendering.

## Usage

### Basic usage

To use the template file, just define some simple variables and include the template:

    <?php

    // page title
    $title = 'Test title';

    // page content
    $content = <<<eot
    Etiam accumsan metus at diam vehicula, at blandit ligula laoreet.
    Donec tempus leo sit amet sodales eleifend. Cras sollicitudin eros a nisl aliquet,
    vitae congue odio elementum. Nullam hendrerit fringilla porttitor.
    eot;

    // include the template
    require '/path/to/html5-quick-template.html.php';

    ?>

Please see the source of the `test.php` file for a full example. The complete list of variables
to be (eventually) defined can be found in the `USER VARIABLES` part of the `html5-quick-template.html.php`
source file.

### Advanced usage

You can overwrite the internal settings defining a `$settings` array in your script, with
all default settings entries or part of them. Please see the `SETTINGS` part in the `html5-quick-template.html.php`
source file for a full list.

## Key features

-   template built with [Bootstrap](http://getbootstrap.com/), [jQuery](http://jquery.com/)
    and [Font Awesome](http://fortawesome.github.io/Font-Awesome)
-   inclusion of libraries from a CDN (no local requirements)
-   default Bootstrap layout: fixed navbar on top and responsive page
-   printers friendly
-   search in page with highlight and count of results (3 cars. min)
-   use `TAB` key to select search field and `ESC` key to clear current search

## Author & infos

This (*small*) work is authored and maintained by [@pierowbmstr](http://github.com/pierowbmstr)
and licensed under an [Apache 2.0 license](http://www.apache.org/licenses/LICENSE-2.0.html). To
propose modifications or tell about a bug, please create a ticket or a fork of the sources
repository at <http://github.com/pierowbmstr/html5-quick-template>.
