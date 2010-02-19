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
 * @author    Bastian Onken <bastianonken@php.net>
 * @copyright 2010 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   SVN: $Id$
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     File available since Release 0.1.0
 */

require_once 'HTML/TagCloud.php';

// To get the date function working properly we have to set the time zone
date_default_timezone_set('UTC');

// Set up new font sizes
$baseFontSize  = 36;
$fontSizeRange = 24;

// Create an instance of HTML_TagCloud with non-default font sizes
$tags = new HTML_TagCloud($baseFontSize, $fontSizeRange);

// Prepare some items, without specifying the timestamp (this way they will get
//  the actual timestamp)
$name = 'a';
foreach (range(0, 15) as $i) {
    $arr[$i]['name']  = $name;
    $arr[$i]['url']   = '#';
    $arr[$i]['count'] = $i;
    $name++;
}

// Submit the prepared items to the TagCloud
$tags->addElements($arr);
$tags->addElement('H', '#', 16);
$tags->addElement('P', '#', 18);

// Get the CSS part only
$css = $tags->buildCSS();

// Get the HTML part only
$taghtml = $tags->buildHTML();

// Now return a HTML page and display the CSS-part and the HTML-part in
//  separated positions
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My first Tag Cloud</title>
<style type="text/css">
<?php

// Print CSS-part of the TagCloud
print $css;

?>
</style>
</head>
<body>
<?php

// Print HTML-part of the TagCloud
print $taghtml;

// Show source, you don't need this line in your code, it's just for showing off
?>
<br/>
Take a look at the source:<br/>
<?php

show_source(__FILE__);

?>
</body>
</html>