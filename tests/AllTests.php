<?php
/**
 * AllTests.php (created on 23.01.2008 12:33:43)
 *
 * Run all TestCases for package HTML_TagCloud
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

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'HTML_TagCloud_AllTests::main');
}

require_once 'PHPUnit/Framework.php';
require_once 'PHPUnit/TextUI/TestRunner.php';

chdir(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

require_once dirname(__FILE__) . '/TagCloudTest.php';

/**
 * HTML_TagCloud_AllTests
 *
 * Unit test suite for HTML_TagCloud class
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
class HTML_TagCloud_AllTests
{
    /**
     * main entry point for running the complete suite
     *
     * @return void
     */
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    /**
     * registers TestSuite (is referenced by self::main)
     *
     * @return void
     */
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('HTML_TagCloud package');
        $suite->addTestSuite('HTML_TagCloudTest');
        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'HTML_TagCloud_AllTests::main') {
    HTML_TagCloud_AllTests::main();
}
