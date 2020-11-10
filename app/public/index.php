<?php
require "../src/Entity/Match.php";


echo "Welcome to our game";

$playerA = new Player("A");
$playerB = new Player("B");
$playerC = new Player("C");
$playerD = new Player("D");

$playerA->setPoints("1700");
$playerB->setPoints("2500");
$playerC->setPoints("1200");
$playerD->setPoints("1800");

echo "Here are our contestants","\n";



echo "Joueur A : ",$playerA->getPoints(),"\n";
echo "Joueur B : ",$playerB->getPoints(),"\n";
echo "Joueur C : ",$playerC->getPoints(),"\n";
echo "Joueur D : ",$playerD->getPoints(),"\n";



 
$matchAB = new Match($playerA,$playerB);
echo "Joueur A face au joueur B ",$matchAB->get_proba() ,"\n";
echo "Joueur B face au joueur A ",(1-$matchAB->get_proba()),"\n";


$matchAC = new Match($playerA,$playerC);
echo "Joueur A face au joueur C ",$matchAC->get_proba() ,"\n";
echo "Joueur C face au joueur A ",1-$matchAC->get_proba(),"\n";

$matchAD = new Match($playerA,$playerD);
echo "Joueur A face au joueur D ",$matchAD->get_proba() ,"\n";
echo "Joueur D face au joueur A ",1-$matchAD->get_proba(),"\n";


$matchAB->endMatch(1);
echo $playerA->getPoints(),"\n";
echo $playerB->getPoints(),"\n";

?>


