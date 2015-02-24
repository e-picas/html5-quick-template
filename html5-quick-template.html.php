<?php
/**
 * HTML5 Quick Template - A simple blank HTML5 template for quick rendering
 * Sources at <http://github.com/piwi/html5-quick-template>
 * Copyright (c) 2014-2015 Pierre Cassat <http://e-piwi.fr/>
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
 *
 * @package     html5-quick-template
 * @prefix      hqt_|HQT_
 * @license     Apache 2.0
 * @sources     http://github.com/piwi/html5-quick-template
 * @author      Pierre Cassat <http://e-piwi.fr/>
 */

// debug & php settings
//error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 1);

// set a default timezone to avoid PHP5 warnings
$hqt_dtmz = @date_default_timezone_get(); @date_default_timezone_set($hqt_dtmz?:'Europe/London');

// PHP 5.3 or greater required
if (version_compare(phpversion(), '5.3.0', '<')) { die('The HTML5 quick template requires at least PHP version [5.3.0]! (current version is ['.phpversion().'])'); }

// shortcut to change the actual app mode (in 'dev' or 'prod') ; uncomment this during development
//$hqt_app_mode_shortcut = 'dev';

################# USER VARIABLES #######################################################################################
/*
 * Each of these variables are "typed" as `string`, `array` or `string|array`. This is mostly
 * an advice about how the variable is used but you can (quite safely) use strings or arrays
 * when you want. To disable a variable, just define it to `false` or an empty string.
 */

/**
 * @var    string    The page title
 */
if (!isset($title)) $title = 'Empty template';

/**
 * @var    string    The page content
 */
if (!isset($content)) $content = 'No content received!';

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
 * @var    string|array    The page content footnotes like `id => note content` or as a raw string
 */
if (!isset($notes)) $notes = array();

/**
 * @var    string|array    The page table of contents like `id => title` or `id => items` recursively, or as a raw string
 */
if (!isset($toc)) $toc = array();

/**
 * @var    string|array    The page content additional meta tags like `name => value`
 */
if (!isset($metas)) $metas = array();

/**
 * @var    string|array    The page additional stylesheets `src` list
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
 * @var    string    The page inline javascript code executed after all scripts are loaded
 */
if (!isset($js)) $js = '';

/**
 * @var    array    An array of constant menu items ; each item must be `url=..., title=..., content=...`
 */
if (!isset($menu)) $menu = array();

/**
 * @var    string    A notice for the content (information string such as copyright, written last)
 */
if (!isset($content_notice)) $content_notice = '';

/**
 * @var    string    A notice for the page (information string such as copyright, written in the footer)
 */
if (!isset($page_notice)) $page_notice = '';

/**
 * @var    string|array    The page secondary contents list or string, you can use a 'meaningful' index
 */
if (!isset($secondary_contents)) $secondary_contents = array();
if (!is_array($secondary_contents)) $secondary_contents = (is_string($secondary_contents) && !empty($secondary_contents)) ? array( $secondary_contents ) : array();

/**
 * @var    string    The header link to the repo
 */
if (!isset($stamp_url)) $stamp_url = 'http://github.com/piwi/html5-quick-template';

/**
 * @var    string    The header link to the repo icon (see <http://fortawesome.github.io/Font-Awesome/icons/#brand>)
 */
if (!isset($stamp_icon)) $stamp_icon = 'fa-github';

/**
 * @var    string    The header link to the repo title
 */
if (!isset($stamp_title)) $stamp_title = 'Fork the repo on GitHub';

/**
 * @var    string    The URL for refreshing the page
 */
if (!isset($self)) $self = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : (isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '');

/**
 * @var    array     The user settings overwriting the `$default_settings`
 */
if (!isset($settings) || !is_array($settings)) $settings = array();

################# END OF USER VARIABLES ################################################################################

################# SETTINGS #############################################################################################
/*
 * Settings are loaded by their key string, you need to keep these keys intact. For more
 * facilities, keys are prefixed by their "family" type: `mask_`, `length_` ...
 *
 * Settings values may be a string or an array (see comments below) ; you can use anonymous
 * functions to return the final value (see <http://www.php.net/manual/en/functions.anonymous.php>).
 * When writing closures, you must define a `use` statement to access page's variables:
 *
 *      function() use (&$content) { ... }
 *
 * You MUST write your masks using only the `%s` specifier. You can rearrange specifiers to handle
 * any received argument using the `%1$s` notation (see <http://www.php.net/manual/en/function.sprintf.php>).
 */

/**
 * @var array   Default settings
 * You can overwrite each entry or all of them defining a `$settings` array in your script
 */
$hqt_default_settings = array(
    // @string      app_mode        the application mode ('dev' => show the profiler | 'prod' => clean page)
    'app_mode' => (isset($hqt_app_mode_shortcut) ? $hqt_app_mode_shortcut : 'prod'),
    // @string      profiler_default_mode   the default profiler mode for 'prod' `app_mode`
    'profiler_default_mode' => 'hidden',
    // @array       profiler_mode  the actual profiler mode in ( 'on' => profiler, 'off' => no profiler, 'hidden' => profiler hidden in HTML ) 
    'profiler_mode' => function() { return (hqt_setting('app_mode')==='dev' ? 'on' : hqt_setting('profiler_default_mode')); },
    // @array       profiler_user_stack  some infos to add to the page's profiler
    'profiler_user_stack' => array(),
    // @string      language        the page language (used by HTML5)
    'language' => 'en',
    // @string      charset         the page encoding (used by HTML5)
    'charset' => 'utf-8',
    // @string      direction       direction of text in ( rtl ltr )
    'direction' => 'ltr',
    // @array       headers         list of headers to send (each of them will be searched as a `header_xxx` setting)
    'headers' => array('Content-Type', 'Last-Modified'),
    // @string      header_Content-Type  the "Content-Type" header value
    'header_Content-Type' => 'text/html',
    // @string      header_Last-Modified  the "Last-Modified" header value
    'header_Last-Modified' => function() use (&$update) {
        return (!empty($update) ? hqt_datify($update, 'D, d M Y H:i:s T') : null);
    },
    // @array       string_spacify      list of characters replaced by a space when transforming a string
    'string_spacify' => array('-', '_'),
    // @array       string_strip        list of characters striped when transforming a string
    'string_strip' => array(),
    // @string      slug_glue           character used to build slugs (replacing special chars and spaces)
    'slug_glue' => '-',
    // @string      slug_mask           mask to catch replaced characters used to build slugs
    'slug_mask' => '~[^a-zA-Z0-9]+~u',    
    // @numeric     length_extract      length of introduction or extract of contents
    'length_extract' => 180,
    // @numeric     length_title        length of title when constructed from a content
    'length_title' => 32,
    // @string      date_format         date-time format mask
    'date_format' => 'd M Y H:i:s',
    // @string      mask_meta           mask used for additional meta tags
    //                                  this mask is completed with `$index` and `$value`
    'mask_meta' => '<meta name="%s" content="%s">',
    // @string      mask_stylesheet     mask used for additional stylesheets
    //                                  this mask is completed with `$href`
    'mask_stylesheet' => '<link href="%s" rel="stylesheet">',
    // @string      mask_script         mask used for additional scripts
    //                                  this mask is completed with `$src`
    'mask_script' => '<script src="%s"></script>',
    // @string      mask_default        default mask used to build strings
    //                                  this mask is completed with `$str`
    'mask_default' => '%s',
    // @string      mask_list           mask used to build lists wrapper
    //                                  all `mask_list(...)` masks are completed with `$items_value`
    'mask_list' => '<ul>%s</ul>',
    // @string      mask_list_item      mask used to build each list item
    //                                  all `mask_list_item(...)` masks are completed with `$key` and `$value`
    'mask_list_item' => '<li>%2$s</li>',
    // @string      mask_list_item_content  mask used to build the content of each list item
    //                                      all `mask_list_item_content(...)` masks are completed with `$key` and `$value`
    'mask_list_item_content' =>  '%2$s',
    // @array       navbar_items        list of navbar allowed items in ( menu , toc , notes , top , bottom , summary )
    'navbar_items' => array('menu', 'toc', 'notes', 'top', 'bottom', 'summary'),
    // @string      mask_list_toc       mask used to build global table of contents list
    'mask_list_toc' => '<ul>%s</ul>',
    // @string      mask_list_item_toc  mask used to build each table of contents list item
    'mask_list_item_toc' => '<li>%2$s</li>',
    // @string      mask_list_item_content_toc  mask used to build the content of each table of contents list item
    'mask_list_item_content_toc' => '<a href="#%s">%s</a>',
    // @string      mask_list_notes     mask used to build global notes list
    'mask_list_notes' => '<ol>%s</ol>',
    // @string      mask_list_item_notes     mask used to build each notes list item
    'mask_list_item_notes' => '<li id="%s">%s</li>',
    // @string      mask_list_item_content_notes    mask used to build the content string of each notes list item
    'mask_list_item_content_notes' => '%2$s',
    // @string      menu_item_content_stamp_icon    icon of the "stamp" menu item
    'menu_item_content_stamp_icon' => function() use (&$stamp_icon) {
        return '&nbsp;<i class="fa '.hqt_safestring($stamp_icon).'"></i>&nbsp;';
    },
    // @string      menu_item_content_stamp     content of the "stamp" menu item
    'menu_item_content_stamp' => function() use (&$stamp_url, &$stamp_title) {
        $icon = hqt_safestring(hqt_setting('menu_item_content_stamp_icon'));
        return '<a title="'.hqt_safestring($stamp_title).'" href="'.hqt_safestring($stamp_url).'">'.$icon.'<span class="visible-xs">'.hqt_safestring($stamp_title).'</span></a>';
    },
    // @string      brand_title     build the brand title from the page title
    'brand_title' => function() use (&$title) { return hqt_safestring($title); },
    // @string      brand_icon      brand icon (here as an array with a random selection for each rendering ;)
    'brand_icon' => array( '<i class="fa fa-umbrella"></i>', '<i class="fa fa-anchor"></i>', '<i class="fa fa-beer"></i>', '<i class="fa fa-cloud"></i>', '<i class="fa fa-bug"></i>', '<i class="fa fa-leaf"></i>' ),
    // @string      meta_title     build the meta "title" from the page title
    'meta_title' => function() use (&$title) { return strip_tags(hqt_safestring($title)); },
    // @string      libscript_jquery       jQuery 1.11.2 <http://jquery.com/>
    'libscript_jquery' => "//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js",
    // @string      libscript_bootstrap    Bootstrap 3.3.2 <http://getbootstrap.com/>
    'libscript_bootstrap' => "//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js",
    // @string      libstylesheet_bootstrap Bootstrap 3.3.2 <http://getbootstrap.com/>
    'libstylesheet_bootstrap' => "//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css",
    // @string      libstylesheet_fontawesome     Font Awesome 4.3.0 <http://fortawesome.github.io/Font-Awesome>
    'libstylesheet_fontawesome' => "//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css",
    // @string      libscript_html5shiv    html5shiv.js 3.7.0 <http://code.google.com/p/html5shiv/>
    'libscript_html5shiv' => "https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js",
    // @string      libscript_respond    Respond.js 1.4.2 <http://code.google.com/p/html5shiv/>
    'libscript_respond' => "https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js",
    // @array       language_strings    Overloading of default language strings (see `$hqt_language_strings`)
    'language_strings' => array(),
    // @string      app_name        title of the "about" window
    'app_name' => function() { return HQT_NAME.' '.HQT_VERSION; },
    // @string      app_description     description of the "about" window
    'app_description' => function() { return 'A simple blank HTML5 template for quick rendering.'; },
    // @array       app_infos       table of infos for the "about" window
    'app_infos' => function() { return array(
            'license' => '<a href="http://www.apache.org/licenses/LICENSE-2.0.html" title="See online">Apache v2.0 open source license</a>',
            'maintainer' => '<a href="http://github.com/piwi" title="See online">@pierowbmstr</a>',
            'sources &amp; updates' => '<a href="'.HQT_HOME.'" title="See online">'.HQT_HOME.'</a>',
            'documentation' => '<a href="'.hqt_setting('app_manual_url').'" title="See online">'.hqt_setting('app_manual_url').'</a>',
    ); },
    // @array       app_dependencies       table of infos for the "third-parties" of the "about" window, each like array( 'name'=>..., 'home'=>..., 'license'=>..., 'license_url'=>... )
    'app_dependencies' => function() { return array(
        array('name'=>'jQuery', 'version'=>'1.11.2', 'home'=>'http://jquery.com/', 'license'=>'MIT license', 'license_url'=>'http://github.com/jquery/jquery/blob/master/MIT-LICENSE.txt'),
        array('name'=>'Bootstrap', 'version'=>'3.3.1', 'home'=>'http://getbootstrap.com/', 'license'=>'Apache license v2.0', 'license_url'=>'http://www.apache.org/licenses/LICENSE-2.0'),
        array('name'=>'Font Awesome', 'version'=>'4.3.0', 'home'=>'http://fortawesome.github.io/Font-Awesome', 'license'=>'SIL OFL 1.1 license', 'license_url'=>'http://scripts.sil.org/OFL'),
        array('name'=>'HTML5shiv', 'version'=>'3.7.0', 'home'=>'http://code.google.com/p/html5shiv/', 'license'=>'MIT license', 'license_url'=>'http://www.opensource.org/licenses/mit-license.php'),
        array('name'=>'Respond.js', 'version'=>'1.4.2', 'home'=>'http://github.com/scottjehl/Respond', 'license'=>'MIT license', 'license_url'=>'http://www.opensource.org/licenses/mit-license.php'),
    ); },
    // @string      app_about_notice        a notice string for the about box
    'app_about_notice' => function() { return 'To follow sources updates, create a fork of the template or transmit a bug, please have a look at the GitHub repository at <a href="'.HQT_HOME.'" title="See sources on GitHub">'.HQT_HOME.'</a>.'; },
    // @string      app_manual_url          the URL to read the HTML5 quick template manual (URL to this file itself)
    'app_manual_url' => function() { return (substr(HQT_VERSION, -3)=='dev' ? HQT_HOME.'/tree/wip' : 'http://sites.ateliers-pierrot.fr/html5-quick-template/html5-quick-template.html.php'); },
    // @array       profiler_stack          table of profiler entries
    'profiler_stack' => array(
        'profiler-request' => function() {
            return '<a id="' . hqt_internalid('profiler-request') . '" class="insert-request"></a>';
        },
        'profiler_apps' => function() { return HQT_NAME.' '.HQT_VERSION; },
        'profiler_date' => date('c') . ' (' . @date_default_timezone_get() . ')',
        'profiler-user-agent' => '',
        'profiler_server_os' => php_uname(),
    )
);

################# END OF SETTINGS ######################################################################################

################# LN STRINGS ###########################################################################################
/*
 * Language strings are searched by their indexes, you MUST keep them intact.
 * The final strings are completed with arguments (if so) via `sprintf()` PHP function.
 */

/**
 * @var array   Language strings
 * You can overwrite each language string defining it in a `$settings['language_strings']` item
 * using the same key as below.
 */
$hqt_language_strings = array(
    'about_button' => 'About',
    'about_button_title' => 'open the about box',
    'about_box_title' => 'About the app',
    'author_info' => 'Content authored by %s.&nbsp;',
    'bottom_menu_item' => 'Bottom',
    'bottom_menu_item_title' => 'reach the bottom of this page',
    'brand_button_title' => '(re)fresh this page',
    'close_this_modal_box' => 'close this box',
    'footer_info_app' => 'Page generated from an <a href="%s" title="%s">%s</a>.',
    'footer_info_dependencies' => 'Page built with the help of open source stuff such as <a href="http://jquery.com/" title="jquery.com">jQuery</a>, <a href="http://getbootstrap.com/" title="getbootstrap.com">Bootstrap</a> and <a href="http://fortawesome.github.io/Font-Awesome" title="fortawesome.github.io/Font-Awesome">Font Awesome</a>.',
    'footer_print_info' => 'Together, have a responsible approach: do not print this page unless necessary.<br>This page comes from the Internet at',
    'internet_connection_off' => 'Your internet connection seems off, the page will be rendered as raw HTML.',
    'last_update_info' => 'Last update of this content at %s.&nbsp;',
    'manual_button' => 'Manual',
    'manual_button_title' => 'read the app manual online',
    'navigation_menu_title' => 'navigation menu',
    'notes_block_header' => 'Footnotes',
    'notes_menu_item' => 'Footnotes',
    'notes_menu_item_title' => 'reach the footnotes of this page',
    'outdated_browser_info' => 'You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.',
    'profiler_button' => 'Profiler',
    'profiler_button_title' => 'show / hide the profiler',
    'profiler-request' => 'request',
    'profiler_apps' => 'apps',
    'profiler_date' => 'date',
    'profiler-user-agent' => 'browser / device',
    'profiler_server_os' => 'server OS',
    'results' => 'results',
    'search_field_placeholder' => 'search ...',
    'search_field_mobile_clear' => 'clear search field',
    'search_field_title' => 'in-page highlighting search field',
    'search_field_clear_title' => 'clear search field',
    'secondary_block_handler_title' => 'show / hide this content block',
    'show_hide' => 'show / hide',
    'summary_menu_item' => 'Summary',
    'summary_menu_item_title' => 'toggle content summary',
    'toc_block_header' => 'Table of contents',
    'toc_menu_item' => 'Table of contents',
    'toc_menu_item_title' => 'reach the table of contents of this page',
    'toggle_navigation' => 'Toggle navigation',
    'top_menu_item' => 'Top',
    'top_menu_item_title' => 'reach the top of this page',
    'warning' => 'Warning!',
);

################# END OF LN STRINGS ####################################################################################

################# INTERNAL API #########################################################################################
/*
 * The methods of the internal API are all prefixed with `hqt_`.
 * They MUST NOT throw any error or exception.
 * Most of them MUST return a string.
 */

/**
 * @constant    Name of the app
 */
define('HQT_NAME', 'html5-quick-template');

/**
 * @constant    Current version of the app
 */
define('HQT_VERSION', '1.2.8-dev');

/**
 * @constant    URL of the app repo
 */
define('HQT_HOME', 'http://github.com/piwi/html5-quick-template');

/**
 * Prepare the env vars
 *
 * @param       array   $defaults   The default settings array
 * @param       array   $options    The user settings array
 * @param       array   $ln         The app language strings
 * @setting     language_strings    List of user language strings
 * @return      void
 */
function hqt_prepare($defaults = array(), $options = array(), $ln = array()) {
    foreach (array_merge($defaults, $options) as $var=>$val) { hqt_internal($var, $val); }
    $user_lns = hqt_setting('language_strings');
    if (empty($user_lns) || !is_array($user_lns)) $user_lns = array();
    hqt_internal('language_strings', array_merge($ln, $user_lns));
}

/**
 * Prepare the DOM analyzing existing IDs
 *
 * @param   string  $content    The user content of the page
 * @return  void
 */
function hqt_prepare_dom($content) {
    if (0!==preg_match_all('~id=["\']([^"\']+)~i', hqt_safestring($content), $matches) && isset($matches[1]) && !empty($matches[1])) {
        foreach ($matches[1] as $id) { hqt_getid($id, true); }
    }
}

/**
 * Get a setting entry
 * 
 * @param   string  $name       The setting key to get
 * @param   mixed   $default    The default value if setting was not found
 * @return  mixed
 */
function hqt_setting($name, $default = null) {
    return hqt_internal($name, null, $default);
}

/**
 * Internal `hqt_settings` setter/getter
 *
 * @param   array   $var        The variable name
 * @param   mixed   $val        The variable value to set
 * @param   mixed   $default    The default value while getting if setting was not found
 * @return  mixed
 */
function hqt_internal($var, $val = null, $default = null) {
    static $hqt_settings = array();
    if (!empty($val)) {
        $hqt_settings[$var] = $val;
    } else {
        $val = array_key_exists($var, $hqt_settings) ? $hqt_settings[$var] : $default;
        return ((is_object($val) && ($val instanceof Closure)) ? hqt_callback($val, '') : $val);
    }
}

/**
 * Set or get a unique DOM ID identified by `$name` for the template itself
 *
 * @param   string  $name The name of the ID to get
 * @return  string
 */
function hqt_internalid($name) {
    static $hqt_dom_internal_ids = array();
    if (!array_key_exists($name, $hqt_dom_internal_ids)) $hqt_dom_internal_ids[$name] = hqt_getid($name, true);
    return $hqt_dom_internal_ids[$name];
}

/**
 * Apply one or more callbacks on a string
 *
 * @param   string|array    $callback   One or more callback functions to call
 * @param   string          $str        The single `$str` argument passed to callback(s)
 * @return  string
 */
function hqt_callback($callback, $str) {
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
 * Translate a key string passing it arguments
 *
 * @param       string          $str    Index of the language strings array to retrieve translated string
 * @param       array           $args   Arguments passed to the string to complete it
 * @setting     language_strings        List of all actual language strings
 * @return      string
 */
function hqt_translate($str, $args = null) {
    $ln_strs = hqt_setting('language_strings');
    if (array_key_exists($str, $ln_strs)) {
        $str = $ln_strs[$str];
        if (!empty($args)) {
            array_unshift($args, $str);
            $str = call_user_func_array('sprintf', $args);
        }
    } elseif (!empty($args)) { $str = hqt_stringify($str).' ('.implode(' , ', $args).')'; }
    return $str;
}

/**
 * Set or get a unique DOM ID identified by `$name`
 *
 * @param   string  $name The name of the ID to get
 * @param   bool    $set  Force creation of a new ID
 * @return  string
 */
function hqt_getid($name, $set = false) {
    static $hqt_dom_ids = array();
    if (!array_key_exists($name, $hqt_dom_ids) || $set===true) {
        $id = hqt_slugify($name);
        if (in_array($id, $hqt_dom_ids)) $id .= uniqid();
        $hqt_dom_ids[$name] = $id;
    }
    return $hqt_dom_ids[$name];
}

/**
 * Returns a safe string passing it in `$mask` with `sprintf()` and to a list of optional callbacks
 * 
 * @param    mixed          $what        The original content to stringify
 * @param    string         $mask        The mask to use to build the content
 * @param    null|callable  $callback    A callback method to finally transform the string
 * @param    string         $items_glue  A string used to join array items
 * @setting  mask_default                Default value for `$mask`
 * @setting  date_format                 String used to format DateTime objects
 * @return   string
 */
function hqt_safestring($what, $mask = null, $callback = null, $items_glue = ' ') {
    if (is_null($mask)) $mask = hqt_setting('mask_default');
    $str = '';
    if (is_array($what)) {
        $count = 0;
        foreach ($what as $var=>$val) {
            $valnum = substr_count($mask, '%s');
            $str .= ($count>0 ? $items_glue : '').(($valnum > 1) ? sprintf($mask, $var, $val) : sprintf($mask, $val));
            $count++;
        }
    } elseif (is_object($what)) {
        if ($what instanceof DateTime) {
            $str .= sprintf($mask, $what->format(hqt_setting('date_format')));
        } elseif ($what instanceof Closure) {
            $str .= sprintf($mask, hqt_callback($what, $str));
        }
    } elseif (is_string($what) || is_numeric($what)) {
        $str .= sprintf($mask, (string) $what);
    }
    $str = hqt_callback($callback, $str);
    return $str; 
}

/**
 * Call the `hqt_safestring` method with `$mask` if `$what` is an array, without `$mask` otherwise
 * 
 * @param    mixed          $what        The original content to stringify
 * @param    string         $mask        The mask to use to build the content
 * @param    null|callable  $callback    A callback method to finally transform the string
 * @setting  mask_default                Default mask used if `$str` is a simple string
 * @return   string
 */
function hqt_safestringifarray($what, $mask = null, $callback = null) {
    return (is_array($what) ? hqt_safestring($what, $mask, $callback) : hqt_safestring($what, hqt_setting('mask_default'), $callback));
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
function hqt_stringify($str, $callback = null) {
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
 * @setting slug_mask                   REGEX mask to match striped chars
 * @setting slug_glue                   Car. used to replace unwanted cars.
 * @return  string
 */
function hqt_slugify($str, $callback = null) {
    $str = preg_replace(hqt_setting('slug_mask'), hqt_setting('slug_glue'), (string) $str);
    $str = strtolower(trim($str, hqt_setting('slug_glue')));
    $str = hqt_callback($callback, $str);
    return $str;
}

/**
 * Build a readable date-time from a timestamp or a `DateTime` object
 *
 * @param   float|DateTime  $str        The date or timestamp to transform
 * @param   string          $format     The format of date to use
 * @param   null|callable   $callback   A callback method to finally transform the string
 * @setting date_format                 Default value for `$format`
 * @return  string
 */
function hqt_datify($str, $format = null, $callback = null) {
    if (is_null($format)) $format = hqt_setting('date_format');
    $str = (is_object($str) && ($str instanceof DateTime)) ? $str->format($format) : (is_numeric($str) ? date($format, $str) : hqt_safestring($str));
    $str = hqt_callback($callback, $str);
    return $str;
}

/**
 * Returns a safe string extracted from original
 * 
 * @param    mixed           $what       The original content to extract
 * @param    int             $length     The length to extract (default is `settings[ length_extract ]`)
 * @param    null|callable   $callback   A callback method to finally transform the string
 * @setting  length_extract              Length of the extracted string
 * @return   string
 */
function hqt_extract($what, $length = null, $callback = null) {
    if (is_null($length)) $length = hqt_setting('length_extract');
    $str = substr(hqt_safestring($what), 0, $length);
    $str = htmlentities(trim(strip_tags($str), "\n"));
    $str = hqt_callback($callback, $str);
    return $str;
}

/**
 * Build a table of contents from an array of items
 * 
 * @param    array          $items        The list items array like `id => content` or `id => sub-items` recursively
 * @param    null|callable  $callback     A callback method to finally transform the string
 * @param    array          $options      An array of options to override current page settings
 * @setting  mask_list
 * @setting  mask_list_item
 * @setting  mask_list_item_content
 * @return   string
 */
function hqt_make_list($items, $callback = null, $options = array()) {
    $str = '';
    if (is_array($items)) {
        $list_options = array_merge(array(
            'mask_list' => hqt_setting('mask_list'),
            'mask_list_item' => hqt_setting('mask_list_item'),
            'mask_list_item_content' => hqt_setting('mask_list_item_content'),
        ), (is_array($options) ? $options : array()));
        foreach ($items as $var=>$val) { 
            if (!is_string($var) && is_string($val)) { $var = $val; }
            if (is_array($val)) {
                $str .= sprintf(
                    $list_options['mask_list_item'],
                    hqt_safestring($var),
                    sprintf($list_options['mask_list_item_content'], hqt_safestring($var), hqt_safestring($var, null, $callback)) . hqt_make_list($val, $callback, $options)
                );
            } else {
                $str .= sprintf(
                    $list_options['mask_list_item'],
                    hqt_safestring($var),
                    sprintf($list_options['mask_list_item_content'], hqt_safestring($var), hqt_safestring($val, null, $callback))
                );
            }
        }
        $str = sprintf($list_options['mask_list'], $str);
    } else {
        $str = hqt_safestring($items);
    }
    return $str;
}

/**
 * Get the "about" modal box content
 *
 * @setting app_name
 * @setting app_description
 * @setting app_infos
 * @setting app_dependencies
 * @setting app_about_notice
 * @return string
 */
function hqt_about() {
    $app_name = hqt_setting('app_name');
    $app_description = hqt_setting('app_description');
    $app_infos = hqt_setting('app_infos');
    $app_dependencies = hqt_setting('app_dependencies');
    $app_about_notice = hqt_setting('app_about_notice');
    $str = '<div class="jumbotron"><h1 class="text-center">'.hqt_safestring($app_name).'</h1>'.(!empty($app_description) ? '<p class="text-center">'.hqt_safestring($app_description).'</p>' : '').'<dl class="dl-horizontal">';
    if (is_array($app_infos)) { foreach ($app_infos as $name=>$val) { $str .= '<dt>'.hqt_safestring($name).'</dt><dd>'.hqt_safestring($val).'</dd>'; } }
    if (is_array($app_dependencies)) {
        $str .= '<dt>third-parties</dt><dd><ul class="list-unstyled">';
        foreach ($app_dependencies as $dep) { $str .= '<li>'.(isset($dep['home']) ? '<a href="'.hqt_safestring($dep['home']).'" title="See online: '.hqt_safestring($dep['home']).'">' : '').hqt_safestring($dep['name']).(isset($dep['home']) ? '</a>' : '').(isset($dep['license']) || isset($dep['version']) ? ' ('.(isset($dep['version']) ? 'v. <em>'.hqt_safestring($dep['version']).'</em>' : '').(isset($dep['license']) && isset($dep['version']) ? ' - ' : '').(isset($dep['license']) ? (isset($dep['license_url']) ? '<a href="'.hqt_safestring($dep['license_url']).'" title="See online">' : '').hqt_safestring($dep['license']).(isset($dep['license_url']) ? '</a>' : ''): '').')' : '').'</li>'; }
        $str .= '</ul></dd>';
    }
    $str .= '</dl>'.(!empty($app_about_notice) ? '<small>'.hqt_safestring($app_about_notice).'</small>' : '').'</div>';
    return $str;
}

################# END OF INTERNAL API ##################################################################################

################# FINAL RENDERING ######################################################################################
/*
 * The final rendering is built by direct output.
 * The HTML construction MUST NOT throw any error or exception.
 * Any DOM ID MUST be get with `hqt_internalid()`.
 * To allow "left-to-right" languages to use the template, you MUST use the following variables
 * instead of raw "left" or "right" when necessary: `$hqt_direction_left` and `$hqt_direction_right`.
 * Any language string MUST be get using `hqt_translate()`.
 * Any HTML tag can contain a `data-jq-XXX` attribute to load its value as original `XXX` attribute if jQuery is loaded.
 */

// env preparation
hqt_prepare($hqt_default_settings, $settings, $hqt_language_strings);
hqt_prepare_dom($content);

// dump env vars when calling this file 
$hqt_arg_mode = (isset($_GET['mode']) ? $_GET['mode'] : null);
if (basename($_SERVER['PHP_SELF'])==basename(__FILE__) && (empty($hqt_arg_mode) || $hqt_arg_mode!='empty')) {
    $hqt_is_manual = true;
    @ini_set('html_errors', 1);
    ob_start();
    echo '<p class="lead">To follow sources updates, create a fork of the template or transmit a bug, please have a look at the GitHub repository at <a href="'.HQT_HOME.'" title="See sources on GitHub">'.HQT_HOME.'</a>. For a full credits info, please see <a href="javascript:showHide(\'hqt-about\');" class="no-hash" data-toggle="modal" data-target="#'.hqt_internalid('messagebox').'">the About box</a>.</p>';
    echo '<h2 id="links">Manuals</h2>';
    echo '<p>The following manuals may be useful using the template:</p><ul><li><a href="http://www.php.net/docs.php">the PHP manual</a></li><li><a href="http://www.whatwg.org/specs/web-apps/current-work/multipage/">the HTML Living Standard</a></li></ul>';
    echo '<p>Use one of the links below to access the third-party libraries documentations:</p><ul><li><a href="http://api.jquery.com/">jQuery API</a></li><li><a href="http://getbootstrap.com/css/">Bootstrap 3 documentation</a></li><li><a href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome icons</a></li></ul>';
    echo '<p>The template tries to keep HTML5 and CSS3 valid. To test your contents, please see:</p><ul><li><a href="http://jigsaw.w3.org/css-validator/">the CSS3 validator provided by the W3C</a></li><li><a href="http://validator.nu/">Validator.nu to check HTML(5) syntax</a></li></ul>';
    echo '<h2 id="vars">Definable variables</h2><p>Dump of variables you can define calling the template and their default values.</p><pre>';
    $vars = get_defined_vars();
    foreach (array('GLOBALS', '_POST', '_GET', '_COOKIE', '_FILES', '_ENV', '_REQUEST', '_SERVER', 'php_errormsg') as $key) { if (array_key_exists($key, $vars)) unset($vars[$key]); }
    foreach ($vars as $k=>$v) { if (substr($k, 0, 3)=='hqt') unset($vars[$k]); }
    foreach ($vars as $k=>$v) { if (substr($k, 0, 5)=='HTTP_') unset($vars[$k]); }
    ksort($vars, SORT_STRING); var_dump($vars);
    echo '</pre><h2 id="opts">Default settings</h2><p>Dump of the default template settings you can overwrite in a personal <code>$settings</code> array.</p><pre>';
    ksort($hqt_default_settings, SORT_STRING); var_dump($hqt_default_settings);
    echo '</pre><h2 id="languages">Default language strings</h2><p>Dump of the default language strings you can overwrite in a personal <code>$settings["language_strings"]</code> array using the same indexes as below.</p><pre>';
    ksort($hqt_language_strings, SORT_STRING); var_dump($hqt_language_strings);
    echo '</pre><h2 id="dev">Development</h2><p>If you are working on the template source (from your own fork for instance), please note that you can set the <code>app_mode</code> on <kbd>dev</kbd> to get a profiler at the bottom of each page. A shortcut may be present at the top of the template script to enable the dev mode quickly. As this profiler is hidden by default, but present in the HTML source, you can add a <code>profiler=on</code> query argument to show it on load (<a href="?profiler=on">test on current URL</a>).</p><p>You can also test the rendering of an empty template (to validate it for instance) adding a <code>mode=empty</code> query argument (<a href="?mode=empty">test on current URL</a>).</p>';
    $content = ob_get_contents();
    ob_end_clean();
    $toc = array( 'links', 'vars'=>'Variables', 'opts'=>'Settings', 'languages'=>'Language strings', 'dev'=>'Development' );
    $update = filemtime(__FILE__);
    $title = HQT_NAME.' '.HQT_VERSION;
    $sub_title = 'internal documentation';
    hqt_internal('brand_title', hqt_stringify(HQT_NAME, 'ucwords'));
    hqt_internal('brand_icon', '<i class="fa fa-code"></i>');
}

// headers
$_headers = hqt_setting('headers');
if (!empty($_headers) && is_array($_headers)) {
    foreach ($_headers as $_head) {
        $_head_val = hqt_setting('header_'.$_head);
        if (!empty($_head_val)) { header($_head.': '.hqt_safestring($_head_val)); }
    }
}

// rendering
$hqt_profiler_mode      = hqt_setting('profiler_mode');
$hqt_direction_left     = (hqt_setting('direction')==='rtl' ? 'right' : 'left');
$hqt_direction_right    = (hqt_setting('direction')==='rtl' ? 'left' : 'right');
?><!DOCTYPE html>
<html lang="<?php echo hqt_safestring(hqt_setting('language')); ?>" dir="<?php echo hqt_setting('direction'); ?>">
<head>
    <meta charset="<?php echo hqt_safestring(hqt_setting('charset')); ?>">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo hqt_setting('libstylesheet_bootstrap'); ?>" rel="stylesheet">
    <link href="<?php echo hqt_setting('libstylesheet_fontawesome'); ?>" rel="stylesheet" id="<?php echo hqt_internalid('lib-fontawesome'); ?>">
    <!--[if lt IE 9]>
      <script src="<?php echo hqt_setting('libscript_html5shiv'); ?>"></script>
      <script src="<?php echo hqt_setting('libscript_respond'); ?>"></script>
    <![endif]-->
<?php
$meta_title = hqt_safestring(hqt_setting('meta_title'));
if (empty($meta_title)) $meta_title = hqt_safestring(hqt_setting('brand_title'));
if (!empty($meta_title)) : ?>
    <title><?php echo $meta_title; ?></title>
<?php endif; ?>
<?php if (!empty($sub_title)) : ?>
    <meta name="description" content="<?php echo hqt_safestring($sub_title); ?>">
<?php endif; ?>
<?php if (!empty($author)) : ?>
    <meta name="author" content="<?php echo hqt_safestring($author, null, null, ', '); ?>">
<?php endif; ?>
<style>
body                            { padding-top: 70px; direction: <?php echo hqt_setting('direction'); ?>; }
.navbar .container              { width: 100%; }
.wrapper                        { padding-bottom: 20px; }
aside, nav                      { margin: 12px; padding: 12px 20px; border-radius: 6px; max-width: 20%; }
aside#<?php echo hqt_internalid('secondary-contents'); ?>        { margin: 15px 20px; padding: 0; position: relative; }
.secondary-content              { margin: 2px; padding: 15px; border-radius: 4px; }
.handler a                      { color: #777777; }
aside, nav ul                   { padding-<?php echo $hqt_direction_left; ?>: 22px; }
.footer                         { font-size: 85%; background-color: #f5f5f5; color: #333333; padding: 12px; border-radius: 6px; position: relative; }
h3                              { padding-<?php echo $hqt_direction_left; ?>: .5em; }
h4:not([id="<?php echo hqt_internalid('toc'); ?>"])              { padding-<?php echo $hqt_direction_left; ?>: 1em; }
h5                              { padding-<?php echo $hqt_direction_left; ?>: 2em; }
h6                              { padding-<?php echo $hqt_direction_left; ?>: 3em; }
.footnotes                      { font-size: .9em; }
.highlight                      { background : #ff0; }
.bg-info                        { background-color: #D9EDF7; }
.bg-default                     { background-color: #f5f5f5; }
.navbar-brand i                 { font-size: 22px; }
form.navbar-form                { position: relative; }
.navbar-form.navbar-<?php echo $hqt_direction_right; ?>:last-child { margin-<?php echo $hqt_direction_right; ?>: 0px; }
input#<?php echo hqt_internalid('search-field'); ?>              { padding-<?php echo $hqt_direction_right; ?>: 24px; }
span.search-icon, span.search-icon-alt                { position: absolute; display: block; top: 10px; <?php echo $hqt_direction_right; ?>: 24px; z-index: 100; cursor: pointer; }
.dropdown-menu li > ul          { list-style-type: none; padding-<?php echo $hqt_direction_left; ?>: 24px; }
.dropdown-menu li > ul li       { margin: 0px; }
.dropdown-menu li li > a        { display: block; padding: 3px 6px; clear: both; font-weight: normal; line-height: 1.428571429; color: #333333; white-space: nowrap; }
.dropdown-menu li li > a:hover,
.dropdown-menu li li > a:focus  { color: #262626; text-decoration: none; background-color: #f5f5f5; }
.modal-body .jumbotron          { padding: 16px !important; margin: 0 !important; border-radius: 6px; }
.modal-body .jumbotron h1       { font-size: 2em; margin-top: 10px; }
body.no-js                      { padding-top: 0px; }
body.no-js .hidden-no-js        { display: none; }
body.no-js aside, body.no-js nav{ max-width: 100%; }
body.no-js .alert-warning       { display: block; padding: 1em; background-color: #dddddd; color: red; text-align: center; }
body.no-js ul.navbar-nav        { list-style-type: none; display: block; padding: 0; }
body.no-js ul.navbar-nav li     { display: inline; padding: 0; }
body.no-js ul.navbar-nav li.hidden-no-js { display: none; }
body.no-js ul.navbar-nav a      { text-decoration: none; }
body.no-js .modal               { border-top: 1px dotted #dddddd; font-size: .86em; }
@media (min-width: 768px) {
    body:not([class="no-js"]) .navbar-nav > li { float: <?php echo $hqt_direction_left; ?>; }
}
@media (min-width: 768px) and (max-width: 991px) {
    aside, nav                      { max-width: 40%; }
    body.no-js aside, body.no-js nav{ max-width: 100%; }
}
@media (max-width: 767px) {
    aside, nav                      { max-width: 100%; }
    aside#<?php echo hqt_internalid('secondary-contents'); ?>        { margin: 10px; }
    .secondary-content              { display: block; min-width: 100%; }
    span.search-icon                { top: 40px; }
    .responsive                     { width: 100%; overflow: auto; }
    .navbar li a .visible-xs        { display: inline !important; }
    .dropdown-menu li li > a        { color: #777777; }
    .dropdown-menu li li > a:hover,
    .dropdown-menu li li > a:focus  { background-color: transparent; }
    .modal-body                     { padding: 10px; }
    body.no-js aside, body.no-js nav{ max-width: 100%; }
}
@media print {
    body                       { font-size: 10pt; padding-top: 0; }
    aside#<?php echo hqt_internalid('secondary-contents-print'); ?>        { margin: 1em 0; clear: both; display: block; min-width: 100% !important; font-size: .9em; }
    .secondary-content         { border-top: 1px dotted #dddddd; }
    footer                     { margin-top: 1em; padding-top: 4px; border-top: 1px dotted #dddddd; font-size: .86em; }
}
@media screen and (-webkit-min-device-pixel-ratio:0) {
    select:focus, textarea:focus, input:focus { font-size: 16px; }
}
</style>
<?php echo hqt_safestringifarray($metas, hqt_setting('mask_meta')); ?>
<?php echo hqt_safestringifarray($stylesheets, hqt_setting('mask_stylesheet')); ?>
<style>
<?php echo hqt_safestring($css); ?>
</style>
</head>
<body data-offset="70" class="no-js">
    <!--[if lt IE 7]>
    <div class="alert alert-warning alert-dismissable">
        <button type="button" class="close hidden-no-js" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong><?php echo hqt_translate('warning'); ?></strong> <?php echo hqt_translate('outdated_browser_info'); ?>
    </div>
    <![endif]-->
    <div class="alert alert-warning hidden"><?php echo hqt_translate('internet_connection_off'); ?></div>
    <a id="<?php echo hqt_internalid('top'); ?>"></a>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header navbar-<?php echo $hqt_direction_left; ?> hidden-no-js">
                <button id="<?php echo hqt_internalid('main-navbar-handler'); ?>" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" title="<?php echo hqt_translate('navigation_menu_title'); ?>">
                    <span class="sr-only"><?php echo hqt_translate('toggle_navigation'); ?></span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $self; ?>" title="<?php echo hqt_translate('brand_button_title'); ?>">
                    <?php $icon = hqt_setting('brand_icon'); if (!empty($icon)) : ?>
                        <?php echo is_array($icon) ? $icon[array_rand($icon)] : $icon;?>&nbsp;
                    <?php endif; ?>
                    <?php echo hqt_safestring(hqt_setting('brand_title')); ?>
                </a>
            </div>
            <div id="<?php echo hqt_internalid('main-navbar'); ?>" class="navbar-collapse collapse">
<?php if (!empty($menu) && @in_array('menu', hqt_setting('navbar_items'))) : ?>
                <ul class="nav navbar-nav navbar-<?php echo $hqt_direction_left; ?>">
    <?php foreach ($menu as $menu_item) : ?>
        <?php if (isset($menu_item['items']) && !empty($menu_item['items'])) : ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php if (isset($menu_item['title'])) echo hqt_translate($menu_item['title']); ?>"><?php if (isset($menu_item['content'])) echo hqt_translate($menu_item['content']); ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
            <?php foreach ($menu_item['items'] as $menu_sub_item) : ?>
                            <li><a href="<?php if (isset($menu_sub_item['url'])) echo $menu_sub_item['url']; ?>" title="<?php if (isset($menu_sub_item['title'])) echo hqt_translate($menu_sub_item['title']); ?>"><?php if (isset($menu_item['content'])) echo hqt_translate($menu_sub_item['content']); ?></a></li>
            <?php endforeach; ?>
                        </ul>
                    </li>
        <?php else: ?>
                    <li><a href="<?php if (isset($menu_item['url'])) echo $menu_item['url']; ?>" title="<?php if (isset($menu_item['title'])) echo hqt_translate($menu_item['title']); ?>"><?php if (isset($menu_item['content'])) echo hqt_translate($menu_item['content']); ?></a></li>
        <?php endif; ?>
    <?php endforeach; ?>
                </ul>
<?php endif; ?>
                <ul class="nav navbar-nav navbar-<?php echo $hqt_direction_right; ?>">
<?php if (!empty($toc) && @in_array('toc', hqt_setting('navbar_items'))) : ?>
                    <li><a href="#<?php echo hqt_internalid('toc'); ?>" title="<?php echo hqt_translate('toc_menu_item_title'); ?>"><i class="fa fa-book"></i><span class="hidden-sm">&nbsp;<?php echo hqt_translate('toc_menu_item');; ?></span></a></li>
<?php endif; ?>
<?php if (!empty($notes) && @in_array('notes', hqt_setting('navbar_items'))) : ?>
                    <li><a href="#<?php echo hqt_internalid('notes'); ?>" title="<?php echo hqt_translate('notes_menu_item_title'); ?>"><i class="fa fa-thumb-tack"></i><span class="hidden-sm">&nbsp;<?php echo hqt_translate('notes_menu_item');; ?></span></a></li>
<?php endif; ?>
<?php if (@in_array('top', hqt_setting('navbar_items'))) : ?>
                    <li class="hidden-no-js"><a href="#<?php echo hqt_internalid('top'); ?>" title="<?php echo hqt_translate('top_menu_item_title'); ?>"><i class="fa fa-angle-up"></i><span class="hidden-sm">&nbsp;<?php echo hqt_translate('top_menu_item'); ?></span></a></li>
<?php endif; ?>
<?php if (@in_array('bottom', hqt_setting('navbar_items'))) : ?>
                    <li><a href="#<?php echo hqt_internalid('bottom'); ?>" title="<?php echo hqt_translate('bottom_menu_item_title'); ?>"><i class="fa fa-angle-down"></i><span class="hidden-sm">&nbsp;<?php echo hqt_translate('bottom_menu_item'); ?></span></a></li>
<?php endif; ?>
<?php if (@in_array('summary', hqt_setting('navbar_items')) && (!empty($secondary_contents) || !empty($toc))) : ?>
                    <li class="dropdown hidden-no-js">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="<?php echo hqt_translate('summary_menu_item_title'); ?>"><?php echo hqt_translate('summary_menu_item'); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
    <?php if (!empty($toc)) : ?>
                            <?php
                            $toc_menu = hqt_make_list($toc, array('hqt_stringify','ucfirst'), array(
                                'mask_list' => hqt_setting('mask_list_toc'),
                                'mask_list_item' => hqt_setting('mask_list_item_toc'),
                                'mask_list_item_content' => hqt_setting('mask_list_item_content_toc'),
                            )); 
                            echo substr($toc_menu, strlen('<ul>'), -(strlen('</ul>')));
                            ?>
        <?php if (!empty($secondary_contents)) : ?>
                            <li class="divider"></li>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (!empty($secondary_contents)) : ?>
        <?php foreach ($secondary_contents as $i => $_item) : $id = hqt_slugify($i); ?>
                            <li><a href="#<?php echo hqt_internalid('secondary-content-'.$id); ?>" title="<?php echo hqt_extract($_item); ?>" class="anchor-to-collapsible"><?php echo (is_string($i) ? hqt_stringify($i) : hqt_extract($_item, hqt_setting('length_title'))); ?></a></li>
        <?php endforeach; ?>
    <?php endif; ?>
                        </ul>
                    </li>
<?php endif; ?>
                    <li class="active"><?php echo hqt_safestring(hqt_setting('menu_item_content_stamp')); ?></li>
                </ul>
                <form class="navbar-form navbar-<?php echo $hqt_direction_right; ?> hidden-no-js" role="search">
                    <span id="<?php echo hqt_internalid('result-count'); ?>" class="text-primary"></span>&nbsp;
                    <span id="<?php echo hqt_internalid('delete-search-alt'); ?>" class="text-primary search-icon-alt visible-xs hidden">[<?php echo hqt_translate('search_field_mobile_clear'); ?>]</span>
                    <input id="<?php echo hqt_internalid('search-field'); ?>" class="form-control" type="search" tabindex="1" placeholder="<?php echo hqt_translate('search_field_placeholder'); ?>" title="<?php echo hqt_translate('search_field_title'); ?>">
                    <span id="<?php echo hqt_internalid('icon-search'); ?>" class="search-icon fa fa-search"></span>
                    <span id="<?php echo hqt_internalid('delete-search'); ?>" class="text-primary search-icon fa fa-times hidden" title="<?php echo hqt_translate('search_field_clear_title'); ?>"></span>
                </form>
            </div>
        </div>
    </div>
    <div id="<?php echo hqt_internalid('wrapper'); ?>" class="wrapper container-fluid">
<?php if (!empty($secondary_contents)) : ?>
        <aside id="<?php echo hqt_internalid('secondary-contents'); ?>" class="hidden-print pull-<?php echo $hqt_direction_right; ?>">
    <?php foreach ($secondary_contents as $i => $_item) : $id = hqt_slugify($i); ?>
            <div class="secondary-content bg-default">
                <p class="text-muted handler">
                    <a class="no-hash" data-toggle="collapse" href="javascript:showHide('<?php echo hqt_internalid('secondary-content-'.$id); ?>');" data-jq-href="#<?php echo hqt_internalid('secondary-content-'.$id); ?>" onClick="$(this).find('i').toggleClass('fa-angle-up').toggleClass('fa-angle-down');" title="<?php echo hqt_translate('secondary_block_handler_title'); ?>">
                        <i class="fa fa-angle-up"></i>&nbsp;<?php echo ($id != (string) $i) ? hqt_stringify($i) : hqt_translate('show_hide'); ?>
                    </a>
                </p>
                <div id="<?php echo hqt_internalid('secondary-content-'.$id); ?>" class="collapse in">
                    <?php echo hqt_safestring($_item); ?>
                </div>
            </div>
    <?php endforeach; ?>
        </aside>
        <div class="clearfix visible-xs"></div>
<?php endif; ?>
        <article>
<?php if (!empty($title)) : ?>
            <header>
                <h1><?php echo hqt_safestring($title); ?> <small><?php echo hqt_safestring($sub_title); ?></small></h1>
            </header>
<?php endif; ?>
<?php if (!empty($toc)) : ?>
            <nav class="bg-info <?php echo (!empty($secondary_contents)) ? 'pull-'.$hqt_direction_left : 'pull-'.$hqt_direction_right; ?> hidden-print">
    <?php $block_title_toc = hqt_translate('toc_block_header'); if (!empty($block_title_toc)) : ?>
                <h4 id="<?php echo hqt_internalid('toc'); ?>"><?php echo hqt_safestring($block_title_toc); ?></h4>
    <?php endif; ?>
                <?php echo hqt_make_list($toc, array('hqt_stringify','ucfirst'), array(
                    'mask_list' => hqt_setting('mask_list_toc'),
                    'mask_list_item' => hqt_setting('mask_list_item_toc'),
                    'mask_list_item_content' => hqt_setting('mask_list_item_content_toc'),
                )); ?>
            </nav>
            <div class="clearfix visible-xs"></div>
<?php endif; ?>
            <?php echo hqt_safestring($content); ?>
<?php if (!empty($notes)) : ?>
            <hr class="hidden-print" />
            <footer>
                <div class="footnotes">
    <?php $block_title_notes = hqt_translate('notes_block_header'); if (!empty($block_title_notes)) : ?>
                    <h4 id="<?php echo hqt_internalid('notes'); ?>"><?php echo hqt_safestring($block_title_notes); ?></h4>
    <?php endif; ?>
                    <?php echo hqt_make_list($notes, array('hqt_stringify'), array(
                        'mask_list' => hqt_setting('mask_list_notes'),
                        'mask_list_item' => hqt_setting('mask_list_item_notes'),
                        'mask_list_item_content' => hqt_setting('mask_list_item_content_notes'),
                    )); ?>
                </div>
            </footer>
<?php endif; ?>
<?php if (!empty($author) || !empty($update) || !empty($content_notice)) : ?>
            <hr class="hidden-print" />
            <footer class="text-<?php echo $hqt_direction_right; ?> text-muted"><p class="small">
    <?php if (!empty($content_notice)) : ?>
                <?php echo hqt_safestring($content_notice); ?>
        <?php if (!empty($author) || !empty($update)) : ?>
                <br class="visible-xs">
        <?php endif; ?>
    <?php endif; ?>
    <?php if (!empty($author)) : ?>
                <?php echo hqt_translate('author_info', array(hqt_safestring($author, null, null, ', '))); ?>
        <?php if (!empty($update)) : ?>
                <br class="visible-xs">
        <?php endif; ?>
    <?php endif; ?>
    <?php if (!empty($update)) : ?>
                <?php echo hqt_translate('last_update_info', array(hqt_datify($update))); ?>
    <?php endif; ?>
            </p></footer>
<?php endif; ?>
        </article>
        <div class="clearfix"></div>
<?php if (!empty($secondary_contents)) : ?>
        <aside id="<?php echo hqt_internalid('secondary-contents-print'); ?>" class="visible-print"></aside>
        <div class="clearfix visible-xs"></div>
<?php endif; ?>
        <footer>
            <div class="footer printer-footer">
                <div class="pull-<?php echo $hqt_direction_right; ?> text-<?php echo $hqt_direction_right; ?>">
    <?php if (!empty($page_notice)) : ?>
                    <?php echo hqt_safestring($page_notice); ?><br>
    <?php endif; ?>
                    <?php echo hqt_translate('footer_info_app', array(HQT_HOME, HQT_NAME.' '.HQT_VERSION, HQT_NAME)); ?><br><?php echo hqt_translate('footer_info_dependencies'); ?>
                </div>
                <div class="pull-<?php echo $hqt_direction_left; ?> responsive hidden-print">
                    <div class="clearfix visible-xs"><br /></div>
                    <div>
                        <ul class="nav nav-pills">
<?php if (in_array($hqt_profiler_mode, array('on', 'hidden'))) : ?>
                            <li class="handler"><a id="<?php echo hqt_internalid('profiler-handler'); ?>" class="no-hash profiler-component" data-toggle="collapse" href="javascript:showHide('<?php echo hqt_internalid('profiler'); ?>');" data-jq-title="<?php echo hqt_translate('profiler_button_title'); ?>" data-jq-href="#<?php echo hqt_internalid('profiler'); ?>"><i class="fa fa-cogs"></i>&nbsp;<?php echo hqt_translate('profiler_button'); ?></a></li>
<?php endif; ?>
<?php if (!isset($hqt_is_manual) || true!==$hqt_is_manual) : ?>
                            <li class="handler"><a href="javascript:showHide('<?php echo hqt_internalid('hqt-about'); ?>');" class="no-hash" data-toggle="modal" data-target="#<?php echo hqt_internalid('messagebox'); ?>" data-jq-title="<?php echo hqt_translate('about_button_title'); ?>"><i class="fa fa-info-circle"></i>&nbsp;<?php echo hqt_translate('about_button'); ?></a></li>
    <?php $app_manual = hqt_setting('app_manual_url'); if (!empty($app_manual)) : ?>
                            <li class="handler"><a href="<?php echo $app_manual; ?>" title="<?php echo hqt_translate('manual_button_title'); ?>"><i class="fa fa-globe"></i>&nbsp;<?php echo hqt_translate('manual_button'); ?></a></li>
    <?php endif; ?>
<?php endif; ?>
<?php if (@in_array('top', hqt_setting('navbar_items'))) : ?>
                            <li class="handler hidden"><a href="#<?php echo hqt_internalid('top'); ?>" title="<?php echo hqt_translate('top_menu_item_title'); ?>"><i class="fa fa-angle-up"></i><span class="hidden-sm">&nbsp;<?php echo hqt_translate('top_menu_item'); ?></span></a></li>
<?php endif; ?>
                        </ul>
<?php if (in_array($hqt_profiler_mode, array('on', 'hidden'))) : ?>
                        <div id="<?php echo hqt_internalid('profiler'); ?>" class="profiler-component collapse" style="display: none;" data-jq-style=""><small class="hidden">[<a href="javascript:showHide('<?php echo hqt_internalid('profiler'); ?>');">close</a>]</small>
                            <dl class="dl-horizontal">
    <?php $profiler = hqt_setting('profiler_stack'); if (!empty($profiler)) : if (!is_array($profiler)) $profiler = array($profiler); ?>
        <?php foreach ($profiler as $var=>$val) : ?>
            <dt><?php echo hqt_translate($var); ?></dt>
            <dd id="<?php echo $var; ?>"><?php echo hqt_safestring($val); ?></dd>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php $profiler = hqt_setting('profiler_user_stack'); if (!empty($profiler)) : if (!is_array($profiler)) $profiler = array($profiler); ?>
        <?php foreach ($profiler as $var=>$val) : ?>
                                <dt><?php echo (is_string($var) ? hqt_safestring($var) : ''); ?></dt>
                                <dd id="<?php echo hqt_internalid('profiler-'.hqt_slugify($var)); ?>"><?php echo hqt_safestring($val); ?></dd>
        <?php endforeach; ?>
    <?php endif; ?>
                            </dl>
                        </div>
<?php endif; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </footer>
        <footer class="visible-print">
            <p class="small"><?php echo hqt_translate('footer_print_info'); ?>: <span id="<?php echo hqt_internalid('printer-request'); ?>"></span></p>
        </footer>
    </div>
    <div class="clearfix"></div>
    <a id="<?php echo hqt_internalid('bottom'); ?>"></a>
    <div id="<?php echo hqt_internalid('messagebox'); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="<?php echo hqt_internalid('messageboxLabel'); ?>" aria-hidden="true">
        <div class="modal-dialog"><div class="modal-content">
            <div class="hidden-no-js modal-header"><button type="button" class="close pull-<?php echo $hqt_direction_right; ?>" data-dismiss="modal" aria-hidden="true" title="<?php echo hqt_translate('close_this_modal_box'); ?>">x</button><h4 class="modal-title" id="<?php echo hqt_internalid('messageboxLabel'); ?>"><i class="fa fa-info-circle"></i>&nbsp;<?php echo hqt_translate('about_box_title'); ?></h4></div>
            <div class="modal-body" id="<?php echo hqt_internalid('hqt-about'); ?>" style="display: none;" data-jq-style=""><small class="hidden">[<a href="javascript:showHide('<?php echo hqt_internalid('hqt-about'); ?>');">close</a>]</small><?php echo hqt_about(); ?></div>
            <div class="hidden-no-js modal-footer hidden"></div>
        </div></div>
    </div>
    <script src="<?php echo hqt_setting('libscript_jquery'); ?>" id="<?php echo hqt_internalid('lib-jquery'); ?>"></script>
    <script src="<?php echo hqt_setting('libscript_bootstrap'); ?>" id="<?php echo hqt_internalid('lib-bootstrap'); ?>"></script>
<script>
var _query          = document.location.search.substr(1);
var _searchString   = _query.substr(_query.indexOf("search=")).split("&")[0].split("=")[1];
<?php if (in_array($hqt_profiler_mode, array('on', 'hidden'))) : ?>
document.getElementById("<?php echo hqt_internalid('profiler-user-agent'); ?>").innerHTML = navigator.userAgent;
document.getElementById("<?php echo hqt_internalid('profiler-request'); ?>").innerHTML    = document.location.href;
<?php endif; ?>
document.getElementById("<?php echo hqt_internalid('printer-request'); ?>").innerHTML     = document.location.href;
function showHide(elementid){
    if (!window.jQuery) { document.getElementById(elementid).style.display = (document.getElementById(elementid).style.display == 'none' ? '' : 'none'); document.location.hash = elementid; }
}
function getScriptVersion(script_id) {
    var script = $("#"+script_id), script_src = script.attr("src"), script_href = script.attr("href"),
        matcher = new RegExp(/\d+(?:\.\d+)+/g), vers = null;
    if (script_src!==undefined && script_src.length) vers = script_src.match(matcher);
    else if (script_href!==undefined && script_href.length) vers = script_href.match(matcher);
    return vers;
}
function clearSearchField(full) {
    if (full) {
        $("#<?php echo hqt_internalid('search-field'); ?>").val("");
        $("#<?php echo hqt_internalid('result-count'); ?>").text("");
        if (_searchString) { document.location.href = document.location.href.replace("search="+_searchString, ''); }
    }
    $("#<?php echo hqt_internalid('icon-search'); ?>").removeClass("hidden");
    $("#<?php echo hqt_internalid('delete-search'); ?>, #<?php echo hqt_internalid('delete-search-alt'); ?>").addClass("hidden");
    $("#<?php echo hqt_internalid('wrapper'); ?>").removeHighlight();
}
function scrollToAnchor(href) {
    href = typeof(href) == "string" ? href : $(this).attr("href");
    if (!href) return; if (href.charAt(0) == "#") {
        var $target = $(href); if ($target.length) {
            $('html, body').animate({ scrollTop: $target.offset().top - 70 }, "slow");
            if (history && "pushState" in history) { history.pushState({}, document.title, window.location.pathname + href); }
        }
    }
}
function scrollToAnchorCollapsible(el) {
    var tgt = $($(el).attr("href")); if (tgt && !tgt.hasClass("in")) { tgt.collapse('show'); }
}
function closeNavbarMenu() {
    if ($("#<?php echo hqt_internalid('main-navbar-handler'); ?>").is(':visible')) { $("#<?php echo hqt_internalid('main-navbar-handler'); ?>").trigger('click'); }
}

/*
 highlight v4 - Highlights arbitrary terms - MIT license - Johann Burkard
 <http://johannburkard.de/blog/programming/javascript/highlight-javascript-text-higlighting-jquery-plugin.html>
 */
jQuery.fn.highlight=function(c){function e(b,c){var d=0;if(3==b.nodeType){var a=b.data.toUpperCase().indexOf(c);if(0<=a){d=document.createElement("span");d.className="highlight";a=b.splitText(a);a.splitText(c.length);var f=a.cloneNode(!0);d.appendChild(f);a.parentNode.replaceChild(d,a);d=1}}else if(1==b.nodeType&&b.childNodes&&!/(script|style)/i.test(b.tagName))for(a=0;a<b.childNodes.length;++a)a+=e(b.childNodes[a],c);return d}return this.length&&c&&c.length?this.each(function(){e(this,c.toUpperCase())}): this};jQuery.fn.removeHighlight=function(){return this.find("span.highlight").each(function(){this.parentNode.firstChild.nodeName;with(this.parentNode)replaceChild(this.firstChild,this),normalize()}).end()};

$(function() {
    $("body").removeClass("no-js");
    $("*").each(function(i,el){
        $.each(el.attributes, function(j,attr) {
            if(attr.name.indexOf("data-jq-") == 0) { $(el).attr(attr.name.replace("data-jq-", ""), $(el).attr(attr.name)); $(el).attr(attr.name, ""); }
        });
    });
    window.onbeforeprint = function() {
        var _sc_original = $("#<?php echo hqt_internalid('secondary-contents'); ?>"), _sc_target = $("#<?php echo hqt_internalid('secondary-contents-print'); ?>");
        if (_sc_original) { _sc_target.html(_sc_original.html()); }
    };
    window.onafterprint = function() {
        var _sc_target = $("#<?php echo hqt_internalid('secondary-contents-print'); ?>");
        if (_sc_target) { _sc_target.html(""); }
    };
    $("a:not(.no-hash, .anchor-to-collapsible)").on("click", scrollToAnchor);
    $("a.anchor-to-collapsible").on("click", function(){ scrollToAnchorCollapsible($(this)); scrollToAnchor($(this).attr("href")); });
    $("#main-navbar a:not(.dropdown-toggle)").on("click", closeNavbarMenu);
<?php if (in_array($hqt_profiler_mode, array('on', 'hidden'))) : ?>
    $("#<?php echo hqt_internalid('profiler-apps'); ?>").html(
        $("#<?php echo hqt_internalid('profiler-apps'); ?>").html()
        +" | jQuery "+jQuery.fn.jquery
        +" | Bootstrap "+getScriptVersion("<?php echo hqt_internalid('lib-bootstrap'); ?>")
        +" | FontAwesome "+getScriptVersion("<?php echo hqt_internalid('lib-fontawesome'); ?>")
    );
    var _profilerString = _query.substr(_query.indexOf("profiler=")).split("&")[0].split("=")[1];
    <?php if ($hqt_profiler_mode=='hidden') : ?>
    if (_profilerString==undefined || _profilerString!='on') { $(".profiler-component").hide(); }
    <?php endif; ?>
    <?php if (in_array($hqt_profiler_mode, array('on','hidden'))) : ?>
    if (_profilerString && _profilerString=='off') { $(".profiler-component").hide(); }
    <?php endif; ?>
<?php endif; ?>
    $("#<?php echo hqt_internalid('delete-search'); ?>, #<?php echo hqt_internalid('delete-search-alt'); ?>").click(function() { clearSearchField(true); });
    $(document).keyup(function(e) { if (e.keyCode == 27) { clearSearchField(true); } });
    $("#<?php echo hqt_internalid('delete-search'); ?>").attr("title", $("#<?php echo hqt_internalid('delete-search'); ?>").attr("title")+" [ESC]");
    var searchField = {};
    searchField.input = $("#<?php echo hqt_internalid('search-field'); ?>");
    searchField.performSearch = function() {
        clearSearchField();
        var phrase = searchField.input.val().replace(/^\s+|\s+$/g, ""), count=0, matches, phrase_regex;
        phrase = phrase.replace(/\s+/g, "|");
        if (phrase.length == 0) { clearSearchField(true); return; }
        if (phrase.length < 3) { return; }
        $("#<?php echo hqt_internalid('icon-search'); ?>").addClass("hidden");
        $("#<?php echo hqt_internalid('delete-search'); ?>, #<?php echo hqt_internalid('delete-search-alt'); ?>").removeClass("hidden");
        phrase_regex = ["\\b(", phrase, ")"].join("");
        matches = $("#<?php echo hqt_internalid('wrapper'); ?>").html().match(new RegExp(phrase_regex, "gi"));
        count = matches ? (matches.length) : 0;
        $("#<?php echo hqt_internalid('wrapper'); ?>").highlight(phrase);
        $("#<?php echo hqt_internalid('result-count'); ?>").text(count + " <?php echo hqt_translate('results'); ?>");
        searchField.search = null;
    };
    searchField.input.keyup(function(e) {
        if (searchField.search) { clearTimeout(searchField.search); }
        searchField.search = setTimeout(searchField.performSearch, 300);
    });
    if (_searchString) {
        $("#<?php echo hqt_internalid('search-field'); ?>").val(_searchString).select().focus();
        searchField.performSearch();
    } else {
        searchField.search;
    }
});
</script>
<?php echo hqt_safestringifarray($scripts, hqt_setting('mask_script')); ?>
<script>
<?php echo hqt_safestring($js); ?>
</script>
</body>
</html>
