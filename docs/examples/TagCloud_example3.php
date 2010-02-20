<?php
/**
 * TagCloud_example3.php
 *
 * Generate a customized Tag Cloud by extending the class.
 * In this example we visualize only the timeline information, not the number of
 * occurrences. Because of this every item of the tag cloud will have the same
 * font size, but different colors. The newer the tag is, the deeper its color
 * will be; older tags will have a lighter color.
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

// {{{ class MyTags extends HTML_TagCloud{

/**
 * MyTags extends HTML_TagCloud
 *
 * Showing how to override the protected class vars
 *
 * @category  HTML
 * @package   HTML_TagCloud
 * @author    Shoma Suzuki <shoma@catbot.net>
 * @author    Bastian Onken <bastianonken@php.net>
 * @copyright 2010 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     Class available since Release 0.1.0
 */
class MyTags extends HTML_TagCloud
{
    /**
     * Defines colors of the different levels that tags will be assigned to
     * (based on tag's age)
     *
     * @var    array
     * @access protected
     */
    protected $epocLevel = array(
        array(
            'earliest' => array(
                'link'    => 'ffdfdf',
                'visited' => 'ffdfdf',
                'hover'   => 'ffdfdf',
                'active'  => 'ffdfdf',
            ),
        ),
        array(
            'earlier' => array(
                'link'    => 'ff7f7f',
                'visited' => 'ff7f7f',
                'hover'   => 'ff7f7f',
                'active'  => 'ff7f7f',
            ),
        ),
        array(
            'previous' => array(
                'link'    => 'ff7f7f',
                'visited' => 'ff7f7f',
                'hover'   => 'ff7f7f',
                'active'  => 'ff7f7f',
            ),
        ),
        array(
            'recent' => array(
                'link'    => 'ff4f4f',
                'visited' => 'ff4f4f',
                'hover'   => 'ff4f4f',
                'active'  => 'ff4f4f',
            ),
        ),
        array(
            'later' => array(
                'link'    => 'ff1f1f',
                'visited' => 'ff1f1f',
                'hover'   => 'ff1f1f',
                'active'  => 'ff1f1f',
            ),
        ),
        array(
            'latest' => array(
                'link'    => 'ff0000',
                'visited' => 'ff0000',
                'hover'   => 'ff0000',
                'active'  => 'ff0000',
            ),
        ),
    );

    /**
     * Stores the font-size unit, potentional values are: mm,cm,in,pt,pc,px,em
     *
     * @var    string
     * @access protected
     */
    protected $sizeSuffix = 'pt';

    /**
     * Limits the range of generated font-sizes
     *
     * @var    int
     * @access protected
     */
    protected $fontSizeRange = 0;

    /**
     * Defines the base font size
     *
     * @var    int
     * @access protected
     */
    protected $baseFontSize = 12;
}

// }}}

// Create an instance of our extended HTML_TagCloud we prepared above
$tags = new MyTags();

// Add Elements (same as TagCloud_example1.php)
$tags->addElement('PHP', 'http://www.php.net', 39, strtotime('-1 day'));
$tags->addElement('XML', 'http://www.xml.org', 21, strtotime('-2 week'));
$tags->addElement('Perl', 'http://www.perl.org', 15, strtotime('-1 month'));
$tags->addElement('PEAR', 'http://pear.php.net', 32, time());
$tags->addElement('MySQL', 'http://www.mysql.com', 10, strtotime('-2 day'));
$tags->addElement('PostgreSQL', 'http://pgsql.com', 6, strtotime('-3 week'));

// Print out HTML and CSS
print $tags->buildALL();

// Show source, you don't need this line in your code, it's just for showing off
?>
<br/>
Take a look at the source:<br/>
<?php

show_source(__FILE__);
