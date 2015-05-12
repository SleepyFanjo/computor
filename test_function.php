<?php

function calcPrix($mensualite, $apport, $annee) {
    $taux = 2.8;
    $taux /= 100;
    $prix = ($mensualite * 12 * (1 - pow(1 + $taux / 12, -12 * $annee))) / ((1 - ($apport / 100)) * $taux);
    return $prix;
}

echo calcPrix($argv[1], 20, 25);
?>