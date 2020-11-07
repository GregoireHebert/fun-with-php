<?php
    include "joueur.php";

    class match {

        public function __construct($jA, $jB) {
        $result = 1/(1+pow(10,($jA->elo-$jB->elo)/400));
        echo $result.PHP_EOL;
            if ($result > 0.5) {
                echo "Victoire de ".$jA->name.PHP_EOL;
                //correction du elo
                //$jA->elo += 32*(1-$result);
                //$jB->elo += 32*(0-(1-$result));//on inverse la proba avec 1-$result
            } elseif ($result < 0.5) {
                echo "Victoire de ".$jB->name.PHP_EOL;
                //correction du elo
                //$jB->elo += 32*(1-$result);
                //$jA->elo += 32*(0-(1-$result));//on inverse la proba avec 1-$result
            } else {
                echo "Egalité de ".$jA->name." et de ".$jB->name.PHP_EOL;
                //correction du elo
                //$jA->elo += 32*(0.5-$result);
                //$jB->elo += 32*(0.5-$result);
            }
        }
    }
?>