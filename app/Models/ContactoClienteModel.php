<?php namespace App\Models;

use CodeIgniter\Model;

class ContactoClienteModel extends Model
{
  protected $table = 'contactocliente';
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
          "idContactoCliente" => $id,
      ));
      return $this->db->affectedRows();
  }

  public function delete_data($id)
  {
      return $this->db->table($this->table)->delete(array(
          "idContactoCliente" => $id,
      ));
  }

  public function getContactosColaborador($idColaborador) { 
    $query = $this->db->query('select * from ' . $this->table . ' where idCliente ='.$idColaborador);
    return $query->getResult();
  } 

}