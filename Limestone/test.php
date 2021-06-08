<?php

use Limestone\Limestone;

include 'Limestone.php';


$test = new Limestone();
$test->getFolderFiles('../templates');

$testParse = $test->parseFile("<html>
<title>Ignored Title</title>
<body>
  <h1>Hello, World!</h1>

  <p>This is some e-mail content.
  Even though it has whitespace and newlines, the e-mail converter
  will handle it correctly.

  <p>Even mismatched tags.</p>

  <div>A div</div>
  <div>Another div</div>
  <div>A div<div>within a div</div></div>

  <a href='http://foo.com'>A link</a>

</body>
</html>");
echo $testParse;