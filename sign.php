<?php
$pathToLibs = realpath(__DIR__ . '/../application/libraries');
set_include_path($pathToLibs . PATH_SEPARATOR  . get_include_path());

require_once 'WindowsAzure/WindowsAzure.php';

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;
use WindowsAzure\Table\Models\Entity;
use WindowsAzure\Table\Models\EdmType;


function sign()
{
    global $db_conn ;

    $petitionId = $_GET['petitionId'];
    $email = $_GET['email'] ;
    $RowKey = $_GET['RowKey'] ;
    $nume = $_GET ['nume'] ;
    $prenume = $_GET [ 'prenume' ] ;

    if( $petitionId == NULL)
    {
        dumpError('Invalid arguments supplied.');
        return;
    }

    //update in odata

    // Create table REST proxy.

    $connectionString = 'DefaultEndpointsProtocol=http;AccountName=rogovdata;AccountKey=tLSPDUCHwb/WhTRwNgRLfNJtlilquET7yNyU6fFzmZoB1vTDXuJcm6r1+oTu8Xe4XQbLOKhbugNPCpNIRoLMNg==';


    //have to get PartitionKey and RowKey
    $PartitionKey = "" ;
    $RowKey = "1363462020" ;

 
    $tableConnection = ServicesBuilder::getInstance()->createTableService($connectionString);

    $result = $tableConnection->getEntity('Petitii', $PartitionKey , $RowKey ) ;
    $entity = $result->getEntity(); 

    $results = array ( ) ;

    $entity->setPropertyValue("nrvoturi", ((int)$entity->getProperty("nrvoturi")->getValue() + 1));     
    try {
        $tableConnection->updateEntity('Petitii', $entity);
        $results['success'] = true ;
    } catch (ServiceException $e) {
        dumpError ( $e->getMessage() . '<br />' . $e->getTraceAsString() ) ;
        return ;
    }


    $sql = "INSERT INTO voturi VALUES ('".$nume."', '".$prenume."', '".$email."', '1', '1', '".$petitionId."')" ;

    $query = $db_conn ->prepare ( $sql ) ;
    $query -> execute ( ) ;

    echo json_encode( $results ) ;
}

//INSERT INTO voturi VALUES ('abc', '4fg',  'a@a.a', '1', '1', 'abc')