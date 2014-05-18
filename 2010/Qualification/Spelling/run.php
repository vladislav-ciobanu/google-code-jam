<?php
function getMap()
{
    $map = [' ' => '0'];
    for ($i = 97; $i < 123; $i++) {
        $map[chr($i)] = (string)getCode(chr($i));
    }

    return $map;
}

function getCode($char)
{
    $i = ord($char);
    $code = (floor(($i-97)/3) + 2);
    $rest = ($i-97) % 3;

    if ((($code == 9 || $code == 8) && $rest % 3 == 0) || $code > 9) {
        $code--;
        $rest = 3;
    }

    if (($code == 9 || $code == 8) && $i < 122) {
        $rest--;
    }

    $newCode = $code;

    if ($rest) {
        while ($rest) {
            $newCode += $code * pow(10, $rest);
            $rest--;
        }

    }

    return $newCode;
}

function getPhoneCodes($line, &$map)
{
    //  var_dump($map, $line);die;
    $len = strlen($line);
    $prevCode = [0 => ''];
    $newLine = '';

    for ($i = 0; $i < $len; $i++) {
        $code = $map[$line[$i]];

        if ($code[0] == $prevCode[0] /*&& $line[$i] != ' '*/) {
            $newLine .= ' ';
        }

        $newLine .= $code;
        $prevCode = $code;
    }

    return $newLine;
}

//$fpIn = fopen ('C-small-practice.in', 'r');
//$fpOut = fopen ('C-small-practice.out', 'w');
$fpIn = fopen ('C-large-practice.in', 'r');
$fpOut = fopen ('C-large-practice.out', 'w');

if (!$fpIn || !$fpOut) {
    echo 'err';
    exit;
}

$cases = fgets($fpIn);
$map = getMap();
$k = 0;

while (($line = fgets($fpIn)) !== false) {

    $newLine = getPhoneCodes(str_replace(["\n", "\r"], '', $line), $map);

    fwrite($fpOut, "Case #" . ++$k . ": " . $newLine . "\n");
}

fclose($fpIn);
fclose($fpOut);
echo 'done';