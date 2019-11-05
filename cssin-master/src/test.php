<?php
require 'cssin.php';
$cssin = new FM\CSSIN();
$html_with_inlined_css = $cssin->inlineCSS('http://localhost/testwork/testhtml.html');
print_r($html_with_inlined_css);
?>