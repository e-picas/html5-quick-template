<?php
/**
 * HTML5 Quick Template - A simple blank HTML5 template for quick rendering
 * Copyright (C) 2014 PieroWbmstr <http://github.com/pierowbmstr>

 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// debug
//error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 1);


/**
 * @var	string	The page title
 */
if (!isset($title)) $title = '';

/**
 * @var	string	The page sub-title
 */
if (!isset($sub_title)) $sub_title = '';

/**
 * @var	string	The page content
 */
if (!isset($content)) $content = '';

/**
 * @var	array	The page content notes like `id => note content`
 */
if (!isset($notes)) $notes = array();

/**
 * @var	array	The page table of contents like `id => title` or `id => items` with items like `id => title`
 */
if (!isset($toc)) $toc = array();

/**
 * @var	array	The page content additional meta tags like `name => value`
 */
if (!isset($metas)) $metas = array();

/**
 * @var	array	The page additional stylsheets `src` list
 */
if (!isset($stylesheets)) $stylesheets = array();

/**
 * @var	array	The page additional scripts `src` list
 */
if (!isset($scripts)) $scripts = array();

/**
 * @var	string	The page inline css rules written last
 */
if (!isset($css)) $css = '';

/**
 * @var	string	The page inline javascript code executed after all scripts load
 */
if (!isset($js)) $js = '';

/**
 * Returns a safe string passing it in `$mask` with `sprintf()` and transforming it
 * if `$transform===true`
 * 
 * @param	misc	$what		The original content to stringify
 * @param	string	$mask		The mask to use to build the content
 * @param	bool	$readable	Make a readable content or not (default is NOT)
 * @return	string
 */
function safely($what, $mask = '%s', $readable = false)
{
	$str = '';
	if (is_array($what)) {
		foreach ($what as $var=>$val) {
			$valnum = substr_count($mask, '%s');
			$str .= $valnum>1 ? sprintf($mask, $var, $val) : sprintf($mask, $val);
		}
	} elseif (is_string($what)) {
		$str .= sprintf($mask, $what);
		if ($readable===true) {
			$str = ucfirst(str_replace(array('-', '_'), ' ', $str));
		}
	}
	return $str; 
}

/**
 * Build a table of contents from an array of items
 * 
 * @param	array	$toc	The contents array like `id => title` or `id => items` with `items` constructed like `$toc`
 * @return	string
 */
function make_toc($toc)
{
	$str = '';
	if (is_array($toc)) {
		$str .= '<ul>';
		foreach ($toc as $var=>$val) { 
			if (!is_string($var) && is_string($val)) { $var = $val; }
			if (is_array($val)) {
				$str .= '<li><a href="#'.safely($var).'">'.safely($var, '%s', true).'</a>';
				$str .= make_toc($val);
				$str .= '</li>'; 
			} else {
				$str .= '<li><a href="#'.safely($var).'">'.safely($val, '%s', true).'</a></li>'; 
			}
		}
		$str .= '</ul>';
	} else {
		$str = safely($toc);
	}
	return $str;
}

/**
 * Build a list of notes from an array of items
 * 
 * @param	array	$notes	The notes array like `id => info`
 * @return	string
 */
function make_notes($notes)
{
	$str = '';
	if (is_array($notes)) {
		$str .= '<ol>';
		foreach ($notes as $var=>$val) { 
			if (!is_string($var) && is_string($val)) { $var = $val; }
			$str .= '<li id="'.safely($var).'">'.safely($val, '%s', true).'</li>'; 
		}
		$str .= '</ol>';
	} else {
		$str = safely($notes);
	}
	return $str;
}

// rendering
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="en">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 3.1.1 <http://getbootstrap.com/> -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome 4.0.3 <http://fortawesome.github.io/Font-Awesome> -->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
    <title><?php echo safely($title); ?></title>
<?php if (!empty($sub_title)) : ?>
	<meta name="description" content="<?php echo safely($sub_title); ?>">
<?php endif; ?>
    <style>
    .navbar .container { width: 100%; }
    .wrapper    { padding-top: 60px; padding-bottom: 20px; }
    aside       { margin: 12px; padding: 12px; border-radius: 6px; }
    aside ul    { padding-left: 22px; }
    .footer     { background-color: #f5f5f5; color: #333333; padding: 12px; border-radius: 6px; }
    h3          { padding-left: .5em; }
    h4          { padding-left: 1em; }
    h5          { padding-left: 2em; }
    h6          { padding-left: 3em; }
    .footnotes  { font-size: .9em; }
    .highlight  { background : #ff0; }
    form		{ position: relative; }
    input[type="search"] { padding-right: 24px; }
    span#delete-search { position: absolute; display: block; top: 10px; right: 24px; z-index: 100; cursor: pointer; }
    </style>
<?php echo safely($metas, '<meta name="%s" content="%s">'); ?>
<?php echo safely($stylesheets, '<link href="%s" rel="stylesheet">'); ?>
<style>
<?php echo safely($css); ?>
</style>
</head>
<body data-offset="80">
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
                    <li><a href="#toc" title="Reach the table of contents"><i class="fa fa-angle-right"></i>&nbsp;Table of Contents</a></li>
<?php endif; ?>
                    <li><a href="#top" title="Reach the top of the page"><i class="fa fa-angle-up"></i>&nbsp;Top</a></li>
                    <li><a href="#bottom" title="Reach the bottom of the page"><i class="fa fa-angle-down"></i>&nbsp;Bottom</a></li>
                    <li class="active"><a title="http://github.com/atelierspierrot/html5-quick-template" href="http://github.com/atelierspierrot/html5-quick-template">&nbsp;<i class="fa fa-github"></i>&nbsp;</a></li>
                </ul>
                <form class="navbar-form navbar-right">
					<span class="result-count text-primary"></span>&nbsp;
					<input class="form-control" type="search" id="search" placeholder="search ..." title="In-page highlighting search field">
					<span id="delete-search" class="text-primary hidden fa fa-spinner" title="Clear the search field"></span>
				</form>
            </div>
        </div>
    </div>
	<div class="wrapper container-fluid">
		<article>
			<header>
				<h1><?php echo safely($title); ?> <small><?php echo safely($sub_title); ?></small></h1>
			</header>
<?php if (!empty($toc)) : ?>
		    <aside role="navigation" class="bg-info pull-right">
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
		</article>
		<footer>
		    <div class="footer">
				<div class="pull-left"><small>
					<span class="badge"><?php echo date('d M Y H:i:s'); ?></span>
					<br>
					<span class="badge" id="user-agent"></span>
					<br>
					<span class="badge"><?php echo php_uname(); ?></span>
				</small></div>
				<div class="pull-right text-right"><small>
					Page generated from <a href="http://github.com/atelierspierrot/html5-quick-template" title="github.com/atelierspierrot/html5-quick-template">html5-quick-template</a>.
					<br>
					Page built with the help of open source stuffs such as 
					<a href="http://jquery.com/" title="jquery.com">jQuery</a>, 
					<a href="http://getbootstrap.com/" title="getbootstrap.com">Bootstrap</a> and 
					<a href="http://fortawesome.github.io/Font-Awesome" title="fortawesome.github.io/Font-Awesome">Font Awesome</a>.
				</small></div>
				<div class="clearfix"></div>
			</div>
		</footer>
	</div>
	<div class="clearfix"></div>
	<a id="bottom"></a>
	<!-- jQuery 1.11.0 <http://jquery.com/> -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- Bootstrap 3.1.1 <http://getbootstrap.com/> -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script>
/*
highlight v4 - Highlights arbitrary terms - MIT license - Johann Burkard
<http://johannburkard.de/blog/programming/javascript/highlight-javascript-text-higlighting-jquery-plugin.html>
*/
jQuery.fn.highlight=function(c){function e(b,c){var d=0;if(3==b.nodeType){var a=b.data.toUpperCase().indexOf(c);if(0<=a){d=document.createElement("span");d.className="highlight";a=b.splitText(a);a.splitText(c.length);var f=a.cloneNode(!0);d.appendChild(f);a.parentNode.replaceChild(d,a);d=1}}else if(1==b.nodeType&&b.childNodes&&!/(script|style)/i.test(b.tagName))for(a=0;a<b.childNodes.length;++a)a+=e(b.childNodes[a],c);return d}return this.length&&c&&c.length?this.each(function(){e(this,c.toUpperCase())}): this};jQuery.fn.removeHighlight=function(){return this.find("span.highlight").each(function(){this.parentNode.firstChild.nodeName;with(this.parentNode)replaceChild(this.firstChild,this),normalize()}).end()};

$(function() {
	$('#user-agent').html(navigator.userAgent);
	$('#delete-search').click(function() { 
		$('#search').val('');
		$("#delete-search").addClass("hidden");
		$(".wrapper").removeHighlight();
		$(".result-count").text("");
	});
	var self = this;
	self.input = $("#search");
	self.performSearch = function() {
		$("#delete-search").addClass("hidden");
		var phrase = self.input.val().replace(/^\s+|\s+$/g, ""),
			count = 0, matches, phrase_regex;
		phrase = phrase.replace(/\s+/g, "|");
		$(".wrapper").removeHighlight();
		if (phrase.length < 3) { return; }
		$("#delete-search").removeClass("hidden").removeClass("fa-times").addClass("fa-spinner");
		phrase_regex = ["\\b(", phrase, ")"].join("");
		matches = $(".wrapper").html().match(new RegExp(phrase_regex, "gi"));
		count = matches ? (matches.length) : 0;
		$(".wrapper").highlight(phrase);
		$(".result-count").text(count + " results");
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
<?php echo safely($scripts, '<script src="%s"></script>'); ?>
<script>
<?php echo safely($js); ?>
</script>
</body>
</html>
