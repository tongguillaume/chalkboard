<?php

use Limestone\Limestone;

include 'Limestone.php';


$test = new Limestone();
$mama = $test->getFolderFiles('../templates');

foreach ($mama as $file) {
    $test->parseFile($file);
}