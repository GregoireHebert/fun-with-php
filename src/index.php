<?php
require("game.php");


$pA = new Player("Joueur A",1700);
$pB = new Player("Joueur B",2500);
$pC = new Player("Joueur C",1200);
$pD = new Player("Joueur D",1800);

$levelMan = new LevelManager();

echo "\n************************ Les joueurs : *********************\n\n";

echo $pA->toString();
echo $pB->toString();
echo $pC->toString();
echo $pD->toString();

echo "\n************************ Les probabilitès : *********************\n\n";

$gameAB = new Game($pA,$pB);
$gameAC = new Game($pA,$pC);
$gameAD = new Game($pA,$pD);

echo "probabilité de Joueur A face au Joueur B : ".$gameAB->getGameProbabilityP1VsP2()."\n";
echo "probabilité de Joueur B face au Joueur A : ".$gameAB->getGameProbabilityP2VsP1()."\n";
echo "probabilité de Joueur A face au Joueur C : ".$gameAC->getGameProbabilityP1VsP2()."\n";
echo "probabilité de Joueur C face au Joueur A : ".$gameAC->getGameProbabilityP2VsP1()."\n";
echo "probabilité de Joueur D face au Joueur A : ".$gameAD->getGameProbabilityP2VsP1()."\n";
echo "probabilité de Joueur A face au Joueur D : ".$gameAD->getGameProbabilityP1VsP2()."\n";

echo "\n************************ Niveau après match A vs B (A gagnant) : *********************\n\n";

$gameAB->fixPlayersLevel(1);


echo $pA->toString();
echo $pB->toString();


echo "\n\n";
