<?php
$resultDir = 'collage/result/';

$id = substr($_GET['id'], 1, 5);

print "<div align=\"center\"><img src=\"{$resultDir}{$id}.png\"></center>";