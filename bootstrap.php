<?php

/**
 * @author Hudson Moreira Guimaraes - hudymoreira@gmail.com
 *
 **/

$dir = dirname(__FILE__);
session_start();
function appload ($classe){
	$dir = dirname(__FILE__);
	$arquivo = "$dir/app/$classe.php";
	if (file_exists ($arquivo)){
		require_once ($arquivo);
		return true;
	}
}
function libload($classe){
	$dir = dirname(__FILE__);
	$arquivo = "$dir/lib/$classe.php";
	if (file_exists ($arquivo)){
		require_once ($arquivo);
		return true;
	}
}
spl_autoload_register('appload');
spl_autoload_register('libload');
