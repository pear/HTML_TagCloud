<?php

/**
 * algorithm.php (created on 20.12.2007 20:33:23)
 *
 * Playground for different types of to-be-available algorithms for tag cloud
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
require_once('Image/Color.php');

$max = 100;
$tags = array(
    'design' => rand(1, $max),
    'widgets' => rand(1, $max),
    'wikis' => rand(1, $max),
    'blogs' => rand(1, $max),
    'semantic' => rand(1, $max),
    'xhtml' => rand(1, $max),
    'rss' => rand(1, $max),
    'podcasting' => rand(1, $max),
    'folksonomy' => rand(1, $max),
    'mobility' => rand(1, $max),
    'ajax' => rand(1, $max)
);
arsort($tags);
$thresholds = 4;
$color1 = '0048FF';
//$color1 = '0028FF';
$color2 = 'FFFFFF';
$bgColor = 'D6DDFF';

$graphScale = 100 / max($tags);

function linearize(Array $tags) {
    asort($tags);
    $linearizedTags = array();
    $f = min($tags);
    foreach ($tags as $tag => $count) {
        $linearizedTags[$tag] = $f;
        $f += (max($tags) - min($tags)) / (count($tags) - 1);
    }
    arsort($linearizedTags);
    return $linearizedTags;
}

function logarithmicSmoothing(Array $tags) {
    global $graphScale;
    foreach ($tags as $tag => $count) {
        //$tags[$tag] = log($count + 1, max($tags)) * max($tags);
        $tags[$tag] = log($count + 1, max($tags)) * (max($tags) + min($tags)) / 2;
    }
    return $tags;
}

function googleChartTextEncode(Array $tags) {
    global $graphScale;
    foreach ($tags as $tag => $count) {
        $tags[$tag] = number_format(($count * $graphScale), 1);
    }
    return implode(',', $tags);
}

$data = array(
    'Real distribution' => googleChartTextEncode($tags),
    'Linearized' => googleChartTextEncode(linearize($tags)),
    'Logarithic smoothing' => googleChartTextEncode(logarithmicSmoothing($tags))
);

$numberOfColorsToBuild = count($data);
$imageColor = new Image_Color();
$imageColor->setWebSafe(false);
$imageColor->setColors($color1, $color2);
$colors = $imageColor->getRange($numberOfColorsToBuild);

$chartParameters = array(
    //general chart set up
    'chtt' => 'Tag Cloud Algorithm Compare', //title
    'chs' => '900x300', //chart's size in pixels. //size
    'cht' => 'bvg', //chartType
    //axis set up
    'chxt' => 'x,y', //indicates both x-axis and y-axis labels are required
    'chxr' => '1,0,'.max($tags), //y-axis range
    //data set up
    'chd' => 't:'.implode('|', $data), //the data sets
    'chxl' => '0:|'.implode('|', array_keys($tags)).'|', //axis legend
    'chdl' => implode('|', array_keys($data)), //graph legend
    //styling the chart
    'chco' => implode(',', $colors), //data colors
    'chf' => 'bg,lg,270,'.$bgColor.',1,FFFFFF,0|c,lg,0,FFFFFF', //fill colors
    'chbh' => '16', //bar width
    //grid set up
    'chg' => '0,'.(ceil(max($tags) * $graphScale / $thresholds)),
);

$chartParameterStringArray = '';
foreach ($chartParameters as $chartParameterId => $chartParameterValue) {
    $chartParameterStringArray[] = $chartParameterId.'='.$chartParameterValue;
}

echo '<?xml version="1.0"?>';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<title>PEAR HTML Tag Cloud playground</title>
<link type="text/css" rel="stylesheet" href="http://yui.yahooapis.com/2.4.1/build/datatable/assets/skins/sam/datatable.css"/>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/element/element-beta-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/datasource/datasource-beta-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/dragdrop/dragdrop-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.4.1/build/datatable/datatable-beta-min.js"></script>
</head>
<body class="yui-skin-sam">
<img src="http://chart.apis.google.com/chart?<?php echo htmlspecialchars(implode('&', $chartParameterStringArray)); ?>" alt="TagCloud Algorithm Compare chart"/>
<?php
$tagCloud = new HTML_TagCloud();
foreach ($tags as $tag => $count) {
    $tagCloud->addElement($tag, "http://example.org", $count);
}
print 'no conversion: '.$tagCloud->buildALL();

$tagCloud_linearize = new HTML_TagCloud();
foreach (linearize($tags) as $tag => $count) {
    $tagCloud_linearize->addElement($tag, "http://example.org", $count);
}
print 'linearized: '.$tagCloud_linearize->buildHTML();

$tagCloud_logarithmicSmoothing = new HTML_TagCloud();
foreach (logarithmicSmoothing($tags) as $tag => $count) {
    $tagCloud_logarithmicSmoothing->addElement($tag, "http://example.org", $count);
}
print 'logarithmic: '.$tagCloud_logarithmicSmoothing->buildHTML();

?>
<div id="TagCloudData" style="margin-top:1em"></div>
<script type="text/javascript">
YAHOO.example.Data = {
taglist: [
<?php
$dataJSArrayLines = array();
foreach ($tags as $tag => $count) {
    $dataJSArrayLines[] = '        {tag:"'.$tag.'", quantity:"'.$count.'"}';
}
echo implode(",\n", $dataJSArrayLines)."\n";
?>
    ]
};
YAHOO.util.Event.addListener(window, "load", function() {
    YAHOO.example.Basic = new function() {
        var myColumnDefs = [
            {key:"tag", sortable:true, resizeable:true, editor:"textbox"},
            {key:"quantity", formatter:YAHOO.widget.DataTable.formatNumber, sortable:true, resizeable:true, editor:"textbox", editorOptions:{validator:YAHOO.widget.DataTable.validateNumber}}
        ];
        this.myDataSource = new YAHOO.util.DataSource(YAHOO.example.Data.taglist);
        this.myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
        this.myDataSource.responseSchema = {
            fields: ["tag","quantity"]
        };
        this.myDataTable = new YAHOO.widget.DataTable("TagCloudData",
                myColumnDefs, this.myDataSource);
        // Enables inline cell editing
        //this.myDataTable.subscribe("cellClickEvent", this.myDataTable.onEventShowCellEditor);
    };
});
</script>
</body>
</html>
