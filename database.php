<?php

function create_connection ( )
{
	$db_host = 'hackrogov.cloudapp.net';
	$port = '3306' ;
	$db_user = 'petitii' ;
	$db_password = 'petitii##gov' ;
	$db = 'db_petitii' ;

	$dsn = 'mysql:dbname='.$db.';host='.$db_host.';port='.$port ;
	try{
		$db_conn = new PDO($dsn, $db_user, $db_password);
	}catch (PDOException $e){
		echo 'Connection failed: ' . $e->getMessage();
		return false;
	}
	return $db_conn ;
}

