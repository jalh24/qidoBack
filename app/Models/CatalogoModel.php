<?php namespace App\Models;

use CodeIgniter\Model;

class CatalogoModel extends Model
{

	protected $db;

  public function __construct()
  {
      parent::__construct();
      $this->db = \Config\Database::connect();
  }

  public function getZonasLaborales() { 
    $query = $this->db->query('select * from zonalaboral');
    return $query->getResult();
  } 

  public function getSexo() { 
    $query = $this->db->query('select * from sexocat');
    return $query->getResult();
  } 

  public function getParentesco() { 
    $query = $this->db->query('select * from parentescocat');
    return $query->getResult();
  } 

  public function getTez() { 
    $query = $this->db->query('select * from tezcat');
    return $query->getResult();
  } 

  public function getEstadoCivil() { 
    $query = $this->db->query('select * from estadocivilcat');
    return $query->getResult();
  } 

  public function getPaises() { 
    $query = $this->db->query('select * from pais');
    return $query->getResult();
  } 

  public function getEstados($pais) { 
    $query = $this->db->query('select * from estado where idPais='.$pais);
    return $query->getResult();
  }

  public function getCiudad($estado) { 
    $query = $this->db->query('select * from ciudad where idEstado='.$estado);
    return $query->getResult();
  }

  public function getColonias($pais) { 
    $query = $this->db->query('select * from colonia where idCiudad='.$ciudad);
    return $query->getResult();
  }

  public function getColoniasByCodigoPostal($codigoPostal) { 
    $query = $this->db->query('select * from colonia where codigoPostal='.$codigoPostal);
    return $query->getResult();
  }
  public function getCiudadesByCodigoPostal($codigoPostal) { 
    $query = $this->db->query('select * from ciudad where idCiudad='.$codigoPostal);
    return $query->getResult();
  }
  public function getEstadosByCodigoPostal($codigoPostal) { 
    $query = $this->db->query('select * from estado where idEstado='.$codigoPostal);
    return $query->getResult();
  }

  public function getEstatus($tipo) { 
    $query = $this->db->query('select * from estatus where tipo='.$tipo);
    return $query->getResult();
  }


}