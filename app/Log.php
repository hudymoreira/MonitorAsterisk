<?php

//Multiline error log class
// ersin güvenç 2008 eguvenc@gmail.com
//For break use "\n" instead '\n'

Class Log {
	//
	const USER_ERROR_DIR = '/var/log/mligacoes.log';
	const GENERAL_ERROR_DIR = '/var/log/mligacoesGeneral.log';

	/*
	 User Errors...
	 */
	public function user($msg,$username)
	{
		$date = date('d.m.Y h:i:s');
		
		
		//$log = $msg."   |  Date:  ".$date."  |  User:  ".$username."\n";
		$log = "|  Date:  ".$date."  |  User:  ".$username." | " . $msg ."\n";
		
		error_log($log, 3, self::USER_ERROR_DIR);
	}
	/*
	 General Errors...
	 */
	public function geral($msg)
	{
		$date = date('d.m.Y h:i:s');
		$log = " |  Date:  ".$date." | " .$msg ."\n";
		
		error_log($log, 3, self::GENERAL_ERROR_DIR);
	}

}