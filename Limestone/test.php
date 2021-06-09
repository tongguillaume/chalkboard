<?php

use Limestone\Limestone;

include 'Limestone.php';


$test = new Limestone();
$mama = $test->getFolderFiles('../test/templates');
$arrayLine = [];
foreach ($mama as $file) {
    $arrayLine[] =  $test->parseFile($file);
}

$test->htmlToYaml($arrayLine);
$test->htmlToXml($arrayLine);