
<?php 
class Player
{
    private $username;
    private $rank = 1200;
    private $status;

    function __construct($name) {
        $this->username = $name;
    }

    public function name(){
        return $this->username;
    }

    public function Status(){
        return $this->rank;
    }

    public function getRank(){
        return $this->rank;
    }

    public function setRank($value){
        $this->rank = $value;
    }

    public function getUsername(){
        return $this->username;
    }
}
?>