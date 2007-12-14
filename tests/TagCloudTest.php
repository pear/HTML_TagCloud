<?php

/**
 * TagCloudTest.php (created on 26.11.2007 12:33:43)
 *
 * TestCase for HTML_TagCloud
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
 * @since     File available since Release 0.1.3
 */

require_once '../TagCloud.php';
require_once 'PHPUnit/Framework.php';

/**
 * TagCloudTest
 *
 * Tests HTML_TagCloud class
 *
 * @category  HTML
 * @package   HTML_TagCloud
 * @author    Bastian Onken <bastian.onken@gmx.net>
 * @copyright 2007 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     Class available since Release 0.1.3
 */
class TagCloudTest extends PHPUnit_Framework_TestCase
{

    public $HTML_TagCloud;

    /**
     * called before the test functions will be executed
     * this function is defined in PHPUnit_TestCase and overwritten here
     *
     * @return void
     */
    function setUp()
    {
        $this->HTML_TagCloud = new HTML_TagCloud();
    }

    /**
     * called after the test functions are executed
     * this function is defined in PHPUnit_TestCase and overwritten here
     *
     * @return void
     */
    function tearDown()
    {
        unset($this->HTML_TagCloud);
    }

    /**
     * test the addElement function
     *
     * @return void
     */
    function testAddElement()
    {
        $this->HTML_TagCloud->addElement('Tag');
        $result = $this->HTML_TagCloud->buildHTML();
        $this->assertTrue(!empty($result));
    }

}

?>