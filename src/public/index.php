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

$probability1ab = new Probability($playerA->getPoints(), $playerB->getPoints());
$probability1ba = new Probability($playerB->getPoints(), $playerA->getPoints());

$probability2ca = new Probability($playerC->getPoints(), $playerA->getPoints());
$probability2ac = new Probability($playerA->getPoints(), $playerC->getPoints());

$probability3da = new Probability($playerD->getPoints(), $playerA->getPoints());
$probability3ad = new Probability($playerA->getPoints(), $playerD->getPoints());

echo "Hello, " . $playerA->getName(). "! You have  ". $playerA->getPoints(). " points";

echo "Probability Player A vs Player B : ". $probability1ab->getProbability() ."\n";
echo "Probability Player B vs Player A : ". $probability1ba->getProbability() ."\n";
echo "Probability Player C vs Player A : ". $probability2ca->getProbability() ."\n";
echo "Probability Player A vs Player C : ". $probability2ac->getProbability() ."\n";
echo "Probability Player D vs Player A : ". $probability3da->getProbability() ."\n";
echo "Probability Player A vs Player D : ". $probability3ad->getProbability() ."\n";

echo "New Level A : ". $level -> newLevel($playerA->getPoints(), 1, $probability1ab->getProbability());
echo "New Level B : ". $level -> newLevel($playerB->getPoints(), 0, $probability1ba->getProbability());


?>
