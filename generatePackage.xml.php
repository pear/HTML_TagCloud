<?php
/**
 * generatePackage.xml.php
 *
 * Generates the package2.xml file
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
 * @since     File available since Release 0.1.0
 */

require_once 'PEAR/PackageFileManager2.php';
PEAR::setErrorHandling(PEAR_ERROR_DIE);

$packagexml = new PEAR_PackageFileManager2();
$packagexml->setOptions(
    array(
        'baseinstalldir' => 'HTML',
        'packagedirectory' => dirname(__FILE__),
        'filelistgenerator' => 'svn', // generate from svn
        'ignore' => array(__FILE__, 'misc/', 'build*.properties', 'build.xml'),
        'packagefile' => 'package2.xml',
        'dir_roles' => array('docs' => 'doc', 'tests' => 'test')
    )
);
$packagexml->setChannel('pear.php.net');
$packagexml->setPackage('HTML_TagCloud');
$summary = <<<EOT
Generate a "Tag Cloud" in HTML and visualize tags by their frequency.
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

This package does not only visualize frequency, but also timeline information.
The newer the tag is, the deeper its color will be; older tags will have a
lighter color.

The main goal of "HTML_TagCloud" is to provide an easy to implement and
configureable Tag Cloud solution that is suitable for any PHP-based webapp.

Features:
 - set up each tag's name, URL, frequency, age
 - customizable colors
 - customizable font-sizes
EOT;
$packagexml->setDescription($description);
$packagexml->addMaintainer(
    'lead', 'bastianonken', 'Bastian Onken', 'bastianonken'.'@'.'php.net', 'yes'
);
$packagexml->addMaintainer(
    'lead', 'shomas', 'Shoma Suzuki', 'shoma'.'@'.'catbot.net', 'no'
);
$packagexml->setLicense('PHP License', 'http://www.php.net/license');

// Current Release
$notes = <<<EOT
New Features:
* req #17052: Added possibility to set up individual tag separators
EOT;
$packagexml->setAPIVersion('0.2.4');
$packagexml->setAPIStability('beta');
$packagexml->setReleaseVersion('0.2.4');
$packagexml->setReleaseStability('beta');
$packagexml->setNotes($notes);
$packagexml->addPackageDepWithChannel(
    'optional', 'Image_Color', 'pear.php.net', '1.0.2'
);
$packagexml->setPackageType('php'); // this is a PEAR-style php script package
$packagexml->addGlobalReplacement(
    'package-info', '@package_version@', 'version'
);
$packagexml->addRelease(); // set up as current release at the release section

// get current release dependencies for PHP
$options = array(
    'ignore_functions' => array(),
    'ignore_files' => array(),
);
PEAR::pushErrorHandling(PEAR_ERROR_RETURN);
$available = $packagexml->detectDependencies($options);
if (PEAR::isError($available)) {
    // PHP_CompatInfo is not installed, set up PHP dep manually
    $packagexml->setPhpDep('5.2.0');
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
    || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')
) {
    //$pkg->writePackageFile();
    $packagexml->writePackageFile();
} else {
    //$pkg->debugPackageFile();
    $packagexml->debugPackageFile();
}
