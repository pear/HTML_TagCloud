<?php
/*
 * A simple example
 *
 * @category   PEAR
 * @package    PEAR_PackageFileManager
 * @author     Greg Beaver <cellog@php.net>
 * @copyright  2003-2006 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/PEAR_PackageFileManager
 * @since      File available since Release 0.1
 * @ignore
 */

require_once 'PEAR/PackageFileManager.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$test = new PEAR_PackageFileManager();
$test->setOptions(array(
    'package' => 'HTML_TagCloud',
    'summary' => 'generate a "tag cloud" in HTML',
    'description' => 'HTML_TagCloud enables you to generate a "tag cloud" in HTML',
    'baseinstalldir' => 'HTML',
    'version' => '0.1.2',
    'packagedirectory' => dirname(__FILE__),
    'state' => 'beta',
    'filelistgenerator' => 'file',
    'notes' => 'bug fix release',
    'ignore' => array('package.xml', 'generatePackage.xml.php', 'CVS/')
    ));
$test->addDependency('PEAR', '1.1');
$test->addDependency('php', '5.0.0', 'ge', 'php');
$test->addMaintainer('shomas', 'lead', 'Shoma Suzuki', 'shoma@catbot.net');
$test->addMaintainer('bastianonken', 'lead', 'Bastian Onken', 'bastian.onken@gmx.net');
//$test->writePackageFile();
$test->debugPackageFile();
?>
