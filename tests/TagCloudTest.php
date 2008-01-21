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

require_once 'HTML/TagCloud.php';
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
        $this->HTML_TagCloud->addElement('tag0');
        $result = $this->HTML_TagCloud->buildHTML();
        $this->assertFalse(empty($result));
    }

    /**
     * test the addElements function
     *
     * @return void
     */
    function testAddElements() {
        $tags = array(
            array('name' => 'tag1'),
            array('name' => 'tag2', 'url' => 'http://example.org'),
            array('name' => 'tag3', 'url' => 'http://example.org', 'count' => 3),
            array('name' => 'tag4', 'url' => 'http://example.org', 'count' => 4, 'timestamp' => time()),
        );
        $this->HTML_TagCloud->addElements($tags);
        $result = $this->HTML_TagCloud->buildHTML();
        $this->assertFalse(empty($result));
    }

    /**
     * test the buildCSS function
     *
     * @return void
     */
    function testBuildCSS() {
        $expected = <<<EOT
a.earliest:link {text-decoration: none; color: #cccccc;}
a.earliest:visited {text-decoration: none; color: #cccccc;}
a.earliest:hover {text-decoration: none; color: #cccccc;}
a.earliest:active {text-decoration: none; color: #cccccc;}
a.earlier:link {text-decoration: none; color: #9999cc;}
a.earlier:visited {text-decoration: none; color: #9999cc;}
a.earlier:hover {text-decoration: none; color: #9999cc;}
a.earlier:active {text-decoration: none; color: #9999cc;}
a.later:link {text-decoration: none; color: #9999ff;}
a.later:visited {text-decoration: none; color: #9999ff;}
a.later:hover {text-decoration: none; color: #9999ff;}
a.later:active {text-decoration: none; color: #9999ff;}
a.latest:link {text-decoration: none; color: #0000ff;}
a.latest:visited {text-decoration: none; color: #0000ff;}
a.latest:hover {text-decoration: none; color: #0000ff;}
a.latest:active {text-decoration: none; color: #0000ff;}

EOT;
        $this->assertEquals($expected, $this->HTML_TagCloud->buildCSS(), 'my message');
    }

    /**
     * test the buildHTML function
     *
     * @return void
     */
    function testBuildHTML() {
        $expected = <<<EOT
<div class="tagcloud"><a href="" style="font-size: 12px;" class="latest">tag0</a>&nbsp;
<a href="" style="font-size: 12px;" class="latest">tag1</a>&nbsp;
<a href="http://example.org" style="font-size: 12px;" class="latest">tag2</a>&nbsp;
<a href="http://example.org" style="font-size: 24px;" class="latest">tag3</a>&nbsp;
<a href="http://example.org" style="font-size: 36px;" class="earliest">tag4</a>&nbsp;
</div>

EOT;
        $this->assertEquals($expected, $this->HTML_TagCloud->buildHTML());
    }

    /**
     * test the buildAll function
     *
     * @return void
     */
    function testBuildAll() {
        $expected = <<<EOT
<style type="text/css">
a.earliest:link {text-decoration: none; color: #cccccc;}
a.earliest:visited {text-decoration: none; color: #cccccc;}
a.earliest:hover {text-decoration: none; color: #cccccc;}
a.earliest:active {text-decoration: none; color: #cccccc;}
a.earlier:link {text-decoration: none; color: #9999cc;}
a.earlier:visited {text-decoration: none; color: #9999cc;}
a.earlier:hover {text-decoration: none; color: #9999cc;}
a.earlier:active {text-decoration: none; color: #9999cc;}
a.later:link {text-decoration: none; color: #9999ff;}
a.later:visited {text-decoration: none; color: #9999ff;}
a.later:hover {text-decoration: none; color: #9999ff;}
a.later:active {text-decoration: none; color: #9999ff;}
a.latest:link {text-decoration: none; color: #0000ff;}
a.latest:visited {text-decoration: none; color: #0000ff;}
a.latest:hover {text-decoration: none; color: #0000ff;}
a.latest:active {text-decoration: none; color: #0000ff;}
</style>
<div class="tagcloud"><a href="" style="font-size: 12px;" class="latest">tag0</a>&nbsp;
<a href="" style="font-size: 12px;" class="latest">tag1</a>&nbsp;
<a href="http://example.org" style="font-size: 12px;" class="latest">tag2</a>&nbsp;
<a href="http://example.org" style="font-size: 24px;" class="latest">tag3</a>&nbsp;
<a href="http://example.org" style="font-size: 36px;" class="earliest">tag4</a>&nbsp;
</div>

EOT;
        $this->assertEquals($expected, $this->HTML_TagCloud->buildAll());
    }

    /**
     * test the clearElements function
     *
     * @return void
     */
    function testClearElements() {
        $this->HTML_TagCloud->clearElements();
        $result = $this->HTML_TagCloud->buildHTML();
        $this->assertTrue(empty($result));
    }

}

?>