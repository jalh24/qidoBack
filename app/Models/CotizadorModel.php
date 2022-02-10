<?php namespace App\Models;

use CodeIgniter\Model;

class CotizadorModel extends Model
{

	protected $db;

  public function __construct()
  {
      parent::__construct();
      $this->db = \Config\Database::connect();
  }

//   public function getCostoTurno() { 
//     $query = $this->db->query('select * from costoturno');
//     return $query->getResult();
//   }

//   public function getGastoServicio() { 
//     $query = $this->db->query('select * from gastoservicio');
//     return $query->getResult();
//   }

  public function getCostoTurno($tipoCosto) { 
    $query = $this->db->query('select * from costoturno where idTipoCosto='.$tipoCosto);
    return $query->getResult();
  }

  public function getGastoServicio($tipoCosto) { 
    $query = $this->db->query('select * from gastoservicio where idTipoCosto='.$tipoCosto);
    return $query->getResult();
  }

  public function getPolizas() { 
    $query = $this->db->query('select * from polizas');
    return $query->getResult();
  }

  public function getPagosPersonal() { 
    $query = $this->db->query('select * from pagospersonal');
    return $query->getResult();
  }

  public function getPreciosCliente() { 
    $query = $this->db->query('select * from precioscliente');
    return $query->getResult();
  }

}