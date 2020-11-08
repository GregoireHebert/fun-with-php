
<?php 
class Player
{
    private $_name;
    private $_points = 1200;
    private $_status;

    function __construct($nom) {
        $this->_name = $nom;
    }

    public function name(){
        return $this->_name;
    }

    public function Status(){
        return $this->_points;
    }


    public function getPoints(){
        return $this->_points;
    }

    public function setPoints($value){
        $this->_points = $value;
    }

    public function getName(){
        return $this->_name;
    }
}
?>