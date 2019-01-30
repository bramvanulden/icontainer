<?php

$command = escapeshellcmd('route.py');
$output = shell_exec($command);
echo $output;
header("location: ../../newhome.php");
