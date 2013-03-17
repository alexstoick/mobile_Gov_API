<?php

function checkSignature ( )
{
	global $db_conn ;

	//?action=checkSignature&petitionId=value&email=value

	$email = $_GET ['email'] ;
	$petitionId = $_GET [ 'petitionId' ] ;

	$results = array ( ) ;

	$sql = "SELECT `cod` FROM voturi WHERE email='".$email."' AND id_petitie='".$petitionId."'" ;

    $query = $db_conn ->prepare ( $sql ) ;
    $query -> execute ( ) ;

    $results = $query -> fetchAll ( ) ;

    if ( count ( $results) > 0 )
        $signed = true ;
   	else
   		$signed = false ;

   	$results [ 'signed' ] = $signed ;

   	echo json_encode( $results ) ;
}