<?php
require "../src/Entity/Match.php";

echo "Welcome to the best game EVER\n\n";

$playerA = new Player("A");
$playerB = new Player("B");
$playerC = new Player("C");
$playerD = new Player("D");

$playerA->setRank("1700");
$playerB->setRank("2500");
$playerC->setRank("1200");
$playerD->setRank("1800");

echo "Les joueurs : ","\n\n";

echo "Joueur A : ",$playerA->getRank(),"\n";
echo "Joueur B : ",$playerB->getRank(),"\n";
echo "Joueur C : ",$playerC->getRank(),"\n";
echo "Joueur D : ",$playerD->getRank(),"\n\n";

echo "Probabilités des joueurs : ","\n\n";
 
$matchAB = new Match($playerA,$playerB);
echo "Joueur A face au joueur B : ",$matchAB->get_proba() ,"\n";
echo "Joueur B face au joueur A : ",(1-$matchAB->get_proba()),"\n";

$matchAC = new Match($playerA,$playerC);
echo "Joueur A face au joueur C : ",$matchAC->get_proba() ,"\n";
echo "Joueur C face au joueur A : ",1-$matchAC->get_proba(),"\n";

$matchAD = new Match($playerA,$playerD);
echo "Joueur A face au joueur D : ",$matchAD->get_proba() ,"\n";
echo "Joueur D face au joueur A : ",1-$matchAD->get_proba(),"\n\n";

echo "Rang après le matchs A contre B: ","\n\n";

$matchAB->endMatch(1);
echo "Rang du joueur A : ",$playerA->getRank(),"\n";
echo "Rang du joueur B : ",$playerB->getRank(),"\n";

?>



