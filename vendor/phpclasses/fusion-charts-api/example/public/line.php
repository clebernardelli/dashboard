<?php

// Data from db
$months = array('Jan', 'Feb', 'Mar', 'Apr');
$valLine1 = array(100, 200, 150, 210);
$valLine2 = array(50, 300, 90, 400);

$pathJS  = 'fusion-charts/' . FusionCharts_Chart_Line::JS_NAME;
$pathSWF = 'fusion-charts/' . FusionCharts_Chart_Line::SWF_NAME;

$chart = new FusionCharts_Chart_Line($pathSWF, $pathJS);

$categories = new FusionCharts_Tag_Categories();
foreach ($months as $month) {
    $category = new FusionCharts_Tag_Category($month);
    $categories->addCategory($category);
}

$line1 = new FusionCharts_Tag_DataSet();
foreach ($valLine1 as $value) {
    $line = new FusionCharts_Tag_Set($value);
    $line1->addSet($line);
}

$line2 = new FusionCharts_Tag_DataSet();
foreach ($valLine2 as $value) {
    $line = new FusionCharts_Tag_Set($value);
    $line2->addSet($line);
}

$trendLine1 = new FusionCharts_Tag_Line();
$trendLine1
    ->setValue(250)
    ->setColor('FF0000')
    ->setDisplayValue('Trendline1 Example: 250')
    ->setValueOnRight();

$trendLine2 = clone $trendLine1;
$trendLine2
    ->setValue(390)
    ->setDisplayValue('Trendline2 Example: 390');

$trendLines = new FusionCharts_Tag_TrendLines();
$trendLines
    ->addLine($trendLine1)
    ->addLine($trendLine2);

$chart
    ->setName('Line Chart Example')
    ->setWidth(800)
    ->setHeight(400)
    ->setAttribute('showvalues', '0')
    ->setLabelRotate(true)
    ->addCategories($categories)
    ->addLine($line1)
    ->addLine($line2)
    ->addTrendLines($trendLines);

echo $chart->render();