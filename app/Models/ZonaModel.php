<?php namespace App\Models;

use CodeIgniter\Model;

class ZonaModel extends Model
{
  protected $table = 'colaboradorzona';
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
          "idZonaLaboral" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function delete_data($idZona,$idColaborador)
  {
      return $this->db->table($this->table)->delete(array(
          "idZonaLaboral" => $idZona,"idColaborador" =>$idColaborador
      ));
  }

  public function getZonasColaborador($idColaborador) { 
    $query = $this->db->query('select * from ' . $this->table . ' where idColaborador ='.$idColaborador);
    return $query->getResult();
  } 

}