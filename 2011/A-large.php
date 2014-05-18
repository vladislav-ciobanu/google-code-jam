<?php
//35 #    46 .
function solve($matrix, $r, $c, $nbDiez)
{
    if (!$nbDiez) {
        return $matrix;
    }
    
    if ($nbDiez%4 != 0) {
        return false;
    }
    
    for ($i=0; $i<$r; $i++) {
        for ($j=0; $j<$c; $j++) {
            if ($matrix[$i][$j] != '#') continue;
            if (!isset($matrix[$i+1]) || $matrix[$i][$j+1]!='#' 
                || $matrix[$i+1][$j]!='#' || $matrix[$i+1][$j+1]!='#') {
                return false;
            }
            $matrix[$i][$j] = '/';
            $matrix[$i][$j+1] = '\\';
            $matrix[$i+1][$j] = '\\';
            $matrix[$i+1][$j+1] = '/';
        }
    }
    
    return $matrix;    
}


$fpIn = fopen ('A-large.in', 'r');
$fpOut = fopen ('A-large.out', 'w');

if (!$fpIn || !$fpOut) {
    exit;
}

$cases = fgets($fpIn);
$k = 0;

while (($line = fgets($fpIn)) !== false) {
    list($r,$c)= explode(' ', $line);
    
    $matrix = array();
    $diez = 0;
    
    for ($i=1; $i<=$r; $i++) {
        $str = trim(fgets($fpIn));
        $tmp = count_chars($str, 1);
        $diez += isset($tmp[35]) ? $tmp[35] : 0;
        $matrix[] = $str;
    }
    
    $t = solve($matrix, $r, $c, $diez);
    
    
    fwrite($fpOut, 'Case #' . ++$k . ":\n" . ($t ? implode("\n", $t) : 'Impossible') . "\n");
}

fclose($fpIn);
fclose($fpOut);