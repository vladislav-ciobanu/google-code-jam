<?php

function checkLine($line)
{
    if ($line == 'XXXX') {
        return 'X won';
    }

    if ($line == 'OOOO') {
        return 'O won';
    }

    if (strpos($line, '.') !== false) {
        return false;
    }

    if (strpos($line, 'T') === false) {
        return 'Draw';
    }

    if (strpos($line, 'O') === false) {
        return 'X won';
    }

    if (strpos($line, 'X') === false) {
        return 'O won';
    }

    return true;
}

function getGameStatus($board)
{
    $i = 0;
    $columns = [];
    $d1 = '';
    $d2 = '';
    $isIncomplete = false;


    foreach ($board as $line) {
        $line = strtoupper(trim($line));

        $status = checkLine($line);

        if (strpos($status, 'won') !== false) {
            return $status;
        }

        if (!$status) {
            $isIncomplete = true;
        }

        $arr = str_split($line);
        $j = 0;


        foreach ($arr as $chr) {

            if (!isset($columns[$j])) {
                $columns[$j] = '';
            }
            $columns[$j] .= $chr;
            $j++;
        }

        $d1 .= $line[$i];
        $d2 .= $line[3-$i];
        $i++;
    }

    foreach ($columns as $line) {
        $status = checkLine($line);

        if (strpos($status, 'won') !== false) {
            return $status;
        }

        if (!$status) {
            $isIncomplete = true;
        }
    }

    $status = checkLine($d1);

    if (strpos($status, 'won') !== false) {
        return $status;
    }

    if (!$status) {
        $isIncomplete = true;
    }

    $status = checkLine($d2);

    if (strpos($status, 'won') !== false) {
        return $status;
    }

    if (!$status) {
        $isIncomplete = true;
    }

    return $isIncomplete ? 'Game has not completed' : 'Draw';
}

//$fpIn = fopen ('A-small.in', 'r');
//$fpOut = fopen ('A-small.out', 'w');
$fpIn = fopen ('A-large.in', 'r');
$fpOut = fopen ('A-large.out', 'w');

if (!$fpIn || !$fpOut) {
    echo 'err';
    exit;
}

$cases = fgets($fpIn);
$k = 0;

while (($line = fgets($fpIn)) !== false) {
    $board = [
        $line,
        fgets($fpIn),
        fgets($fpIn),
        fgets($fpIn),
    ];
    fgets($fpIn);

    $newLine = getGameStatus($board);

    fwrite($fpOut, "Case #" . ++$k . ": " . $newLine . "\n");
}

fclose($fpIn);
fclose($fpOut);