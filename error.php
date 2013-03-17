<?php
    
function dumpError($errorMessage)
{
    $jsonResponse = array();
    $jsonResponse['success'] = FALSE;
    $jsonResponse['error_message'] = $errorMessage;
    echo json_encode($jsonResponse);
}

?>