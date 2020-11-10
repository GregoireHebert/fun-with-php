<?php

require("../src/Game.php");

$playerA = new Player("Joueur A",1700);
$playerB = new Player("Joueur B",2500);
$playerC = new Player("Joueur C",1200);
$playerD = new Player("Joueur D",1800);

echo "PlayerA score: ".$playerA->getScore()."\n";
echo "PlayerB score: ".$playerB->getScore()."\n";
echo "PlayerC score: ".$playerC->getScore()."\n";
echo "PlayerD score : ".$playerD->getScore()."\n";

$playAvB = new Game($playerA, $playerB);
echo "Probabilité du joueur A face au joueur B: ".$playAvB->probabilityP1vP2()."\n";
echo "Probabilité du joueur B face au joueur A: ".$playAvB->probabilityP2vP1()."\n";

$playAvC = new Game($playerA, $playerC);
echo "Probabilité du joueur A face au joueur C: ".$playAvC->probabilityP1vP2()."\n";
echo "Probabilité du joueur C face au joueur A: ".$playAvC->probabilityP2vP1()."\n";

$playAvD = new Game($playerA, $playerD);
echo "Probabilité du joueur A face au joueur D: ".$playAvD->probabilityP1vP2()."\n";
echo "Probabilité du joueur D face au joueur A: ".$playAvD->probabilityP2vP1()."\n";

$playAvB->correctPlayersNewScore(1);

echo "Player A score: ".$playerA->getScore()."\n";
echo "Player B score: ".$playerB->getScore()."\n";
 




?>