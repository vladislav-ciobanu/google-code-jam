<?php
$fpIn = fopen ('C-small.in', 'r');
$fpOut = fopen ('C-small.out', 'w');

if (!$fpIn || !$fpOut) exit;

$cases = fgets($fpIn);
$i = 0;
$max = 0;
$seq = array();

while (($count = fgets($fpIn)) !== false) {
    $line = fgets($fpIn);    
    calc($line);
    fwrite($fpOut, 'Case #' . ++$i . ': ' . ($max ? $max : 'NO'));
    
    if ($i < $cases) {
        fwrite ($fpOut, "\n");
    }
}

fclose($fpIn);
fclose($fpOut);

function calc($line)
{
    global $max, $seq;
    
    $seq = explode(' ', trim($line));
    $max = 0;
    
    for ($i = 1; $i < count($seq); $i++) {
        genComb($i, 0);    
    }
}



function calcBinSum($nr)
{
    if (count($nr) == 1) {
        return current($nr);
    }
    
    $s = 0;
    
    foreach ($nr as $i) {
        $s ^= $i;
    }
    
    return $s;
}

function genMax($nr)
{
    global $seq, $max;
    
    $diff = array_diff_key($seq, $nr);
    
    $s1 = array_sum($diff);
    $s2 = calcBinSum($nr);

    if ($s1 == $s2) {
        $tmp = max(array($s1, array_sum($nr)));
        if ($tmp > $max) {
            $max = $tmp;    
        }        
    }
}


function genComb($k, $start)
{
    global $seq, $nr;
    
    if (!$k) {
        genMax($nr);
        return;
    }
    
    $k--;
    
    for ($i = $start; $i < count($seq) - $k; $i++) {        
        $nr[$i] = $seq[$i];
        genComb($k, $i+1);
        array_pop($nr);
    }
}

