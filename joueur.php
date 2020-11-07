<?php
    class joueur {
        public $name;
        public $elo;

        public function __construct($parameter) {
            $this->name = $parameter;
            $this->elo = 1200;
        }

        public function __toString(): string {
            return sprintf('name : %s, elo : %d', $this->name, $this->elo).PHP_EOL;
        }
    }
?>