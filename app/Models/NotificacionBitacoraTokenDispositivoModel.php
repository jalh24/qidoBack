<?php namespace App\Models;

use CodeIgniter\Model;
use \Datetime;
use \DateInterval;

class NotificacionBitacoraTokenDispositivoModel extends Model
{
  protected $table = 'bitacoratokendispositivo';
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

  public function getBitacorasTokenDispositivo($dato) { 
    $query = $this->db->query('select * from ' . $this->table . ' where tokenDispositivo = "'.$dato.'"');
    return $query->getResult();
  }

  public function getCountNotificaciones($dato) { 
    $query = $this->db->query('select bitacoraT.tokenDispositivo, COUNT(*),s.cliente FROM bitacoratokendispositivo AS bitacoraT INNER JOIN bitacoraservicio AS b ON bitacoraT.idBitacora = b.idBitacora INNER JOIN servicio AS s ON b.idServicio = s.idServicio WHERE bitacoraT.tokenDispositivo = "'.$dato.'" GROUP BY bitacoraT.tokenDispositivo, s.cliente');
    return $query->getResult();
  }

  public function getBitacorasTokenDispositivoByCliente($dato,$cliente) { 
    $query = $this->db->query('select bitacoraT.*, s.cliente FROM bitacoratokendispositivo AS bitacoraT INNER JOIN bitacoraservicio AS b ON bitacoraT.idBitacora = b.idBitacora INNER JOIN servicio AS s ON b.idServicio = s.idServicio WHERE bitacoraT.tokenDispositivo = "'.$dato.'" AND s.cliente = '.$cliente);
    return $query->getResult();
  }

  public function getDeleteNotificacionBitacora($dato,$idBitacora) {
    $safeMode = $this->db->query('SET SQL_SAFE_UPDATES = 0');
    $query = $this->db->query('delete from bitacoratokendispositivo where tokenDispositivo = "'.$dato.'" and idBitacora = '.$idBitacora);
    $safeMode = $this->db->query('SET SQL_SAFE_UPDATES = 1');
    return $query->getResult();
  }
}