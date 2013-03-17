<?php
    
//Always echo JSON
header('Content-type: application/json');

include 'Petition.php';
include 'database.php' ;
include 'getUrl.php';
include 'dumpPetitionList.php';
include 'login.php';
include 'error.php';
include 'utility.php';
include 'sign.php';
include 'checkSignature.php' ;


$db_conn = create_connection ( );

$action = $_GET['action'];

switch($action)
{
    case "checkSignature":
    {
        checkSignature ( ) ;
        break ;
    }
    case "petitionList":
    {
        dumpPetitionList();
        break;
    }
    case "login":
    {
        login();
        break;
    }
    case "sign":
    {
        sign();
        break;        
    }
    case NULL:
    {
        dumpError('No action supplied.');
        break;
    }
    default:
    {
        dumpError('Invalid action was supplied.');
        break;
    }
}
?>
