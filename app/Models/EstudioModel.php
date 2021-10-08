<?php namespace App\Models;

use CodeIgniter\Model;

class EstudioModel extends Model
{
  protected $table = 'estudio';
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
          "idEstudio" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function delete_data($id)
  {
      return $this->db->table($this->table)->delete(array(
          "idEstudio" => $id,
      ));
  }

  public function getEstudiosColaborador($idColaborador) { 
    $query = $this->db->query('select est.*, es.nombre estatusNombre from ' . $this->table . ' est inner join estatus  es on es.idEstatus = est.idEstatus where idColaborador ='.$idColaborador);
    return $query->getResult();
  } 

}