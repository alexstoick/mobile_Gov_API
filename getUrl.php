<?php
function getUrl($category, $id)
{
    $url = 'http://rogovdata.cloudapp.net:8080/v1/RoGovOpenData/Petitii/?';

    $filter = '$filter=';
    if($category != NULL)
    {
        $filter .= urlencode("categorie1 eq '$category'");
    }
    if(strlen($filter) > 9)
    {
        if($id != NULL)
        {
            $filter .= urlencode("and id eq $id");
        }
    }
    else
    {
        if($id != NULL)
        {
            $filter .= urlencode("id eq $id");
        }
    }

    if(strlen($filter) > 9)
    {
        $url .= $filter;
        $url .= '&format=json';
    }
    else
    {
        $url .= 'format=json';
    }

    return $url;    
}
?>