<?php
function isPrime($number)
{
    if ($number < 2) { /* We don't want zero or one showing up as prime */
            return FALSE;
    }
    for ($i=2; $i<=($number / 2); $i++) {
            if($number % $i == 0) { /* Modulus operator, very useful */
                    return false;
            }
    }
    return true;
}

$primes = array();

for ($i=2; $i<=10000; $i++) {
    if (isPrime($i)) {
       $primes[$i] = $i;
    }
}

function getDivisers($nb)
{
    global $primes;
    if ($nb == 1) {
        return array(1=>1);
    }
    if (isset($primes[$nb])) {
        return array($nb=>1);
    }
    
    $divs = array();
    $nr = $nb;
    
    foreach ($primes as $i) {
        while ($nr % $i == 0) {
            $nr /= $i;
            if (isset($divs[$i])) {
                $divs[$i]++;
            } else {
                $divs[$i] = 1;
            }            
        }            
    }
    
    return $divs;
}

function solve($nb, $low, $high, $freqs)
{   
    global $primes;
    
    if ($low == 1) return $low;
    
    $divs = array();
    
    foreach ($freqs as $fr) {
        $divs[$fr] = getDivisers($fr);
    }
    
    $common = null;
    echo "<br><br>";
    foreach ($divs as $fr=>$nbs) {
        if ($fr===1) continue;
        echo "<br>".$fr."<br>";print_r($nbs);
        if ($common === null) {
            $common = $nbs;
        } else {
            $common = array_intersect_key($nbs, $common);
        }
        
        if (!$common) break;        
    }
    
    //print_r($common);
    
    
    //print_r(func_get_args());
}


$fpIn = fopen ('B-small.in', 'r');
$fpOut = fopen ('B-small.out', 'w');

if (!$fpIn || !$fpOut) {
    exit;
}

$cases = fgets($fpIn);
$k = 0;

while (($line = fgets($fpIn)) !== false) {
    list($nb, $low,$high)= explode(' ', trim($line));
    $freqs = explode(' ', trim(fgets($fpIn)));
    
    $fr = solve($nb, $low, $high, $freqs);
    
    
    fwrite($fpOut, 'Case #' . ++$k . ": " . ($fr ? $fr : 'NO') . "\n");
}

fclose($fpIn);
fclose($fpOut);