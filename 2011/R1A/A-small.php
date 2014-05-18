<?php
function checkPossib($line)
{
    list($n, $pd, $pg) = explode(' ', $line);
    if ($pd == 0) return $pg==100 ? false : true;
    
    if ($pd == 100) return $pg == 0 ? false : true;
    if ($pg == 100 && $pd < 100) return false;
    if ($pg == 0) return $pd == 0 ? true : false;
    
    //return ($pd*$n) % 100 == 0 ? true : false;
    
    //echo $pd.":".$pg."<br>";
    $origPd = $pd;
    $pd = getMinNb($pd, 2);
    $pd = getMinNb($pd, 5);
    
    $d = 100/($origPd/$pd);
    /*
    $pg = getMinNb($pg, 2);
    $pg = getMinNb($pg, 5);*/
    
    //echo $pd.":".$pg."<br><br>";
    //echo $d."<br>";
    return (bool)($d <= $n);
    
    
    
}

function getMinNb($nb, $div)
{
    if ($div < 2) return $nb;
    $i = 0;
    
    while($nb%$div == 0) {
        $nb /= $div;
        $i++;
        if ($i == 2) return $nb;
    }
    
    return $nb;
}

$fpIn = fopen ('A-small.in', 'r');
$fpOut = fopen ('A-small.out', 'w');

if (!$fpIn || !$fpOut) {
    exit;
}

$cases = fgets($fpIn);
$i = 0;

while (($line = fgets($fpIn)) !== false) {
    $t = checkPossib($line);
    fwrite($fpOut, 'Case #' . ++$i . ': ' . ($t ? 'Possible' : 'Broken' ));
    
    if ($i < $cases) {
        fwrite ($fpOut, "\n");
    }
}

fclose($fpIn);
fclose($fpOut);