<?php

use Chalkboard\Chalkboard;
include 'Chalkboard.php';


$chalkBoard = new Chalkboard();
//get the templates/pages from your project
$fileFolder = $test->getFolderFiles('../test/templates');

//get all the parsed line from each files
$arrayLine = [];
foreach ($fileFolder as $file) {
    $arrayLine = array_merge($arrayLine, $test->parseFile($file));
}
//create an array of parsed line
$arrayLine = array_intersect_key($arrayLine, array_unique(array_map('strtolower', $arrayLine)));

//create the yaml or xml file with all the lines
$test->htmlToYaml($arrayLine);
$test->htmlToXml($arrayLine);