<?php namespace App\Models;

use CodeIgniter\Model;

class ColaboradorModel extends Model
{
  protected $table = 'colaborador';
  protected $db;

  public function __construct()
  {
      parent::__construct();
      $this->db = \Config\Database::connect();
      // OR $this->db = db_connect();
  }

public function insert_data($data = array())
  {
      return $this->db->table($this->table)->insert($data);
      //return $this->db->insertID();
  }

  public function update_data($id, $data = array())
  {
      $this->db->table($this->table)->update($data, array(
          "idColaborador" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function delete_data($id)
  {
      return $this->db->table($this->table)->delete(array(
          "idColaborador" => $id,
      ));
  }

  public function getColaboradores() { 
    $query = $this->db->query('select * from ' . $this->table);
    return $query->getResult();
  } 

}