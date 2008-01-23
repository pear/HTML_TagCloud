<?php

/**
 * TagCloud_example1.php
 *
 * Generate a simple Tag Cloud
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
 */

require_once 'HTML/TagCloud.php';

date_default_timezone_set('UTC');

$tags = new HTML_TagCloud();
// add Elements
$tags->addElement('PHP', 'http://www.php.net', 39, strtotime('-1 day'));
$tags->addElement('XML', 'http://www.xml.org', 21, strtotime('-2 week'));
$tags->addElement('Perl', 'http://www.perl.org', 15, strtotime('-1 month'));
$tags->addElement('PEAR', 'http://pear.php.net', 32, time());
$tags->addElement('MySQL', 'http://www.mysql.com', 10, strtotime('-2 day'));
$tags->addElement('PostgreSQL', 'http://pgsql.com', 6, strtotime('-3 week'));
// output HTML and CSS
print $tags->buildALL();

show_source(__FILE__);

?>
