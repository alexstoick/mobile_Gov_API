<?php

function login()    
{

    $response = array();
    $response['success'] = NULL;
    $email = $_GET['user'];
    $password = $_GET['pass'];

	global $db_conn ;
	$sql = "SELECT `NUME`,`PRENUME`,`PAROLA` FROM conturi WHERE email='".$email."'" ;

	$query = $db_conn ->prepare ( $sql ) ;
	$query -> execute ( ) ;

	$results = $query -> fetchAll ( ) ;

	$count = count ( $results ) ;
	
	$returnValue = array ( ) ;

	$success = false ;

	if ( $count == 1)
	{
		if ( $password == $results[0][2] )
		{
			$success = true ;
			$response['nume'] = $results[0][0] ;
			$response['prenume'] = $results[0][1] ;
		}
	}

	$response['success'] = $success ;

	echo json_encode( $response ) ;

}
