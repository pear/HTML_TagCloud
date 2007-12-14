<?php

/**
 * TagCloudTest.php (created on 26.11.2007 12:33:43)
 *
 * <file description>
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  <category>
 * @package   <package>
 * @author    Bastian Onken <bastian.onken@gmx.net>
 * @copyright 2007 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   CVS: $Id$
 * @link      http://<package url>
 * @since     File available since Release <release>
 */

require_once 'HTML/TagCloud.php';
require_once 'PHPUnit/Framework.php';

class TagCloudTest extends PHPUnit_Framework_TestCase {

    public $HTML_TagCloud;

    function TagCloudTest($name) {
        $this->PHPUnit_TestCase($name);
    }

    // called before the test functions will be executed
    // this function is defined in PHPUnit_TestCase and overwritten
    // here
    function setUp() {
        $this->HTML_TagCloud = new HTML_TagCloud();
    }

    // called after the test functions are executed
    // this function is defined in PHPUnit_TestCase and overwritten
    // here
    function tearDown() {
        unset($this->HTML_TagCloud);
    }

    function testAddElement() {
        $this->HTML_TagCloud->addElement('Tag');
        $result = $this->HTML_TagCloud->buildHTML();
        $this->assertTrue(!empty($result));
    }

}

?>