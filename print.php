<?php

function print1D($b, $a) {
    if ($a !== 0) {
        echo "The solution is : (approx)".(float)(-$b)/(float)$a." : (exact)";

        $res = reduceFraction(abs($b), $a);
        if ($b > 0) {
            echo "-".$res[0]."/".$res[1]."\n";
        }
        else {
            echo $res[0]."/".$res[1]."\n";
        }
    }
    else {
        echo "There are no solutions for that (divide by 0)\n";
    }
}

function print2D($fraction, $delta, $expr) {
    echo 'There are 2 solutions :'. PHP_EOL;
    echo '(exact)  X1 = ('.$fraction[0].' - sqrt('.$delta.'))/'.$fraction[1].', ';
    echo 'X2 = ('.$fraction[0].' + sqrt('.$delta.'))/'.$fraction[1].PHP_EOL;
    $x1 = (floatval($fraction[0]) - sqrt($delta)) / floatval($fraction[1]);
    $x2 = (floatval($fraction[0]) + sqrt($delta)) / floatval($fraction[1]);
    echo "(approx) X1 = $x1, X2 = $x2". PHP_EOL;
    echo 'Factored form : '.$expr[2].'(X - (('.$fraction[0].' - sqrt('.$delta.'))/'.$fraction[1].'))(X - (('.$fraction[0].' + sqrt('.$delta.'))/'.$fraction[1].'))'. PHP_EOL;
}

function print2DComplex($fraction, $delta) {
    echo 'There are 2 complex soltuions :'.PHP_EOL;
    echo '(exact)  X1 = ('.$fraction[0].' - i * sqrt('.-$delta.'))/'.$fraction[1].', ';
    echo 'X2 = ('.$fraction[0].' + i * sqrt('.-$delta.'))/'.$fraction[1].PHP_EOL;
    $x1[0] = floatval($fraction[0]) / floatval($fraction[1]);
    $x1[1] = -sqrt(-$delta) / floatval($fraction[1]);
    $x1[2] = sqrt(-$delta) / floatval($fraction[1]);
    echo '(approx) X1 = '.$x1[0].' + i * '.$x1[1].', ';
    echo 'X2 = '.$x1[0].' + i * '.$x1[2].PHP_EOL;
}

?>