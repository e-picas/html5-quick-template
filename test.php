<?php

// PHP settings not required for template usage
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
$dtmz = @date_default_timezone_get();
@date_default_timezone_set($dtmz?:'Europe/Paris');

// template file path
$html5_quick_template = __DIR__.'/html5-quick-template.html.php';

// page title
$title = 'Test title';

// page sub-title
$sub_title = 'A lorem ipsum fake content ...';

// page last update
$update = new DateTime('yesterday');

// page author
$author = '@pierowbmstr <http://github.com/pierowbmstr>';

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

// page secondaty content
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

// additional header meta tags
$metas = array(
    'robots' => 'none'
);

// additional stylesheets
$stylesheets = array();

// additional scripts
$scripts = array();

// page inline css
$css = '';

// page inline js
$js = '';

/*
$settings = array();
$settings['date_format'] = 'D-M-Y';
$settings['brand_icon'] = '<i class="fa fa-html5"></i>';
*/

require $html5_quick_template;

