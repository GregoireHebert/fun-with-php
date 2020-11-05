<?php


class Probability
{
    private $Ra;
    private $Rb;

    public function __construct(float $Ra, float $Rb) {
        $this->Ra = $Ra;
        $this->Rb = $Rb;
    }

    public function getProbability() {
        return 1 / (1 + (pow(10,($this->Rb - $this->Ra) /400)));
    }
}
