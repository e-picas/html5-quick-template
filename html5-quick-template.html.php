<?php
/**
 * HTML5 Quick Template - A simple blank HTML5 template for quick rendering
 * <http://github.com/pierowbmstr/html5-quick-template>
 * Copyright 2014 PieroWbmstr <http://github.com/pierowbmstr>
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// debug
//error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 1);

// set a default timezone to avoid PHP5 warnings
$dtmz = @date_default_timezone_get();
@date_default_timezone_set($dtmz?:'Europe/London');

/**
 * @var array   Default settings
 * You can overwrite each entry or all of them defining a `$settings` array
 */
$default_settings = array(
    // list of characters replaced by a space when transforming a string
    'string_spacify' => array('-', '_'),
    // list of characters striped when transforming a string
    'string_strip' => array(),
    // length of introductions or extracts of contents
    'intro_length' => 80,
    // date time format mask
    'date_format' => 'd M Y H:i:s',
    // mask used for additional meta tags
    'mask_meta' => '<meta name="%s" content="%s">',
    // mask used for additional stylesheets
    'mask_stylesheet' => '<link href="%s" rel="stylesheet">',
    // mask used for additional scripts
    'mask_scripts' => '<script src="%s"></script>',
    // mask used to build global table of contents list
    'mask_toc_list' => '<ul>%s</ul>',
    // mask used to build each table of contents list item
    'mask_toc_list_item' => '<li>%s</li>',
    // mask used to build the content of each table of contents list item
    'mask_toc_list_item_content' => '<a href="#%s">%s</a>',
    // mask used to build global notes list
    'mask_notes_list' => '<ol>%s</ol>',
    // mask used to build each notes list item
    'mask_notes_list_item' => '<li id="%s">%s</li>',
    // mask used to build the content string of each notes list item
    'mask_notes_list_item_content' => '%s',

    // jQuery 1.11.0 <http://jquery.com/>
    'jquery_script' => "//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js",
    // Bootstrap 3.1.1 <http://getbootstrap.com/>
    'bootstrap_script' => "//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js",
    'bootstrap_stylesheet' => "//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css",
    // Font Awesome 4.0.3 <http://fortawesome.github.io/Font-Awesome>
    'icons_stylesheet' => "//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css",
);

/**
 * @var    string    The page title
 */
if (!isset($title)) $title = '';

/**
 * @var    string    The page sub-title
 */
if (!isset($sub_title)) $sub_title = '';

/**
 * @var    string    The author of the content
 */
if (!isset($author)) $author = '';

/**
 * @var    string|DateTime    The page last update date
 */
if (!isset($update)) $update = null;

/**
 * @var    string    The page content
 */
if (!isset($content)) $content = '';

/**
 * @var    string|array    The page content footnotes like `id => note content` or as a raw string
 */
if (!isset($notes)) $notes = array();

/**
 * @var    string|array    The page secondary contents list or string, you can use a 'meaningfull' index
 */
if (!isset($secondary_contents)) $secondary_contents = array();
if (!is_array($secondary_contents)) $secondary_contents = array( $secondary_contents );

/**
 * @var    string|array    The page table of contents like `id => title` or `id => items`
 *                         with items like `id => title` or as a raw string
 */
if (!isset($toc)) $toc = array();

/**
 * @var    array    The page content additional meta tags like `name => value`
 */
if (!isset($metas)) $metas = array();

/**
 * @var    string|array    The page additional stylsheets `src` list
 */
if (!isset($stylesheets)) $stylesheets = array();

/**
 * @var    string|array    The page additional scripts `src` list
 */
if (!isset($scripts)) $scripts = array();

/**
 * @var    string    The page inline css rules written last
 */
if (!isset($css)) $css = '';

/**
 * @var    string    The page inline javascript code executed after all scripts load
 */
if (!isset($js)) $js = '';

/**
 * @var    string    The header link to the repo
 */
if (!isset($repo_url)) $repo_url = 'http://github.com/atelierspierrot/html5-quick-template';

/**
 * @var    string    The header link to the repo icon (see <http://fortawesome.github.io/Font-Awesome/icons/#brand>)
 */
if (!isset($repo_icon)) $repo_icon = 'fa-github';

/**
 * @var    string    The header link to the repo title
 */
if (!isset($repo_title)) $repo_title = 'For the repo on gihub';

/**
 * @var    array    The user settings overwriting the `$default_settings`
 */
if (!isset($settings)) $settings = array();
if (!is_array($settings)) $settings = array( $settings );

/**
 * Prepare the `hqt_settings` env vars
 *
 * @param   array   $defaults   The default settings array
 * @param   array   $options    The user settings array
 * @global  array   $hqt_settings
 * @global  string  $hqt_name
 * @global  string  $hqt_url
 * @global  string  $hqt_version
 * @return  void
 */
function prepare($defaults = array(), $options = array())
{
    global $hqt_settings, $hqt_name, $hqt_url, $hqt_version;
    $hqt_settings = array_merge($defaults, $options);
    $hqt_name = 'html5-quick-template';
    $hqt_url = 'http://github.com/pierowbmstr/html5-quick-template';
    $hqt_version = '1.0.0';
}

/**
 * Returns a safe string passing it in `$mask` with `sprintf()` and transforming it if `$transform===true`
 * 
 * @param    misc    $what        The original content to stringify
 * @param    string  $mask        The mask to use to build the content
 * @param    bool    $readable    Make a readable content or not (default is NOT)
 * @return   string
 */
function safely($what, $mask = '%s', $readable = false)
{
    global $hqt_settings;
    $str = '';
    if (is_array($what)) {
        foreach ($what as $var=>$val) {
            $valnum = substr_count($mask, '%s');
            $str .= ($valnum > 1) ? sprintf($mask, $var, $val) : sprintf($mask, $val);
        }
    } elseif (is_object($what)) {
        if ($what instanceof DateTime) {
            $str .= sprintf($mask, $what->format($hqt_settings['date_format']));
        }
    } elseif (is_string($what)) {
        $str .= sprintf($mask, $what);
        if ($readable===true) {
            $str = str_replace($hqt_settings['string_spacify'], ' ', $str);
            $str = str_replace($hqt_settings['string_strip'], '', $str);
            $str = ucfirst($str);
        }
    }
    return $str; 
}

/**
 * Returns a safe string extracted from original
 * 
 * @param    misc    $what        The original content to stringify
 * @return   string
 */
function intro($what)
{
    global $hqt_settings;
    $str = substr(safely($what), 0, $hqt_settings['intro_length']);
    return htmlentities(strip_tags($str));
}

/**
 * Build a table of contents from an array of items
 * 
 * @param    array    $toc    The contents array like `id => title` or `id => items` with `items` constructed like `$toc`
 * @return   string
 */
function make_toc($toc)
{
    global $hqt_settings;
    $str = '';
    if (is_array($toc)) {
        foreach ($toc as $var=>$val) { 
            if (!is_string($var) && is_string($val)) { $var = $val; }
            if (is_array($val)) {
                $str .= sprintf(
                    $hqt_settings['mask_toc_list_item'], 
                    sprintf($hqt_settings['mask_toc_list_item_content'], safely($var), safely($var, '%s', true)) . make_toc($val)
                );
            } else {
                $str .= sprintf(
                    $hqt_settings['mask_toc_list_item'], 
                    sprintf($hqt_settings['mask_toc_list_item_content'], safely($var), safely($val, '%s', true))
                );
            }
        }
        $str = sprintf($hqt_settings['mask_toc_list'], $str);
    } else {
        $str = safely($toc);
    }
    return $str;
}

/**
 * Build a list of notes from an array of items
 * 
 * @param    array    $notes    The notes array like `id => info`
 * @return   string
 */
function make_notes($notes)
{
    global $hqt_settings;
    $str = '';
    if (is_array($notes)) {
        foreach ($notes as $var=>$val) { 
            if (!is_string($var) && is_string($val)) { $var = $val; }
            $str .= sprintf(
                $hqt_settings['mask_notes_list_item'],
                safely($var),
                safely($val, $hqt_settings['mask_notes_list_item_content'], true)
            );
        }
        $str = sprintf($hqt_settings['mask_notes_list'], $str);
    } else {
        $str = safely($notes);
    }
    return $str;
}

// rendering
prepare($default_settings, $settings);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="en">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo $hqt_settings['bootstrap_stylesheet']; ?>" rel="stylesheet">
    <link href="<?php echo $hqt_settings['icons_stylesheet']; ?>" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title><?php echo safely($title); ?></title>
<?php if (!empty($sub_title)) : ?>
    <meta name="description" content="<?php echo safely($sub_title); ?>">
<?php endif; ?>
<?php if (!empty($author)) : ?>
    <meta name="author" content="<?php echo safely($author); ?>">
<?php endif; ?>
    <style>
    body        { padding-top: 70px; }
    .navbar .container { width: 100%; }
    .wrapper    { padding-bottom: 20px; }
    aside       { margin: 12px; padding: 12px 20px; border-radius: 6px; max-width: 20%; }
    aside#secondary-contents { margin: 15px 20px; padding: 0; position: relative; }
    .secondary-content       { margin: 2px; padding: 15px; border-radius: 4px; }
    .handler a  { color: #777777; }
    aside ul    { padding-left: 22px; }
    .footer     { background-color: #f5f5f5; color: #333333; padding: 12px; border-radius: 6px; position: relative; }
    h3          { padding-left: .5em; }
    h4:not([id="toc"]) { padding-left: 1em; }
    h5          { padding-left: 2em; }
    h6          { padding-left: 3em; }
    .footnotes  { font-size: .9em; }
    .highlight  { background : #ff0; }
    .bg-info    { background-color: #D9EDF7; }
    .bg-default { background-color: #f5f5f5; }
    form.navbar-form    { position: relative; }
    .navbar-form.navbar-right:last-child { margin-right: 0px; }
    input#search        { padding-right: 24px; }
    span#delete-search  { position: absolute; display: block; top: 10px; right: 24px; z-index: 100; cursor: pointer; }
    @media (max-width: 767px) {
        aside               { max-width: 100%; }
        aside#secondary-contents { margin: 10px; }
        .secondary-content       { display: block; min-width: 100%; }
        span#delete-search  { top: 40px; }
        .responsive { width: 100%; overflow: auto; }
    }
    </style>
<?php echo safely($metas, $hqt_settings['mask_meta']); ?>
<?php echo safely($stylesheets, $hqt_settings['mask_stylesheet']); ?>
<style>
<?php echo safely($css); ?>
</style>
</head>
<body data-offset="70">
    <!--[if lt IE 7]>
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>Warning!</strong> You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.
    </div>
    <![endif]-->
    <a id="top"></a>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=""><?php echo safely($title); ?></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
<?php if (!empty($toc)) : ?>
                    <li><a href="#toc" title="reach the table of contents"><i class="fa fa-angle-left"></i>&nbsp;Table of Contents</a></li>
<?php endif; ?>
<?php if (!empty($notes)) : ?>
                    <li><a href="#notes" title="reach the notes of the content"><i class="fa fa-angle-right"></i>&nbsp;Footnotes</a></li>
<?php endif; ?>
                    <li><a href="#top" title="reach the top of the page"><i class="fa fa-angle-up"></i>&nbsp;Top</a></li>
                    <li><a href="#bottom" title="reach the bottom of the page"><i class="fa fa-angle-down"></i>&nbsp;Bottom</a></li>
<?php if (!empty($secondary_contents)) : ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Infos <b class="caret"></b></a>
                        <ul class="dropdown-menu">
    <?php foreach ($secondary_contents as $i => $_item) : $id = safely((string) $i); ?>
                            <li><a href="#secondary-content-<?php echo $id; ?>" title="<?php echo intro($_item); ?>"><?php echo safely($id, '%s', true); ?></a></li>
    <?php endforeach; ?>
                        </ul>
                    </li>
<?php endif; ?>
                    <li class="active"><a title="<?php echo safely($repo_title); ?>" href="<?php echo safely($repo_url); ?>">&nbsp;<i class="fa <?php echo safely($repo_icon); ?>"></i>&nbsp;</a></li>
                </ul>
                <form class="navbar-form navbar-right" role="search">
                    <span id="result-count" class="text-primary"></span>&nbsp;
                    <input id="search-field" class="form-control" type="search" tabindex="1" placeholder="search ..." title="in-page highlighting search field">
                    <span id="delete-search" class="text-primary fa fa-spinner hidden" title="clear search field [ESC]"></span>
                </form>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wrapper container-fluid">
<?php if (!empty($secondary_contents)) : ?>
        <aside id="secondary-contents" class="pull-right">
    <?php foreach ($secondary_contents as $i => $_item) : $id = safely((string) $i); ?>
            <div class="secondary-content bg-default">
                <p class="text-muted handler"><a data-toggle="collapse" data-parent="#secondary-contents" href="#secondary-content-<?php echo $id; ?>" onClick="$(this).find('i').toggleClass('fa-angle-up').toggleClass('fa-angle-down');" title="show / hide this content block"><i class="fa fa-angle-up"></i>&nbsp;show / hide</a></p>
                <div id="secondary-content-<?php echo $id; ?>" class="collapse in">
                    <?php if ($id != (string) $i) : ?><h4 id="<?php echo $id; ?>"><?php echo safely($id, '%s', true); ?></h4><?php endif; ?>
                    <?php echo make_toc($_item); ?>
                </div>
            </div>
    <?php endforeach; ?>
        </aside>
        <div class="clearfix visible-xs"></div>
<?php endif; ?>
        <article>
            <header>
                <h1><?php echo safely($title); ?> <small><?php echo safely($sub_title); ?></small></h1>
            </header>
<?php if (!empty($toc)) : ?>
            <aside role="navigation" class="bg-info <?php echo (!empty($secondary_contents)) ? 'pull-left' : 'pull-right'; ?> hidden-print">
                <h4 id="toc">Table of contents</h4>
                <?php echo make_toc($toc); ?>
            </aside>
            <div class="clearfix visible-xs"></div>
<?php endif; ?>
            <?php echo safely($content); ?>
<?php if (!empty($notes)) : ?>
            <hr />
            <footer>
                <div class="footnotes">
                    <h4 id="notes">Notes</h4>
                    <?php echo make_notes($notes); ?>
                </div>
            </footer>
<?php endif; ?>
<?php if (!empty($author) || !empty($update)) : ?>
            <hr />
            <footer class="text-right text-muted"><small><p>
    <?php if (!empty($author)) : ?>
                Content authored by <?php echo safely($author); ?>.&nbsp;
    <?php endif; ?>
    <?php if (!empty($update)) : ?>
                Last update of this content at <?php echo safely($update); ?>.&nbsp;
    <?php endif; ?>
            </p></small></footer>
<?php endif; ?>
        </article>
        <footer>
            <div class="footer">
                <div class="pull-right text-right"><small>
                    Page generated from an <a href="<?php echo safely($hqt_url); ?>" title="<?php echo safely($hqt_name); ?> <?php echo safely($hqt_version); ?>"><?php echo safely($hqt_name); ?></a>.
                    <br>
                    Page built with the help of open source stuff such as 
                    <a href="http://jquery.com/" title="jquery.com">jQuery</a>, 
                    <a href="http://getbootstrap.com/" title="getbootstrap.com">Bootstrap</a> and 
                    <a href="http://fortawesome.github.io/Font-Awesome" title="fortawesome.github.io/Font-Awesome">Font Awesome</a>.
                </small></div>
                <div class="pull-left responsive"><small>
                    <span class="label label-default"><?php echo date($hqt_settings['date_format']); ?></span>
                    <br>
                    <span class="label label-default" id="user-agent"></span>
                    <br>
                    <span class="label label-default"><?php echo php_uname(); ?></span>
                </small></div>
                <div class="clearfix"></div>
            </div>
        </footer>
    </div>
    <div class="clearfix"></div>
    <a id="bottom"></a>
    <script src="<?php echo $hqt_settings['jquery_script']; ?>"></script>
    <script src="<?php echo $hqt_settings['bootstrap_script']; ?>"></script>
    <script>
/*
highlight v4 - Highlights arbitrary terms - MIT license - Johann Burkard
<http://johannburkard.de/blog/programming/javascript/highlight-javascript-text-higlighting-jquery-plugin.html>
*/
jQuery.fn.highlight=function(c){function e(b,c){var d=0;if(3==b.nodeType){var a=b.data.toUpperCase().indexOf(c);if(0<=a){d=document.createElement("span");d.className="highlight";a=b.splitText(a);a.splitText(c.length);var f=a.cloneNode(!0);d.appendChild(f);a.parentNode.replaceChild(d,a);d=1}}else if(1==b.nodeType&&b.childNodes&&!/(script|style)/i.test(b.tagName))for(a=0;a<b.childNodes.length;++a)a+=e(b.childNodes[a],c);return d}return this.length&&c&&c.length?this.each(function(){e(this,c.toUpperCase())}): this};jQuery.fn.removeHighlight=function(){return this.find("span.highlight").each(function(){this.parentNode.firstChild.nodeName;with(this.parentNode)replaceChild(this.firstChild,this),normalize()}).end()};

$(function() {
    function clearSearchField() {
        $("#search-field").val("");
        $("#delete-search").addClass("hidden");
        $("#wrapper").removeHighlight();
        $("#result-count").text("");
    }
    $("#user-agent").html(navigator.userAgent);
    $("#delete-search").click(function() { clearSearchField(); });
    $(document).keyup(function(e) { if (e.keyCode == 27) { clearSearchField(); } });
    var self = this;
    self.input = $("#search-field");
    self.performSearch = function() {
        $("#delete-search").addClass("hidden");
        var phrase = self.input.val().replace(/^\s+|\s+$/g, ""),
            count = 0, matches, phrase_regex;
        phrase = phrase.replace(/\s+/g, "|");
        $("#wrapper").removeHighlight();
        if (phrase.length < 3) { return; }
        $("#delete-search").removeClass("hidden").removeClass("fa-times").addClass("fa-spinner");
        phrase_regex = ["\\b(", phrase, ")"].join("");
        matches = $("#wrapper").html().match(new RegExp(phrase_regex, "gi"));
        count = matches ? (matches.length) : 0;
        $("#wrapper").highlight(phrase);
        $("#result-count").text(count + " results");
        $("#delete-search").removeClass("fa-spinner").addClass("fa-times");
        self.search = null;
    };
    self.search;
    self.input.keyup(function(e) {
        if (self.search) { clearTimeout(self.search); }
        self.search = setTimeout(self.performSearch, 300);
    });
});
    </script>
<?php echo safely($scripts, $hqt_settings['mask_scripts']); ?>
<script>
<?php echo safely($js); ?>
</script>
</body>
</html>
