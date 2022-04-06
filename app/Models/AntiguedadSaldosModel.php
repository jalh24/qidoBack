<?php namespace App\Models;

use CodeIgniter\Model;
use \Datetime;
use \DateInterval;

class AntiguedadsaldosModel extends Model
{
  protected $table = 'servicio';
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

  public function getDeudores() { 
    $query = $this->db->query('select *, (DATEDIFF(NOW(), fechaCreacion)) AS diferenciaDias FROM servicio WHERE DATEDIFF(NOW(), fechaCreacion) >= 1 AND cantidadPorPagar > 0 ORDER BY cliente ASC');
    return $query->getResult();
  }

}