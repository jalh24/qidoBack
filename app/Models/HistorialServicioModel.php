<?php namespace App\Models;

use CodeIgniter\Model;

class HistorialServicioModel extends Model
{
  protected $table = 'historialservicio';
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

  public function update_data($id, $data = array())
  {
      $this->db->table($this->table)->update($data, array(
          "idHistorialServicio" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function delete_data($id)
  {
      return $this->db->table($this->table)->delete(array(
          "idHistorialServicio" => $id,
      ));
  }

  public function getHistorialServiciosColaborador($idColaborador) { 
    $query = $this->db->query('select * from ' . $this->table . ' where idColaborador ='.$idColaborador);
    return $query->getResult();
  }

  public function eliminarHistorialServicios($idHistorialServicio,$colabHistServ) {

    $query = $this->db->query('delete from ' . $this->table . ' where idHistorialServicio=' . $idHistorialServicio . ' and idColaborador=' . $colabHistServ->idColaborador);
}

public function agregarHistorialServicios($idHistorialServicio,$colabHistServ) {
    $query = $this->db->query('insert into historialservicio(idColaborador,fecha,responsable,observaciones) values (' . $colabHistServ->idHistorialServicio . ' ,' . $colabHistServ->fechaHistorialServicio . ' ,' . "'".$colabHistServ->responsableHistorialServicio."'" . ' ,' . "'".$colabHistServ->observacionesHistorialServicio."'" . ')');
  }

  public function deleteHistorialServiciosColaboradorExistente($idServicio) { 
    $query = $this->db->query('delete from historialservicio where idHistorialServicio =' . $idServicio . ' LIMIT 1');
    return;
  }

}