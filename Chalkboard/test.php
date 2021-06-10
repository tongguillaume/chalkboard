<?php

use Chalkboard\Chalkboard;
include 'Chalkboard.php';


$test = new Chalkboard();

// mes tests
var_dump($test->parseFile("jesaispas")); die();

$mama = $test->getFolderFiles('../templates');
$arrayLine = [];
foreach ($mama as $file) {
    $arrayLine = array_merge($arrayLine, $test->parseFile($file));
}
$arrayLine = array_intersect_key($arrayLine, array_unique(array_map('strtolower', $arrayLine)));
$test->htmlToYaml($arrayLine);
$test->htmlToXml($arrayLine);