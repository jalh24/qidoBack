<?php namespace App\Models;

use CodeIgniter\Model;
use \Datetime;
use \DateInterval;

class EstadocuentaModel extends Model
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

  public function getPacientes() { 
    $query = $this->db->query('select *, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from cliente');
    return $query->getResult();
  }

  // public function getListaPacientes($dato) { 
  //   $query = $this->db->query('select *, CONCAT_WS(" ",nombre,a_paterno,a_materno) as nombrecompleto from servicio inner join pagoservicio on servicio.idServicio=pagoservicio.idServicio where cliente='.$dato);
  //   return $query->getResult();
  // }

  public function getListaPacientes($estadocuentaFiltro) {
    $filter = ' where serv.idServicio > 0 ';
    if(!empty($estadocuentaFiltro)) {
      if(!empty($estadocuentaFiltro->fecha1) && !empty($estadocuentaFiltro->fecha2)) {
        $fecha1Conv = strtotime($estadocuentaFiltro->fecha1);
        $fecha1new = date('Y-m-d',$fecha1Conv);
        $fecha2Conv = strtotime($estadocuentaFiltro->fecha2);
        $fecha2new = date('Y-m-d',$fecha2Conv);
        $filter = $filter . ' and (serv.fechaCreacion between \'' . $fecha1new . '\' and \'' . $fecha2new .'\' ) ';
      }
      if(!empty($estadocuentaFiltro->pacientes)) {
        $filter = $filter . ' and serv.cliente= ' . $estadocuentaFiltro->pacientes[0]->idCliente;
      }
  }

    $query = $this->db->query('select *, CONCAT_WS(" ",serv.nombre,serv.a_paterno,serv.a_materno) as nombrecompleto from ' . $this->table . ' serv ' . ' inner join pagoservicio pag on serv.idServicio=pag.idServicio'.
                              $filter);
    
    // var_dump('select *, CONCAT_WS(" ",serv.nombre,serv.a_paterno,serv.a_materno) as nombrecompleto, from ' . $this->table . ' serv ' . ' inner join pagoservicio pag on serv.idServicio=pag.idServicio'.
    // $filter);

    return $query->getResult();
  }

}