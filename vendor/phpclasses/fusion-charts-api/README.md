# FusionCharts - API #
__http://www.fusioncharts.com/__
##[PHPClasses](http://www.phpclasses.org/package/9002-PHP-Generate-graphical-charts-using-FusionCharts-API.html)##

## Description ##
This package can generate graphical charts using the FusionCharts API.

It provides a base class that can generate HTML and JavaScript for rendering several types of charts supported by the FusionCharts API taking XML code that defines the parameters of the charts.

The package comes also with specialized classes that can generate the necessary XML code with the parameters for several types of charts.

Currently it comes with classes for rendering charts of types column, line, plot, pie and pareto.

The chart classes provide a fluent interface to define any of the supported parameters like the chart data values, chart size, colors, labels, fonts, and other chart specific parameters.

## Requirement ##

- PHP 5.3 >

## Install ##
```
$ composer require deoliveiralucas/fusion-charts-api
```

## Examples ##

- Columns
``` php
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
```

- Please see [EXAMPLES](https://github.com/deoliveiralucas/fusion-charts-api/tree/master/example/public) for details.

## Contributing ##

- Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

- GNU General Public License Versions. Please see [License File](http://opensource.org/licenses/gpl-license.html) for more information.
