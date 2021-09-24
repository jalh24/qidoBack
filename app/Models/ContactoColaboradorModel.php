<?php namespace App\Models;

use CodeIgniter\Model;

class ContactoColaboradorModel extends Model
{
  protected $table = 'contactocolaborador';
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
          "idContactoColaborador" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function delete_data($id)
  {
      return $this->db->table($this->table)->delete(array(
          "idContactoColaborador" => $id,
      ));
  }

  public function getContactosColaborador($idColaborador) { 
    $query = $this->db->query('select * from ' . $this->table . ' where idColaborador ='.$idColaborador);
    return $query->getResult();
  } 

}