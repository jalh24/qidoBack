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
      if(!empty($pagoFiltro->pacientes)) {
        $filter = $filter . ' and ser.cliente= ' . $pagoFiltro->pacientes[0]->cliente;
      }
      if(!empty($pagoFiltro->estatusPago)) {
        $filter = $filter . ' and est.idTipoEstatusPago= ' . $pagoFiltro->estatusPago;
      }
    }
 //   $query = $this->db->query('select * from ' . $this->table . '');
 $query = $this->db->query('select DISTINCT pag.*, ser.cliente, CONCAT_WS(" ",ser.nombre,ser.a_paterno,ser.a_materno) as nombrecompleto, DATE_FORMAT(pag.fechaPago,"%d/%m/%Y") AS formatoFecha, est.Nombre as estatusPagoNombre  from '.$this->table .' pag inner join servicio ser on pag.idServicio=ser.idServicio left join tipoestatuspago est on est.idTipoEstatusPago=pag.estatusPago' .
                              $filter. ' LIMIT '.$pagoFiltro->start.','. $pagoFiltro->limit);

    return $query->getResult();
  } 

  public function getPagosNums($pagoFiltro) {
    $filter = ' where idPagoServicio > 0 ';
    if(!empty($pagoFiltro)) {
      if(!empty($pagoFiltro->fecha1) && !empty($pagoFiltro->fecha2)) {
        $fecha1Conv = strtotime($pagoFiltro->fecha1);
        $fecha1new = date('Y-m-d',$fecha1Conv);
        $fecha2Conv = strtotime($pagoFiltro->fecha2);
        $fecha2new = date('Y-m-d',$fecha2Conv);
        $filter = $filter . ' and (pag.fechaPago between \'' . $fecha1new . '\' and \'' . $fecha2new .'\' ) ';
      }
      // if(!empty($pagoFiltro->colaboradores)){
      //   // $filter = $filter . ' and atiendeCovid= ' . $colaboradorFiltro->atiendeCovid;
      //   // $col = json_decode($pagoFiltro->colaboradores[1]);
      //   // $col = implode(",",$pagoFiltro->colaboradores);
      //   // var_dump($pagoFiltro->colaboradores[0]->nombrecompleto);
      //   $filter = $filter . ' and CONCAT_WS(" ",colab.nombre,colab.a_paterno,colab.a_materno)= \'' . $pagoFiltro->colaboradores[0]->nombrecompleto.'\'';
      // }
      if(!empty($pagoFiltro->estatus)) {
        $filter = $filter . ' and estatus= \'' . $pagoFiltro->estatus.'\'';
      }
  }
                                
    $query = $this->db->query('select count(DISTINCT pag.idPagoServicio) total from ' . $this->table . ' pag '.
                              $filter);
    return $query->getResult();
  }
}