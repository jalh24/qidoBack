<?php namespace App\Models;

use CodeIgniter\Model;
use \Datetime;
use \DateInterval;

class PagoModel extends Model
{
  protected $table = 'pagoservicio';
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

  public function getPagos($pagoFiltro) { 

    $filter = ' where pag.idPagoServicio > 0 ';
    if(!empty($pagoFiltro)) {
      if(!empty($pagoFiltro->fecha1) && !empty($pagoFiltro->fecha2)) {
        $fecha1Conv = strtotime($pagoFiltro->fecha1);
        $fecha1new = date('Y-m-d',$fecha1Conv);
        $fecha2Conv = strtotime($pagoFiltro->fecha2);
        $fecha2new = date('Y-m-d',$fecha2Conv);
        $filter = $filter . ' and (pag.fechaPago between \'' . $fecha1new . '\' and \'' . $fecha2new .'\' ) ';
      }
    }
 //   $query = $this->db->query('select * from ' . $this->table . '');
 $query = $this->db->query('select DISTINCT pag.*, DATE_FORMAT(pag.fechaPago,"%d/%m/%Y") AS formatoFecha  from '.$this->table .' pag ' .
                              $filter. ' LIMIT '.$pagoFiltro->start.','. $pagoFiltro->limit);

    return $query->getResult();
  } 

}