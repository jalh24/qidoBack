<?php namespace App\Models;

use CodeIgniter\Model;
use \Datetime;
use \DateInterval;

class BitacoraModel extends Model
{
  protected $table = 'bitacoraservicio';
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

    public function getEstadosAnimo() { 
    $query = $this->db->query('select * from estadoanimo');
    return $query->getResult();
  }

  public function getActividades() { 
    $query = $this->db->query('select * from actividad');
    return $query->getResult();
  } 

  public function getLastBitacora($dato) { 
    $query = $this->db->query('select * from bitacoraservicio where idServicio = "'.$dato.'" order by fechaCaptura desc limit 1');
    return $query->getResult();
  }

}