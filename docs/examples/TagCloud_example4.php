<?php

/**
 * TagCloud_example4.php
 *
 * Generate a more customized Tag Cloud by extending the class.
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
 * @copyright 2008 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   CVS: $Id$
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     File available since Release 0.1.0
 * @todo      fix issue with setting up basefonsize and fontsizerange on extending class (doesn't get recognized when instance isn't constructed with these values; so they are useless in most of the cases)
 */

require_once 'HTML/TagCloud.php';

/**
 * MyTagsAdvanced extends HTML_TagCloud
 *
 * Showing how to override the protected class vars
 *
 * @category  HTML
 * @package   HTML_TagCloud
 * @author    Shoma Suzuki <shoma@catbot.net>
 * @author    Bastian Onken <bastian.onken@gmx.net>
 * @copyright 2008 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     Class available since Release 0.1.0
 */
class MyTagsAdvanced extends HTML_TagCloud
{
    protected $epocLevel = array(
        array(
            'earliest' => array(
                'link'    => 'D3D3D3',
                'visited' => 'D3D3D3',
                'hover'   => 'D3D3D3',
                'active'  => 'D3D3D3',
            ),
        ),
        array(
            'earlier' => array(
                'link'    => 'AFB8CC',
                'visited' => 'AFB8CC',
                'hover'   => 'AFB8CC',
                'active'  => 'AFB8CC',
            ),
        ),
        array(
            'later' => array(
                'link'    => '5F72AA',
                'visited' => '5F72AA',
                'hover'   => '5F72AA',
                'active'  => '5F72AA',
            ),
        ),
        array(
            'latest' => array(
                'link'    => '000097',
                'visited' => '000097',
                'hover'   => '000097',
                'active'  => '000097',
            ),
        ),
    );
    protected $sizeSuffix = '%';
    protected function _createHTMLTag($tag, $type, $fontSize)
    {
        return '<a href="'. $tag['url'] . '" style="font-size: '.
               $fontSize . $this->sizeSuffix . ';" class="tagElement '.  $type .'">' .
               htmlspecialchars($tag['name']) . '</a> '. "\n";
    }
}

/**
 * MyTagsAdvanced extends HTML_TagCloud
 *
 * Showing how to override the protected class vars
 *
 * @category  HTML
 * @package   HTML_TagCloud
 * @author    Shoma Suzuki <shoma@catbot.net>
 * @author    Bastian Onken <bastian.onken@gmx.net>
 * @copyright 2008 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     Class available since Release 0.1.0
 */
class MyTagsDynamicColors extends HTML_TagCloud
{
    protected $sizeSuffix = '%';
    public function __construct($baseFontSize = 24, $fontSizeRange = 12, $epocLevel)
    {
        $this->baseFontSize  = $baseFontSize;
        $this->fontSizeRange = $fontSizeRange;
        if ($this->baseFontSize - $this->fontSizeRange > 0) {
            $this->minFontSize = $this->baseFontSize - $this->fontSizeRange;
        } else {
            $this->minFontSize = 0;
        }
        $this->maxFontSize = $this->baseFontSize + $this->fontSizeRange;
        $this->epocLevel = $epocLevel;
    }
    protected function _createHTMLTag($tag, $type, $fontSize)
    {
        return '<a href="'. $tag['url'] . '" style="font-size: '.
               $fontSize . $this->sizeSuffix . ';" class="tagElement '.  $type .'">' .
               htmlspecialchars($tag['name']) . '</a> '. "\n";
    }
}

require_once 'Image/Color.php';

$imageColor = new Image_Color();
$imageColor->setWebSafe(false);
$imageColor->setColors('000090', 'FFFFFF');
foreach ($imageColor->getRange(4) as $key => $color) {
    echo('<span style="color:'.$color.';">text</span>');
    $epocLevel[]['epocLevel'.$key] = array(
        'link'    => $color,
        'visited' => $color
    );
}
$epocLevel = array_reverse($epocLevel);

date_default_timezone_set('UTC');

$baseFontSize  = 140;
$fontSizeRange = 50;
// Tag size range in ($baseFontSize - $fontSizeRange) to
// ($baseFontSize + $fontSizeRange).
$tags = new MyTagsDynamicColors($baseFontSize, $fontSizeRange, $epocLevel);
// every element has a high count
$tags->addElement('oneYearOld(38)', 'http://example.org', 38, strtotime('-1 year'));
$tags->addElement('halfAYearOld(34)', 'http://example.org', 34, strtotime('-6 month'));
$tags->addElement('threeMonthOld(33)', 'http://example.org', 33, strtotime('-3 month'));
$tags->addElement('oneMonthOld(36)', 'http://example.org', 36, strtotime('-1 month'));
$tags->addElement('oneWeekOld(37)', 'http://example.org', 37, strtotime('-1 week'));
$tags->addElement('now(35)', 'http://example.org', 35, strtotime('now'));
// same elements, but medium count
$tags->addElement('oneYearOld(18)', 'http://example.org', 18, strtotime('-1 year'));
$tags->addElement('halfAYearOld(14)', 'http://example.org', 14, strtotime('-6 month'));
$tags->addElement('threeMonthOld(13)', 'http://example.org', 13, strtotime('-3 month'));
$tags->addElement('oneMonthOld(16)', 'http://example.org', 16, strtotime('-1 month'));
$tags->addElement('oneWeekOld(17)', 'http://example.org', 17, strtotime('-1 week'));
$tags->addElement('now(15)', 'http://example.org', 15, strtotime('now'));
// same elements, but low count
$tags->addElement('oneYearOld(6)', 'http://example.org', 6, strtotime('-1 year'));
$tags->addElement('halfAYearOld(2)', 'http://example.org', 2, strtotime('-6 month'));
$tags->addElement('threeMonthOld(1)', 'http://example.org', 1, strtotime('-3 month'));
$tags->addElement('oneMonthOld(4)', 'http://example.org', 4, strtotime('-1 month'));
$tags->addElement('oneWeekOld(5)', 'http://example.org', 5, strtotime('-1 week'));
$tags->addElement('now(3)', 'http://example.org', 3, strtotime('now'));

$tags2 = new MyTagsDynamicColors($baseFontSize, $fontSizeRange, $epocLevel);
// set up some tags
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
// set up some time occurrences
$timeFixtures = array(
    '-1 year',
    '-6 month',
    '-3 month',
    '-1 month',
    '-1 week',
    '-1 day'
);
// create randomized tags
foreach( $tagFixtures as $tag ) {
    // set up how many occurrences this tag has
    $numberOfOccurrences = rand(1, 50);
    // randomize through the time fixtures and set up the oldness of this tag
    $time = $timeFixtures[rand(0, count($timeFixtures)-1)];
    // finally add it to the cloud, to see how the time and count values are
    //  interpreted we add them to the tagname to see their current value
    $tags2->addElement($tag/*.'('.$numberOfOccurrences.','.str_replace(' ', '', $time).')'*/, 'http://example.org', $numberOfOccurrences, strtotime($time));
}

$tagCloudCSS = <<<EOD
.tagcloud {
    font-family: 'lucida grande',trebuchet,'trebuchet ms',verdana,arial,helvetica,sans-serif;
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
    background-color: #000097;
}
.tagcloud a:active {
    border-width: 1px;
    color:white !important;
    background-color: #C2D7E7;
}
.tagElement {
    padding: 2px 5px;
    position: relative;
    vertical-align: middle;
}
EOD;

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My customized Tag Cloud</title>
<style type="text/css">
<?php
print $tagCloudCSS."\n".$tags->buildCSS();
?>
</style>
</head>
<body>
<?php
print $tags->buildHTML();
print $tags2->buildHTML();
show_source(__FILE__);
?>
</body>
</html>
