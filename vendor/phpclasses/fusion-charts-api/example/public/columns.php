<?php

// Data from db
$months = array('Jan', 'Feb', 'Mar', 'Apr');
$values = array(100, 200, 150, 210);

$pathJS  = 'fusion-charts/' . FusionCharts_Chart_ColumnLine::JS_NAME;
$pathSWF = 'fusion-charts/' . FusionCharts_Chart_ColumnLine::SWF_NAME;

$chart = new FusionCharts_Chart_ColumnLine($pathSWF, $pathJS);

$categories = new FusionCharts_Tag_Categories();
foreach ($months as $month) {
    $category = new FusionCharts_Tag_Category($month);
    $categories->addCategory($category);
}

$columns = new FusionCharts_Tag_DataSet();
foreach ($values as $value) {
    $column = new FusionCharts_Tag_Set($value);
    $columns->addSet($column);
}

$chart
    ->setName('Chart Columns Example')
    ->setWidth(800)
    ->setHeight(400)
    ->setLabelRotate(true)
    ->setXdescription('x values')
    ->setYdescription('y values')
    ->setAttribute('showyaxisvalues', '0')
    ->addCategories($categories)
    ->addColumns($columns);

echo $chart->render();