<?php namespace App\Models;

use CodeIgniter\Model;
use \Datetime;
use \DateInterval;

class EstadoCuentaModel extends Model
{
  protected $table = 'cliente';
  protected $db;

  public function __construct()
  {
      parent::__construct();
      $this->db = \Config\Database::connect();
      // OR $this->db = db_connect();
  }

public function insert_data($data = array())
  {
      $this->db->table($this->table)->insert($data);
      return $this->db->insertID();
  }

  public function getPacientes() { 
    $query = $this->db->query('select *, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from cliente');
    return $query->getResult();
  }

  public function getListaPacientes($dato) { 
    $query = $this->db->query('select *, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from servicio inner join pagoservicio on servicio.idServicio=pagoservicio.idServicio where cliente='.$dato);
    return $query->getResult();
  }

}