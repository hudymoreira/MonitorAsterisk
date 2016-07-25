<?php

/**
 * @author Hudson Moreira Guimaraes - hudymoreira@gmail.com
 *
 **/

class DbHelper {
	private $con;
	public function __construct(){
		$this->con = new PDO("mysql:host=localhost;dbname=MLigacao", "root", "master");
	}
	
	public function selectLigacoes($filtro){
		$query = "SELECT * FROM Ligacoes where year(data_ligacao) = ".$filtro[2]." ";
		
		if ($filtro[0] <> 0){
			$query = $query . " and ramal = " . $filtro[0] ;	
		}
		if ($filtro[1] <> 0){
			$query = $query . " and month(data_ligacao) = " . $filtro[1] ;
		}
		
		$Ligacoes = array();
		$select = $this->con->query($query);
		
		while($linha = $select->fetch(PDO::FETCH_OBJ)){
			$ligacao = new Ligacao();
			$ligacao->setId     ($linha->id_ligacao);
			$ligacao->setRamal  ($linha->ramal);
			$ligacao->setData   ($linha->data_ligacao);
			$ligacao->setArquivo($linha->arquivo );
			$ligacao->setNumero ($linha->numero);
			$ligacao->setDuracao($linha->duracao);
			$ligacao->setBk     ($linha->bk);
			array_push($Ligacoes, $ligacao);
		}
		return $Ligacoes;
	}
	public function selectRamais(){
		$ramais = array();
		$select = $this->con->query("select L.ramal from Ligacoes L WHERE NOT EXISTS (SELECT ramal FROM Usuario U Where L.ramal = U.ramal ) group by L.ramal ");
		while($linha = $select->fetch(PDO::FETCH_OBJ)){
			$ramal = new Ramal();
			$ramal->setRamal($linha->ramal);
			array_push($ramais, $ramal);
		}
		return $ramais;
	}
	public function selectUsuarios(){
		$usuarios = array();
		$select = $this->con->query("select * from Usuario");
		while($linha = $select->fetch(PDO::FETCH_OBJ)){
			$usuario = new Usuario();
			$usuario->setid   ($linha->id_usuario);
			$usuario->setNome ($linha->nome);
			$usuario->setRamal($linha->ramal);
			array_push($usuarios, $usuario);
		}
		return $usuarios;
	}
	public function insertUsuario(Usuario $usuario){
			$stmt = $this->con->prepare("INSERT INTO Usuario (nome, ramal) VALUES(?,?)");
			$stmt->bindParam(1 ,$usuario->getNome() );
			$stmt->bindParam(2 ,$usuario->getRamal());
			$stmt->execute();
	}
	public function deleteUduario($id){
		$stmt = $this->con->prepare("DELETE FROM Usuario where id_usuario = ?");
		$stmt->bindParam(1 ,$id );
		$stmt->execute();
	}
	
}
