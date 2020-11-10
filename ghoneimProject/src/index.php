<?php
namespace toto;
require_once "Player.php";
require_once "Match.php";

$A = new Player(1700.0,"A");
$B = new Player(2500.0,"B");
$C = new Player(1200.0,"C");
$D = new Player(1800.0,"D");

echo (
    nl2br("probabilité du joueur A face au joueur B: " . $A->getWinProbability($B) . "\n" .
    "probabilité du joueur B face au joueur A: " . $B->getWinProbability($A) . "\n" .
    "probabilité du joueur C face au joueur A: " . $C->getWinProbability($A) . "\n" .
    "probabilité du joueur A face au joueur C: " . $A->getWinProbability($C) . "\n" .
    "probabilité du joueur D face au joueur A: " . $D->getWinProbability($A) . "\n" .
    "probabilité du joueur A face au joueur D: " . $A->getWinProbability($D) . "\n")
);

$match = new Match();
$match->play($A, $B);
echo ($A);
echo ($B);
$match->play($B, $A);
echo ($B);
echo ($A);
$match->play($A, $C);
echo ($A);
echo ($C);
$match->play($D, $A);
echo ($D);
echo ($A);
$match->play($A, $D);
echo ($A);
echo ($D);
