<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
header('Content-Type: text/html; charset=utf-8');
include('config.php');
include('bubbles.php');
include('random.php');
include('scissors.php');


$task1 = new scissors();
$task1->slice();
echo "<hr>";

$task2 = new bubbles();
$task2->sort();
echo "<hr>";

$task3 = new random();
$task3->fill_database();
?>
</body>
</html>
