<?php
/**
 * This PHP script is a test usage and demonstration page 
 * for <http://github.com/e-picas/html5-quick-template>
 *
 * To make your tests, (un)comment prepared lines of this script and 
 * reload the `test.php` file in your browser.
 */

// PHP settings not required for template usage
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
$dtmz = @date_default_timezone_get();
@date_default_timezone_set($dtmz?:'Europe/Paris');

// for this test page only, add '?type=css' for a simple stylesheet and '?type=js' for a simple script
if (!empty($_GET) && isset($_GET['type'])) {
    if ($_GET['type']=='css') {
        header('Content-Type: text/css');
        echo "body { background: #eeeeee; }";
        exit();
    } elseif ($_GET['type']=='js') {
        header('Content-Type: application/javascript');
        echo "alert('test script');";
        exit();
    }
}

####### DEMO STARTS HERE #################################################################

// template file path
$html5_quick_template = __DIR__.'/html5-quick-template.html.php';

// page title
$title = 'Test title';
// you can also define it as an array
//$title = array('Test', 'title');

// page sub-title
$sub_title = 'A lorem ipsum fake content ...';
// you can also define it as an array
//$sub_title = array('A lorem ipsum', 'fake content ...');

// page last update
$update = new DateTime('yesterday');
// you can also define it as a timestamp
//$update = filemtime(__FILE__);

// page author
$author = '@picas (http://picas.fr/)';
// you can also define it as an array
//$author = array('@picas (http://picas.fr/)', 'other author');

// page content
$content = <<<eot
<p class="lead">
Etiam accumsan metus at diam vehicula, at blandit ligula laoreet.
Donec tempus leo sit amet sodales eleifend. Cras sollicitudin eros a nisl aliquet,
vitae congue odio elementum. Nullam hendrerit fringilla porttitor.
</p>
<h2 id="title-1">Title 1</h2>
<p>Lorem ipsum dolor <strong>sit amet, consectetur adipiscing elit</strong>. Proin pulvinar dolor sit amet dui lacinia fringilla. <a href="#">Etiam ut iaculis risus.</a> Sed volutpat mi eu dictum fermentum. Nunc nec tempor metus. Pellentesque eleifend risus quis volutpat consequat. Quisque pharetra, eros at hendrerit fermentum, lectus leo tincidunt justo, eu porta felis mi ut arcu. In sagittis congue neque, sit amet blandit diam convallis quis. Aenean varius nunc eget metus suscipit rutrum. Pellentesque condimentum, nibh ac vulputate lacinia, augue nibh tristique ante, sed scelerisque magna tortor nec arcu. Etiam quis feugiat urna, quis hendrerit libero. Aliquam non dignissim elit. Maecenas non aliquam nibh. Donec tincidunt, libero vel luctus mattis, ipsum dui malesuada magna, vel scelerisque arcu nulla id lacus. Fusce aliquet, dolor non suscipit bibendum, metus nisl tincidunt lectus, ut egestas magna dolor a ligula.</p>
<p>Integer <kbd>pulvinar elementum</kbd> sem, at blandit sapien hendrerit a. Cras <em>quis imperdiet massa</em>, nec lacinia diam. Ut ultricies risus sit amet eros sodales convallis. Vivamus et semper erat. Nulla lacus magna, dapibus sed risus molestie, commodo facilisis diam. Sed quam diam, viverra congue metus in, dignissim auctor ante. Fusce blandit leo ut adipiscing bibendum. Aliquam et lorem et augue aliquam malesuada.</p>
<p>Aenean elementum nulla <abbr title="at blandit sapien hendrerit a">sapien</abbr>, quis cursus risus sodales sed. Sed nec est et enim vulputate pulvinar. Etiam sodales eros quis tincidunt cursus. Mauris consectetur lorem ut sollicitudin tincidunt. Maecenas magna risus, semper nec commodo in, sagittis in neque. Vivamus imperdiet urna at velit convallis semper. Cras eleifend rutrum dui, ut mollis eros euismod ac. Pellentesque molestie felis vel sapien malesuada auctor. Phasellus imperdiet nisl eu mi aliquam commodo. Suspendisse placerat viverra justo, vitae venenatis metus vulputate ut. Sed gravida nibh at lorem posuere, eu dignissim neque varius.</p>
<p>Donec pharetra ante eu nisi luctus, nec <code>laoreet lacus</code> vulputate. Proin arcu urna, <var>vulputate fringilla</var> purus vitae, mattis consequat lacus. Praesent nec elit et elit volutpat faucibus. Sed commodo cursus massa in convallis. Integer gravida eleifend nisl eget elementum. Morbi luctus massa nec eleifend hendrerit. Pellentesque vel lectus tellus. Aliquam in orci cursus, varius felis nec, posuere nulla. Nunc ante elit, ullamcorper ut accumsan id, interdum nec magna. Vestibulum quis purus sed erat fermentum porta. Cras elementum turpis sit amet rutrum mollis. Aenean gravida urna congue dictum suscipit. Nam feugiat convallis mattis. Donec malesuada malesuada nibh. Etiam dui nulla, lobortis ut libero ac, ultrices sodales diam. In nec orci sit amet sapien porttitor malesuada vitae non est.</p>
<pre>
Etiam accumsan metus at diam vehicula, at blandit ligula laoreet.
Donec tempus leo sit amet sodales eleifend. Cras sollicitudin eros a nisl aliquet,
vitae congue odio elementum. Nullam hendrerit fringilla porttitor.
</pre>
<p>Pellentesque sagittis, sem mollis viverra tempor, libero lacus euismod risus, <abbr title="at blandit sapien hendrerit a" class="initialism">sit amet facilisis</abbr> nulla metus non magna. Maecenas lectus risus, tincidunt in fringilla non, bibendum vitae ante. Mauris pellentesque mi et leo rutrum vulputate. Mauris sodales pellentesque nibh, quis hendrerit magna dapibus eget. Curabitur in ante arcu. Sed ac mi ligula. Cras commodo pellentesque velit id gravida. Vestibulum eget sem quis magna elementum pulvinar. Nulla vitae magna libero. Nulla sodales massa tristique orci scelerisque volutpat. </p>
<h2 id="title-2">Title 2</h2>
<h3 id="title-2-1">Title 2.1</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pulvinar dolor sit amet dui lacinia fringilla. Etiam ut iaculis risus. Sed volutpat mi eu dictum fermentum. Nunc nec tempor metus. Pellentesque eleifend risus quis volutpat consequat. Quisque pharetra, eros at hendrerit fermentum, lectus leo tincidunt justo, eu porta felis mi ut arcu. In sagittis congue neque, sit amet blandit diam convallis quis. Aenean varius nunc eget metus suscipit rutrum. Pellentesque condimentum, nibh ac vulputate lacinia, augue nibh tristique ante, sed scelerisque magna tortor nec arcu. Etiam quis feugiat urna, quis hendrerit libero. Aliquam non dignissim elit. Maecenas non aliquam nibh. Donec tincidunt, libero vel luctus mattis, ipsum dui malesuada magna, vel scelerisque arcu nulla id lacus. Fusce aliquet, dolor non suscipit bibendum, metus nisl tincidunt lectus, ut egestas magna dolor a ligula.</p>
<blockquote>
<p>Integer pulvinar elementum sem, at blandit sapien hendrerit a. Cras quis imperdiet massa, nec lacinia diam. Ut ultricies risus sit amet eros sodales convallis.</p>
<p>Vivamus et semper erat. Nulla lacus magna, dapibus sed risus molestie, commodo facilisis diam. Sed quam diam, viverra congue metus in, dignissim auctor ante. Fusce blandit leo ut adipiscing bibendum. Aliquam et lorem et augue aliquam malesuada.</p>
</blockquote>
<p>Aenean elementum nulla sapien, quis cursus risus sodales sed. Sed nec est et enim vulputate pulvinar. Etiam sodales eros quis tincidunt cursus. Mauris consectetur lorem ut sollicitudin tincidunt. Maecenas magna risus, semper nec commodo in, sagittis in neque. Vivamus imperdiet urna at velit convallis semper. Cras eleifend rutrum dui, ut mollis eros euismod ac. Pellentesque molestie felis vel sapien malesuada auctor. Phasellus imperdiet nisl eu mi aliquam commodo. Suspendisse placerat viverra justo, vitae venenatis metus vulputate ut. Sed gravida nibh at lorem posuere, eu dignissim neque varius.</p>
<p>Donec pharetra ante eu nisi luctus, nec laoreet lacus vulputate. Proin arcu urna, vulputate fringilla purus vitae, mattis consequat lacus. Praesent nec elit et elit volutpat faucibus. Sed commodo cursus massa in convallis. Integer gravida eleifend nisl eget elementum. Morbi luctus massa nec eleifend hendrerit. Pellentesque vel lectus tellus. Aliquam in orci cursus, varius felis nec, posuere nulla. Nunc ante elit, ullamcorper ut accumsan id, interdum nec magna. Vestibulum quis purus sed erat fermentum porta. Cras elementum turpis sit amet rutrum mollis. Aenean gravida urna congue dictum suscipit. Nam feugiat convallis mattis. Donec malesuada malesuada nibh. Etiam dui nulla, lobortis ut libero ac, ultrices sodales diam. In nec orci sit amet sapien porttitor malesuada vitae non est.</p>
<ul>
<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pulvinar dolor sit amet dui lacinia fringilla. Etiam ut iaculis risus. Sed volutpat mi eu dictum fermentum. Nunc nec tempor metus. Pellentesque eleifend risus quis volutpat consequat. Quisque pharetra, eros at hendrerit fermentum, lectus leo tincidunt justo, eu porta felis mi ut arcu. In sagittis congue neque, sit amet blandit diam convallis quis. Aenean varius nunc eget metus suscipit rutrum. Pellentesque condimentum, nibh ac vulputate lacinia, augue nibh tristique ante, sed scelerisque magna tortor nec arcu. Etiam quis feugiat urna, quis hendrerit libero. Aliquam non dignissim elit. Maecenas non aliquam nibh. Donec tincidunt, libero vel luctus mattis, ipsum dui malesuada magna, vel scelerisque arcu nulla id lacus. Fusce aliquet, dolor non suscipit bibendum, metus nisl tincidunt lectus, ut egestas magna dolor a ligula.</li>
<li>Integer pulvinar elementum sem, at blandit sapien hendrerit a. Cras quis imperdiet massa, nec lacinia diam. Ut ultricies risus sit amet eros sodales convallis. Vivamus et semper erat. Nulla lacus magna, dapibus sed risus molestie, commodo facilisis diam. Sed quam diam, viverra congue metus in, dignissim auctor ante. Fusce blandit leo ut adipiscing bibendum. Aliquam et lorem et augue aliquam malesuada.</li>
<li>Aenean elementum nulla sapien, quis cursus risus sodales sed. Sed nec est et enim vulputate pulvinar. Etiam sodales eros quis tincidunt cursus. Mauris consectetur lorem ut sollicitudin tincidunt. Maecenas magna risus, semper nec commodo in, sagittis in neque. Vivamus imperdiet urna at velit convallis semper. Cras eleifend rutrum dui, ut mollis eros euismod ac. Pellentesque molestie felis vel sapien malesuada auctor. Phasellus imperdiet nisl eu mi aliquam commodo. Suspendisse placerat viverra justo, vitae venenatis metus vulputate ut. Sed gravida nibh at lorem posuere, eu dignissim neque varius.</li>
</ul>
<p>Etiam accumsan metus at diam vehicula, at blandit ligula laoreet. Donec tempus leo sit amet sodales eleifend. Cras sollicitudin eros a nisl aliquet, vitae congue odio elementum. Nullam hendrerit fringilla porttitor. Pellentesque sagittis, sem mollis viverra tempor, libero lacus euismod risus, sit amet facilisis nulla metus non magna. Maecenas lectus risus, tincidunt in fringilla non, bibendum vitae ante. Mauris pellentesque mi et leo rutrum vulputate. Mauris sodales pellentesque nibh, quis hendrerit magna dapibus eget. Curabitur in ante arcu. Sed ac mi ligula. Cras commodo pellentesque velit id gravida. Vestibulum eget sem quis magna elementum pulvinar. Nulla vitae magna libero. Nulla sodales massa tristique orci scelerisque volutpat. </p>
<h3 id="title-2-2">Title 2.2</h3>
<!-- this is to test the DOM IDs management of the template -->
<a id="top"></a>
<a id="bottom"></a>
<a id="toc"></a>
<a id="notes"></a>
<a id="secondary-content-secondary-content-title"></a>
<a id="secondary-content-0"></a>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pulvinar dolor sit amet dui lacinia fringilla. Etiam ut iaculis risus. Sed volutpat mi eu dictum fermentum. Nunc nec tempor metus. Pellentesque eleifend risus quis volutpat consequat. Quisque pharetra, eros at hendrerit fermentum, lectus leo tincidunt justo, eu porta felis mi ut arcu. In sagittis congue neque, sit amet blandit diam convallis quis. Aenean varius nunc eget metus suscipit rutrum. Pellentesque condimentum, nibh ac vulputate lacinia, augue nibh tristique ante, sed scelerisque magna tortor nec arcu. Etiam quis feugiat urna, quis hendrerit libero. Aliquam non dignissim elit. Maecenas non aliquam nibh. Donec tincidunt, libero vel luctus mattis, ipsum dui malesuada magna, vel scelerisque arcu nulla id lacus. Fusce aliquet, dolor non suscipit bibendum, metus nisl tincidunt lectus, ut egestas magna dolor a ligula.</p>
<blockquote>
<p>Integer pulvinar elementum sem, at blandit sapien hendrerit a. Cras quis imperdiet massa, nec lacinia diam. Ut ultricies risus sit amet eros sodales convallis.</p>
<p>Vivamus et semper erat. Nulla lacus magna, dapibus sed risus molestie, commodo facilisis diam. Sed quam diam, viverra congue metus in, dignissim auctor ante. Fusce blandit leo ut adipiscing bibendum. Aliquam et lorem et augue aliquam malesuada.</p>
<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
</blockquote>
<p>Aenean elementum nulla sapien, quis cursus risus sodales sed. Sed nec est et enim vulputate pulvinar. Etiam sodales eros quis tincidunt cursus. Mauris consectetur lorem ut sollicitudin tincidunt. Maecenas magna risus, semper nec commodo in, sagittis in neque. Vivamus imperdiet urna at velit convallis semper. Cras eleifend rutrum dui, ut mollis eros euismod ac. Pellentesque molestie felis vel sapien malesuada auctor. Phasellus imperdiet nisl eu mi aliquam commodo. Suspendisse placerat viverra justo, vitae venenatis metus vulputate ut. Sed gravida nibh at lorem posuere, eu dignissim neque varius.</p>
<ol>
<li>Donec pharetra ante eu nisi luctus, nec laoreet lacus vulputate. Proin arcu urna, vulputate fringilla purus vitae, mattis consequat lacus. Praesent nec elit et elit volutpat faucibus. Sed commodo cursus massa in convallis. Integer gravida eleifend nisl eget elementum. Morbi luctus massa nec eleifend hendrerit. Pellentesque vel lectus tellus. Aliquam in orci cursus, varius felis nec, posuere nulla. Nunc ante elit, ullamcorper ut accumsan id, interdum nec magna. Vestibulum quis purus sed erat fermentum porta. Cras elementum turpis sit amet rutrum mollis. Aenean gravida urna congue dictum suscipit. Nam feugiat convallis mattis. Donec malesuada malesuada nibh. Etiam dui nulla, lobortis ut libero ac, ultrices sodales diam. In nec orci sit amet sapien porttitor malesuada vitae non est.</li>
<li>Etiam accumsan metus at diam vehicula, at blandit ligula laoreet. Donec tempus leo sit amet sodales eleifend. Cras sollicitudin eros a nisl aliquet, vitae congue odio elementum. Nullam hendrerit fringilla porttitor. Pellentesque sagittis, sem mollis viverra tempor, libero lacus euismod risus, sit amet facilisis nulla metus non magna. Maecenas lectus risus, tincidunt in fringilla non, bibendum vitae ante. Mauris pellentesque mi et leo rutrum vulputate. Mauris sodales pellentesque nibh, quis hendrerit magna dapibus eget. Curabitur in ante arcu. Sed ac mi ligula. Cras commodo pellentesque velit id gravida. Vestibulum eget sem quis magna elementum pulvinar. Nulla vitae magna libero. Nulla sodales massa tristique orci scelerisque volutpat. </li>
</ol>
<h3 id="title-2-3">Title 2.3</h3>
<dl>
<dt>Lorem ipsum dolor sit amet</dt>
<dd>Consectetur adipiscing elit. Proin pulvinar dolor sit amet dui lacinia fringilla. Etiam ut iaculis risus. Sed volutpat mi eu dictum fermentum. Nunc nec tempor metus. Pellentesque eleifend risus quis volutpat consequat. Quisque pharetra, eros at hendrerit fermentum, lectus leo tincidunt justo, eu porta felis mi ut arcu. In sagittis congue neque, sit amet blandit diam convallis quis. Aenean varius nunc eget metus suscipit rutrum. Pellentesque condimentum, nibh ac vulputate lacinia, augue nibh tristique ante, sed scelerisque magna tortor nec arcu. Etiam quis feugiat urna, quis hendrerit libero. Aliquam non dignissim elit. Maecenas non aliquam nibh. Donec tincidunt, libero vel luctus mattis, ipsum dui malesuada magna, vel scelerisque arcu nulla id lacus. Fusce aliquet, dolor non suscipit bibendum, metus nisl tincidunt lectus, ut egestas magna dolor a ligula.</dd>
<dt>Integer pulvinar elementum sem</dt>
<dd>At blandit sapien hendrerit a. Cras quis imperdiet massa, nec lacinia diam. Ut ultricies risus sit amet eros sodales convallis. Vivamus et semper erat. Nulla lacus magna, dapibus sed risus molestie, commodo facilisis diam. Sed quam diam, viverra congue metus in, dignissim auctor ante. Fusce blandit leo ut adipiscing bibendum. Aliquam et lorem et augue aliquam malesuada.</dd>
</dl>
<dl class="dl-horizontal">
<dt>Aenean elementum nulla sapien, quis cursus risus sodales sed</dt>
<dd>Sed nec est et enim vulputate pulvinar. Etiam sodales eros quis tincidunt cursus. Mauris consectetur lorem ut sollicitudin tincidunt. Maecenas magna risus, semper nec commodo in, sagittis in neque. Vivamus imperdiet urna at velit convallis semper. Cras eleifend rutrum dui, ut mollis eros euismod ac. Pellentesque molestie felis vel sapien malesuada auctor. Phasellus imperdiet nisl eu mi aliquam commodo. Suspendisse placerat viverra justo, vitae venenatis metus vulputate ut. Sed gravida nibh at lorem posuere, eu dignissim neque varius.</dd>
<dt>Donec pharetra ante eu nisi luctus</dt>
<dd>Nec laoreet lacus vulputate. Proin arcu urna, vulputate fringilla purus vitae, mattis consequat lacus. Praesent nec elit et elit volutpat faucibus. Sed commodo cursus massa in convallis. Integer gravida eleifend nisl eget elementum. Morbi luctus massa nec eleifend hendrerit. Pellentesque vel lectus tellus. Aliquam in orci cursus, varius felis nec, posuere nulla. Nunc ante elit, ullamcorper ut accumsan id, interdum nec magna. Vestibulum quis purus sed erat fermentum porta. Cras elementum turpis sit amet rutrum mollis. Aenean gravida urna congue dictum suscipit. Nam feugiat convallis mattis. Donec malesuada malesuada nibh. Etiam dui nulla, lobortis ut libero ac, ultrices sodales diam. In nec orci sit amet sapien porttitor malesuada vitae non est.</dd>
<dt>Etiam accumsan metus at diam vehicula</dt>
<dd>At blandit ligula laoreet. Donec tempus leo sit amet sodales eleifend. Cras sollicitudin eros a nisl aliquet, vitae congue odio elementum. Nullam hendrerit fringilla porttitor. Pellentesque sagittis, sem mollis viverra tempor, libero lacus euismod risus, sit amet facilisis nulla metus non magna. Maecenas lectus risus, tincidunt in fringilla non, bibendum vitae ante. Mauris pellentesque mi et leo rutrum vulputate. Mauris sodales pellentesque nibh, quis hendrerit magna dapibus eget. Curabitur in ante arcu. Sed ac mi ligula. Cras commodo pellentesque velit id gravida. Vestibulum eget sem quis magna elementum pulvinar. Nulla vitae magna libero. Nulla sodales massa tristique orci scelerisque volutpat. </dd>
</dl>
<h2 id="title-3">Title 3</h2>
<table class="table table-striped">
<thead>
<tr>
  <th>#</th>
  <th>First Name</th>
  <th>Last Name</th>
  <th>Username</th>
</tr>
</thead>
<tbody>
<tr>
  <td>1</td>
  <td>Mark</td>
  <td>Otto</td>
  <td>@mdo</td>
</tr>
<tr>
  <td>2</td>
  <td>Jacob</td>
  <td>Thornton</td>
  <td>@fat</td>
</tr>
<tr>
  <td>3</td>
  <td>Larry</td>
  <td>the Bird</td>
  <td>@twitter</td>
</tr>
</tbody>
</table>
eot;
// you can also define your content as an array (indexes will be ignored)
/*
$content = array(
    '[1] Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    'test-index' => '[2] Proin pulvinar dolor sit amet dui lacinia fringilla. Etiam ut iaculis risus. Sed volutpat mi eu dictum fermentum. Nunc nec tempor metus. Pellentesque eleifend risus quis volutpat consequat. Quisque pharetra, eros at hendrerit fermentum, lectus leo tincidunt justo, eu porta felis mi ut arcu. In sagittis congue neque, sit amet blandit diam convallis quis. Aenean varius nunc eget metus suscipit rutrum. Pellentesque condimentum, nibh ac vulputate lacinia, augue nibh tristique ante, sed scelerisque magna tortor nec arcu. Etiam quis feugiat urna, quis hendrerit libero. Aliquam non dignissim elit. Maecenas non aliquam nibh. Donec tincidunt, libero vel luctus mattis, ipsum dui malesuada magna, vel scelerisque arcu nulla id lacus. Fusce aliquet, dolor non suscipit bibendum, metus nisl tincidunt lectus, ut egestas magna dolor a ligula.',
);
//*/

// page table of contents
$toc = array(
    'title-1' => 'Title 1',
    'title-2' => array(
        'title-2-1' => 'Title 2.1',
        'title-2-2' => 'Title 2.2',
        'title-2-3'
    ),
    'title-3'
);

// content notes
$notes = array(
    'note-1' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    'note-2' => 'Proin pulvinar dolor sit amet dui lacinia fringilla. Etiam ut iaculis risus. Sed volutpat mi eu dictum fermentum. Nunc nec tempor metus. Pellentesque eleifend risus quis volutpat consequat. Quisque pharetra, eros at hendrerit fermentum, lectus leo tincidunt justo, eu porta felis mi ut arcu. In sagittis congue neque, sit amet blandit diam convallis quis. Aenean varius nunc eget metus suscipit rutrum. Pellentesque condimentum, nibh ac vulputate lacinia, augue nibh tristique ante, sed scelerisque magna tortor nec arcu. Etiam quis feugiat urna, quis hendrerit libero. Aliquam non dignissim elit. Maecenas non aliquam nibh. Donec tincidunt, libero vel luctus mattis, ipsum dui malesuada magna, vel scelerisque arcu nulla id lacus. Fusce aliquet, dolor non suscipit bibendum, metus nisl tincidunt lectus, ut egestas magna dolor a ligula.',
);
// you can also define a simple string
//$notes = 'One single footnote.';

// page secondary content
$secondary_contents = array(
    'secondary content title'=>'
<p>Aenean elementum nulla <abbr title="at blandit sapien hendrerit a">sapien</abbr>, quis cursus risus sodales sed. Sed nec est et enim vulputate pulvinar. Etiam sodales eros quis tincidunt cursus. Mauris consectetur lorem ut sollicitudin tincidunt. Maecenas magna risus, semper nec commodo in, sagittis in neque. Vivamus imperdiet urna at velit convallis semper. Cras eleifend rutrum dui, ut mollis eros euismod ac. Pellentesque molestie felis vel sapien malesuada auctor. Phasellus imperdiet nisl eu mi aliquam commodo. Suspendisse placerat viverra justo, vitae venenatis metus vulputate ut. Sed gravida nibh at lorem posuere, eu dignissim neque varius.</p>
<p>Pellentesque sagittis, sem mollis viverra tempor, libero lacus euismod risus, <abbr title="at blandit sapien hendrerit a" class="initialism">sit amet facilisis</abbr> nulla metus non magna. Maecenas lectus risus, tincidunt in fringilla non, bibendum vitae ante. Mauris pellentesque mi et leo rutrum vulputate. Mauris sodales pellentesque nibh, quis hendrerit magna dapibus eget. Curabitur in ante arcu. Sed ac mi ligula. Cras commodo pellentesque velit id gravida. Vestibulum eget sem quis magna elementum pulvinar. Nulla vitae magna libero. Nulla sodales massa tristique orci scelerisque volutpat. </p>
<p>Donec pharetra ante eu nisi luctus, nec <code>laoreet lacus</code> vulputate. Proin arcu urna, vulputate fringilla purus vitae, mattis consequat lacus. Praesent nec elit et elit volutpat faucibus. Sed commodo cursus massa in convallis. Integer gravida eleifend nisl eget elementum. Morbi luctus massa nec eleifend hendrerit. Pellentesque vel lectus tellus. Aliquam in orci cursus, varius felis nec, posuere nulla. Nunc ante elit, ullamcorper ut accumsan id, interdum nec magna. Vestibulum quis purus sed erat fermentum porta. Cras elementum turpis sit amet rutrum mollis. Aenean gravida urna congue dictum suscipit. Nam feugiat convallis mattis. Donec malesuada malesuada nibh. Etiam dui nulla, lobortis ut libero ac, ultrices sodales diam. In nec orci sit amet sapien porttitor malesuada vitae non est.</p>
<p>Lorem ipsum dolor <strong>sit amet, consectetur adipiscing elit</strong>. Proin pulvinar dolor sit amet dui lacinia fringilla. <a href="#">Etiam ut iaculis risus.</a> Sed volutpat mi eu dictum fermentum. Nunc nec tempor metus. Pellentesque eleifend risus quis volutpat consequat. Quisque pharetra, eros at hendrerit fermentum, lectus leo tincidunt justo, eu porta felis mi ut arcu. In sagittis congue neque, sit amet blandit diam convallis quis. Aenean varius nunc eget metus suscipit rutrum. Pellentesque condimentum, nibh ac vulputate lacinia, augue nibh tristique ante, sed scelerisque magna tortor nec arcu. Etiam quis feugiat urna, quis hendrerit libero. Aliquam non dignissim elit. Maecenas non aliquam nibh. Donec tincidunt, libero vel luctus mattis, ipsum dui malesuada magna, vel scelerisque arcu nulla id lacus. Fusce aliquet, dolor non suscipit bibendum, metus nisl tincidunt lectus, ut egestas magna dolor a ligula.</p>
    ',
    '
<h2 id="secondary-2">Secondary 2</h2>
<p>Aenean elementum nulla <abbr title="at blandit sapien hendrerit a">sapien</abbr>, quis cursus risus sodales sed. Sed nec est et enim vulputate pulvinar. Etiam sodales eros quis tincidunt cursus. Mauris consectetur lorem ut sollicitudin tincidunt. Maecenas magna risus, semper nec commodo in, sagittis in neque. Vivamus imperdiet urna at velit convallis semper. Cras eleifend rutrum dui, ut mollis eros euismod ac. Pellentesque molestie felis vel sapien malesuada auctor. Phasellus imperdiet nisl eu mi aliquam commodo. Suspendisse placerat viverra justo, vitae venenatis metus vulputate ut. Sed gravida nibh at lorem posuere, eu dignissim neque varius.</p>
<p>Pellentesque sagittis, sem mollis viverra tempor, libero lacus euismod risus, <abbr title="at blandit sapien hendrerit a" class="initialism">sit amet facilisis</abbr> nulla metus non magna. Maecenas lectus risus, tincidunt in fringilla non, bibendum vitae ante. Mauris pellentesque mi et leo rutrum vulputate. Mauris sodales pellentesque nibh, quis hendrerit magna dapibus eget. Curabitur in ante arcu. Sed ac mi ligula. Cras commodo pellentesque velit id gravida. Vestibulum eget sem quis magna elementum pulvinar. Nulla vitae magna libero. Nulla sodales massa tristique orci scelerisque volutpat. </p>
    ',
);
// you can define a simple string that will be rendered as a single item array
//$secondary_contents = '<p>Aenean elementum nulla <abbr title="at blandit sapien hendrerit a">sapien</abbr>, quis cursus risus sodales sed. Sed nec est et enim vulputate pulvinar. Etiam sodales eros quis tincidunt cursus. Mauris consectetur lorem ut sollicitudin tincidunt. Maecenas magna risus, semper nec commodo in, sagittis in neque. Vivamus imperdiet urna at velit convallis semper. Cras eleifend rutrum dui, ut mollis eros euismod ac. Pellentesque molestie felis vel sapien malesuada auctor. Phasellus imperdiet nisl eu mi aliquam commodo. Suspendisse placerat viverra justo, vitae venenatis metus vulputate ut. Sed gravida nibh at lorem posuere, eu dignissim neque varius.</p>';

// additional header meta tags
$metas = array(
    'robots' => 'none'
);
// you can also define a simple string
//$metas = '<meta name="robots" content="none">';

// additional stylesheets
//$stylesheets = array( '?type=css' );
// you can also define a simple string
//$stylesheets = '<link href="?type=css" rel="stylesheet">';

// additional scripts
//$scripts = array( '?type=js' );
// you can also define a simple string
//$scripts = '<script src="?type=js"></script>';

// page inline css
//$css = 'body { background-color: #eeeeee; }';

// page inline js
//$js = 'alert("test inline script");';

// content notice info
$content_notice = 'This is a notice (short info) about the content.';
// you can also define it as an array
//$content_notice = array('This is a notice (short info) about the content.', 'Second notice ...');

// page notice info
$page_notice = 'Contents are licensed under the <strong>unknown</strong> license.';
// you can also define it as an array
//$page_notice = array('Contents are licensed under the <strong>unknown</strong> license.', 'Second notice ...');

// settings overwrites
/*
$settings = array();
$settings['app_mode'] = 'dev';
//$settings['profiler_mode'] = 'on';
//$settings['direction'] = 'rtl';
$settings['date_format'] = 'D-M-Y';
$settings['brand_icon'] = '<i class="fa fa-html5"></i>';
$settings['navbar_items'] = array('toc', 'top', 'bottom', 'summary');
$settings['profiler_stack'] = array(
    'profiler-request' => function() {
            return '<a id="' . hqt_internalid('profiler-request') . '" class="insert-request"></a>';
        },
    'profiler_apps' => function() { return HQT_NAME.' '.HQT_VERSION; },
    'profiler_date' => date('c') . ' (' . @date_default_timezone_get() . ')',
    'profiler-user-agent' => '',
);
$settings['profiler_user_stack'] = 'test';
$settings['language_strings'] = array();
$settings['language_strings']['notes_block_header'] = 'Content Notes';
//*/

// uncomment this block to test all values setted on `$test_val` below
/*
$test_val = null;
//$test_val = false;
//$test_val = '';
$title = $sub_title = $update = $author = $content = $toc = $notes = $secondary_contents = $metas = $stylesheets = $scripts = $css = $js = $content_notice = $page_notice = $test_val;
//*/

// uncomment this block to test a constant menu in the navbar
/*
$menu = array(
    array('url'=>'http://test.com/', 'title'=>'Test menu item', 'content'=>'Test 1'),
    array('url'=>'http://test.com/', 'title'=>'Test menu item', 'content'=>'Test 2'),
);
//*/

// uncomment this block to test a constant menu in the navbar including sub-menu
//*
$menu = array(
    array('url'=>'http://test.com/', 'title'=>'Test menu item', 'content'=>'Test 1'),
    array('url'=>'http://test.com/', 'title'=>'Test menu item', 'content'=>'Test 2',
    'items'=>array(
        array('url'=>'http://test.com/', 'title'=>'Test sub-menu item', 'content'=>'Test 1'),
        array('url'=>'http://test.com/', 'title'=>'Test sub-menu item', 'content'=>'Test 2'),
    )),
);
//*/

// uncomment this line to test a 'self' custom URL for page refresh
//$self = 'http://test.com/';

// inclusion of the template
require $html5_quick_template;

// that's it (the HTML page may already be rendered)
