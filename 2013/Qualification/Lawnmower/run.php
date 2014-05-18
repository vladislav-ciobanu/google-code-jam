<?php
function getPatternResult($n, $m, $lawn)
{
    if ($n == 1 || $m == 1) {
        return true;
    }

    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $m; $j++) {
            $square = $lawn[$i][$j];

            $isBlocked = false;

            for ($k = 0; $k < $n; $k++) {
                if ($square < $lawn[$k][$j]) {
                    $isBlocked = true;
                    break;
                }
            }

            if ($isBlocked) {
                $isBlocked = false;
                for ($l = 0; $l < $m; $l++) {
                    if ($square < $lawn[$i][$l]) {
                        $isBlocked = true;
                        break;
                    }
                }
            }

            if ($isBlocked) {
                return false;
            }
        }
    }

    return true;
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

    list($n, $m) = explode(' ', trim($line));
    $lawn = [];
    for ($i=0; $i < $n; $i++) {
        $lawn[] = explode(' ', trim(fgets($fpIn)));
    }

    $result = getPatternResult($n, $m, $lawn);
    $message = $result ? 'YES' : 'NO';

    fwrite($fpOut, "Case #" . ++$k . ": " . $message . "\n");
}

fclose($fpIn);
fclose($fpOut);