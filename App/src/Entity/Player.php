<?php
class Player {
	
	public const DEFAULT_RATIO = 1200;
	private string $name;
	private float $ratio;

	function __construct(string $name) {
		$this->name = $name;
		$this->ratio = self::DEFAULT_RATIO;
	}

	function getName() {
		return $this->name;
	}

	public function getRatio() {
		return $this->ratio;
	}

	public function setRatio(int $value) {
		$this->ratio = $value;
	}

}

?>