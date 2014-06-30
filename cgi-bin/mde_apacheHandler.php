#!/usr/bin/env php
<?php
#
# PHP-CGI-script to parse Markdown files with the PHP Markdown Extended class by APACHE direct handling
# Copyright (c) 2004-2014 Pierre Cassat
# Sources at <http://github.com/piwi/html5-quick-template/tree/mde-master>
#

@error_reporting(-1);

## Config
$HERE           = getcwd();
$CONSOLE        = realpath($HERE.'/markdown-extended/bin/markdown-extended');
$CONTENT_TYPE   = 'text/html';
$CHARSET        = 'utf-8';
$OPTIONS        = '-t='.realpath($HERE.'/mde-html5-quick-template.html');
$PHP_BIN        = 'php';
$REQ            = $_SERVER['PATH_TRANSLATED'];
$PLAIN          = $_SERVER['QUERY_STRING'];

## adjustments
$domain = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : null;
if (!empty($domain) && substr($domain, 0, 3)!=='www') {
    $subdomains_table = array(
    );
    $subdomain = substr($domain, 0, strpos($domain, '.'));
    if (array_key_exists($subdomain, $subdomains_table)) {
        $REQ = str_replace('/www/', '/www/'.$subdomains_table[$subdomain].'/', $REQ);
    }
}

## command
$cmd = "$PHP_BIN $CONSOLE $OPTIONS $REQ";

## debug
/*
header("Content-Type: text/html;charset=$CHARSET");
echo "<br />## Server infos:<br />";
echo "QUERY : ".$_SERVER['QUERY_STRING']."<br />";
echo "PATH_INFO : ".$_SERVER['PATH_INFO']."<br />";
echo "PATH_TRANSLATED : ".$_SERVER['PATH_TRANSLATED']."<br />";
echo "REDIRECT_HANDLER : ".$_SERVER['REDIRECT_HANDLER']."<br />";
echo "<br />## MDE infos:";
echo "CONSOLE : $CONSOLE<br />";
echo "PHP_BIN : $PHP_BIN<br />";
echo "REQ : $REQ<br />";
echo "CHARSET : $CHARSET<br />";
echo "OPTIONS : $OPTIONS<br />";
echo "<br />> gonna run:<br />";
echo $cmd;
//echo "<br />## Full SERVER infos:<br />";
//echo "<pre>".var_export($_SERVER,1)."</pre>";
exit(0);
//*/

try {
    exec($cmd, $output, $return);
//    header("Content-Type: text/html;charset=$CHARSET");
    echo join("\n", $output);
} catch (Exception $e) {
    header("Content-Type: text/plain;charset=$CHARSET");
    echo file_get_contents($REQ);
}

# Endfile
