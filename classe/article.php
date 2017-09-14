<?php
class Compte
{
    protected $_numero;
    protected $_nom;
    protected $_solde;

  public function __construct($unNumero,$unNom,$unSolde)
  {
    $this->_numero=$unNumero;
    $this->_nom=$unNom;
    $this->_solde=$unSolde;
  }
  public function getInfos()
  {
    return "Sur le compte ".$this->_numero.$this->_nom." il y a ".$this->_solde;
  }

}
?>
