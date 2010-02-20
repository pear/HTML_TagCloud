<?php
/**
 * TagCloud_example5.php
 *
 * Generate a Tag Cloud and specify a special tag separators yourself.
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
 * @since     File available since Release 0.2.4
 */

require_once 'HTML/TagCloud.php';

// To get the date function working properly we have to set the time zone
date_default_timezone_set('UTC');

// Set up font sizes, colors and a non-default tag separator
$baseFontSize  = 150;
$fontSizeRange = 75;
$sizeSuffix    = '%';
$latestColor   = 'FF0000';
$earliestColor = 'FFFB00';
$thresholds    = 6;
$tagSeparator  = '<span style="color:#DDDDDD;"> / </span>';

// Create an instance of HTML_TagCloud with settings we defined above
$tagCloud = new HTML_TagCloud(
    $baseFontSize, $fontSizeRange, $latestColor, $earliestColor, $thresholds,
    $sizeSuffix, $tagSeparator
);

// Set up some tags
$tagFixtures = array(
    'blogs',
    'folksonomy',
    'wikis',
    'rss',
    'widgets',
    'ajax',
    'podcasting',
    'semantic',
    'xhtml',
    'design',
    'mobility'
);

// Set up some time occurrences
$timeFixtures = array(
    '-1 year',
    '-6 month',
    '-3 month',
    '-1 month',
    '-1 week',
    '-1 day'
);

// Build and add randomized tags to the TagCloud
foreach ($tagFixtures as $tag) {
    // Set up how many occurrences this tag has
    $numberOfOccurrences = rand(1, 50);
    // Randomize through the time fixtures and set up the age of this tag
    $time = $timeFixtures[rand(0, count($timeFixtures)-1)];
    // Finally add it to the cloud, to see how the time and count values are
    //  interpreted we add them to the tagname to see their current value
    $tagCloud->addElement($tag, $dummyURL, $numberOfOccurrences, strtotime($time));
}

// Now return a HTML page that contains additional TagCloud style definitions
//  and display both TagClouds we created above
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My customized Tag Cloud</title>
<style type="text/css">
.tagcloud {
    font-family: 'lucida grande',trebuchet,'trebuchet ms',verdana,arial,
                  helvetica,sans-serif;
    line-height: 1.8em;
    word-spacing: 0ex;
    letter-spacing: normal;
    text-decoration: none;
    text-transform: none;
    text-align: justify;
    text-indent: 0ex;
    margin: 1em 0em 0em 0em;
    border: 2px dotted #ddd;
    padding: 1em;
}
.tagcloud a:link {
    border-width: 0;
}
.tagcloud a:visited {
    border-width: 0;
}
.tagcloud a:hover {
    border-width: 1px;
    color:white !important;
    background-color: #FF0000;
}
.tagcloud a:active {
    border-width: 1px;
    color:white !important;
    background-color: #FFFB00;
}
.tagcloudElement {
    padding: 2px 5px;
    position: relative;
    vertical-align: middle;
}
<?php

// Print out CSS
print $tagCloud->buildCSS();

?>
</style>
</head>
<body>
<p>This box shows a randomized tag cloud, hit reload to mix them up:</p>
<?php

// Print out HTML
print $tagCloud->buildHTML();

// Show source, you don't need this line in your code, it's just for showing off
?>
<br/>
Take a look at the source:<br/>
<?php

show_source(__FILE__);

?>
</body>
</html>