<?php
function reverseWords($line)
{
    //return implode(' ', array_reverse(explode(' ', $line)));
    $newLine = '';
    $len = strlen($line);
    $word = '';

    for ($i = $len - 1; $i >= 0; $i--) {
        if ($line[$i] == ' ') {
            $newLine .= $word . ' ';
            $word = '';
        } else {
            $word = $line[$i] . $word;
        }
    }

    $newLine .= $word;

    return $newLine;
}

//$fpIn = fopen ('B-small-practice.in', 'r');
//$fpOut = fopen ('B-small-practice.out', 'w');
$fpIn = fopen ('B-large-practice.in', 'r');
$fpOut = fopen ('B-large-practice.out', 'w');

if (!$fpIn || !$fpOut) {
    echo 'err';
    exit;
}

$cases = fgets($fpIn);
$k = 0;

while (($line = fgets($fpIn)) !== false) {

    $newLine = reverseWords(trim($line));

    fwrite($fpOut, "Case #" . ++$k . ": " . $newLine . "\n");
}

fclose($fpIn);
fclose($fpOut);
echo 'done';