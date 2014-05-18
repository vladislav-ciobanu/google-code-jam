<?php
//46 .    48 0    49 1
function solve($teams, $nb)
{

    $wp = array();
    $owp = array();
    
    
    for ($i=0; $i<$nb; $i++) {
        $t=$teams[$i];
        $wp[$i] = avg($t);
        
        $owpArr = array();
        for ($j=0; $j<$nb; $j++) {
            if ($i==$j || $teams[$j][$i]=='.')continue;
            
            $newScore = $teams[$j];
            $newScore[$i] = '';
            $owpArr[] = avg($newScore);
        }
        //print_r($owpArr);
        $owp[$i] = array_sum($owpArr)/count($owpArr);
    }
    
    $rpi = array();
    
    foreach ($wp as $i=>$_wp) {
        $newOwp = $owp;
       
        for ($j=0; $j<$nb; $j++) {
            if ($teams[$i][$j]=='.') {
                unset($newOwp[$j]);
            }                
        }
        
        $oowp = array_sum($newOwp)/count($newOwp);
        $rpi[] = 0.25 * $_wp + 0.5 * $owp[$i] + 0.25 * $oowp;
    }
    return $rpi;
}

function avg($str)
{
    $chrs = count_chars($str, 1);
    $one = isset($chrs[49]) ? $chrs[49] : 0;
    $zero = isset($chrs[48]) ? $chrs[48] : 0;
    
    return $one/($one+$zero);
}

$fpIn = fopen ('A-large.in', 'r');
$fpOut = fopen ('A-large.out', 'w');

if (!$fpIn || !$fpOut) {
    exit;
}

$cases = fgets($fpIn);
$k = 0;

while (($line = fgets($fpIn)) !== false) {
    $nb = $line;
    
    $teams = array();
    
    for ($i=1; $i<=$nb; $i++) {
        $teams[] = trim(fgets($fpIn));
    }
    
    $rpi = solve($teams, $nb);
    
    
    fwrite($fpOut, 'Case #' . ++$k . ":\n" . implode("\n", $rpi)."\n");
}

fclose($fpIn);
fclose($fpOut);