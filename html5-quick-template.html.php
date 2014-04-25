<?php
/**
 * HTML5 Quick Template - A simple blank HTML5 template for quick rendering
 * Sources at <http://github.com/pierowbmstr/html5-quick-template>
 * Copyright 2014 @pierowbmstr <http://github.com/pierowbmstr>
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

################# USER VARIABLES #######################################################################################

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
if (!isset($content)) $content = 'No content received!';

/**
 * @var    string|array    The page content footnotes like `id => note content` or as a raw string
 */
if (!isset($notes)) $notes = array();

/**
 * @var    string|array    The page secondary contents list or string, you can use a 'meaningful' index
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
if (!isset($repo_url)) $repo_url = 'http://github.com/pierowbmstr/html5-quick-template';

/**
 * @var    string    The header link to the repo icon (see <http://fortawesome.github.io/Font-Awesome/icons/#brand>)
 */
if (!isset($repo_icon)) $repo_icon = 'fa-github';

/**
 * @var    string    The header link to the repo title
 */
if (!isset($repo_title)) $repo_title = 'Fork the repo on gihub';

/**
 * @var    array    The user settings overwriting the `$default_settings`
 */
if (!isset($settings)) $settings = array();
if (!is_array($settings)) $settings = array( $settings );

################# END OF USER VARIABLES ################################################################################

################# SETTINGS #############################################################################################

/**
 * @var array   Default settings
 * You can overwrite each entry or all of them defining a `$settings` array
 */
$hqt_default_settings = array(
    // list of characters replaced by a space when transforming a string
    'string_spacify' => array('-', '_'),
    // list of characters striped when transforming a string
    'string_strip' => array(),
    // car. used to build slugs (replacing special cars and spaces)
    'slug_glue' => '-',
    // length of introductions or extracts of contents
    'extract_length' => 180,
    // date time format mask
    'date_format' => 'd M Y H:i:s',
    // mask used for additional meta tags
    'mask_meta' => '<meta name="%s" content="%s">',
    // mask used for additional stylesheets
    'mask_stylesheet' => '<link href="%s" rel="stylesheet">',
    // mask used for additional scripts
    'mask_scripts' => '<script src="%s"></script>',
    // title of the table of contents
    'toc_title' => 'Table of contents',
    // mask used to build global table of contents list
    'mask_toc_list' => '<ul>%s</ul>',
    // mask used to build each table of contents list item
    'mask_toc_list_item' => '<li>%s</li>',
    // mask used to build the content of each table of contents list item
    'mask_toc_list_item_content' => '<a href="#%s">%s</a>',
    // title of the content notes
    'notes_title' => 'Footnotes',
    // mask used to build global notes list
    'mask_notes_list' => '<ol>%s</ol>',
    // mask used to build each notes list item
    'mask_notes_list_item' => '<li id="%s">%s</li>',
    // mask used to build the content string of each notes list item
    'mask_notes_list_item_content' => '%s',
    // mask used to build author info
    'mask_author' => 'Content authored by %s.&nbsp;',
    // mask used to build last update info
    'mask_update' => 'Last update of this content at %s.&nbsp;',
    // title of the secondaty contents menu
    'secondary_blocks_title' => 'Infos',
    // build the brand title from the page title
    'brand_title' => $title,
    // brand icon (here as an array with a random selection for each rendering ;)
    'brand_icon' => array( '<i class="fa fa-umbrella"></i>', '<i class="fa fa-anchor"></i>', '<i class="fa fa-beer"></i>', '<i class="fa fa-cloud"></i>', '<i class="fa fa-bug"></i>', '<i class="fa fa-leaf"></i>' ),

    // jQuery 1.11.0 <http://jquery.com/>
    'jquery_script' => "//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js",
    // Bootstrap 3.1.1 <http://getbootstrap.com/>
    'bootstrap_script' => "//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js",
    'bootstrap_stylesheet' => "//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css",
    // Font Awesome 4.0.3 <http://fortawesome.github.io/Font-Awesome>
    'icons_stylesheet' => "//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css",

    // footer application information string
    'app_info' => 'Page generated from an <a href="%s" title="%s">%s</a>.',
    // footer dependencies information string
    'dependencies_info' => 'Page built with the help of open source stuff such as <a href="http://jquery.com/" title="jquery.com">jQuery</a>, <a href="http://getbootstrap.com/" title="getbootstrap.com">Bootstrap</a> and <a href="http://fortawesome.github.io/Font-Awesome" title="fortawesome.github.io/Font-Awesome">Font Awesome</a>.'

);

################# END OF SETTINGS ######################################################################################

################# INTERNAL API #########################################################################################

/**
 * @constant    Name of the app
 */
define('HQT_NAME', 'html5-quick-template');

/**
 * @constant    Current version of the app
 */
define('HQT_VERSION', '1.0.1');

/**
 * @constant    URL of the app repo
 */
define('HQT_URL', 'http://github.com/pierowbmstr/html5-quick-template');

/**
 * Prepare the env vars
 *
 * @param   array   $defaults   The default settings array
 * @param   array   $options    The user settings array
 * @return  void
 */
function hqt_prepare($defaults = array(), $options = array())
{
    foreach (array_merge($defaults, $options) as $var=>$val) {
        hqt_internal($var, $val);
    }
    if (!isset($options['app_info']) || (isset($options['app_info']) && $options['app_info']==$defaults['app_info'])) {
        hqt_internal('app_info', sprintf($defaults['app_info'], HQT_URL, HQT_NAME.' '.HQT_VERSION, HQT_NAME));
    }
}

/**
 * Get a setting entry
 * 
 * @param   string  $name   The setting key to get
 * @return  misc
 */
function hqt_setting($name)
{
    return hqt_internal($name);
}

/**
 * Internal `hqt_settings` setter/getter
 *
 * @param   array   $var   The variable name
 * @param   misc    $val   The variable value to set
 * @return  misc
 */
function hqt_internal($var, $val = null)
{
    static $hqt_settings = array();
    if (!empty($val)) {
        $hqt_settings[$var] = $val;
    } else {
        return isset($hqt_settings[$var]) ? $hqt_settings[$var] : null;
    }
}

/**
 * Apply one or more callbacks on a string
 *
 * @param   string|array    $callback   One or more callback functions to call
 * @param   string          $str        The single `$str` argument passed to callback(s)
 * @return  string
 */
function hqt_callback($callback, $str)
{
    if (empty($callback)) return $str;
    if (!is_array($callback)) $callback = array( $callback );
    foreach ($callback as $_cb) {
        if (!is_null($_cb) && is_callable($_cb)) {
            $oldstr = $str;
            try { $str = call_user_func($_cb, $str); } catch (Exception $e) { $str = $oldstr; }
        }
    }
    return $str;
}

/**
 * Returns a safe string passing it in `$mask` with `sprintf()` and transforming it if `$transform===true`
 * 
 * @param    misc           $what        The original content to stringify
 * @param    string         $mask        The mask to use to build the content
 * @param    null|callable  $callback    A callback method to finally transform the string
 * @setting  date_format                 String used to formate DateTime objects
 * @return   string
 */
function hqt_safestring($what, $mask = '%s', $callback = null)
{
    $str = '';
    if (is_array($what)) {
        foreach ($what as $var=>$val) {
            $valnum = substr_count($mask, '%s');
            $str .= ($valnum > 1) ? sprintf($mask, $var, $val) : sprintf($mask, $val);
        }
    } elseif (is_object($what)) {
        if ($what instanceof DateTime) {
            $str .= sprintf($mask, $what->format(hqt_setting('date_format')));
        }
    } elseif (is_string($what) || is_numeric($what)) {
        $str .= sprintf($mask, (string) $what);
    }
    $str = hqt_callback($callback, $str);
    return $str; 
}

/**
 * Get a readable string from any original string
 *
 * @param   string          $str        The original string
 * @param   null|callable   $callback   A callback method to finally transform the string
 * @setting string_spacify              Car(s). replaced by a space
 * @setting string_strip                Car(s). stripped
 * @return  string
 */
function hqt_stringify($str, $callback = null)
{
    $str = str_replace(hqt_setting('string_spacify'), ' ', (string) $str);
    $str = str_replace(hqt_setting('string_strip'), '', $str);
    $str = hqt_callback($callback, $str);
    return $str;
}

/**
 * Build a slug string (for DOM IDs for instance) from an original string
 *
 * @param   string          $str        The original string
 * @param   null|callable   $callback   A callback method to finally transform the string
 * @setting slug_glue                   Car. used to replace unwanted cars.
 * @return  string
 */
function hqt_slugify($str, $callback = null)
{
    $str = preg_replace('~[^a-zA-Z0-9]+~u', hqt_setting('slug_glue'), (string) $str);
    $str = strtolower(trim($str, hqt_setting('slug_glue')));
    $str = hqt_callback($callback, $str);
    return $str;
}

/**
 * Returns a safe string extracted from original with legnth `settings[ extract_length ]`
 * 
 * @param    misc           $what       The original content to extract
 * @param   null|callable   $callback   A callback method to finally transform the string
 * @setting  extract_length             Length of the extracted string
 * @return   string
 */
function hqt_extract($what, $callback = null)
{
    $str = substr(hqt_safestring($what), 0, hqt_setting('extract_length'));
    $str = htmlentities(trim(strip_tags($str), "\n"));
    $str = hqt_callback($callback, $str);
    return $str;
}

/**
 * Build a table of contents from an array of items
 * 
 * @param    array    $toc    The contents array like `id => title` or `id => items` with `items` constructed like `$toc`
 * @setting  mask_toc_list
 * @setting  mask_toc_list_item
 * @setting  mask_toc_list_item_content
 * @return   string
 */
function hqt_make_toc($toc)
{
    $str = '';
    if (is_array($toc)) {
        foreach ($toc as $var=>$val) { 
            if (!is_string($var) && is_string($val)) { $var = $val; }
            if (is_array($val)) {
                $str .= sprintf(
                    hqt_setting('mask_toc_list_item'),
                    sprintf(hqt_setting('mask_toc_list_item_content'), hqt_safestring($var), hqt_safestring($var, '%s', array('hqt_stringify','ucfirst'))) . hqt_make_toc($val)
                );
            } else {
                $str .= sprintf(
                    hqt_setting('mask_toc_list_item'),
                    sprintf(hqt_setting('mask_toc_list_item_content'), hqt_safestring($var), hqt_safestring($val, '%s', array('hqt_stringify','ucfirst')))
                );
            }
        }
        $str = sprintf(hqt_setting('mask_toc_list'), $str);
    } else {
        $str = hqt_safestring($toc);
    }
    return $str;
}

/**
 * Build a list of notes from an array of items
 * 
 * @param    array    $notes    The notes array like `id => info`
 * @setting  mask_notes_list
 * @setting  mask_notes_list_item
 * @setting  mask_notes_list_item_content
 * @return   string
 */
function hqt_make_notes($notes)
{
    $str = '';
    if (is_array($notes)) {
        foreach ($notes as $var=>$val) { 
            if (!is_string($var) && is_string($val)) { $var = $val; }
            $str .= sprintf(
                hqt_setting('mask_notes_list_item'),
                hqt_safestring($var),
                hqt_safestring($val, hqt_setting('mask_notes_list_item_content'), array('hqt_stringify'))
            );
        }
        $str = sprintf(hqt_setting('mask_notes_list'), $str);
    } else {
        $str = hqt_safestring($notes);
    }
    return $str;
}

################# END OF INTERNAL API ##################################################################################

################# FINAL RENDERING ######################################################################################

// env preparation
hqt_prepare($hqt_default_settings, $settings);

// dump env vars when calling this file 
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__)) {
    ob_start();
    echo '<p class="lead">To follow updates and bugs, please have a look at <a href="'.HQT_URL.'">'.HQT_URL.'</a>.</p>';
    echo "<h2>Defined variables</h2><pre>";
    $vars = get_defined_vars();
    foreach (array('GLOBALS', '_POST', '_GET', '_COOKIE', '_FILES', '_ENV', '_REQUEST', '_SERVER', 'php_errormsg', 'dtmz', 'hqt_default_settings') as $key) { if (isset($vars[$key])) unset($vars[$key]); }
    var_dump($vars);
    echo "</pre><h2>Default settings</h2><pre>";
    var_dump($hqt_default_settings);
    echo "</pre>";
    $content = ob_get_contents();
    ob_end_clean();
    $title = HQT_NAME.' '.HQT_VERSION;
    $sub_title = 'internal documentation';
    hqt_internal('brand_title', hqt_stringify(HQT_NAME, 'ucwords'));
    hqt_internal('brand_icon', '<i class="fa fa-code"></i>');
}

// headers
header('Content-Type: text/html');
if (!empty($update)) {
    header('Last-Modified: '.(($update instanceof DateTime) ? $update->format('D, d M Y H:i:s T') : date('D, d M Y H:i:s T', $update)));
}

// rendering
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="en">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo hqt_setting('bootstrap_stylesheet'); ?>" rel="stylesheet">
    <link href="<?php echo hqt_setting('icons_stylesheet'); ?>" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title><?php echo hqt_safestring(hqt_setting('brand_title')); ?></title>
<?php if (!empty($sub_title)) : ?>
    <meta name="description" content="<?php echo hqt_safestring($sub_title); ?>">
<?php endif; ?>
<?php if (!empty($author)) : ?>
    <meta name="author" content="<?php echo hqt_safestring($author); ?>">
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
    .navbar-brand i     { font-size: 22px; }
    form.navbar-form    { position: relative; }
    .navbar-form.navbar-right:last-child { margin-right: 0px; }
    input#search        { padding-right: 24px; }
    span#delete-search  { position: absolute; display: block; top: 10px; right: 24px; z-index: 100; cursor: pointer; }
    @media (max-width: 767px) {
        aside                       { max-width: 100%; }
        aside#secondary-contents    { margin: 10px; }
        .secondary-content          { display: block; min-width: 100%; }
        span#delete-search          { top: 40px; }
        .responsive                 { width: 100%; overflow: auto; }
        .navbar li a .visible-xs    { display: inline !important; }
    }
    </style>
<?php echo hqt_safestring($metas, hqt_setting('mask_meta')); ?>
<?php echo hqt_safestring($stylesheets, hqt_setting('mask_stylesheet')); ?>
<style>
<?php echo hqt_safestring($css); ?>
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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" title="navigation menu">
                    <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : ''); ?>">
                    <?php $icon = hqt_setting('brand_icon'); if (!empty($icon)) : ?>
                        <?php echo is_array($icon) ? $icon[array_rand($icon)] : $icon;?>&nbsp;
                    <?php endif; ?>
                    <?php echo hqt_safestring(hqt_setting('brand_title')); ?>
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
<?php if (!empty($toc)) : ?>
                    <li><a href="#toc" title="reach the table of contents"><i class="fa fa-book"></i>&nbsp;<?php echo hqt_safestring(hqt_setting('toc_title')); ?></a></li>
<?php endif; ?>
<?php if (!empty($notes)) : ?>
                    <li><a href="#notes" title="reach the notes of the content"><i class="fa fa-thumb-tack"></i>&nbsp;<?php echo hqt_safestring(hqt_setting('notes_title')); ?></a></li>
<?php endif; ?>
                    <li><a href="#top" title="reach the top of the page"><i class="fa fa-angle-up"></i>&nbsp;Top</a></li>
                    <li><a href="#bottom" title="reach the bottom of the page"><i class="fa fa-angle-down"></i>&nbsp;Bottom</a></li>
<?php if (!empty($secondary_contents)) : ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo hqt_safestring(hqt_setting('secondary_blocks_title')); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
    <?php foreach ($secondary_contents as $i => $_item) : $id = hqt_slugify($i); ?>
                            <li><a href="#secondary-content-<?php echo $id; ?>" title="<?php echo hqt_extract($_item); ?>"><i class="fa fa-chevron-right"></i>&nbsp;<?php echo hqt_stringify($i); ?></a></li>
    <?php endforeach; ?>
                        </ul>
                    </li>
<?php endif; ?>
                    <li class="active"><a title="<?php echo hqt_safestring($repo_title); ?>" href="<?php echo hqt_safestring($repo_url); ?>">&nbsp;<i class="fa <?php echo hqt_safestring($repo_icon); ?>"></i>&nbsp;<span class="visible-xs"><?php echo hqt_safestring($repo_title); ?></span></a></li>
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
    <?php foreach ($secondary_contents as $i => $_item) : $id = hqt_slugify($i); ?>
            <div class="secondary-content bg-default">
                <p class="text-muted handler">
                    <a data-toggle="collapse" data-parent="#secondary-contents" href="#secondary-content-<?php echo $id; ?>" onClick="$(this).find('i').toggleClass('fa-angle-up').toggleClass('fa-angle-down');" title="show / hide this content block">
                        <i class="fa fa-angle-up"></i>&nbsp;<?php echo ($id != (string) $i) ? hqt_stringify($i) : 'show / hide'; ?>
                    </a>
                </p>
                <div id="secondary-content-<?php echo $id; ?>" class="collapse in">
                    <?php echo hqt_make_toc($_item); ?>
                </div>
            </div>
    <?php endforeach; ?>
        </aside>
        <div class="clearfix visible-xs"></div>
<?php endif; ?>
        <article>
            <header>
                <h1><?php echo hqt_safestring($title); ?> <small><?php echo hqt_safestring($sub_title); ?></small></h1>
            </header>
<?php if (!empty($toc)) : ?>
            <aside role="navigation" class="bg-info <?php echo (!empty($secondary_contents)) ? 'pull-left' : 'pull-right'; ?> hidden-print">
                <h4 id="toc"><?php echo hqt_safestring(hqt_setting('toc_title')); ?></h4>
                <?php echo hqt_make_toc($toc); ?>
            </aside>
            <div class="clearfix visible-xs"></div>
<?php endif; ?>
            <?php echo hqt_safestring($content); ?>
<?php if (!empty($notes)) : ?>
            <hr />
            <footer>
                <div class="footnotes">
                    <h4 id="notes"><?php echo hqt_safestring(hqt_setting('notes_title')); ?></h4>
                    <?php echo hqt_make_notes($notes); ?>
                </div>
            </footer>
<?php endif; ?>
<?php if (!empty($author) || !empty($update)) : ?>
            <hr />
            <footer class="text-right text-muted"><small><p>
    <?php if (!empty($author)) : ?>
                <?php echo hqt_safestring($author, hqt_setting('mask_author')); ?>
    <?php endif; ?>
    <?php if (!empty($author) && !empty($update)) : ?>
        <br class="visible-xs">
    <?php endif; ?>
    <?php if (!empty($update)) : ?>
        <?php echo hqt_safestring($update, hqt_setting('mask_update')); ?>
    <?php endif; ?>
            </p></small></footer>
<?php endif; ?>
        </article>
        <footer>
            <div class="footer">
                <div class="pull-right text-right"><small>
                    <?php echo hqt_setting('app_info'); ?><br><?php echo hqt_setting('dependencies_info'); ?>
                </small></div>
                <div class="pull-left responsive"><small>
                    <span class="label label-default" title="date of the page"><?php echo date(hqt_setting('date_format')); ?></span>
                    <br>
                    <span class="label label-default" id="user-agent" title="current user agent"></span>
                    <br>
                    <span class="label label-default" title="server system"><?php echo php_uname(); ?></span>
                </small></div>
                <div class="clearfix"></div>
            </div>
        </footer>
    </div>
    <div class="clearfix"></div>
    <a id="bottom"></a>
    <script src="<?php echo hqt_setting('jquery_script'); ?>"></script>
    <script src="<?php echo hqt_setting('bootstrap_script'); ?>"></script>
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
    function scrollAnchor(href) {
        href = typeof(href) == "string" ? href : $(this).attr("href");
        if (!href) return;
        if (href.charAt(0) == "#") {
            var $target = $(href);
            if ($target.length) {
                $('html, body').animate({ scrollTop: $target.offset().top - 70 });
                if(history && "pushState" in history) {
                    history.pushState({}, document.title, window.location.pathname + href);
                }
            }
        }
    }
    $("body").on("click", "a", scrollAnchor);
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
<?php echo hqt_safestring($scripts, hqt_setting('mask_scripts')); ?>
<script>
<?php echo hqt_safestring($js); ?>
</script>
</body>
</html>
