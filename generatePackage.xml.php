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
 * @copyright 2008 Bastian Onken
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
    'ignore' => array(__FILE__, 'misc/'),
    'packagefile' => 'package2.xml',
    'dir_roles' => array('docs' => 'doc', 'tests' => 'test')
));
$packagexml->setChannel('pear.php.net');
$packagexml->setPackage('HTML_TagCloud');
$summary = <<<EOT
Generate a "Tag Cloud" in HTML and visualize tags by their frequenzy.
Additionally visualizes each tag's age.
EOT;
$packagexml->setSummary($summary);
$description = <<<EOT
This package can be used to generate tag clouds. The output is HTML and CSS.

A Tag Cloud is a visual representation of so-called "tags" or keywords, that do
have a different font size depending on how often they occur on the page/blog. A
less used synonym for a Tag Cloud that came up before Web 2.0 is the term
"weightet list". Popular examples of Tag Clouds and their use can be found in
action at pages like Flickr, Del.icio.us and Technorati. A nice overview on what
a Tag Cloud can actually do can be found at WikiPedia:
http://wikipedia.org/wiki/Tag_cloud

This package does not only visualize frequency, but also timeline infomation.
The newer the tag is, the deeper its color will be; older tags will have a
lighter color.

The main goal of "HTML_TagCloud" is to provide an easy to implement and
configureable Tag Cloud solution that is suitable for any PHP-based webapp.

Features:
 - set up each tag's name, URL, frequenzy, age
 - customizable colors
 - customizable font-sizes
EOT;
$packagexml->setDescription($description);
$packagexml->addMaintainer('lead', 'bastianonken', 'Bastian Onken',
                           'bastian.onken@gmx.net', 'yes');
$packagexml->addMaintainer('lead', 'shomas', 'Shoma Suzuki',
                           'shoma@catbot.net', 'no');
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
$packagexml->setDate('2006-11-25');
$packagexml->setChangelogEntry('0.1.2', $packagexml->generateChangeLogEntry());

// Changelog: Release 0.1.3
$notes = <<<EOT
Quality review release
 - Heavily applied PEAR Coding Standards
 - extended unit tests

Fixed issues
 - Fixed hard-wired css class name: If cloud consists of one tag and epocLevel
   was set up by extending the class member, the default value for the css class
   may be incorrect if it was not "latest". This behaviour has been changed. The
   value for the css class is now based on the last value of a _epocLevel key
   string.
 - Returned value of _buidHTMLTags was of wrong type if no tags were set up.
   This behaviour has been changed. An empty tag cloud will now be displayed
   with text "not enough data" instead of returning an empty string.
EOT;
$packagexml->setAPIVersion('0.1.3');
$packagexml->setAPIStability('beta');
$packagexml->setReleaseVersion('0.1.3');
$packagexml->setReleaseStability('beta');
$packagexml->setLicense('PHP License', 'http://www.php.net/license');
$packagexml->setNotes($notes);
$packagexml->setPackageType('php'); // this is a PEAR-style php script package
$packagexml->setDate('2008-01-23');
$packagexml->setChangelogEntry('0.1.3', $packagexml->generateChangeLogEntry());

/* add changelogs for future releases above this line */

// Current Release
/*$notes = <<<EOT
New features added
 - Added requested feature #12417 "Adding weighted limitation of elements"
EOT;*/
$notes = <<<EOT
New features
 - Added ability to set up timeline colors for tags dynamically by setting up a
    latestColor and a earliestColor and the number of thresholds.
    (requires PEAR package "Image_Color")
 - Added ability to set up multiple tag cloud per page by attaching a unique id
    to each tag cloud's individual css class identifiers
Fixed issues
 - Fixed issue with setting up basefonsize and fontsizerange on extending class
   (doesn't got recognized when instance isn't constructed with these values;
   so they were useless in most of the cases)
EOT;
$packagexml->setAPIVersion('0.2.0');
$packagexml->setAPIStability('beta');
$packagexml->setReleaseVersion('0.2.0');
$packagexml->setReleaseStability('beta');
$packagexml->setNotes($notes);
$packagexml->setPackageType('php'); // this is a PEAR-style php script package
$packagexml->addGlobalReplacement('package-info', '@package_version@',
                                  'version');
$packagexml->addRelease(); // set up as current release at the release section

// get current release dependencies for PHP
$options = array(
    'ignore_functions' => array(),
    'ignore_files' => array()
);
PEAR::pushErrorHandling(PEAR_ERROR_RETURN);
$available = $packagexml->detectDependencies($options);
if (PEAR::isError($available)) {
    // PHP_CompatInfo is not installed, set up PHP dep manually
    $packagexml->setPhpDep('5.1.0');
}
PEAR::popErrorHandling();

// set up current release dependency for the PEAR installer
$packagexml->setPearinstallerDep('1.4.0b1');

// finally create the <contents> tag
$packagexml->generateContents();

// to additionally generate a version 1 xml file get a PEAR_PackageFile object
//$pkg = &$packagexml->exportCompatiblePackageFile1();

// do the output: if make was set write to file, otherwise just print to screen
if (   isset($_GET['make'])
    || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    //$pkg->writePackageFile();
    $packagexml->writePackageFile();
} else {
    //$pkg->debugPackageFile();
    $packagexml->debugPackageFile();
}

?>
