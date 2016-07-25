<?php 

/**
 * @author Hudson Moreira Guimaraes - hudymoreira@gmail.com
 *
 */
class Usuario {
	
	private $id;
	private $nome;
	private $ramal;
	
	public function __construct(){
		$this->id    = 0;
		$this->nome  = "";
		$this->ramal = 0;
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
		return $this;
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