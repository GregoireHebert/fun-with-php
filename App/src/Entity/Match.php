<?php

require "Player.php";

class Match {

	private Player $player1;
	private Player $player2;

	function __construct(Player $player1, Player $player2) {
		$this->player1 = $player1;
		$this->player2 = $player2;
	}

	function getPlayer1() {
		return $this->player1;
	}

	function getPlayer2() {
		return $this->player2;
	}

	public function getProbabilityOp1() {
		return $this->computeProbability($this->player2, $this->player1);
	}

	public function getProbabilityOp2() {
		return $this->computeProbability($this->player1, $this->player2);

	}
	
	public function finishMatch(int $winner) {
		if($winner == 1) {
			$this->player1->setRatio($this->player1->getRatio() + 32 * (1 - $this->getProbabilityOp1()));
			$this->player2->setRatio($this->player2->getRatio() + 32 * (0 - $this->getProbabilityOp2()));
		} else {
			$this->player1->setRatio($this->player1->getRatio() + 32 * (0 - $this->getProbabilityOp1()));
			$this->player2->setRatio($this->player2->getRatio() + 32 * (1 - $this->getProbabilityOp2()));
		}
	}


	// A externaliser

	private function computeProbability(Player $player1, Player $player2) {

		return bcdiv(1, bcadd(1, pow(10, 
			bcdiv(bcsub($player1->getRatio(), $player2->getRatio()), 400, 10)
		), 10), 10);
		
	}

}

?>