<?php

include("src/Player.php");
include("src/Game.php");

$playerA=new Player("A");
$playerA->setPoints(1700);

$playerB=new Player("B");
$playerB->setPoints(2500);

$playerC=new Player("C");
$playerC->setPoints(1200);

$playerD=new Player("D");
$playerD->setPoints(1800);

echo "probabilité du joueur ".$playerA->getName()." face au joueur ".$playerB->getName().": ".$playerA->probability($playerB->getPoints());
echo "<br>";
echo PHP_EOL; 
echo "probabilité du joueur B face au joueur A: ".$playerB->probability($playerA->getPoints());
echo "<br>";
echo PHP_EOL; 
echo "probabilité du joueur C face au joueur A: ".$playerC->probability($playerA->getPoints());
echo "<br>";
echo PHP_EOL; 
echo "probabilité du joueur A face au joueur C: ".$playerA->probability($playerC->getPoints());
echo "<br>";
echo PHP_EOL; 
echo "probabilité du joueur D face au joueur A: ".$playerD->probability($playerA->getPoints());
echo "<br>";
echo PHP_EOL; 
echo "probabilité du joueur A face au joueur D: ".$playerA->probability($playerD->getPoints());
echo "<br>";
echo PHP_EOL; 

$game = new Game($playerA,$playerB);
$game->doGame(1);

echo "<br>";
echo PHP_EOL; 
echo "Le nouveau niveau du joueur ".$playerA->getName()." est: ".$playerA->getPoints();
echo "<br>";
echo PHP_EOL; 
echo "Le nouveau niveau du joueur ".$playerB->getName()." est: ".$playerB->getPoints();