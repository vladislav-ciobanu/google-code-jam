<?php

function getItemIndexes($credit, $itemPrices)
{
    $credit = (int)$credit;

    foreach ($itemPrices as $index => $price) {
        $price = (int)$price;
        if ($price >= $credit) {
            continue;
        }

        $diff = $credit - $price;

        if ($diff == $price) {
            $addIndex = $index + 1;
            $searchPrices = array_slice($itemPrices, $index + 1);
        } else {
            $addIndex = 0;
            $searchPrices = $itemPrices;
        }

        $searchIndex = array_search($diff, $searchPrices);

        if (false !== $searchIndex) {//var_dump($price, $searchIndex);die;
            return [$index + 1, $searchIndex + $addIndex + 1];
        }
    }

    return [0, 0];
}

//$fpIn = fopen ('A-small-practice.in', 'r');
//$fpOut = fopen ('A-small-practice.out', 'w');
$fpIn = fopen ('A-large-practice.in', 'r');
$fpOut = fopen ('A-large-practice.out', 'w');

if (!$fpIn || !$fpOut) {
    echo 'err';
    exit;
}

$cases = fgets($fpIn);
$k = 0;

while (($line = fgets($fpIn)) !== false) {
    $credit = $line;
    $nbItems = fgets($fpIn);
    $itemPrices = explode(' ', fgets($fpIn));
    $indexes = getItemIndexes($credit, $itemPrices);
    fwrite($fpOut, "Case #" . ++$k . ": " . implode(' ', $indexes) . "\n");
}

fclose($fpIn);
fclose($fpOut);