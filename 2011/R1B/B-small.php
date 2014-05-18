<?php

function solve($pts, $nb, $d)
{
    echo $d.":".$nb."<br>";
    print_r($pts);
    $prevP = null;
    $prevC = null;
    $pMin = null;
    
    $time = 0;
    foreach ($pts as $p=>$count) {
        $min = ((round($count/2)-1)+0.5)*$d;
        
        
        
        if ($prevC !== null) {
            if (($p-$min) - ($prevP+$pMin)>=$d) {
                //max();
            }
        } else {
            $time += $min;
        }
        
        $prevP = $p;
        $prevC = $count;        
        $pMin  = $min;
    } 
    
}


$fpIn = fopen ('B-small.in', 'r');
$fpOut = fopen ('B-small.out', 'w');

if (!$fpIn || !$fpOut) {
    exit;
}

$cases = fgets($fpIn);
$k = 0;

while (($line = fgets($fpIn)) !== false) {
    list($nb,$d)= explode(' ', $line);
    
    $pts = array();
    
    for ($i=1; $i<=$nb; $i++) {
        $str = explode(' ', trim(fgets($fpIn)));
        $pts[$str[0]] = $str[1];
    }
    
    $t = solve($pts, $nb, $d);
    
    
    fwrite($fpOut, 'Case #' . ++$k . ": " . $t . "\n");
}

fclose($fpIn);
fclose($fpOut);