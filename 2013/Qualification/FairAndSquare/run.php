<?php
//function isPalindromeOld($number)
//{
//    $reverse_number = 0;
//
//    while($number > 0){
//        $lsd = $number % 10;
//        $reverse_number = $reverse_number * 10 + $lsd;
//        $number = ($number - $lsd) / 10;
//    }
//
//    return $number === $reverse_number;
//}

function isPalindrome($number)
{
    $number = (string)$number;
    return $number === strrev($number);
}

function getNumberOfPalindromes($startNb, $endNb)
{
    $result = 0;
    $start = ceil(sqrt($startNb));

    for ($i = $start; ; $i++) {
        $parent = $i * $i;

        if ($parent > $endNb) {
            break;
        }

        if (!isPalindrome($i)) {
            continue;
        }


        if (isPalindrome($parent)) {
            $result++;
        }
    }

    return $result;
}
//echo 'test';die;
$fpIn = fopen ('C-large-1.in', 'r');
$fpOut = fopen ('C-large-1.out', 'w');
//$fpIn = fopen ('A-large.in', 'r');
//$fpOut = fopen ('A-large.out', 'w');

if (!$fpIn || !$fpOut) {
    echo 'err';
    exit;
}

$cases = fgets($fpIn);
$k = 0;

while (($line = fgets($fpIn)) !== false) {
    list($startNb, $endNb) = explode(' ', $line);
    $newLine = getNumberOfPalindromes($startNb, $endNb);
    fwrite($fpOut, "Case #" . ++$k . ": " . $newLine . "\n");
}

fclose($fpIn);
fclose($fpOut);