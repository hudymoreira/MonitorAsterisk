<?php

/**
 * @author Hudson Moreira Guimaraes - hudymoreira@gmail.com
 *
 **/


class View {
	public function load($file, $dados = null){
		header("Content-Type: text/html;  charset=ISO-8859-1",true);
		include("views/header.tpl.php");
		include("views/$file.tpl.php");
		include("views/footer.tpl.php");
	}
}
