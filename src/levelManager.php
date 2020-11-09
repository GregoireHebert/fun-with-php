
<?php



class LevelManager {


    public static function getLevel(float $points) : string{
        switch ($points) {
            case $points <= 1200 : 
               return "Debutant";
            case $points > 1200 && $points < 2200 : 
                return "Averti";
            case $points > 2200 : 
                return "Expert";
            default:
                throw new UnexpectedValueException("!! Erreur lors du calcul du niveau !!");
           }
    }
}