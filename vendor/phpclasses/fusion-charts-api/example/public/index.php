<?php 
    require_once '../../../../../vendor/autoload.php'; 
?>

<html>
<head>
    <style type="text/css">
        body{ text-align: center; }
        ul li a{ text-decoration: none; color: #ccc; }
        ul li a:hover{ color: #000; transition: 1s; text-decoration: underline; }
        ul li{ display: inline; padding: 5px 10px 5px 10px; }
        ul li:not(:first-child){ margin-left: 15px; }
    </style>
    <title>Api Fusion Charts</title>
</head>
<body>
<ul>
    <li><a href="index.php?action=pareto">Pareto</a></li>
    <li><a href="index.php?action=columns">Columns</a></li>
    <li><a href="index.php?action=columns-line">Columns Line</a></li>
    <li><a href="index.php?action=plot">Plot</a></li>
    <li><a href="index.php?action=pie">Pie</a></li>
    <li><a href="index.php?action=line">Line</a></li>
</ul>
<?php
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'pareto':
            require_once 'pareto.php';
            break;
        case 'columns':
            require_once 'columns.php';
            break;
        case 'columns-line':
            require_once 'columns-line.php';
            break;
        case 'plot':
            require_once 'plot.php';
            break;
        case 'pie':
            require_once 'pie.php';
            break;
        case 'line':
            require_once 'line.php';
            break;
        default:
            echo '<b>FusionCharts API</b>';
    }
}else {
    echo '<b>FusionCharts API</b>';
}
?>
</body>
</html>