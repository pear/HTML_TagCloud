<?php

/**
 * TagCloud_example2.php
 *
 * Generate a Tag Cloud with non-default font sizes embedded into HTML. Also use
 * the array function "addElements" in conjunction with "addElement" to mass set
 * up tags.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  HTML
 * @package   HTML_TagCloud
 * @author    Bastian Onken <bastian.onken@gmx.net>
 * @copyright 2007 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   CVS: $Id$
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     File available since Release 0.1.0
 */

require_once 'HTML/TagCloud.php';

date_default_timezone_set('UTC');

$baseFontSize  = 36;
$fontSizeRange = 24;
// Tag size range in ($baseFontSize - $fontSizeRange) to
// ($baseFontSize + $fontSizeRange).
$tags = new HTML_TagCloud($baseFontSize, $fontSizeRange);
$name = 'a';
// set a item without timestamp
foreach (range(0, 15) as $i) {
    $arr[$i]['name']  = $name;
    $arr[$i]['url']   = '#';
    $arr[$i]['count'] = $i;
    $name++;
}
// set many item at once by array
$tags->addElements($arr);
$tags->addElement('H', '#', 16);
$tags->addElement('P', '#', 18);
// CSS part only
$css = $tags->buildCSS();
// html part only
$taghtml = $tags->buildHTML();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My first Tag Cloud</title>
<style type="text/css">
<?php 
print $css;
?>
</style>
</head>
<body>
<?php
print $taghtml;
show_source(__FILE__);
?>
</body>
</html>
