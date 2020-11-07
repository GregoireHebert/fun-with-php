<?php
    include "match.php";

    $joueurA = new joueur("joueurA");
    $joueurA->elo = 1700;
    $joueurB = new joueur("joueurB");
    $joueurB->elo = 2500;
    $joueurC = new joueur("joueurC");
    $joueurD = new joueur("joueurD");
    $joueurD->elo = 1800;

    echo $joueurA;
    echo $joueurB;
    echo $joueurC;
    echo $joueurD;

    $jA_vsjB = new match($joueurA, $joueurB);
    $jB_vsjA = new match($joueurB, $joueurA);

    $jC_vsjA = new match($joueurC, $joueurA);
    $jA_vsjC = new match($joueurA, $joueurC);

    $jD_vsjA = new match($joueurD, $joueurA);
    $jA_vsjD = new match($joueurA, $joueurD);

    echo $joueurA;
    echo $joueurB;
    echo $joueurC;
    echo $joueurD;
?>