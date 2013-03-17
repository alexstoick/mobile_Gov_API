<?php
    
function notNullValue($primary, $secondary)
{
    if($primary == NULL)
    {
        return $secondary;
    }
    else
    {
        return $primary;
    }
}

?>