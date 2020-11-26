<?php

namespace App\Entity;

class Level {
    public int $_levelNumber = 1;

   
    public function checkPlayerLevel($points, $name): void { 
        $arrayLevel = [1200,1400,1600,1800,2000,2200,2300,2400,2500];
        $counter = 0;
        // On gère le dernier niveau
        if($points < 2500 && $this->_levelNumber === 9) {
          //  echo "$name releguated to level " . ($this->_levelNumber - 1) . "\n";
            $this->_levelNumber = $this->_levelNumber - 1;
        } else if($points > 2500 && $this->_levelNumber === 8) {
          //  echo "$name promoted to level " . ($this->_levelNumber + 1) . "\n";
            $this->_levelNumber = $this->_levelNumber + 1;
        } else {
            // On gère les autres niveaux
            while($counter !== count($arrayLevel)) {
                if($points > $arrayLevel[$counter + 1]) {
                    $counter = $counter + 1;
                } else {
                    if($this->_levelNumber < $counter + 1) {
               //         echo "$name promoted to level " . ($counter + 1) . "\n";
                        $this->_levelNumber = $counter + 1;
                        return;
                    } else if($this->_levelNumber > $counter + 1) {
                //        echo "$name releguated to level " . ($counter + 1) . "\n";
                        $this->_levelNumber = $counter + 1;
                        return;
                    }
                    return;
                }
            }    
        }
        
    }
}

?>