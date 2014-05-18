<?php

$fpIn = fopen ('B-small.in', 'r');
$fpOut = fopen ('B-small.out', 'w');

if (!$fpIn || !$fpOut) {
    exit;
}

$cases = fgets($fpIn);
$i = 0;
$opL = array();

while (($line = fgets($fpIn)) !== false) {
    $list = genList($line);
    fwrite($fpOut, 'Case #' . ++$i . ': ' . $list);
    
    if ($i < $cases) {
        fwrite ($fpOut, "\n");
    }
}

fclose($fpIn);
fclose($fpOut);

function genList($line) 
{
    global $opL;
    
    $line = trim($line);
    preg_match('/^(\d+)\s+([A-Z\s]*)\s*(\d+)\s+([A-Z\s]*)\s*(\d+)\s*([A-Z]*)/', $line, $tmp);
    $combStr = trim($tmp[2]);
    $opStr = trim($tmp[4]);
    $magic = trim($tmp[6]);
    
    $opL = array();

    if (!empty($opStr)) {
        $oInf = count_chars(str_replace(' ', '', $opStr), 1);
        $oInf = array_combine(array_map('chr', array_keys($oInf)), $oInf);
        $op = explode(' ', $opStr);

        foreach ($op as $opC) {
            $opL[$opC[0]][] = $opC[1];
            $opL[$opC[1]][] = $opC[0];
        }    
    }
    
    $comb = array();
    if ($combStr) {
        $combArr = explode(' ', $combStr);
        foreach ($combArr as $cb) {
            $comb[$cb[0].$cb[1]] = $cb[2];
        }        
    }
    
    $list = array();
    $prev = '';
    $len = strlen($magic);

    for ($i = 0; $i < $len; $i++) {
        $c = $magic[$i];

        if (isset($comb[$prev.$c])) {
            array_pop($list);
            $newC = $comb[$prev.$c];
            $list[] = $newC;
            $prev = $newC;
        } elseif (isset($comb[$c.$prev])) {
            array_pop($list);
            $newC = $comb[$c.$prev];
            $list[] = $newC;
            $prev = $newC;
        } elseif($list && isOpp($list, $c)) {
            $list = array();
            $prev = '';
        } else {
            $list[] = $c;
            $prev = $c;
        }
    }

    return '[' . implode(', ', $list) . ']';
}

function isOpp(&$list, $c)
{
    global $opL;
    
    if (!isset($opL[$c])) return false;    

    return (bool)array_intersect($list, $opL[$c]);
}



