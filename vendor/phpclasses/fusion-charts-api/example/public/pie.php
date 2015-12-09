<?php

// Data from db
$values = array(
    'Jan' => 100,
    'Feb' => 200,
    'Mar' => 150,
    'Apr' => 210
);

$pathJS  = 'fusion-charts/' . FusionCharts_Chart_Pie::JS_NAME;
$pathSWF = 'fusion-charts/' . FusionCharts_Chart_Pie::SWF_NAME;

$chart = new FusionCharts_Chart_Pie($pathSWF, $pathJS);

$chart
    ->setName('Chart Pie Example')
    ->setWidth(800)
    ->setHeight(400)
    ->setAttribute('showlegend', '1')
    ->setAttribute('showlabels', '0');

$slice = new FusionCharts_Tag_Set();
foreach ($values as $name => $value){
    $slice
        ->setAttribute('issliced', '1')
        ->setAttribute('label', $name)
        ->setAttribute('value', $value);

    $chart->addSlice($slice);
}

echo $chart->render();