<?php 

class Ramal{
	
	private $ramal;
	
	public function __construct(){
		$this->ramal = 0;
	}
	public function getRamal() {
		return $this->ramal;
	}
	public function setRamal($ramal) {
		$this->ramal = $ramal;
		return $this;
	}
	
}


?>