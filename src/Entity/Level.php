<?php

class Level {
    public int $_levelNumber = 1;

   
    public function checkPlayerLevel($points, $name): void { 
        $arrayLevel = [1200,1400,1600,1800,2000,2200,2300,2400,2500];
        $counter = 0;
        $levelChecked = FALSE;
        if(!$this->levelNumber == count($arrayLevel)) {
            while(!$levelChecked) {
                if($points > $arrayLevel[$counter + 1] /*&& $points < $arrayLevel[$counter + 1] */) {
                    $counter = $counter + 1;
                } else {
                    $levelChecked = TRUE;
                    if($this->_levelNumber < $counter + 1) {
                        echo "$name promoted to level " . ($counter + 1) . "\n";
                        $this->_levelNumber = $counter + 1;
                    } else if($this->_levelNumber > $counter + 1) {
                        echo "$name releguated to level " . ($counter + 1) . "\n";
                        $this->_levelNumber = $counter + 1;
                    }
                }
            }    
        }
        
    }
}

?>