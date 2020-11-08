<?php
require "Entity/Match.php";


$playerC = new Player("Debutant");
$playerA = new Player("Averti");
$playerD = new Player("AvertiPlus");
$playerB = new Player("Expert");

$playerA->setRatio(1700);
$playerD->setRatio(1800);
$playerB->setRatio(2500);

echo $playerA->getRatio()."\n";
echo $playerB->getRatio()."\n";
echo $playerC->getRatio()."\n";
echo $playerD->getRatio()."\n";

$matchAB = new Match($playerA, $playerB);
echo $matchAB->getProbabilityOp1()."\n";
echo $matchAB->getProbabilityOp2()."\n";

$matchAC = new Match($playerA, $playerC);
echo $matchAC->getProbabilityOp2()."\n";
echo $matchAC->getProbabilityOp1()."\n";

$matchAD = new Match($playerA, $playerD);
echo $matchAC->getProbabilityOp1()."\n";
echo $matchAC->getProbabilityOp2()."\n";

$matchAB->finishMatch(1);
echo $playerA->getRatio()."\n";
echo $playerB->getRatio()."\n";


?>