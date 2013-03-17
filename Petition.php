<?php
class Petition
{
    public $title;
    public $id;
    public $votes;
    public $category;
    public $date;
    public $description;
    function __construct($json)
    {
        $this->title = NULL;
        $this->id = NULL;
        $this->votes = NULL;
        $this->category = NULL;
        $this->date = NULL;

        $this->title = $json->titlu;
        $this->id = (int)$json->id;
        $this->votes = (int)$json->nrvoturi;
        $this->category = $json->categorie1;
        $this->RowKey = $json->RowKey ;   
        //$this->author;
        //"2013-03-13T00:00:00Z"
        $d = date_parse ( $json->{'data'} ) ;
        $this->date = $d['day'].'.'.$d['month'].'.'.$d['year'] ;
        $this->description = $json->textpetitie;
    }
}
