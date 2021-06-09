<?php

use Limestone\Limestone;

include 'Limestone.php';


$test = new Limestone();
$mama = $test->getFolderFiles('../test/templates');
$arrayLine = [];
foreach ($mama as $file) {
    $arrayLine = array_merge($arrayLine, $test->parseFile($file));
}
$arrayLine = array_intersect_key($arrayLine, array_unique(array_map('strtolower', $arrayLine)));
$test->htmlToYaml($arrayLine);
$test->htmlToXml($arrayLine);