<?php

function calcTime($line)
{
    $line = trim(substr($line, strpos($line, ' ')));    
    $seq = explode(' ', $line);

    $prevP['O'] = 1;
    $prevP['B'] = 1;
    $prevC = $seq[0][0];
    $t = 0;
    $tC['O'] = 0;
    $tC['B'] = 0;
    $rc = array('B' => 'O', 'O' => 'B');
    $count = 0;

    for ($i = 0 ; $i < count($seq); $i += 2) {
        $c = $seq[$i];
        $p = $seq[$i + 1];

        if ($prevC == $c) {
            $count = abs($prevP[$c] - $p) + 1;
        } else {
            $posDiff = abs($p - $prevP[$c]);

            if ($posDiff <= $tC[$c]) {
                $count = 1;
            } else {
                $count = $posDiff - $tC[$c] + 1;
            }        

            $tC[$c] = 0;
        }

        $t += $count;
        $tC[$rc[$c]] += $count;

        $prevC = $c;
        $prevP[$c] = $p;
    }
    
    return $t;
}

$p = 4;
$str = 'B 100 O 1';

$fpIn = fopen ('A-large.in', 'r');
$fpOut = fopen ('A-large.out', 'w');

if (!$fpIn || !$fpOut) {
    exit;
}

$cases = fgets($fpIn);
$i = 0;

while (($line = fgets($fpIn)) !== false) {
    $t = calcTime($line);
    fwrite($fpOut, 'Case #' . ++$i . ': ' . $t);
    
    if ($i < $cases) {
        fwrite ($fpOut, "\n");
    }
}

fclose($fpIn);
fclose($fpOut);