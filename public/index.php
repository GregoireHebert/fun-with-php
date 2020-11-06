<?php
require "src/Entity/Probability.php";
require "src/Entity/Match.php";

function printProbability(Player $player1, Player $player2) {
    echo "Probability of player " . $player1->getName() . " against player " . $player2->getName();
    echo ": " . Probability::getProbability($player1, $player2) . "\n";
} 

$playerA = new Player("A");
$playerA->setPoints(1700);
$playerB = new Player("B");
$playerB->setPoints(2500);
$playerC = new Player("C");
$playerC->setPoints(1200);
$playerD = new Player("D");
$playerD->setPoints(1800);
printProbability($playerA, $playerB);
printProbability($playerB, $playerA);
printProbability($playerC, $playerA);
printProbability($playerA, $playerC);
printProbability($playerD, $playerA);
printProbability($playerA, $playerD);

$match = new Match($playerA, $playerB);
$match->matchOutcome("win1");
echo "After Player A beats player B: \n";
echo "Player A: " . $playerA->getPoints() . " Player B: " . $playerB->getPoints();
