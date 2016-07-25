<?php 

/**
 * @author Hudson Moreira Guimaraes - hudymoreira@gmail.com
 *
 */
class Ligacao {
	private $id;
	private $ramal;
	private $data;
	private $arquivo;
	private $numero;
	private $duracao;
	private $bk;

	public function __construct(){
		$this->id = 0;
		$this->ramal = "";  
		$this->data = "";   
		$this->arquivo = "";
		$this->numero = ""; 
		$this->bk = "";     
	}
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	public function getRamal() {
		return $this->ramal;
	}
	public function setRamal($ramal) {
		$this->ramal = $ramal;
		return $this;
	}
	public function getData() {
		return $this->data;
	}
	public function setData($data) {
		$this->data = $data;
		return $this;
	}
	public function getArquivo() {
		return $this->arquivo;
	}
	public function setArquivo($arquivo) {
		$this->arquivo = $arquivo;
		return $this;
	}
	public function getNumero() {
		return $this->numero;
	}
	public function setNumero($numero) {
		$this->numero = $numero;
		return $this;
	}
	public function getDuracao() {
		return $this->duracao;
	}
	public function setDuracao($duracao) {
		$this->duracao = $duracao;
		return $this;
	}
	public function getBk() {
		return $this->bk;
	}
	public function setBk($bk) {
		$this->bk = $bk;
		return $this;
	}
}
?>