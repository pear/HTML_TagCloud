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
 * @author    Bastian Onken <bastianonken@php.net>
 * @copyright 2010 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   SVN: $Id$
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     File available since Release 0.1.3
 */

require_once 'HTML/TagCloud.php';
require_once 'PHPUnit/Framework.php';

/**
 * HTML_TagCloud_Test
 *
 * Tests HTML_TagCloud class
 *
 * @category  HTML
 * @package   HTML_TagCloud
 * @author    Bastian Onken <bastianonken@php.net>
 * @copyright 2010 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     Class available since Release 0.1.3
 */
class HTML_TagCloudTest extends PHPUnit_Framework_TestCase
{
    public $htmlTagCloud;

    public $addElementsData;

    /**
     * called before the test functions will be executed
     * this function is defined in PHPUnit_TestCase and overwritten here
     *
     * @return void
     */
    public function setUp()
    {
        $this->htmlTagCloud    = new HTML_TagCloud();
        $this->addElementsData = array(
            array('name' => 'tag1'),
            array(
                'name' => 'tag2',
                'url'  => 'http://example.org'
            ),
            array(
                'name'  => 'tag3',
                'url'   => 'http://example.org',
                'count' => 3
            ),
            array(
                'name'      => 'tag4',
                'url'       => 'http://example.org',
                'count'     => 4,
                'timestamp' => time()
            ),
        );
    }

    /**
     * test the addElement function
     *
     * @return void
     */
    public function testAddElement_empty()
    {
        $expected = <<<EOT
<div class="tagcloud {$this->htmlTagCloud->getUid()}">
<a href="" style="font-size:24px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest"></a> &nbsp;
</div>

EOT;
        $this->htmlTagCloud->addElement('');
        $result = $this->htmlTagCloud->buildHTML();
        $this->assertEquals($result, $expected);
    }

    /**
     * test the addElement function
     *
     * @return void
     */
    public function testAddElement_withName()
    {
        $expected = <<<EOT
<div class="tagcloud {$this->htmlTagCloud->getUid()}">
<a href="" style="font-size:24px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag0</a> &nbsp;
</div>

EOT;
        $this->htmlTagCloud->addElement('tag0');
        $result = $this->htmlTagCloud->buildHTML();
        $this->assertEquals($result, $expected);
    }

    /**
     * test the addElement function
     *
     * @return void
     */
    public function testAddElement_withNameAndUrl()
    {
        $expected = <<<EOT
<div class="tagcloud {$this->htmlTagCloud->getUid()}">
<a href="http://example.org" style="font-size:24px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag0</a> &nbsp;
</div>

EOT;
        $this->htmlTagCloud->addElement('tag0', 'http://example.org');
        $result = $this->htmlTagCloud->buildHTML();
        $this->assertEquals($result, $expected);
    }

    /**
     * test the addElement function
     *
     * @return void
     */
    public function testAddElement_withNameUrlAndCount()
    {
        $expected = <<<EOT
<div class="tagcloud {$this->htmlTagCloud->getUid()}">
<a href="http://example.org" style="font-size:24px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag0</a> &nbsp;
</div>

EOT;
        $this->htmlTagCloud->addElement('tag0', 'http://example.org', 100);
        $result = $this->htmlTagCloud->buildHTML();
        $this->assertEquals($result, $expected);
    }

    /**
     * test the addElement function
     *
     * @return void
     */
    public function testAddElement_withNameUrlCountAndTimestamp()
    {
        $expected = <<<EOT
<div class="tagcloud {$this->htmlTagCloud->getUid()}">
<a href="http://example.org" style="font-size:24px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag0</a> &nbsp;
</div>

EOT;
        $this->htmlTagCloud->addElement('tag0', 'http://example.org', 100, time());
        $result = $this->htmlTagCloud->buildHTML();
        $this->assertEquals($result, $expected);
    }

    /**
     * test the addElements function
     *
     * @return void
     */
    public function testAddElements_single()
    {
        $expected = <<<EOT
<div class="tagcloud {$this->htmlTagCloud->getUid()}">
<a href="" style="font-size:24px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag1</a> &nbsp;
</div>

EOT;
        $this->htmlTagCloud->addElements(array($this->addElementsData[0]));
        $result = $this->htmlTagCloud->buildHTML();
        $this->assertEquals($result, $expected);
    }

    /**
     * test the addElements function
     *
     * @return void
     */
    public function testAddElements_multiple()
    {
        $expected = <<<EOT
<div class="tagcloud {$this->htmlTagCloud->getUid()}">
<a href="" style="font-size:12px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag1</a> &nbsp;
<a href="http://example.org" style="font-size:12px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag2</a> &nbsp;
<a href="http://example.org" style="font-size:24px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag3</a> &nbsp;
<a href="http://example.org" style="font-size:36px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_earliest">tag4</a> &nbsp;
</div>

EOT;
        $this->htmlTagCloud->addElements($this->addElementsData);
        $result = $this->htmlTagCloud->buildHTML();
        $this->assertEquals($result, $expected);
    }

    /**
     * test the buildCSS function
     *
     * @return void
     */
    public function testBuildCSS()
    {
        $expected = <<<EOT
a.{$this->htmlTagCloud->getUid()}_earliest:link {text-decoration: none; color: #cccccc;}
a.{$this->htmlTagCloud->getUid()}_earliest:visited {text-decoration: none; color: #cccccc;}
a.{$this->htmlTagCloud->getUid()}_earliest:hover {text-decoration: none; color: #cccccc;}
a.{$this->htmlTagCloud->getUid()}_earliest:active {text-decoration: none; color: #cccccc;}
a.{$this->htmlTagCloud->getUid()}_earlier:link {text-decoration: none; color: #9999cc;}
a.{$this->htmlTagCloud->getUid()}_earlier:visited {text-decoration: none; color: #9999cc;}
a.{$this->htmlTagCloud->getUid()}_earlier:hover {text-decoration: none; color: #9999cc;}
a.{$this->htmlTagCloud->getUid()}_earlier:active {text-decoration: none; color: #9999cc;}
a.{$this->htmlTagCloud->getUid()}_later:link {text-decoration: none; color: #9999ff;}
a.{$this->htmlTagCloud->getUid()}_later:visited {text-decoration: none; color: #9999ff;}
a.{$this->htmlTagCloud->getUid()}_later:hover {text-decoration: none; color: #9999ff;}
a.{$this->htmlTagCloud->getUid()}_later:active {text-decoration: none; color: #9999ff;}
a.{$this->htmlTagCloud->getUid()}_latest:link {text-decoration: none; color: #0000ff;}
a.{$this->htmlTagCloud->getUid()}_latest:visited {text-decoration: none; color: #0000ff;}
a.{$this->htmlTagCloud->getUid()}_latest:hover {text-decoration: none; color: #0000ff;}
a.{$this->htmlTagCloud->getUid()}_latest:active {text-decoration: none; color: #0000ff;}

EOT;
        $result   = $this->htmlTagCloud->buildCSS();
        $this->assertEquals($expected, $result);
    }

    /**
     * test the buildHTML function
     *
     * @return void
     */
    public function testBuildHTML()
    {
        $expected = <<<EOT
<div class="tagcloud {$this->htmlTagCloud->getUid()}">
<a href="" style="font-size:12px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag1</a> &nbsp;
<a href="http://example.org" style="font-size:12px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag2</a> &nbsp;
<a href="http://example.org" style="font-size:24px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag3</a> &nbsp;
<a href="http://example.org" style="font-size:36px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_earliest">tag4</a> &nbsp;
</div>

EOT;
        $this->htmlTagCloud->addElements($this->addElementsData);
        $result = $this->htmlTagCloud->buildHTML();
        $this->assertEquals($expected, $result);
    }

    /**
     * test the buildAll function
     *
     * @return void
     */
    public function testBuildAll()
    {
        $expected = <<<EOT
<style type="text/css">
a.{$this->htmlTagCloud->getUid()}_earliest:link {text-decoration: none; color: #cccccc;}
a.{$this->htmlTagCloud->getUid()}_earliest:visited {text-decoration: none; color: #cccccc;}
a.{$this->htmlTagCloud->getUid()}_earliest:hover {text-decoration: none; color: #cccccc;}
a.{$this->htmlTagCloud->getUid()}_earliest:active {text-decoration: none; color: #cccccc;}
a.{$this->htmlTagCloud->getUid()}_earlier:link {text-decoration: none; color: #9999cc;}
a.{$this->htmlTagCloud->getUid()}_earlier:visited {text-decoration: none; color: #9999cc;}
a.{$this->htmlTagCloud->getUid()}_earlier:hover {text-decoration: none; color: #9999cc;}
a.{$this->htmlTagCloud->getUid()}_earlier:active {text-decoration: none; color: #9999cc;}
a.{$this->htmlTagCloud->getUid()}_later:link {text-decoration: none; color: #9999ff;}
a.{$this->htmlTagCloud->getUid()}_later:visited {text-decoration: none; color: #9999ff;}
a.{$this->htmlTagCloud->getUid()}_later:hover {text-decoration: none; color: #9999ff;}
a.{$this->htmlTagCloud->getUid()}_later:active {text-decoration: none; color: #9999ff;}
a.{$this->htmlTagCloud->getUid()}_latest:link {text-decoration: none; color: #0000ff;}
a.{$this->htmlTagCloud->getUid()}_latest:visited {text-decoration: none; color: #0000ff;}
a.{$this->htmlTagCloud->getUid()}_latest:hover {text-decoration: none; color: #0000ff;}
a.{$this->htmlTagCloud->getUid()}_latest:active {text-decoration: none; color: #0000ff;}
</style>
<div class="tagcloud {$this->htmlTagCloud->getUid()}">
<a href="" style="font-size:12px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag1</a> &nbsp;
<a href="http://example.org" style="font-size:12px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag2</a> &nbsp;
<a href="http://example.org" style="font-size:24px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_latest">tag3</a> &nbsp;
<a href="http://example.org" style="font-size:36px;" class="tagcloudElement {$this->htmlTagCloud->getUid()}_earliest">tag4</a> &nbsp;
</div>

EOT;
        $this->htmlTagCloud->addElements($this->addElementsData);
        $result = $this->htmlTagCloud->buildAll();
        $this->assertEquals($expected, $result);
    }

    /**
     * test the clearElements function
     *
     * @return void
     */
    public function testClearElements()
    {
        $expected = <<<EOT
<div class="tagcloud {$this->htmlTagCloud->getUid()}">
<p>not enough data</p>
</div>

EOT;
        $this->htmlTagCloud->addElements($this->addElementsData);
        $this->htmlTagCloud->clearElements();
        $result = $this->htmlTagCloud->buildHTML();
        $this->assertEquals($expected, $result);
    }

    /**
     * test the getElementCount function
     *
     * @return void
     */
    public function getElementCount()
    {
        $expected = 4;
        $this->htmlTagCloud->addElements($this->addElementsData);
        $result = $this->htmlTagCloud->getElementCount();
        $this->assertEquals($expected, $result);
    }
}
