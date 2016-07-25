<?php

/**
 * @author Hudson Moreira Guimaraes - hudymoreira@gmail.com
 *
 **/


class Controller {
	public $view;
	public $dbHelper;
	public $ferramenta;
	public function __construct(){
		
		$this->dbHelper = new DbHelper;
		$this->view = new View;
		$this->ferramenta = new Ferramenta;
	
		if(isset($_GET['opt'])){	
			if ($_GET['opt'] =="usuario"){
				if(isset($_GET['delete'])){
					$this->dbHelper->deleteUduario($_GET['delete']);
				}
				$dados = array();
				array_push($dados,$this->dbHelper->selectRamais());
				array_push($dados,$this->dbHelper->selectUsuarios());
				$this->view->load("cadastroUsuario",$dados);
				
			}
			if ($_GET['opt'] =="filtro"){
				$this->view->load("filtro",$this->dbHelper->selectUsuarios());
			}
			if ($_GET['opt'] =="excel"){
				$filtro = array($_GET['ramal'],
								$_GET['mes'  ],
								$_GET['ano'  ]);
				$ligacoes = $this->dbHelper->selectLigacoes($filtro);
				$this->ferramenta->getExcel($ligacoes);
			}
		} elseif (isset($_POST['opt'])){
			if ($_POST['opt'] =="usuario"){
				$usuario = new Usuario();
				$usuario->setNome($_POST['nome']);
				$usuario->setRamal($_POST['ramal']);
				$this->dbHelper->insertUsuario($usuario);
				$dados = array();
				array_push($dados,$this->dbHelper->selectRamais());
				array_push($dados,$this->dbHelper->selectUsuarios());
				$this->view->load("cadastroUsuario",$dados);
				
			}
			if ($_POST['opt'] =="ligacoes"){
				$dados = array();
				
				$filtro = array($_POST['ramal'],
						        $_POST['mes'  ],
						        $_POST['ano'  ]);
				
				array_push($dados, $this->dbHelper->selectLigacoes($filtro));
				array_push($dados, $filtro);
				
				$this->view->load("ligacoes",$dados);
			}
		} else {
			$this->view->load("home");
		}
		
	}
	
}
