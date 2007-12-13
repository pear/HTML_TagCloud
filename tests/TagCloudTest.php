<?php

/**
 * $Id$
 * Created on 26.11.2007 at 12:33:43, by Bastian
 *
 * <classname>
 *
 * <description>
 * 
 * @package    <project name>
 * @author     $Author$
 * @copyright  $Author$
 * @link       $HeadURL$
 * @license    http://creativecommons.org/licenses/by/2.5/de/  Creative Commons Attribution 2.5 License
 * @version    $Revision$
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