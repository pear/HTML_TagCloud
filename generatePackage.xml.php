<?php

/**
 * generatePackage.xml.php
 *
 * Generates the package.xml file (version 2)
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
 * @since     File available since Release 0.1.0
 */

require_once 'PEAR/PackageFileManager2.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$packagexml = new PEAR_PackageFileManager2();
$packagexml->setOptions(array(
    'baseinstalldir' => 'HTML',
    'packagedirectory' => dirname(__FILE__),
    'filelistgenerator' => 'cvs', // generate from cvs, use file for directory
    'ignore' => array('generatePackage.xml.php'),
    'packagefile' => 'package2.xml',
    'dir_roles' => array('docs' => 'doc')
));
$packagexml->setPackage('HTML_TagCloud');
$packagexml->setSummary('generate a "tag cloud" in HTML');
$packagexml->setDescription('HTML_TagCloud enables you to generate a "tag cloud" in HTML');
$packagexml->setChannel('pear.php.net');
$packagexml->addMaintainer('lead', 'bastianonken', 'Bastian Onken', 'bastian.onken@gmx.net');
$packagexml->addMaintainer('lead', 'shomas', 'Shoma Suzuki', 'shoma@catbot.net', 'no');
$packagexml->setLicense('PHP License', 'http://www.php.net/license');

// Changelog: Release 0.1.0
$notes = <<<EOT
First Release as PEAR Package
EOT;
$packagexml->setAPIVersion('0.1.0');
$packagexml->setAPIStability('beta');
$packagexml->setReleaseVersion('0.1.0');
$packagexml->setReleaseStability('beta');
$packagexml->setLicense('PHP License', 'http://www.php.net/license');
$packagexml->setNotes($notes);
$packagexml->setPackageType('php'); // this is a PEAR-style php script package
// put in Changelog
$packagexml->setDate('2006-10-02');
$packagexml->setChangelogEntry('0.1.0', $packagexml->generateChangeLogEntry());

// Changelog: Release 0.1.1
$notes = <<<EOT
removed docs/CVS
EOT;
$packagexml->setAPIVersion('0.1.1');
$packagexml->setAPIStability('beta');
$packagexml->setReleaseVersion('0.1.1');
$packagexml->setReleaseStability('beta');
$packagexml->setLicense('PHP License', 'http://www.php.net/license');
$packagexml->setNotes($notes);
$packagexml->setPackageType('php'); // this is a PEAR-style php script package
// put in Changelog
$packagexml->setDate('2006-10-03');
$packagexml->setChangelogEntry('0.1.1', $packagexml->generateChangeLogEntry());

// Changelog: Release 0.1.2
$notes = <<<EOT
Bug fix release

Fixed bug #10569 "Notice on line 401 running example2.php"
Fixed bug #12419 "Extended class defines wrong array parameters"
EOT;
$packagexml->setAPIVersion('0.1.2');
$packagexml->setAPIStability('beta');
$packagexml->setReleaseVersion('0.1.2');
$packagexml->setReleaseStability('beta');
$packagexml->setLicense('PHP License', 'http://www.php.net/license');
$packagexml->setNotes($notes);
$packagexml->setPackageType('php'); // this is a PEAR-style php script package
// put in Changelog
$packagexml->setDate('2006-11-25');
$packagexml->setChangelogEntry('0.1.2', $packagexml->generateChangeLogEntry());

/* add changelogs for future releases above this line */

// Current Release
$notes = <<<EOT
New features added

Added requested feature #12417 "Adding weighted limitation of elements"
 - 
EOT;
$packagexml->setAPIVersion('0.1.3');
$packagexml->setAPIStability('beta');
$packagexml->setReleaseVersion('0.1.3');
$packagexml->setReleaseStability('beta');
$packagexml->setNotes($notes);
$packagexml->setPackageType('php'); // this is a PEAR-style php script package
// set as current release
$packagexml->addRelease(); // set up a release section

// get current release dependencies
$options = array(
    'ignore_functions' => array(),
    'ignore_files' => array()
);
PEAR::pushErrorHandling(PEAR_ERROR_RETURN);
$available = $packagexml->detectDependencies($options);
if (PEAR::isError($available)) {
    // PHP_CompatInfo is not installed on your system, then fix PHP dep with PFM2
    $packagexml->setPhpDep('5.1.0');
}
PEAR::popErrorHandling();

$packagexml->setPearinstallerDep('1.4.0b1');

$packagexml->generateContents(); // create the <contents> tag

// to additionally generate a version 1 package.xml file
//$pkg = &$packagexml->exportCompatiblePackageFile1(); // get a PEAR_PackageFile object

if (isset($_GET['make']) || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    //$pkg->writePackageFile();
    $packagexml->writePackageFile();
} else {
    //$pkg->debugPackageFile();
    $packagexml->debugPackageFile();
}

?>
