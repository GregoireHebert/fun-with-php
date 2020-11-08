<?php
require "Entity/Player.php";
require "Entity/Probability.php";
require "Entity/Level.php";

$level = new Level();

$playerA = new Player("PlayerA");
$playerB = new Player("PlayerB");
$playerC = new Player("PlayerC");
$playerD = new Player("PlayerD");

$playerA->setPoints(1700);
$playerB->setPoints(2500);
$playerC->setPoints(1200);
$playerD->setPoints(1800);

$probability = new Probability();

$probability1ab = $probability->getProbability($playerA, $playerB);
$probability1ba = $probability->getProbability($playerB, $playerA);

echo "Probability Player A vs Player B : ". $probability->getProbability($playerA, $playerB) ."\n";
echo "Probability Player B vs Player A : ". $probability->getProbability($playerB, $playerA) ."\n";
echo "Probability Player C vs Player A : ". $probability->getProbability($playerC, $playerA) ."\n";
echo "Probability Player A vs Player C : ". $probability->getProbability($playerA, $playerC) ."\n";
echo "Probability Player D vs Player A : ". $probability->getProbability($playerD, $playerA) ."\n";
echo "Probability Player A vs Player D : ". $probability->getProbability($playerA, $playerD) ."\n";

$playerA->setPoints($level -> newLevel($playerA, 1, $probability1ab));
echo "New Level A : ". $playerA->getPoints()."\n";
$playerB->setPoints($level -> newLevel($playerB, 0, $probability1ba));
echo "New Level B : " . $playerB->getPoints()."\n";


?>
