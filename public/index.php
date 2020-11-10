<?php

include ('src/Entity/Player.php');
include ('src/Entity/Match.php');

$playerA = new Player("Player A");
$playerA->_points = 1399;
$playerB = new Player("Player B");
$playerB->_points = 1801;
$playerB->_level->_levelNumber = 4;
echo("Points des deux joueurs avant match :\n");
echo("Points Player A : " . $playerA->_points . "\n");
echo("Points Player B : " . $playerB->_points . "\n\n");


echo("Niveaux des deux joueurs avant match :\n");
echo("Niveau Player A : " . ($playerA->_level->_levelNumber) . "\n");
echo("Niveau Player B : " . ($playerB->_level->_levelNumber). "\n\n");

$match1 = new Match($playerA, $playerB);
$matchResultForPlayerA = $match1->playMatch();
echo("Points Player A : " . $playerA->_points . "\n");
echo("Points Player B : " . $playerB->_points . "\n\n");

$match1 = new Match($playerA, $playerB);
$matchResultForPlayerA = $match1->playMatch();
echo("Points Player A : " . $playerA->_points . "\n");
echo("Points Player B : " . $playerB->_points . "\n\n");

$match1 = new Match($playerA, $playerB);
$matchResultForPlayerA = $match1->playMatch();
echo("Points Player A : " . $playerA->_points . "\n");
echo("Points Player B : " . $playerB->_points . "\n\n");

$match1 = new Match($playerA, $playerB);
$matchResultForPlayerA = $match1->playMatch();
echo("Points Player A : " . $playerA->_points . "\n");
echo("Points Player B : " . $playerB->_points . "\n\n");

$match1 = new Match($playerA, $playerB);
$matchResultForPlayerA = $match1->playMatch();
echo("Points Player A : " . $playerA->_points . "\n");
echo("Points Player B : " . $playerB->_points . "\n\n");

?>