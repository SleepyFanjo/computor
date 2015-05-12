<?php

require_once("print.php");

function ft_abs($nb) {
    return $nb > 0 ? $nb : -$nb;
}

function pgcd($a, $b) {
    return $a ? pgcd($b % $a, $a) : $b;
}

function reduceFraction($top, $bottom) {
    if (is_int($top) && is_int($bottom))
    {
        $pgcd = pgcd($top, $bottom);
        $top /= $pgcd;
        $bottom /= $pgcd;
    }
    return array($top, $bottom);
}

function calculate2($expr) {
    $delta = ($expr[1] * $expr[1]) - (4 * $expr[2] * $expr[0]);
    echo "Delta = ".$delta."\n";
    if ($delta == 0) {
        print1D($b, 2 * $a);
    }
    else {
        $fraction = reduceFraction(ft_abs($expr[1]), 2 * ft_abs($expr[2]));
        $fraction[0] = -$fraction[0] * ($expr[1] / ft_abs($expr[1]));
        $fraction[1] = $fraction[1] * ($expr[2] / ft_abs($expr[2]));
        if ($delta > 0) {
            print2D($fraction, $delta, $expr);
        }
        else
            print2DComplex($fraction, $delta);
    }
}

function calculate($expr, $degree) {
    if ($degree == 0) {
        echo "OMFG, it's not a polynom you know ? You really need a tool to solve a constant function ?\n";
        if ($expr[0] == 0) {
            echo "The solution is : R\n";
        }
        else {
            echo "There are no solutions for that\n";
        }
    }
    else if ($degree == 1) {
        print1D($expr[0], $expr[1]);
    }
    else {
        calculate2($expr);
    }
}

?>