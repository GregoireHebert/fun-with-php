
<?php



class LevelManager {

    /**
     * renvoie le niveau d'un joueur selon ses points
     */
    public static function getLevel(float $points) : string{
        switch ($points) {
            case $points <= 1200 : 
               return "Debutant";
               break;
            case $points > 1200 && $points < 2200 : 
                return "Averti";
               break;
            case $points > 2200 : 
                return "Expert";
               break;
            default;
           }
    }
}