<?php
function dumpPetitionList()
{

    if ( ! isset ( $_GET['category'] ) )
        $category = NULL ;
    else
        $category = $_GET['category'] ;

    //action=petitionList[&category=JUSTITIE][&requestCategories=1][&id=value]

    if ( ! isset ( $_GET['id'] ) )
        $id = NULL ;
    else
        $id = $_GET['id'] ;

    $url = getUrl($category, $id);
    $jsonResponse = file_get_contents($url);
    $jsonResponse = json_decode($jsonResponse);

    $response = array ( ) ;

    if ( ! isset ( $_GET['requestCategories'] ) )
    {
        foreach($jsonResponse->{'d'} as $jsonPet)
        {
            $pet = new Petition($jsonPet);
            array_push($response, $pet);
        }
    }
    else
    {
        foreach ( $jsonResponse->{'d'} as $jsonItem )
        {
            $category = $jsonItem -> {"categorie1"} ;
            array_push ( $response , $category ) ;
        }
    }

    echo json_encode($response);
}
