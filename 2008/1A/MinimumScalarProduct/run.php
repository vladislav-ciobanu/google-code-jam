<?php

//$fpIn = fopen ('A-small-practice.in', 'r');
//$fpOut = fopen ('A-small-practice.out', 'w');
$fpIn = fopen ('A-large-practice.in', 'r');
$fpOut = fopen ('A-large-practice.out', 'w');

if (!$fpIn || !$fpOut) {
    echo 'err';
    exit;
}

$cases = fgets($fpIn);
$k = 0;

while (($line = fgets($fpIn)) !== false) {

    //$newLine = reverseWords(trim($line));

    //fwrite($fpOut, "Case #" . ++$k . ": " . $newLine . "\n");
}

fclose($fpIn);
fclose($fpOut);
echo 'done';