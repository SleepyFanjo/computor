<?php

require_once("calculate.php");

function addToken($nb1, $factor, $mod, &$result) {
    for ($i = 0; $factor[2] - $i >= 0 && !isset($result[$factor[2] - $i]); $i++) {
        $result[$factor[2] - $i] = 0;
    }
    if (ctype_digit($nb1))
        $result[$factor[2]] += intval($nb1) * $mod;
    else
        $result[$factor[2]] += floatval($nb1) * $mod;
}

function loadCommandLine($argv) {
    if (!isset($argv[1])) {
        die ('No parameters, are you kidding me ?');
    }
    elseif (!preg_match('/((-*[0-9]+\.{0,1}[0-9]* \* X\^\d+)( *[+-=]* *))+/', $argv[1])) {
        die('Invalid Expression given');
    }
    
    $tokenList = explode(" ", $argv[1]);
    if (is_numeric($tokenList[count($tokenList) - 1])) {
        array_push($tokenList, "*", "X^0");
    }
    
    // Computing token list
    $result = array();
    $mod = 1;
    for ($i = 0; $i < count($tokenList); $i+=3) {
        addToken($tokenList[$i], $tokenList[$i+2], $mod, $result);
        if (isset($tokenList[$i + 3]) && $tokenList[$i + 3] == "-") {
            $tokenList[$i + 4] = $tokenList[$i + 3].$tokenList[$i + 4];
        }
        else if (isset($tokenList[$i + 3]) && $tokenList[$i + 3] == "=") {
            $mod = -1;
        }
        $i++;
    }
    ksort($result);
    return ($result);
}

function printEasy($expr) {
    echo "Reduced form: ";
    $first = true;
    foreach ($expr as $degre => $value) {
        if ($first && $value > 0) {
            echo $value." * X^".$degre;
            $first = false;
        }
        elseif ($first && $value < 0) {
            echo "-".abs($value)." * X^".$degre;
            $first = false;
        }
        else if ($value > 0) {
            echo " + ".$value." * X^".$degre;
        }
        else if ($value < 0){
            echo " - ".abs($value)." * X^".$degre;
        }
    }
    echo " = 0\n";
    $polynomial = max(array_keys($expr));
    $i = 0;
    while ($polynomial - $i > 0 && $expr[$polynomial - $i] == 0)
    {
        $i++;
    }
    echo 'Polynomial degree: ';
    echo $polynomial - $i . PHP_EOL;
    if ($polynomial - $i > 2) {
        die("The polynomial degree is stricly greater than 2, I can't solve.");
    }
    return $polynomial - $i;
}

$expr = loadCommandLine($argv);
$degree = printEasy($expr);
calculate($expr, $degree);

?>