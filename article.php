<?php
class Article
{
    protected $id;
    protected $titre;
    protected $date;
    protected $contenu;

  public function __construct($id,$titre,$date,$contenu)
  {
    $this->id=$id;
    $this->titre=$unNom;
    $this->date=$date;
    $this->$contenu=$contenu
  }
  public function getInfos()
  {
    return "Sur le compte ".$this->_numero.$this->_nom." il y a ".$this->_solde;
  }

  public function insertion()
  {

  }
  public function modification()
  {

  }
  public function suppression()
  {

  }

}
?>
